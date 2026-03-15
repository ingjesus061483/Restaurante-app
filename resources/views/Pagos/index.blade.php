@extends('shared/layout')
@section('title','Listado de pagos')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fa-solid fa-filter"></i> &nbsp; Filtros
    </div>
    <div class="card-body">
        <form action="{{url('/pagos')}}">
            <div class="row">
                <div class="col-4">
                    <label class="form-label" for="codigo">
                        Fecha inicio
                    </label>
                    <input name="fechaIni" value="{{$fechaIni}}"  class="form-control" type="date"/>
                </div>
                <div class="col-6">
                    <label class="form-label" for="codigo">
                        Fecha fin
                    </label>
                    <input name="fechaFin" class="form-control" value="{{$fechaFin}}" type="date"/>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="margin-top: 10px">
                     <button type="submit" title="Buscar"  name="accion" class="btn btn-primary" >
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div style ="padding: 10px">
            <a class="btn btn-success" title="Totalizar" href="{{url('/pagodetalle')}} ">
                <i class="fa-solid fa-calculator"></i>

            </a>
        </div>
        <table id="datatablesSimple">
            <thead>
                <tr>

                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Fecha </th>
                    <th>Mesa</th>
                    <th>Cliente</th>
                    <th>Mesero</th>
                    <th>Sub total</th>
                    <th>Impuesto</th>
                    <th>Descuento  </th>
                    <th>Total pagar</th>
                    <th>Servicio voluntario</th>
                    <th>Recibido</th>
                    <th>Cambio</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Fecha </th>
                    <th>Mesa</th>
                    <th>Cliente</th>
                    <th>Mesero</th>
                    <th>Sub total</th>
                    <th>Impuesto</th>
                    <th>Descuento  </th>
                    <th>Total pagar</th>
                    <th>Servicio voluntario</th>
                    <th>Recibido</th>
                    <th>Cambio</th>
                    <th></th>

                </tr>
            </tfoot>
            <tbody>
                @foreach($pagos as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->orden_encabezado->codigo}}</td>
                    <td>{{$item->orden_encabezado->fecha}} </td>
                    <td>{{$item->orden_encabezado->mesa!=null? $item->orden_encabezado->mesa->codigo.' - '.$item->orden_encabezado->mesa->nombre:""}}</td>
                    <td>{{$item->orden_encabezado->cliente!=null?$item->orden_encabezado->cliente->nombre.' '.$item->orden_encabezado->cliente->apellido:""}}</td>
                    <td>{{$item->orden_encabezado->empleado->nombre. ' '.$item->orden_encabezado->empleado->apellido}}</td>
                    <td>${{number_format($item->subtotal)}}</td>
                    <td>${{number_format($item->impuesto)}}</td>
                    <td>${{number_format($item->descuento)}}  </td>
                    <td>${{number_format($item->total_pagar)}}</td>
                    <td>${{number_format($item->servicio_voluntario)}}</td>
                    <td>${{number_format($item->recibido)}}</td>
                    <td>${{number_format($item->cambio)}}</td>
                    <td>
                        <a title="Ver detalles" href="{{url('/pagos')}}/{{$item->id}}" class="btn btn-success">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
         <div class="col-3">
                <label class="form-label" style="font-weight: bold" for="categoria">
                    Total de venta:
                </label>
                ${{number_format($totales)}}
        </div>
    </div>
</div>
@endsection
