<?php

namespace App\Services;

use App\Factories\ProductTypeFactory;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartService
{
    public function addOrUpdateCartItem($cartId, $productId)
    {
        $cartItems = CartItem::firstOrNew([
            'cart_id' => $cartId,
            'product_id' => $productId
        ]);
        if ($cartItems->exists()) {
            if ($cartItems->quantity <= $cartItems->product->quantity) {

                $cartItems->quantity += 1;
            } else {
                throw ValidationException::withMessages([
                    "quantity" => "not enough stock"
                ]);
            }
        } else {
            $cartItems->quantity = 1;
        }
        $cartItems->save();
        return $cartItems;
    }

    public function getCartId()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        return $cart["id"];
    }

    public function getAllCartItems()
    {
        $cartId = $this->getCartId();
        $cartItems = CartItem::with('product')
            ->where('cart_id', $cartId)
            ->get();
        return $cartItems;
    }

    public function totalCartPrice()
    {
        return CartItem::with('product')
            ->where('cart_id', $this->getCartId())
            ->get()
            ->reduce(function ($initial, $current) {
                $product = ProductTypeFactory::resolve($current);
                $orderPrice = $product->calculateProductPrice();
                return $initial + ($orderPrice * $current->quantity);
            }, 0);
    }

    public function getCartItems()
    {
        $cartItems = CartItem::with('product')
            ->whereHas('cart', function ($query) {
                $query->where('user_id', Auth::id());
            })->get();
        return $cartItems;
    }
}
