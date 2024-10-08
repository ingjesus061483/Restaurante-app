<?php
namespace App\Repositories;

use App\Contracts\IRepository;

class SessionRepository implements IRepository
{    
    protected ProductoRepository $_ProductoRepsitory;
    public function __construct(ProductoRepository $ProductoRepository) 
    {
        $this->_ProductoRepsitory = $ProductoRepository;
    }
    function GetAll()
    {
        $detalles=[];       
        if(session()->has('detalles'))
        {            
            $detalles=session('detalles');
        }
        return $detalles;
    }
    function GetProductosSession()
    {
        $detalles=session('detalles');
        $productosSession=[];
        foreach($detalles as $item)
        {
            $productosSession[]=$item->producto_id;
        }
        return $productosSession;
    }
    private function GetItemOrdenDetalleProducto($detalles,$producto_id)
    {
        $search=null;
        foreach($detalles as $item)
        {
            if($item->producto_id==$producto_id)
            {
                $search=$item;            
                break;
            }           
        }
        return $search;
    }  
    function find($id)
    {
        $detalles=[];        
        if(session()->has('detalles'))                
        {            
            $detalles=session('detalles');                               
        }         
        $search=null;
        foreach($detalles as $item)
        {
            if($item->id==$id)
            {
                $search=$item;            
                break;
            }           
        }
        return $search;
    }  
    public function Update($id, $request)
    {       
        $detalles=[];        
        if(session()->has('detalles'))                        
        {
            $detalles=session('detalles');                                                     
        }
        for($i = 0 ; $i < sizeof($detalles); $i++)
        {
        
            if($detalles[$i]->producto_id==$request->producto_id)
            {
               $detalles[$i]->cantidad=$request->cantidad;
               $detalles[$i]->total=$request->total; 
               $detalles[$i]->observaciones=$request->observaciones; 
               break;                
            }
        }
        session(['detalles' => $detalles]);        
    }
    public function Store($request)
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
        $search=$this->GetItemOrdenDetalleProducto($detalles,$request->producto_id);        
        $producto =$this->_ProductoRepsitory->find($request-> producto_id);
        if($search==null)        
        {
            $detalles[]=(object)[                        
                'id'=>$id, 
                'detalle_id'=>'0',
                "orden_id"=> property_exists($request,'orden_id')?$request->orden_id:'0',   
                'producto'=>$producto,
                'producto_id'=>$producto->id, 
                'imagen'=>$producto->imagen,     
                'impreso'=>'0',      
                'cantidad'=>$request-> cantidad,            
                'detalleOrden'=>$request->detalleOrden,            
                'valor_unitario'=>$request->valor_unitario,            
                'total'=>$request-> total,
                'observaciones'  =>$request->observaciones
            ];                            
            session(['detalles' => $detalles]);        
            return true;                     
        }        
        return false;      
    }    
    public function Delete($id)
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
            session()->forget(['cabana']);
        }
        else{
            session(['detalles' => $newdetalle]);
        }
    }
}