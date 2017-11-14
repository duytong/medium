<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
{
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|unique:topics',
                    'overview' => 'required',
                    'image' => 'required|image|dimensions:min_width=280,min_height=180'
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|unique:topics,name,' . $this->topic,
                    'overview' => 'required',
                    'image' => 'image|dimensions:min_width=280,min_height=180'
                ];
                break;
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg).',
            'image.dimensions' => 'The image has invalid dimensions (min-width: 280 pixel, min-height: 180 pixel).'
        ];
    }
}
