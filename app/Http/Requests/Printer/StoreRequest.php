<?php

namespace App\Http\Requests\Printer;

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
            'codigo'=>'required|max:50|unique:impresoras',
            'nombre'=>'required|max:50',
            'recurso_compartido'=>'required|max:50',
            'tamaño_fuente_encabezado'=>'required|numeric',
            'tamaño_fuente_contenido'=>'required|numeric',
            //
        ];
    }
    public function messages()
    {
        return [
            'codigo.required'=>'El campo :attribute es obligatorio',
            'codigo.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'codigo.unique'=>'El campo :attribute ya existe en la base de datos',
            'nombre.required'=>'El campo :attribute es obligatorio',
            'nombre.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'recurso_compartido.required'=>'El campo :attribute es obligatorio',
            'recurso_compartido.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'tamaño_fuente_encabezado.required'=>'El campo :attribute es obligatorio',
            'tamaño_fuente_encabezado.numeric'=>'El campo :attribute debe ser un número',
            'tamaño_fuente_contenido.required'=>'El campo :attribute es obligatorio',
            'tamaño_fuente_contenido.numeric'=>'El campo :attribute debe ser un número',
        ];
    }
    public function attributes()
    {
        return [
            'codigo'=>'Codigo',
            'nombre'=>'Nombre',
            'recurso_compartido'=>'Recurso Compartido',
            'tamaño_fuente_encabezado'=>'Tamaño Fuente Encabezado',
            'tamaño_fuente_contenido'=>'Tamaño Fuente Contenido',
        ];
    }
}
