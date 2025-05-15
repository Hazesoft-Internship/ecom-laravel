<?php

namespace App\Services;

use App\Factories\Productfactory;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    private int $cartId;
    private int $userId;
    private  $cartItems;

    public function __construct()
    {
        $this->userId = Auth::id();

        $this->cartId = Auth::user()->cart->id;
        $this->cartItems = Auth::user()->cart->cartItems;
    }

    public function create($orders)
    {
        $product = new ProductService();
        $orderItems = CartItems::with('product')->where('cart_id', $this->cartId)->get();

        $order = $this->show();
        $totalprice = $order['total_price'];

        $order = Order::create([

            'cart_id' => $this->cartId,
            'address' => $orders['address'],
            'status' => 'pending',
            'paymenttype' => $orders['payment_method'],
            "tax" => 0,
            'total' => $totalprice
        ]);

        foreach ($orderItems as $item) {

            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'unitprice' => $item->product->price
                
            ]);
            $product->decreaseproduct( $item->product_id,$item->quantity);
        }
        CartItems::where('cart_id', $this->cartId)->delete();
    }


    public function show(): array
    {

        $totalPrice = 0;
        $paymentMethods = [];
        $productTypes = [];

        foreach ($this->cartItems as $item) {
            $productModel = Product::findOrFail($item->product_id);

            $productData = [
                'price' => $productModel->price,
                'quantity' => $item->quantity,
                'types' => $productModel->types,

            ];

            $product = ProductFactory::createProduct($productData);

            $totalPrice += $product->getDiscountedPrice();
            $paymentMethods = array_merge($paymentMethods, $product->getPaymentMethod());
            $productTypes = array_merge($productTypes, $product->getProductTypes());
        }

        // dd($productData['subtotal']);
        $paymentMethods = array_unique($paymentMethods);
        $productTypes = array_unique($productTypes);

        $productTypesCollection = collect($productTypes);

        // dd($productTypesCollection);
        if ($productTypesCollection->contains('Physical') && $productTypesCollection->contains('Digital')) {
            $paymentMethods = collect($paymentMethods)->reject(fn($method) => $method === 'COD')->values()->all();
        }


        return [
            'total_price' => $totalPrice,
            'payment_methods' => $paymentMethods,
            'cartItems' => $this->cartItems

        ];
    }

    public function delete(string $id): void {}
}
