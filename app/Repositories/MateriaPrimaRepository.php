<?php
namespace App\Repositories;
use App\Contracts\IRepository;
use App\Models\MateriaPrima;
class MateriaPrimaRepository implements IRepository
{
    protected FileRepository $_filerepository;
    public function __construct(FileRepository $fileRepository) {
        $this->_filerepository = $fileRepository;
    }
    public function BuscarMateriaPrimaEnIgrediente($materiaprimas){
       return MateriaPrima::whereNotIn('id',$materiaprimas)->get();
    } 
    public function  existencias( $id,$entrada=0){                
        $materiaPrima= $this->Find($id);
        return $materiaPrima->existencias()->where('entrada',$entrada)->get();    
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
        return MateriaPrima::all();
    }
    public function Find($id)
    {
        return  MateriaPrima::Find($id);
    }
    public function Store($request)
    {  
        $foraneo=$request->input('foraneo')==null?0:(bool)$request->input('foraneo'); 
        $codigo=$request->input('codigo');
        $nombre =$request->input('nombre');  
        $nombreimagen=$this->_filerepository-> getImage($request, $codigo.' '.$nombre);       
        materiaprima::create([
            'codigo'=>$request->input('codigo'),
            'nombre' =>$request->input('nombre'),
            'descripcion'=>$request->input('descripcion'),
            'costo_unitario'=>$request->input('costo_unitario'),                                   
            'imagen'=>$nombreimagen,
            'unidad_medida_id' =>$request->input('unidad_medida') ,
            'categoria_id'=>$request->input('categoria'),
        ]);      
      
    }
    public function  Update($id, $request)
    {
        $codigo=$request->input('codigo');
        $nombre =$request->input('nombre');          
        $nombreimagen=$this->_filerepository->getImage($request,$codigo.' '.$nombre);
        $materiaprima= $this->Find($id);
        $materiaprima->codigo=$request->input('codigo');
        $materiaprima->nombre =$request->input('nombre');        
        $materiaprima->imagen=$nombreimagen!=null?$nombreimagen:$materiaprima->imagen;        
        $materiaprima->descripcion=$request->input('descripcion');
        $materiaprima->costo_unitario=$request->input('costo_unitario');        
        $materiaprima-> unidad_medida_id =$request->input('unidad_medida') ;
        $materiaprima->categoria_id=$request->input('categoria');
        $materiaprima->save();    
    }
    public function Delete($id)
    {
        $materiaprima=materiaprima::find($id);
        if ($materiaprima->imagen!=null)
        {
            $ruta=public_path("img/");
            unlink($ruta.$materiaprima->imagen);
        }
        $materiaprima->delete(); 
    }
}