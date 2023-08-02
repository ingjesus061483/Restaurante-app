<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Repositories\CabanaRepository;
use App\Repositories\EmpresaRepository;
use App\Repositories\FormaPagoRepository;
use App\Repositories\ImpuestoRepository;
use App\Repositories\OrdenServicioRepository;
use App\Repositories\PagoRepository;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    protected CabanaRepository $_cabanaRepository;
    protected PagoRepository $_pagoRepository;
    protected FormaPagoRepository $_formapagoRepository;
    protected OrdenServicioRepository $_ordenServicioRepository;
    protected ImpuestoRepository $_impuestoRepository;
    protected EmpresaRepository $_empresaRepository;
    public function __construct(
                                CabanaRepository $cabanaRepository,
                                PagoRepository $pagoRepository,    
                                ImpuestoRepository $impuestoRepository,
                               EmpresaRepository $empresaRepository,
                               FormaPagoRepository $formaPagoRepository,
                               OrdenServicioRepository $ordenServicioRepository)
   {
    $this->_cabanaRepository=$cabanaRepository;
    $this->_pagoRepository=$pagoRepository;
    $this->_formapagoRepository=$formaPagoRepository;
    $this->_empresaRepository=$empresaRepository;
    $this->_impuestoRepository=$impuestoRepository;
    $this->_ordenServicioRepository=$ordenServicioRepository;
    
   }   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $id=request()->input('id');   
        $user=Auth::user();        
        $empresa= $this->_empresaRepository->Find( $user->empresa_id);        
        $ordenServicio=$this->_ordenServicioRepository->Find($id);        
        $subtotal=$this->_ordenServicioRepository-> totalizarOrden( $ordenServicio->orden_detalles) ;
        $impuesto=0;
        if ($empresa-> tipo_regimen_id==2)
        {
            $impuesto=$this->_impuestoRepository->CalcularImpuestos($subtotal);
        }

        $data=[   
            'forma_pago'=>$this->_formapagoRepository->GetAll(),    
            'ordenServicio'=>$ordenServicio,  
            'orden_detalle'=>   $ordenServicio->orden_detalles,
            'subtotal'=>$subtotal,
            'impuesto'=>$impuesto
        ];
        return view ('Pagos.create',$data);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion=$request->validate([
            'codigo'=>'required|unique:pafos|max:50',            
            'fecha_hora'=>'required|max:255|min:3',                        
            'subtotal'=>'required|numeric',                        
            'impuesto'=>'required|numeric',                        
            'descuento'=>'required|numeric',                      
            'total_pagar'=>'required|numeric',                     
            'recibido'=>'required|numeric',                      
            'forma_pago'=>'required' ,                      
        ]);             
        $ordenServicio=$this->_ordenServicioRepository->Find($request->input('orden_id'));
        $this->_pagoRepository->Store((object)$request->all());
        $this->_ordenServicioRepository->PagarOrden($ordenServicio->id);
        $cabana_id=$ordenServicio->cabaña==null?0:$ordenServicio->cabaña->id;
        $this->_cabanaRepository->desocuparCabana($cabana_id);
        return redirect()->to(url('/ordenservicio'));  
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
