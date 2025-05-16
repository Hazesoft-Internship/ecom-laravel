<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [
    function () {
        return view('Dashboard');
    }
]);

Route::middleware("auth")->group(function () {
    Route::get('/allproducts', [ProductController::class, 'index']);
    Route::get('/myproducts', [ProductController::class, 'myProducts']);
    Route::get('/addproduct', [ProductController::class, 'create']);
    Route::get('/updateproduct/{id}', [ProductController::class, 'edit']);
    Route::get('/mycart', [CartController::class, 'index']);
    Route::get('/checkout', [OrderController::class, 'index']);
    Route::get('/orderHistory',[OrderController::class,'showOrderHistory']);

    Route::post('/addproduct-submit', [ProductController::class, 'store'])->name('addproduct-submit');
    Route::post('/updateproduct-submit/{id}', [ProductController::class, 'update'])->name('updateproduct-submit');
    Route::post('/deleteproduct-submit/{id}', [ProductController::class, 'destroy'])->name('deleteproduct-submit');
    Route::post('/addtocart-submit/{id}', [CartController::class, 'store'])->name('addtocart-submit');
    Route::post('/deletecartitem-submit/{id}', [CartController::class, 'destroy'])->name('deletecartitem-submit');
    Route::post('/addorder-submit/{id}', [OrderController::class, 'store'])->name('addorder-submit');
});

Route::get('/login', [UserController::class, 'showLoginPage'])->name('login');
Route::get('/signup', [UserController::class, 'showSignupPage']);
Route::get('/logout', [UserController::class, 'logout']);

Route::post('/login-submit', [UserController::class, 'login'])->name('login-submit');
Route::post('/signup-submit', [UserController::class, 'register'])->name('signup-submit');
