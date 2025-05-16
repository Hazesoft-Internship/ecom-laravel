<?php

namespace App\Services;

use App\Services\PaymentMethod;

class PhysicalProduct implements PaymentMethod
{
    public function getPaymentType(): array
    {
        return ["COD", "ESewa"];
    }

    public function calculate(int $productQuantity, int $total): int
    {
        if ($productQuantity >= 10) return $total + 200;
        elseif ($productQuantity >= 5) return $total + 100;
        else return $total;
    }
}
