<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use App\Models\Impresora;
use App\Models\OrdenEncabezado;
use App\Repositories\ConfiguracionRepository;
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
    protected ConfiguracionRepository $_configuracionRepository;
    protected ExistenciaRepository  $_existenciaRepository;
    protected FileRepository $_fileRepository;
    protected PlantillasRepository $_plantillaRepository;
    private function Detalles_impresora($orden_detalles,$impresora ){

        $detalles=$orden_detalles;
        $detalles_impresora=[];
        foreach($detalles as $detalle){
            $impresora_id=$detalle->producto->impresora_id;
            if ($impresora_id==$impresora->id)
            {
                $detalles_impresora[]=$detalle;
            }                
        }
        return $detalles_impresora;

    }
    public function __construct(ExistenciaRepository $existenciaRepository,
                                PlantillasRepository $plantillasRepository,
                                FileRepository $fileRepository,
                                ConfiguracionRepository $configuracionRepository)
    {
        $this->_configuracionRepository=$configuracionRepository;
        $this->_plantillaRepository=$plantillasRepository;
        $this ->_fileRepository=$fileRepository;
        $this->_existenciaRepository = $existenciaRepository;

    }
    function printComanda($id)
    {
        try
        {
            if(!Auth::check())            
            {
                return redirect()->to('login');            
            }
            $empresa=Auth::user()->empresa; 
            $ordenEncabezado=OrdenEncabezado::find($id) ;
            $impresoras=Impresora::all();
            $ordenservicio=(object)["empresa"=>$empresa,
                                    "orden_encabezado"=>$ordenEncabezado ,
                                    "detalles"=>[],
                                    "impresora"=>null
                                   ];
            $err=[];
            foreach( $impresoras as $item )            
            {   
                try
                {              
                    $detalles=$ordenEncabezado->orden_detalles;
                    $detalles_impresora=$this->Detalles_impresora($detalles,$item);               
                    if(count( $detalles_impresora)>0)
                    {
                        $ordenservicio->detalles=(object)$detalles_impresora;                    
                        $ordenservicio->impresora=$item;
                        $conector=new WindowsPrintConnector($item->recurso_compartido);                    
                        $printer =new Printer($conector);                            
                        $printer ->initialize();                    
                        $this->_plantillaRepository->ImprimirPlantillaComanda($printer,$ordenservicio);                    
                        $printer -> cut();                    
                        $printer->close();                                    
                    }                
                }                
                catch(Exception $ex)
                {
                    $err[]=$ex->getMessage();
                }
            }
            if (count($err)>0)
            {
                return back()->withErrors($err);

            }            
            return redirect()->to('ordenservicio');        
        }
        catch(Exception $ex)
        {
            return back()->withErrors($ex->getMessage());
        }     

    }
   public function printOrdenServicio($id)
    {
        try
        {
            if(!Auth::check())            
            {
                return redirect()->to('login');            
            }     
            $empresa=Auth::user()->empresa; 
            $ordenEncabezado=OrdenEncabezado::find($id) ;
            $impresoras=Impresora::all();
            $ordenservicio=(object)["empresa"=>$empresa,
                                    "orden_encabezado"=>$ordenEncabezado ,
                                    "detalles"=>[],
                                    "impresora"=>null,
                                    "domicilio"=>$this->_configuracionRepository->getConfigByNombre('Valor_Domicilio')->valor,
                                    "propina"=>$this->_configuracionRepository->getConfigByNombre("propina")->valor,
                                   ];
            $err=[];
            foreach( $impresoras as $item )            
            {   
                try
                {              
                    $detalles=$ordenEncabezado->orden_detalles;
                    $detalles_impresora=$this->Detalles_impresora($detalles,$item);               
                    if(count( $detalles_impresora)>0)
                    {
                        $ordenservicio->detalles=(object)$detalles_impresora;                    
                        $ordenservicio->impresora=$item;
                        $conector=new WindowsPrintConnector($item->recurso_compartido);                    
                        $printer =new Printer($conector);                            
                        $printer ->initialize();                    
                        $this->_plantillaRepository->ImprimirPlantillaOrdenServicio($printer,$ordenservicio);                    
                        $printer->pulse();
                        $printer -> cut();                    
                        $printer->close();                                    
                    }                
                }                
                catch(Exception $ex)
                {
                    $err[]=$ex->getMessage();
                }
            }
            if (count($err)>0)
            {
                return back()->withErrors($err);

            }            
            return redirect()->to('ordenservicio');        
        }
        catch(Exception $ex)
        {
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
