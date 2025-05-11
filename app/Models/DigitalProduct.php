<?php

namespace App\Models;

use App\Interfaces\Product\ProductInterface as ProductProductInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ProductInterface;

class DigitalProduct extends Model implements ProductProductInterface
{
    /** @use HasFactory<\Database\Factories\DigitalProductFactory> */
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
        $discount = 0;
        if ($this->quantity >= 12) {
            $discount = 0.2;
        } elseif ($this->quantity >= 6) {
            $discount = 0.1;
        }
        return $this->price - ($discount * $this->price);
    }

    public function paymentMethod()
    {
        return ["Khalti"];
    }
}
