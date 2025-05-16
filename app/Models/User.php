<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticable
{
    use HasFactory, HasApiTokens;
    
    protected $fillable = ["fullName", "email", "password"];

    public function checkLogin(array $userData) {}

    public function product()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

    public function cart()
    {
        return $this->hasOne(\App\Models\Cart::class);
    }
}
