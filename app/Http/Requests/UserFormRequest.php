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
                //'email'             => 'required|between:3,64|email|unique:App\Models\User,email,'.$this->user->id,',id',
            ];
        }


            return [
                'first_name'        => 'required|between:1,100',
                'email'             => 'required|between:3,64|email|unique:App\Models\User,email',
                'last_name'         => 'required|between:1,255',
                'role'              => 'required|integer|not_in:0',

            ];
    }

    public function messages()
    {
        return [
            'first_name.required'       =>  'The :attribute is required',
            'first_name.between'        =>  'The :attribute is required',
            'last_name.required'        =>  'The :attribute is required',
            'last_name.between'         =>  'The :attribute is required',
            'role.required'             =>  'The :attribute is required',
            'role.not_in'               =>  'The :attribute is not null',
            'email.unique'              => 'The :attribute exist',
            'email.required'            => 'The :attribute is required',
        ];
    }

    public function attributes()
    {
        return [
            'first_name'                => 'First Name',
            'email'                     => 'Email',
            'last_name'                 => 'Last Name',
            'role'                 => 'Select User Account Type',
        ];
    }
}
