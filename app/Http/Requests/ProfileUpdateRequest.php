<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'username' => [
                'required',
                'string',
                'max:255',

                Rule::unique('users')->ignore($this->user()->id),
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',

                Rule::unique('users')->ignore($this->user()->id),
            ],

            'phone' => [
                'required',
                'regex:/^[0-9]{9}$/'
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],

        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [

            'phone.regex' =>
                'Numărul de telefon trebuie să conțină exact 9 cifre.',

        ];
    }
    
}