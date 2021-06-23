<?php

namespace App\Http\Requests\Admin\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'first_name' => ['required','string'],
            'last_name' => ['required','string'],
            'email' => ['required','email','unique:vendors,email'],
            'phone' => ['required','unique:vendors,phone'],
            'password' => ['required','string','min:8','confirmed','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
            'profile_picture' => ['sometimes','image','mimes:jpeg,png,jpg,heic','max:2048'],
            'city' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'long' => ['required'],
            'lat' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'regex' => 'The :attribute must be atleast 8 characters, and include number, symbol, a lower and upper case letter',
        ];
    }
}
