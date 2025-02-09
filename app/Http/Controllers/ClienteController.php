<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\Cliente\StoreRequest;
use App\Http\Requests\Cliente\UpdateRequest;
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
    public function create(AutorizeRequest $request)
    {        
        $empresa=Auth::user()->empresa;
        $data=[
            "empresa"=>$empresa
        ];
        return view ('Cliente.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {   
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
             
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
    public function edit(AutorizeRequest $request, $id)
    {   
        if(!Auth::check())
        {
            return redirect()->to('login');
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
    public function update(UpdateRequest $request, $id)
    {   
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
             
        $this->_repository->Update($id,(object)$request->all());        
        return redirect()->to(url('/clientes'));

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AutorizeRequest $request, $id)
    {        
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        
        $this->_repository->Delete($id);       
        return redirect()->to(url('/clientes'));
        //
    }
}
