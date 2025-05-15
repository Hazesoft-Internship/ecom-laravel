<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductService
{

    public function create(array $data): Product
    {
        $userId = Auth::id();
        $data['user_id'] = $userId;
        return Product::create($data);
    }

    public function showmyproduct(): Collection
    {
        // $products = Product::where('user_id', '=', Auth::id())->get();
        $products = Auth::user()->product;
        return $products;
    }
    public function showallproduct(): Collection
    {
        $products = Product::where('user_id', '!=', Auth::id())->get();
        return $products;
    }
    public function findByIdOrFail(string $id): Product
    {
        return Product::findOrFail($id);
    }

    public function update(int $id, array $data): Product
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function decreaseproduct($id, $quantity)
    {
        $product = Product::findOrFail($id);
        $product->decrement('quantity', $quantity);
        echo ("decreased id" . $id . "  " . $quantity);
    }
    public function delete(string $id): void
    {
        Product::destroy($id);
    }
}
