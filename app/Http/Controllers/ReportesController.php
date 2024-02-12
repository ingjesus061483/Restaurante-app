<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use App\Models\Impresora;
use App\Models\OrdenEncabezado;
use App\Repositories\CabanaRepository;
use App\Repositories\ConfiguracionRepository;
use App\Repositories\EmpleadoRepository;
use App\Repositories\ExistenciaRepository;
use App\Repositories\FileRepository;
use App\Repositories\PlantillasRepository;
use App\Repositories\ProductoRepository;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
class ReportesController extends Controller
{
    protected ConfiguracionRepository $_configuracionRepository;
    protected ExistenciaRepository  $_existenciaRepository;
    protected CabanaRepository $_cabanaRepository;
    protected FileRepository $_fileRepository;
    protected PlantillasRepository $_plantillaRepository;
    protected EmpleadoRepository $_empleadoRepository;
    protected ProductoRepository $_productoRepository;
    public function __construct(ExistenciaRepository $existenciaRepository,
                                PlantillasRepository $plantillasRepository,
                                FileRepository $fileRepository,
                                CabanaRepository $cabanaRepository,
                                ConfiguracionRepository $configuracionRepository,
                                EmpleadoRepository $empleadoRepository,
                                ProductoRepository $productoRepository,)

    {
        $this->_cabanaRepository=$cabanaRepository;
        $this->_productoRepository=$productoRepository;
        $this->_empleadoRepository=$empleadoRepository;
        $this->_configuracionRepository=$configuracionRepository;
        $this->_plantillaRepository=$plantillasRepository;
        $this ->_fileRepository=$fileRepository;
        $this->_existenciaRepository = $existenciaRepository;

    }
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
    public function VentasByMesasPdf()
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $ventas=$this->_cabanaRepository->GetVentasByCabanas();
        $data=[
            'ventas'=>$ventas
        ];
         //return view('Reporte.VentasByMesas',$data);
         return $this->_fileRepository->GetPdf('Reporte.VentasByMesas',$data);   
    }
    public function PropinasByEmpleadoPdf()
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $data=[
            'propinas'=>$this->_empleadoRepository->propinasByEmpleado()        
        ];
//       return view ('Reporte.PropinasByEmpleado',$data);
       return $this->_fileRepository->GetPdf('Reporte.PropinasByEmpleado',$data);
    }
    public function ProductosVendidosByFechaPdf(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        $data=[
            'productosvendidos'=>$this->_productoRepository->ProductosVendidosByFecha($request),
        ];
        return $this->_fileRepository->GetPdf('Reporte.ProductosVendidosByFecha',$data);
        //return view('Reporte.ProductosVendidosByFecha',$data)
    }
    //

}
