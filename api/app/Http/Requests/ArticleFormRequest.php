<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
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
            'title' => 'required|string',
            'classify' => 'required|string',
            'author'=> 'required|string',
            'tag' => 'required|string',
            'content' => 'required|string',
        ];
    }
}


// php artisan make:request RegisterFormRequest