<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;

class OrderItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public static function store($orderId, $cart_items)
    {
        foreach ($cart_items as $cartItem) {

            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'price' => $cartItem['product']['price'],
                'total_price' => $cartItem['total'],
            ]);

            $product = Product::find($cartItem['product_id']);

            if ($product) {
                $product->stock -= $cartItem['quantity'];
                $product->save();
            }
        }
    }
}
