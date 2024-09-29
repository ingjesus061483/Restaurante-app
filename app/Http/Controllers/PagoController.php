<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Repositories\CabanaRepository;
use App\Repositories\CajaMovimientoRepository;
use App\Repositories\CajaRepository;
use App\Repositories\EmpresaRepository;
use App\Repositories\FormaPagoRepository;
use App\Repositories\ImpuestoRepository;
use App\Repositories\OrdenServicioRepository;
use App\Repositories\PagoRepository;
use App\Repositories\CuentasCobrarRepository;
use App\Repositories\DetalleCuentasCobrarRepository;
use App\Repositories\ConfiguracionRepository;

use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    protected ConfiguracionRepository $_configuracionRepository;
    protected CabanaRepository $_cabanaRepository;
    protected PagoRepository $_pagoRepository;
    protected FormaPagoRepository $_formapagoRepository;
    protected OrdenServicioRepository $_ordenServicioRepository;
    protected ImpuestoRepository $_impuestoRepository;
    protected EmpresaRepository $_empresaRepository;
    protected CajaRepository $_cajaRepository;
    protected CajaMovimientoRepository $_cajaMovimientoRepository;
    protected CuentasCobrarRepository $_cuentasCobrarRepository;
    private DetalleCuentasCobrarRepository $_DetalleCuentasCobrarRepository;
    public function __construct(                                
                                CabanaRepository $cabanaRepository,
                                PagoRepository $pagoRepository,    
                                ImpuestoRepository $impuestoRepository,
                               EmpresaRepository $empresaRepository,
                               FormaPagoRepository $formaPagoRepository,
                               OrdenServicioRepository $ordenServicioRepository,
                               CajaRepository $cajaRepository,
                               CajaMovimientoRepository $cajaMovimientoRepository,
                               CuentasCobrarRepository $cuentasCobrarRepository,
                               DetalleCuentasCobrarRepository $DetalleCuentasCobrarRepository,
                               ConfiguracionRepository $configuracionRepository)                               
    {
        $this->_cabanaRepository=$cabanaRepository;        
        $this->_pagoRepository=$pagoRepository;        
        $this->_formapagoRepository=$formaPagoRepository;        
        $this->_empresaRepository=$empresaRepository;        
        $this->_impuestoRepository=$impuestoRepository;        
        $this->_ordenServicioRepository=$ordenServicioRepository;        
        $this->_cajaRepository=$cajaRepository;                
        $this->_cajaMovimientoRepository=$cajaMovimientoRepository;    
        $this->_cuentasCobrarRepository=$cuentasCobrarRepository ;
        $this->_DetalleCuentasCobrarRepository=$DetalleCuentasCobrarRepository;
        $this->_configuracionRepository= $configuracionRepository;
    }   
    function pagoStore(Request $request,$pagoDetalles,$caja)
    {
        $this->_pagoRepository->Store($request);        
        foreach($pagoDetalles as $item)        
        {            
            if($item->forma_pago_id==1)                        
            {                
                $CajaMovimiento =(object)[                                    
                    "fecha_hora"=>date("Y-m-d H:i:s"),                        
                    "concepto"=>'Ingreso de pago',                     
                    "valor"=>$item->valor_recibido,                    
                    "ingreso"=>1,                                      
                    "caja_id"=>$caja->id                           
                ];                                        
                $this->_cajaMovimientoRepository->Store($CajaMovimiento);                            
            }        
        }            
        session()->forget('pagodetalles');                
        $this->_cajaRepository->Cerrar($caja->id); 
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
        $user=Auth::user();                
        if(! $this->autorizar($user))        
        {
            return  back();        
        }
        $forma_pago=request()->input('forma_pago');
        $pagos=$this->_pagoRepository-> GetAll();
       
        $data=[  
            'forma_pago'=>$this->_formapagoRepository->GetAll(),                         
            'totales'=>$this->_pagoRepository-> TotalesPagos(),
            'pagos'=>$pagos
        ];
        return view('Pagos.index',$data);
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
        $user=Auth::user();                
        $caja=$user->caja;
        if($caja==null){
            return back()->withErrors('El usuario no tiene una caja asignada');
        }
        if(!$this->_cajaRepository->EsAbierta($caja))
        {
            $this->_cajaRepository->Abrir($caja->id);
        }
        $orden_id=request()->input('id');           
        $ordenServicio=$this->_ordenServicioRepository->Find($orden_id);    
        $configuracion=$this->_configuracionRepository -> getConfigByNombre("propina");    
        $acum=0;        
        if($ordenServicio->credito==1)
        {
            $creditos=$ordenServicio->CuentasCobrar;
            $pagos=$ordenServicio->pagos;
            $recibido=$this->_pagoRepository->valorRecibido($pagos);
            $acum=$recibido;
            if(count($creditos)==0&&$recibido>0){
                $credito=(object)["orden_id"=>$ordenServicio->id,"valor_recibido"=>$recibido];
                session(['cuentascobrar' => $credito]);                  
                return redirect()->to(url('/cuentascobrar/create'));                                                                              
            }
        }
        $pagoDetalles=session()->has('pagodetalles')?session('pagodetalles'):[];        
        $this->_pagoRepository-> acumular($pagoDetalles,$acum);
        /*foreach($pagoDetalles as $item)
        {
            $acum=$acum+ $item->valor_recibido;                   
        }*/
        $empresa= $this->_empresaRepository->Find( $user->empresa_id);                
        $subtotal=$this->_ordenServicioRepository-> totalizarOrden( $ordenServicio->orden_detalles) ;
        $impuesto=0;
        if ($empresa-> tipo_regimen_id==2)
        {
            $impuesto=$this->_impuestoRepository->CalcularImpuestos($subtotal);
        }
        $totalpagar=$subtotal+$impuesto;
        $propina=$totalpagar*$configuracion->valor;
        $faltante=$totalpagar-$acum;
        $data=[   
            'forma_pago'=>$this->_formapagoRepository->GetAll(),    
            "propina"=>$propina,
            'ordenServicio'=>$ordenServicio,  
            'orden_detalle'=>   $ordenServicio->orden_detalles,
            'subtotal'=>$subtotal,
            'impuesto'=>$impuesto,            
            'pagoDetalles'=>$pagoDetalles,
            'acumulado'=>$acum,
            'faltante'=>$faltante
        ];
        return view ('Pagos.create',$data);    
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
        $user=Auth::user();                   
        $caja=$user->caja;
        $validacion=$request->validate([
            'codigo'=>'required|unique:pagos|max:50',            
            'fecha_hora'=>'required|max:255|min:3',                        
            'subtotal'=>'required|numeric',                        
            'impuesto'=>'required|numeric',                         
            'descuento'=>'required|numeric',                      
            'total_pagar'=>'required|numeric',                     
        ]);
        $pagoDetalles=session()->has('pagodetalles')?session('pagodetalles'):[];  
        if(count($pagoDetalles)==0)
        {
           return back()->withErrors("Debe crear por lo menos un detalle de pago") ;
        }        
        $recibido =$request->input('acumulado');
        $total_pagar= $request->input('total_pagar');
        settype($recibido,"double");
        settype($total_pagar,"double");
        $ordenServicio=$this->_ordenServicioRepository->Find($request->input('orden_id'));       
        $cabana=$ordenServicio->cabaña!=null?$ordenServicio->cabaña:null;        
        $this->_cabanaRepository->desocuparCabana($cabana);                
        if($ordenServicio->credito==0)
        {
            if($total_pagar>$recibido)
            {
                return back()->withErrors('No se ha recibido el monto total de pago');
            }                   
            $this->pagoStore($request,$pagoDetalles ,$caja);       
            $this->_ordenServicioRepository->PagarOrden($ordenServicio->id);    
            $this->_ordenServicioRepository-> ActualizarTotalPagarOrdenservicio($ordenServicio-> id);        
            return redirect()->to(url("/reportes/printordenservicio/$ordenServicio->id"));  
        }
        else
        {
            $cuentasCobrar=$this->_cuentasCobrarRepository->GetCuentasCobrarByOrdenServicio($ordenServicio->id);
            if($cuentasCobrar==null)
            { 
                $this->pagoStore($request,$pagoDetalles,$caja);            
                $credito=(object)["orden_id"=>$ordenServicio->id,"valor_recibido"=>$recibido];
                session(['cuentascobrar' => $credito]);  
                $this->_ordenServicioRepository->AcreditarOrden($ordenServicio->id);
                $this->_ordenServicioRepository-> ActualizarTotalPagarOrdenservicio($ordenServicio->id);        
                return redirect()->to(url('/cuentascobrar/create'));                                                                              
            }
            else
            {
                $this->pagoStore($request,$pagoDetalles,$caja);                   
                $credito=(object)["orden_id"=>$ordenServicio->id,"valor_recibido"=>$recibido];                              
                $this->_DetalleCuentasCobrarRepository->store($credito);
                $creditodetalles=$cuentasCobrar->DetalleCuentaCobrar;
                $totalpagdoCredito=$this->_DetalleCuentasCobrarRepository->TotalizarDetallesCreditos($creditodetalles);
                $montointeres=$cuentasCobrar->monto+ $cuentasCobrar->interes;
                if($totalpagdoCredito==$montointeres)
                {
                    $this->_ordenServicioRepository->PagarOrden($ordenServicio->id);            
                    return redirect()->to(url('/ordenservicio'));                                                                                                                                                                              
                }
                else
                {
                    return redirect()->to(url("/cuentascobrar/$cuentasCobrar->id"));                  
                }               
            }           
        }
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
      
        $user=Auth::user();                
        if(! $this->autorizar($user))        
        {
            return  back();        
        }
     
        $pago=     $this->_pagoRepository->Find($id);
        $data =[
           'pagosdetalles'=> $pago->pago_detalle,
          
        ];
        return view('Pagos.show',$data);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
