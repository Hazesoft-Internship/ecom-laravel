<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ["user_id", "name", "price", "quantity", "type"];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function cartItem()
    {
        return $this->hasMany(\App\Models\CartItems::class);
    }
    public function orderItem()
    {
        return $this->hasOne(\App\Models\OrderItems::class);
    }
}
