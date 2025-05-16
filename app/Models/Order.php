<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ["cart_id", "address", "status", "paymentType", "tax", "total"];

    public function cart()
    {
        return $this->belongsTo(\App\Models\Cart::class);
    }
    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItems::class);
    }

    public function cartItems()
    {
        return $this->hasMany(\App\Models\CartItems::class);
    }
}
