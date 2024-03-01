@extends('shared/layout')
@section('title','Listado de cajas')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        <a href="{{url('/cajas/create')}}" class="btn btn-primary">Crear cajas </a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Valor inicial</th>                        
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Valor inicial</th>    
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($cajas as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->nombre}}</td>            
                    <td>{{$item->descripcion}}</td>
                    <td>${{number_format($item->valor_inicial)}}</td>                    
                    <td>
                        <a title="Ver detalles" class="btn btn-success" href="{{url('/cajas')}}/{{$item->id}}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                   
                    <td>
                        <a title="Editar" class="btn btn-warning" href="{{url('/')}}/cajas/{{$item->id}}/edit">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                    </td>
                    <td>                
                        <form action="{{url('/')}}/cajas/{{$item->id}}" onsubmit="return validar('Desea eliminar este registro?');" method="post">
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
