<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MateriaPrima;
use App\Models\Categoria;
use App\Models\UnidadMedida;
use App\Models\Existencia;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMateriaPrimaRequest;
use App\Http\Requests\UpdateMateriaPrimaRequest;
use App\Repositories\CategoriaRepository;
use App\Repositories\MateriaPrimaRepository;
use App\Repositories\UnidadMedidaRepository;
use Illuminate\Support\Facades\DB;

class MateriaPrimaController extends Controller
{
    protected MateriaPrimaRepository $_materiaPrimaRepository;
    protected UnidadMedidaRepository $_unidadMedidaRepository;
    protected CategoriaRepository $_categoriaRepository;
    public function __construct(MateriaPrimaRepository $materiaPrimaRepository,
                                UnidadMedidaRepository $unidadMedidaRepository,
                                CategoriaRepository $categoriaRepository) 
    {
        $this->_materiaPrimaRepository=$materiaPrimaRepository;
        $this->_unidadMedidaRepository = $unidadMedidaRepository;
        $this->_categoriaRepository=$categoriaRepository;
    }
    public function LoadPrimaryMatter($search){             
        $data=[
            'materiaprimas'=>DB::select("SELECT CONCAT(codigo, ' - ',nombre) AS nombre FROM materia_primas 
            WHERE CONCAT(codigo, ' - ',nombre) LIKE ?",['%'.$search.'%']),
        ];
        return json_encode($data);

    }
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        $materiaprimas=$this->_materiaPrimaRepository->GetAll();
        $data=[            
            'materiaprimas'=>$materiaprimas
        ];
        return view('MateriaPrima.index',$data);
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
        if(!$this-> autorizar(Auth::user()))
        {
            return back();
        }      
       $categoria=$this->_categoriaRepository->GetAll();
       $unidadmedida=$this->_unidadMedidaRepository->GetAll();
       $data=[
           'categorias'=>$categoria,
           'unidad_medida'=>$unidadmedida,        
        ];
        return view('MateriaPrima.create',$data);   
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
            'codigo'=>'required|unique:materia_primas|max:50',            
            'nombre'=>'required|max:255|min:3',            
            'costo_unitario'=>'required|numeric',            
            'unidad_medida'=>'required',
            'categoria'=>'required' ,            
            'existencias'=>'required|numeric'
        ]);
        $insumo= $this->_materiaPrimaRepository->Store($request);        
        return redirect()->to(url("/materiaprimas/$insumo->id"));                
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        if(!$this-> autorizar(Auth::user()))
        {
            return back();
        }
        $materiaprima=$this->_materiaPrimaRepository->Find($id); //materiaprima::find($id);
        $entradas=$this->_materiaPrimaRepository->existencias($id,1); //Existencia:: where('entrada',1)->where('materia_prima_id',$id)->get();
        $salidas=$this->_materiaPrimaRepository->existencias($id);// Existencia:: where('entrada',0)->where('materia_prima_id',$id)->get();
        $total_entrada=$this->_materiaPrimaRepository ->totalizarExistencia($id,1);
        $total_salida=$this->_materiaPrimaRepository-> totalizarExistencia($id);        
        $data=[
            "materiaprima"=>$materiaprima,         
            "entradas"=>$entradas,
            "salidas"=>$salidas,
            "total_entrada"=>$total_entrada,
            "total_salida"=>$total_salida
        ];
        return view("MateriaPrima.show",$data);        
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();
        }        
        $materiaprima=$this-> _materiaPrimaRepository->Find($id);
        $categoria=$this->_categoriaRepository->GetAll();
        $unidadmedida=$this->_unidadMedidaRepository->GetAll();
        $data=[            
            'categorias'=>$categoria,
            'unidad_medida'=>$unidadmedida,
            'materiaprima'=>$materiaprima
        ];
        return view('MateriaPrima.edit',$data);
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
        $validacion=$request->validate([
            'codigo'=>'required|max:50|unique:materia_primas,codigo,'.$id,            
            'nombre'=>'required|max:255|min:3',            
            'costo_unitario'=>'required|numeric',            
            'unidad_medida'=>'required',
            'categoria'=>'required' 
        ]);    
        $this->_materiaPrimaRepository->Update($id ,$request);            
        return redirect()->to(url('/materiaprimas'));                
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        if(!$this-> autorizar(Auth::user()))
        {
            return back();
        }        
        $this->_materiaPrimaRepository->Delete($id);
        return redirect()->to(url('/materiaprimas'));                
        //
    }
}
