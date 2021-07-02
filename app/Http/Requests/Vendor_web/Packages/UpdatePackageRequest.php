<?php

namespace App\Http\Requests\Vendor_web\Packages;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
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
            'category_id' => ['required'],
            'no_of_package' => ['required'],
            'receiver_name' => ['required', 'string', 'max:255'],
            'receiver_address' => ['required', 'string', 'max:255'],
            'receiver_phone' => ['required'],
            'product_price' => ['required'],
            'weight' => ['required'],
        ];
    }
}
