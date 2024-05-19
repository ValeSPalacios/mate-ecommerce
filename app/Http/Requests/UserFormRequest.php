<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
       if ($this->method() == 'PUT') {

            return [
                'first_name'        => 'required|between:1,255',
                'last_name'         => 'required|between:1,255',
                
            ];
        }


            return [
                'username'        => 'required|between:4,64|unique:App\Models\User,username',
                'email'             => 'required|between:3,64|email|unique:App\Models\User,email',
                'password'         => 'required|between:8,64|same:password-confirm',
                'password-confirm'              => 'required|between:8,64|same:password',

            ];
    }

    public function messages()
    {
        return [
            'username.required'       =>  'The :attribute is required',
            'username.between'        =>  'The :attribute must be between 4 and 64 characters',
            'password.required'        =>  'The :attribute is required',
            'password.between'         =>  'The :attribute must be between 8 and 64 characters',
            'email.unique'              => 'The :attribute exist',
            'email.required'            => 'The :attribute is required',
            'password-confirm.require' =>'The passwords must match',
            'password-confirm.same' =>'The passwords must match',
            'password-confirm.between'         =>  'The :attribute must be between 8 and 64 characters',
            'password.same' =>'The passwords must match',
        ];
    }

    public function attributes()
    {
        return [
            'username'                => 'Username',
            'email'                     => 'Email',
            'password'                 => 'Password',
            'password-confirm'                 => 'Confirmation',
        ];
    }
}
