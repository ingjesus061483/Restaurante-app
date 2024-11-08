<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use App\Repositories\ProveedorRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\Proveedor\StoreRequest;
use App\Http\Requests\Proveedor\UpdateRequest;
use Illuminate\Support\Facades\Auth;
class ProveedorController extends Controller
{
    protected ProveedorRepository $proveedorRepository;
    function __construct(ProveedorRepository $_proveedorRepository)
    {     
        $this->proveedorRepository=$_proveedorRepository;
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
            "proveedores"=>$this->proveedorRepository->getAll(),
        ];
        
        return view("Proveedores.index",$data);        
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
        return view("Proveedores.Create");
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
             
        $this->proveedorRepository->Store($request);        
        return redirect()->to(url('/proveedores'));
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
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
            'proveedor'=>$this->proveedorRepository->Find($id),
        ];
        return view ('Proveedores.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,int $id) 
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
             
        $this->proveedorRepository->Update($id,$request);        
        return redirect()->to(url('/proveedores'));
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        
        $this->proveedorRepository->Delete($id);       
        return redirect()->to(url('/proveedores'));
        //
    }
}
