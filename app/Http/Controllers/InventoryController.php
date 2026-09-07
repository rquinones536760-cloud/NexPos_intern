<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('sku', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalProducts = Product::count();

        $totalStock = Product::sum('stock');

        $lowStock = Product::where('stock', '>', 0)
            ->where('stock', '<=', 10)
            ->count();

        $outOfStock = Product::where('stock', 0)->count();

        return view('inventory.index', compact(
            'products',
            'totalProducts',
            'totalStock',
            'lowStock',
            'outOfStock'
        ));
    }

    public function updateStock(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $product->update([
            'stock' => $request->quantity,
        ]);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Stock updated successfully.');
    }
}