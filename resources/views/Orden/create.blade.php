@extends('shared/layout')
@section('title','Crear orden de servicio')
@section('content')  
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-5">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>                    
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{url('/ordenservicio')}}" enctype="multipart/form-data" autocomplete="off" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="codigo">
                            Tipo documento
                        </label>
                        <select name="tipo_documento" class="form-select" id="tipo_documento">
                            <option value="">Seleccione un tipo de documento</option>
                            @foreach($tipo_documento as $item)
                            <option value="{{$item->id}}">{{$item->nombre}}</option>
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
                    <div class="mb-3">
                        <input type="checkbox" name="aplicaCliente" id="chkcliente">
                        <label class="form-label" for="cliente">
                            Cliente
                        </label>
                        <input type="text" name="cliente"style="display:none"
                         value="{{old('cliente')}}" class="form-control" id="cliente">
                    </div>
                    <div class="mb-3" id="pnlcabaña">
                        <label class="form-label" for="cabaña">
                            Cabaña
                        </label>
                        <select type="text" name="cabaña" class="form-select"
                        id="cabaña">
                            <option value="">seleccione una cabaña</option>
                            @foreach($cabañas as $item)
                            <option value="{{$item->id}}">{{$item->nombre}}</option>
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
                            Fecha                
                        </label>
                        <input type="date" name="fecha" value="{{date('Y-m-d')}}" class="form-control"
                        id="fecha">
                    </div>                 
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            hora                
                        </label>
                        <input type="time" name="hora" value="{{date('H:i:s')}}" class="form-control"
                        id="hora">
                    </div>             
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            Hora entrega                
                        </label>
                        <input type="time" name="hora_entrega" value="{{$tiempo_entrega}}" class="form-control"
                        id="hora">
                    </div>
                    <div class ="mb-3">                    
                        <label class="form-label" for="descripcion">                        
                            Observaciones                    
                        </label>                    
                        <textarea name="observaciones" id="observaciones"  class="form-control"
                            cols="30" rows="10">                        
                            {{old('observaciones')}}                    
                        </textarea>                
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
                    <table class="table">                    
                        <thead>                        
                            <tr>       
                                <th>Id</th>             
                                <th>Cantidad  </th>
                                <th>Detalle</th>
                                <th>Valor Unitario </th>                    
                                <th>Total</th>                                                                                            
                            </tr>
                        </thead>                             
                        <tbody>    
                            @foreach( $orden_detalle as $item)                                            
                            <tr>                           
                                <td>{{$item->id}}</td>
                                <td>{{number_format( $item->cantidad)}}</td>
                                <td>{{$item->detalleOrden}}</td>
                                <td>${{number_format( $item->valorUnitario)}}</td>
                                <td>${{number_format( $item->total)}} </td>                                                   
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