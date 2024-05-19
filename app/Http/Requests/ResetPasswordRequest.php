<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'email'=>'required|between:8,64|email',
            'password'=>'required|between:8,64|same:password_confirmation',
            'password_confirmation' => 'required|between:8,64|same:password',
        ];
    }

    
    public function messages()
    {
        return [
            'password.required'        =>  'The :attribute is required',
            'password.between'         =>  'The :attribute must be between 8 and 64 characters',
            'email.required'            => 'The :attribute is required',
            'password_confirmation.require' =>'The passwords must match',
            'password_confirmation.same' =>'The passwords must match',
            'password_confirmation.between'         =>  'The :attribute must be between 8 and 64 characters',
            'password.same' =>'The passwords must match',
        ];
    }

    public function attributes()
    {
        return [
            'password'                 => 'Password',
            'password_confirmation'                 => 'Confirmation',
        ];
    }
}
