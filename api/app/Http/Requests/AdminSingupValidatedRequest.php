<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSingupValidatedRequest extends FormRequest
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
            'name'=>'required|min:3|max:50|string|unique:admin',
            'email'=>'required|email|unique:admin',
            'password'=>'required|confirmed|min:5|max:30',
            'password_confirmation'=>'required|min:5'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>"name is required",
            'name.min'=>'name not be less than 03 characters',
            'name.max'=>'name no more than 50 characters',
            'name.unique'=>"name already exists",
        ];
    }
}
