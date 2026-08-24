<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest ;

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
}
