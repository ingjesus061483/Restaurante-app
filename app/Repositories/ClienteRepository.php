<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Cliente;

class ClienteRepository implements IRepository{
    protected UserRepository $_UserRepository;
    public function __construct( UserRepository $userRepository) {
        $this->_UserRepository = $userRepository;
    }
    public function GetclienteByUser($user){
        return Cliente::where('user_id',$user->id)->first();
     }
 
    public function Getcliente($identificacion){
       return Cliente::where('identificacion',$identificacion)->first();
    }

    public function GetAll()
    {
        return Cliente::all();
    }
    public function Store( $request)
    {  
        $user=$this->_UserRepository->Store($request);
        $cliente=new Cliente();
        $cliente->identificacion=$request->identificacion;
        $cliente->nombre=$request->nombre;
        $cliente->apellido=$request->apellido;
        $cliente->direccion=$request->direccion;
        $cliente->telefono=$request->telefono;
        $cliente->user_id=$user->id;
        $cliente->save();       
    }
    public function Find($id)
    {
        return Cliente::find($id);
    }
    public function Update($id, $request)
    {
        $cliente=Cliente::find($id);        
        $cliente->identificacion=$request->identificacion;
        $cliente->nombre=$request->nombre;
        $cliente->apellido=$request->apellido;
        $cliente->direccion=$request->direccion;
        $cliente->telefono=$request->telefono;
        $cliente->save();        
    }
    public function Delete($id)
    {
        $cliente=$this->Find($id);
        $this-> _UserRepository->Delete($cliente->user_id);
     
    }
}