<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    protected $cartService;
    public function  __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function findOrCreateCart()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id()
        ]);
        return $cart;
    }

    public function create(Product $product)
    {
        $cart = $this->findOrCreateCart();
        $cartItems = $this->cartService->addOrUpdateCartItem($cart->id, $product->id);
        if ($cartItems) {
            return redirect("/cart");
        }
    }

    public function update()
    {
        $quantitess = request()->quantities;
        foreach ($quantitess as $id => $quantity) {
            $cartItem = CartItem::where('id', $id)->where('cart_id', Auth::user()->cart->id)->first();
            if ($cartItem->product->quantity >= $cartItem->quantity) {
                $cartItem->update([
                    'quantity' => $quantity
                ]);
            } else {
                throw ValidationException::withMessages([
                    "quantity" => "not enough stock"
                ]);
            };
        }
        return redirect("/order/create");
    }
}
