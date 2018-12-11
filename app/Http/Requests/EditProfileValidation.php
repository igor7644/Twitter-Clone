<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileValidation extends FormRequest
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
            'username' => 'required|unique:users'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'lastName.required' => 'Last Name is required!',
            'username.required' => 'Username is required!',
            'username.unique' => 'Username already exists, please choose another one!'
        ];
    }
}
