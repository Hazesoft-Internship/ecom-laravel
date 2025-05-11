<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionUserController;
use App\Http\Controllers\UserController;
use App\Models\CartItem;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::view("/", "home");
Route::view("/register", "auth.register");
Route::view("/login", "auth.login");
Route::post("/register", [UserController::class, "create"]);
Route::post("/login", [SessionUserController::class, "store"])->name('login');
Route::post("/logout", [SessionUserController::class, "destroy"]);

Route::view("/product/create", "product.create")->middleware('auth');
Route::get("/product", [ProductController::class, "index"]);
Route::get("/product/my-product", [ProductController::class, "myProduct"])->middleware('auth');
Route::get("/product/{product}/edit", [ProductController::class, "edit"])->middleware('auth')->can('edit-product', 'product');
Route::patch("/product/{product}", [ProductController::class, "update"])->middleware('auth');
Route::get("/product/{product}", [ProductController::class, "show"]);
Route::post("/product", [ProductController::class, "create"])->middleware('auth');

Route::get("/cart", [CartItemsController::class, "index"]);
Route::post("/cart/{product}", [CartController::class, "create"])->middleware('auth');
Route::patch("/cart/update", [CartController::class, "update"])->middleware('auth');

Route::get("/order/create", [OrderController::class, "show"]);
Route::post("/cart/delete/{cartItem}", [CartItemsController::class, "delete"]);
Route::post("/order/create", [OrderController::class, "create"]);
Route::get("/test", [OrderItemsController::class, "create"]);
