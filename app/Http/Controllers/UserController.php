<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController
{

    public function create(): View
    {
        return View('auth.signup');
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate((new UserRequest())->rules());
        $user= User::create($validated);
        $userId= $user->id;
        Cart::create(['user_id' => $userId]);
        return redirect('/login');
    }
    public function dashboard(): View
    {
        return View("dashboard");
    }
}
