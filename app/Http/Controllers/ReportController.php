<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;

class ReportController extends Controller
{
    public function index()
    {
        $totalSales = Sale::sum('total');

        $totalTransactions = Sale::count();

        $totalProducts = Product::count();

        $totalStock = Product::sum('stock');

        $todaySales = Sale::whereDate('created_at', today())
            ->sum('total');

        $todayTransactions = Sale::whereDate('created_at', today())
            ->count();

        $monthlySales = Sale::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        $averageSale = $totalTransactions > 0
            ? $totalSales / $totalTransactions
            : 0;

        $recentSales = Sale::with('customer')
            ->latest()
            ->take(10)
            ->get();

        return view('reports.index', compact(
            'totalSales',
            'totalTransactions',
            'totalProducts',
            'totalStock',
            'todaySales',
            'todayTransactions',
            'monthlySales',
            'averageSale',
            'recentSales'
        ));
    }
}