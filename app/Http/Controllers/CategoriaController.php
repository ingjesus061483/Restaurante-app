<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categoria\CreateRequest;
use App\Http\Requests\Categoria\DeleteRequest;
use App\Http\Requests\Categoria\IndexRequest;
use App\Http\Requests\Categoria\StoreRequest;
use App\Http\Requests\Categoria\UpdateRequest;
use App\Repositories\CategoriaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
     protected CategoriaRepository $_repository;
      public function __construct(CategoriaRepository $repository) 
      {        
        $this->_repository=$repository;
      }
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
     /*   if(!Auth::check())
        {
            return redirect()->to('login');
        }    */
        $categorias=$this->_repository->GetAll();
        $data=[    
            'categorias'=>$categorias
        ];
        return view('Categoria.index',$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequest $request)
    {
    /*    if(!Auth::check())
        {
            return redirect()->to('login');
        }  
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }       */
        return view('Categoria.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
       /* if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        } 
        print_r($request->all());
        exit();    
        $validacion=$request->validate(['nombre'=>'required|max:50']);*/
        $this->_repository->Store((object)$request->all());
        return redirect()->to(url('/categorias'));       
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
    public function edit(string $id )
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }     
        $categoria=$this->_repository->Find($id);
        $data=[    
            'categoria'=>$categoria
        ];
        return view('Categoria.edit',$data);
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
       /* if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }    
        $validacion=$request->validate(['nombre'=>'required|max:50']);*/
        $this->_repository->Update($id,(object)$request->all());
        return redirect()->to(url('/categorias'));        
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request,  string $id)
    {    
       /* if(!Auth::check())
        {
            return redirect()->to('login');
        }
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }*/     
        $this->_repository->Delete($id);
        return redirect()->to(url('/categorias'));    
        //
    }
}
