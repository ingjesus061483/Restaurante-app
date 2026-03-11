<?php

namespace App\Http\Requests\Mesa;

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
            'codigo'=>'required|unique:mesas|max:50',
            'nombre'=>'required|max:50',
            'capacidad'=>'required|numeric',
            'imagen'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            //
        ];
    }
    public function messages()
    {
        return [
            'codigo.required'=>'El campo :attribute es obligatorio',
            'codigo.unique'=>'El :attribute ya existe',
            'codigo.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'nombre.required'=>'El campo :attribute es obligatorio',
            'nombre.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'capacidad.required'=>'El campo :attribute es obligatorio',
            'capacidad.numeric'=>'El campo :attribute debe ser un numero',
            'imagen.required'=>'El campo :attribute es obligatorio',
            'imagen.image'=>'El campo :attribute debe ser una imagen',
            'imagen.mimes'=>'El campo :attribute debe ser de tipo jpeg, png, jpg o gif',
            'imagen.max'=>'El campo :attribute no debe ser mayor a 2048 kilobytes',

        ];
    }
    public function attributes()
    {
        return [
            'codigo'=>'Codigo',
            'nombre'=>'Nombre',
            'capacidad'=>'Capacidad',
            'imagen'=>'Imagen',
        ];
    }
}
