<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
        $attributes = $request->validated();
        $user = Auth::user();
        $user->name = $attributes['name'];
        $user->email = $attributes['email'];
        if(isset($attributes['password'])) {
            $user->password = bcrypt($attributes['password']);
        }
        /** @var \App\Models\User $user **/
        $user->save();
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
