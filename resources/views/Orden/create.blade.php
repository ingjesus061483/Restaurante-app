@extends('shared/layout')
@section('title','Crear orden de servicio')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div style="padding-bottom: 5px">
                    <a title="Crear detalle de Orden" href=" {{url('/ordendetalles/create')}}"
                    class="btn btn-primary">
                        <i class="fa-solid fa-circle-plus"></i>
                    </a>
                </div>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cantidad  </th>
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
                            <td>{{$item->id}}</td>
                            <td>{{number_format( $item->cantidad)}}</td>
                            <td>{{$item->detalleOrden}}</td>
                            <td>{{$item->observaciones}}</td>
                            <td>${{number_format( $item->valor_unitario)}}</td>
                            <td>${{number_format( $item->total)}} </td>
                            <td>
                                <a title="Editar" onclick="EditarDetalleOrden({{$item->id}})" class="btn btn-warning">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{url('/ordendetalles')}}/{{$item->id}}"
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
            <div class="col-sm-6">
                <form action="{{url('/ordenservicio')}}" enctype="multipart/form-data" autocomplete="off" method="post">
                    @csrf
                    <input type="hidden" name="fecha" value="{{date('Y-m-d')}}" class="form-control"
                    id="fecha">
                    <input type="hidden" name="hora" value="{{date('H:i:s')}}" class="form-control"
                    id="hora">
                    <div class="mb-3">
                        <label class="form-label" for="codigo">
                            Tipo documento
                        </label>
                        <select name="tipo_documento" class="form-select" id="tipo_documento">
                            <option value="">Seleccione un tipo de documento</option>
                            @foreach($tipo_documento as $item)
                            <option value="{{$item->id}}"@if($item->id==3){{'selected'}}@endif>
                                {{$item->nombre}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="codigo">
                            Codigo
                        </label>
                        <input type="text" name="codigo" value="{{date_timestamp_get(date_create())}}" class="form-control" id="codigo">
                    </div>
                    @if($cliente==null)
                        @if($cabana==null)
                        <div class="mb-3">

                            <input type="checkbox" name="aplicaCliente" id="chkcliente">
                            <label class="form-label" for="cliente">
                                Cliente
                            </label>
                            <div id="pnlcliente" class="row"style="display:none">
                                <div class="input-group">
                                    <input type="text" name="cliente"
                                    value="{{old('cliente')}}" class="form-control" id="cliente">
                                    <a class="btn btn-success" title="Nuevo cliente" href="{{url('/clientes/create')}}">
                                        <i class="fa-solid fa-circle-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="mb-3" id="pnlcabaña">
                            <label class="form-label" for="cabaña">
                                Mesa
                            </label>
                            <select type="text" name="cabaña" class="form-select"
                            id="cabaña">
                                <option value="">seleccione una cabaña</option>
                                @foreach($cabañas as $item)
                                    <option value="{{$item->id}}"
                                    @if($cabana!=null&&$item->id==$cabana->id)
                                    {{'selected'}}
                                    @endif
                                    >{{$item->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="cliente"value="{{$cliente->identificacion}}">
                    @endif
                    @if($empleado==null)
                    <div class="mb-3">
                        <label class="form-label" for="empleado">
                            Empleado
                        </label>
                        <input type="text" name="empleado" value="{{old('empleado')}}" class="form-control"
                        id="empleado">
                    </div>
                    @else
                    <input type="hidden" name="empleado" value="{{$empleado->identificacion}}">
                    @endif
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            Hora entrega
                        </label>
                        <input type="time" name="hora_entrega" value="{{$tiempo_entrega}}" class="form-control"
                        id="hora_entrega">
                    </div>
                    @if($cabana==null)
                    <div class ="mb-3">
                        <label class="form-label" for="descripcion">
                            Domicilio
                        </label>
                        <input type="checkbox" name="domicilio" id="">
                    </div>
                    @endif
                    <div class ="mb-3">
                        <label class="form-label" for="descripcion">
                            Credito
                        </label>
                        <input type="checkbox" name="credito" id="">
                    </div>
                    <a title="Regresar" class="btn btn-primary" href="{{url('/ordenservicio')}}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <button class="btn btn-success" title="Guardar" type="submit">
                        <i class="fa-regular fa-floppy-disk"></i>
                    </button>
                    <a class="btn btn-danger" href="{{url('ordenservicio/CancelarOrden/0')}}" title="Cancelar orden">
                        <i class="fa-solid fa-circle-stop"></i>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
