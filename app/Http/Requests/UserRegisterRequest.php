<?php

namespace App\Http\Requests;

class UserRegisterRequest extends JsonRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is not unique',
            'name.required' => 'Name is required',
            'password.required' => 'Password is required',
            'c_password.required' => 'Confirmation password is required',
            'c_password.same' => 'Passwords must be the same',
        ];
    }
}
