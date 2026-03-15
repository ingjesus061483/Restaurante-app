@extends('shared/layout')
@section('title','Detalle de insumos')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                Datos de materia prima
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label style="font-weight: bold" class="form-label" for="codigo">
                                        Codigo:
                                    </label>
                                    {{$materiaprima->codigo}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label style="font-weight: bold" class="form-label" for="codigo">
                                        Nombre:
                                    </label>
                                    {{$materiaprima->nombre}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label style="font-weight: bold" class="form-label" for="costo_unitario">
                                        Costo unitario:
                                    </label>
                                    ${{number_format( $materiaprima->costo_unitario)}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label style="font-weight: bold" class="form-label" for="categoria">
                                        Categoria:
                                    </label>
                                    {{$materiaprima->categoria->nombre}}
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-6">
                                <div class="mb-3">
                                    <label style="font-weight: bold" class="form-label" for="unidad_medida">
                                        Unidad medida:
                                    </label>
                                    {{$materiaprima->unidad_medida->nombre}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class ="mb-3">
                                    <label style="font-weight: bold" class="form-label" for="descripcion">
                                        Descripcion:
                                    </label>
                                        {{$materiaprima->descripcion}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label style="font-weight: bold" class="form-label" for="imagen">
                                Imagen
                            </label>
                            <br>
                            @if($materiaprima->imagen!=null)
                            <img src="{{url('/img')}}/{{$materiaprima->imagen}}"width="300px" height="300px" class="img-thumbnail" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div style="padding: 10px">
                <div class="row">
                    <div class="col-6">
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
                    <div class="col-6">
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
                    <div class="col-4" >
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold" for="imagen">
                                Total entrada:
                            </label>
                            {{number_format( $total_entrada)}}
                        </div>

                    </div>
                    <div class="col-4" >
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold" for="imagen">
                                Total salida:
                            </label>
                            {{ number_format($total_salida)}}
                        </div>

                    </div>
                    <div class="col-4" >

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold" for="imagen">
                                Total movimiento:
                            </label>
                            {{number_format($total_entrada-$total_salida)}}
                        </div>

                    </div>
                </div>

        </div>

        <a title="Regresar" class="btn btn-primary" href="{{url('/materiaprimas')}}">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <a title="Generar PDF" class="btn btn-danger" href="{{url('/reportes/movimiento/')}}/{{$materiaprima->id}}">
            <i class="fa-solid fa-file-pdf"></i>
        </a>
    </div>
</div>
@endsection
