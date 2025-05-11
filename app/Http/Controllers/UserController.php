<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function create()
    {
        $attribute = request()->validate([
            "first_name" => ['required'],
            "last_name" => ['required'],
            "email" => ['required', 'email'],
            "password" => ['required', Password::min(5),'confirmed'],
        ]);

        $user = User::create($attribute);
        Auth::login($user);
        return redirect("/");

    }
}
