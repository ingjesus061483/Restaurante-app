<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    protected ClienteRepository $_repository;   
    public function __construct(ClienteRepository $repository ) {
        $this->_repository=$repository;
    }
    public function GetClientes($cliente)
    {
        $clientes=$this->_repository->Getclientes();
        $data=[
            "clientes"=>$clientes
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
            'clientes'=> $this->_repository->GetAll()
        ];
        return view ('Cliente.index',$data);      
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
      /*  if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }*/
        $empresa=Auth::user()->empresa;
        $data=[
            "empresa"=>$empresa
        ];
        return view ('Cliente.create',$data);
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
        /*if(!$this-> autorizar(Auth::user()))
        {
            return back();              
        }*/
        $validacion=$request->validate([
            'identificacion'=>'required|unique:clientes|max:50',
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',            
            'name'=>'required|unique:users',
            'email'=>'required|email|max:255|unique:users',
            'password'=>['required','confirmed',Password::default()],            
        ]);        
        $this->_repository->Store(((object)$request->all() ));
        return redirect()->to(url('/clientes'));
        //
    }

    /**
     * Display the specified resource.
     */
    public function showClient( $id)    
    {
        $data=[
            "cliente"=>$this-> _repository->Getcliente($id)
        ];
        return json_encode($data);
    }
    public function show( $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $data=[
            "cliente"=>$this-> _repository->Find($id)
        ];
        return view('Cliente.show',$data);
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
            'cliente'=>$this->_repository->Find($id),
        ];
        return view ('Cliente.edit',$data);
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
            'identificacion'=>'required|max:50|unique:clientes,identificacion,'.$id,
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'email'=>'required|email|max:255',            
        ]);
        $this->_repository->Update($id,(object)$request->all());        
        return redirect()->to(url('/clientes'));

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
        $this->_repository->Delete($id);       
        return redirect()->to(url('/clientes'));
        //
    }
}
