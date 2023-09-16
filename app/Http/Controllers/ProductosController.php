<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Repositories\CategoriaRepository;
use App\Repositories\ProductoRepository;
use App\Repositories\UnidadMedidaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    protected ProductoRepository $_productoRepository;
    protected UnidadMedidaRepository $_unidadMedidaRepository;
    protected CategoriaRepository $_categoriaRepository;
    public function __construct(ProductoRepository $productoRepository,
                                UnidadMedidaRepository $unidadMedidaRepository,
                                CategoriaRepository $categoriaRepository)
                                
    {
        $this->_productoRepository =$productoRepository;
        $this->_categoriaRepository=$categoriaRepository;
        $this->_unidadMedidaRepository=$unidadMedidaRepository;
    }
    public function loadProduct($search){
        $query="SELECT * FROM( SELECT productos.id,CONCAT( codigo,' - ',productos.nombre) AS nombre,
                costo_unitario,precio,foraneo,imagen,categorias.nombre AS categoria,unidad_medidas.nombre AS unidad_medida,
                IFNULL((SELECT SUM(cantidad)FROM existencias WHERE producto_id=productos.id AND entrada=1 
                GROUP BY producto_id),0)AS total_entrada,IFNULL((SELECT SUM(cantidad) FROM existencias 
                WHERE producto_id=productos.id AND entrada=0 GROUP BY producto_id),0) AS total_salida,
                IFNULL((SELECT SUM(cantidad) FROM existencias WHERE producto_id=productos.id AND entrada=1 GROUP BY 
                producto_id),0)-IFNULL((SELECT SUM(cantidad) FROM existencias WHERE producto_id=productos.id AND entrada=0 
                GROUP BY producto_id),0) AS total_inventario FROM productos JOIN categorias ON categorias.id=productos.categoria_id
                JOIN unidad_medidas ON unidad_medidas.id=productos.unidad_medida_id)AS productos_all 
                 WHERE nombre like ? and total_inventario>0";
        $data=[            
            'productos'=> DB::select($query,['%'.$search.'%'])
        ];
        return json_encode($data);
    }
    /**
     * Display a listing of the resource.
     */    
    public function index()
    {
        if(! Auth::check())
        {
            return redirect()->to('login');
        }        
        $data =[
            'productos'=>$this->_productoRepository->GetAll(),
        ];
        return view('Producto.index', $data);
        //
    }
    public function SearchProductById($id){
        $data=['producto'=> $this->_productoRepository->Find($id)];
        return json_encode($data);
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
       $categoria= $this->_categoriaRepository->GetAll();
       $unidadmedida=$this->_unidadMedidaRepository->GetAll();
       $data=[        
        'categorias'=>$categoria,
        'unidad_medida'=>$unidadmedida,
        ];
        return view('Producto.create',$data);
   
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
        $foraneo=$request->input('foraneo')==null?0:(bool)$request->input('foraneo');       
        if($foraneo==1)
        {
            $validacion=$request->validate([
                'codigo'=>'required|unique:productos|max:50',            
                'nombre'=>'required|max:255|min:3',            
                'costo_unitario'=>'required|numeric',            
                'precio'=>'required|numeric',            
                'categoria'=>'required' ,              
            ]); 
        }
        else{
            $validacion=$request->validate([
                'codigo'=>'required|unique:productos|max:50',            
                'nombre'=>'required|max:255|min:3',            
                'costo_unitario'=>'required|numeric',            
                'precio'=>'required|numeric',            
                'categoria'=>'required' ,            
                'preparacion'=>'required',
                'tiempo_coccion'=>'required|numeric'
            ]); 
        }
        $this->_productoRepository->Store($request);      
        return redirect()->to(url('/productos'));//
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }         
        if(!$this-> autorizar(Auth::user()))
        {
            return back();
        }                 
        $entradas=$this->_productoRepository->existencias($id,1); //Existencia:: where('entrada',1)->where('producto_id',$id)->get();
        $salidas=$this->_productoRepository->existencias($id);//Existencia:: where('entrada',0)->where('producto_id',$id)->get();
        $total_entrada= $this->_productoRepository->totalizarExistencia($id,1);//$entradas!=null? $this->totalizar($entradas):0;
        $total_salida=$this->_productoRepository->totalizarExistencia($id);//$salidas!=null?$this->totalizar($salidas):0;        
        $data=[
            'producto'=> $this->_productoRepository->Find($id),
            'unidad_medida'=>$this-> _unidadMedidaRepository->GetAll(),
            "entradas"=>$entradas,
            "salidas"=>$salidas,
            "total_entrada"=>$total_entrada,
            "total_salida"=>$total_salida
        ];     
        return view('Producto.show',$data);
        
    }    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }         
        if(!$this-> autorizar(Auth::user()))
        {
            return back();
        }            
       $categoria= $this-> _categoriaRepository->GetAll();
       $unidadmedida=$this-> _unidadMedidaRepository->GetAll();
       $data=[        
        'categorias'=>$categoria,
        'unidad_medida'=>$unidadmedida,
        'producto'=>$this->_productoRepository->Find($id),
        ];
        return view('Producto.edit',$data);

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }         
        if(!$this-> autorizar(Auth::user()))
        {
            return back();
        }            
        $foraneo=$request->input('foraneo')==null?0:(bool)$request->input('foraneo');       
        if($foraneo==1)
        {
            $validacion=$request->validate([
                'codigo'=>'required|max:50|unique:productos,codigo,'.$id,            
                'nombre'=>'required|max:255|min:3',            
                'costo_unitario'=>'required|numeric',            
                'precio'=>'required|numeric',            
                'categoria'=>'required' ,            
                
            ]); 
        }
        else{
            $validacion=$request->validate([
                'codigo'=>'required|max:50|unique:productos,codigo,'.$id,            
                'nombre'=>'required|max:255|min:3',            
                'costo_unitario'=>'required|numeric',            
                'precio'=>'required|numeric',            
                'categoria'=>'required' ,            
                'preparacion'=>'required',
                'tiempo_coccion'=>'required|numeric'
            ]); 
        }
        $this->_productoRepository->Update($id,$request);

        return redirect()->to(url('/productos'));//
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(! Auth::check())
        {
            return redirect()->to('login');
        }
        if(!Auth::check())
        {
            return redirect()->to('login');
        }         
        if(!$this-> autorizar(Auth::user()))
        {
            return back();
        }            
        $this->_productoRepository->Delete($id);
        return redirect()->to(url('/productos'));//       
    }
}
