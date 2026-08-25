<?php

use App\Http\Controllers\Product\CartController;
use App\Http\Controllers\Product\CheckoutController;
use App\Http\Middleware\EnsureAccountIsActive;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', EnsureAccountIsActive::class])
    ->group(function () {
        Route::get('/cart/review', [CheckoutController::class, 'review'])->name('cart.review');
        Route::post('/cart/submit', [CheckoutController::class, 'submit'])->name('cart.submit');
    });

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::put('/cart/{product:slug}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product:slug}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
