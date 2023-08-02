@extends('shared/layout')
@section('title','Inventario de materias primas')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-4">
                <a href="{{url('/reportes/inventario')}}" target="blank" class="btn btn-danger">PDF </a>        
            </div>
            <div class="col-4">
            </div>            
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label" for="nombre">
                        Total existencias
                    </label>
                   {{$total_inventario}}
                </div> 
            </div>
        </div>        
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Nombre</th>
                    <th>Costo unitario</th>                    
                    <th>Categoria</th>       
                    <th>Unidad medida</th>                           
                    <th>Tipo</th>
                    <th>Total enetrada </th>
                    <th>Total salida</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>                   
                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Nombre</th>
                    <th>Costo unitario</th>                        
                    <th>Categoria</th>       
                    <th>Unidad medida</th>       
                    <th>Tipo</th>
                    <th>Total enetrada </th>
                    <th>Total salida</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>    
                @foreach($inventario as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{number_format($item->costo_unitario)}}</td>                                                            
                    <td>{{$item->categoria}}</td>       
                    <td>{{$item->unidad_medida}}</td>                           
                    <td>{{$item->tipo}}</td>
                    <td>{{number_format( $item->total_entrada)}}</td>
                    <td>{{number_format($item->total_salida)}}</td>
                    <td>{{number_format($item->total_inventario)}}</td>
                    <td>
                        <a class="btn btn-success" 
                        href="{{url('/')}}/{{$item->tipo=='producto'?'productos':'materiaprimas'}}/{{$item->id}}">Ver</a>
                    </td>
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
</div>
@endsection

