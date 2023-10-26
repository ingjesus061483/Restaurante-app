<?php

namespace App\Http\Controllers;

use App\Models\Observacion;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreObeservacionRequest;
use App\Http\Requests\UpdateObeservacionRequest;
use App\Repositories\ObservacionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObservacionController extends Controller
{
    protected ObservacionRepository $_observacionRepository;
    public function __construct(ObservacionRepository $observacionRepository) {
        $this->_observacionRepository = $observacionRepository;
    }
    public function GetObservacions($codigo)
    {
        $observacions=$this->_observacionRepository->GetObservacions($codigo);
        $data=[
            "observaciones"=>count($observacions)>0?$observacions:$this->_observacionRepository->GetAll()
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
        $data=[
            "observaciones"=>$this->_observacionRepository->GetAll(),
        ];
        return view("Observaciones.index",$data);
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
        return view("Observaciones.create");
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
            'codigo'=>'required|max:50|unique:observacions',
            'descripcion'=>'required'    
        ]);
        $this->_observacionRepository->Store((object)$request->all());
        return redirect()->to(url('/observaciones'));
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }  
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }  
        $data=[
            "observacion"=>$this->_observacionRepository->Find($id),
        ];
        return view("Observaciones.edit",$data);
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
            'codigo'=>'required|max:50|unique:observacions,codigo,'.$id,
            'descripcion'=>'required'    
        ]);
        $this->_observacionRepository->Update($id,$request);
        return redirect()->to(url('/observaciones'));
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }  
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }  
        $this->_observacionRepository->Delete($id);
        return redirect()->to(url('/observaciones'));
        //
    }
}
