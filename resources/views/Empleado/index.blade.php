@extends('shared/layout')
@section('title','Listado de empleados')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        <a href="{{url('/empleados/create')}}" class="btn btn-primary">Crear empleado </a>
        <a title="Ver reporte" href="{{url('file/propinasByEmpleado')}}" target="blank" class="btn btn-danger">
            <i class="fa-solid fa-file-pdf"></i>
        </a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Identificacion</th>
                    <th>Nombre completo </th>            
                    <th>Fecha nacimiento</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Usuario</th>
                    <th>Role</th>
                    <th>Caja</th>
                    <th>Empresa</th>                    
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Identificacion</th>
                    <th>Nombre completo </th>            
                    <th>Fecha nacimiento</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Usuario</th>
                    <th>Role</th>
                    <th>Caja</th>
                    <th>Empresa</th>         
                    <th></th>
                    <th></th>
                </tr>        
            </tfoot>
            <tbody>
                @foreach($empleados as $item)
                <tr>
                    <td>{{$item->id}}</td>            
                    <td>{{$item->identificacion}}</td>
                    <td>{{$item->nombre .' '.$item->apellido}}</td>            
                    <td>{{$item->fecha_nacimiento}}</td>
                    <td>{{$item->direccion}}</td>
                    <td>{{$item->telefono}}</td>
                    <td>{{$item->usuario->email}}</td>
                    <td>{{$item->usuario->name}}</td>
                    <td>{{$item->usuario->role->nombre}}</td>
                    <td>{{$item->usuario->caja!=null?$item->usuario->caja->nombre:''}}</td>
                    <td>{{$item->usuario->empresa->nombre}}</td>            
                    <td>
                        <a title="Editar" class="btn btn-warning" href="{{url('/empleados/'.$item->id.'/edit')}}">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                    </td>
                    <td>                
                        <form onsubmit="return validar('Desea eliminar este registro?');" action="{{url('/')}}/empleados/{{$item->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button title="Eliminar" class="btn btn-danger" type="submit"> 
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>        
                </tr>
                @endforeach   
            </tbody>        
        </table>
    </div>
</div>
@endsection
