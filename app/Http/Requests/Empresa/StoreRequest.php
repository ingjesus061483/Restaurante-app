<?php

namespace App\Http\Requests\Empresa;

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
             'nit'=>'required|unique:empresas|max:50',
            'nombre'=>'required|max:50',
            'camara_de_comercio'=>'required|max:50',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'email'=>'required|email|max:255',
            'contacto'=>'required',
            'tipo_regimen'=>'required',
            //
        ];
    }
    public function messages()
    {
        return [
            'nit.required'=>'El campo :attribute es obligatorio',
            'nit.unique'=>'El campo :attribute ya existe',
            'nit.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'nombre.required'=>'El campo :attribute es obligatorio',
            'nombre.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'camara_de_comercio.required'=>'El campo :attribute es obligatorio',
            'camara_de_comercio.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'direccion.required'=>'El campo :attribute es obligatorio',
            'direccion.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'telefono.required'=>'El campo :attribute es obligatorio',
            'telefono.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'email.required'=>'El campo :attribute es obligatorio',
            'email.email'=>'El campo :attribute debe ser un email valido',
            'email.max'=>'El campo :attribute no debe ser mayor a 255 caracteres',
            'contacto.required'=>'El campo :attribute es obligatorio',
            'tipo_regimen.required'=>'El campo :attribute es obligatorio',
        ];
    }
    public function attributes()
    {
        return [
            'nit'=>'Nit',
            'nombre'=>'Nombre',
            'camara_de_comercio'=>'Camara de Comercio',
            'direccion'=>'Direccion',
            'telefono'=>'Telefono',
            'email'=>'Email',
            'contacto'=>'Contacto',
            'tipo_regimen'=>'Tipo Regimen',
        ];
    }
}
