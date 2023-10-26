<?php
namespace App\Repositories;
use App\Contracts\IRepository;
use App\Models\Observacion;
class ObservacionRepository implements IRepository{
    public function GetObservacions($codigo)
    {
        return Observacion::where('codigo',$codigo) ->get();
    }
    public function GetAll()
    {
        return  Observacion::all();
    }
    public function Find($id)
    {
        return Observacion::find($id);        
    }
    public function Store($request)
    {
        $observacion=new Observacion();
        $observacion->codigo=$request->codigo;
        $observacion->descripcion=$request->descripcion;
        $observacion->save();
    }
    public function Update($id, $request)
    {
        $observacion=$this->Find($id);
        $observacion->codigo=$request->codigo;
        $observacion->descripcion=$request->descripcion;
        $observacion->save();
    }
    public function Delete($id)
    {
        $observacion=$this->Find($id);
        $observacion->delete();
    }
}