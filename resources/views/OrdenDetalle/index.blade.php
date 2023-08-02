@extends('shared/layout')
@section('title','Detalle de ordenes')
@section('content')  
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>                    
        @endforeach
    </ul>
</div>
@endif
<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-4">
                <a href=" {{url('/ordendetalles/create')}}"  class="btn btn-primary">
                    Crear detalle de Orden servicio 
                </a>
            </div>
            <div class="col-4">               
            </div>
            <div  class="col-4">
                <a href="{{url('/ordenservicio/create')}}" class="btn btn-primary">
                    Ordenar
                </a>
            </div>

        </div>
        
    </div>
    <div class="card-body">        
        <div class="row">
            <div class="col-12">
                <table id="datatablesSimple">
                    <thead>
                        <tr>       
                            <th>Id</th>             
                            <th>Cantidad  </th>
                            <th>Detalle</th>
                            <th>Valor Unitario </th>                    
                            <th>Total</th>                                                            
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>     
                            <th>Id</th>               
                            <th>Cantidad  </th>
                            <th>Detalle</th>
                            <th>Valor Unitario </th>                    
                            <th>Total</th>                                                            
                            <th></th>
                        </tr>                
                    </tfoot>
                    <tbody>    
                        @foreach( $orden_detalle as $item)        
                            
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->cantidad}}</td>
                                <td>{{$item->detalleOrden}}</td>
                                <th>{{$item->valorUnitario}}</th>
                                <th>{{$item->total}} </th>           
                                <td>                
                                    <form action="{{url('/ordendetalles')}}/{{$item->id}}" 
                                        onsubmit="return validar('Desea eliminar este registro?');" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit"> Cancelar</button>
                                    </form>
                                </td>
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
                Total orden:
                {{$total}}
            </div>

        </div>       
    </div>
</div>

@endsection

