@extends('shared/layout')
@section('title','Listado de cajas')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div style="padding-bottom: 10px" >
            <a title="Crear caja" href="{{url('/cajas/create')}}" class="btn btn-primary">
                <i class="fa-solid fa-circle-plus"></i>
            </a>
        </div>
        <table class="table" id="datatablesSimple">
            <thead>
                <tr>
                     <th style="text-align: center"></th>
                    <th style="text-align: center"></th>
                    <th style="text-align: center"></th>
                    <th style="text-align: center">Id</th>
                    <th style="text-align: center">Codigo</th>
                    <th style="text-align: center">Nombre</th>
                    <th style="text-align: center">Descripcion</th>
                    <th style="text-align: center">Valor inicial</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cajas as $item)
                <tr>
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
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td>${{number_format($item->valor_inicial)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
