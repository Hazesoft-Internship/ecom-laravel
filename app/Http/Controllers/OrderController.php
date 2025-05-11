<?php

namespace App\Http\Controllers;

use App\Factories\ProductTypeFactory;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    //
    public function create()
    {
        $address = request("address");
        $paymentMethod = request()->input("paymentMethod");
        $totalPrice = $this->cartService->totalCartPrice();
        $validated = request()->validate([
            "address" => ['required', 'string'],
            "paymentMethod" => ['in:COD,Esewa,Khalti']
        ]);

        $order = Order::create([
            'cart_id' => $this->cartService->getCartId(),
            'address' => $validated["address"],
            'status' => "pending",
            'payment_type' => $validated["paymentMethod"],
            'total' => $totalPrice
        ]);
        $this->createOrderItem($order->id);
    }

    public function paymentMethodOptions(): array
    {
        $cartItems = $this->cartService->getAllCartItems();
        $options = [];
        foreach ($cartItems as $cartItem) {
            $product = ProductTypeFactory::resolve($cartItem);
            $options = array_merge($options, $product->paymentMethod());
        }
        $paymentMethods = array_unique($options);
        $types = $cartItems->pluck('product.type')->unique()->toArray();
        if (in_array('digital', $types) && in_array('physical', $types)) {
            $paymentMethods = array_values(array_filter($paymentMethods, fn($method) => $method !== 'COD'));
        }
        return $paymentMethods;
    }

    public function show()
    {
        return view("order.create", ["paymentMethods" => $this->paymentMethodOptions()]);
    }

    public function createOrderItem($orderId)
    {
        $cartItems = $this->cartService->getCartItems();
        foreach ($cartItems as $cart) {
            $product = ProductTypeFactory::resolve($cart);
            $OrderProductPrice = $product->calculateProductPrice();
            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'unit_price' => $OrderProductPrice,
                'total_price' => $OrderProductPrice * $cart->quantity
            ]);
        }
    }
}
