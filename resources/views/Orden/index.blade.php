@extends('shared/layout')
@section('title','Listado de ordenes')
@section('content')
<div class="card mb-4">
    <div class="card-header">
<i class="fa-solid fa-filter"></i> &nbsp; Filtros

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form action="{{url('/ordenservicio')}}">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label" for="codigo">
                                Fecha inicio
                            </label>
                            <input name="fechaIni" value="{{$fechaIni}}"  class="form-control" type="date"/>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="codigo">
                                Fecha fin
                            </label>
                            <input name="fechaFin" class="form-control" value="{{$fechaFin}}" type="date"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="margin-top: 10px">
                            <button title="Buscar" type="submit"  name="accion" class="btn btn-primary" >
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>&nbsp;
                            <button title="Generar PDF"  type="submit" formtarget="blank"  class="btn btn-danger" name="accion" value ="PDF" >
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
    <div style="padding: 10px">
         <a title="Crear orden de servicio" href="{{url('/ordendetalles/create')}}" class="btn btn-primary">
            <i class="fa-solid fa-circle-plus"></i>
        </a>
    </div>
    <div style="padding: 10px">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Id</th>
                    <th>Mesa</th>
                    <th>Fecha hora </th>
                    <th>Hora de entrega</th>
                    <th>Codigo </th>
                    <th>Cliente</th>
                    <th>Mesero</th>
                    <th>Total</th>
                    <th>Cantidad de productos ordenados</th>
                    <th>Credito</th>
                    <th>Domicilio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordenes as $item)
                <tr style="{{$item->estado_id==2?'color:green':'color:black'}}">
                    <td>
                        @if($item->estado_id==1)
                        <a title="añadir item" class="btn btn-primary" style="" href="{{url('/ordendetalles/'.$item->id.'/edit')}}">
                            <i class="fa-solid fa-file-circle-plus"></i>
                        </a>
                        @endif
                    </td>
                    <td>
                        <a title="Ver detalles" class="btn btn-info" style="" href="{{url('/ordenservicio')}}/{{$item->id}}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a  class="btn btn-warning" title="Imprimir orden"  href="{{url('/reportes/printordenservicio/'.$item->id)}}">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning" title="Imprimir comanda"  href="{{url('/reportes/printComanda/'.$item->id)}}">
                           <i class="fa-solid fa-kitchen-set"></i>
                        </a>
                    </td>
                    <td>
                        @if($item->estado_id==1&&(auth()->user()->role_id==1||auth()->user()->role_id==2) )
                        <form action="{{url('/ordenservicio')}}/{{$item->id}}"
                            onsubmit="return validar('Desea eliminar este registro?');" method="post">
                            @csrf
                            @method('delete')
                            <button title="Cancelar orden de pedido" class="btn btn-danger" style="" type="submit">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                    <td>
                        @switch($item->estado_id)
                            @case(1)
                                <form action="{{url('/ordenservicio')}}/{{$item->id}}"
                                    onsubmit="return validar('Desea entregar esta orden?');" method="post">
                                    @csrf
                                    @method('patch')
                                    <button title="Entregar orden" class="btn btn-success" style="" type="submit">
                                        <i class="fa-solid fa-truck-ramp-box"></i>
                                    </button>
                                </form>
                                @break
                            @case(2)
                                <form action="{{url('pagos/create')}}" method="get">
                                    <input type="hidden" value="{{$item->id}}" name="id">
                                    <button title="Cobrar" type="submit" class="btn btn-success" style="">
                                        <i class="fa-solid fa-cash-register"></i>
                                    </button>
                                </form>
                                @break
                            @case(4)
                                <form action="{{url('pagos/create')}}" method="get">
                                    <input type="hidden" value="{{$item->id}}" name="id">
                                    <button title="Cobrar" type="submit" class="btn btn-success" style="">
                                        <i class="fa-solid fa-cash-register"></i>
                                    </button>
                                </form>
                                @break
                            @default
                        @endswitch
                    </td>
                    <td>
                        @if($item->estado_id==1&&$item->cabaña!=null)
                        <a title="Cambio de mesa" class="btn btn-primary" style="" onclick="CambiarMesa('{{$item->cabaña->codigo.' - '.$item->cabaña->nombre}}',{{$item->id}})">
                            <i class="fa-solid fa-person-walking"></i>
                        </a>
                        @endif
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->mesa!=null? $item->mesa->codigo.' - '.$item->mesa->nombre:""}}</td>
                    <td>{{$item->fecha.' '.$item->hora}} </td>
                    <td>{{$item->hora_entrega}}</td>
                    <td>{{$item->codigo}}</td>
                    <td>
                        <a
                            onmouseover="mostrar_Cliente('{{$item->cliente!=null?$item->cliente->identificacion:''}}')"
                            href="{{url('/clientes')}}/{{$item->cliente!=null?$item->cliente->id:"0"}}">
                            {{$item->cliente!=null?$item->cliente->nombre.' '.$item->cliente->apellido:""}}
                        </a>
                    </td>
                    <td>{{$item->empleado->nombre. ' '.$item->empleado->apellido}}</td>
                    <td>${{number_format($item->total)}}</td>
                    <td>{{$item->orden_detalles->count()}}</td>
                    <td>{{$item->credito==1?'Si':'No'}}</td>
                    <td>{{$item->domicilio==1?'Si':'No'}}</td>
                    <td>{{$item->estado->nombre}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

