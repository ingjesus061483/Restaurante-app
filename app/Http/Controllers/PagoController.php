<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Repositories\CabanaRepository;
use App\Repositories\EmpresaRepository;
use App\Repositories\FormaPagoRepository;
use App\Repositories\ImpuestoRepository;
use App\Repositories\OrdenServicioRepository;
use App\Repositories\PagoRepository;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    protected CabanaRepository $_cabanaRepository;
    protected PagoRepository $_pagoRepository;
    protected FormaPagoRepository $_formapagoRepository;
    protected OrdenServicioRepository $_ordenServicioRepository;
    protected ImpuestoRepository $_impuestoRepository;
    protected EmpresaRepository $_empresaRepository;
    public function __construct(
                                CabanaRepository $cabanaRepository,
                                PagoRepository $pagoRepository,    
                                ImpuestoRepository $impuestoRepository,
                               EmpresaRepository $empresaRepository,
                               FormaPagoRepository $formaPagoRepository,
                               OrdenServicioRepository $ordenServicioRepository)
   {
    $this->_cabanaRepository=$cabanaRepository;
    $this->_pagoRepository=$pagoRepository;
    $this->_formapagoRepository=$formaPagoRepository;
    $this->_empresaRepository=$empresaRepository;
    $this->_impuestoRepository=$impuestoRepository;
    $this->_ordenServicioRepository=$ordenServicioRepository;
    
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
        if(! $this->autorizar($user))        
        {
            return  back();        
        }
        $id=request()->input('id');   
        $pagoDetalles=[];
        if(session()->has('pagodetalles'))
        {
            $pagoDetalles=session('pagodetalles');
        }
        $acum=0;        
        foreach($pagoDetalles as $item)
        {
            $acum=$acum+ $item->valor_recibido;                   
        }
        $empresa= $this->_empresaRepository->Find( $user->empresa_id);        
        $ordenServicio=$this->_ordenServicioRepository->Find($id);        
        $subtotal=$this->_ordenServicioRepository-> totalizarOrden( $ordenServicio->orden_detalles) ;
        $impuesto=0;
        if ($empresa-> tipo_regimen_id==2)
        {
            $impuesto=$this->_impuestoRepository->CalcularImpuestos($subtotal);
        }
        $totalpagar=$subtotal+$impuesto;
        $faltante=$totalpagar-$acum;
        $data=[   
            'forma_pago'=>$this->_formapagoRepository->GetAll(),    
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
        $validacion=$request->validate([
            'codigo'=>'required|unique:pagos|max:50',            
            'fecha_hora'=>'required|max:255|min:3',                        
            'subtotal'=>'required|numeric',                        
            'impuesto'=>'required|numeric',                        
            'descuento'=>'required|numeric',                      
            'total_pagar'=>'required|numeric',                     
        ]);  
        $recibido =$request->input('acumulado');
        $total_pagar= $request->input('total_pagar');
        settype($recibido,"double");
        settype($total_pagar,"double");
        if($total_pagar>$recibido){
            return back()->withErrors('No se ha recibido el mototo total de pago');
        }   
        $ordenServicio=$this->_ordenServicioRepository->Find($request->input('orden_id'));       
        $this->_pagoRepository->Store((object)$request->all());
        $this->_ordenServicioRepository->PagarOrden($ordenServicio->id);
        $cabana_id=$ordenServicio->cabaña==null?0:$ordenServicio->cabaña->id;
        $this->_cabanaRepository->desocuparCabana($cabana_id);
        session()->forget('pagodetalles');
        return redirect()->to(url('/ordenservicio'));  
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
