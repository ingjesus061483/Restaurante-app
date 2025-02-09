@extends('shared/layout')
@section('title','Listado de ordenes')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-9">                
                <form action="{{url('/ordenservicio')}}">                     
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
                            <input  type="submit" formtarget="blank"  class="btn btn-danger" name="accion" value ="PDF" >                                                          
                        </div>
                    </div>                              
                </form>
            </div>
            <div class="col-3">
                <br>
                <a href="{{url('/ordendetalles/create')}}" class="btn btn-primary">
                    Crear Orden de servicio 
                </a>
            </div>
        </div>
        
    </div>
    <div class="card-body">
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
<<<<<<< Updated upstream
                    <th>Id</th> 
                    <th>Cabaña</th>                                     
                    <th>Fecha </th>                    
                    <th>hora</th>
                    <th>Hora de entrega</th>                    
                    <th>Codigo </th> 
                    <th>Cliente</th>
                    <th>Mesero</th>                    
                    <th>Total</th>
                    <th>Cantidad de productos ordenados</th>                    
                    <th>credito</th>              
                    <th>Domicilio</th>     
                    <th>Estado</th>                    
                </tr>
            </thead>
            <tfoot>
<<<<<<< Updated upstream
                <tr>      
                    <th></th>   
=======
                <tr>         
>>>>>>> Stashed changes
                    <th></th>
                    <th></th>                    
                    <th></th>                    
                    <th></th>                    
                    <th></th>
                    <th></th>
<<<<<<< Updated upstream
                    <th>Id</th> 
                    <th>Cabaña</th>                                     
                    <th>Fecha </th>                    
                    <th>hora</th>
                    <th>Hora de entrega</th>                    
                    <th>Codigo </th> 
=======
                    <th>Id</th>
                    <th>Codigo </th>        
                    <th>Cabaña</th>            
                    <th>Fecha </th>                    
                    <th>hora</th>
                    <th>Hora de entrega</th>                   
>>>>>>> Stashed changes
                    <th>Cliente</th>
                    <th>Mesero</th>                    
                    <th>Total</th>
                    <th>Cantidad de productos ordenados</th>                    
                    <th>credito</th>              
                    <th>Domicilio</th>     
                    <th>Estado</th>                    
                </tr>
            </tfoot>
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
                        <a  class="btn btn-warning" style="font-size: 10px" href="{{url('/reportes/printordenservicio/'.$item->id)}}">
                            <i class="fa-solid fa-print"></i> &nbsp; Orden 
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning" style="font-size: 10px" href="{{url('/reportes/printComanda/'.$item->id)}}">
                            <i class="fa-solid fa-print"></i> &nbsp;  Comanda
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
                        @if($item->estado_id==1)
                        <a title="Cambio de mesa" class="btn btn-primary" style="" onclick="CambiarMesa('{{$item->cabaña->codigo.' - '.$item->cabaña->nombre}}',{{$item->id}})">                    
                            <i class="fa-solid fa-person-walking"></i>
                        </a>
                        @endif
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->cabaña!=null? $item->cabaña->codigo.' - '.$item->cabaña->nombre:""}}</td>
                    <td>{{$item->codigo}}</td>                    
                    <td>{{$item->cabaña!=null? $item->cabaña->codigo.' - '.$item->cabaña->nombre:""}}</td>
                    <td>{{$item->fecha}} </td>                    
                    <td>{{$item->hora}}</td>                    
<<<<<<< Updated upstream
                    <td>{{$item->hora_entrega}}</td>                   
=======
                    <td>{{$item->hora_entrega}}</td>                    
>>>>>>> Stashed changes
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

