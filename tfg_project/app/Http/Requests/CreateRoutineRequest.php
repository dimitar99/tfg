<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoutineRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:routines,name'],
            'type' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required'],
            'image.*' => ['mimes:jpeg,jpg,png|max:2048'],
        ];
    }

    public function messages()
    {
        return[

        ];
    }

}
