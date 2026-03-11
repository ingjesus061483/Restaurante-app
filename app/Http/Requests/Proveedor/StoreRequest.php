<?php

namespace App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;
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
        return [
            'identificacion'=>'required|unique:proveedors|max:50',
            'nombre'=>'required|max:50',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'email'=>'required|email|max:255',
            //
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
            'direccion.required'=>'El campo :attribute es obligatorio',
            'direccion.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'telefono.required'=>'El campo :attribute es obligatorio',
            'telefono.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'email.required'=>'El campo :attribute es obligatorio',
            'email.email'=>'El campo :attribute debe ser un email valido',
            'email.max'=>'El campo :attribute no debe ser mayor a 255 caracteres',
        ];
    }
    public function attributes()
    {
        return [
            'identificacion'=>'Identificacion',
            'nombre'=>'Nombre',
            'direccion'=>'Direccion',
            'telefono'=>'Telefono',
            'email'=>'Email',
        ];
    }
}
