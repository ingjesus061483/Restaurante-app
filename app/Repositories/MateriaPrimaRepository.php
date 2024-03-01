<?php
namespace App\Repositories;
use App\Contracts\IRepository;
use App\Models\MateriaPrima;
class MateriaPrimaRepository implements IRepository
{
    protected FileRepository $_filerepository;
    protected ExistenciaRepository $_existenciaRepository;
    public function __construct(FileRepository $fileRepository,ExistenciaRepository $existenciaRepository) 
    {
        $this->_existenciaRepository=$existenciaRepository;

        $this->_filerepository = $fileRepository;
    }
    public function GetMateriaPrima()
    {
        $totalentrada="IFNULL((SELECT SUM(cantidad)FROM existencias WHERE materia_prima_id=materia_primas.id AND entrada=1 
        GROUP BY materia_prima_id),0)AS total_entrada";
        $totalsalida="IFNULL((SELECT SUM(cantidad) FROM existencias WHERE materia_prima_id=materia_primas.id AND entrada=0 
        GROUP BY materia_prima_id),0) AS total_salida";
        $totalinventario="IFNULL((SELECT SUM(cantidad) FROM existencias WHERE materia_prima_id=materia_primas.id AND entrada=1
        GROUP BY materia_prima_id),0)-
        IFNULL((SELECT SUM(cantidad) FROM existencias WHERE materia_prima_id=materia_primas.id AND entrada=0
        GROUP BY materia_prima_id),0) AS total_inventario";
         return MateriaPrima::select("materia_primas.id",
                                     "codigo",
                                     "materia_primas.nombre",
                                     "costo_unitario",
                                     "imagen",
                                     "categorias.nombre AS categoria",
                                     "unidad_medidas.nombre AS unidad_medida")
                            ->selectRaw("0 AS precio")
                            ->selectRaw("1 AS foraneo")
                            ->selectRaw("'materia_prima'AS tipo")
                            ->selectRaw($totalentrada)
                            ->selectRaw($totalsalida)
                            ->selectRaw($totalinventario)
                            ->join('categorias', 'categorias.id', '=', 'materia_primas.categoria_id')
                            ->join('unidad_medidas', 'unidad_medidas.id', '=', 'materia_primas.unidad_medida_id');
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
        return  $this->GetMateriaPrima()->get();
    }
    public function Find($id)
    {
        return  MateriaPrima::Find($id);
    }
    public function Store($request)
    {
        $codigo=$request->input('codigo');
        $nombre =$request->input('nombre');  
        $nombreimagen=$this->_filerepository-> getImage($request, $codigo.' '.$nombre);       
        $now=date_create();     
        $fecha=date_format($now, 'Y-m-d');        
        $insumo=materiaprima::create([
            'codigo'=>$request->input('codigo'),
            'nombre' =>$request->input('nombre'),
            'descripcion'=>$request->input('descripcion'),
            'costo_unitario'=>$request->input('costo_unitario'),                                   
            'imagen'=>$nombreimagen,
            'unidad_medida_id' =>$request->input('unidad_medida') ,
            'categoria_id'=>$request->input('categoria'),
        ]);              
        $existencia=(object)[                
            "fecha"=>$fecha,                
            "cantidad"=>$request->existencias,                
            "esEntrada"=>1,                       
            "materiaprima_id"=>$insumo->id,                
            "tipo"=>"materia_prima"
        ];            
        $this->_existenciaRepository->Store($existencia);
        return $insumo;
      
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