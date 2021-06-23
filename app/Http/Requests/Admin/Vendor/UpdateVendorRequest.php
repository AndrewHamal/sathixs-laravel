<?php

namespace App\Http\Requests\Admin\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorRequest extends FormRequest
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
            'email' => ['required','email','unique:vendors,email,'.$this->vendor_id],
            'phone' => ['required','unique:vendors,phone,'.$this->vendor_id],
            'profile_picture' => ['sometimes','image','mimes:jpeg,png,jpg,heic','max:2048'],
            'city' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'long' => ['required'],
            'lat' => ['required'],
        ];
    }
}
