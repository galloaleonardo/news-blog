<?php


namespace App\Http\Controllers\Auth;


use App\User;

class FirstAccessController
{
    public function verify(String $token)
    {
        $user = User::where('token', $token)->first();

        if (!$user) {
            abort(404);
        }

        return view('auth.first-access', compact('user'));
    }
}