@extends('shared/layout')
@section('title','Listado de mesas')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div style="padding-bottom: 10px">
            <a href="{{url('/file/ventasbycabaña')}}" target="blank" title="Pdf" class="btn btn-danger">
                <i class="fa-solid fa-file-pdf"></i>
            </a>&nbsp;
            <a href="{{url('/mesas/create')}}" title="Crear mesa" class="btn btn-primary">
                <i class="fa-solid fa-circle-plus"></i>
            </a>
        </div>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Dependencia</th>
                    <th>Imagen</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cabanas as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->capacidad_maxima}}</td>
                    <td>{{$item->dependencia}}</td>
                    <td> <img src="{{url('/img')}}/{{$item->imagen}}" alt="{{$item->nombre}}" width="100"> </td>

                    <td>
                        <a title="Editar" class="btn btn-warning" href="{{url('/mesas')}}/{{$item->id}}/edit">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{url('/mesas')}}/{{$item->id}}" onsubmit="return validar('Desea eliminar este registro?');" method="post">
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
