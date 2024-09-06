@extends('shared/reportes')
@section('title','vista previa ordenes')
@section('content')  
<h2> Ordenes de servicio </h2>      
<div class="row">    
    <div class="col-12">
    <table class="table">
            <thead>
                <tr>                    
                    <th>Id</th>
                    <th>Codigo </th>                    
                    <th>Fecha </th>                    
                    <th>hora</th>                    
                    <th>Cabaña</th>
                    <th>Cliente</th>
                    <th>Mesero</th>                    
                    <th>Total</th>                    
                </tr>
            </thead>            
            <tbody>    
                @foreach($ordenes as $item)
                <tr style="{{$item->estado_id==2?'color:green':'color:black'}}">
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>                    
                    <td>{{$item->fecha}} </td>                    
                    <td>{{$item->hora}}</td>                                        
                    <td>{{$item->cabaña!=null? $item->cabaña->codigo.' - '.$item->cabaña->nombre:""}}</td>
                    <td>{{$item->cliente!=null?$item->cliente->nombre.' '.$item->cliente->apellido:""}}</td>
                    <td>{{$item->empleado->nombre. ' '.$item->empleado->apellido}}</td>                    
                    <td>${{number_format($item->total)}}</td>                    
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
</div>
<div class="row">            
    <div class="col-4">          
        &nbsp;
    </div>            
    <div class="col-4" >                    
        &nbsp;
    </div>                        
    <div class="col-4" >                      
        <strong>                                               
            Total ventas:                        
        </strong>                                    
        ${{number_format($total)}}                        
    </div>
</div>
@endsection
