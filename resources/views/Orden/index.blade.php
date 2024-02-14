@extends('shared/layout')
@section('title','Listado de ordenes')
@section('content')  
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>                    
        @endforeach
    </ul>
</div>
@endif
<div class="card mb-4">
    <div class="card-header">
        <a href="{{url('/ordendetalles/create')}}" class="btn btn-primary">
            Crear Orden de servicio 
        </a>
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
                    <th>Id</th>
                    <th>Codigo </th>                    
                    <th>Fecha </th>                    
                    <th>hora</th>
                    <th>Hora de entrega</th>
                    <th>Cabaña</th>
                    <th>Cliente</th>
                    <th>Mesero</th>                    
                    <th>Total</th>
                    <th>Cantidad de productos ordenados</th>
                    <th>Observaciones</th> 
                    <th>credito</th>              
                    <th>Domicilio</th>     
                    <th>Estado</th>                    
                </tr>
            </thead>
            <tfoot>
                <tr>         
                    <th></th>      
                    <th></th>                                 
                    <th></th>                    
                    <th></th>                    
                    <th></th>
                    <th></th>    
                    <th>Id</th>
                    <th>Codigo </th>                    
                    <th>Fecha </th>                    
                    <th>hora</th>
                    <th>Hora de entrega</th>
                    <th>Cabaña</th>
                    <th>Cliente</th>
                    <th>Mesero</th>                    
                    <th>Total</th>
                    <th>Cantidad de productos ordenados</th>
                    <th>Observaciones</th>       
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
                        <a class="btn btn-primary" style="" href="{{url('/ordendetalles/'.$item->id.'/edit')}}">                    
                            <i class="fa-solid fa-file-circle-plus"></i>       
                        </a>                 
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info" style="" href="{{url('/ordenservicio')}}/{{$item->id}}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning" style="font-size: 10px" href="{{url('/reportes/printordenservicio/'.$item->id)}}">
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
                            <button class="btn btn-danger" style="" type="submit"> 
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
                                    <button class="btn btn-success" style="" type="submit">
                                        <i class="fa-solid fa-truck-ramp-box"></i>                                    
                                    </button>
                                </form>                                
                                @break
                            @case(2)
                                <form action="{{url('pagos/create')}}" method="get">
                                    <input type="hidden" value="{{$item->id}}" name="id">
                                    <button type="submit" class="btn btn-success" style="">
                                        <i class="fa-solid fa-cash-register"></i>    
                                    </button>                                
                                </form>                           
                                @break
                            @case(4)
                                <form action="{{url('pagos/create')}}" method="get">
                                    <input type="hidden" value="{{$item->id}}" name="id">
                                    <button type="submit" class="btn btn-success" style="">
                                        <i class="fa-solid fa-cash-register"></i>
                                    </button>                                
                                </form>                           
                                @break
                            @default                            
                        @endswitch              
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>                    
                    <td>{{$item->fecha}} </td>                    
                    <td>{{$item->hora}}</td>                    
                    <td>{{$item->hora_entrega}}</td>
                    <td>{{$item->cabaña!=null? $item->cabaña->codigo.' - '.$item->cabaña->nombre:""}}</td>
                    <td><a onmouseover="mostrar( {{$item->cliente!=null?$item->cliente->identificacion:'0'}})" href="{{url('/clientes')}}/{{$item->cliente!=null?$item->cliente->id:"0"}}">{{$item->cliente!=null?$item->cliente->nombre.' '.$item->cliente->apellido:""}}</a></td>
                    <td>{{$item->empleado->nombre. ' '.$item->empleado->apellido}}</td>                    
                    <td>${{number_format($item->total)}}</td>
                    <td>{{$item->orden_detalles->count()}}</td>
                    <td>{{$item->observaciones}}</td>  
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

