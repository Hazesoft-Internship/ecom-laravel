<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionUserController extends Controller
{
    public function store()
    {
        $attribute = request()->validate([
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);

        if (!Auth::attempt($attribute)) {
            throw ValidationException::withMessages([
                "email" => "The username or password you entered is incorrect."
            ]);
        }
        request()->session()->regenerate();
        return redirect("/");
    }

    public function destroy()
    {
        Auth::logout();
        return redirect("/");
    }
}
