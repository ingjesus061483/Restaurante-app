<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Cabaña;
class CabanaRepository implements IRepository
{
    protected FileRepository $_fileRepository;
    public function __construct(FileRepository $fileRepository ) 
    {
        $this->_fileRepository = $fileRepository;
    }
    public function TotalVentaByCabana()
    {
       $ventas= $this->GetVentasByCabanas();
       $sum=0;
       foreach($ventas as $item )
       {
            $sum=$sum+ $item->venta;        
       }
       return $sum;

    }
    public function GetVentasByCabanas()
    {
        return Cabaña::select('cabañas.codigo')
                     ->selectRaw('cabañas.nombre as mesa')
                     ->selectRaw('COUNT(orden_encabezados.id)as ordenes_pagas')
                     ->selectRaw('SUM(pagos.total_pagar)as venta')                     
                     ->join('orden_encabezados','cabañas.id','=','orden_encabezados.cabaña_id')
                     ->join('pagos','orden_encabezados.id','=','pagos.orden_id')
                     ->whereRaw('orden_encabezados.fecha=curdate()')
                     ->where('orden_encabezados.estado_id',3)
                     ->groupBy('cabañas.codigo')
                     ->groupby('cabañas.nombre')
                     ->groupby('orden_encabezados.fecha')
                     ->get();
    }
    public function GetAll()
    {
        return Cabaña::select ("id","codigo","nombre","ocupado","descripcion","capacidad_maxima","imagen")
                     ->selectRaw("IFNULL((SELECT  SUM(orden_encabezados.total) FROM orden_encabezados WHERE cabaña_id=cabañas.id AND fecha=CURDATE() AND  estado_id=3),0) as venta_diaria")
                     ->orderby('venta_diaria') ->get();

    }
    public function desocuparCabana(Cabaña $cabaña)
    {        
        if ($cabaña!=null)
        {
            $cabaña->ocupado=0;
            $cabaña->update();
        }
    }
    public function GetCabanasDesocupadas()
    {
       return Cabaña::where('ocupado',0)->get();
    }
    public function ocuparCabaña($id)
    {
        $cabaña=$this->Find($id);     
        if ($cabaña!=null)
        {
            $cabaña->ocupado=1;
            $cabaña->save(); 
        }
    }
    public function Store($request)
    {
        $nombreimagen=$this->_fileRepository-> getImage($request, $request->codigo.'-'.$request->nombre);       
        $cabana=new Cabaña();
        $cabana->codigo=$request->codigo;
        $cabana->nombre=$request->nombre;
        $cabana->capacidad_maxima=$request->capacidad;
        $cabana->imagen=$nombreimagen;
        $cabana->descripcion=$request->descripcion;
        $cabana->save();
    }
    public function Find($id)
    {
        return Cabaña::find($id);
    }
    public function Update($id,$request)
    {
        $cabana= $this->Find($id);
        $nombreimagen=$this->_fileRepository-> getImage($request, $request->codigo.'-'.$request->nombre);       
        $cabana->codigo=$request->codigo;
        $cabana->nombre=$request->nombre;
        $cabana->capacidad_maxima=$request->capacidad;
        $cabana->imagen=$nombreimagen;
        $cabana->descripcion=$request->descripcion;
        $cabana->save();
    }
    public function Delete($id)
    {
        $cabana= $this->Find($id);
        if ($cabana->imagen!=null)
        {
            $ruta=public_path("img/");
            unlink($ruta.$cabana->imagen);
        }       
 
        $cabana->delete();
    }
}