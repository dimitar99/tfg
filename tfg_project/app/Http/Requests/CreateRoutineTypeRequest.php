<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\RoutineType;

class CreateRoutineTypeRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:routines_types']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo Nombre no puede estar vacío',
            'name.unique' => 'Ya existe una rutina con ese nombre'
        ];
    }

    public function createRoutineType()
    {
        DB::transaction(function () {
            $routineType = new RoutineType([
                'name' => $this->name
            ]);

            $routineType->save();
        });
    }
}
