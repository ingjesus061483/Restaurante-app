<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Pago;
use App\Models\PagoDetalle;
class PagoRepository implements IRepository{
    protected impuestoRepository $_impuestoRepository;
    protected PagoDetalleRepository $_pagoDetalleRepository ;
    public function __construct(impuestorepository $impuestoRepository ,PagoDetalleRepository $pagoDetalleRepository) 
    {
        $this->_pagoDetalleRepository=$pagoDetalleRepository;
        $this->_impuestoRepository = $impuestoRepository;
    }
    public function TotalesPagos()
    {
        $pagos= $pagos=$this->GetAll();
        $sum=0;
        foreach($pagos as $item){
            $sum=$sum+$item->total_pagar;
        }
        return $sum;
    }
    public function GetbyFormaPago($forma_pago)
    {
        $pagos=Pago::where('forma_pago_id',$forma_pago)->get();
        return $pagos;
    }

    public function GetAll()
    {
        return Pago::All();
    }
    public function Find($id){
        return Pago::find($id);
    }
    public function Store($request){
        $pago= Pago::create ([
            'codigo'=>$request->codigo,
            'fecha_hora'=>$request->fecha_hora,
            'subtotal'=>$request->subtotal,
            'impuesto'=>$request->impuesto,
            'descuento'=>$request->descuento,
            'total_pagar'=>$request->total_pagar,
            'recibido'=>$request->acumulado,
            'cambio'=>-1*$request-> faltante,  
            'observaciones'=>$request->observaciones,
            'orden_id'=>$request->orden_id
        ]);
        $pagoDetalles=session('pagodetalles');
        foreach($pagoDetalles as $item)
        {
            $item->pago_id=$pago->id;
            $this->_pagoDetalleRepository->Store($item);
           
        }

    }
    public function Update($id,$request ){

    }
    public function Delete($id){

    }
  
}