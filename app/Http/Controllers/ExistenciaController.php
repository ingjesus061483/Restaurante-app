<?php

namespace App\Http\Controllers;

use App\Models\Existencia;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExistenciaRequest;
use App\Http\Requests\UpdateExistenciaRequest;
use App\Models\materiaprima;
use App\Repositories\ExistenciaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class ExistenciaController extends Controller
{
    protected ExistenciaRepository $_existenciaRepository;
    public function __construct(ExistenciaRepository $existenciaRepository) {        
        $this->_existenciaRepository = $existenciaRepository;
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
        $inventario_view=$this->_existenciaRepository->GetAll();
        $data=[
            'inventario'=> $inventario_view,          
            'total_inventario'=>$this->_existenciaRepository->totalizarInventario(),
        ];
        return view('Inventario.index',$data);
        //
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        if(!Auth::check())
        {
            return json_encode([
                'aut'=>false,
                "id"=>null,
                "tipo"=>'',
                "mensaje"=>"El usuario no ha sido logueado",
            ]);
        }
        if(!$this->autorizar(Auth::user()))
        {
            return json_encode([
                'aut'=>false,
                "id"=>null,
                "tipo"=>'',
                "mensaje"=>"El usuario no ha sido autorizado para esta operacion",
            ]);
        }
        $tipo=$request->input('tipo');     
        $this->_existenciaRepository->Store((object)$request->all());           
        return json_encode([
            'aut'=>true,
            "id"=> $request->input('materiaprima_id'),
            'tipo'=>$tipo,
            "mensaje"=>"Las existencias para ".$tipo." materiaprima han aumentado",
        ]);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Existencia $existencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Existencia $existencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExistenciaRequest $request, Existencia $existencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Existencia $existencia)
    {
        //
    }
}
