<?php

namespace App\Http\Controllers;

use App\Contracts\IRepository;
use App\Models\Empresa;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Models\TipoRegimen;
use App\Repositories\EmpresaRepository;
use App\Repositories\TipoRegimenRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    protected EmpresaRepository $_empresaRepository;
    protected TipoRegimenRepository $_tipoRegimenRepository;
    public function __construct(EmpresaRepository $empresaRepository,TipoRegimenRepository $tipoRegimenRepository) {

        $this->_empresaRepository = $empresaRepository;
        $this->_tipoRegimenRepository=$tipoRegimenRepository;
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
            'empresas'=> $this->_empresaRepository->GetAll()
        ];
        return view ('Empresa.index',$data);
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
            'tipo_regimen'=>$this->_tipoRegimenRepository->GetAll()        
        ];
        return view ('Empresa.create',$data);
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
        $validacion=$request->validate([
            'nit'=>'required|unique:empresas|max:50',
            'nombre'=>'required|max:50',
            'camara_de_comercio'=>'required|max:50',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'email'=>'required|email|max:255',
            'contacto'=>'required',
            'tipo_regimen'=>'required',            
        ]);                
        $this->_empresaRepository->Store($request);
        return redirect()->to(url('/empresas'));
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
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
            'tipo_regimen'=>$this->_tipoRegimenRepository->GetAll(),
            'empresa'=>Empresa::find($id)
        ];
        return view ('Empresa.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(request $request, $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }  
        if(!$this-> autorizar(Auth::user()))
        {
            return back();            
        }
        $validacion=$request->validate([
            'nit'=>'required|max:50|unique:empresas,nit,'.$id,
            'nombre'=>'required|max:50',
            'camara_de_comercio'=>'required|max:50',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'email'=>'required|email|max:255',
            'contacto'=>'required',
            'tipo_regimen'=>'required',            
        ]);                
        $this->_empresaRepository->Update($id,$request);    
        return redirect()->to(url('/empresas'));
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AutorizeRequest $request, $id)
    {        
        try
        {
            if(!Auth::check())
            {
                return redirect()->to('login');
            }  
            $this-> _empresaRepository->Delete($id);
            return redirect()->to(url('/empresas'));        
        }
        catch(Exception $ex)
        {
            back()->withErrors($ex->getMessage());
        }
        //
    }
}
