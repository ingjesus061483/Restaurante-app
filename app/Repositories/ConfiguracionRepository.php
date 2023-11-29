<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Configuracion;

class ConfiguracionRepository implements IRepository{
    public function getConfigByNombre($nombre)
    {
      return Configuracion::where ('nombre',$nombre)->first();
    }
    public function GetAll()
    {
      return Configuracion::all();
    }
    public function Find($id)
    {
       return Configuracion::find($id);
    }
    public function Store($request)
    {
        
    }
    public function Update($id, $request)
    {
        $configuracion =$this->Find($id);
        $configuracion->nombre =$request->nombre;
        $configuracion->valor=$request ->valor;
        $configuracion->Update();        
    }
    public function Delete($id)
    {
        
    }
}