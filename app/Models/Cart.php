<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ["user_id"];

    public function user()
    {
        return $this->hasOne(\App\Models\User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(\App\Models\CartItems::class);
    }

    public function product()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

    public function order()
    {
        return $this->hasMany(\App\Models\Order::class);
    }
}
