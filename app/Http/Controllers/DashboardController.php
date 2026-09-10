<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | RECENT PRODUCTS
        |--------------------------------------------------------------------------
        */

        $products = Product::latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | INVENTORY STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();


        $lowStockProducts = Product::where(
            'stock',
            '>',
            0
        )
        ->whereColumn(
            'stock',
            '<=',
            'low_stock_limit'
        )
        ->count();


        $outOfStockProducts = Product::where(
            'stock',
            0
        )->count();


        /*
        |--------------------------------------------------------------------------
        | TODAY'S SALES
        |--------------------------------------------------------------------------
        */

        $todaySales = Sale::whereDate(
            'created_at',
            today()
        )
        ->where(
            'status',
            'completed'
        )
        ->sum('total');


        /*
        |--------------------------------------------------------------------------
        | TODAY'S TRANSACTIONS
        |--------------------------------------------------------------------------
        */

        $todayTransactions = Sale::whereDate(
            'created_at',
            today()
        )
        ->where(
            'status',
            'completed'
        )
        ->count();


        return view(
            'dashboard.index',
            compact(
                'products',
                'totalProducts',
                'lowStockProducts',
                'outOfStockProducts',
                'todaySales',
                'todayTransactions'
            )
        );
    }
}