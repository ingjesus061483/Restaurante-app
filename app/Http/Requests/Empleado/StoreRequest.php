<?php

namespace App\Http\Requests\Empleado;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user=Auth::user();
        if($user->role_id==1||$user->role_id==2)
        {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if($this->role!=3)
        {
            return [
                'identificacion'=>'required|unique:empleados|max:50',
                'nombre'=>'required|max:50',
                'apellido'=>'required|max:50',
                'fecha_nacimiento'=>'required',
                'direccion'=>'required|max:50',
                'telefono'=>'required|max:50',
                'role'=>'required',
                'empresa'=>'required',
                'name'=>'required|unique:users',
                'email'=>'required|email|max:255|unique:users',
                'password'=>['required','confirmed',Password::default()],
            //
            ];
        }
        return [
            'identificacion'=>'required|unique:empleados|max:50',
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'fecha_nacimiento'=>'required',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'role'=>'required',
            'empresa'=>'required',
            'name'=>'required|unique:users',
            'email'=>'required|email|max:255|unique:users',
            'password'=>['required','confirmed',Password::default()],
            'caja'=>'required',
        ];

    }
    public function messages()
    {
        return [
            'identificacion.required'=>'El campo :attribute es obligatorio',
            'identificacion.unique'=>'El campo :attribute ya existe',
            'identificacion.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'nombre.required'=>'El campo :attribute es obligatorio',
            'nombre.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'apellido.required'=>'El campo :attribute es obligatorio',
            'apellido.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'fecha_nacimiento.required'=>'El campo :attribute es obligatorio',
            'direccion.required'=>'El campo :attribute es obligatorio',
            'direccion.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'telefono.required'=>'El campo :attribute es obligatorio',
            'telefono.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'role.required'=>'El campo :attribute es obligatorio',
            'empresa.required'=>'El campo :attribute es obligatorio',
            'name.required'=>'El campo :attribute es obligatorio',
            'name.unique'=>'El campo :attribute ya existe',
            'email.required'=>'El campo :attribute es obligatorio',
            'email.email'=>'El campo :attribute debe ser una dirección de correo electrónico válida',
            'email.max'=>'El campo :attribute no debe ser mayor a 255 caracteres',
            'email.unique'=>'El campo :attribute ya existe',
            'password.required'=>'El campo :attribute es obligatorio',
            'password.confirmed'=>'Las contraseñas no coinciden',
            'caja.required'=>'El campo :attribute es obligatorio',
        ];
    }
    public function attributes()
    {
        return [
            'identificacion'=>'Identificación',
            'nombre'=>'Nombre',
            'apellido'=>'Apellido',
            'fecha_nacimiento'=>'Fecha de nacimiento',
            'direccion'=>'Dirección',
            'telefono'=>'Teléfono',
            'role'=>'Rol',
            'empresa'=>'Empresa',
            'name'=>'Nombre de usuario',
            'email'=>'Email',
            'password'=>'Contraseña',
            'caja'=>'Caja',
        ];
    }
}
