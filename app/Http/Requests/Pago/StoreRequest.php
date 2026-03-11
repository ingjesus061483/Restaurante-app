<?php

namespace App\Http\Requests\Pago;

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
            'codigo'=>'required|unique:pagos|max:50',
            'fecha_hora'=>'required|max:255|min:3',
            'subtotal'=>'required|numeric',
            'impuesto'=>'required|numeric',
            'descuento'=>'required|numeric',
            'total_pagar'=>'required|numeric',
            //
        ];
    }
    public function messages()
    {
        return [
            'codigo.required'=>'El campo :attribute es obligatorio',
            'codigo.unique'=>'El campo :attribute ya existe',
            'codigo.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'fecha_hora.required'=>'El campo :attribute es obligatorio',
            'fecha_hora.max'=>'El campo :attribute no debe ser mayor a 255 caracteres',
            'fecha_hora.min'=>'El campo :attribute no debe ser menor a 3 caracteres',
            'subtotal.required'=>'El campo :attribute es obligatorio',
            'subtotal.numeric'=>'El campo :attribute debe ser un numero',
            'impuesto.required'=>'El campo :attribute es obligatorio',
            'impuesto.numeric'=>'El campo :attribute debe ser un numero',
            'descuento.required'=>'El campo :attribute es obligatorio',
            'descuento.numeric'=>'El campo :attribute debe ser un numero',
            'total_pagar.required'=>'El campo :attribute es obligatorio',
            'total_pagar.numeric'=>'El campo :attribute debe ser un numero'
        ];
    }
    public function attributes()
    {
        return [
            'codigo'=>'Codigo',
            'fecha_hora'=>'Fecha y Hora',
            'subtotal'=>'Subtotal',
            'impuesto'=>'Impuesto',
            'descuento'=>'Descuento',
            'total_pagar'=>'Total a Pagar'
        ];
    }
}
