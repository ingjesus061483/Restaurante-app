<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Impuesto;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\StoreImpuestoRequest;
use App\Http\Requests\UpdateImpuestoRequest;
use App\Repositories\EmpresaRepository;
use App\Repositories\ImpuestoRepository;
use Illuminate\Support\Facades\Auth;

class ImpuestoController extends Controller
{
    protected ImpuestoRepository $_impuestoRepository;
    protected EmpresaRepository $_empresaRepository;
    public function __construct(ImpuestoRepository $impuestoRepository,
                                EmpresaRepository $empresaRepository ) {
        $this->_impuestoRepository = $impuestoRepository;
        $this->_empresaRepository=$empresaRepository;
    }
    public function CalcularImpuestos($subtotal)
    {
        $user=Auth::user();        
        $empresa= $this->_empresaRepository->Find( $user->empresa_id);        
        if ($empresa-> tipo_regimen_id==1)
        {            
            return json_encode(['impuestos'=> 0]);
        }
        return json_encode(['impuestos'=> $this->_impuestoRepository->CalcularImpuestos($subtotal)]);    
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
            'impuestos'=> $this->_impuestoRepository->GetAll()
        ];
        return view ('Impuesto.index',$data);      
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
        return view ('Impuesto.create');        
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
        if(!$this-> autorizar(Auth::user()))
        {
            return back();
        }      
        $validacion=$request->validate(
            ['nombre'=>'required|max:50',
            'valor'=>'required|numeric',
        ]);
        $this->_impuestoRepository->Store($request); 
        return redirect()->to(url('/impuestos'));
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Impuesto $impuesto)
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
            'impuesto'=>$this-> _impuestoRepository-> Find($id),
        ];
        return view ('Impuesto.edit',$data);             //
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
        $validacion=$request->validate(
            ['nombre'=>'required|max:50',
            'valor'=>'required|numeric',
        ]);
        $this->_impuestoRepository->Update($id,$request); 
        return redirect()->to(url('/impuestos'));       
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
        $this->_impuestoRepository->Delete($id);
        return redirect()->to(url('/impuestos'));       
        //
    }
}
