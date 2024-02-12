<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\CajaMovimiento;

class CajaMovimientoRepository implements IRepository
{
    public function ValorByIngreso($caja_id,$ingreso=0)
    {
        return CajaMovimiento::selectRaw('SUM(valor)Valor_total')
                             ->where('caja_id',$caja_id)
                             ->where('ingreso',$ingreso)
                             ->groupby('ingreso')
                             ->first();   
    }
    public function GetAll()
    {
        return CajaMovimiento::select('cajas.id','caja_movimientos.fecha_hora','caja_movimientos.concepto',
                                      'caja_movimientos.valor','caja_movimientos.ingreso')
                             ->selectRaw("CONCAT(cajas.codigo,' - ',cajas.nombre)as caja")
                             ->join('cajas', 'caja_movimientos.caja_id', '=', 'cajas.id');        
    }
    public function Find($id)
    {
        return CajaMovimiento::find($id);        
    }
    public function Store($request)
    {
        $CajaMovimiento=new CajaMovimiento();
        $CajaMovimiento->fecha_hora=$request->fecha_hora;
        $CajaMovimiento->concepto=$request->concepto;
        $CajaMovimiento->valor=$request->valor;
        $CajaMovimiento->ingreso=$request->ingreso;    
        $CajaMovimiento->caja_id=$request->caja_id;
        $CajaMovimiento->save();        
    }
    public function Update($id, $request)
    {
        
    }
    public function Delete($id){

    }
}