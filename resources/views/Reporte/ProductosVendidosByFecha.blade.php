@extends('shared/reportes')
@section('title','vista previa Inventario')
@section('content') 
<table class="table">
    <thead>
        <tr>
            <th>Codigo </th>
            <th>Producto</th>      
            <th>Total cantidad vendidas</th>
            <th>Total ventas</th>                        
        </tr>
    </thead>            
    <tbody>    
        @foreach($productosvendidos as $item)
        <tr>
            <td>{{$item->codigo}}</td>
            <td>{{$item->nombre}}</td>   
            <td>{{number_format($item->total_cantidad_vendidas)}}</td>                                                                                                                                                   
            <td>${{number_format($item->ventas)}}</td>                                                                        
        </tr>
        @endforeach   
    </tbody>
</table>

@endsection