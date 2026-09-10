<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'barcode',
        'price',
        'cost',
        'stock',
        'category',
        'unit',
        'low_stock_limit',
        'description',
        'status',
        'image',
    ];

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function isLowStock(): bool
    {
        $limit = $this->low_stock_limit ?? 10;

        return $this->stock > 0 && $this->stock <= $limit;
    }
}