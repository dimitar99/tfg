<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'nick' => ['required', 'string', 'max:15'],
            'bio' => ['nullable', 'string', 'max:200'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'El campo Email no tiene un formato correcto',
            'email.unique' => 'El correo introducido ya se esta utilizando',
            'password.min' => 'Como minimo 8 caracteres'
        ];
    }

    public function updateUser(User $user)
    {
        $user->fill([
            'name' => $this->name,
            'surnames' => $this->surnames,
            'nick' => $this->nick,
            'bio' => $this->bio,
            'email' => $this->email
        ]);

        if ($this->password != null) {
            $user->password = bcrypt($this->password);
        }

        $user->save();
    }
}
