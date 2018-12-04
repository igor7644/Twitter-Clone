<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupValidation extends FormRequest
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
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed'
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'lastName.required' => 'Last name is required!',
            'email.required' => 'Email is required!',
            'email.unique' => 'Email has already been taken!',
            'username.required' => 'Username is required!',
            'username.unique' => 'Username has already been taken!',
            'password.required' => 'Password is required!'
        ];
    }
}
