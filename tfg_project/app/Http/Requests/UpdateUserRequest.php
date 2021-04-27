<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
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
            'nick' => ['required', 'string', 'max:15', Rule::unique('users')->ignore($this->user)],
            'bio' => ['nullable', 'string', 'max:200'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }

}
