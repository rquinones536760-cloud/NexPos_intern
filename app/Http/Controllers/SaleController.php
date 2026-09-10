<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SALES LIST
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $sales = Sale::with('customer')
            ->when($request->search, function ($query, $search) {

                $query->where(
                    'invoice_number',
                    'like',
                    "%{$search}%"
                );

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'Sales.index',
            compact('sales')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SALE DETAILS
    |--------------------------------------------------------------------------
    */

    public function show(Sale $sale)
    {
        $sale->load([
            'customer',
            'items.product'
        ]);

        return view(
            'Sales.show',
            compact('sale')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE SALE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'payment_method' => [
                'required',
                'string',
                'in:cash,card,gcash',
            ],

            'payment_reference' => [
                'nullable',
                'string',
                'max:100',
            ],

            'payment_proof' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | GCASH VALIDATION
        |--------------------------------------------------------------------------
        */

        if (
            $validated['payment_method'] === 'gcash' &&
            empty($validated['payment_reference']) &&
            !$request->hasFile('payment_proof')
        ) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Please provide a GCash reference ID or payment proof.',

            ], 422);
        }


        try {

            /*
            |--------------------------------------------------------------------------
            | STORE PAYMENT PROOF
            |--------------------------------------------------------------------------
            */

            $paymentProof = null;


            if ($request->hasFile('payment_proof')) {

                $paymentProof =
                    $request
                        ->file('payment_proof')
                        ->store(
                            'payment-proofs',
                            'public'
                        );
            }


            /*
            |--------------------------------------------------------------------------
            | CREATE SALE
            |--------------------------------------------------------------------------
            */

            $sale = DB::transaction(function () use (
                $validated,
                $paymentProof
            ) {

                $subtotal = 0;

                $items = [];


                /*
                |--------------------------------------------------------------------------
                | CHECK PRODUCTS AND STOCK
                |--------------------------------------------------------------------------
                */

                foreach (
                    $validated['items']
                    as $cartItem
                ) {

                    $product =
                        Product::lockForUpdate()
                            ->find(
                                $cartItem['product_id']
                            );


                    if (!$product) {

                        throw new \Exception(
                            'One of the selected products no longer exists.'
                        );
                    }


                    $quantity =
                        (int) $cartItem['quantity'];


                    if (
                        $product->stock <
                        $quantity
                    ) {

                        throw new \Exception(
                            "Not enough stock for {$product->name}."
                        );
                    }


                    $price =
                        (float) $product->price;


                    $itemSubtotal =
                        $price * $quantity;


                    $subtotal +=
                        $itemSubtotal;


                    $items[] = [

                        'product' =>
                            $product,

                        'quantity' =>
                            $quantity,

                        'price' =>
                            $price,

                        'subtotal' =>
                            $itemSubtotal,

                    ];
                }


                /*
                |--------------------------------------------------------------------------
                | CALCULATE TOTALS
                |--------------------------------------------------------------------------
                */

                $discount = 0;

                $tax =
                    $subtotal * 0.12;

                $total =
                    $subtotal +
                    $tax -
                    $discount;


                /*
                |--------------------------------------------------------------------------
                | GENERATE INVOICE NUMBER
                |--------------------------------------------------------------------------
                */

                do {

                    $invoiceNumber =
                        'INV-' .
                        now()->format('YmdHis') .
                        '-' .
                        strtoupper(
                            Str::random(4)
                        );

                } while (
                    Sale::where(
                        'invoice_number',
                        $invoiceNumber
                    )->exists()
                );


                /*
                |--------------------------------------------------------------------------
                | CREATE SALE
                |--------------------------------------------------------------------------
                */

                $sale = Sale::create([

                    'customer_id' =>
                        null,

                    'invoice_number' =>
                        $invoiceNumber,

                    'payment_method' =>
                        $validated['payment_method'],

                    'payment_reference' =>
                        $validated['payment_reference']
                        ?? null,

                    'payment_proof' =>
                        $paymentProof,

                    'status' =>
                        'completed',

                    'subtotal' =>
                        $subtotal,

                    'discount' =>
                        $discount,

                    'tax' =>
                        $tax,

                    'total' =>
                        $total,

                    'paid' =>
                        $total,

                    'change' =>
                        0,

                ]);


                /*
                |--------------------------------------------------------------------------
                | CREATE SALE ITEMS
                |--------------------------------------------------------------------------
                */

                foreach (
                    $items
                    as $item
                ) {

                    $sale->items()->create([

                        'product_id' =>
                            $item['product']->id,

                        'product_name' =>
                            $item['product']->name,

                        'quantity' =>
                            $item['quantity'],

                        'price' =>
                            $item['price'],

                        'subtotal' =>
                            $item['subtotal'],

                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | REDUCE STOCK
                    |--------------------------------------------------------------------------
                    */

                    $item['product']->decrement(
                        'stock',
                        $item['quantity']
                    );
                }


                return $sale;
            });


            /*
            |--------------------------------------------------------------------------
            | LOAD ITEMS
            |--------------------------------------------------------------------------
            */

            $sale->load('items');


            /*
            |--------------------------------------------------------------------------
            | RETURN INVOICE DATA
            |--------------------------------------------------------------------------
            */

            return response()->json([

                'success' =>
                    true,

                'message' =>
                    'Sale completed successfully.',

                'invoice_number' =>
                    $sale->invoice_number,

                'sale_id' =>
                    $sale->id,

                'date' =>
                    $sale->created_at
                        ->format(
                            'F d, Y h:i A'
                        ),

                'payment_method' =>
                    $sale->payment_method,

                'payment_reference' =>
                    $sale->payment_reference,

                'payment_proof' =>
                    $sale->payment_proof
                        ? Storage::url(
                            $sale->payment_proof
                        )
                        : null,

                'items' =>
                    $sale->items
                        ->map(function ($item) {

                            return [

                                'product_name' =>
                                    $item->product_name,

                                'quantity' =>
                                    $item->quantity,

                                'price' =>
                                    (float)
                                    $item->price,

                                'subtotal' =>
                                    (float)
                                    $item->subtotal,

                            ];

                        })
                        ->values(),

                'subtotal' =>
                    (float)
                    $sale->subtotal,

                'tax' =>
                    (float)
                    $sale->tax,

                'total' =>
                    (float)
                    $sale->total,

            ]);


        } catch (\Exception $e) {

            /*
            |--------------------------------------------------------------------------
            | DELETE UPLOADED PROOF IF TRANSACTION FAILED
            |--------------------------------------------------------------------------
            */

            if (
                isset($paymentProof) &&
                $paymentProof
            ) {

                Storage::disk('public')
                    ->delete(
                        $paymentProof
                    );
            }


            return response()->json([

                'success' =>
                    false,

                'message' =>
                    $e->getMessage(),

            ], 422);
        }
    }
}