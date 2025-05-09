<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdersRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartPricingService;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartId = Cart::where('user_id', Auth::id())->first()->id;
        $orderId = Order::where('cart_id', $cartId)->first()->id;
        $orderItems = OrderItem::with('product')->with('order')->where('order_id', $orderId)->get();
        return view('orderDetail', compact('orderItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrdersRequest $request)
    {
        $cartId = Cart::where('user_id', Auth::id())->first()->id;
        $cart_items = CartItem::with('product')->where('cart_id', $cartId)->get();
        $pricing = CartPricingService::calculate($cart_items->toArray());

        $cart_items = $pricing['cartItems'];
        $status = 'Pending';

        $attributes = $request->validated();

        $attributes['cart_id'] = $cartId;
        $attributes['status'] = $status;
        $attributes['total'] = $pricing['grandTotal'];

        $order = Order::create($attributes);
        $orderId = $order->id;
        OrderItemController::store($orderId,$cart_items);
        CartItem::where('cart_id', $cartId)->delete();
        return redirect('/home');
    }
}
