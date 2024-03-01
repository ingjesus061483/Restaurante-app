@extends('shared/layout')
@section('title','Listado de formas de pagos')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        <a href="{{url('/')}}/formapagos/create" class="btn btn-primary">Crear formas de pagos </a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($formapagos as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->nombre}}</td>            
                    <td>{{$item->descripcion}}</td>
                    <td>
                        <a title="Editar" class="btn btn-warning" href="{{url('/')}}/formapagos/{{$item->id}}/edit">
                            <i class="fa-solid fa-pen"></i> 
                        </a>
                    </td>
                    <td>                
                        <form action="{{url('/')}}/formapagos/{{$item->id}}" onsubmit="return validar('Desea eliminar este registro?');" method="post">
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
