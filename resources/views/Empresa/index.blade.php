@extends('shared/layout')
@section('title','Listado de empresas')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        <a href="{{url('/empresas/create')}}" class="btn btn-primary">Crear empresa </a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>nit</th>
                    <th>nombre</th>
                    <th>Camara de comercio</th>                             
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Contacto</th>
                    <th>Logo</th>
                    <th>slogan</th>
                    <th>Tipo de regimen</th>
                    <th> </th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>nit</th>
                    <th>nombre</th>
                    <th>Camara de comercio</th>                             
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Contacto</th>
                    <th>Logo</th>
                    <th>slogan</th>
                    <th>Tipo de regimen</th>
                    <th></th>
                    <th></th>
                </tr>        
            </tfoot>
            <tbody>
                @foreach($empresas as $item)
                <tr>
                    <td>{{$item->id}}</td>            
                    <td>{{$item->nit}}</td>
                    <td>{{$item->nombre }}</td>            
                    <td>{{$item->camara_de_comercio}}</td>
                    <td>{{$item->direccion}}</td>
                    <td>{{$item->telefono}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->contacto}}</td>
                    <td>{{$item->logo}}</td>
                    <td>{{$item->slogan}}</td>
                    <td>{{$item->tipo_regimen->nombre}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{url('/empresas/'.$item->id.'/edit')}}">
                            Editar 
                        </a>
                    </td>
                    <td>                
                        <form onsubmit="return validar('Desea eliminar este registro?');" action="{{url('/')}}/empresas/{{$item->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit"> Eliminar</button>
                        </form>
                    </td>        
                </tr>
                @endforeach   
            </tbody>        
        </table>
    </div>
</div>
@endsection
