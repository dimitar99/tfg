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
            'name.required' => __('tfg.validations.name-required'),
            'surnames.required' => __('tfg.validations.surnames-required'),
            'nick.required' => __('tfg.validations.nick-required'),
            'nick.unique' => __('tfg.validations.nick-unique'),
            'email.required' => __('tfg.validations.email-required'),
            'email.email' => __('tfg.validations.email-email'),
            'email.unique' => 'El correo introducido ya se esta utilizando',
            'password.required' => __('tfg.validations.password-required'),
            'password.min' => 'El campo Contraseña debe tener 8 carácteres como mínimo',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ];
    }

}
