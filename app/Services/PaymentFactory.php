<?php

namespace App\Services;

use Exception;

class PaymentFactory
{
    public static function getInstance(string $type): object
    {
        $product = require __DIR__ . '/../../config/paymentmethods.php';
        if (!array_key_exists($type, $product)) {
            throw new Exception("Unknown payment type");
        }

        return new $product[$type];
    }
}
