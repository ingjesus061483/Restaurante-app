@extends('shared/layout')
@section('title','orden de servicio')
@section('content')
<div class="card mb-4">
     <div class="card-header">
        Encabesado de orden
     </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight:bold " for="codigo">
                            Codigo:
                        </label>
                        {{$ordenEncabezado->codigo}}
                    </div>
            </div>
            <div class="col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight:bold " for="unidad_medida">
                            Fecha hora:
                        </label>
                        {{$ordenEncabezado->fecha.' '.$ordenEncabezado->hora}}
                    </div>
            </div>
            <div class="col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight:bold " for="unidad_medida">
                            Hora entrega:
                        </label>
                        {{$ordenEncabezado->hora_entrega}}
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                @if($ordenEncabezado->cliente!=null)
                <div class="mb-3">
                    <label  class="form-label" style="font-weight:bold " for="codigo">
                        Cliente:
                    </label>
                    {{$ordenEncabezado->cliente->identificacion.' - '.$ordenEncabezado->cliente->nombre.' '.$ordenEncabezado->cliente->apellido}}
                </div>
                @else
                <div class="mb-3">
                    <label class="form-label" style="font-weight:bold " for="codigo">
                        Mesa:
                    </label>
                    {{$ordenEncabezado->mesa->codigo.' - '.$ordenEncabezado->mesa->nombre}}
                </div>
                @endif
            </div>
            <div class="col-sm-4">
                @if($ordenEncabezado->empleado!=null)
                <div class="mb-3">
                    <label class="form-label" style="font-weight:bold " for="codigo">
                        Empleado:
                    </label>
                    {{$ordenEncabezado->empleado->identificacion .' - '.$ordenEncabezado->empleado->nombre.' '.$ordenEncabezado->empleado->apellido}}
                </div>
                @endif
            </div>
            <div class="col-sm-4">
                <div class ="mb-3">
                    <label class="form-label" style="font-weight:bold " for="descripcion">
                        Estado:
                    </label>
                    {{$ordenEncabezado->estado->nombre}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        Detalles de orden
    </div>
    <div class="card-body">
        <div class ="mb-3">
            <div class="row">
                <div class="col-12">
                    <table id="datatablesSimple" class="table">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Detalle</th>
                                <th>Observaciones</th>
                                <th>Valor Unitario </th>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $orden_detalle as $item)
                            <tr>
                                <td>{{number_format($item->cantidad)}}</td>
                                <td>{{$item->producto->nombre}}</td>
                                <td>{{$item->observaciones}}</td>
                                <td>${{number_format($item->valor_unitario)}}</td>
                                <td>${{number_format($item->total)}} </td>
                                <td>
                                    @if($ordenEncabezado->estado_id==1)
                                    <a title="Editar" onclick="EditarDetalleOrden({{$item->id}})" class="btn btn-warning">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if($ordenEncabezado->estado_id==1&&(auth()->user()->role_id==1||auth()->user()->role_id==2) )
                                    <form action="{{url('/ordendetalles')}}/{{$item->id}}"
                                        onsubmit="return validar('Desea eliminar este registro?');"
                                         method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="orden_id"value="{{$ordenEncabezado->id}}" >
                                        <button title="Eliminar item" class="btn btn-danger" type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@if(count($ordenEncabezado->pagos) > 0)
<div class="row">
    @foreach($ordenEncabezado->pagos as $pago)

    <div class="row" >
        <div class="col-4" ></div>
        <div class="col-4" ></div>

    </div>
    <div class="row" >
        <div class="col-sm-4" >
            <div class ="mb-3">
                <label class="form-label" style="font-weight: bold" for="descripcion">
                    Serv. vol:
                </label>
                ${{number_format($pago->servicio_voluntario)}}
            </div>
        </div>
        <div class="col-sm-4" >
            <div class ="mb-3">
                <label class="form-label" style="font-weight: bold" for="descripcion">
                    Cambio:
                </label>
                ${{number_format($pago->cambio)}}
            </div>
        </div>
        <div class="col-sm-4" >

            <div class ="mb-3">
                <label class="form-label" style="font-weight: bold" for="descripcion">
                    Sub Total:
                </label>
                ${{number_format($pago->subtotal)}}
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
<div class="row">
    <div class="col-sm-4" >
        <div class ="mb-3">
            <label class="form-label" style="font-weight: bold" for="descripcion">
                Total a pagar:
            </label>
            ${{number_format($ordenEncabezado->total)}}
        </div>
    </div>
    <div class="col-sm-4" ></div>
    <div class="col-sm-4" ></div>
</div>
<div class="row">
    <div class="col-12">
        <a title="Regresar" class="btn btn-primary" href="{{url('/ordenservicio')}}">
            <i class="fa-solid fa-circle-arrow-left"></i>
        </a>
        <a target="blank" title="Orden de servicio" href="{{url('file/OrdenServicio')}}/{{$ordenEncabezado->id}}" class="btn btn-danger" >
            <i class="fa-solid fa-file-pdf"></i>
        </a>
    </div>

@endsection
