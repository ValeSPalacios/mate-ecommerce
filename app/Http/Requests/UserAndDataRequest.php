<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAndDataRequest extends FormRequest
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
                'address'=>'required|between:1,200',
                'dni'=>'required|regex:/^([0-9]{2}).[0-9]{3}.[0-9]{3}$/i',
                'mobile'=>'required',
                'date_of_birth'=>'required'

            ];
        }


            return [
                'username'=>'required|min:4|unique:App\Models\User,username',
                'first_name'        => 'required|between:1,255',
                'last_name'         => 'required|between:1,255',
                'email'             => 'required|between:3,64|email|unique:App\Models\User,email',
                'password'=>'required|between:8,64',
                'role'=>'required|integer|min:1',
                'address'=>'required|between:1,200',
                'dni'=>'required|regex:/^([0-9]{2}).[0-9]{3}.[0-9]{3}$/i|unique:App\Models\UserData,dni',
                'mobile'=>'required',
                'date_of_birth'=>'required',
                'avatar'=>'required| mimes:jpeg,jpg,png'

            ];
    }

    public function messages()
    {
        return [
            'username.unique'           =>  'The :attribute is already used',
            'username.required'         =>  'The :attribute is required',
            'dni.require'               =>  'The :attribute is required',
            'dni.regex'                 =>  'The :attribute must have 8 digits',
            'dni.unique'                   =>  'The :attribute already exists',
            'address.required'          =>  'The :attribute is required',
            'addess.between'                   =>  'The :attribute must have between 1 and 200 characters',
            'mobile.required'           =>  'The :attribute is required',
            //'mobile.regex'                   =>  'The :attribute must have 10 digits',
            'first_name.required'       =>  'The :attribute is required',
            'first_name.between'        =>  'The :attribute is required',
            'last_name.required'        =>  'The :attribute is required',
            'last_name.between'         =>  'The :attribute is required',
            'role.required'             =>  'The :attribute is required',
            'role.min'               =>  'Select one :attribute ',
            'role.integer'             => 'Please, select one :attribute',
            'email.unique'              => 'The :attribute exist',
            'email.required'            => 'The :attribute is required',
            'password.required'            => 'The :attribute is required',
            'password.beetwen'            => 'The :attribute must have between 8 an 64 character',
            'date_of_birth.require'=>'The :attribute is required',
        ];
    }

    public function attributes()
    {
        return [
            'first_name'                => 'First Name',
            'email'                     => 'Email',
            'last_name'                 => 'Last Name',
            'role'                 => 'Role',
        ];
    }
}
