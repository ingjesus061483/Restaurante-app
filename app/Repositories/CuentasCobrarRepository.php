<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\CuentasCobrar;

class CuentasCobrarRepository implements IRepository{
    private DetalleCuentasCobrarRepository $_detalleCuentasCobrarRepository;
    public function __construct(DetalleCuentasCobrarRepository $detalleCuentasCobrarRepository) {
        $this->_detalleCuentasCobrarRepository = $detalleCuentasCobrarRepository;            
    }
    function GetCuentasCobrarByCliente()
    {
        return CuentasCobrar::selectRaw('cuentas_cobrars.*,orden_encabezados.codigo ,tipo_cobros.nombre as tipo_cobro')
                     ->join('orden_encabezados','orden_encabezados.id','=','cuentas_cobrars.orden_id')
                     ->join('clientes','clientes.id','=','orden_encabezados.cliente_id')
                     ->join('tipo_cobros','tipo_cobros.id','=','cuentas_cobrars.tipo_cobro_id');

    }
    function GetCuentasCobrarByOrdenServicio($orden_id)
    {
        return CuentasCobrar::where('orden_id',$orden_id)->first();
    }
    function  GetAll()
    {
        return CuentasCobrar::all();
    }
    function Find($id)
    {
        return CuentasCobrar::find($id);
        
    }
    function Store($request)
    {
        $cuentaCobrar=CuentasCobrar::create([
                                    "orden_id" => $request->orden_id,
                                    "fecha" => $request->fecha,                                    
                                    "tiempo" => $request->tiempo,                                     
                                    "monto" => $request->monto,                                       
                                    "interes" => $request->interes,                                    
                                    "tipo_cobro_id" => $request->tipo_cobro
                                ]);
        $detalleCuentaCobrar=(object)["fecha"=>$cuentaCobrar->fecha,"valor"=>$request->valorRecibido,
                                      "cuenta_cobrar_id"=>$cuentaCobrar->id];
        $this->_detalleCuentasCobrarRepository->Store($detalleCuentaCobrar);        
    }
    function Update($id, $request)
    {
        
    }
    function Delete($id)
    {
        
    }
}