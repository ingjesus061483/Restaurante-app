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
use App\Repositories\OrdenDetalleRepository;
use App\Repositories\OrdenServicioRepository;
use App\Repositories\ProductoRepository;
use App\Repositories\SessionRepository;
use Illuminate\Support\Facades\Auth;
class OrdenDetalleController extends Controller
{
    protected OrdenDetalleRepository  $_OrdenDetalleRepository;
    protected ProductoRepository $_productoRepository;
    protected CategoriaRepository $_categoriaRepository;
    protected CabanaRepository $_cabanaRepository;
    protected OrdenServicioRepository $_ordenServicioRepository;
    protected SessionRepository $_sessionRepository;
    public function __construct(CabanaRepository $cabanaRepository,
                                ProductoRepository $productoRepository,
                                CategoriaRepository $categoriaRepository,
                                OrdenServicioRepository $ordenServicioRepository,
                                OrdenDetalleRepository $ordenDetalleRepository,
                                SessionRepository $sessionRepository) {
         $this->_productoRepository=$productoRepository;                       
         $this->_categoriaRepository=$categoriaRepository;
        $this->_cabanaRepository = $cabanaRepository;
        $this->_ordenServicioRepository=$ordenServicioRepository;
        $this->_OrdenDetalleRepository=$ordenDetalleRepository;
        $this->_sessionRepository=$sessionRepository;
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
        $detalles=$this-> _sessionRepository->GetAll();     
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
            $productos=$this->_productoRepository->GetAll();            
        }        
        else
        {
            $productosSession=[];            
            $detalles=session('detalles');                   
            foreach($detalles as $item)
            {
                $productosSession[]=$item->producto_id;
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
        $detalle=$this->_OrdenDetalleRepository-> GetdetalleByproducto($request);
        if($detalle->orden_id==0)
        {  
            if(!$this->_sessionRepository->Store($detalle))
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
        }
        else
        {
            $deta=$detalle; 
            session(['detalle' => $deta]);        
            $orden=$this->_ordenServicioRepository->Find($detalle->orden_id);
            $detalles=$orden->orden_detalles;
            $encontrado=false;
            $ordendetalle=null;
            foreach($detalles as $detail )
            {
                if($detail->producto_id == $detalle->producto_id)
                {
                    $encontrado=true;
                    $ordendetalle=$detail;
                    break;
                }
            }
            $mensaje='';
            if(!$encontrado)
            {
                $this->_OrdenDetalleRepository->store($detalle);
                $mensaje='Has insertado un detalle';
            }
            else
            {
                
                $detalle->cantidad=$detalle->cantidad+ $ordendetalle->cantidad;
                $update=   $this->_OrdenDetalleRepository-> GetdetalleByproducto($deta);                
                $this->_OrdenDetalleRepository->update($ordendetalle-> id,$update);                    
                $mensaje='Se ha actualizado un detalle';
            }
            $this->_ordenServicioRepository->ActualizarTotalPagarOrdenservicio($request->orden_id);
            $deta->cantidad= (int)$request->cantidad;
            $data=[
                'orden_id'=>$request->orden_id,
                'message'=>$mensaje,
                'encontrado'=>true
            ];                
        }
        return json_encode($data);        
        //
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detalle=$this->_sessionRepository->find($id)!=null?
                        $this->_sessionRepository->find($id):
                        $this->_OrdenDetalleRepository->find($id);        
        $data=[
            "detalle"=>$detalle
        
        ];
        return json_encode($data);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {       
        $orden_servicio=$this->_ordenServicioRepository->Find($id);  
  $productos =$this->_productoRepository->GetAll();      
/*        $ordendetalles=$orden_servicio->orden_detalles;        
        $productosSession=[];                                
        foreach($ordendetalles as $item)        
        {            
            $productosSession[]=$item->producto_id;        
        }
        $productos= $this->_productoRepository-> BuscarProductoEnOrdenServicio($productosSession);*/
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
    public function update(Request $request, $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $detalle=$this->_OrdenDetalleRepository-> GetdetalleByproducto($request);
        if($id!=0)
        {
            $this->_OrdenDetalleRepository->update($id,$detalle);            
            $this->_ordenServicioRepository->ActualizarTotalPagarOrdenservicio($request->orden_id);
        }
        else
        {
            $this->_sessionRepository->update(0,$detalle);
        }
        $data=[
            'orden_id'=>$request->orden_id,
            'message'=>'se ha actualizado un item del detalle',           
        ];                
        return json_encode($data);

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
        $request=request();       
        if ($request->orden_id==null)
        {
            $this->_sessionRepository->delete($id);
        }
        else
        {
            $this->_OrdenDetalleRepository->delete($id);            
            $this->_ordenServicioRepository->ActualizarTotalPagarOrdenservicio($request->orden_id); 
        }
        
        return back();
        //
    }
}
