<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cartService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cartItems = $this->cartService->show();
        // dd($cartItems);
        return view('product.cart', compact('cartItems'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id)
    {
        $this->cartService->create($id);

        // return redirect()->route('dashboard');
        return back();
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
        $cartItem = $this->cartService->findByIdOrFail($id);
        return view('product.editcart', compact('cartItem'));
        //todo form reuse

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->toArray();
        $this->cartService->update($id, $validated);
        return redirect()->route('cart.show');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cartService->delete($id);
        return redirect()->route('cart.show');
    }
}
