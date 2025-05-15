<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class ProductController
{
    public function __construct(private ProductService $productService) {}


    public function index(): View
    {
        $products = $this->productService->showallproduct();
        return View('product.viewproduct', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return View('product.createproduct');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->productService->create($validated);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(): View
    {
        $products = $this->productService->showmyproduct();
        return View('product.myproducts', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        //todo form reuse
        $product = $this->productService->findByIdOrFail($id);
        return view('product.editproduct', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request): RedirectResponse
    {        
        $validated = $request->validated();
        // $this->productService->update($validated);
        $this->productService->update($validated['product_id'], $validated);
        return redirect()->route('product.myproduct');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->productService->delete($id);
        return redirect()->route('product.myproduct');
    }
}
