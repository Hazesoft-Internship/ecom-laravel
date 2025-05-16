<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{

    public function register(RegisterRequest $request): RedirectResponse
    {
        try {
            $userData = [
                'fullName' => $request->fullName,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];

            $user = User::create($userData);

            Auth::login($user);

            return redirect('/allproducts')->with("Success", "Registration successful");
        } catch (Exception $e) {
            return redirect('/login')->with("Failed", "Registration failed");
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = ["email" => $request->email, "password" => $request->password];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/allproducts');
            }
        } catch (Exception $e) {
            return redirect('/login') - with('Error', "Failed to login");
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('Success', 'You have been logged out');
    }

    public function showLoginPage(): View
    {
        return view('auth.login');
    }

    public function showSignupPage(): View
    {
        return view('auth.signup');
    }

}
