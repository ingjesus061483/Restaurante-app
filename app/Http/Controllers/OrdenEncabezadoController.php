<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\OrdenEncabezado;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrdenEncabezadoRequest;
use App\Http\Requests\UpdateOrdenEncabezadoRequest;
use App\Repositories\CabanaRepository;
use App\Repositories\ClienteRepository;
use App\Repositories\EmpleadoRepository;
use App\Repositories\OrdenServicioRepository;
use App\Repositories\TipoDocumentoRepository;
use Illuminate\Support\Facades\Auth;
class OrdenEncabezadoController extends Controller
{
    protected TipoDocumentoRepository $_tipoDocumentoRepository;
    protected OrdenServicioRepository $_ordenServicioRepository;
    protected EmpleadoRepository $_empleadoRepository;
    protected CabanaRepository $_cabanaRepository;
    protected ClienteRepository $_clienteRepository;
    public function __construct(CabanaRepository $cabanaRepository,
                                TipoDocumentoRepository $tipoDocumentoRepository,
                                OrdenServicioRepository $ordenServicioRepository,
                                ClienteRepository $clienteRepository,
                                EmpleadoRepository $empleadoRepository)                                 
    {
        $this->_tipoDocumentoRepository=$tipoDocumentoRepository;
        $this->_cabanaRepository = $cabanaRepository;
        $this->_ordenServicioRepository=$ordenServicioRepository;
        $this->_clienteRepository=$clienteRepository;
        $this->_empleadoRepository=$empleadoRepository;
       
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
        if (session()->has('detalles'))
        {
          return  redirect()->to('ordendetalles');
        }    
        $user=Auth::user();
        if($user->role_id==3)
        {
            $ordenes=$this->_ordenServicioRepository-> GetOrdenesByEmpleados($user->id);
        }
        else
        {
            $ordenes=$this->_ordenServicioRepository->GetAll();            
        }
        $data=[
            'ordenes'=>$ordenes           
        ];
        return view('Orden.index',$data);
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
        if(!session()->has('detalles')){
            return back()->withErrors('Escoje un producto antes de ordenar!');
        }
        $cabañas=$this->_cabanaRepository->GetCabanasDesocupadas();    
        $cabana=null;
        if(session()->has('cabana'))
        {    
            $cabana=session('cabana');
        }
        /*if(count($cabañas)==0)
        {
            return back()->withErrors('No hay cabañas disponibles en en elmomento!');
        }*/
        $detalles=session('detalles');
        $errors=$this->_ordenServicioRepository->ComprobarExistenciaProductoDetalle($detalles);
        if (count($errors)>0){
            return back()->withErrors($errors);
        }
        $tiempoCoccion=$this->_ordenServicioRepository-> GetTiempoCoccion($detalles);        
        $now=date_create();        
        date_add($now,date_interval_create_from_date_string($tiempoCoccion.' minutes'));     
        $time=date_format($now, 'H:i:s');
        $user=Auth::user();
        $empleado=$this->_empleadoRepository->GetEmpleadoByUser($user);
        $cliente=$this->_clienteRepository->GetclienteByUser($user);
        $data=[
            'tipo_documento'=>$this->_tipoDocumentoRepository->GetAll(),   
            'cabañas'=>$cabañas,  
            'cabana'=>$cabana,
            'tiempo_entrega'=>$time,          
            'empleado'=>$empleado,
            'cliente'=>$cliente,
            'orden_detalle'=>$detalles
        ];
        return view('Orden.create',$data);
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
        $aplicaCliente=$request->input('aplicaCliente')!=null?(bool)$request->input('aplicaCliente'):0;        
        if($aplicaCliente)
        {
            $validate=$request->validate([
                'codigo'=>'required|unique:orden_encabezados|max:50',  
                'tipo_documento'=>'required',                                    
                'fecha'=>'required',            
                'hora'=>'required|',            
                'hora_entrega'=>'required' ,            
                'cliente'=>'required',
                'empleado'=>'required',
            ]);
        }
        else
        {
            $validate=$request->validate([
                'codigo'=>'required|unique:orden_encabezados|max:50',                                      
                'tipo_documento'=>'required',
                'fecha'=>'required',            
                'hora'=>'required|',            
                'hora_entrega'=>'required' ,            
                'cabaña'=>'required',
                'empleado'=>'required',
            ]);
        }          
        if(!session()->has('detalles'))
        {
            return back()->withErrors('No hay detalles de ordenes disponibles');
        } 
        $orden =$this->_ordenServicioRepository->BuscarOrdenCliente($request); 
        if($orden!=null)
        {
            return back()->withErrors('El cliente ya tiene un orden en espera asociada a el');
        }
        $id=$this->_ordenServicioRepository->Store($request);
        session()->forget('detalles');        
        if(session()->has('cabana')) 
        {
            session()->forget('cabana');
        }
        return redirect()->to(url("/reportes/printComanda/$id"));            
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
        $ordenEncabezado=$this->_ordenServicioRepository-> Find($id);
        $OrdenDetalles=$ordenEncabezado->orden_detalles;
        $data=[
            'ordenEncabezado'=>$ordenEncabezado,
            'orden_detalle'=>$OrdenDetalles,
        ];
        return view ('Orden.show',$data);        
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdenEncabezado $ordenEncabezado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }       
        $ordenEncabezado=$this->_ordenServicioRepository ->Find($id);
        $fechahora_entrega =$ordenEncabezado->fecha.' '.$ordenEncabezado->hora_entrega;
        $tiempo_entrega= date_timestamp_get(date_create($fechahora_entrega));        
        $now=date_create();
        $string_date= date_format($now,'Y-m-d H:i:s');
        $tiempo_ahora=date_timestamp_get(date_create($string_date));        
        if($tiempo_entrega>$tiempo_ahora)        
        {            
            return back()->withErrors('El pedido'.$ordenEncabezado->codigo.' no esta listo aun');        
        }
        $this->_ordenServicioRepository->Update($id,null);
        return redirect()->to(url('/ordenservicio'));        
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }  
        if(!$this-> autorizar(Auth::user()))
        {
            return back()->withErrors("Usted no tiene permisos para borrar esta operacion");
        }      
           
        $this->_ordenServicioRepository->Delete($id);        
        return redirect()->to(url('/ordenservicio'));        
        //
    }

}
