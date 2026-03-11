<?php

namespace App\Http\Requests\CuentaCobrar;

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
            'fecha'=>'required',
            'cliente'=>'required',
            'tiempo'=>'required|numeric',
            'monto'=>'required|numeric',
            'interes'=>'required|numeric' ,
            'tipo_cobro'=>  'required',
            'valorRecibido'=>'required|numeric',
            //
        ];
    }
    public function messages()
    {
        return [
            'fecha.required'=>'El campo :attribute es obligatorio',
            'cliente.required'=>'El campo :attribute es obligatorio',
            'tiempo.required'=>'El campo :attribute es obligatorio',
            'tiempo.numeric'=>'El campo :attribute debe ser un numero',
            'monto.required'=>'El campo :attribute es obligatorio',
            'monto.numeric'=>'El campo :attribute debe ser un numero',
            'interes.required'=>'El campo :attribute es obligatorio',
            'interes.numeric'=>'El campo :attribute debe ser un numero',
            'tipo_cobro.required'=>'El campo :attribute es obligatorio',
            'valorRecibido.required'=>'El campo :attribute es obligatorio',
            'valorRecibido.numeric'=>'El campo :attribute debe ser un numero'
        ];
    }
    public function attributes(){
        return [
            'fecha'=>'Fecha',
            'cliente'=>'Cliente',
            'tiempo'=>'Tiempo',
            'monto'=>'Monto',
            'interes'=>'Interes',
            'tipo_cobro'=>'Tipo de cobro',
            'valorRecibido'=>'Valor recibido'
        ];
    }
}
