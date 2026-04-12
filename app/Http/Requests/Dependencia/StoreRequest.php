<?php

namespace App\Http\Requests\Dependencia;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'codigo'=>'required|unique:dependencias|max:50',
            'nombre'=>'required|max:255|min:3',
            //
        ];
    }
    public function messages()
    {
        return [
            'codigo.required'=>'El campo :attribute es obligatorio',
            'codigo.unique'=>'El campo :attribute debe ser único',
            'codigo.max'=>'El campo :attribute no debe exceder los 50 caracteres',
            'nombre.required'=>'El campo :attribute es obligatorio',
            'nombre.max'=>'El campo :attribute no debe exceder los 255 caracteres',
            'nombre.min'=>'El campo :attribute debe tener al menos 3 caracteres',
        ];
    }
    public function attributes()
    {
        return [
            'codigo'=>'código',
            'nombre'=>'nombre',
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'codigo'=>strtoupper($this->codigo),
        ]);
    }
    public function failedAuthorization()
    {
            throw new HttpResponseException(response()->redirectTo(url('/UnAutorize'))
        ->with(['error' =>'Esta accion no esta autorizada!',]));
    }
}
