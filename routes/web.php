<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// redirect to login page if not authenticated
Route::get('/', function () {
    return Auth::check() ? redirect()->route('products.index') : redirect()->route('login');
});

// authentication routes (login, register, etc.)
Auth::routes();

// middleware
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);  // All product-related routes
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
