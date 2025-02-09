<?php

namespace  App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'identificacion'=>'required|max:50|unique:proveedors,identificacion,'.$this->id,
            'nombre'=>'required|max:50',       
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'email'=>'required|email|max:255',              //
        ];
    }
}
