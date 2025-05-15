<?php

namespace App\Factories;

use App\Models\Digitalproduct;
use App\Models\PhysicalProduct;
use App\Models\ProductInterface;
use Exception;

class Productfactory{
     public static function createProduct($product): ProductInterface
    {
        // dd($product["types"]);
        return match ($product["types"]) {
            "physical" => new PhysicalProduct($product),
            "digital" => new Digitalproduct($product),
            default => throw new Exception("Product type  not found"),
        };
    }
}