<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Routine;

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
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'description' => ['required', 'string'],
            'video' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'El campo Nombre no puede estar vacio',
            'type.required' => 'El campo Tipo no puede estar vacio',
            'description.required' => 'El campo Descripcion no puede estar vacio',
            'video.required' => 'El campo Video no puede estar vacio'
        ];
    }

    public function createRoutine()
    {
        DB::transaction(function () {
            $routine = new Routine([
                'name' => $this->name,
                'type' => $this->type,
                'description' => $this->description,
                'video' => $this->video,
            ]);

            $routine->save();
        });
    }
}
