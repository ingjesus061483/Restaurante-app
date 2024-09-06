<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\CabanaRepository;
use App\Repositories\ConfiguracionRepository;
use App\Repositories\EmpleadoRepository;
use App\Repositories\ExistenciaRepository;
use App\Repositories\FileRepository;
use App\Repositories\PrinterRepository;
use App\Repositories\MateriaPrimaRepository;
use App\Repositories\OrdenDetalleRepository;
use App\Repositories\OrdenServicioRepository;
use App\Repositories\PrinterTemplateRepository;
use App\Repositories\ProductoRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PrinterController extends Controller
{
    protected ConfiguracionRepository $_configuracionRepository;
    protected ExistenciaRepository  $_existenciaRepository;
    protected CabanaRepository $_cabanaRepository;
    protected FileRepository $_fileRepository;
    protected PrinterTemplateRepository $_printerTemplateRepository;
    protected EmpleadoRepository $_empleadoRepository;
    protected MateriaPrimaRepository $_materiaPrimarepository;
    protected ProductoRepository $_productoRepository;
    protected OrdenDetalleRepository $_ordendetalleRepository;
    protected OrdenServicioRepository $_ordenservicioRepository;
    protected PrinterRepository $_impresoraRepository;
    public function __construct(ExistenciaRepository $existenciaRepository,
                                PrinterTemplateRepository $printerTemplateRepository,
                                FileRepository $fileRepository,
                                CabanaRepository $cabanaRepository,
                                ConfiguracionRepository $configuracionRepository,
                                EmpleadoRepository $empleadoRepository,
                                ProductoRepository $productoRepository,
                                MateriaPrimaRepository $materiaPrimarepository,
                                OrdenDetalleRepository $ordendetalleRepository,
                                OrdenServicioRepository $ordenServicioRepository,
                                PrinterRepository $impresoraRepository,)

    {
        $this->_ordendetalleRepository=$ordendetalleRepository;
        $this->_cabanaRepository=$cabanaRepository;
        $this->_productoRepository=$productoRepository;
        $this->_empleadoRepository=$empleadoRepository;
        $this->_configuracionRepository=$configuracionRepository;
        $this->_printerTemplateRepository=$printerTemplateRepository;
        $this ->_fileRepository=$fileRepository;
        $this->_existenciaRepository = $existenciaRepository;
        $this->_materiaPrimarepository=$materiaPrimarepository;
        $this->_ordenservicioRepository=$ordenServicioRepository;
        $this->_impresoraRepository=$impresoraRepository;
    }  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check())
        {
            return redirect()->to('login');
        }        
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }       
        $data =[
            'impresoras'=>$this->_impresoraRepository->GetAll()
        ];
        return view ('Printer.index',$data);       //
    }
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }  
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }       
        return view('Printer.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }     
        $validacion=$request->validate([
            'codigo'=>'required|max:50|unique:impresoras',
            'nombre'=>'required|max:50',
            'recurso_compartido'=>'required|max:50',
            'tamaño_fuente_encabezado'=>'required|numeric',
            'tamaño_fuente_contenido'=>'required|numeric',                    
        ]);           
        $this->_impresoraRepository->Store((object)$request->all());
        return redirect()->to(url('/impresoras'));  
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        if (!Auth::check())
        {
            return redirect()->to('login');
        }        
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }
        $data =[
            'impresora'=>$this->_impresoraRepository->Find($id)
        ];
        return view('Printer.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }     
        $validacion=$request->validate([
            'nombre'=>'required|max:50',
            'recurso_compartido'=>'required|max:50',
            'tamaño_fuente_encabezado'=>'required|numeric',
            'tamaño_fuente_contenido'=>'required|numeric',                    
            'codigo'=>'required|max:50|unique:impresoras,codigo,'.$id,
        ]);
        $this->_impresoraRepository->Update( $id,(object)$request->all());
        return redirect()->to(url('/impresoras'));  
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }
        $this->_impresoraRepository->Delete($id);
        return redirect()->to(url('/impresoras'));   
        //
    }
    function Comanda($id)
    {
        try
        {
            if(!Auth::check())            
            {
                return redirect()->to('login');            
            }            
            $empresa=Auth::user()->empresa; 
            $ordenservicio=$this->_ordenservicioRepository->GetOrdenServicio($id,$empresa);               
            $err=[];                
            $cont=0;
            $detalles=$ordenservicio-> orden_encabezado->orden_detalles; 
            $impresoras=$this->_impresoraRepository->GetAll();
            $this->_printerTemplateRepository-> Comanda($impresoras, $ordenservicio,$detalles,$err,$cont);       
            if (count($err)>0)
            {
                return redirect()->to('ordenservicio')->withErrors($err);
            }         
            if($cont==0)
            {
                throw new Exception("No hay productos para imprimir");
            }         
            $this->_ordendetalleRepository->ActualizarImpresos($id);
            return redirect()->to('ordenservicio');        
        }
        catch(Exception $ex)
        {
            return  redirect()->to('ordenservicio')->withErrors($ex->getMessage());
        }
    }
    public function ComandaSesion($id)    
    {
        try
        {
            if(!Auth::check())            
            {
                return redirect()->to('login');            
            }            
            if(!session()->has('detalles'))
            {
                throw new Exception('No hay detalles disponibles');
            }
      
            $empresa=Auth::user()->empresa; 
            $ordenservicio=$this->_ordenservicioRepository->GetOrdenServicio($id,$empresa);
            $detalles=session('detalles');                           
            $err=[];    
            $cont=0;     
            $impresoras=$this->_impresoraRepository->GetAll();
            $this->_printerTemplateRepository-> Comanda($impresoras, $ordenservicio,$detalles,$err,$cont);
            if (count($err)>0)
            {
                session()->forget('detalles');                       
                return redirect()->to('ordenservicio')->withErrors($err);
            }            
            $this->_ordendetalleRepository->ActualizarImpresos($id);
            session()->forget('detalles');
            return redirect()->to('ordenservicio');        
        }
        catch(Exception $ex)
        {
            session()->forget('detalles');
            return  redirect()->to('ordenservicio')->withErrors($ex->getMessage());
        }
    }
    public function OrdenServicio($id)
    {
        try
        {
            if(!Auth::check())            
            {
                return redirect()->to('login');            
            }        
          
            $empresa=Auth::user()->empresa; 
            $ordenservicio=$this->_ordenservicioRepository->GetOrdenServicio($id,$empresa);  
            $ordenservicio-> domicilio=$this->_configuracionRepository->getConfigByNombre('Valor_Domicilio')->valor;            
            $ordenservicio->propina=$this->_configuracionRepository->getConfigByNombre("propina")->valor;            
            $err=[];            
            $impresoras=$this->_impresoraRepository->GetAll();
            $recurso_compartido=$this->_configuracionRepository->getConfigByNombre('Impresora_cajero')->valor;
            $this->_printerTemplateRepository->Factura($recurso_compartido,$impresoras,$ordenservicio,$err);
            if (count($err)>0)
            {
                return  redirect()->to('ordenservicio')->withErrors($err);
            }            
            return redirect()->to('ordenservicio');        
        }
        catch(Exception $ex)
        {
            return  redirect()->to('ordenservicio')->withErrors($ex->getMessage());
        }    
    }
   
}
