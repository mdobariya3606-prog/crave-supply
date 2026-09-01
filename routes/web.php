<?php

use App\Http\Controllers\Admin\ContactMessageController;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

require_once 'auth.php';
require_once 'product.php';
require_once 'order.php';
require_once 'category.php';
require_once 'cart.php';

Route::get('/', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('dashboard');
})->name('home');

Route::get('/dashboard', function () {
    \Illuminate\Support\Facades\Redis::set('last_accessed', now()->toDateTimeString());
    return view(
        'dashboard',
        [
            'topReviews' => Review::query()
                ->where('is_approved', true)
                ->whereNotNull('comment')
                ->where('comment', '!=', '')
                ->with(['product', 'user'])
                ->orderByDesc('rating')
                ->latest()
                ->take(6)
                ->get(),
            'randomProducts' => Product::query()
                ->where('is_available', true)
                ->with(['productImages', 'category'])
                ->inRandomOrder()
                ->take(10)
                ->get(),
        ]
    );
})->name('dashboard');

Route::middleware('auth')->get('/cache/clear', function (Request $request) {
    // Clear only this user's session-backed data; never flush the shared application cache.
    $request->session()->forget('cart');

    return redirect()->back()->with('success', 'Your personal cache was cleared.');
})->name('cache.clear');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/account-disabled', 'account-disabled')->name('account.disabled');

Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.submit');
