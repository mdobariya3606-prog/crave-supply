<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Product\CheckoutController;
use App\Http\Middleware\EnsureAccountIsActive;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', EnsureAccountIsActive::class])
    ->group(function () {
        Route::get('/orders', [CheckoutController::class, 'orders'])->name('orders.index');
        Route::get('/orders/{order}/confirmation', [CheckoutController::class, 'confirmation'])->name('orders.confirmation');
        Route::get('/orders/{order}/bill', [CheckoutController::class, 'bill'])->name('orders.bill');

        Route::middleware(['admin'])->group(function () {
            Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
            Route::put('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');
        });
    });
