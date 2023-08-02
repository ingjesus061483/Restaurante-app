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
        <a href="{{url('/ordendetalles')}}" class="btn btn-primary">
            Crear Orden de servicio 
        </a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
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
                    <th>Estado</th>
                    <th></th>                    
                    <th></th>                    
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>                   
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
                    <th>Estado</th>
                    <th></th>                                 
                    <th></th>                    
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>    
                @foreach($ordenes as $item)
                <tr style="{{$item->estado_id==2?'color:green':'color:black'}}">
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>                    
                    <th>{{$item->fecha}} </th>                    
                    <th>{{$item->hora}}</th>                    
                    <th>{{$item->hora_entrega}}</th>
                    <th>{{$item->cabaña!=null? $item->cabaña->codigo.' - '.$item->cabaña->nombre:""}}</th>
                    <th>{{$item->cliente!=null?$item->cliente->nombre.' '.$item->cliente->apellido:""}}</th>
                    <th>{{$item->empleado->nombre. ' '.$item->empleado->apellido}}</th>                    
                    <th>{{number_format($item->total)}}</th>
                    <th>{{$item->orden_detalles->count()}}</th>
                    <th>{{$item->observaciones}}  </th>                    
                    <td>{{$item->estado->nombre}}</td>

                    <td>
                        <a class="btn btn-info" href="{{url('/ordenservicio')}}/{{$item->id}}">
                            Ver detalles
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning" href="{{url('/reportes/print/'.$item->id)}}">
                            Imprimir
                        </a>
                    </td>
                    <td>                
                        @if($item->estado_id==1)
                        <form action="{{url('/ordenservicio')}}/{{$item->id}}" 
                            onsubmit="return validar('Desea eliminar este registro?');" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit"> Cancelar</button>
                        </form>
                        @endif
                    </td>
                    <td>
                        @if($item->estado_id==1)
                        <form action="{{url('/ordenservicio')}}/{{$item->id}}" 
                            onsubmit="return validar('Desea entregaar estad orden?');" method="post">
                            @csrf
                            @method('patch')
                            <button class="btn btn-success" type="submit"> Entregar</button>
                        </form>
                        @else
                        <form action="{{url('pagos/create')}}" method="get">
                            <input type="hidden" value="{{$item->id}}" name="id">
                            <button type="submit" class="btn btn-success" > Cobrar</button>                                                   

                        
                        </form>

                        
                        @endif

                    </td>
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
</div>

@endsection

