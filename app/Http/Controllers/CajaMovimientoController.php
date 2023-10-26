<?php

namespace App\Http\Controllers;

use App\Models\CajaMovimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCajaMovimientoRequest;
use App\Http\Requests\UpdateCajaMovimientoRequest;
use App\Repositories\CajaMovimientoRepository;
use App\Repositories\CajaRepository;
use Illuminate\Http\Request;

class CajaMovimientoController extends Controller
{
    protected CajaMovimientoRepository $_cajaMovimientoRepository;
    protected CajaRepository $_cajaRepository;
    public function __construct(CajaMovimientoRepository $cajaMovimientoRepository,
                                CajaRepository $cajaRepository)                                
    {
        $this->_cajaMovimientoRepository = $cajaMovimientoRepository;
        $this->_cajaRepository=$cajaRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $caja=$this->_cajaRepository->Find($request->caja_id);
        $total_caja=$request->total_caja-$request->valor;
        if($total_caja<=$caja->valor_inicial)
        {
            $data=[
                'message'=>'',
                'error'=>true
            ];
        }
        else
        {
            $CajaMovimiento=(object)[
                'fecha_hora'=>date("Y-m-d H:i:s"),
                'concepto'=>$request->concepto,
                'valor'=>$request->valor,            
                'ingreso'=>$request->ingreso,
                'caja_id'=>$request->caja_id
            ];
            $this->_cajaMovimientoRepository->Store($CajaMovimiento);
            $data=[
                'message'=>'se ha hecho un movimiento en la caja',
                'error'=>false
            ];

        }
        
        return json_encode($data);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CajaMovimiento $cajaMovimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CajaMovimiento $cajaMovimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCajaMovimientoRequest $request, CajaMovimiento $cajaMovimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CajaMovimiento $cajaMovimiento)
    {
        //
    }
}
