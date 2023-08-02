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
        $user=  User::create([
            'name'=>$request->name,
            'email'=>$request->email,   
            'role_id'=>$request->role,
            'empresa_id'=>$request->empresa,                 
            'password'=>hash::make( $request->password),        
        ]);         
        return $user;        
    }
    public function Find($id)
    {
        return User::find($id);
        
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
        $user->delete();
        
    }
}
