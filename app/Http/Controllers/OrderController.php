<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //form reuse
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $order = $this->orderService->show();
        $totalprice = $order['total_price'];
        $paymentmethods = $order['payment_methods'];
        $orderItems = $order['cartItems'];

        // dd($totalprice, $paymentmethods);
        return view('product.order', compact('totalprice', 'paymentmethods', 'orderItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $validated = $request->validated();
        $this->orderService->create($validated);
        return view('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
