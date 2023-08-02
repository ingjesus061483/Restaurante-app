<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Impuesto;

class ImpuestoRepository implements IRepository{
    public function CalcularImpuestos($subtotal)
    {
        $impuestos =$this->GetAll();
        $sum=0;
        foreach($impuestos as $item){
            $impuesto=$subtotal*($item->valor/100);
            $sum=$sum+$impuesto;
        }
        return $sum;
    }
    public function GetAll()
{
    return Impuesto::all();
    
}
public function Find($id)
{
    return Impuesto::find($id);
}
public function Store($request)
{
    $impuesto=new Impuesto();
    $impuesto->nombre=$request->input('nombre');
    $impuesto->valor=$request->input('valor');
    $impuesto->descripcion=$request->input('descripcion');
    $impuesto->save();

}
public function Update($id, $request)
{
    $impuesto =$this->Find($id);
    $impuesto->nombre=$request->input('nombre');
    $impuesto->valor=$request->input('valor');
    $impuesto->descripcion=$request->input('descripcion');
    $impuesto->save();    
}
public function Delete($id)
{
    $impuesto =$this->Find($id);
    $impuesto->delete();
    
}
}