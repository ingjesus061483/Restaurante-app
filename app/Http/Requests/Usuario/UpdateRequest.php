<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
class UpdateRequest extends FormRequest
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
            'current_password'=>['required',Password::default()],
            'password'=>['required','confirmed',Password::default()],
            //
        ];
    }
    public function messages()
    {
        return [
            'current_password.required'=>'El campo :attribute es obligatorio',
            'current_password.min'=>'El campo :attribute debe tener al menos 8 caracteres',
            'password.required'=>'El campo :attribute es obligatorio',
            'password.min'=>'El campo :attribute debe tener al menos 8 caracteres',
            'password.confirmed'=>'Las contraseñas no coinciden',
        ];
    }
    public function attributes()
    {
        return [
            'current_password'=>'Contraseña actual',
            'password'=>'Nueva contraseña',
        ];
    }
}
