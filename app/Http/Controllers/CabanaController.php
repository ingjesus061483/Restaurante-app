<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\CabanaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabanaController extends Controller
{
   private CabanaRepository $_repository;
    public function __construct( CabanaRepository $repository)     
    {
        $this->_repository=$repository;
        
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
            'cabanas'=>$this->_repository->GetAll(),
        ];
        return view ('Cabana.index',$data);
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
       
        return view('Cabana.create');
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
       
        $validacion=$request->validate([
            'codigo'=>'required|unique:cabañas|max:50',            
            'nombre'=>'required|max:50',           
            'capacidad'=>'required|numeric',
            'precio'=>'required|numeric',
        ]);
        $this->_repository->Store((object)$request->all());          
        return redirect()->to(url('/cabañas'));         
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
       
        $data=[       
            'cabana'=>$this->_repository->Find($id),
        ];
        return view('Cabana.edit',$data);
        
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
       
        $validacion=$request->validate([
            'codigo'=>'required|max:50|unique:cabañas,codigo,'.$id,            
            'nombre'=>'required|max:50',           
            'capacidad'=>'required|numeric',
            'precio'=>'required|numeric',
        ]);
        $this->_repository->Update($id,(object)$request->all());   
        return redirect()->to(url('/cabañas'));       
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
        $this->_repository->Delete($id);
        return redirect()->to(url('/cabañas'));      

        //
    }
}
