<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoMagazineRequest extends FormRequest
{
    const POST = 'POST';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $mandatory = strtoupper(request()->method()) === self::POST ? 'required' : 'nullable';

        return [
            'page_title' => ['required', 'max:100'],
            'page_description' => ['required', 'max:255'],
            'page_type' => 'required',
            'twitter_user' => 'nullable',
            'image_link' => [$mandatory, 'image', 'mimes:jpeg,jpg,png'],
        ];
    }
}
