<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalProduct extends Model
{
    /** @use HasFactory<\Database\Factories\PhysicalProductFactory> */
    use HasFactory;
    protected $price;
    protected $quantity;
    public function __construct($price, $quantity)
    {
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function calculateProductPrice()
    {
        if ($this->quantity >= 10) {
            return $this->price + 200;
        } elseif ($this->quantity >= 5) {
            return $this->price + 100;
        } else {
            return $this->price;
        }
    }

    public function paymentMethod()
    {
        return ["COD", "Esewa"];
    }
}
