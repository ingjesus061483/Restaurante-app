<?php
namespace App\Repositories;
use App\Contracts\IRepository;
use App\Models\FormaPago;
class FormaPagoRepository implements IRepository{
    public function GetAll()
    {
        return FormaPago::all();
    }
    public function Find($id)
    {
        return FormaPago::find($id);
    }
    public function Store($request)
    {
        $formapago=new FormaPago();
        $formapago->nombre=$request->nombre;
        $formapago->descripcion=$request->descripcion;
        $formapago->save();        
    }
    public function Update($id, $request)
    {
        $formapago= $this->Find($id);
        $formapago->nombre =$request->nombre;
        $formapago->descripcion =$request->descripcion;
        $formapago->update();
    }
    public function Delete($id)
    {
        $formapago= $this->Find($id);
        $formapago->delete();
    }
}
