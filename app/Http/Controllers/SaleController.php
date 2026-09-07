<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sales = Sale::with('customer')
            ->when($request->search, function ($query, $search) {
                $query->where('invoice_no', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('sales.index', compact('sales'));
    }

    public function show(Sale $sale)
    {
        $sale->load([
            'customer',
            'items.product'
        ]);

        return view('sales.show', compact('sale'));
    }
}