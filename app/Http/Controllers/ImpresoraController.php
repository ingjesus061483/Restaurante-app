<?php

namespace App\Http\Controllers;

use App\Models\Impresora;
use App\Http\Controllers\Controller;
use App\Repositories\ImpresoraRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpresoraController extends Controller
{
    protected  ImpresoraRepository $_impresoraRepository;
    public function __construct(ImpresoraRepository $impresoraRepository ) {
        $this->_impresoraRepository = $impresoraRepository;
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
        return view ('Impresora.index',$data);       //
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
        return view('Impresora.create');
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
    public function show(Impresora $impresora)
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
        return view('Impresora.edit',$data);
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
}
