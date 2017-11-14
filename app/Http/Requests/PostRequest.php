<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'image.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg).',
        ];
    }
}
