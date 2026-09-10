<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [

        'customer_id',

        'invoice_number',

        'payment_method',

        'payment_reference',

        'payment_proof',

        'status',

        'subtotal',

        'discount',

        'tax',

        'total',

        'paid',

        'change',

    ];


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER
    |--------------------------------------------------------------------------
    */

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    /*
    |--------------------------------------------------------------------------
    | SALE ITEMS
    |--------------------------------------------------------------------------
    */

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}