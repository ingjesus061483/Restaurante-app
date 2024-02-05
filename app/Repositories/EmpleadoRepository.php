<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Empleado;

class EmpleadoRepository implements IRepository
{
    protected UserRepository $_UserRepository;
    public function __construct( UserRepository $userRepository) {
        $this->_UserRepository = $userRepository;
    }
    public function GetEmpleadoByUser($user){
        return Empleado::where('user_id',$user->id)->first();
     }
 
    public function Getempleado($identificacion){
       return Empleado::where('identificacion',$identificacion)->first();
    }
    public function GetAll()
    {
        return Empleado::all();
    }
    public function Find($id)
    {
        return Empleado::find($id);
    }
    public function Store($request)
    {
        $user= $this->_UserRepository->Store($request);
        $empleado=new Empleado();
        $empleado->identificacion=$request->identificacion;
        $empleado->nombre=$request->nombre;
        $empleado->apellido=$request->apellido;
        $empleado->direccion=$request->direccion;
        $empleado->telefono=$request->telefono;
        $empleado->user_id=$user->id;
        $empleado->save();
    }
    public function Update($id, $request)
    {       
        $empleado=$this->Find($id);
        $user=$this->_UserRepository ->find($empleado->user_id);
        $empleado->identificacion=$request->identificacion;
        $empleado->nombre=$request->nombre;
        $empleado->apellido=$request->apellido;
        $empleado->direccion=$request->direccion;
        $empleado->telefono=$request->telefono;
        $empleado->save();
        $user->role_id=$request->role;
        $user->caja_id=$request->caja;
        $user->save();    
    }
    public function Delete($id)
    {
        $empleado=$this->Find($id);        
        $this->_UserRepository->Delete($empleado->user_id);        
    } 
}