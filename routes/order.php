<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Order\OrderController as OrderOrderController;
use App\Http\Controllers\Product\CheckoutController;
use App\Http\Middleware\EnsureAccountIsActive;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', EnsureAccountIsActive::class])
    ->group(function () {

        Route::controller(CheckoutController::class)
            ->prefix('/orders')
            ->name('orders.')
            ->group(function () {
                Route::get('/', 'orders')->name('index');
                Route::post('/payment', 'payment')->name('payment');
                Route::post('/payment/submit', 'submitPayment')->name('payment.submit');
                Route::get('/{order}/confirmation', 'confirmation')->name('confirmation');
                Route::get('/{order}/bill', 'bill')->name('bill');
            });

        Route::middleware(['admin'])
            ->controller(OrderController::class)
            ->prefix('/admin')
            ->name('admin.')
            ->group(function () {
                Route::get('/orders', 'index')->name('orders.index');
                Route::put('/orders/{order}/status', 'updateStatus')->name('orders.status');
            });
    });

Route::post('/products/{product:slug}/order', [OrderOrderController::class, 'store'])->middleware(['auth', EnsureAccountIsActive::class])->name('products.order.store');
