<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('user.profile');
    }

    public function update(ProfileRequest $request)
    {
        $data = $request->validated();

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $request->user()->update($data);

        return redirect()->route('profile')->with('status', 'Your profile has been updated.');
    }
}
