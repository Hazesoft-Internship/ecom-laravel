<?php

namespace App\Services;

use App\Services\PaymentMethod;

class DigitalProduct implements PaymentMethod
{
    public function getPaymentType(): array
    {
        return ["Khalti"];
    }

    public function calculate(int $productQuantity, int $total): int
    {
        if ($productQuantity >= 12) return ($total - ($total * 20 / 100));
        elseif ($productQuantity >= 6) return ($total - ($total * 10 / 100));
        else return $total;
    }
}
