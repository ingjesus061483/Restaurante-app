@extends('shared/layout')
@section('title','Listado de clientes')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        <a href="{{url('/clientes/create')}}" class="btn btn-primary">Crear empleado </a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Identificacion</th>
                    <th>Nombre completo </th>            
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>    
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Identificacion</th>
                    <th>Nombre completo </th>            
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>                    
                    <th></th>
                    <th></th>
                </tr>        
            </tfoot>
            <tbody>
                @foreach($clientes as $item)
                <tr>
                    <td>{{$item->id}}</td>            
                    <td>{{$item->identificacion}}</td>
                    <td>{{$item->nombre .' '.$item->apellido}}</td>            
                    <td>{{$item->direccion}}</td>
                    <td>{{$item->telefono}}</td>
                    <td>{{$item->email}}</td>                    
                    <td>
                        <a title="Editar" class="btn btn-warning" href="{{url('/clientes/'.$item->id.'/edit')}}">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                    </td>
                    <td>                
                        <form onsubmit="return validar('Desea eliminar este registro?');" action="{{url('/')}}/clientes/{{$item->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit"> 
                                <i title="Eliminar"  class="fa-solid fa-trash"></i>
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
