<?php

namespace App\Http\Requests\OrdenEncabezado;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $aplicaCliente=$this->aplicaCliente!=null?(bool)$this->aplicaCliente:0;
        if($aplicaCliente)
        {
            return[
                'codigo'=>'required|unique:orden_encabezados|max:50',
                'tipo_documento'=>'required',
                'fecha'=>'required',
                'hora'=>'required|',
                'hora_entrega'=>'required' ,
                'cliente'=>'required',
                'empleado'=>'required',
            ];
        }
        return [
                'codigo'=>'required|unique:orden_encabezados|max:50',
                'tipo_documento'=>'required',
                'fecha'=>'required',
                'hora'=>'required|',
                'hora_entrega'=>'required' ,
                'cabaña'=>'required',
                'empleado'=>'required',

        ];
    }
    public function messages(): array
    {
        return [
            'codigo.required'=>'El campo :attribute es obligatorio.',
            'codigo.unique'=>'El código ya existe en la base de datos.',
            'codigo.max'=>'El campo :attribute no debe exceder los 50 caracteres.',
            'tipo_documento.required'=>'El campo :attribute es obligatorio.',
            'fecha.required'=>'El campo :attribute es obligatorio.',
            'hora.required'=>'El campo :attribute es obligatorio.',
            'hora_entrega.required'=>'El campo :attribute es obligatorio.',
            'cliente.required'=>'El campo :attribute es obligatorio cuando se aplica cliente.',
            'empleado.required'=>'El campo :attribute es obligatorio.',
            'cabaña.required'=>'El campo :attribute es obligatorio cuando no se aplica cliente.',
        ];
    }
    public function attributes(): array
    {
        return [
            'codigo'=>'código',
            'tipo_documento'=>'tipo de documento',
            'fecha'=>'fecha',
            'hora'=>'hora',
            'hora_entrega'=>'hora de entrega',
            'cliente'=>'cliente',
            'empleado'=>'empleado',
            'cabaña'=>'mesa',
        ];
    }
}
