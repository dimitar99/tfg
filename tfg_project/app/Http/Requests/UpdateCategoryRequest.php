<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('categories')->ignore($this->category)]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo Nombre no puede estar vacío',
            'name.unique' => 'Ya existe una rutina con ese nombre'
        ];
    }
}
