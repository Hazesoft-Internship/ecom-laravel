<?php

namespace App\Models;


class Digitalproduct implements ProductInterface
{

    private $quantity;
    private $price;
    private $totalprice = 0;
    public function __construct(public $product)
    {

        $this->quantity = $product['quantity'];
        $this->price = $product['price'];
        $this->totalprice = $this->price * $this->quantity;
    }


    public  function  getPaymentMethod(): array
    {
        return ["Khalti"];
    }

    public  function getDiscountedPrice(): int
    {
        if ($this->quantity >= 6 && $this->quantity < 12) {

            $this->totalprice -= $this->totalprice * 10 / 100;

            return $this->totalprice;
        }
        if ($this->quantity >= 12) {
            $this->totalprice -= $this->totalprice * 20 / 100;
            return $this->totalprice;
        } else {
            return $this->totalprice;
        }
    }
    public  function getProductTypes(): array
    {
        return ["Digital"];
    }
}
