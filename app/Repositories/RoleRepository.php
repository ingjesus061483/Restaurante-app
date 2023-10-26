<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Role;

class RoleRepository implements IRepository{
    public function GetAll()
    {
        return Role::all();
    }
    public function Find($id)
    {
        return Role::find($id);
    }
    public function Store($request)
    {
        $role=new Role();
        $role->nombre=$request->nombre;
        $role->descripcion=$request->descripcion;
        $role->save();
    }
    public function Update($id, $request)
    {
        $role= $this->Find($id);
        $role->nombre=$request->nombre;
        $role->descripcion=$request->descripcion;
        $role->save();
    }
    public function Delete($id)
    {
        $role= $this->Find($id);
        $role->delete($id);
    }
}