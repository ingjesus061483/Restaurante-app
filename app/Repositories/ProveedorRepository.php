<?php
namespace App\Repositories;
use App\Contracts\IRepository;
use App\Models\Proveedor;

class ProveedorRepository implements IRepository
{
    public function getAll()
    {
         return Proveedor::all(); 
    }
    public function Store($request)
    {
        $proveedor=new Proveedor();
        $proveedor->identificacion=$request->identificacion;
        $proveedor->nombre=$request->nombre;
        $proveedor->direccion=$request->direccion;
        $proveedor->telefono=$request->telefono;
        $proveedor->email=$request->email;
        $proveedor->save();
    }
    public function Find($id)
    {
        return Proveedor::Find($id);
        
    }
    public function Update($id, $request)
    {
        $proveedor=$this->find($id);
        $proveedor->identificacion=$request->identificacion;
        $proveedor->nombre=$request->nombre;
        $proveedor->direccion=$request->direccion;
        $proveedor->telefono=$request->telefono;
        $proveedor->email=$request->email;
        $proveedor->save();
    }
    public function delete($id)
    {
        $prov=$this->Find($id);
        $prov->delete($id);
    }


}