@extends('shared/layout')
@section('title','Listado de productos')
@section('content')
<div class="card mb-4">
    <div class="card-header">
         <i class="fa-solid fa-filter"></i>&nbsp; Filtro
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12" style="padding: 10px">
                @include('shared/Categorias')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form target="blank" action="{{url('file/ProductosVendidosByFecha')}}">
                    <input type="hidden" name="categoria_id" value="{{$categoria_id}}">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label" style="font-weight: bold" for="codigo">
                                Fecha inicio:
                            </label>
                            <input name="fechaIni" value=""  class="form-control" type="date"/>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" style="font-weight: bold" for="codigo">
                                Fecha fin:
                            </label>
                            <input name="fechaFin" class="form-control" value="" type="date"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="padding-top: 10px">
                            <button title="Ver reporte" type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-file-pdf"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div style="padding-bottom: 10px">
        <a title="Crear producto" href="{{url('/productos/create')}}" class="btn btn-primary">
            <i class="fa-solid fa-circle-plus"></i>
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
                    <th>Precio</th>
                    <th>Tiempo de coccion</th>
                    <th>Unidad medida</th>
                    <th>Categoria</th>
                    <th>Procesado</th>
                    <th>Total existencias</th>

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
                    <TH>Precio</TH>
                    <th>Tiempo de coccion</th>
                    <th>Unidad medida</th>
                    <th>Categoria</th>
                    <th>Procesado</th>
                    <th>Total existencias</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($productos as $item)
                <tr>
                    <td>
                        @if(!$item->procesado)
                        <button title="Existencias" onclick="existencias(this,'producto');" class="btn btn-info" >
                            <i class="fa-solid fa-warehouse"></i>

                        </button>
                        @endif
                    </td>
                    <td>
                        <a title="Ver detalles" class="btn btn-success" href="{{url('/productos')}}/{{$item->id}}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a title="Editar" class="btn btn-warning" href="{{url('/productos')}}/{{$item->id}}/edit">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{url('/productos')}}/{{$item->id}}"
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
                    <td>${{number_format($item->costo_unitario)}}</td>
                    <td>${{ number_format($item->precio)}}</td>
                    <td>{{$item->tiempo_coccion}}</td>
                    <td>{{$item->unidad_medida}}</td>
                    <td>{{$item->categoria}}</td>
                    <td>{{$item->procesado==1?'Si':'No'}}</td>
                    <td>
                        @if(!$item->procesado)
                            {{number_format($item->total_inventario)}}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

