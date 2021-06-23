<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RiderRequest extends FormRequest
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
            'email' => ['required','email','unique:riders,email'],
            'phone' => ['required','unique:riders,phone'],
            'date_of_birth' => ['required','date_format:Y-m-d','before:16 years ago'],
            'gender' => ['required'],
            'password' => ['required','string','min:8','confirmed','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
            'profile_photo' => ['required'],
            'driving_license' => 'required|array',
            'driving_license.*' => 'image|mimes:jpeg,png,jpg,pdf,svg|max:2048',
            'photo_id_proof' => 'required|array',
            'photo_id_proof.*' => 'image|mimes:jpeg,png,jpg,pdf,svg|max:2048',
            'registration_certificate' => 'required|array',
            'registration_certificate.*' => 'image|mimes:jpeg,png,jpg,pdf,svg|max:2048',
            'vehicle_insurance' => 'required|array',
            'vehicle_insurance.*' => 'image|mimes:jpeg,png,jpg,pdf,svg|max:2048',
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
            'regex' => 'The :attribute must be atleast 8 characters, and include number, symbol, a lower and upper case letter',
            'before'=> 'You are not eligible.',
        ];
    }
}
