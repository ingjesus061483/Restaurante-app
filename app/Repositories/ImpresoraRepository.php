<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Impresora;

class ImpresoraRepository implements IRepository
{
    public function GetAll()    
    {
        return Impresora::all();    
    }
    
    public function Store($request)    
    {
        $impresora=new Impresora();        
        $impresora->codigo=$request->codigo;        
        $impresora->nombre=$request->nombre;        
        $impresora->recurso_compartido=$request->recurso_compartido;        
        $impresora->anchura_papel=$request->anchura_papel;
        $impresora->tamaño_fuente=$request->tamaño_fuente;        
        $impresora->descripcion=$request->descripcion;        
        $impresora->save();
    
    }
    function Find($id)
    {
        return  Impresora::find($id);
    }
    function Update($id,$request)
    {
        $impresora=$this->Find($id);        
        $impresora->codigo=$request->codigo;
        $impresora->nombre=$request->nombre;
        $impresora->recurso_compartido=$request->recurso_compartido;
        $impresora->anchura_papel=$request->anchura_papel;
        $impresora->tamaño_fuente=$request->tamaño_fuente;
        $impresora->descripcion=$request->descripcion;
        $impresora->save();
    }
    function Delete($id)
    {
        $impresora =$this->Find($id);
        $impresora->delete();    
    }
}