<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('user.login');
    }

    public function store(LoginRequest $request)
    {
        if (! Auth::attempt([...$request->only('email', 'password'), 'is_active' => true], $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'These credentials do not match our records.']);
        }

        // Preserve a guest cart while rotating the session ID after login.
        $guestCart = $request->session()->get('cart', []);
        $request->session()->regenerate();
        if ($guestCart) {
            $request->session()->put('cart', $guestCart);
        }

        return redirect()->intended(route('dashboard'));
    }
}
