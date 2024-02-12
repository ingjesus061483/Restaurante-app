<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Categoria;

class CategoriaRepository implements IRepository
{
    public function GetAll()
    {
        return Categoria::all();        
    }
    public function Find($id)
    {
        return Categoria::find($id);
    }
    public function Store($request)
    {
        $categoria=new Categoria();
        $categoria->nombre=$request->nombre;
        $categoria->descripcion=$request->descripcion;
        $categoria->save();
    }
    public function Update($id, $request)
    {
        $categoria= $this->Find($id);
        $categoria->nombre =$request->nombre;
        $categoria->descripcion =$request->descripcion;
        $categoria->update();
    }
    public function Delete($id)
    {
        $categoria= $this->Find($id);
        $categoria->delete();
    }    
}