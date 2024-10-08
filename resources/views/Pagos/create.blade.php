@extends('shared/layout')
@section('title','Crear pago')
@section('content')  
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-5">                
                <form action="{{url('/pagos')}}" enctype="multipart/form-data" autocomplete="off" method="post">
                    <input type="hidden" name="acumulado"value="{{$acumulado}}" >        
                    <input type="hidden" name="faltante" value="{{$faltante}}">
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
                        id="total_pagar" value={{$subtotal+$impuesto}}>
                    </div>
                    @if($propina>0)
                     <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            Servicio voluntario                
                        </label>                  
                        <input type="text" name="serviciovol" value="{{$propina}}" class="form-control"
                        id="serviciovol">
                    </div>
                    @endif
                    
                    <div class ="mb-3">                    
                        <label class="form-label" for="descripcion">                        
                            Observaciones                    
                        </label>                    
                        <textarea name="observaciones" id="observaciones"  class="form-control"
                            cols="30" rows="10">                        
                            {{old('observaciones')}}                    
                        </textarea>                
                    </div>                                                   
                    <!--<div class="mb-3">
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
                    </div>-->
                    <a id="detalle" class="btn btn-primary" >                    
                        Detalle de pago                
                    </a>                 
                    <a class="btn btn-primary" href="{{url('/')}}">                    
                        Regresar                
                    </a>                 
                    <button class="btn btn-success" type="submit">                   
                        Guardar                
                    </button>
                </form>                    
            </div>                    
            <div class="col-7">                 
                <div class ="row">  
                    <div class="col-12">                        
                        <table class="table">                                                    
                            <thead>                                                            
                                <tr>                                    
                                    <th>Id</th>                                                           
                                    <th > Forma pago </th>                                
                                    <th> Detalle pago</th>                                
                                    <th> Valor recibido</th>    
                                    <th></th>                            
                                </tr>                        
                            </thead>                         
                            <tbody>                            
                                @foreach( $pagoDetalles as $item)                                                                        
                                <tr>                                
                                    <td>{{$item->id}}</td>                                             
                                    <td >{{$item->forma_pago}}</td>
                                    <td>{{$item->detalle_pago}}</td>                               
                                    <td>{{$item->valor_recibido}}</td>                                                                  
                                    <td>                
                                        <form action="{{url('/pagodetalle')}}/{{$item->id}}" onsubmit="return validar('Desea eliminar este registro?');" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="orden_id" value="{{$ordenServicio->id}}">
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
                <div class="row">
                    <div class="col-6">
                        <strong> acumulado:</strong> {{$acumulado}}
                    </div>
                    <div class="col-6">
                        <strong>{{$faltante>0?'Faltante:':'Sobrante:'}} </strong>{{$faltante<0?-1*$faltante:$faltante }}
                    </div>
                    
                </div>            

            </div>
        </div>               
    </div>
</div>
@endsection