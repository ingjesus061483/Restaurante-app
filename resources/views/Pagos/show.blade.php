@extends('shared/layout')
@section('title','Ver detalles de pagos')
@section('content')  
<div class="card mb-4">   
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr> 
                    <th>Id</th>
                    <th>Detalle pago</th>                    
                    <th>Valor recibido</th>
                    <th>Forma pago</th>                                      
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Detalle pago</th>                    
                    <th>Valor recibido</th>
                    <th>Forma pago</th>                  
                </tr>        
            </tfoot>
            <tbody>
                @foreach($pagosdetalles as $item)
                <tr>
                    <td>{{$item->id}}</td>            
                    <td>{{$item->detalle_pago}}</td>
                    <td>${{number_format($item->valor_recibido)}}</td>            
                    <td>{{$item->forma_pago->nombre}}</td>                                     
                </tr>
                @endforeach   
            </tbody>        
        </table>
    </div>
</div>
@endsection
