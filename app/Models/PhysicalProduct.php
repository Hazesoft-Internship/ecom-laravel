<?php

namespace App\Models;

class PhysicalProduct implements ProductInterface
{

    private $price;
    private $quantity;
    private $totalprice = 0;
    public function __construct(public  $product)
    {
        // dd($product);
        $this->price = $product['price'];
        $this->quantity = $product['quantity'];
        $this->totalprice = $this->price * $this->quantity;
    }

    public function getPaymentMethod(): array
    {
        return ['COD','ESEWA'];
    }

    public function  getDiscountedPrice(): int
    {
        if ($this->quantity >= 5 && $this->quantity < 10) {
            $this->totalprice += 100;
        }
        if ($this->quantity >= 10) {
            $this->totalprice += 200;
        }
        
        return $this->totalprice;
    }

    public  function getProductTypes(): array
    {
        return ["Physical"];
    }
}
