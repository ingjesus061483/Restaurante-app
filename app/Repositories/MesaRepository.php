<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Mesa;

/**
 * Representa e interactua con la tabla cabañas de la base de datos.
 *
 */
class MesaRepository implements IRepository
{
    protected FileRepository $_fileRepository;
    public function __construct(FileRepository $fileRepository )
    {
        $this->_fileRepository = $fileRepository;
    }

     /**
     * Suma las ventas de todas las cabañas .
     *
     * @return decimal
     */
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
        return Mesa::select('mesas.codigo')
                     ->selectRaw('mesas.nombre as mesa')
                     ->selectRaw('COUNT(orden_encabezados.id)as ordenes_pagas')
                     ->selectRaw('SUM(pagos.total_pagar)as venta')
                     ->join('orden_encabezados','mesas.id','=','orden_encabezados.mesa_id')
                     ->join('pagos','orden_encabezados.id','=','pagos.orden_id')
                     ->whereRaw('orden_encabezados.fecha=curdate()')
                     ->where('orden_encabezados.estado_id',3)
                     ->groupBy('mesas.codigo')
                     ->groupby('mesas.nombre')
                     ->groupby('orden_encabezados.fecha')
                     ->get();
    }
    public function GetAll()
    {
        return Mesa::select ("mesas.id","mesas.codigo","mesas.nombre","mesas.ocupado","mesas.descripcion","mesas.capacidad_maxima","mesas.imagen","dep.nombre as dependencia")
                     ->join('dependencias as dep', 'mesas.dependencia_id', '=', 'dep.id')
                     ->selectRaw("IFNULL((SELECT  SUM(orden_encabezados.total) FROM orden_encabezados WHERE mesa_id=mesas.id AND fecha=CURDATE() AND  estado_id=3),0) as venta_diaria")
                     ->orderby('mesas.id','asc') ->get();
    }
    public function desocuparCabana($cabaña)
    {
        if ($cabaña!=null)
        {
            $cabaña->ocupado=0;
            $cabaña->update();
        }
    }
    public function GetCabanasDesocupadas()
    {
       return Mesa::where('ocupado',0)->get();
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
        $cabana=new Mesa();
        $cabana->codigo=$request->codigo;
        $cabana->nombre=$request->nombre;
        $cabana->capacidad_maxima=$request->capacidad;
        $cabana->imagen=$nombreimagen;
        $cabana->descripcion=$request->descripcion;
        $cabana->dependencia_id=$request->dependencia;
        $cabana->save();
    }
    public function GetCabanabyCode($code){
        return Mesa::where('codigo',$code)->first();
    }
    public function Find($id)
    {
        return Mesa::find($id);
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
        $cabana->dependencia_id=$request->dependencia;
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
