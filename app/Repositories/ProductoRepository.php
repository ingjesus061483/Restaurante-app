<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Producto;
use App\Repositories\FileRepository;

class ProductoRepository implements IRepository{
    protected FileRepository $_filerepository;
  
    protected ExistenciaRepository $_existenciaRepository;
    public function __construct(FileRepository $fileRepository,
                                ExistenciaRepository $existenciaRepository,)  
    {  
        $this->_existenciaRepository=$existenciaRepository;
        $this->_filerepository = $fileRepository;
    }
    public function GetProductos()
    {
        $totalentrada="IFNULL((SELECT SUM(cantidad)FROM existencias WHERE producto_id=productos.id AND entrada=1
                       GROUP BY producto_id),0)AS total_entrada";
        $totalsalida="IFNULL((SELECT SUM(cantidad) FROM existencias WHERE producto_id=productos.id AND entrada=0 
                      GROUP BY producto_id),0) AS total_salida";
        $totalinventario="IFNULL((SELECT SUM(cantidad) FROM existencias WHERE producto_id=productos.id AND entrada=1 
                          GROUP BY producto_id),0)-
                          IFNULL((SELECT SUM(cantidad) FROM existencias WHERE producto_id=productos.id AND entrada=0 
                          GROUP BY producto_id),0) AS total_inventario";
        return Producto::select("productos.id",
                                "codigo",
                                "productos.nombre",
                                "costo_unitario",
                                "precio",
                                "foraneo",
                                "imagen",
                                "categorias.nombre AS categoria",
                                "unidad_medidas.nombre AS unidad_medida")
                        ->selectRaw("'producto'AS tipo")
                        ->selectRaw($totalentrada)
                        ->selectRaw($totalsalida)
                        ->selectRaw($totalinventario)
                        ->join('categorias', 'categorias.id', '=', 'productos.categoria_id')
                        ->join('unidad_medidas', 'unidad_medidas.id', '=', 'productos.unidad_medida_id');
    }
    public function TotalVentaProductos($ventas)    
    {        
        $sum =0;
        foreach($ventas as $item)
        {
            $sum=$sum +$item->ventas;
        }
        return $sum;
    }
    public function ProductosVendidosByFecha($request)    
    {
        $fechaIni=$request->fechaIni;
        $fechaFin=$request->fechaFin;
        return Producto::select('orden_detalles.valor_unitario')
                       ->selectRaw("CONCAT( productos.codigo,' - ',productos.nombre)as producto")
                       ->selectRaw("SUM(orden_detalles.cantidad) as total_cantidad_vendidas")
                       ->selectRaw("IFNULL( CASE WHEN  SUBSTRING(productos.codigo, 1, 1) ='B' THEN IFNULL((SELECT valor FROM configuracions WHERE nombre ='comision_bebidas'),0)END,0) *SUM(orden_detalles.cantidad)comision_bebidas")
                       ->selectRaw("IFNULL( CASE WHEN  SUBSTRING(productos.codigo, 1, 1) ='C' THEN IFNULL((SELECT valor FROM configuracions WHERE nombre ='comision_comidas'),0)END,0)*SUM(orden_detalles.cantidad)comision_comidas")
                       ->selectRaw("SUM( orden_detalles.total )-
                                    IFNULL( CASE WHEN  SUBSTRING(productos.codigo, 1, 1) ='B' THEN IFNULL((SELECT valor FROM configuracions WHERE nombre ='comision_bebidas'),0)END,0) *SUM(orden_detalles.cantidad)-
                                    IFNULL( CASE WHEN  SUBSTRING(productos.codigo, 1, 1) ='C' THEN IFNULL((SELECT valor FROM configuracions WHERE nombre ='comision_comidas'),0)END,0)*SUM(orden_detalles.cantidad) ventas")                                             
                       ->join('orden_detalles','productos.id','=','orden_detalles.producto_id')
                       ->join('orden_encabezados','orden_Encabezados.id','=','orden_detalles.orden_encabezado_id')
                       ->where('orden_encabezados.estado_id',3)
                       ->whereBetween('orden_encabezados.fecha',[$fechaIni,$fechaFin])
                       ->groupby('productos.codigo')
                       ->groupby('productos.nombre')     
                       ->groupby('orden_detalles.valor_unitario')                  
                       ->get();            
    } 
    public function buscarproductosBynombre($nombre)
    {
        return Producto::where('nombre','like','%'.$nombre.'%')->get();
    }
    public function BuscarProductoEnOrdenServicio($productos)
    {
        return Producto::whereNotIn('id',$productos)->get();
    } 
    public function ingredientes($id)
    {
       $producto= $this->Find($id);
       return $producto-> preparacions()->select('materia_prima_id')->where('producto_id',$id)->get();        
    }
    public function  existencias( $id,$entrada=0)
    {                
        $producto= $this->Find($id);
        return $producto->existencias()->where('entrada',$entrada)->get();    
    }    
    public function totalizarExistencia($id, $entrada = 0)
    {
       $existencias=$this->existencias($id,$entrada);
       $sum=0;
       foreach($existencias as $item){
           $sum=$item->cantidad+$sum;
       }
       return $sum;
    }
  
    public function GetAll()
    {
        return $this->GetProductos()->get();
    }
    public function Find($id)
    {
        return  Producto::Find($id);
    }
    public function Store($request)
    {  
        $foraneo=$request->input('foraneo')==null?0:(bool)$request->input('foraneo'); 
        $codigo=$request->input('codigo');
        $nombre =$request->input('nombre');  
        $nombreimagen=$this->_filerepository-> getImage($request, $codigo.' '.$nombre);       
       $producto=  Producto::create([
            'codigo'=>$request->input('codigo'),
            'nombre' =>$request->input('nombre'),
            'preparacion'=>$request->input('preparacion'),
            'descripcion'=>$request->input('descripcion'),
            'costo_unitario'=>$request->input('costo_unitario'),                                   
            'precio'=>$request->input('precio'),
            'impresora_id'=>$request->input('impresora'),
            'foraneo'=>$foraneo,
            'imagen'=>$nombreimagen,
            'tiempo_coccion'=>$request->input('tiempo_coccion'),
            'unidad_medida_id' =>$request->input('unidad_medida') ,
            'categoria_id'=>$request->input('categoria'),
        ]);       
        if($producto ->foraneo==1)
        {
            $now=date_create();     
            $fecha=date_format($now, 'Y-m-d');
            
            $existencia=(object)[                
                "fecha"=>$fecha,                
                "cantidad"=>$request->existencias,                
                "esEntrada"=>1,                       
                "materiaprima_id"=>$producto->id,                
                "tipo"=>"producto"
            ];            
            $this->_existenciaRepository->Store($existencia);

        }
        return $producto;

    }
    public function  Update($id, $request)
    {
        $codigo=$request->input('codigo');
        $nombre =$request->input('nombre');  
        $nombreimagen=$this->_filerepository-> getImage($request, $codigo.' '.$nombre);       
        $foraneo=$request->input('foraneo')==null?0:(bool)$request->input('foraneo'); 
        $producto=$this->Find($id); 
        $producto-> codigo=$request->input('codigo');
        $producto->  nombre =$request->input('nombre');
        $producto->  preparacion=$request->input('preparacion');
        $producto-> costo_unitario=$request->input('costo_unitario');
        $producto->precio=$request->input('precio');
        $producto->foraneo=$foraneo;
        $producto->descripcion=$request->input('descripcion');
        $producto->impresora_id=$request->input('impresora');
        $producto->tiempo_coccion= $request->input('tiempo_coccion');
        $producto-> imagen=$nombreimagen;
        $producto->unidad_medida_id =$request->input('unidad_medida') ;
        $producto->categoria_id=$request->input('categoria');
        $producto->save();       
    }
    public function Delete($id)
    {
        $producto=$this->Find($id);
        if ($producto->imagen!=null)
        {
            $ruta=public_path("img/");
            unlink($ruta.$producto->imagen);
        }       
        $producto->delete();
    }
}