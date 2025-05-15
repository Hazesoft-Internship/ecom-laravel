<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [

        'cart_id',
        'address',
        'status',
        'paymenttype',
        'tax',
        'total'
    ];


    protected $casts = [
        //
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
