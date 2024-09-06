@extends('shared/reportes')
@section('title','vista previa Inventario')
@section('content') 
<div class="row">
    <div class="col-12">
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
    </div>    
</div>
<div class="row">
    <div class="col-4">

    </div>
    <div class="col-4">

    </div>
     <div class="col-4">
        <strong>Total venta:</strong>&nbsp;${{number_format($total_venta)}}
    </div>
</div>

@endsection