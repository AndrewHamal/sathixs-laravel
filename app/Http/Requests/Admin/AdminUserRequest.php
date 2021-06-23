<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','email','unique:users,email'],
            'phone' => ['required','unique:users,phone'],
            'role_id' => ['required'],
            'password' => ['required','string','min:8','confirmed','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
        ];
    }

    public function messages()
    {
        return [
            'regex' => 'The :attribute must be atleast 8 characters, and include number, symbol, a lower and upper case letter',
        ];
    }
}
