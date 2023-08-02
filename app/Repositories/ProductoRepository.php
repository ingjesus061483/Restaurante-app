<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Producto;
use App\Repositories\FileRepository;

class ProductoRepository implements IRepository{
    protected FileRepository $_filerepository;
    public function __construct(FileRepository $fileRepository) {
        $this->_filerepository = $fileRepository;
    }
    public function BuscarProductoEnOrdenServicio($productos){
        return Producto::whereNotIn('id',$productos)->get();
     } 
    public function ingredientes($id){
       $producto= $this->Find($id);
       return $producto-> preparacions()->select('materia_prima_id')->where('producto_id',$id)->get();        
    }
    public function  existencias( $id,$entrada=0){                
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
        return Producto::all();
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
        Producto::create([
            'codigo'=>$request->input('codigo'),
            'nombre' =>$request->input('nombre'),
            'preparacion'=>$request->input('preparacion'),
            'descripcion'=>$request->input('descripcion'),
            'costo_unitario'=>$request->input('costo_unitario'),                                   
            'precio'=>$request->input('precio'),
            'foraneo'=>$foraneo,
            'imagen'=>$nombreimagen,
            'tiempo_coccion'=>$request->input('tiempo_coccion'),
            'unidad_medida_id' =>$request->input('unidad_medida') ,
            'categoria_id'=>$request->input('categoria'),
        ]);       
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