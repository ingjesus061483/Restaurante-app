<?php

namespace App\Http\Requests\Empleado;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
class UpdateRequest extends FormRequest
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
                'identificacion'=>'required|max:50|unique:empleados,identificacion,'. $this->id,
                'nombre'=>'required|max:50',
                'apellido'=>'required|max:50',
                'fecha_nacimiento'=>'required',
                'direccion'=>'required|max:50',
                'telefono'=>'required|max:50',
                'email'=>'required|email|max:255',
                'name'=>'required',
                'password'=>['required','confirmed',Password::default()],
                'role'=>'required'
                //
            ];
        }
        return [
            'identificacion'=>'required|max:50|unique:empleados,identificacion,'. $this->id,
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'fecha_nacimiento'=>'required',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'email'=>'required|email|max:255',
            'name'=>'required',
            'password'=>['required','confirmed',Password::default()],
            'role'=>'required',
            'caja'=>'required'
            //
        ];

    }
    public function messages()
    {
        return [
            'identificacion.required'=>'El campo :attribute es obligatorio',
            'identificacion.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'identificacion.unique'=>'El campo :attribute ya existe',
            'nombre.required'=>'El campo :attribute es obligatorio',
            'nombre.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'apellido.required'=>'El campo :attribute es obligatorio',
            'apellido.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'fecha_nacimiento.required'=>'El campo :attribute es obligatorio',
            'direccion.required'=>'El campo :attribute es obligatorio',
            'direccion.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'telefono.required'=>'El campo :attribute es obligatorio',
            'telefono.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'email.required'=>'El campo :attribute es obligatorio',
            'email.email'=>'El campo :attribute debe ser una dirección de correo electrónico válida',
            'email.max'=>'El campo :attribute no debe ser mayor a 255 caracteres',
            'name.required'=>'El campo :attribute es obligatorio',
            'password.required'=>'El campo :attribute es obligatorio',
            'password.confirmed'=>'La confirmación de :attribute no coincide',
            'role.required'=>'El campo :attribute es obligatorio',
            'caja.required'=>'El campo :attribute es obligatorio',
        ];
    }
    public function attributes(){
        return [
            'identificacion'=>'Identificación',
            'nombre'=>'Nombre',
            'apellido'=>'Apellido',
            'fecha_nacimiento'=>'Fecha de nacimiento',
            'direccion'=>'Dirección',
            'telefono'=>'Teléfono',
            'email'=>'Email',
            'name'=>'Nombre de usuario',
            'password'=>'Contraseña',
            'role'=>'Rol',
            'caja'=>'Caja',
        ];
    }
}
