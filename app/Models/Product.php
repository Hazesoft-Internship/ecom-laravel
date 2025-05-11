<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'user_id'
    ];

    protected $casts = [
        'price' => 'float'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItem()
    {
        return $this->hasMany(CartItem::class);
    }
}
