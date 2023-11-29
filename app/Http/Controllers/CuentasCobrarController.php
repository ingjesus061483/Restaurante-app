<?php

namespace App\Http\Controllers;

use App\Models\CuentasCobrar;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCuentasCobrarRequest;
use App\Http\Requests\UpdateCuentasCobrarRequest;
use App\Repositories\ConfiguracionRepository;
use App\Repositories\CuentasCobrarRepository;
use App\Repositories\DetalleCuentasCobrarRepository;
use App\Repositories\OrdenServicioRepository;
use App\Repositories\TipoCobroRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CuentasCobrarController extends Controller
{
    private OrdenServicioRepository $_ordenservicioRepository;
    private TipoCobroRepository $_tipoCobroRepository;
    private CuentasCobrarRepository $_CuentasCobrarRepository;
    private ConfiguracionRepository $_ConfiguracionRepository;
    private DetalleCuentasCobrarRepository $_DetalleCuentasCobrarRepository;
    public function __construct(OrdenServicioRepository $ordenServicioRepository,
                                TipoCobroRepository $tipoCobroRepository,
                                CuentasCobrarRepository $cuentasCobrarRepository,
                                ConfiguracionRepository $configuracionRepository,
                                DetalleCuentasCobrarRepository $detalleCuentasCobrarRepository)
    {
        $this->_DetalleCuentasCobrarRepository=$detalleCuentasCobrarRepository;
        $this->_ConfiguracionRepository=$configuracionRepository;
        $this->_CuentasCobrarRepository=$cuentasCobrarRepository;
        $this->_tipoCobroRepository=$tipoCobroRepository;        
        $this->_ordenservicioRepository = $ordenServicioRepository;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }           
        if(session()->has('cuentascobrar'))
        {
            redirect()->to(url('/cuentascobrar/create'));
        }
        $identificacion=request()->cliente;   
        $cuentasCobrar=$identificacion==null? $this->_CuentasCobrarRepository->
                                                     GetCuentasCobrarByCliente()->
                                                     get():
                                                     $this->_CuentasCobrarRepository->
                                                     GetCuentasCobrarByCliente()->
                                                     where('clientes.identificacion',$identificacion)->
                                                     get();        
        $data=["cuentasCobrar"=>$cuentasCobrar ];        
        return view("CuentasCobrar.index",$data);
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
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }     
        if(!session()->has('cuentascobrar'))
        {
            return redirect()->to(url('/ordenservicio'))->withErrors("No hay pagos disponibles");
        }
        $credito=session('cuentascobrar');
        $ordenServicio=$this->_ordenservicioRepository->Find($credito->orden_id);
        $valorRecibido=$credito->valor_recibido;
        $cliente =$ordenServicio->cliente;
        $configuracion=$this->_ConfiguracionRepository->getConfigByNombre('interes');        
        $monto=$ordenServicio->total;
        $interes=$configuracion->valor *$monto;
        $data=[
            "orden_id"=>$ordenServicio->id,
            "valorRecibido"=>$valorRecibido,
            "interes"=>$interes,
            "cliente"=> $cliente ,
            "monto"=>  $monto,
            "tipoCobro"=>$this->_tipoCobroRepository->GetAll()
        ];
        return view("CuentasCobrar.create",$data);             
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }   
        $validacion=$request->validate(
            ['fecha'=>'required',
            'cliente'=>'required',
            'tiempo'=>'required|numeric',
            'monto'=>'required|numeric',
            'interes'=>'required|numeric' ,
            'tipo_cobro'=>  'required',
            'valorRecibido'=>'required|numeric',
        ]);        
        $this->_ordenservicioRepository->actualizarCliente($request);
        $this->_CuentasCobrarRepository->store($request);
        session()->forget('cuentascobrar');
        return redirect()->to(url('/cuentascobrar'));        
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }   
        $cuentasCobrar=$this->_CuentasCobrarRepository->Find($id);
        $detalleCuentasCobrar=$cuentasCobrar->DetalleCuentaCobrar;      
        $totalizar=$this->_DetalleCuentasCobrarRepository->TotalizarDetallesCreditos($cuentasCobrar->DetalleCuentaCobrar);
        $totaladeudado=$cuentasCobrar->monto+$cuentasCobrar->interes-$totalizar;
        $data=[
            "cuentasCobrar"=>$cuentasCobrar,
            "detalleCuentasCobrar"=>$detalleCuentasCobrar,
            "totalizar"=>$totalizar,        
            "totaladeudado"=>$totaladeudado,
        ];
        return view("CuentasCobrar.show",$data);             






        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CuentasCobrar $cuentasCobrar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCuentasCobrarRequest $request, CuentasCobrar $cuentasCobrar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CuentasCobrar $cuentasCobrar)
    {
        //
    }
}
