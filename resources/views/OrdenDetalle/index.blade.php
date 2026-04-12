@extends('shared/layout')
@section('title','Detalle de ordenes')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-4">
                <a title="Añadir item" href=" {{url('/ordendetalles')}}/{{$id}}/edit"  class="btn btn-primary">
                    <i class="fa-solid fa-list"></i>

                </a>
            </div>
            <div class="col-4">
            </div>
            <div  class="col-4">
                <a title="Imprimir comanda" class="btn btn-primary"  href="{{url('/reportes/printComandaSesion/'.$id)}}">
                    <i class="fa-solid fa-print"></i> &nbsp;  Comanda
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cantidad  </th>
                            <th>Detalle</th>
                            <th>Valor Unitario </th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $orden_detalle as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->cantidad}}</td>
                                <td>{{$item->detalleOrden}}</td>
                                <td>${{number_format($item->valor_unitario)}}</td>
                                <td>${{number_format($item->total)}} </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">

            </div>
            <div class="col-4">

            </div>
            <div class="col-4">
                Total orden:&nbsp;${{$total}}
            </div>
        </div>
    </div>
</div>
@endsection
