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
            'video' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [

        ];
    }

    public function updateRoutine(Routine $routine)
    {
        $routine->fill([
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'video' => $this->video
        ]);

        $routine->save();
    }
}
