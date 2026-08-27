<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('user.register');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);

        $guestCart = $request->session()->get('cart', []);
        Auth::login($user);
        if ($guestCart) {
            $request->session()->put('cart', $guestCart);
        }

        return redirect()->route('dashboard');
    }
}
