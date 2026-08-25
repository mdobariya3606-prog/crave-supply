<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Middleware\EnsureAccountIsActive;
use App\Http\Controllers\Product\CheckoutController;
use App\Models\Review;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', [
        'topReviews' => Review::query()
            ->where('is_approved', true)
            ->whereNotNull('comment')
            ->where('comment', '!=', '')
            ->with(['product', 'user'])
            ->orderByDesc('rating')
            ->latest()
            ->take(6)
            ->get(),
    ]);
})->name('home');

Route::get('/dashboard', fn () => redirect()->route('home'))->name('dashboard');

Route::get('/account-disabled', fn () => view('account-disabled'))->name('account.disabled');

Route::view('/about', 'about')->name('about');
Route::get('/contact', fn () => view('contact'))->name('contact');
Route::post('/contact', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'email', 'max:255'],
        'message' => ['required', 'string', 'max:2000'],
    ]);

    Mail::raw(
        "Name: {$validated['name']}\nEmail: {$validated['email']}\n\nMessage:\n{$validated['message']}",
        function ($mail) use ($validated) {
            $mail->to('booknest44@gmail.com')
                ->replyTo($validated['email'], $validated['name'])
                ->subject('New CraveSupply contact message');
        }
    );

    return back()->with('contact_success', 'Thanks for reaching out. Our team will get back to you shortly.');
})->name('contact.submit');

Route::middleware(['auth', EnsureAccountIsActive::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/cart/review', [CheckoutController::class, 'review'])->name('cart.review');
    Route::post('/cart/submit', [CheckoutController::class, 'submit'])->name('cart.submit');
    Route::get('/orders', [CheckoutController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{order}/confirmation', [CheckoutController::class, 'confirmation'])->name('orders.confirmation');
    Route::get('/orders/{order}/bill', [CheckoutController::class, 'bill'])->name('orders.bill');
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::put('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/customers', [AdminCustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/admin/customers/{user}', [AdminCustomerController::class, 'show'])->name('admin.customers.show');
    Route::patch('/admin/customers/{user}/toggle', [AdminCustomerController::class, 'toggle'])->name('admin.customers.toggle');
    Route::delete('/admin/customers/{user}', [AdminCustomerController::class, 'destroy'])->name('admin.customers.destroy');
});

Route::middleware('guest')
    ->group(function () {
        Route::get('/register', [RegisterController::class, 'create'])->name('register');
        Route::post('/register', [RegisterController::class, 'store']);

        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::post('/login', [LoginController::class, 'store']);

        Route::get('/forgot-password', [PasswordResetController::class, 'requestForm'])->name('password.request');
        Route::post('/forgot-password', [PasswordResetController::class, 'email'])->name('password.email');
        Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
        Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
    });

require_once 'product.php';
