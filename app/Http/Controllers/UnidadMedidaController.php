<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\StoreUnidadMedidaRequest;
use App\Http\Requests\UpdateUnidadMedidaRequest;
use App\Repositories\UnidadMedidaRepository;
use Illuminate\Support\Facades\Auth;

class UnidadMedidaController extends Controller
{
    protected UnidadMedidaRepository $_repository;
    public function __construct(UnidadMedidaRepository $repository ) {
        $this->_repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(AutorizeRequest $request)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
        $unidadMedidas=$this->_repository->GetAll();
        $data=[            
            'unidadMedidas'=>$unidadMedidas
        ];
        return view('UnidadMedida.index',$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AutorizeRequest $request)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }         
        return view('UnidadMedida.create');
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
        $validacion=$request->validate(['nombre'=>'required|max:50']);
        $this->_repository->Store($request);
        return redirect()->to(url('/unidad_medida'));   
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UnidadMedida $unidadMedida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AutorizeRequest $request, string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }         
        $unidadMedida=$this->_repository->Find($id);
        $data=[            
            'unidadMedida'=>$unidadMedida
        ];
        return view('UnidadMedida.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }         
        if(!$this-> autorizar(Auth::user()))
        {
            return back();
        }            
        $validacion=$request->validate(['nombre'=>'required|max:50']);
        $this->_repository->Update($id,$request);
        return redirect()->to(url('/unidad_medida'));       
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AutorizeRequest $request, string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }         
        $this->_repository->Delete($id);        
        return redirect()->to(url('/unidad_medida'));       
        //
    }
}
