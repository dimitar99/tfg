<?php

namespace App\Http\Requests;

use App\Models\RoutineType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoutineTypeRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('routines_types')->ignore($this->routineType)]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo Nombre no puede estar vacío',
            'name.unique' => 'Ya existe una rutina con ese nombre'
        ];
    }

    public function updateRoutineType(RoutineType $routineType)
    {
        $routineType->fill([
            'name' => $this->name
        ]);

        $routineType->save();
    }
}
