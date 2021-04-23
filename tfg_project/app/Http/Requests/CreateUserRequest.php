<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateUserRequest extends FormRequest
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
            'surnames' => ['required', 'string'],
            'nick' => ['required', 'string', 'max:15', 'unique:users'],
            'bio' => ['nullable', 'string', 'max:200'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo Nombre no puede estar vacio',
            'surnames.required' => 'El campo Apellidos no puede estar vacio',
            'nick.required' => 'El campo Nick no puede estar vacio',
            'nick.unique' => 'El nick introducido ya se esta utilizando',
            'email.required' => 'El campo Email no puede estar vacio',
            'email.email' => 'El campo Email no tiene un formato correcto',
            'email.unique' => 'El correo introducido ya se esta utilizando',
            'password.required' => 'El campo Contraseña no puede estar vacio',
            'password.min' => 'El campo Contraseña debe tener 8 carácteres como mínimo',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ];
    }

}
