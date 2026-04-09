@extends('shared/layout')
@section('title','Listado de insumos')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div style="padding-bottom: 10px">
            <a title="Crear materia prima" href="{{url('/materiaprimas/create')}}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Nombre</th>
                    <th>Costo unitario</th>
                    <th>Unidad medida</th>
                    <th>Categoria</th>
                    <th>Total inventario</th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Nombre</th>
                    <th>Costo unitario</th>
                    <th>Unidad medida</th>
                    <th>Categoria</th>
                    <th>Total inventario</th>

                </tr>
            </tfoot>
            <tbody>
                @foreach($materiaprimas as $item)
                <tr>
                    <td>
                        <a title="Ver detalles" class="btn btn-success" href="{{url('/materiaprimas')}}/{{$item->id}}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <button title="Existencias" onclick="existencias(this,'materia_prima');" class="btn btn-info" >
                            <i class="fa-solid fa-warehouse"></i>
                        </button>
                    </td>
                    <td>
                        <a title="Editar" class="btn btn-warning" href="{{url('/materiaprimas')}}/{{$item->id}}/edit">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{url('/materiaprimas')}}/{{$item->id}}"
                            onsubmit="return validar('Desea eliminar este registro?');" method="post">
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
                    <td>${{number_format( $item->costo_unitario)}}</td>
                    <td>{{$item->unidad_medida}}</td>
                    <td>{{$item->categoria}}</td>
                    <td>{{number_format( $item->total_inventario)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

