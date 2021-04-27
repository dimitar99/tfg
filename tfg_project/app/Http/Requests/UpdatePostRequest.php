<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'body' => ['required', 'string', 'max:100s'],
            'image' => ['nullable'],
            'categorias' => ['required', 'array'],
            'categorias.*' => ['integer', 'exists:categories,id']
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'El campo body no puede estar vacio'
        ];
    }

}
