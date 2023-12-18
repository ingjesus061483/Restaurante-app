<?php
namespace App\Repositories;

use App\Contracts\IRepository;

class SessionRepository implements IRepository
{
    function GetAll()
    {
        
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
        if($search==null)        
        {
            $detalles[]=(object)[                        
                'id'=>$id, 
                'detalle_id'=>'0',
                "orden_id"=>'0',           
                'producto_id'=>$request-> producto_id,            
                'cantidad'=>$request-> cantidad,            
                'detalleOrden'=>$request->detalleOrden,            
                'valor_unitario'=>$request->valor_unitario,            
                'total'=>$request-> total        
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
        }
        else{
            session(['detalles' => $newdetalle]);
        }
    }
}