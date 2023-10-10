<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\PagoDetalle;
class PagoDetalleRepository implements IRepository
{
    public function TotalizarPeriodo($forma_pago,$fecha1,$fecha2)
    {
        if($forma_pago==null)
        {
            $pagos= PagoDetalle::select('forma_pago_id','forma_pagos.nombre AS forma_pago')
                               ->selectRaw("SUM(valor_recibido) as Total_valor_recibido")                
                               ->join('forma_pagos', 'pago_detalles.forma_pago_id', '=', 'forma_pagos.id')
                               ->join('pagos','pagos.id','=','pago_detalles.pago_id')            
                               ->whereBetween('pagos.fecha_hora',[$fecha1,$fecha2])
                               ->groupBy('forma_pago_id')
                               ->get();          
        }
        else
        {
            $pagos= PagoDetalle::select('forma_pago_id','forma_pagos.nombre AS forma_pago')
                           ->selectRaw("SUM(valor_recibido) as Total_valor_recibido")                
                           ->join('forma_pagos', 'pago_detalles.forma_pago_id', '=', 'forma_pagos.id')
                           ->join('pagos','pagos.id','=','pago_detalles.pago_id')
                           ->where('forma_pago_id',$forma_pago)
                           ->whereBetween('pagos.fecha_hora',[$fecha1,$fecha2])
                           ->groupBy('forma_pago_id')
                           ->get();          

        }        
        return $pagos;            
    }
    public function Totalizar($forma_pago){
        if($forma_pago!=null)
        {
            $pagos= PagoDetalle::select('forma_pago_id','forma_pagos.nombre AS forma_pago')
                           ->selectRaw("SUM(valor_recibido) as Total_valor_recibido")                
                           ->join('forma_pagos', 'pago_detalles.forma_pago_id', '=', 'forma_pagos.id')
                           ->where('forma_pago_id',$forma_pago)
                           ->groupBy('forma_pago_id')
                           ->get();         
        }
        else
        {
            $pagos= PagoDetalle::select('forma_pago_id','forma_pagos.nombre AS forma_pago')
                           ->selectRaw("SUM(valor_recibido) as Total_valor_recibido")                
                           ->join('forma_pagos', 'pago_detalles.forma_pago_id', '=', 'forma_pagos.id')                           
                           ->groupBy('forma_pago_id')
                           ->get();          
        }        
        return $pagos;            
    }
    public function GetAll()
    {
       return PagoDetalle::all();
    }
    public function Find($id)
    {
        return PagoDetalle::find($id);
    }
    public function Store($request)
    {
        $pagoDetalle=new PagoDetalle();
        $pagoDetalle->detalle_pago=$request->detalle_pago;
        $pagoDetalle->valor_recibido=$request->valor_recibido;
        $pagoDetalle->forma_pago_id=$request->forma_pago_id;
        $pagoDetalle->pago_id =$request->pago_id;
        $pagoDetalle-> save();   
    }
    public function Update($id, $request)
    {
        
    }
    public function Delete($id)
    {
        
    }

}