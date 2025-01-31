<?php

use App\Http\Controllers\AdminCartController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function () {
    return response()->json(auth()->user());
});


//public routes
Route::resource('/product', ProductController::class)->only([
    'index', 'show' // allowing only viewing the products
]);
Route::resource('/cart', CartController::class);

//authorisation
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//authenticated routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

//admin routes
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::resource('product', AdminProductController::class)->only([
        'store', 'update', 'destroy'
    ]);
    Route::resource('cart', AdminCartController::class)->only([
        'index','destroy'
    ]);
});
