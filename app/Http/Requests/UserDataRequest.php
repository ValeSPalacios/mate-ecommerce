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
                //'email'             => 'required|between:3,64|email|unique:App\Models\User,email,'.auth()->user()->id,',id',
                'address'=>'required|between:1,200',
                'dni'=>'required|min:8',
                'mobile'=>'required|max:14',
                'date_of_birth'=>'required'
            ];
        }


            return [
                'first_name'        => 'required|between:1,100',
                'email'             => 'required|between:3,64|email|unique:App\Models\User,email',
                'last_name'         => 'required|between:1,255',
                'role'              => 'required|integer|not_in:0',

            ];
    }
}
