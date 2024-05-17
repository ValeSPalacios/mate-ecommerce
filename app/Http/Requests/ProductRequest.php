<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'name'=>'required|between:4,100|unique:App\Models\Product,name,'.$this->product->id,',id',
                'cost_price'=>'required|numeric|min:1',
                'increase'=>'required|integer|min:1',
                'stock'=>'required|integer|min:0',
                'category'=>'required|integer|min:1',
                'description'=>'required|between:10,200'

            ];
        }

        return [
            'name'=>'required||between:4,100|unique:App\Models\Product,name',
            'cost_price'=>'required|numeric|min:1',
            'increase'=>'required|integer|min:1',
            'stock'=>'required|integer|min:0',
            'category'=>'required|integer|min:1',
            'description'=>'required|between:10,200',
            'product-img'=>'required| mimes:jpeg,jpg,png'

        ];
    }
    
    public function messages()
    {
        return [
            'name.unique'           =>  'The :attribute is already used',
            'name.required'         =>  'The :attribute is required',
            'name.between' =>'The :attribute must have 4 to 100 characters ',
            'cost_price.require'               =>  'The :attribute is required',
            'cost_price.integer'            =>'The :attribute must be grater than 0',
            'cost_price.min'                 =>  'The :attribute must be grater than 0',
            'increase.required'                   =>  'The :attribute is required',
            'increase.integer'                   =>  'The :attribute must be grater than 1',
            'increase.min'                   =>  'The :attribute must be grater than 1',
            'stock.required'                   =>  'The :attribute is required',
            'stock.integer'                   =>  'The :attribute must be grater or equal to 0',
            'stock.min'                   =>  'The :attribute must be grater or equal to 0',
            'category.required'                   =>  'The :attribute is required',
            'category.integer'                   =>  'The :attribute is not valid',
            'category.min'                   =>  'The :attribute is invalid',
            'description.required'                   =>  'The :attribute is required',
            'description.between'                   =>  'The :attribute must have between 10 adn 200 characters',
            
        ];
    }

    public function attributes()
    {
        return [
            'name'                => 'Name',
            'cost_price'                     => 'Cost Price',
            'stock'                 => 'Stock',
            'category'                 => 'Category',
            'increase' =>'Increase',
            'product-img'=>'Product Image'
        ];
    }
}
