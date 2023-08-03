@extends('shared/layout')
@section('title','Crear pago')
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
                <form action="{{url('/pagos')}}" enctype="multipart/form-data" autocomplete="off" method="post">
                    <input type="hidden" name="orden_id" value="{{$ordenServicio->id}}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="codigo">
                            Codigo
                        </label>
                        <input type="text" name="codigo" value="{{date_timestamp_get(date_create())}}" class="form-control" id="codigo">
                    </div>            
                    
                    <div class="mb-3">
                        <label class="form-label" for="codigo">
                            Fecha hora
                        </label>
                        <input type="datetime" name="fecha_hora" value="{{date('Y-m-d h:i:s')}}"  class="form-control" id="fechahora">
                    </div>  
                    <div class="mb-3">
                        <label class="form-label" for="categoria">
                            Forma pago                
                        </label>
                        <select type="text" name="forma_pago" class="form-select"
                         id="forma_pago">
                         <option value="">seleccione una forma pago</option>
                         @foreach($forma_pago as $item)
                         <option value="{{$item->id}}">{{$item->nombre}}</option>
                         @endforeach
                        </select>              
                    </div>                 
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            Subtotal                
                        </label>
                        <input type="text" name="subtotal" value="{{$subtotal}}" class="form-control"
                        id="subtotal">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            Impuestos                
                        </label>
                        <input type="text" name="impuesto" value="{{$impuesto}}" class="form-control"
                        id="impuesto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            Descuento                
                        </label>
                        <input type="text" name="descuento"  class="form-control"
                        id="descuento">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            Total a pagar                
                        </label>
                        <input type="text" name="total_pagar"  class="form-control"
                        id="total_pagar">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            Recibido                
                        </label>
                        <input type="text" name="recibido"  class="form-control"
                        id="recibido">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            Cambio                
                        </label>
                        <input type="text" name="cambio"  class="form-control"
                        id="cambio">
                    </div>
                    <div class ="mb-3">                    
                        <label class="form-label" for="descripcion">                        
                            Observaciones                    
                        </label>                    
                        <textarea name="observaciones" id="ovservaciones"  class="form-control"
                            cols="30" rows="10">                        
                            {{old('observaciones')}}                    
                        </textarea>                
                    </div>                                                   
                    <a class="btn btn-primary" href="{{url('/facturacion')}}">                    
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
                                <th>Cantidad</th>                                
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
                                <td>{{$item->producto->nombre}}</td>                                
                                <td>${{number_format( $item->valor_unitario)}}</td>                                
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