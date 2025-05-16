<?php

namespace App\Services;

interface PaymentMethod
{
    public function getPaymentType(): array;
    public function calculate(int $productQuantity, int $total): int;
}
