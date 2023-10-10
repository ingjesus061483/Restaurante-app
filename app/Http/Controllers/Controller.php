<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function autorizar(User $user){
        if($user->role_id==1||$user->role_id==2)
        {
            return true;
        }
    }
    public function EstaLogueado()
    {
        $logueado=false;
        if(Auth::check())
        {
            $logueado=true;
        }
        return $logueado;      
    }
  
}
