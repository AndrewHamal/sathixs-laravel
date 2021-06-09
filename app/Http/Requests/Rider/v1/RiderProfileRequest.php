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
            'date_of_birth' => ['required','date_format:Y-m-d','before:16 years ago'],
            'gender' => ['required']

        ];
    }

    public function messages()
    {
        return [
            'before'=> 'You are not eligible.'
        ];
    }
}
