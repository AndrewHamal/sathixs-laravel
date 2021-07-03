<?php

namespace App\Http\Requests\Vendor_web\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required','email','unique:vendors,email,'.$this->vendor_id],
            'phone' => ['required','unique:vendors,phone,'.$this->vendor_id],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
        ];
    }
}
