@extends('shared/layout')
@section('title','Totales de pago por formas de pagos')
@section('content')  
<div class="card mb-4">   
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr> 
            
                    <th>Forma  pago</th>                    
                    <th> Total valor recibido</th>
                    
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Forma  pago</th>                                        
                    <th> Total valor recibido</th>
                </tr>        
            </tfoot>
            <tbody>
                @foreach($pagosdetalles as $item)
                <tr>               
                    <td>{{$item->forma_pago}}</td>                                     
                    <td>{{$item->Total_valor_recibido}}</td>            
                    
                </tr>
                @endforeach   
            </tbody>        
        </table>
    </div>
</div>
@endsection
