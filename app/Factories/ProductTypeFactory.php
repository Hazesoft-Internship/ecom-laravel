<?php

namespace App\Factories;

use App\Models\DigitalProduct;
use App\Models\PhysicalProduct;

class ProductTypeFactory
{
    public static function resolve($cart)
    {
        $type = $cart->product["type"];
        return match ($type) {
            "digital" => new DigitalProduct($cart->product["price"], $cart["quantity"]),
            "physical" => new PhysicalProduct($cart->product["price"], $cart["quantity"]),
        };
    }
}
