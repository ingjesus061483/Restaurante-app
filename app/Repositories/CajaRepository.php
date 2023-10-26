<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Caja;

class CajaRepository implements IRepository{
    protected CajaMovimientoRepository $_cajaMovimientoRepository;
    public function __construct(CajaMovimientoRepository $cajaMovimientoRepository) {
        $this->_cajaMovimientoRepository = $cajaMovimientoRepository;
    }
    public function EsAbierta(Caja $caja)
    {       
        return $caja->abierta==1?true:false;
    }
    public function Abrir($id)
    {
        $caja=$this->Find($id);
        $caja->abierta=1;
        $caja->save();
    }
    public function Cerrar($id)
    {
        $caja=$this->Find($id);
        $caja->abierta=0;
        $caja->save();
    }
    public function GetAll()
    {
        return Caja::all();
    }
    public function Find($id)
    {
        return Caja::find($id);
    }
    public function Store($request)
    {
        $caja= Caja::Create([
            'codigo'=>$request->codigo,
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
            'valor_inicial'=>$request->valor_inicial
        ]);
        $CajaMovimiento=(object)['fecha_hora'=>date("Y-m-d H:i:s"),
                'concepto'=>'ingreso inicial',                
                'valor'=>$caja->valor_inicial,                
                'ingreso'=>1,
                'caja_id'=>$caja->id
            ];
        $this->_cajaMovimientoRepository->Store($CajaMovimiento);

    }
    public function Update($id, $request)
    {
        $caja=$this->Find($id);
        $caja->codigo=$request->codigo;
        $caja->nombre=$request->nombre;
        $caja->descripcion=$request->descripcion;
        $caja->valor_inicial=$request->valor_inicial;
        $caja->save();
    }
    public function Delete($id)
    {
        $caja=$this->Find($id);
        $caja->delete();
    }
}