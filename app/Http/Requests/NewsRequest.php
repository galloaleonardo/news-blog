<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title' => ['required', 'max:100'],
            'subtitle' => ['required', 'max:255'],
            'image_link' => [$mandatory, 'image', 'mimes:jpeg,jpg,png', 'max:1000'],
            'category_id' => ['required', 'numeric'],
            'author_id' => 'required',
            'content' => 'required',
            'active' => 'nullable',
            'featured' => 'nullable',
            'youtube_links' => 'nullable',
            'twitter_links' => 'nullable'
        ];
    }
}
