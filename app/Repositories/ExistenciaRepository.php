<?php
namespace App\Repositories;
use App\Contracts\IRepository;
use App\Models\Existencia;
use Illuminate\Support\Facades\DB;
class ExistenciaRepository implements IRepository
{
    protected ProductoRepository $_productoRepository;
    protected MateriaPrimaRepository $_materiaprimaRepository;
    
    public function TotalizarInventario(){        
        $sum=0;        
        foreach($this-> getInventario() as $item)                    
        {            
            $sum=$sum +$item->total_inventario;                        
        }            
        return $sum;    
    }     
    public function GetAll()
    {
        return $this-> getInventario();        
    }
    public function Find($id)
    {
        
    }
    public function Store($request)
    {
        $tipo=$request->tipo;     
        $existencia=new Existencia();
        $existencia->fecha=$request->fecha;
        $existencia->cantidad=$request->cantidad;
        $existencia->entrada=$request->esEntrada;
        $existencia->materia_prima_id=$tipo=='materia_prima'? $request->materiaprima_id:null;
        $existencia->producto_id=$tipo=='producto'? $request->materiaprima_id:null;
       // $existencia->insumo_id=$tipo=='insumo'?$request->materiaprima_id:null;
        $existencia->save();
    }
    public function Update($id, $request)
    {
        
    }
    public function Delete($id)
    {
        
    }
    public function getInventario($bindindgs=[],$column=[]){
        $where=count($bindindgs)>0&&count( $column)>0?"where ".$column[0]."=? and ".$column[1].">? and ".
        $column[2]."=?":"";
        $query="SELECT mat_prod.* FROM(SELECT materia_primas.id,codigo,materia_primas. nombre,costo_unitario,0 AS precio,
                0 AS foraneo,imagen,categorias.nombre AS categoria, unidad_medidas.nombre AS unidad_medida,'materia_prima'AS tipo,
                IFNULL((SELECT SUM(cantidad)FROM existencias WHERE materia_prima_id=materia_primas.id AND entrada=1 GROUP BY 
                materia_prima_id),0)AS total_entrada,IFNULL((SELECT SUM(cantidad) FROM existencias WHERE 
                materia_prima_id=materia_primas.id AND entrada=0 GROUP BY materia_prima_id),0) AS total_salida,
                IFNULL((SELECT SUM(cantidad) FROM existencias WHERE materia_prima_id=materia_primas.id AND entrada=1 GROUP BY
                materia_prima_id),0)-IFNULL((SELECT SUM(cantidad) FROM existencias WHERE materia_prima_id=materia_primas.id AND 
                entrada=0 GROUP BY materia_prima_id),0) AS total_inventario FROM materia_primas JOIN categorias ON 
                categorias.id=materia_primas.categoria_id JOIN unidad_medidas ON unidad_medidas.id=materia_primas.unidad_medida_id
                UNION 
                SELECT productos.id,codigo, productos.nombre,costo_unitario,precio,foraneo,imagen,categorias.nombre AS categoria,
                unidad_medidas.nombre AS unidad_medida,'producto'AS tipo,IFNULL((SELECT SUM(cantidad)FROM existencias WHERE
                producto_id=productos.id AND entrada=1 GROUP BY producto_id),0)AS total_entrada,IFNULL((SELECT SUM(cantidad) 
                FROM existencias WHERE producto_id=productos.id AND entrada=0 GROUP BY producto_id),0) AS total_salida,
                IFNULL((SELECT SUM(cantidad) FROM existencias WHERE producto_id=productos.id AND entrada=1 GROUP BY 
                producto_id),0)-IFNULL((SELECT SUM(cantidad) FROM existencias WHERE producto_id=productos.id AND entrada=0 
                GROUP BY producto_id),0) AS total_inventario FROM productos JOIN categorias ON categorias.id=productos.categoria_id
                JOIN unidad_medidas ON unidad_medidas.id=productos.unidad_medida_id )AS mat_prod ".$where." ORDER BY total_inventario DESC; ";
        return DB::select($query,$bindindgs);
    }
    
}