<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrdenEncabezado;
use App\Repositories\ExistenciaRepository;
use App\Repositories\FileRepository;
use App\Repositories\PlantillasRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
class ReportesController extends Controller
{
    protected ExistenciaRepository  $_existenciaRepository;
    protected FileRepository $_fileRepository;
    protected PlantillasRepository $_plantillaRepository;
    public function __construct(ExistenciaRepository $existenciaRepository,
                                PlantillasRepository $plantillasRepository,
                                FileRepository $fileRepository)
    {
        $this->_plantillaRepository=$plantillasRepository;
        $this ->_fileRepository=$fileRepository;
        $this->_existenciaRepository = $existenciaRepository;

    }
    public function print($id)
    {
        try
        {
            if(!Auth::check())            
            {
                return redirect()->to('login');            
            }
            $empresa=Auth::user()->empresa; 
            $ordenEncabezado=OrdenEncabezado::find($id) ;
            $ordenservicio=(object)["empresa"=>$empresa,"orden_encabezado"=>$ordenEncabezado ];
            $conector=new WindowsPrintConnector("pos2");
            $printer =new Printer($conector);        
            $printer ->initialize();
            $this->_plantillaRepository->ImprimirPlantillaOrdenServicio($printer,$ordenservicio);
            $printer -> cut();                
            $printer->close();            
            return redirect()->to('ordenservicio');        
        }
        catch(Exception $ex){
          return back()->withErrors($ex->getMessage());
        }
        
    }
    public function inventarioPdf()
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $inventario_view=$this->_existenciaRepository->GetAll();
        $data=[
            'inventario'=> $inventario_view,          
            'total_inventario'=>$this->_existenciaRepository->TotalizarInventario(),
        ];
       // return view('Reporte.inventario',$data);
       return $this->_fileRepository->GetPdf('Reporte.inventario',$data);

    }
    //
}
