<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class ProductController extends Controller
{
    public function index(): View
    {
        $allProducts = Product::where('user_id', '!=', Auth::id())->get();
        return view('product.allproduct', ["products" => $allProducts]);
    }

    public function create(): View
    {
        return view('product.addproduct');
    }

    public function edit(Request $request, string $id): View
    {
        $myProduct = Product::find($id);
        return view('product.updateproduct', ["product" => $myProduct]);
    }

    public function destroy(string $id): RedirectResponse
    {
        Product::destroy($id);
        return redirect('/myproducts');
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        try {

            $product = $request->validated();
            $product['user_id'] = Auth::id();

            Product::create($product);

            return redirect('/allproducts')->with('Success', 'Product added successfully');
        } catch (\Exception $e) {
            return redirect('/')->with('Failed', 'Fail to add product');
        }
    }

    public function update(ProductRequest $request, string $id): RedirectResponse
    {
        try {
            $product = Product::findorFail($id);
            $product->update($request->validated());

            return redirect('/myproducts')->with('Success', 'Product updation successful');
        } catch (\Exception $e) {
            return redirect('/')->with('Failed', 'Fail to update product');
        }
    }

    public function myProducts(): View
    {
        $myProducts = Product::where('user_id', '=', Auth::id())->get();
        return view('product.myproduct', ["products" => $myProducts]);
    }
}
