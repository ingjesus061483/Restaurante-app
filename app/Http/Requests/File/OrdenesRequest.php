<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class OrdenesRequest extends FormRequest
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
        return [
            'fechaIni'=>'required',
            'fechaFin'=>'required|after_or_equal:fechaIni',
            //
        ];
    }
    public function messages()
    {
        return [
            'fechaIni.required'=>'El campo :attribute es obligatorio',
            'fechaFin.required'=>'El campo :attribute es obligatorio',
            'fechaFin.after_or_equal'=>'El campo :attribute debe ser una fecha posterior o igual a la fecha de inicio'
        ];
    }
    public function attributes()
    {
        return [
            'fechaIni'=>'Fecha de Inicio',
            'fechaFin'=>'Fecha de Fin'
        ];
    }
}
