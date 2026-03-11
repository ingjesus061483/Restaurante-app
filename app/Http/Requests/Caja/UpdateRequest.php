<?php

namespace App\Http\Requests\Caja;

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
        return [
            'codigo'=>'required|max:50|unique:cajas,codigo,'. $this->id,
            'nombre'=>'required|max:50',
            'valor_inicial'=>'required|numeric',
            //
        ];
    }
    public function messages(): array
    {
        return [
            'codigo.required'=>'El :attribute es requerido',
            'codigo.unique'=>'El :attribute  ya existe',
            'codigo.max'=>'El :attribute no debe exceder los 50 caracteres',
            'nombre.required'=>'El :attribute es requerido',
            'nombre.max'=>'El :attribute no debe exceder los 50 caracteres',
            'valor_inicial.required'=>'El :attribute es requerido',
            'valor_inicial.numeric'=>'El :attribute debe ser un numero',
        ];
    }
    public function attributes(): array
    {
        return [
            'codigo'=>'codigo',
            'nombre'=>'nombre',
            'valor_inicial'=>'valor inicial',
        ];
    }
}
