<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class RegisterFormRequest extends FormRequest
{
    // protected $forceJsonResponse = true;
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
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:10',
            // 'captcha' => 'required|captcha'
        ];
    }
    // public function messages(){
    //     // return [
    //     //     'captcha.captcha' => 'Please provide the valid captcha.'
    //     // ];
    // }
}


// php artisan make:request RegisterFormRequest