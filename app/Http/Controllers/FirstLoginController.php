<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Validation\Rules\Password;

class FirstLoginController extends Controller
{
    public function index()
    {
        return view('auth.passwords.first-login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers(),
            ]
        ]);

        $attributes = $request->all();

        $user = User::find($request->user()->id);
        
        $user->update([
            'password' => \Hash::make($attributes['password'])
        ]);

        return redirect()->route('dashboard');
    }
}
