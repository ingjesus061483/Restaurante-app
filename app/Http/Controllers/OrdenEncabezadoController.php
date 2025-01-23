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
    public function MoveTableByOrder(Request $request,$id){
        $cabanaSource=$this->_cabanaRepository->GetCabanabyCode($request->source);
        
        if($cabanaSource!=null)
        {
            $this->_ordenServicioRepository->updateTableByOrder($request,$id);               
            $this->_cabanaRepository->ocuparCabaña($request->  moveTo);
            $this->_cabanaRepository->desocuparCabana($cabanaSource);
            $data=[   
            'cabana'=>$cabanaSource,
            'orden_id'=>$id,                                            
            'message'=>'la mesa se ha movido',                    
            'error'=>false                
            ];                                
            return json_encode ($data);        
        }
        $data=[   
            'orden_id'=>$id,                                            
            'error'=>true,
            'message'=>'la mesa no existe',                    
                           
        ];                                
        return json_encode ($data);        

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
        if (request()->accion=="PDF")
        {
            $request=request();
            return redirect()->to("file/OrdenesByFecha?fechaIni=$request->fechaIni&fechaFin=$request->fechaFin");
        }   
        if (session()->has('detalles'))
        {
            $detalles =session('detalles');
            $orden_id=$detalles[0]->orden_id;
            if($orden_id!=0)
            {
                return  redirect()->to("/ordendetalles?id=$orden_id");
            }            
            return  redirect()->to('ordenservicio/create');
        }    
        if( $this->_ordenServicioRepository->GetDate(request(),$fechaini,$fechafin))
        {
            $ordenes=[];
            $data=[
                'fechaIni'=>date_format($fechaini,'Y-m-d'),
                'fechaFin'=>date_format($fechafin,'Y-m-d'),
                'ordenes'=>$ordenes           
            ];            
            return view('Orden.index',$data)->withErrors("fecha inicial no puede ser mayor a la final.");
        }
        $user=Auth::user();                
        if($user->role_id==5)
        {
            $empleado=$user->empleados->first();
            $ordenes=$this->_ordenServicioRepository-> GetOrdenesByEmpleados($empleado->id,$fechaini,$fechafin);
        }
        else
        {
           $ordenes=$this->_ordenServicioRepository->GetorderByDate($fechaini,$fechafin)
                                                    ->orderby('id','Desc') 
                                                    ->get();            

        }
        $data=[
            'fechaIni'=>date_format($fechaini,'Y-m-d'),
            'fechaFin'=>date_format($fechafin,'Y-m-d'),
            'cabanas'=>$this->_cabanaRepository-> GetCabanasDesocupadas(),
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
        $cabañas=$this->_cabanaRepository->GetCabanasDesocupadas();    
        $cabana=session()->has('cabana')?session('cabana'): null;        
        $detalles=session()->has('detalles')?session('detalles'):[];
        $datacomprobacion=$this->_ordenServicioRepository->ComprobarExistenciaProductoDetalle($detalles);    
        $detalles=$datacomprobacion["detalles"];
        $errors=$datacomprobacion["errors"];        
        $time=$this->_ordenServicioRepository->GetHoraEntrega($detalles);
        $user=Auth::user();
        $empleado=$this->_empleadoRepository->GetEmpleadoByUser($user);
        $cliente=null;
        $data=[
            'tipo_documento'=>$this->_tipoDocumentoRepository->GetAll(),   
            'cabañas'=>$cabañas,  
            'cabana'=>$cabana,
            'tiempo_entrega'=>$time,          
            'empleado'=>$empleado,
            'cliente'=>$cliente,
            'orden_detalle'=>$detalles
        ];
        if (count($errors)>0){
            return view('Orden.create',$data)->withErrors($errors);
        }
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
        if($this->_ordenServicioRepository->ComprobarTiempoEntrega($fechahora_entrega))        
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
