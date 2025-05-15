<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartService
{
    private int $cartId;
    private int $userId;

    public function __construct()
    {
        $this->userId = Auth::id();

        $user = User::with('cart')->findOrFail($this->userId); // eager load cart
        $this->cartId = $user->cart->id;
    }

    /**
     * Add product to cart
     */
    public function create(string $productId, int $quantity = 1): void
    {
        $cartItem = CartItems::where('cart_id', $this->cartId)
            ->where('product_id', $productId)
            ->first();
        // dd($cartItem);
        if ($cartItem) {

            $cartItem->increment('quantity', $quantity);
        } else {
            CartItems::create([
                'cart_id' => $this->cartId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
    }


    /**
     * Get all products in the cart with cart item data
     */
    public function show(): mixed
    {
        $cart = Cart::with('cartItems.product')->findOrFail($this->cartId);
        // $subtotal = $cart->subtotal;

        $cartItems = $cart->cartItems->map(function ($item) {
            return [
                'product' => $item->product,
                'cart_item_id' => $item->id,
                'quantity' => $item->quantity,
                'subtotal' => $item->quantity * $item->product->price,

            ];
        });

        return $cartItems;
    }

    /**
     * Find a specific cart item
     */
    public function findByIdOrFail(string $id): CartItems
    {
        return CartItems::findOrFail($id);
    }
    public function update(int $id, array $data): CartItems
    {
        $product = CartItems::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete(string $id): void
    {
        CartItems::destroy($id);
    }
    
}
