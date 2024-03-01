@extends('shared/reportes')
@section('title','vista previa Inventario')
@section('content') 
<div class="row">
    <div class="col-12">    
        <table class="table">
            <thead>
                <tr>                
                    <th>Producto </th>
                    <th>Precio</th>
                    <th>Total cantidad vendidas</th>   
                    <th>Comision bebidas</th>      
                    <th>Comision comidas</th>                 
                    <th>Total ventas</th>                        
                </tr>
            </thead>            
            <tbody>    
                @foreach($productosvendidos as $item)
                <tr>                    
                    <td>{{$item->producto}}</td>
                    <td>${{number_format( $item->valor_unitario)}}</td>                   
                    <td>{{number_format($item->total_cantidad_vendidas)}}</td>                       
                    <td>${{$item->comision_bebidas}}</td>  
                    <td>${{$item->comision_comidas}}</td>                                                                                                                                             
                    <td>${{number_format($item->ventas)}}</td>                                                                        
                </td>
                @endforeach   
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-4"></div>
    <div class="col-4"></div>
    <div class="col-4"> 
        <strong>Total ventas:</strong>&nbsp;${{number_format( $total_vemtas)}}
    </div>
</div>
@endsection