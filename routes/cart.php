<?php

use App\Http\Controllers\Cart\DeleteCartController;
use App\Http\Controllers\Cart\UpdateCartController;
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
Route::put('/cart/{product:slug}', [UpdateCartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product:slug}', [DeleteCartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart', [DeleteCartController::class, 'clear'])->name('cart.clear');
