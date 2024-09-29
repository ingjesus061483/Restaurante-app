<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\Cabana\StoreRequest;
use App\Http\Requests\Cabana\UpdateRequest;
use App\Repositories\CabanaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\OrdenServicioRepository;
class CabanaController extends Controller
{
   private CabanaRepository $_repository;
   private OrdenServicioRepository $_ordenServicioRepository;
    public function __construct( CabanaRepository $repository, OrdenServicioRepository $OrdenServicioRepository)     
    {
        $this->_repository=$repository;
        $this->_ordenServicioRepository=$OrdenServicioRepository;
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
    public function create(AutorizeRequest $request)
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
    public function store(StoreRequest $request)
    {         
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        /*if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }
        $validacion=$request->validate([
            'codigo'=>'required|unique:cabañas|max:50',            
            'nombre'=>'required|max:50',           
            'capacidad'=>'required|numeric',
        ]);*/
        $this->_repository->Store($request);          
        return redirect()->to(url('/cabañas'));         
    }

    /**
     * Display the specified resource.
     */
    public function show(int  $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }         

        $cabana=$this->_repository->Find($id);
        if($cabana->ocupado==1)
        {
            $ordenservicio=$this->_ordenServicioRepository-> GetOrdenByMesa($id);
            if($ordenservicio!=null)
            {
                return redirect()->to(url('/ordendetalles/'.$ordenservicio->id.'/edit'));           
            }
            return back()->withErrors("La mesa no se encuentra disponible");
        }
        session(['cabana' => $cabana]);   
        if (!session()->has('detalles'))
        {
            return redirect()->to(url('/ordendetalles/create'));           
        }    
        return  redirect()->to('ordenservicio/create');
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AutorizeRequest $request, int $id)
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
    public function update(UpdateRequest $request, string $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }        
      /*  $validacion=$request->validate([
            'codigo'=>'required|max:50|unique:cabañas,codigo,'.$id,            
            'nombre'=>'required|max:50',           
            'capacidad'=>'required|numeric',            
        ]);*/
        $this->_repository->Update($id,$request);   
        return redirect()->to(url('/cabañas'));       
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AutorizeRequest $request, int $id)
    { 
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
      /*  if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }*/
        $this->_repository->Delete($id);
        return redirect()->to(url('/cabañas'));      

        //
    }
}
