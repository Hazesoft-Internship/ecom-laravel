<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartItemsController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartItems = $this->cartService->getCartItems();
        return view("cart.index", ['cartItems' => $cartItems]);
    }

    public function delete(CartItem $cartItem)
    {
        $order = CartItem::find($cartItem->id);
        $order->delete();
        return redirect("/cart");
    }
}
