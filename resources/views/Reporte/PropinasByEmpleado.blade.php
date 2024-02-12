@extends('shared/reportes')
@section('title','vista previa Inventario')
@section('content') 
<table class="table">
    <thead>
        <tr>
            <th>Identificacion </th>
            <th>Empleado</th>      
            <th>Total venta</th>
            <th>Cantidad ordenes vendida</th>            
            <th>Propina</th>           
        </tr>
    </thead>            
    <tbody>    
        @foreach($propinas as $item)
        <tr>
            <td>{{$item->identificacion}}</td>
            <td>{{$item->nombre_completo}}</td>   
            <td>${{number_format($item->total_ventas)}}</td>                                                                        
            <td>{{$item->canidad_ordeneses_vendidas}}</td>                                                               
            <td>${{number_format($item->total_propina)}}</td>                                                                        
        </tr>
        @endforeach   
    </tbody>
</table>

@endsection