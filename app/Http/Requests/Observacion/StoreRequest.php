<?php

namespace App\Http\Requests\Observacion;

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
            'codigo'=>'required|max:50|unique:observacions',
            'descripcion'=>'required'
            //
        ];
    }
    public function messages()
    {
        return [
            'codigo.required'=>'El campo :attribute es obligatorio',
            'codigo.max'=>'El campo :attribute no debe ser mayor a 50 caracteres',
            'codigo.unique'=>'El campo :attribute ya existe',
            'descripcion.required'=>'El campo :attribute es obligatorio'
        ];
    }
    public function attributes()
    {
        return [
            'codigo'=>'Codigo',
            'descripcion'=>'Descripcion'
        ];
    }
}
