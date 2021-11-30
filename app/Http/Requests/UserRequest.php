<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->user ? $this->user->id : 0;

        return [
            'name' => 'required|min:3',
            'email' => 'required|email|confirmed|unique:users,email,' . $userId,
            'password' => 'nullable',
            'first_password' => 'nullable',
            'admin' => 'nullable',
            'active' => 'nullable'
        ];
    }
}
