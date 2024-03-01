@extends('shared/layout')
@section('title','Listado de productos')
@section('content')  
<div class="card mb-4">    
    <div class="card-body"> 
        <table id="datatablesSimple">
            <thead>
                <th>Id</th>
                <th>Detalle</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th></th>
            </thead>
            <tfoot>
                <th>Id</th>
                <th>Detalle</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th></th>
            </tfoot>
            <tbody>
                @foreach($productos as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td>${{number_format( $item->precio)}}</td>
                    <td>
                        @if ($item->imagen!=null)
                          <img class="img-fluid" src="{{url('/')}}/img/{{$item->imagen}}" alt="" sizes="" srcset="" width="50px" height="50px"></td>
                        @endif
                    </td>                                            
                    <td>                        
                        <a title="Comprar"  onclick="ordenservicio({{$item->id}});" class="btn btn-primary">
                            <i class="fa-solid fa-cart-shopping"></i>                        
                        </a>                      
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>       
    </div>
    <div class="card-footer">
        <div class="row">
            <div col-auto>
            </div>            
            <div col-auto>
                <a class="btn btn-primary" href="{{isset($orden_id)?url('/ordenservicio'):url('/ordendetalles')}}">                    
                    Regresar                
                </a>              
            </div>
        </div>        
    </div>
</div>
@endsection