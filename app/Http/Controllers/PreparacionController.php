<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Preparacion;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePreparacionRequest;
use App\Http\Requests\UpdatePreparacionRequest;
use App\Models\MateriaPrima;
use App\Repositories\IngredienteRepository;
use App\Repositories\MateriaPrimaRepository;
use App\Repositories\ProductoRepository;
use Illuminate\Support\Facades\Auth;

class PreparacionController extends Controller
{
    protected ProductoRepository $_productoRepository;
    protected MateriaPrimaRepository $_materiaprimaRepository;
    protected IngredienteRepository $_ingredienteRepository;
    public function __construct(ProductoRepository $productoRepository ,
                                IngredienteRepository $ingredienteRepository,
                                MateriaPrimaRepository $materiaPrimaRepository) {
        $this->_productoRepository = $productoRepository;
        $this->_materiaprimaRepository=$materiaPrimaRepository;
        $this->_ingredienteRepository=$ingredienteRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $producto_id=request()->input('producto');
        $preparacions=$this->_productoRepository->ingredientes($producto_id);// Preparacion::select('materia_prima_id')->where('producto_id',$producto_id)->get();        
        $materiaprimas=$this->_materiaprimaRepository->BuscarMateriaPrimaEnIgrediente($preparacions);
        $data=[
            'materiaprimas'=>$materiaprimas,// MateriaPrima::whereNotIn('id',$preparacions)->get(),
            'producto_id'=>$producto_id,
        ];
        return view ('Ingrediente.create',$data);

        

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
        $materia_prima_id=$request->input('materia_prima_id');        
        $producto_id =$request->input('producto_id');                      
        $preparacion=$this->_ingredienteRepository->BuscarIngredientesMateriaprimaproducto($materia_prima_id,$producto_id) ; 
        if($preparacion!=null){
            $arr=['message'=>'La materia prima ya se encuentra registrada en estos ingredientes'];
            return json_encode($arr);            
        }
        $this->_ingredienteRepository->Store($request);           
        return json_encode(['message'=>'Se ha registrado um ingrediente']);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Preparacion $preparacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Preparacion $preparacion)
    {
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
        $this ->_ingredienteRepository->Update($id,$request);
        return json_encode(['message'=>'Se ha actualizado um ingrediente']);        //
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
        $this->_ingredienteRepository->Delete($id);
        return back();       
        //
    }
}
