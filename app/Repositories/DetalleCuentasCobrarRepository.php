<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\CuentasCobrarDetalles;

class DetalleCuentasCobrarRepository implements IRepository
{
    function TotalizarDetallesCreditos($detalles){
        $sum=0;
        foreach($detalles as $item){
            $sum=$item->valor;
        }
        return $sum;
    }
    
    function  GetAll()
    {
        return CuentasCobrarDetalles::all();
    }
    function Find($id)
    {
        
    }
    function Store($request)
    {
        $detalleCuentaCobrar=new CuentasCobrarDetalles();
        $detalleCuentaCobrar->fecha=$request->fecha;
        $detalleCuentaCobrar->valor=$request->valor;
        $detalleCuentaCobrar->cuenta_cobrar_id=$request->cuenta_cobrar_id;
        $detalleCuentaCobrar->save();

        
    }
    function Update($id, $request)
    {
        
    }
    function Delete($id)
    {
        
    }

}