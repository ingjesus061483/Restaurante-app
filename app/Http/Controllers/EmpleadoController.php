<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutorizeRequest;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\Empresa;
use App\Models\Role;
use App\Models\User;
use App\Repositories\CajaRepository;
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
    protected  CajaRepository $_cajaRepository;
    public function __construct(RoleRepository $roleRepository,
                                EmpleadoRepository $empladoRepository,
                                EmpresaRepository $empresaRepository,
                                CajaRepository $cajaRepository) 
    {
        $this->_roleRepository=$roleRepository;
        $this->_empleadoRepository=$empladoRepository;        
        $this->_empresaRepository=$empresaRepository;
        $this->_cajaRepository=$cajaRepository;
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
            'empleados'=>$this->_empleadoRepository->GetAll()
        ];
        return view ('Empleado.index',$data);
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
            
            'roles'=>$this->_roleRepository->GetAll(),
            'empresas'=>$this-> _empresaRepository->GetAll(),
            'cajas'=>$this->_cajaRepository->GetAll(),
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
            'fecha_nacimiento'=>'required',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'role'=>'required',
            'empresa'=>'required',
            'name'=>'required|unique:users',
            'email'=>'required|email|max:255|unique:users',
            'password'=>['required','confirmed',Password::default()],            
        ]);  
        if($request->role==3){
            $validacion=$request->validate(['caja'=>'required']);
        }
        $this->_empleadoRepository->Store((object) $request->all());
        return redirect()->to(url('/empleados'));    
        //
    }
    public function ListaCumpleaños( AutorizeRequest $request, $id)
    {
        if(!Auth::check())
        {
            return redirect()->to('login');
        }  
        $data=['empleados'=> $this->_empleadoRepository->GetAll()];
        return view('Empleado.Cumpleaños',$data);
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
    public function edit(AutorizeRequest $request, $id)
    {
        
        if(!Auth::check())
        {
            return redirect()->to('login');
        }
        $data=[
         
            'roles'=>$this->_roleRepository->GetAll(),
            'empleado'=>$this ->  _empleadoRepository-> Find($id),
            'cajas'=>$this->_cajaRepository->GetAll(),
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
            'fecha_nacimiento'=>'required',
            'direccion'=>'required|max:50',
            'telefono'=>'required|max:50',
            'email'=>'required|email|max:255',
            'name'=>'required',
            'password'=>['required','confirmed',Password::default()],            
            'role'=>'required'
        ]);
        if($request->role==3){
            $validacion=$request->validate(['caja'=>'required']);
        }
        $this->_empleadoRepository->Update($id,(object)$request->all());
        return redirect()->to(url('/empleados'));
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
       
        
        $this-> _empleadoRepository->Delete($id);
        return redirect()->to(url('/empleados'));
        //
    }
}
