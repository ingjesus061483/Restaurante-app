<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\StorePagoDetalleRequest;
use App\Http\Requests\UpdatePagoDetalleRequest;
use App\Models\PagoDetalle;
use App\Repositories\FormaPagoRepository;
use App\Repositories\PagoDetalleRepository;
use Database\Factories\FormaPagoFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Else_;

class PagoDetalleController extends Controller
{
    protected FormaPagoRepository $_formaPagoRepository;
    protected PagoDetalleRepository $_pagoDetalleRepository;
    public function __construct(FormaPagoRepository $formaPagoRepository, PagoDetalleRepository $pagoDetalleRepository) {
        $this->_formaPagoRepository = $formaPagoRepository;
        $this->_pagoDetalleRepository=$pagoDetalleRepository;
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
        $user=Auth::user();                
        if(! $this->autorizar($user))        
        {
            return  back();        
        }
        $fechaini=request()->fechaIni;
        $fechafin=request()->fechaFin;
        $forma_pago= request()->forma_pago;
        if($fechaini==null&&$fechafin==null)
        {
            $pagos= $this->_pagoDetalleRepository->Totalizar($forma_pago);
        }
        else
        {
            $fechaini=$fechaini!=null?$fechaini:date('yyyy-MM-dd');
            $fechafin=$fechafin!=null?$fechafin:date('yyyy-MM-dd');
            $pagos=$this->_pagoDetalleRepository->TotalizarPeriodo($forma_pago,$fechaini,$fechafin);

        }

        $data=[
            'pagosdetalles'=>$pagos, 
            'fechaIni'=>$fechaini,
            'fechaFin'=>$fechafin,
            'formaPagos'=>$this->_formaPagoRepository->GetAll() ,
            'formaPago'=> $forma_pago         
        ];
        return  view('PagoDetalle.index',$data);      
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
        if(!Auth::check())
        {
            return redirect()->to('login');   
        }      
        $user=Auth::user();                
        if(! $this->autorizar($user))        
        {
            return  back();        
        }   
        $detalles=[];                
        $id=1;                       
        if(session()->has('pagodetalles'))                
        {           
           $detalles=session('pagodetalles');                   
           $id=count($detalles)+1;                                
        }
        $encontrado=false;
        foreach($detalles as $item){
            if($item->forma_pago_id==$request->forma_pago_id){
                $encontrado=true;
                break;            
            }
        }
        if($encontrado)
        {
            $acum=0;                
            foreach($detalles as $item)            
            {           
                $acum=$acum+ $item->valor_recibido;                               
            }
            $acum=$acum+$request->valorRecibido;
            if(!$acum<=$request->totalpagar)
            {
                $detalles[]=(object)[                            
                    'id'=>$id,  
                    'pago_id'=>null,              
                    'forma_pago_id'=>$request->forma_pago,
                    'forma_pago'=>$this->_formaPagoRepository->Find($request->forma_pago)->nombre,
                    'detalle_pago'=>$request->detallepago,
                    'valor_recibido'=>$request->valorRecibido,            
                ];                            
            }           
            $data=[            
                "message"=>"has insertado un pago" ,
                "error"=>false        
            ];
        }
        else{
            $data=[            
                "message"=>"inserte otra forma de pago",
                "error"=>true 
            ];
        }
        session(['pagodetalles' => $detalles]);                            
        return json_encode($data);        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PagoDetalle  $pagoDetalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PagoDetalle $pagoDetalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePagoDetalleRequest $request, PagoDetalle $pagoDetalle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PagoDetalle $pagoDetalle)
    {
        //
    }
}
