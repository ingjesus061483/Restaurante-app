<?php
namespace App\Repositories;
use App\Contracts\IRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserRepository implements IRepository
{
    public function GetAll()
    {
        return User::all();
    }
    public function Store($request)
    {
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,   
            'role_id'=>property_exists($request, "role")? $request->role:null,
            'empresa_id'=>$request->empresa,                 
            'caja_id'=>property_exists($request,"caja")?$request->caja:null,
            'password'=>hash::make( $request->password),        
        ]);         
        return $user;        
    }
    public function Find($id)
    {
        return User::find($id);        
    }
    public function ActivarSesion($id, $sesion)
    {
        $user=User::find($id);
        $user->sesion=$sesion;
        $user->save();
    }
    public function UsersAdmin()
    {
        $users=User::where('role_id',2)->get();
        return $users;
    }
    public function Update($id, $request)
    {
        $user=User::find($id);
        $user->password=Hash::make($request->password);
        $user->save();
    }
    public function Delete($id)
    {
        $user=User::find($id);
        if($user->sesion==1)
        {
            $user =null;
           return back()->withErrors('Esta sesion se encuemtra activa');
        }       
        $user->delete();        
    }
}
