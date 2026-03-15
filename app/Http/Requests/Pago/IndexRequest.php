<?php

namespace App\Http\Requests\Pago;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class IndexRequest extends FormRequest
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
           'fechaIni'=>'required|date',
           'fechaFin'=>'required|date|after_or_equal:fechaIni',
            //
        ];
    }
    public function messages()
    {
        return [
            'fechaIni.required' => 'La :attribute es requerida.',
            'fechaIni.date' => 'La :attribute debe ser una fecha válida.',
            'fechaFin.required' => 'La :attribute es requerida.',
            'fechaFin.date' => 'La :attribute debe ser una fecha válida.',
            'fechaFin.after_or_equal' => 'La :attribute debe ser igual o posterior a la fecha inicial.',
        ];
    }
    public function attributes()
    {
        return [
            'fechaIni' => 'fecha inicial',
            'fechaFin' => 'fecha final',
        ];
    }
     public function prepareForValidation(){
        if($this->fechaIni==null)
        {
            $fechaini=date_create();
            date_add($fechaini, date_interval_create_from_date_string('-1 days'));
        }
        else
        {
            $fechaini=date_create($this->fechaIni);
        }
        $fechafin=$this->fechaFin!=null ?date_create( $this->fechaFin):date_create();
        $this->merge([
            'fechaIni'=>date_format($fechaini,'Y-m-d'),
            'fechaFin'=>date_format($fechafin,'Y-m-d'),
        ]);
    }

}
