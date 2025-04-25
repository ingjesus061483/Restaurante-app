<?php
namespace App\Repositories;
use App\Contracts\IRepository;

use App\Models\OrdenEncabezado;
class OrdenServicioRepository implements IRepository
{
    protected SessionRepository $_sesionRepository;
    protected OrdenDetalleRepository $_OrdenDetalleRepository;
    protected ProductoRepository $_productoRepository;
    protected CabanaRepository $_cabanaRepository;    
    protected EmpleadoRepository $_empleadoRepository;
    protected ClienteRepository $_clienteRepository;
    protected ExistenciaRepository $_existenciaRepository;
    public function __construct(ProductoRepository $productoRepository,
                                CabanaRepository $cabanaRepository,
                                EmpleadoRepository $empleadoRepository,
                                ClienteRepository $clienteRepository,                                
                                ExistenciaRepository $existenciaRepository,
                                OrdenDetalleRepository $ordenDetalleRepository,
                                SessionRepository $sessionRepository,)
    {
        $this-> _existenciaRepository=$existenciaRepository;
        $this->_cabanaRepository=$cabanaRepository;
        $this->_clienteRepository=$clienteRepository;
        $this-> _empleadoRepository=$empleadoRepository;
        $this->_productoRepository = $productoRepository;
        $this->_OrdenDetalleRepository=$ordenDetalleRepository ;
        $this->_sesionRepository=$sessionRepository;
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
    function updateTableByOrder($request ,$id)
    {
        $ordenEncabezado=$this->find($id);
        $ordenEncabezado->cabaña_id =$request->moveTo;
        $ordenEncabezado->save();
    }
    function GetOrdenServicio ($id,$empresa)
    {
         
        $ordenEncabezado=$this-> Find($id) ;        
        $ordenservicio=(object)[
                        "empresa"=>$empresa,
                        "orden_encabezado"=>$ordenEncabezado ,
                        "detalles"=>[],
                        "impresora"=>null,
                        "domicilio"=>'',
                        "propina"=>'',
                        ];
        return $ordenservicio;    
    }

    public function GetOrdenByMesa($mesa_id)
    {
        return OrdenEncabezado::where('cabaña_id',$mesa_id)
                              ->where('estado_id',1) 
                              ->first();       
    }
    public function totalizar($ordenes){
        $sum=0;
        foreach($ordenes as $item)
        {
            $sum =$sum +$item->total;
        }
        return $sum;
    }
    public function totalizarOrden($detalles){
        $sum=0;
        foreach($detalles as $item)
        {
            $sum =$sum +$item->total;
        }
        return $sum;
    } 
    public function GetOrdenesByEmpleados($empleado_id,$fechaini,$fechaFin)
    {
        return OrdenEncabezado::where('empleado_id',$empleado_id)
                              ->wherebetween('fecha',[date_format($fechaini,'Y-m-d'),
                                                      date_format($fechaFin,'Y-m-d')])
                              ->orderBy('id', 'DESC')
                              ->get();       
    }
    public function GetorderByDate($fechaini,$fechaFin)
    {
        return OrdenEncabezado::wherebetween('fecha',[date_format($fechaini,'Y-m-d'),
                                                      date_format($fechaFin,'Y-m-d')]);
                      
                              //->get();
    }
    public function GetAll()
    {
        $fecha1 = date_create();        
        date_add($fecha1, date_interval_create_from_date_string('-1 days'));
        $fecha2=date_create();        
        return OrdenEncabezado::wherebetween('fecha',[date_format($fecha1,'Y-m-d'),
                                                      date_format($fecha2,'Y-m-d')])
                            
                              ->orderby('id','Desc') 
                              ->get();
    }

    public function BuscarOrdenCliente($request)
    {
        $arr=$request->input('cliente')!=null?explode('-',$request->input('cliente')):[];
        $cliente=count($arr)!=0? $this-> _clienteRepository->Getcliente($arr[0]):null;
        return $cliente!=null?OrdenEncabezado::where('cliente_id',$cliente->id)->where('estado_id',1)->first():null;

    }
    public function actualizarClienteOrdenServicio($request){
        $arr=$request->input('cliente')!=null?explode('-',$request->input('cliente')):[];
        $cliente=count($arr)!=0? $this-> _clienteRepository->Getcliente($arr[0]):null;
        $ordenEncabezado=$this->Find($request->orden_id);
        if ($ordenEncabezado->cliente ==null){
            $ordenEncabezado->cliente_id=$cliente->id;
            $ordenEncabezado->update();            
        }        
    }
    public function  PagarOrden($id){
        $ordenEncabezado= $this->Find($id);
        $ordenEncabezado->estado_id=3;
        $ordenEncabezado->save();
    }
    public function AcreditarOrden($id){
        $ordenEncabezado= $this->Find($id);
        $ordenEncabezado->estado_id=4;
        $ordenEncabezado->save();
    }
    function ActualizarTotalPagarOrdenservicio($id)
    {
        $ordenservicio=$this->find($id);
        $detalles=$ordenservicio->orden_detalles;
        $total=$this->totalizarOrden($detalles);
        $pagos=$ordenservicio->pagos;
        foreach($pagos as $pago)
        {
            $total=$total+ $pago->servicio_voluntario+$pago->impuesto-$pago->descuento;
        }

        $ordenservicio->total=$total;
        $ordenservicio->update();    

    } 
    public function Update($id, $request)
    {
        $ordenEncabezado= $this->Find($id);
        $OrdenDetalles=$ordenEncabezado->orden_detalles;
        $ordenEncabezado->estado_id=2;
        $ordenEncabezado->save();
        $this-> DescontarProductoDeExistencia($OrdenDetalles);        
    }  
    public function Delete($id)
    {
        $ordenEncabezado=OrdenEncabezado::find($id);
        $cabaña =$this->_cabanaRepository->find($ordenEncabezado->cabaña_id);
        $this->_cabanaRepository->desocuparCabana($cabaña);
        $ordenEncabezado->delete();
    }
    public function Find($id)
    {
       return OrdenEncabezado::find($id);
    }

    public function Store($request)
    {
        $arr=$request->input('cliente')!=null?explode('-',$request->input('cliente')):[];
        $cliente=count($arr)!=0?
            $this-> _clienteRepository->Getcliente($arr[0]):null;

        $empleado=$request->input('empleado')!=null?
            $this->_empleadoRepository->Getempleado($request->input('empleado')):null;
        $credito=$request->input('credito')!=null?(bool)$request->input('credito'):0;
        $domicilio=$request->input('domicilio')!=null?(bool)$request->input('domicilio'):0;
        $detalles=session('detalles');
        $ordenEncabezado=OrdenEncabezado::create([
          'codigo'=>$request->input('codigo'),
          'tipo_documento_id'=>$request->input('tipo_documento'),
          'fecha'=>$request->input('fecha'),
          'hora'=>$request->input('hora'),
          'hora_entrega'=>$request->input('hora_entrega'),       
          "total"=>$this->totalizarOrden($detalles),
          'credito'=>$credito,
          'domicilio'=>$domicilio,
          'cabaña_id'=>$request->input('cabaña'),
          'cliente_id'=>$cliente!=null?$cliente->id:null,
          'empleado_id'=>$empleado!=null?$empleado->id:null,
        ]);           
        foreach($detalles as $item)
        {
            $item-> orden_id=$ordenEncabezado->id;
            $this->_OrdenDetalleRepository-> Store($item);  
        }
        if($domicilio==0)
        {
            $this-> _cabanaRepository->ocuparCabaña($request->input('cabaña'));
        }
        return $ordenEncabezado->id;
    }
    public function GetHoraEntrega($detalles){
        $tiempoCoccion=$this->_productoRepository-> GetTiempoCoccion($detalles);        
        $now=date_create();        
        date_add($now,date_interval_create_from_date_string($tiempoCoccion.' minutes'));     
        return date_format($now, 'H:i:s');
    }
    public function ComprobarExistenciaProductoDetalle($detalles)
    {
        $errors=[];
        foreach($detalles as $item)                    
        {
            $producto_id=$item->producto_id;
            $producto=$this->_productoRepository->Find($producto_id);
                        $procesado=$producto!=null?$producto->procesado:0;
            if($procesado==0)
            {
                $viewInventario =$this->_existenciaRepository-> getInventario(['producto',$item->cantidad,$producto_id],
                                        ['tipo','total_inventario','id']);                                        
                if(count($viewInventario)==0)
                {                    

                    $errors[]=['La cantidad de '.$item->detalleOrden .' pedida en esta 
                                orden es mayor a la cantidad que hay en el inventario',];                 
                    $this->_sesionRepository->delete($item->id);
                
                }             
            }
            else{
                $ingredientes=$producto->preparacions; 
                if(count($ingredientes)==0)
                {
                    $errors[]=[
                        'El producto '.$item->detalleOrden .' no tiene ingrediente asignados',                        
                    ];                     
                    $this->_sesionRepository->delete($item->id);
                }
                else{
                    foreach($ingredientes as $ingrediente){
                        $materia_prima_id=$ingrediente->materia_prima_id;
                        $cantidad=$ingrediente->cantidad;
                        $viewInventario =$this->_existenciaRepository-> getInventario(['materia_prima',$cantidad,$materia_prima_id],
                                        ['tipo','total_inventario','id']);                                                                                
                        if(count($viewInventario)==0){                                                
                            $errors[]=[                                
                                'La cantidad de '.$ingrediente->materia_prima->nombre .' pedida en esta                                 
                                orden es mayor a la cantidad que hay en el inventario',                             
                            ];                                  
                            $this->_sesionRepository->delete($item->id);           
                        }                    
                    }
                }
            }
        }
        $detalles=session()->has('detalles')?$detalles=session('detalles'):[];
        $data=[
            'detalles'=>$detalles,
            'errors'=>$errors,
        ];
        return $data;    
    }  
    FUNCTION ComprobarTiempoEntrega($fechahora_entrega)
    {
        $tiempo_entrega= date_timestamp_get(date_create($fechahora_entrega));        
        $now=date_create();
        $string_date= date_format($now,'Y-m-d H:i:s');
        $tiempo_ahora=date_timestamp_get(date_create($string_date));        
       return $tiempo_entrega>$tiempo_ahora;
        
    }
    public function DescontarProductoDeExistencia($OrdenDetalles)
    {
        foreach($OrdenDetalles as $detalle)
        {
            $producto=$this->_productoRepository->Find( $detalle->producto_id);
            $cantidad_producto=$detalle->cantidad;
            if(!$producto->procesado)
            {    
                $existencia=(object)[
                    'tipo'=>'producto',                    
                    'fecha'=>date('Y-m-d'),
                    'cantidad'=>$cantidad_producto,
                    'esEntrada'=>0,
                    'materiaprima_id'=>$producto->id                   
                ];
                $this->_existenciaRepository-> Store($existencia);         
            }
            else
            {
                $ingredientes=$producto->preparacions;
                foreach($ingredientes as $ingrediente){
                    $materia_prima_id=$ingrediente->materia_prima_id;
                    $cantidad_ingrediente= $cantidad_producto* $ingrediente->cantidad;
                    $existencia=(object)[
                        'tipo'=>'materia_prima',
                        'fecha'=>date('Y-m-d'),
                        'cantidad'=>$cantidad_ingrediente,
                        'esEntrada'=>0,
                        'materiaprima_id'=>$materia_prima_id              
                    ];  
                    $this->_existenciaRepository -> Store($existencia);
                }
            }            
        }
    }
}