<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                    'name' => 'required|max:64',
                    'username' => 'required|max:32|unique:users',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6',
                    'confirm_password' => 'required|same:password',
                    'avatar' => 'required|image|dimensions:min_width=100,min_height=100'
                ];
            case 'PUT':
                return [
                    'name' => 'required|max:64',
                    'username' => 'required|max:32|unique:users,username,' . $this->user,
                    'email' => 'required|email|unique:users,email,' . $this->user,
                    'avatar' => 'image|dimensions:min_width=100,min_height=100'
                ];
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
            'avatar.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg).',
            'avatar.dimensions' => 'The image has invalid dimensions (min-width: 100 pixel, min-height: 100 pixel).'
        ];
    }
}
