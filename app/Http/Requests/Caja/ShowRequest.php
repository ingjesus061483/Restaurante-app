<?php

namespace App\Http\Requests\caja;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class ShowRequest extends FormRequest
{
   //  protected $redirectRoute = 'Caja.index';
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
    public function attributes(): array
    {
        return[
            'fechaIni'=>'fecha inicial',
            'fechaFin'=>'fecha fin',

        ];
    }
    public function messages(): array
    {
        return [
            'fechaIni.required'=>'La :attribute es requerida',
            'fechaIni.date'=>'La :attribute debe ser una fecha valida',
            'fechaFin.required'=>'La :attribute es requerida',
            'fechaFin.date'=>'La :attribute debe ser una fecha valida',
            'fechaFin.after_or_equal'=>'La :attribute debe ser una fecha igual o posterior a la fecha inicial',
        ];
    }

    public function prepareForValidation()
    {
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
            'fechaIni'=>date_format($fechaini,"Y-m-d H:i:s"),
            'fechaFin'=>date_format($fechafin,"Y-m-d H:i:s"),
        ]);
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
        ];            //

    }
}
