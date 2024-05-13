<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
                //'product'        => 'required|min:1',
                //'provider'         => 'required|min:1',
                'cost_price'            =>'required|numeric|min:1',
                'increase'           =>'required|integer|min:1',
                'count'               =>'required|integer|min:1',
                //'email'             => 'required|between:3,64|email|unique:App\Models\User,email,'.$this->user->id,',id',
            ];
        }


        return [
            'product'        => 'required|min:1',
            'provider'         => 'required|min:1',
            'cost_price'            =>'required|numeric|min:1',
            'increase'           =>'required|integer|min:1',
            'count'               =>'required|integer|min:1',
           
        ];
    
    }

    public function messages()
    {
        return [
            'product.required'       =>  'The :attribute is required',
            'provider.required'        =>  'The :attribute is required',
            'cost_price.required'        =>  'The :attribute is required',
            'cost_price.min'         =>  'The :attribute must be :min or more',
            'cost_price.numeric'         =>  'The :attribute must be a number',
            'increse.required'             =>  'The :attribute is required',
            'increase.integer'         =>  'The :attribute must be a number',
            'count.required'              => 'The :attribute is required',
            'count.min'         =>  'The :attribute must be :min or more',
            'count.integer'         =>  'The :attribute must be a number',
           
           
        ];
    }

    public function attributes()
    {
        return [
            'product'                => 'Product',
            'provider'                     => 'Provider',
            'cost_price'                 => 'Cost Price',
            'increase'                 => 'Increase',
            'count'    =>'Count',
        ];
    }
}

