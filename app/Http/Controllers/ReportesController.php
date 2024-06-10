<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use App\Models\Impresora;
use App\Models\OrdenDetalle;
use App\Models\OrdenEncabezado;
use App\Repositories\CabanaRepository;
use App\Repositories\ConfiguracionRepository;
use App\Repositories\EmpleadoRepository;
use App\Repositories\ExistenciaRepository;
use App\Repositories\FileRepository;
use App\Repositories\ImpresoraRepository;
use App\Repositories\MateriaPrimaRepository;
use App\Repositories\OrdenDetalleRepository;
use App\Repositories\OrdenServicioRepository;
use App\Repositories\PlantillasRepository;
use App\Repositories\ProductoRepository;
use DeepCopy\f001\B;
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
    protected MateriaPrimaRepository $_materiaPrimarepository;
    protected ProductoRepository $_productoRepository;
    protected OrdenDetalleRepository $_ordendetalleRepository;
    protected OrdenServicioRepository $_ordenservicioRepository;
    protected ImpresoraRepository $_impresoraRepository;
    public function __construct(ExistenciaRepository $existenciaRepository,
                                PlantillasRepository $plantillasRepository,
                                FileRepository $fileRepository,
                                CabanaRepository $cabanaRepository,
                                ConfiguracionRepository $configuracionRepository,
                                EmpleadoRepository $empleadoRepository,
                                ProductoRepository $productoRepository,
                                MateriaPrimaRepository $materiaPrimarepository,
                                OrdenDetalleRepository $ordendetalleRepository,
                                OrdenServicioRepository $ordenServicioRepository,
                                ImpresoraRepository $impresoraRepository,)

    {
        $this->_ordendetalleRepository=$ordendetalleRepository;
        $this->_cabanaRepository=$cabanaRepository;
        $this->_productoRepository=$productoRepository;
        $this->_empleadoRepository=$empleadoRepository;
        $this->_configuracionRepository=$configuracionRepository;
        $this->_plantillaRepository=$plantillasRepository;
        $this ->_fileRepository=$fileRepository;
        $this->_existenciaRepository = $existenciaRepository;
        $this->_materiaPrimarepository=$materiaPrimarepository;
        $this->_ordenservicioRepository=$ordenServicioRepository;
        $this->_impresoraRepository=$impresoraRepository;

    }
    private function Detalles_impresora($orden_detalles,$impresora,$accion )
    {
        $detalles=$orden_detalles;
        $detalles_impresora=[];
        foreach($detalles as $detalle)
        {
            $impresora_id=$detalle->producto->impresora_id;
            switch($accion)
            {
                case "comanda":
                    {
                        if($impresora_id==$impresora->id &&$detalle->impreso==0)                        
                        {
                            $detalles_impresora[]=$detalle;
                        }     
                        break;               
                    }
                case "orden":
                    {
                        if($impresora_id==$impresora->id )                        
                        {
                            $detalles_impresora[]=$detalle;
                        }     
                        break;                                                       
                    }
            }
            
        }
        return $detalles_impresora;
    }
    private function GetOrdenServicio ($id)
    {
        $empresa=Auth::user()->empresa; 
        $ordenEncabezado=$this->_ordenservicioRepository-> Find($id) ;        
        $ordenservicio=(object)[
                        "empresa"=>$empresa,
                        "orden_encabezado"=>$ordenEncabezado ,
                        "detalles"=>[],
                        "impresora"=>null,
                        "domicilio"=>'',
                        "propina"=>'',
                        ];
        return $ordenservicio;


    }

    private function GetPrinter($recurso_compartido,$ordenservicio)
    {
        $conector=new WindowsPrintConnector($recurso_compartido);                    
        $printer =new Printer($conector);                            
        $printer ->initialize();                        
        $this->_plantillaRepository->ImprimirPlantillaOrdenServicio($printer,$ordenservicio);                    
        $printer->pulse();
        $printer -> cut();                    
        $printer->close();                                          
    } 
     function printComanda($id)
    {
        try
        {
            if(!Auth::check())            
            {
                return redirect()->to('login');            
            }            
            $ordenservicio=$this->GetOrdenServicio($id);            
            $impresoras=$this->_impresoraRepository->GetAll();          
            $err=[];
            $accion="comanda";
            $detalles=$ordenservicio-> orden_encabezado->orden_detalles; 
            $cont=0;
            foreach( $impresoras as $item )            
            {   
                try
                {              
                    $detalles=$ordenservicio-> orden_encabezado->orden_detalles;
                    $detalles_impresora=$this->Detalles_impresora($detalles,$item,$accion);               
                    if(count( $detalles_impresora)!=0)                    
                    {
                        $ordenservicio->detalles=(object)$detalles_impresora;                    
                        $ordenservicio->impresora=$item;
                        $conector=new WindowsPrintConnector($item->recurso_compartido);                    
                        $printer =new Printer($conector);                            
                        $printer ->initialize();                    
                        $this->_plantillaRepository->ImprimirPlantillaComanda($printer,$ordenservicio);                    
                        $printer -> cut();                    
                        $printer->close();   
                        $cont++;
                    }                
              
                }
                catch(Exception $ex)
                {                    
                    $err[]=$ex->getMessage();
                    break;
                }
            }           
            if($cont==0)
            {
                throw new Exception("No hay productos para imprimir");
            }
            if (count($err)>0)
            {
                return back()->withErrors($err);
            }
            $this->_ordendetalleRepository->ActualizarImpresos($id);
            return redirect()->to('ordenservicio');        
        }
        catch(Exception $ex)
        {
            return back()->withErrors($ex->getMessage());
        }     

    }
    public function printComandaSesion($id)    
    {
        try
        {
            if(!Auth::check())            
            {
                return redirect()->to('login');            
            }            
            if(!session()->has('detalle'))
            {
                throw new Exception('No hay detalles disponibles');
            }
            $detalle=session('detalle');                               
            $ordendetales=[$detalle];
            $ordenservicio=$this->GetOrdenServicio($id); 
            $impresora =$detalle->producto->impresora;       
            $err=[];
            $accion="comanda";            
            try            
            {                
                $detalles=$ordendetales;
                $detalles_impresora=$this->Detalles_impresora($detalles,$impresora,$accion);               
                if(count( $detalles_impresora)==0)                    
                {
                    throw new Exception("No se ha encontrado ningun producto para imprimir");                                                
                }                
                $ordenservicio->detalles=(object)$detalles_impresora;                    
                $ordenservicio->impresora=$impresora;
                $conector=new WindowsPrintConnector($impresora->recurso_compartido);                    
                $printer =new Printer($conector);                            
                $printer ->initialize();                    
                $this->_plantillaRepository->ImprimirPlantillaComanda($printer,$ordenservicio);                    
                $printer -> cut();                    
                $printer->close();   
            }            
            catch(Exception $ex)            
            {              
                $err[]=$ex->getMessage();                              
            }                      
            if (count($err)>0)
            {
                session()->forget('detalle');       
               return redirect()->to('ordenservicio')->withErrors($err);
            }            
            $this->_ordendetalleRepository->ActualizarImpresos($id);
            session()->forget('detalle');
            return redirect()->to('ordenservicio');        
        }
        catch(Exception $ex)
        {
            return  redirect()->to('ordenservicio')->withErrors($ex->getMessage());
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
            $ordenservicio=$this->GetOrdenServicio($id);            
            $ordenservicio-> domicilio=$this->_configuracionRepository->getConfigByNombre('Valor_Domicilio')->valor;            
            $ordenservicio->propina=$this->_configuracionRepository->getConfigByNombre("propina")->valor;            
            $err=[];            
            $recurso_compartido=$this->_configuracionRepository->getConfigByNombre('Impresora_cajero')->valor;
            if($recurso_compartido!="")
            {
                try
                {
                    $ordenservicio->detalles= $ordenservicio-> orden_encabezado->orden_detalles;         
                    $this->GetPrinter($recurso_compartido,$ordenservicio);
                }
                catch(Exception $ex)
                {
                    $err[]=$ex->getMessage();
                }
            }            
            else
            {
                $impresoras=$this->_impresoraRepository->GetAll();
                $accion="orden";
                foreach( $impresoras as $item )            
                {   
                    try
                    {              
                        $detalles=$ordenservicio->orden_encabezado->orden_detalles;
                        $detalles_impresora=$this->Detalles_impresora($detalles,$item,$accion);               
                        if(count( $detalles_impresora)>0)
                        {
                            $ordenservicio->detalles=(object)$detalles_impresora;                    
                            $ordenservicio->impresora=$item;
                            $this->GetPrinter($item->recurso_compartido,$ordenservicio);                    
                        }                
                    }                
                    catch(Exception $ex)
                    {
                        $err[]=$ex->getMessage();
                    }
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
        $productos =$this->_productoRepository->GetProductos();
        $materiaprimas=$this->_materiaPrimarepository->GetMateriaPrima();
        $union= $materiaprimas->union($productos)->get();

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
            'ventas'=>$ventas,
            'total_venta'=>$this->_cabanaRepository->TotalVentaByCabana(),
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
        $validacion=$request->validate([
            'fechaIni'=>'required',
            'fechaFin'=>'required|after_or_equal:fechaIni',
        ]);

        $ventas= $this->_productoRepository->ProductosVendidosByFecha($request);
        $data=[
            'productosvendidos'=>$ventas,
            'total_vemtas'=>$this->_productoRepository-> TotalVentaProductos($ventas)
        ];
       // return view ('Reporte.ProductosVendidosByFecha',$data);
        return $this->_fileRepository->GetPdf('Reporte.ProductosVendidosByFecha',$data);        
    }
    //

}
