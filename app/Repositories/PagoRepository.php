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
    function acumular($pagoDetalles,&$acum)
    {
        
        foreach($pagoDetalles as $item)
        {
            $acum=$acum+ $item->valor_recibido;                   
        }
    }
    public function valorRecibido($pagos)
    {
        $sum=0;
        foreach ($pagos as $item)
        {
            $sum=$sum+$item->recibido;
        }
        return $sum;
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
    function GetDate($request,&$fechaini,&$fechafin)
    {
        if($request->fechaIni==null)
        {
            $fechaini=date_create();
            date_add($fechaini, date_interval_create_from_date_string('-1 days'));
        }
        else
        {
            $fechaini=date_create($request->fechaIni);
        }
        $fechafin=$request->fechaFin!=null ?date_create( $request->fechaFin):date_create();
        return $fechaini>$fechafin;
    }
    public function GetAll()
    {  
        $fecha1 = date_create();        
        date_add($fecha1, date_interval_create_from_date_string('-1 days'));
        $fecha2=date_create();        
        return Pago::wherebetween('fecha_hora',[date_format($fecha1,'Y-m-d'),
                                   date_format($fecha2,'Y-m-d')])
                                 ->orderby('id','Desc') 
                                 ->get();
    }
    public function getPagosbyDate($fechaini,$fechaFin){
        return Pago::wherebetween('fecha_hora',[$fechaini,
        $fechaFin])
      ->orderby('id','Desc') 
      ->get();
    }
    public function Find($id){
        return Pago::find($id);
    }
    public function Store($request){
       // print_r($request->all());
      // exit();
        $pago= Pago::create ([
            'codigo'=>$request->codigo,
            'fecha_hora'=>$request->fecha_hora,
            'subtotal'=>$request->subtotal,
            'impuesto'=>$request->impuesto,
            'descuento'=>$request->descuento,
            'total_pagar'=>$request->total_pagar,
            'servicio_voluntario'=>$request->serviciovol==null?0:$request->serviciovol,
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