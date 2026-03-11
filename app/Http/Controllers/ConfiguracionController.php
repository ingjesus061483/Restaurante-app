<?php

namespace App\Http\Controllers;

use App\Models\configuracion;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\Configuracion\StoreRequest;
use App\Http\Requests\Configuracion\UpdateRequest;
use App\Repositories\ConfiguracionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ConfiguracionController extends Controller
{
    protected ConfiguracionRepository $_configuracionRepository;
    public function __construct(ConfiguracionRepository $configuracionRepository) {
        $this->_configuracionRepository = $configuracionRepository;
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
        $configuraciones=$this->_configuracionRepository->GetAll();
        $data=['configuraciones'=>$configuraciones];
        return view('Configuracion.index',$data);
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
    public function store(StoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(configuracion $configuracion)
    {
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
        $configuracion=$this->_configuracionRepository->Find($id);
        $data=['configuracion'=>$configuracion];
        return view('Configuracion.edit',$data);
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
        if(!$this-> autorizar(Auth::user()))
        {
            return back();
        }
        $this->_configuracionRepository->Update($id,(object)$request->all());
        return redirect()->to("configuracion");
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(configuracion $configuracion)
    {
        //
    }
}
