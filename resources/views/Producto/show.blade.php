@extends('shared/layout')
@section('title','Detalle de productos')
@section('content')
<div class="card mb-4">
    <input type="hidden" id="producto_id" value="{{$producto->id}}">
    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                Datos de productos
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold" for="codigo">
                                        Codigo:
                                    </label>
                                    {{$producto->codigo}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold" for="codigo">
                                        Nombre:
                                    </label>
                                    {{$producto->nombre}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold" for="costo_unitario">
                                        Costo unitario:
                                    </label>
                                    ${{number_format($producto->costo_unitario)}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold" for="costo_unitario">
                                        Precio:
                                    </label>
                                    ${{number_format($producto->precio)}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold" for="categoria">
                                        Categoria:
                                    </label>
                                    {{$producto->categoria->nombre}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold" for="unidad_medida">
                                        Unidad medida:
                                    </label>
                                    {{$producto->unidad_medida!=null?$producto->unidad_medida->nombre:''}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold" for="costo_unitario">
                                        Procesado:
                                    </label>
                                    {{$producto->procesado==1?'si':'no'}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold" for="costo_unitario">
                                        Impresora asociada:
                                    </label>
                                    {{$producto->impresora->nombre}}
                                </div>
                            </div>
                        </div>
                        @if($producto->procesado==1)
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                     <label class="form-label" style="font-weight: bold" for="tiempo_coccion">
                                        Tiempo coccion:
                                    </label>
                                    {{$producto->tiempo_coccion!=null? $producto->tiempo_coccion.' minutos':''}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class ="mb-3">
                                    <label class="form-label" style="font-weight:bold" for="descripcion">
                                        Preparacion:
                                    </label>
                                    <br>
                                    {{$producto->preparacion}}
                                </div>
                            </div>
                        </div>
                         @endif
                         @if($producto->descripcion!='')
                         <div class="row">
                            <div class="col-12">
                                <div class ="mb-3">
                                    <label class="form-label" style="font-weight:bold" for="descripcion">
                                        Descripcion:
                                    </label>
                                    <br>
                                    {{$producto->descripcion}}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @if($producto->imagen!=null)
                        <div class="mb-3">
                            <label class="form-label" style="font-weight:bold" for="imagen">
                                Imagen
                            </label>
                            <br>
                            <img src="{{url('/img')}}/{{$producto->imagen}}" width="300px" height="300px" class="img-thumbnail" alt="">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if($producto->procesado==1)
        <div class="card mb-4">
            <div class="card-header">
                Ingredientes
            </div>
            <div class="card-body">
                <div style="padding-bottom:10px" >
                        <form action="{{url('ingredientes/create')}}" method="get">
                            <input type="hidden" name="producto" value="{{$producto->id}}">
                            <button title="Nuevo ingrediente" class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </form>
                    </div>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Insumo</th>
                            <th>Cantidad</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                             <th>Insumo</th>
                            <th>Cantidad</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($producto->preparacions as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->materia_prima->codigo.' - '.$item->materia_prima->nombre}}</td>
                            <td>{{number_format( $item->cantidad)}}</td>
                            <td>
                                <a title="Editar" class="btn btn-warning" onclick="editar_ingredientes(this);">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{url('/ingredientes')}}/{{$item->id}}"
                                    onsubmit="return validar('Desea eliminar este registro?');" method="post">
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
        @else
        <div style="padding: 10px">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                Detalles de entrada
                            </div>
                            <div class="card-body" >
                                <div style="overflow-x: scroll; ">
                                <table class="table">
                                    <thead>
                                        <th>Id</th>
                                        <th>Fecha</th>
                                        <th>Cantidad</th>
                                    </thead>
                                    <tbody   >
                                        @foreach($entradas as $item )
                                        <tr>
                                            <td>{{ $item->id}}</td>
                                            <td>{{ $item->fecha}}</td>
                                            <td>{{number_format( $item->cantidad)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                Detalles de salida
                            </div>
                            <div class="card-body">
                                <div style="overflow-x: scroll; ">
                                <table class="table">
                                    <thead>
                                        <th>Id</th>
                                        <th>Fecha</th>
                                        <th>Cantidad</th>
                                    </thead>
                                    <tbody>
                                        @foreach($salidas as $item )
                                        <tr>
                                            <td>{{ $item->id}}</td>
                                            <td>{{ $item->fecha}}</td>
                                            <td>{{number_format( $item->cantidad)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4" >
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold" for="imagen">
                                Total entrada:
                            </label>
                            {{number_format( $total_entrada)}}
                        </div>

                    </div>
                    <div class="col-sm-4" >
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold" for="imagen">
                                Total salida:
                            </label>
                            {{ number_format($total_salida)}}
                        </div>

                    </div>
                    <div class="col-sm-4" >

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold" for="imagen">
                                Total movimiento:
                            </label>
                            {{number_format($total_entrada-$total_salida)}}
                        </div>

                    </div>
                </div>

        </div>
        @endif
        <a title="Regresar" class="btn btn-primary" href="{{url('/productos')}}">
            <i class="fa-solid fa-arrow-left"></i>

        </a>
        <a class="btn btn-danger" target="blank" title="Mostrar existencia por producto" href="{{url('file/MostrarExistenciaPorProducto')}}/{{$producto->id}}">
            <i class="fa-solid fa-file-pdf"></i>
        </a>
    </div>
</div>
@endsection
