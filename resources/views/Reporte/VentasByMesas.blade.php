@extends('shared/reportes')
@section('title','vista previa Inventario')
@section('content') 
<table class="table">
    <thead>
        <tr>
            <th>Codigo </th>
            <th>Mesa</th>                  
            <th>Cantidad ordenes vendida</th>            
            <th>Total Venta</th>           
        </tr>
    </thead>            
    <tbody>    
        @foreach($ventas as $item)
        <tr>
            <td>{{$item->codigo}}</td>
            <td>{{$item->mesa}}</td>               
            <td>{{$item->ordenes_pagas}}<td>         
            <td>${{number_format($item->venta)}}</td>                                                                        
        </tr>
        @endforeach   
    </tbody>
</table>

@endsection