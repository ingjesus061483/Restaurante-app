<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dependencia;
use App\Repositories\MesaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mesa;
class HomeController extends Controller
{
    protected MesaRepository $_cabanaRepository;
    public function __construct(MesaRepository $cabanaRepository)
    {
        $this->_cabanaRepository = $cabanaRepository;
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
        $dependencias=Dependencia::all();
        $arrdependencias=[];
        foreach($dependencias as $item)
        {
            $arrdependencias[]=(object)[
                "dependencia"=>$item,
                "Mesas"=>Mesa::select ("mesas.id","mesas.codigo","mesas.nombre","mesas.ocupado","mesas.descripcion","mesas.capacidad_maxima","mesas.imagen","dep.nombre as dependencia")
                               ->join('dependencias as dep', 'mesas.dependencia_id', '=', 'dep.id')
                               ->selectRaw("IFNULL((SELECT  SUM(orden_encabezados.total) FROM orden_encabezados WHERE mesa_id=mesas.id AND fecha=CURDATE() AND  estado_id=3),0) as venta_diaria")
                               ->where('mesas.dependencia_id',$item->id)
                               ->orderby('mesas.nombre','asc') ->get()
            ];
        }
        $data=[

            "dependencias"=>$arrdependencias,
        ];


        return view('Home.index',$data);
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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
