<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopBannerSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'active' => 'nullable',
            'keep_on_top_when_scrolling' => 'nullable'
        ];
    }
}
