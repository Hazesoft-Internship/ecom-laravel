<?php

// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\SessionController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\ViewController;
// use App\Models\Product;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', function () {
//     return view('home');
// });
// Route::get('/user',  [UserController::class, 'index']);

// Route::get('/signup', [UserController::class, 'create']);
// Route::post('/signup', [UserController::class, 'store']);
// Route::get("/dashboard", [UserController::class, 'dashboard'])->name('dashboard');

// Route::get('/login', [SessionController::class, 'create']);
// Route::post('/login', [SessionController::class, 'store'])->name('login');
// Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

// //todo use resource
// //todo aUthorize route
// //
// Route::prefix('product')->group(function (): void {

//     Route::get("/add", [ProductController::class, 'create']);
//     Route::post("/add", [ProductController::class, 'store']);

//     Route::get("/show", [ProductController::class, 'index'])->name('showallproducts');
//     Route::get("/show/myproduct", [ProductController::class, 'show']);

//     Route::get("/update/{id}", [ProductController::class, 'edit']);
//     Route::post("/update", [ProductController::class, 'update']);

//     Route::post("/delete/{id}", [ProductController::class, 'destroy']);
// });

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::view('/', 'welcome');
Route::view('/home', 'home');

// User Registration
Route::get('/signup', [UserController::class, 'create'])->name('signup');
Route::post('/signup', [UserController::class, 'store'])->name('signup.store');

// Authentication
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::prefix('product')->name('product.')->group(function () {


        Route::get('/add', [ProductController::class, 'create'])->name('create');
        Route::post('/add', [ProductController::class, 'store'])->name('store');


        Route::get('/show', [ProductController::class, 'index'])->name('all');


        Route::get('/show/myproduct', [ProductController::class, 'show'])->name('myproduct');


        Route::get('/update/{product}', [ProductController::class, 'edit'])->name('edit');


        Route::post('/update', [ProductController::class, 'update'])->name('update');

        Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
    });
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/show', [CartController::class, 'index'])->name('show');
        Route::post('/add/{id}', [CartController::class, 'store'])->name('store');
        Route::get('/update/{id}', [CartController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CartController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [CartController::class, 'destroy'])->name('delete');
    });
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');
    Route::post('/order', [OrderController::class, 'store'])->name('order');
});
