<?php

namespace App\Http\Controllers\Auth;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('user.profile');
    }

    public function update(ProfileRequest $request)
    {
        $data = $request->validated();

        $request->user()->update($data);

        return redirect()->route('profile')->with('status', 'Your profile has been updated.');
    }

    public function destroy(Request $request)
    {
        if ($request->user()->orders()
            ->whereNotIn('status', [OrderStatus::DELIVERED->value, OrderStatus::CANCELLED->value])
            ->exists()) {
            return back()->with('error', 'Your profile cannot be deleted while you have active orders.');
        }

        $request->user()->update(['is_active' => false]);
        $request->user()->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Your profile has been deleted.');
    }
}
