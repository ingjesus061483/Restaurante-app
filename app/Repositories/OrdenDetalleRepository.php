<?php
namespace App\Repositories;
use App\Contracts\IRepository;
use App\Models\OrdenDetalle;
class OrdenDetalleRepository implements IRepository
{
    public function GetAll()
    {
        
    }
    public function Store($request)
    {
        $OrdenDetalle=new OrdenDetalle();
        $OrdenDetalle->cantidad =$request-> cantidad;
        $OrdenDetalle->valor_unitario=$request-> valor_unitario;
        $OrdenDetalle->total=$request-> total;            
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
        return OrdenDetalle::select('orden_detalles.orden_encabezado_id as orden_id','orden_detalles.id as detalle_id','productos.id as producto_id',
                                    'cantidad','productos.nombre as detalle','productos.precio',)
                           ->join('productos','productos.id','=','orden_detalles.producto_id')
                           ->where('orden_detalles.id',$id)
                           ->first();
    }
    public function Delete($id){
        $detalle=OrdenDetalle::find($id);
        $detalle->delete();
    }
    public function update($id,$request)
    {
        $detalle=OrdenDetalle::find($id);
        $detalle->cantidad=$request->cantidad;
        $detalle->total=$request->total;
        $detalle->update();
    }
 
}