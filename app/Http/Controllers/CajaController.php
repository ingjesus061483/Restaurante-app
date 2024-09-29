<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\Caja\StoreRequest;
use App\Http\Requests\Caja\UpdateRequest;
use App\Repositories\CajaMovimientoRepository;
use App\Repositories\CajaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    protected CajaRepository $_cajaRepository;
    protected CajaMovimientoRepository $_cajaMovimientoRepository;
    public function __construct(CajaRepository $cajaRepository, CajaMovimientoRepository $cajaMovimientoRepository) 
    {
        $this->_cajaMovimientoRepository=$cajaMovimientoRepository;
        $this->_cajaRepository = $cajaRepository;
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
        $data=[
            'cajas'=>$this->_cajaRepository->GetAll()
        ];
        return view ('Caja.index',$data);

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
        return view ('Caja.create');
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
        $this->_cajaRepository->Store($request);        
        return redirect()->to(url('/cajas'));    
        //
    }

    /**
     * Display the specified resource.
     */
    public function show (AutorizeRequest $request, int $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $fechaIni=request()->fechaIni;
        $fechaFin=request()->fechaFin;
        $caja=$this->_cajaRepository->Find($id);
        if($fechaIni==null && $fechaFin===null)
        {
            $cajaMovimientos=$this->_cajaMovimientoRepository->GetAll()
                                                             ->where('cajas.id',$id)
                                                             ->get();
        }
        else
        {            
            $fechaIni=$fechaIni==null?date("Y-m-d H:i:s"):$fechaIni;
            $fechaFin=$fechaFin==null?date("Y-m-d H:i:s"):$fechaFin;            
            $cajaMovimientos=$this->_cajaMovimientoRepository->GetAll()
                                                             ->where('cajas.id',$id)
                                                             ->whereBetween('caja_movimientos.fecha_hora',[
                                                                 $fechaIni,$fechaFin
                                                                ])                                                                
                                                            ->get();
        }
        $ingreso=$this->_cajaMovimientoRepository->ValorByIngreso($id,1);
        $egreso=$this->_cajaMovimientoRepository->ValorByIngreso($id);       
        $data=[
            'caja'=>$caja,
            'ingreso'=>$ingreso!=null?$ingreso->Valor_total:0,
            'egreso'=>$egreso!=null?$egreso->Valor_total:0,
            'cajaMovimientos'=>$cajaMovimientos
        ];
        return view('Caja.show',$data);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit (AutorizeRequest $request, int $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
       
        $data=[
            'caja'=>$this->_cajaRepository->find($id)
        ];
        return view ('Caja.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, int $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $this->_cajaRepository->Update($id,$request);
        return redirect()->to(url('/cajas'));  
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
        $this->_cajaRepository->Delete($id);
        return redirect()->to(url('/cajas'));         

        //
    }
}
