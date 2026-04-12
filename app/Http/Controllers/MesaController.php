<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\Mesa\StoreRequest;
use App\Http\Requests\Mesa\UpdateRequest;
use App\Models\Dependencia;
use App\Repositories\MesaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\OrdenServicioRepository;
class MesaController extends Controller
{
   private MesaRepository $_repository;
   private OrdenServicioRepository $_ordenServicioRepository;
    public function __construct( MesaRepository $repository, OrdenServicioRepository $OrdenServicioRepository)
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
        return view('Mesa.index',$data);
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
        $data=[
            'dependencias'=>Dependencia::all(),
        ];

        return view('Mesa.create',$data);
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
        $this->_repository->Store($request);
        return redirect()->to(url('/mesas'));
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
               if( session()->has ('detalles'))
               {
                  return redirect()->to("ordendetalles?id=$id");
               }
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
            'dependencias'=>Dependencia::all(),
        ];
        return view('Mesa.edit',$data);

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
        $this->_repository->Update($id,$request);
        return redirect()->to(url('/mesas'));
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
        $this->_repository->Delete($id);
        return redirect()->to(url('/mesas'));

        //
    }
}
