<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'company_name' => 'nullable',
            'language_id' => 'required|numeric',
            'company_logo_link' => [
                $mandatory, 'mimes:jpeg,jpg,png', 'max:800', 'dimensions:max_width=2000,max_height=2000'
            ],
            'icon_tab_link' => [$mandatory, 'mimes:ico'],
            'use_logo_by_default' => 'nullable'
        ];
    }
}
