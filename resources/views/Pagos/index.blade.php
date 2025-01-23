@extends('shared/layout')
@section('title','Listado de pagos')
@section('content')  
<div class="card mb-4">     
    <div class ="card-header" >
        <div class="row">
            <div class="col-9">                
                <form action="{{url('/pagos')}}">                     
                    <div class="row">
                        <div class="col-4">
                            <label class="form-label" for="codigo">                        
                                Fecha inicio                                           
                            </label>                    
                            <input name="fechaIni" value="{{$fechaIni}}"  class="form-control" type="date"/>                                        
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="codigo">                                  
                                Fecha fin            
                            </label>                                                                                   
                            <input name="fechaFin" class="form-control" value="{{$fechaFin}}" type="date"/>
                        </div>
                        <div class="col-4">
                            <br>
                            <input type="submit"  name="accion" class="btn btn-primary" value= "Buscar">    
                            <a class="btn btn-success" href="{{url('/pagodetalle')}} ">Totalizar </a>                                             
                        </div>
                    </div>                              
                </form>
            </div>
            <div class="col-3">
                <br>                
                <label class="form-label" for="categoria">                    
                    Total de venta                   
                </label>                
                ${{number_format($totales)}}                 
            </div>    
        </div>    
    </div>
    <div class="card-body">        
        <table id="datatablesSimple">
            <thead>
                <tr>
                    
                    <th>Id</th>
                    <th>Codigo </th>                    
                    <th>Fecha </th>                                       
                    <th>Cabaña</th>
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
                    <th>Cabaña</th>
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
                    <td>{{$item->orden_encabezado->cabaña!=null? $item->orden_encabezado->cabaña->codigo.' - '.$item->orden_encabezado->cabaña->nombre:""}}</td>                                   
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
    </div>
</div>
@endsection