<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Cabaña;
class CabanaRepository implements IRepository
{
    public function GetAll(){
        return Cabaña::all();
    }
    public function desocuparCabana($id){
        $cabaña=$this->Find($id);
        if ($cabaña!=null)
        {
            $cabaña->ocupado=0;
            $cabaña->update();
        }

    }
    public function GetCabanasDesocupadas(){
       return Cabaña::where('ocupado',0)->get();
    }
    public function ocuparCabaña($id){
        $cabaña=$this->Find($id);     
        if ($cabaña!=null)
        {
            $cabaña->ocupado=1;
            $cabaña->save(); 
        }
    }
    public function Store($request)
    {
        $cabana=new Cabaña();
        $cabana->codigo=$request->codigo;
        $cabana->nombre=$request->nombre;
        $cabana->capacidad_maxima=$request->capacidad;
        $cabana->precio=$request->precio;
        $cabana->descripcion=$request->descripcion;
        $cabana->save();
    }
    public function Find($id){
        return Cabaña::find($id);
    }
    public function Update($id,$request){
        $cabana= $this->Find($id);
        $cabana->codigo=$request->codigo;
        $cabana->nombre=$request->nombre;
        $cabana->capacidad_maxima=$request->capacidad;
        $cabana->precio=$request->precio;
        $cabana->descripcion=$request->descripcion;
        $cabana->save();
    }
    public function Delete($id){
        $cabana= $this->Find($id);
        $cabana->delete();
    }
}