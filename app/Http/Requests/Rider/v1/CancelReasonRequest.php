<?php

namespace App\Http\Requests\Rider\v1;

use Illuminate\Foundation\Http\FormRequest;

class CancelReasonRequest extends FormRequest
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
        if($this->cancel_reason_id == 'other')
        {
            return [
                'package_id' => ['required'],
                'custom_cancel_reason' => ['required'],
            ];
        }else{
            return [
                'package_id' => ['required'],
                'cancel_reason_id' => ['required'],
            ];
        }

    }
}
