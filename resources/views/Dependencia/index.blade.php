@extends('shared/layout')
@section('title','Listado de dependencias')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Listado de dependencias
        <a style="float: right" class="btn btn-success" href="{{url('/dependencias/create')}}">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($dependencias as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td>
                        <a title="Editar" class="btn btn-primary" href="{{url('/dependencias')}}/{{$item->id}}/edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{url('/dependencias')}}/{{$item->id}}" onsubmit="return validar('Desaea eliminar esta dependencia?')" method="POST">
                            @csrf
                            @method('DELETE')
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
