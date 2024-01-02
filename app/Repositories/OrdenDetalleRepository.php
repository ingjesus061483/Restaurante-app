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
        $detalle=OrdenDetalle::select('orden_detalles.orden_encabezado_id as orden_id',
                                      'orden_detalles.id as detalle_id',
                                      'productos.id as producto_id',
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
        $detalle->total=$request->total;
        $detalle->update();
    }
 
}