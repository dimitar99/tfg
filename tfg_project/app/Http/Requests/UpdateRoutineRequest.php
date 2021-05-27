<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoutineRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:routines,name,'.$this->id],
            'routine_type_id' => ['nullable', 'integer', 'exists:routines_types,id'],
            'description' => ['required', 'string', ' max:600'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,svg'],
        ];
    }

    public function messages()
    {
        return [
            'image.image' => __('tfg.validations.image'),
        ];
    }
}
