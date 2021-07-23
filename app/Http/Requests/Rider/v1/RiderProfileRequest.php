<?php

namespace App\Http\Requests\Rider\v1;

use Illuminate\Foundation\Http\FormRequest;

class RiderProfileRequest extends FormRequest
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
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required','email'],
            'date_of_birth' => ['nullable','before:18 years ago'],
            'gender' => ['nullable']

        ];
    }

    public function messages()
    {
        return [
            'before'=> 'You are not eligible. Must be at least 18 years old'
        ];
    }
}
