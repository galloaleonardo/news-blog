<?php

namespace App\Http\Controllers;

use App\Http\Requests\FirstLoginRequest;

class FirstLoginController extends Controller
{
    public function index()
    {
        return view('auth.passwords.first-login');
    }

    public function updatePassword(FirstLoginRequest $request)
    {
        $data = $request->validated();

        $this->service->updatePassword((int)$request->user()->id, $data);

        return redirect()->route('dashboard');
    }
}
