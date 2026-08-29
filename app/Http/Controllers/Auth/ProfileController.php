<?php

namespace App\Http\Controllers\Auth;

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
        $request->user()->update(['is_active' => false]);
        $request->user()->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Your profile has been deleted.');
    }
}
