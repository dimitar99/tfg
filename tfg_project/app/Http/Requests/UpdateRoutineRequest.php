<?php

namespace App\Http\Requests;

use App\Models\Routine;
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
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo Nombre no puede estar vacío',
            'type.required' => 'El campo Tipo no puede estar vacío',
            'description.required' => 'El campo Descripcion no puede estar vacío',
            'image.required' => 'El campo Imagen no puede estar vacío'
        ];
    }

    public function updateRoutine(Routine $routine)
    {
        $routine->fill([
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'image' => $this->image
        ]);

        $routine->save();
    }
}
