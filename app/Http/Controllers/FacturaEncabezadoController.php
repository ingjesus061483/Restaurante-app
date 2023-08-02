<?php

namespace App\Http\Controllers;

use App\Models\FacturaEncabezado;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacturaEncabezadoRequest;
use App\Http\Requests\UpdateFacturaEncabezadoRequest;
use App\Models\OrdenEncabezado;
use App\Repositories\FacturaRepository;
use App\Repositories\FormaPagoRepository;
use App\Repositories\OrdenServicioRepository;
use App\Repositories\TipoDocumentoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturaEncabezadoController extends Controller
{
    protected FormaPagoRepository $_formapagoRepository;
    protected OrdenServicioRepository $_ordenServicioRepository;
    protected FacturaRepository $_facturaRepository;
    protected TipoDocumentoRepository $_tipodocumentoRepository;
    public function __construct(OrdenServicioRepository $ordenServicioRepository,
                                TipoDocumentoRepository $tipoDocumentoRepository,
                                FacturaRepository $facturaRepository,
                                FormaPagoRepository $formaPagoRepository
                                ){
                            
        $this->_tipodocumentoRepository=$tipoDocumentoRepository;                                    
        $this-> _formapagoRepository=$formaPagoRepository;
        $this->_facturaRepository=$facturaRepository;
        $this->_ordenServicioRepository = $ordenServicioRepository;
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
        if(!Auth::check())
        {
            return redirect()->to('login');
        }                           
        $id=request()->input('id');   

        if($id!=null){
            $orden=$this->_ordenServicioRepository->Find($id);
            $orden_detalle=$orden->orden_detalles;
            $subtotal=$this->_ordenServicioRepository->totalizarOrden($orden_detalle);            
            $total_impuesto=$this->_facturaRepository->CalcularImpuestos($subtotal);                        
            $totalPagar=$subtotal+$total_impuesto;            
            $data=[
                'orden_detalle'=>$orden_detalle,  
                'tipo_documento'=>$this->_tipodocumentoRepository->GetAll(),
                'forma_pago'       =>$this->_formapagoRepository->GetAll(),
                'orden_encabezado'=>$orden,                
                'subtotal'=>$subtotal,                
                'total_impuestos'=>$total_impuesto,                
                'totalPagar'=>$totalPagar,
                'es_orden'=>1
            
            ];
        }
        else
        {
            $data=[
                'orden_detalle'=>[],                
                'orden_encabezado'=>null,                
                'subtotal'=>0,                
                'total_impuestos'=>0,                
                'totalPagar'=>0
            
            ];
        }
        return view('facturacion.create',$data);


        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        print_r($request->all());

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FacturaEncabezado $facturaEncabezado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FacturaEncabezado $facturaEncabezado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturaEncabezadoRequest $request, FacturaEncabezado $facturaEncabezado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacturaEncabezado $facturaEncabezado)
    {
        //
    }
}
