<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\models\Pago;
class PagoRepository implements IRepository{
    protected impuestoRepository $_impuestoRepository;
    public function __construct(impuestorepository $impuestoRepository = null) {
        $this->_impuestoRepository = $impuestoRepository;
    }
    
    public function GetAll()
    {
        return Pago::All();
    }
    public function Find($id){
        return Pago::find($id);
    }
    public function Store($request){
        $pago=new Pago();
        $pago->codigo=$request->codigo;
        $pago->fecha_hora=$request->fecha_hora;
        $pago->  subtotal=$request->subtotal;
        $pago->  impuesto =$request->impuesto;
        $pago-> descuento =$request->descuento;
        $pago-> total_pagar=$request->total_pagar;
        $pago->recibido=$request->recibido;
        $pago->  cambio =$request-> cambio;
        $pago->  observaciones =$request->observaciones;
        $pago-> orden_id=$request->orden_id;
        $pago->  forma_pago_id =$request->forma_pago;
        $pago->save();

    }
    public function Update($id,$request ){

    }
    public function Delete($id){

    }
  
}