<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDataRequest extends FormRequest
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
                //'email'             => 'required|between:3,64|email|unique:App\Models\User,email,'.$this->id,',id',
                'address'=>'required|between:1,200',
                'dni'=>'required|regex:/^([0-9]{2}).[0-9]{3}.[0-9]{3}$/i|unique:App\Models\User,email,'.$this->id,',id',
                'mobile'=>'required|max:14',
                'date_of_birth'=>'required'
            ];
        }


        return [
            'first_name'        => 'required|between:1,255',
            'last_name'         => 'required|between:1,255',
            //'email'             => 'required|between:3,64|email|unique:App\Models\User,email,'.$this->id,',id',
            'address'=>'required|between:1,200',
            'dni'=>'required|regex:/^([0-9]{2}).[0-9]{3}.[0-9]{3}$/i|unique:App\Models\UserData,dni',
            'mobile'=>'required',
            'date_of_birth'=>'required',
            'avatar'=>'required| mimes:jpeg,jpg,png'
        ];
    }
}
