<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\Empresa;
use App\Models\Role;
use App\Models\User;
use App\Repositories\EmpleadoRepository;
use App\Repositories\EmpresaRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class EmpleadoController extends Controller
{
    protected RoleRepository $_roleRepository;  
    protected EmpleadoRepository $_empleadoRepository;
    protected EmpresaRepository $_empresaRepository;
    public function __construct(RoleRepository $roleRepository,
                                EmpleadoRepository $empladoRepository,
                                EmpresaRepository $empresaRepository) 
    {
        $this->_roleRepository=$roleRepository;
        $this->_empleadoRepository=$empladoRepository;        
        $this->_empresaRepository=$empresaRepository;
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
            'empleados'=>$this->_empleadoRepository->GetAll()
        ];
        return view ('Empleado.index',$data);
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
        $data=[
            
            'roles'=>$this->_roleRepository->GetAll(),
            'empresas'=>$this-> _empresaRepository->GetAll(),
        ];
        return view ('Empleado.create',$data);
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
        $validacion=$request->validate([
            'identificacion'=>'required|unique:empleados|max:50',
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'role'=>'required',
            'empresa'=>'required',
            'name'=>'required|unique:users',
            'email'=>'required|email|max:255|unique:users',
            'password'=>['required','confirmed',Password::default()],            
        ]);  
        $this->_empleadoRepository->Store((object) $request->all());
        return redirect()->to(url('/empleados'));    
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $data=[
         
            'roles'=>$this->_roleRepository->GetAll(),
            'empleado'=>$this ->  _empleadoRepository-> Find($id)
        ];
        return view ('Empleado.edit',$data);       
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $validacion=$request->validate([
            'identificacion'=>'required|max:50|unique:empleados,identificacion,'.$id,
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'email'=>'required|email|max:255',
            'role'=>'required'
        ]);
        $this->_empleadoRepository->Update($id,(object)$request->all());
        return redirect()->to(url('/empleados'));
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        if(!Auth::check())
        {
            return redirect()->to('login');
        }    
        $this-> _empleadoRepository->Delete($id);
        return redirect()->to(url('/empleados'));
        //
    }
}
