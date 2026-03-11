<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required',Password::default()],
            //
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'El campo :attribute es obligatorio',
            'email.email'=>'El campo :attribute debe ser un correo electrónico válido',
            'password.required'=>'El campo :attribute es obligatorio',
            'password.min'=>'El campo :attribute debe tener al menos 8 caracteres',
            'password.confirmed'=>'Las contraseñas no coinciden',
        ];
    }
    public function attributes()
    {
        return [
            'email'=>'Correo electrónico',
            'password'=>'Contraseña',
        ];
    }
}
