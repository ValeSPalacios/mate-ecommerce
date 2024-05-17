<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
                'mobile'            =>'required',
                'address'           =>'required',
                'dni'               =>'required|min:8|max:8',
                //'email'             => 'required|between:3,64|email|unique:App\Models\User,email,'.$this->user->id,',id',
            ];
        }


        return [
            'first_name'        => 'required|between:1,255',
            'last_name'         => 'required|between:1,255',
            'mobile'            =>'required',
            'address'           =>'required',
            'dni'               =>'required|min:8|max:8|unique:App\Models\Provider,dni'
           
        ];
    
    }

    public function messages()
    {
        return [
            'first_name.required'       =>  'The :attribute is required',
            'first_name.between'        =>  'The :attribute must be between 1 and 255 characters',
            'last_name.required'        =>  'The :attribute is required',
            'last_name.between'         =>  'The :attribute must be between 1 and 255 characters',
            'dni.required'             =>  'The :attribute is required',
            'dni.unique'               =>  'The :attribute already exists',
            'dni.max'                  => 'The max length of :attribute is 8',
            'address.required'              => 'The :attribute is required',
            'mobile.required'            => 'The :attribute is required',
        ];
    }

    public function attributes()
    {
        return [
            'first_name'                => 'First Name',
            'mobile'                     => 'Mobile',
            'last_name'                 => 'Last Name',
            'dni'                 => 'DNI',
            'mobile'    =>'Mobile',
            'address' =>'Address'
        ];
    }
}
