@extends('shared/layout')
@section('title','orden de servicio')
@section('content')  
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-5">
                    <div class="mb-3">
                        <label class="form-label" for="codigo">
                            Codigo
                        </label>                        
                        {{$ordenEncabezado->codigo}}             
                    </div>            
                    @if($ordenEncabezado->cliente!=null)
                    <div class="card mb-4">
                        <div class="card-header">
                            Cliente
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="codigo">
                                            Identificacion
                                        </label>                        
                                        {{$ordenEncabezado->cliente->identificacion}}             
                                    </div>      
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="codigo">
                                            Nombre completo
                                        
                                        </label>                        
                                        {{$ordenEncabezado->cliente->nombre.' '.$ordenEncabezado->cliente->apellido}}             
                                    </div>      
                                </div>


                            </div>
                        </div>  
                    </div>          
                    @else

                    <div class="card mb-4">
                        <div class="card-header">
                            Cabaña
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="codigo">
                                            Codigo
                                        </label>                        
                                        {{$ordenEncabezado->cabaña->codigo}}             
                                    </div>      

                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="codigo">
                                            Nombre                                         
                                        </label>                        
                                        {{$ordenEncabezado->cabaña->nombre}}             
                                    </div>      
                                </div>                            
                            </div>
                        </div>  
                    </div>          
                    @endif
                    @if($ordenEncabezado->empleado!=null)
                    <div class="card mb-4">
                        <div class="card-header">
                            Empleado
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="codigo">
                                            Identificacion
                                        </label>                        
                                        {{$ordenEncabezado->empleado->identificacion}}             
                                    </div>      
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="codigo">
                                            Nombre completo
                                        
                                        </label>                        
                                        {{$ordenEncabezado->empleado->nombre.' '.$ordenEncabezado->empleado->apellido}}             
                                    </div>      
                                </div>


                            </div>
                        </div>   
                    </div>         
                    @endif                                
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            Fecha                
                        </label>
                        {{$ordenEncabezado->fecha}}
                    </div>                 
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            hora                
                        </label>
                        {{$ordenEncabezado->hora}}
                    </div>             
                    <div class="mb-3">
                        <label class="form-label" for="unidad_medida">
                            Hora entrega                
                        </label>
                        {{$ordenEncabezado->hora_entrega}}
                    </div>
                    <div class ="mb-3">                    
                        <label class="form-label" for="descripcion">                        
                            Observaciones                    
                        </label>                    
                        {{$ordenEncabezado->observaciones}}
                    </div>                          
                    <div class ="mb-3">                    
                        <label class="form-label" for="descripcion">                        
                            Estado
                        </label>                    
                        {{$ordenEncabezado->estado->nombre}}
                    </div>                          
                    <a class="btn btn-primary" href="{{url('/orderservicio')}}">                    
                        Regresar                
                    </a>                                     
                    <a href="" class="btn btn-danger" >                   
                        PDF                
                    </a>        
            </div>                    
            <div class="col-7">            
                <div class ="mb-3">                
                    <div class="row">
                        <div class="col-12">                            
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
                                        <td>{{number_format($item->cantidad)}}</td>
                                        <td>{{$item->producto->nombre}}</td>
                                        <td>${{number_format($item->valor_unitario)}}</td>
                                        <td>${{number_format($item->total)}} </td>                                                   
                                    </tr>                    
                                    @endforeach                       
                                </tbody>                                            
                            </table>                    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4" ></div>
                        <div class="col-4" ></div>
                        <div class="col-4" >
                            <div class ="mb-3">                    
                                <label class="form-label" for="descripcion">                        
                                    Total
                                </label>                    
                                {{$ordenEncabezado->total}}
                            </div>
                                    
                        </div>
                    </div>

                </div>            
            </div>
        </div>               
    </div>
</div>
@endsection