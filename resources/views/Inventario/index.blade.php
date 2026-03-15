@extends('shared/layout')
@section('title','Inventario de Productos')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div style="padding-bottom: 10px">
            <a href="{{url('/file/inventario')}}" title="Inventario" target="blank"
                     class="btn btn-danger">
                <i class="fa-solid fa-file-pdf"></i>
            </a>
        </div>
        <div style="padding-bottom: 10px">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Nombre</th>
                    <th>Costo unitario</th>
                    <th>Categoria</th>
                    <th>Unidad medida</th>
                    <th>Tipo</th>
                    <th>Total enetrada </th>
                    <th>Total salida</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Nombre</th>
                    <th>Costo unitario</th>
                    <th>Categoria</th>
                    <th>Unidad medida</th>
                    <th>Tipo</th>
                    <th>Total enetrada </th>
                    <th>Total salida</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($inventario as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>${{number_format($item->costo_unitario)}}</td>
                    <td>{{$item->categoria}}</td>
                    <td>{{$item->unidad_medida}}</td>
                    <td>{{str_replace('_', ' ', $item->tipo)}}</td>
                    <td>{{number_format( $item->total_entrada)}}</td>
                    <td>{{number_format($item->total_salida)}}</td>
                    <td>{{number_format($item->total_inventario)}}</td>
                    <td>
                        <a title="Ver detalles" class="btn btn-success"
                            href="{{url('/')}}/{{$item->tipo=='producto'?'productos':'materiaprimas'}}/{{$item->id}}">
                            <i class="fa-solid fa-eye"></i>

                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-weight: bold" for="nombre">
                Total existencias:
            </label>
            {{$total_inventario}}
        </div>
    </div>
</div>
@endsection

