@extends('shared/reportes')
@section('title','vista previa Inventario')
@section('content')  
<h2> Inventario de productos y materia prima </h2>      
<div class="row">    
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Nombre</th>
                    <th>Costo unitario</th>                    
                    <th>Categoria</th>
                    <th>Unidad medida</th>                    
                    <th>Total enetrada </th>
                    <th>Total salida</th>
                    <th>Total</th>                    
                    <th>Tipo </th>
                </tr>
            </thead>            
            <tbody>    
                @foreach($inventario as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->nombre}}</td>                            
                    <td>${{number_format($item->costo_unitario)}}</td>                                                            
                    <td>{{$item->categoria}}</td>            
                    <td>{{$item->unidad_medida}}</td>            
                    <td>{{$item->total_entrada}}</td>
                    <td>{{$item->total_salida}}</td>
                    <td>{{$item->total_inventario}}</td>
                    <td>{{$item->tipo}}</td>                    
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
            Total existencias:                        
        </strong>                                    
        {{$total_inventario}}                        
    </div>
</div>
@endsection
