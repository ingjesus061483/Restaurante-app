<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
class AutorizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user=Auth::user();
       if(!Auth::check())
        {
            return false;
        }
        if($user->role_id==1||$user->role_id==2)
        {
            return true;
        }
        return false;
    }
    protected function failedAuthorization()
    {
        /*if(Auth::chech())
        {
                 return redirect()->to('login');
        }*/


        throw new HttpResponseException(response()->redirectTo(url('/UnAutorize'))
        ->with(['error' =>'Esta accion no esta autorizada!',]));
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
