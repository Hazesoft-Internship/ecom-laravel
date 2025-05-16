<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;

    protected $fillable = ["cart_id", "product_id", "quantity"];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function cart()
    {
        return $this->belongsTo(\App\Models\Cart::class);
    }

    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }
}
