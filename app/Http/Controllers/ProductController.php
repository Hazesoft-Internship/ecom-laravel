<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::where('user_id', '!=', Auth::id())->latest()->get();
        return view("product.index", ['products' => $products]);
    }

    public function myProduct()
    {
        // $products = Product::where('user_id', Auth::id())->latest()->get();
        $products = Auth::user()->product()->latest()->get();
        return view("product.myProduct", ['products' => $products]);
    }

    public function create()
    {
        $attributes =  request()->validate([
            "name" => ['required'],
            "quantity" => ['required', 'integer', 'min:0'],
            "price" => ['required', 'numeric', 'min:1'],
        ]);
        $attributes["user_id"] = Auth::id();
        Product::create($attributes);
        return redirect("/product");
    }

    public function show(Product $product)
    {
        return view("product.show", ['product' => $product]);
    }

    public function edit(Product $product)
    {
        return view("product.edit", ['product' => $product]);
    }

    public function update(Product $product)
    {
        $attributes = request()->validate([
            "name" => ['required'],
            "quantity" => ['required', 'integer', 'min:0'],
            "price" => ['required', 'numeric', 'min:1'],
        ]);
        $product->update($attributes);
        return redirect("/product/$product->id");
    }

    public function findOne($id)
    {
        return Product::find($id);
    }
}
