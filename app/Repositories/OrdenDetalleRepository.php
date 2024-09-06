<?php
namespace App\Repositories;
use App\Contracts\IRepository;
use App\Models\OrdenDetalle;
class OrdenDetalleRepository implements IRepository
{
    protected ProductoRepository $_productoRepository;
    public function __construct(ProductoRepository $productoRepository = null) {
        $this->_productoRepository = $productoRepository;
    }
    public function GetAll()
    {
        
    }
    public function  GetdetalleByProducto($request)
    {
        $venta_costo=$request->venta_costo=="true"?1:0;        
        $cantidad=(double)$request->cantidad;
        $observaciones=$request->observaciones;
        $producto_id=$request->producto_id;
        $producto=$this->_productoRepository->Find($producto_id);        
        $valor_unitario=(double)$venta_costo==1 ?$producto->costo_unitario:$producto->precio;
        $total=$cantidad*$valor_unitario;        
        $data =(object) [
            "cantidad"=>$cantidad,                        
            'producto'=>$producto,
            'impreso'=>0,
            "detalleOrden"=>$producto->nombre,
            "producto_id"=>$producto->id,
            "venta_costo"=>$venta_costo,
            "valor_unitario"=>$valor_unitario ,
            "total"=>$total,
            "orden_id"=>$request->orden_id,
            "observaciones"=>$observaciones,
        ];    
        return $data;
    }
  
    public function Store($request)
    {
        $OrdenDetalle=new OrdenDetalle();
        $OrdenDetalle->cantidad =$request-> cantidad;
        $OrdenDetalle->valor_unitario=$request-> valor_unitario;
        $OrdenDetalle->total=$request-> total; 
        $OrdenDetalle->observaciones=$request->observaciones;           
        $OrdenDetalle->orden_encabezado_id=$request-> orden_id;            
        $OrdenDetalle->producto_id=$request-> producto_id;            
        $OrdenDetalle->save();        
    }
    public function getDetallesByOrden($orden_id)
    {
        return OrdenDetalle::where('orden_encabezado_id',$orden_id)->get();
    }
 
    public function find($id)
    {
        $detalle=OrdenDetalle::select('orden_detalles.orden_encabezado_id as orden_id',
                                      'orden_detalles.id as detalle_id',
                                      'productos.id as producto_id',
                                      'orden_detalles.observaciones',
                                      'cantidad',
                                      'productos.nombre as detalleOrden',
                                      'productos.imagen',
                                      'productos.precio as valor_unitario',)
                           ->join('productos','productos.id','=','orden_detalles.producto_id')
                           ->where('orden_detalles.id',$id)
                           ->first();

        return $detalle;
    }
    public function Delete($id){
        $detalle=OrdenDetalle::find($id);
        $detalle->delete();
    }
    public function update($id,$request)
    {
        $detalle=OrdenDetalle::find($id);
        $detalle->cantidad=$request->cantidad;
        $detalle->observaciones=$request->observaciones;
        $detalle->total=$request->total;
        $detalle->update();
    }
    function Detalles_impresora($orden_detalles,$impresora,$accion )
    {
        $detalles=$orden_detalles;
        $detalles_impresora=[];
        foreach($detalles as $detalle)
        {
            $impresora_id=$detalle->producto->impresora_id;
            switch($accion)
            {
                case "comanda":
                    {
                        if($impresora_id==$impresora->id &&$detalle->impreso==0)                        
                        {
                            $detalles_impresora[]=$detalle;
                        }     
                        break;               
                    }
                case "orden":
                    {
                        if($impresora_id==$impresora->id )                        
                        {
                            $detalles_impresora[]=$detalle;
                        }     
                        break;                                                       
                    }
            }            
        }
        return $detalles_impresora;
    }

    public function ActualizarImpresos($id)
    {
        $detalles_impresos=OrdenDetalle::where('impreso',0) ->where('orden_encabezado_id',$id)->get();
        foreach($detalles_impresos as $item)
        {                
            $item->impreso=1;
            $item->save();
        }

    }

 
}