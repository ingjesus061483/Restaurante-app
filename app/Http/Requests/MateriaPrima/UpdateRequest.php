<?php

namespace App\Http\Requests\MateriaPrima;

use Illuminate\Foundation\Http\FormRequest;
USE Illuminate\Support\Facades\Auth;
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
        return [
             'codigo'=>'required|max:50|unique:materia_primas,codigo,'.$this->id,
            'nombre'=>'required|max:255|min:3',
            'costo_unitario'=>'required|numeric',
            'unidad_medida'=>'required',
            'categoria'=>'required'
            //
        ];
    }
    public function messages()
    {
        return [
            'codigo.required'=>'El campo :attribute es obligatorio',
            'codigo.unique'=>'El campo :attribute ya existe',
            'codigo.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'nombre.required'=>'El campo :attribute es obligatorio',
            'nombre.max'=>'El campo :attribute no debe ser mayor a 255 caracteres',
            'nombre.min'=>'El campo :attribute no debe ser menor a 3 caracteres',
            'costo_unitario.required'=>'El campo :attribute es obligatorio',
            'costo_unitario.numeric'=>'El campo :attribute debe ser un numero',
            'unidad_medida.required'=>'El campo :attribute es obligatorio',
            'categoria.required'=>'El campo :attribute es obligatorio'
        ];
    }
    public function attributes()
    {
        return [
            'codigo'=>'Codigo',
            'nombre'=>'Nombre',
            'costo_unitario'=>'Costo Unitario',
            'unidad_medida'=>'Unidad de Medida',
            'categoria'=>'Categoria'
        ];
    }
}
