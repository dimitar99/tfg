<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
            'nick' => ['required', 'string'],
            'bio' => ['nullable', 'string', 'max:200'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo Nombre no puede estar vacio',
            'surnames.required' => 'El campo Apellidos no puede estar vacio',
            'nick.required' => 'El campo Nick no puede estar vacio',
            'email.required' => 'El campo Email no puede estar vacio',
            'email.email' => 'El campo Email no tiene un formato correcto',
            'email.unique' => 'El correo introducido ya se esta utilizando',
            'password.required' => 'El campo Contraseña no puede estar vacio',
            'password.min' => 'La contraseña debe ser como minimo de 8 caracteres'
        ];
    }

    public function createUser()
    {
        DB::transaction(function () {
            $user = new User([
                'name' => $this->name,
                'surnames' => $this->surnames,
                'nick' => $this->nick,
                'bio' => $this->bio,
                'email' => $this->email,
                'password' => bcrypt($this->password)
            ]);

            $user->save();
        });
    }
}
