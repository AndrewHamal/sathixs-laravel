<?php

namespace App\Http\Requests\Rider\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RiderUpdateRequest extends FormRequest
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
            'email' => ['required','email','unique:riders,email,'.$this->rider_id],
            'phone' => ['required','unique:riders,phone,'.$this->rider_id],
            'date_of_birth' => ['required','date_format:Y-m-d','before:16 years ago'],
            'gender' => ['required'],
            'home_city' => ['required'],
            'home_state' => ['required'],
            'home_country' => ['required'],
            'home_long' => ['required'],
            'home_lat' => ['required'],
            'work_city' => ['required'],
            'work_state' => ['required'],
            'work_country' => ['required'],
            'work_long' => ['required'],
            'work_lat' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'before'=> 'You are not eligible.',
        ];
    }
}
