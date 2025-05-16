<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            return view('cart.cart', ['cartItems' => []]);
        }

        $cartItems = CartItems::where('cart_id', $cart->id)->with('product')->get();

        return view('cart.cart', ['cartItems' => $cartItems->toArray()]);
    }

    public function storeCart(int $userID): bool
    {
        $cart = Cart::firstOrCreate(["user_id" => $userID]);

        if (!$cart) {
            return false;
        }
        return true;
    }

    public function store(Request $request, int $id): RedirectResponse
    {
        $userID = Auth::id();

        $this->storeCart($userID);

        $cart = Cart::where('user_id', $userID)->first();
        $cart_id = $cart->id;

        $cartItem = CartItems::where('cart_id', $cart_id)
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += (int)$request->quantity;
            $cartItem->save();
        } else {
            CartItems::create([
                "cart_id" => $cart_id,
                "product_id" => $id,
                "quantity" => (int)$request->quantity
            ]);
        }

        return redirect('/mycart')->with('Success', 'Item added to cart successfully');
    }

    public function destroy(string $id): RedirectResponse
    {
        CartItems::destroy($id);
        return redirect('/mycart');
    }
}
