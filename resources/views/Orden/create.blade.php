@extends('shared/layout')
@section('title','Crear orden de servicio')
@section('content')  
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-5">                
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
                                <div class="col-7">
                                    <input type="text" name="cliente"
                                    value="{{old('cliente')}}" class="form-control" id="cliente">
                                </div>
                                <div class="col-5">                                                                
                                    <a class="btn btn-success" href="{{url('/clientes/create')}}">                                    
                                    Nuevo cliente                                                        
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="mb-3" id="pnlcabaña">
                            <label class="form-label" for="cabaña">
                                Cabaña
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
                                                    
                    <a class="btn btn-primary" href="{{url('/ordenservicio')}}">                    
                        Regresar                
                    </a>                 
                    <button class="btn btn-success" type="submit">                   
                        Guardar                
                    </button>
                </form>                    
            </div>                    
            <div class="col-7">            
                <div class ="mb-3">                
                    <a href=" {{url('/ordendetalles/create')}}"  class="btn btn-primary">
                        Crear detalle de Orden
                    </a>
                </div>
                <div class ="mb-3">                
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
            </div>
        </div>               
    </div>
</div>
@endsection