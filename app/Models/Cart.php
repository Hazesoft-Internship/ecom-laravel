<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';

    protected $fillable = [
        'user_id'
    ];


    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    // public function getSubtotal()
    // {
    //     return $this->cartItems->sum(fn($item) => $item->quantity * $item->product->price);
    // }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItems::class);
    }
}
