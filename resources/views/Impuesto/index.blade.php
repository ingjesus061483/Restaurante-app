@extends('shared/layout')
@section('title','Listado de impuestos')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        <a href="{{url('/')}}/impuestos/create" class="btn btn-primary">Crear impuestos </a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Valor</th>
                    <th>Descripcion</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Valor</th>
                    <th>Descripcion</th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($impuestos as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->nombre}}</td>            
                    <td>{{$item->valor}}</td>            
                    <td>{{$item->descripcion}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{url('/')}}/impuestos/{{$item->id}}/edit">
                            Editar 
                        </a>
                    </td>
                    <td>                
                        <form action="{{url('/')}}/impuestos/{{$item->id}}"
                             onsubmit="return validar('Desea eliminar este registro?');" method="post">
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
