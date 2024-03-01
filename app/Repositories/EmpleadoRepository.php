<?php
namespace App\Repositories;

use App\Contracts\IRepository;
use App\Models\Empleado;
use Illuminate\Support\Facades\Hash;
class EmpleadoRepository implements IRepository
{
    protected UserRepository $_UserRepository;    
    public function __construct( UserRepository $userRepository) {
        $this->_UserRepository = $userRepository;
    }
    public function propinasByEmpleado()
    {
        $subquery="SELECT valor FROM configuracions WHERE nombre ='propina'";
        return Empleado::select('empleados.identificacion')
                       ->selectRaw("CONCAT( empleados.nombre,' ',empleados.apellido)as nombre_completo")
                       ->selectRaw('SUM( pagos.total_pagar )total_ventas')
                       ->selectRaw('COUNT(orden_encabezados.id) canidad_ordeneses_vendidas')
                       ->selectRaw("SUM( pagos.total_pagar*($subquery))total_propina")
                       ->join('orden_encabezados','Empleados.id','=','orden_encabezados.empleado_id')
                       ->join('pagos','orden_encabezados.id','=','pagos.orden_id')
                       ->whereRaw('orden_encabezados.fecha=CURDATE()')
                       ->where('orden_encabezados.estado_id',3)
                       ->groupby('empleados.identificacion')
                       ->groupbyRaw("CONCAT( empleados.nombre,' ',empleados.apellido)")->get();
    }
    public function GetEmpleadoByUser($user){
        return Empleado::where('user_id',$user->id)->first();
     }
 
    public function Getempleado($identificacion){
       return Empleado::where('identificacion',$identificacion)->first();
    }
    public function GetAll()
    {
        return Empleado::all();
    }
    public function Find($id)
    {
        return Empleado::find($id);
    }
    public function Store($request)
    {
        $user= $this->_UserRepository->Store($request);
        $empleado=new Empleado();
        $empleado->identificacion=$request->identificacion;
        $empleado->nombre=$request->nombre;
        $empleado->apellido=$request->apellido;
        $empleado->fecha_nacimiento=$request->fecha_nacimiento;
        $empleado->direccion=$request->direccion;
        $empleado->telefono=$request->telefono;
        $empleado->user_id=$user->id;
        $empleado->save();
    }
    public function Update($id, $request)
    {       
        $empleado=$this->Find($id);
        $user=$this->_UserRepository ->find($empleado->user_id);
        $empleado->identificacion=$request->identificacion;
        $empleado->nombre=$request->nombre;
        $empleado->apellido=$request->apellido;
        $empleado->fecha_nacimiento=$request->fecha_nacimiento;
        $empleado->direccion=$request->direccion;
        $empleado->telefono=$request->telefono;
        $empleado->save();
        $user->role_id=$request->role;
        $user->caja_id=$request->caja;
        $user->password=hash::make( $request->password);
        $user->save();    
    }
    public function Delete($id)
    {
        $empleado=$this->Find($id);        
        $this->_UserRepository->Delete($empleado->user_id);        
    } 
}