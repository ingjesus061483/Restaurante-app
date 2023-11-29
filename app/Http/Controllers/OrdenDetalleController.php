<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\OrdenDetalle;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrdenDetalleRequest;
use App\Http\Requests\UpdateOrdenDetalleRequest;
use App\Models\Cabaña;
use App\Models\Categoria;
use App\Models\Producto;
use App\Repositories\CabanaRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\OrdenServicioRepository;
use App\Repositories\ProductoRepository;
use Illuminate\Support\Facades\Auth;
class OrdenDetalleController extends Controller
{
    protected ProductoRepository $_productoRepository;
    protected CategoriaRepository $_categoriaRepository;
    protected CabanaRepository $_cabanaRepository;
    protected OrdenServicioRepository $_ordenServicioRepository;
    public function __construct(CabanaRepository $cabanaRepository,
                                ProductoRepository $productoRepository,
                                CategoriaRepository $categoriaRepository,
                                OrdenServicioRepository $ordenServicioRepository) {
         $this->_productoRepository=$productoRepository;                       
         $this->_categoriaRepository=$categoriaRepository;
        $this->_cabanaRepository = $cabanaRepository;
        $this->_ordenServicioRepository=$ordenServicioRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($id=null)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }   
    /*    $cabañas=$this->_cabanaRepository->GetCabanasDesocupadas();
        if(count($cabañas)==0)
        {
            return back()->withErrors('No hay cabañas disponibles en en elmomento!');
        }     */
        $detalles=[];       
        if(session()->has('detalles')){            
            $detalles=session('detalles');
        }
        $data=[
            "orden_detalle"=>$detalles,
            "total"=>$this-> _ordenServicioRepository-> totalizarOrden($detalles)
        ];        
        return view('OrdenDetalle.index',$data);
        //
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

        $productos=[];       
        if(!session()->has('detalles'))        
        {            
          //  $prod=request()->producto;
           // if($prod!=null){
             //   $productos=$this->_productoRepository->buscarproductosBynombre($prod);
            //}
            //else
            //{
                $productos=$this->_productoRepository->GetAll();
            //}
        }        
        else
        {

            $productosSession=[];            
            $detalles=session('detalles');                   
            foreach($detalles as $item)
            {
                $productosSession[]=$item->id;
            }
            $productos= $this->_productoRepository-> BuscarProductoEnOrdenServicio($productosSession);
                      
        }
        if(count($productos)==0)
        {
            return back()->withErrors('No hay productos disponibles');
        }
        $data=[
            'categorias'=>$this->_categoriaRepository->GetAll(),
            'productos'=>$productos,
        ];  
        return view('OrdenDetalle.create',$data);       
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
        if(!$this->_ordenServicioRepository->GuardarSesionDetalle($request))        
        {
            
            $data=[
                    'orden_id'=>$request->orden_id,
                    'message'=>'El producto ya encuentra en la tabla detalle',
                    'encontrado'=>false
                ];  
        }        
        else
        {
            $data=[
                'orden_id'=>$request->orden_id,
                'message'=>'Has insertado un detalle',
                'encontrado'=>true
            ];                
        }        
        return json_encode($data);        
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrdenDetalle $ordenDetalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {       
        $orden_servicio=$this->_ordenServicioRepository->Find($id);        
        $ordendetalles=$orden_servicio->orden_detalles;        
        $productosSession=[];                                
        foreach($ordendetalles as $item)        
        {            
            $productosSession[]=$item->producto_id;        
        }
        $productos= $this->_productoRepository-> BuscarProductoEnOrdenServicio($productosSession);
        $data=[
            "orden_id"=>$orden_servicio->id,
            'categorias'=>$this->_categoriaRepository->GetAll(),
            'productos'=>$productos,
        ];  
        return view('OrdenDetalle.create',$data);       

        
        
                
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrdenDetalleRequest $request, OrdenDetalle $ordenDetalle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {            
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        $this->_ordenServicioRepository->EliminarSesionDetalle($id);
        return back();
        //
    }
}
