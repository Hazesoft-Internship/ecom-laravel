<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

  interface ProductInterface 
{
   public function getProductTypes();
   public function getDiscountedPrice();
   public function getPaymentMethod();

}
