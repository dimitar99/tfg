<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'body' => ['required', 'string', 'max:100'],
            'image' => ['nullable'],
            'categorias' => ['required', 'array'],
            'categorias.*' => ['integer', 'exists:categories,id'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,svg']
        ];
    }

}
