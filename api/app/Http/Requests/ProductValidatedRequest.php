<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidatedRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'name'=>"required|min:3|max:50|required|unique:product",
            'cate_id'=>'required',
            'desc'=>'required|min:5',
            'price'=>'required|numeric|min:0',
            'discount'=>'required|numeric|min:0|max:100',
            'max_price'=>'required|numeric|min:0',
            'min_price'=>'required|min:0',
            'status'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>"name is required",
            'name.min'=>'name not be less than 03 characters',
            'name.max'=>'name no more than 50 characters',
            'name.unique'=>"name already exists",
            'cate_id.required'=>"category is required",
            'price.required'=>"price is required",
            'price.min'=>"price is less than 0",
            'price.numeric'=>'price is number',
            'discount.required'=>"discount is required",
            'discount.numeric'=>"discount is numeric",
            'discount.min'=>"discount is less than 0 ",
            'discount.max'=>"discount no more than 100",
        ];
    }
}
