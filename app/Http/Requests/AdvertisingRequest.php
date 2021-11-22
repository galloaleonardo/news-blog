<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisingRequest extends FormRequest
{
    const POST = 'POST';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $mandatory = strtoupper(request()->method()) === self::POST ? 'required' : 'nullable';

        return [
            'title' => ['required', 'min:5', 'max:100'],
            'image_link' => [$mandatory, 'image', 'mimes:jpeg,jpg,png'],
            'active' => 'nullable'
        ];
    }
}
