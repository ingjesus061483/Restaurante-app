<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Dependencia\StoreRequest;
use App\Http\Requests\Dependencia\UpdateRequest;
use Illuminate\Support\Facades\Auth;
class DependenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AutorizeRequest $request)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }

        $data=[
            'dependencias'=>Dependencia::all(),
        ];
        return view('Dependencia.index',$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( AutorizeRequest $request)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        return view('Dependencia.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $dependencia=new Dependencia();
        $dependencia->codigo=$request->codigo;
        $dependencia->nombre=$request->nombre;
        $dependencia->descripcion=$request->descripcion;
        $dependencia->save();
        return redirect()->route('dependencias.index');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dependencia $dependencia)
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
        $data=[
            'dependencia'=>Dependencia::find($id),
        ];
        return view('Dependencia.edit',$data);

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
        $dependencia=Dependencia::find($id);
        $dependencia->codigo=$request->codigo;
        $dependencia->nombre=$request->nombre;
        $dependencia->descripcion=$request->descripcion;
        $dependencia->save();
        return redirect()->route('dependencias.index');
         //


        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy (AutorizeRequest $request, $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
         }
        $dependencia=Dependencia::find($id);
        $dependencia->delete();
        return redirect()->route('dependencias.index');

        //
    }
}
