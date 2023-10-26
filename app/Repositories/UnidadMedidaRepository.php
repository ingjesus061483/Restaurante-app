<?php
namespace App\Repositories;
use App\Contracts\IRepository;
use App\Models\UnidadMedida;
class UnidadMedidaRepository implements IRepository{
    public function GetAll()
    {
        return  UnidadMedida::all();
    } 
    public function Find($id)
    {
        return UnidadMedida::Find($id);
        
    }
    public function Store($request)
    {
        $unidadmedida=new UnidadMedida();
        $unidadmedida->nombre=$request->input('nombre');
        $unidadmedida->descripcion=$request->input('descripcion');
        $unidadmedida->save();    
    }
    public function Update($id, $request)
    {
        $unidadMedida=$this->Find($id);
        $unidadMedida->nombre =$request->input('nombre');
        $unidadMedida->descripcion =$request->input('descripcion');
        $unidadMedida->update();
    }
    public function Delete($id)
    {
        $unidadMedida=$this->Find($id);
        $unidadMedida->delete();
    }

}