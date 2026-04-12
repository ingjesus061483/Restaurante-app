<?php

namespace App\Http\Requests\Producto;

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
        $procesado=$this->procesado==null?0:(bool)$this->procesado;
        if($procesado==0)
        {
            return [
                'codigo'=>'required|unique:productos|max:50',
                'nombre'=>'required|max:255|min:3',
                'costo_unitario'=>'required|numeric',
                'precio'=>'required|numeric',
                 'imagen'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'categoria'=>'required' ,
                'impresora'=>'required' ,
                'existencias'=>'required|numeric'
            //
            ];
        }
        return[
                'codigo'=>'required|unique:productos|max:50',
                'nombre'=>'required|max:255|min:3',
                'costo_unitario'=>'required|numeric',
                'precio'=>'required|numeric',
                'categoria'=>'required' ,
                'preparacion'=>'required',
                 'imagen'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'tiempo_coccion'=>'required|numeric',
                'impresora'=>'required' ,
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
            'costo_unitario.numeric'=>'El campo :attribute debe ser un número',
            'precio.required'=>'El campo :attribute es obligatorio',
            'precio.numeric'=>'El campo :attribute debe ser un número',
            'categoria.required'=>'El campo :attribute es obligatorio',
            'preparacion.required'=>'El campo :attribute es obligatorio',
            'tiempo_coccion.required'=>'El campo :attribute es obligatorio',
            'tiempo_coccion.numeric'=>'El campo :attribute debe ser un número',
            'impresora.required'=>'El campo :attribute es obligatorio',
            'existencias.required'=>'El campo :attribute es obligatorio',
            'existencias.numeric'=>'El campo :attribute debe ser un número',
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
            'costo_unitario'=>'Costo Unitario',
            'precio'=>'Precio',
            'categoria'=>'Categoria',
            'preparacion'=>'Preparacion',
            'tiempo_coccion'=>'Tiempo Coccion',
            'impresora'=>'Impresora',
            'imagen'=>'Imagen',
            'existencias'=>'Existencias'
        ];
    }

}
