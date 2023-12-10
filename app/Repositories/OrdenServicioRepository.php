<?php
namespace App\Repositories;
use App\Contracts\IRepository;

use App\Models\OrdenEncabezado;
class OrdenServicioRepository implements IRepository
{
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
                                OrdenDetalleRepository $ordenDetalleRepository )
    {
        $this-> _existenciaRepository=$existenciaRepository;
        $this->_cabanaRepository=$cabanaRepository;
        $this->_clienteRepository=$clienteRepository;
        $this-> _empleadoRepository=$empleadoRepository;
        $this->_productoRepository = $productoRepository;
        $this->_OrdenDetalleRepository=$ordenDetalleRepository ;
    }
    public function totalizarOrden($detalles){
        $sum=0;
        foreach($detalles as $item)
        {
            $sum =$sum +$item->total;
        }
        return $sum;
    } 
    public function GetAll()
    {
       return OrdenEncabezado ::all();
    }
    public  function GetTiempoCoccion($detalles)
    {
        $productos=[];
        foreach($detalles as $item)                    
        {
            $producto_id=$item->producto_id;
            $producto=$this->_productoRepository->Find($producto_id);            
            $foraneo=$producto!=null?$producto->foraneo:0;
            if($foraneo==0){
                $productos=[$producto];
            }
        }
        $tiempoCoccion=0;
        for($i=0;$i<=count($productos)-1;$i++)
        {
            if($productos[$i]->tiempo_coccion>$tiempoCoccion)
            {
                $tiempoCoccion=$productos[$i]->tiempo_coccion;
            }

        }
        return $tiempoCoccion;
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
        $ordenservicio->total=$total;
        $ordenservicio->update();    

    } 
    public function Update($id, $request)
    {
        $ordenEncabezado= $this->Find($id);
        $OrdenDetalles=$ordenEncabezado->orden_detalles;
        $ordenEncabezado->estado_id=2;
        $ordenEncabezado->save();
        $this->DescontarProductoDeExistencia($OrdenDetalles);        
    }  
    public function Delete($id)
    {
        $ordenEncabezado=OrdenEncabezado::find($id);
        $this->_cabanaRepository->desocuparCabana($ordenEncabezado->cabaña_id);
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
        $detalles=session('detalles');
        $ordenEncabezado=OrdenEncabezado::create([
          'codigo'=>$request->input('codigo'),
          'tipo_documento_id'=>$request->input('tipo_documento'),
          'fecha'=>$request->input('fecha'),
          'hora'=>$request->input('hora'),
          'hora_entrega'=>$request->input('hora_entrega'),
          'observaciones'=>$request->input('observaciones'),
          "total"=>$this->totalizarOrden($detalles),
          'credito'=>$credito,
          'cabaña_id'=>$request->input('cabaña'),
          'cliente_id'=>$cliente!=null?$cliente->id:null,
          'empleado_id'=>$empleado!=null?$empleado->id:null,
        ]);           
        foreach($detalles as $item)
        {
            $item-> orden_id=$ordenEncabezado->id;
            $this->_OrdenDetalleRepository-> Store($item);  
        }
        $this-> _cabanaRepository->ocuparCabaña($request->input('cabaña'));
    }
    public function DescontarProductoDeExistencia($OrdenDetalles)
    {
        foreach($OrdenDetalles as $detalle)
        {
            $producto=$this->_productoRepository->Find( $detalle->producto_id);
            $cantidad_producto=$detalle->cantidad;
            if($producto->foraneo)
            {    
                $existencia=(object)[
                    'tipo'=>'producto',                    
                    'fecha'=>date('Y-m-d'),
                    'cantidad'=>$cantidad_producto,
                    'esEntrada'=>0,
                    'materiaprima_id'=>$producto->id                   
                ];
                $this-> _existenciaRepository->Store($existencia);         
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
                    $this-> _existenciaRepository->Store($existencia);
                }
            }            
        }
    } 
 
    public function ComprobarExistenciaProductoDetalle($detalles){
        $errors=[];
        foreach($detalles as $item)                    
        {
            $producto_id=$item->producto_id;
            $producto=$this->_productoRepository->Find($producto_id);
                        $foraneo=$producto!=null?$producto->foraneo:0;
            if($foraneo==1){
                $viewInventario =$this->_existenciaRepository-> getInventario(['producto',$item->cantidad,$producto_id],
                                        ['tipo','total_inventario','id']);                                        
                if(count($viewInventario)==0){                    
                    $errors[]=[
                            'La cantidad de '.$item->detalleOrden .' pedida en esta 
                            orden es mayor a la cantidad que hay en el inventario',                        
                        ];                     
                    
                }             
            }
            else{
                $ingredientes=$producto->preparacions; 
                if(count($ingredientes)==0)
                {
                    $errors[]=[
                        'El producto '.$item->detalleOrden .' no tiene ingrediente asignados',                        
                    ];                     
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
                        }                    
                    }
                }
            }
        }
        return $errors;    
    }  
    function BuscarItemOrdenDetalle($detalles,$value)
    {
        $search=false;
        foreach($detalles as $item)
        {
            if($item->producto_id==$value)
            {
                $search=true;            
                break;
            }           
        }
        return $search;
    }  
    public function GuardarSesionDetalle($request)
    { 
        $id=0;              
        $detalles=[];        
        if(!session()->has('detalles'))                
        {            
            $id=1;                               
        }                
        else
        {
            $detalles=session('detalles');                               
            $id=count($detalles)+1;                                
        }               
        $search=$this->BuscarItemOrdenDetalle($detalles,$request->producto_id);        
        if($search)        
        {
            return false;        
        }        
        $detalles[]=(object)[                        
            'id'=>$id, 
            "orden_id"=>'',           
            'producto_id'=>$request-> producto_id,            
            'cantidad'=>$request-> cantidad,            
            'detalleOrden'=>$request->detalleOrden,            
            'valor_unitario'=>$request->valor_unitario,            
            'total'=>$request-> total        
        ];                            
        session(['detalles' => $detalles]);        
        return true;        
    }
    public function GetdetalleByproducto($request)
    {
        $cantidad=$request->input('cantidad');
        $producto_id=$request->input('producto_id');
        $producto=$this->_productoRepository->Find($producto_id);
        $total=$cantidad*$producto->precio;        
        $data =(object) [
            "cantidad"=>$cantidad,            
            "detalleOrden"=>$producto->nombre,
            "producto_id"=>$producto->id,
            "valor_unitario"=>$producto->precio ,
            "total"=>$total,
            "orden_id"=>$request->orden_id,
        ];    
        return $data;
    }
    
    public function EliminarSesionDetalle($id)
    {
        $i=0;        
        $newdetalle=[];        
        $detalles=session('detalles');    
        foreach($detalles as $item)
        {
            if($item->id!=$id)
            {
                $newdetalle[$i]=$item;
                $i++;
            }
        }
        if(count($newdetalle)==0)
        {
            session()->forget(['detalles']);
        }
        else{
            session(['detalles' => $newdetalle]);
        }
    }
}