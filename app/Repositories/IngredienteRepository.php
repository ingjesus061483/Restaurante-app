<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Preparacion;

class IngredienteRepository implements IRepository
{
    protected ProductoRepository $_productoRepository;
    public function __construct(ProductoRepository $productoRepository) {
        $this->_productoRepository = $productoRepository;
    }
    public function GetIngredienteByProducto($producto_id){
        
    }
    public function GetAll()
    {
        
    }    
    public function BuscarIngredientesMateriaprimaproducto($materia_prima_id,$producto_id )
    {
        return Preparacion::where('materia_prima_id',$materia_prima_id)
                                ->where('producto_id',$producto_id)
                                ->first();
    }  
    public function Store($request)
    {
        $materia_prima_id=$request->input('materia_prima_id');                
        $producto_id =$request->input('producto_id');        
        $cantidad= $request->input('cantidad');              
        $preparacion=new Preparacion();        
        $preparacion-> materia_prima_id=$materia_prima_id;                
        $preparacion->producto_id=$producto_id;        
        $preparacion->cantidad=$cantidad;              
        $preparacion->save(); 
    }
    public function Update($id, $request)
    {
        $materiaprima=$request->input('materiaprima');                            
        $producto_id =$request->input('producto_id');
        $cantidad= $request->input('cantidad');                
        $arr= explode('-',$materiaprima);
        $materiaprima_codigo=trim( $arr[0]);
        $preparacion=$this->Find($id);
        $Materia_Prima=$preparacion->materiaprima-> where('codigo',$materiaprima_codigo)->first();
        $preparacion-> materia_prima_id=$Materia_Prima->id;
        $preparacion->producto_id=$producto_id;
        $preparacion->cantidad=$cantidad;        
        $preparacion->save();    
    }
    public function Find($id)
    {    
       return Preparacion::find($id);       
    
    }
    public function Delete($id)
    {
        $preparacion=$this->Find($id);
        $preparacion->delete();
    }
}