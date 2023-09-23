@extends('shared/layout')
@section('title','Listado de pagos')
@section('content')  

<div class="card mb-4">     
    <div class ="card-header" >
        <div class="row">
            <div class="col-7"> 
                <form  action="{{url('/pagos')}}"method="get" >
                    <div class="row">                    
                        <div class="col-9">
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
                        <div class="col-3" >
                            <br>                        
                            <button type="submit" class="btn btn-primary" >Buscar  </button>

                        </div>
    
                    </div>
    
                </form>
                                
            </div>
            <div class="col-5">
                <label class="form-label" for="categoria">
                    Total de venta por   {{$formaPago!=null?$formaPago->nombre:""}}
                </label>
                {{$totales}}              
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
                    <th>Recibido</th>
                    <th>Cambio</th>
                    <th>Forma pago</th>
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
                    <th>Recibido</th>
                    <th>Cambio</th>
                    <th>Forma pago</th>
                
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
                    <td>{{number_format($item->subtotal)}}</td>
                    <td>{{$item->impuesto}}</td>
                    <td>{{$item->descuento}}  </td>                    
                    <td>{{$item->total_pagar}}</td>
                    <td>{{$item->recibido}}</td>
                    <td>{{$item->cambio}}</td>
                    <td>{{$item->forma_pago->nombre}}</td>

            
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
</div>

@endsection