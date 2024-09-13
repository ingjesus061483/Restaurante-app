<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CabanaRepository;
use App\Repositories\ConfiguracionRepository;
use App\Repositories\EmpleadoRepository;
use App\Repositories\ExistenciaRepository;
use App\Repositories\FileRepository;
use App\Repositories\MateriaPrimaRepository;
use App\Repositories\OrdenDetalleRepository;
use App\Repositories\OrdenServicioRepository;
use App\Repositories\ProductoRepository;

class FileController extends Controller
{
    protected ConfiguracionRepository $_configuracionRepository;
    protected ExistenciaRepository  $_existenciaRepository;
    protected CabanaRepository $_cabanaRepository;
    protected FileRepository $_fileRepository;
    protected EmpleadoRepository $_empleadoRepository;
    protected MateriaPrimaRepository $_materiaPrimarepository;
    protected ProductoRepository $_productoRepository;
    protected OrdenDetalleRepository $_ordendetalleRepository;
    protected OrdenServicioRepository $_ordenservicioRepository;   
    public function __construct(ExistenciaRepository $existenciaRepository,                             
                                FileRepository $fileRepository,
                                CabanaRepository $cabanaRepository,
                                ConfiguracionRepository $configuracionRepository,
                                EmpleadoRepository $empleadoRepository,
                                ProductoRepository $productoRepository,
                                MateriaPrimaRepository $materiaPrimarepository,
                                OrdenDetalleRepository $ordendetalleRepository,
                                OrdenServicioRepository $ordenServicioRepository,)

    {
        $this->_ordendetalleRepository=$ordendetalleRepository;
        $this->_cabanaRepository=$cabanaRepository;
        $this->_productoRepository=$productoRepository;
        $this->_empleadoRepository=$empleadoRepository;
        $this->_configuracionRepository=$configuracionRepository;        
        $this ->_fileRepository=$fileRepository;
        $this->_existenciaRepository = $existenciaRepository;
        $this->_materiaPrimarepository=$materiaPrimarepository;
        $this->_ordenservicioRepository=$ordenServicioRepository;        

    }  
    public function Inventario()
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
       // return view('File.inventario',$data);
       return $this->_fileRepository->GetPdf('File.inventario',$data);
    }
    public function VentasByMesas()
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
         //return view('File.VentasByMesas',$data);
         return $this->_fileRepository->GetPdf('File.VentasByMesas',$data);   
    }
    public function PropinasByEmpleado()
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $data=[
            'propinas'=>$this->_empleadoRepository->propinasByEmpleado()        
        ];
//       return view ('File.PropinasByEmpleado',$data);
       return $this->_fileRepository->GetPdf('File.PropinasByEmpleado',$data);
    }
    public function OrdenesByFecha(Request $request)
    {
   
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $validacion=$request->validate([
            'fechaIni'=>'required',
            'fechaFin'=>'required|after_or_equal:fechaIni',
        ]);
        $fechaini=date_create(request()->fechaIni);
        $fechafin=request()->fechaFin!=null ?date_create( request()->fechaFin):date_create();
        $ordenes=$this->_ordenservicioRepository->GetorderByDate($fechaini,$fechafin)
                                          ->where('estado_id',3)                                          
                                          ->orderby('id','Desc')
                                          ->get(); 
        $data=[
            'ordenes'=>$ordenes,            
            'total'=>$this->_ordenservicioRepository-> Totalizar($ordenes)            
        ];        
        //return view ('File.OrdenesByFechaPdf',$data);
        return $this->_fileRepository->GetPdf('File.OrdenesByFecha',$data);        


    }
    public function ProductosVendidosByFecha(Request $request)
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
       // return view ('File.ProductosVendidosByFecha',$data);
        return $this->_fileRepository->GetPdf('File.ProductosVendidosByFecha',$data);        
    }   
    public function  OrdenServicio($id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        $ordenEncabezado=$this->_ordenservicioRepository-> Find($id);
        $OrdenDetalles=$ordenEncabezado->orden_detalles;
        $data=[
            'ordenEncabezado'=>$ordenEncabezado,
            'orden_detalle'=>$OrdenDetalles,
        ];        
       // return view ('file.OrdenServicio',$data);   
       return $this->_fileRepository->GetPdf('file.OrdenServicio',$data);        
    }
    function MostrarExistenciaPorProducto($id)
    {
        if(!Auth::check())        
        {
            return redirect()->to('login');        
        }                 
              
        $producto= $this->_productoRepository->Find($id);
        if($producto-> procesado==0)
        {
            $entradas=$this->_productoRepository->existencias($id,1); //Existencia:: where('entrada',1)->where('producto_id',$id)->get();
            $salidas=$this->_productoRepository->existencias($id);//Existencia:: where('entrada',0)->where('producto_id',$id)->get();
            $total_entrada= $this->_productoRepository->totalizarExistencia($id,1);//$entradas!=null? $this->totalizar($entradas):0;            
            $total_salida=$this->_productoRepository->totalizarExistencia($id);//$salidas!=null?$this->totalizar($salidas):0;
            $data=[                
                'producto'=>$producto,                     
                "entradas"=>$entradas,
                "salidas"=>$salidas,
                "total_entrada"=>$total_entrada,
                "total_salida"=>$total_salida
            ];     
        }
        else
        {
            $preparacions =$producto->preparacions;
          /*  if(count($preparacions)==0)
            {
                session(['producto' => $producto]);
                return redirect()->to(url('ingredientes/create'));   
            }            */
            $data=[                
                'producto'=>$producto,                 
            ];  
        
        }
        return $this->_fileRepository->GetPdf('file.MostrarExistenciaPorProducto',$data);        
        //return view('File.MostrarExistenciaPorProducto',$data);
}     
    //
}
