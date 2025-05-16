<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Order;
use App\Models\OrderItems;
use App\Services\PaymentFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Exception;

class OrderController extends Controller
{

    public function getPaymentType(array $products): array
    {
        try {
            $productTypes = array_unique(array_map(fn($item) => $item['product_type'], $products));
            $paymentType = [];

            foreach ($productTypes as $type) {
                $product = PaymentFactory::getInstance($type);
                $paymentType[] = $product->getPaymentType();
            }

            $paymentType = array_merge(...$paymentType);

            if (count($paymentType) > 2) {
                return array_filter($paymentType, fn($type) => $type != "COD");
            }
            return $paymentType;
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return [];
        }
    }

    public function calculateGrandTotal(array $products): int
    {
        try {
            $total = array_reduce($products, function ($carry, $item) {
                return $carry + ($item['product_price'] * $item['cart_quantity']);
            }, 0);

            $grandTotal = 0;
            foreach ($products as $item) {
                $product = PaymentFactory::getInstance($item['product_type']);
                $grandTotal = $product->calculate($item['cart_quantity'], $total);
            }
            return $grandTotal;
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return 0;
        }
    }

    public function getProduct(int $cart_id): array
    {
        try {
            $cart_items = CartItems::where('cart_id', '=', $cart_id)->with('product')->get();

            $products = $cart_items->map(function ($item) {
                return [
                    'product_id' => $item->product->id,
                    'product_name' => $item->product->name,
                    'product_price' => $item->product->price,
                    'product_type' => $item->product->type,
                    'cart_quantity' => $item->quantity,
                ];
            });

            return $products->toArray();
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return [];
        }
    }

    public function showCheckOrderPage(): array
    {
        try {
            $cart_id = Cart::where('user_id', '=', Auth::id())->value('id');

            $products = $this->getProduct($cart_id);

            $availablePaymentMethod = $this->getPaymentType($products);
            $grandTotal = $this->calculateGrandTotal($products);

            $tax = $grandTotal * 13 / 100;
            $grandTotal += $tax;

            return [
                "products" => $products,
                "grandTotal" => $grandTotal,
                "cart_id" => $cart_id,
                "availablePaymentMethod" => $availablePaymentMethod,
                "tax" => $tax
            ];
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return [];
        }
    }

    public function store(OrderRequest $request, int $id): RedirectResponse
    {
        try {
            $order = $request->validated();

            $products = $this->getProduct($id);
            $grandTotal = $this->calculateGrandTotal($products);

            $tax = $grandTotal * 13 / 100;
            $grandTotal += $tax;

            $order['cart_id'] = $id;
            $order['total'] = $grandTotal;
            $order['tax'] = $tax;

            $order = Order::create($order);
            $order_id = $order->toArray()['id'];

            foreach ($products as $product) {
                OrderItems::create([
                    'order_id' => $order_id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['cart_quantity'],
                    'totalPrice' => $grandTotal,
                ]);
            }

            CartItems::where('cart_id', $id)->delete();

            return redirect('/orderHistory');
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to place the order.']);
        }
    }

    public function index(): View
    {
        try {
            $cartItems = $this->showCheckOrderPage();
            return view('order.checkout', ["cartItems" => $cartItems]);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return view('error', ['message' => 'Failed to load the checkout page.']);
        }
    }

    public function showOrderHistory(): View
    {
        try {
            $cart_id = Cart::where('user_id', '=', Auth::id())->value('id');
            $orderHistory = Order::where('cart_id', '=', $cart_id)->get();
            return view('order.orderhistory', ['orderHistory' => $orderHistory->toArray()]);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return view('error', ['message' => 'Failed to load the order history.']);
        }
    }
}
