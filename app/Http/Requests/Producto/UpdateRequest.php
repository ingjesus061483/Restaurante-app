<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
         $procesado=$this->procesado==null?0:(bool)$this->procesado;
        if($procesado==0)
        {
            return [
                'codigo'=>'required|max:50|unique:productos,codigo,'.$this->id,
                'nombre'=>'required|max:255|min:3',
                'costo_unitario'=>'required|numeric',
                'precio'=>'required|numeric',
                'categoria'=>'required' ,
                'impresora'=>'required' ,
            //
            ];
        }
        return[
            'codigo'=>'required|max:50|unique:productos,codigo,'.$this->id,
            'nombre'=>'required|max:255|min:3',
            'costo_unitario'=>'required|numeric',
            'precio'=>'required|numeric',
            'categoria'=>'required' ,
            'preparacion'=>'required',
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
            'nombre.min'=>'El campo :attribute debe tener al menos 3 caracteres',
            'costo_unitario.required'=>'El campo :attribute es obligatorio',
            'costo_unitario.numeric'=>'El campo :attribute debe ser un número',
            'precio.required'=>'El campo :attribute es obligatorio',
            'precio.numeric'=>'El campo :attribute debe ser un número',
            'categoria.required'=>'El campo :attribute es obligatorio',
            'impresora.required'=>'El campo :attribute es obligatorio',
            'preparacion.required'=>'El campo :attribute es obligatorio',
            'tiempo_coccion.required'=>'El campo :attribute es obligatorio',
            'tiempo_coccion.numeric'=>'El campo :attribute debe ser un número',

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
            'impresora'=>'Impresora',
            'preparacion'=>'Preparacion',
            'tiempo_coccion'=>'Tiempo de Coccion'
        ];
    }
}
