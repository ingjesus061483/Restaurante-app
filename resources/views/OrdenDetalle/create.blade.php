@extends('shared/layout')
@section('title','Listado de productos')
@section('content')  
<div class="card mb-4">    
    <div class="card-body"> 
        <table id="datatablesSimple">
            <thead>
                <th></th>
                <th>Id</th>
                <th>Detalle</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>

            </thead>
            <tfoot>
                <th></th>
                <th>Id</th>
                <th>Detalle</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
            </tfoot>
            <tbody>
                @foreach($productos as $item)
                <tr>
		     <td>                        
                        <a title="Comprar"  onclick="ordenservicio({{$item->id}});" class="btn btn-primary">
                            <i class="fa-solid fa-cart-shopping"></i>                        
                        </a>                      
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td>${{number_format( $item->precio)}}</td>
                    <td>
                        @if ($item->imagen!=null)
                          <img class="img-fluid" src="{{url('/')}}/img/{{$item->imagen}}" alt="" sizes="" srcset="" width="50px" height="50px"></td>
                        @endif
                    </td>                                            
                  
                </tr>
                @endforeach
            </tbody>
        </table>       
    </div>
    <div class="card-footer">
        <div class="row">
                    
            <div class="col-4">
                <a class="btn btn-primary" href="{{isset($orden_id)?url('/ordenservicio'):url('/ordendetalles')}}">                    
                    Regresar                
                </a>              
            </div>
            @if(!isset($orden_id))
            <div class="col-4">
                <a class="btn btn-primary" href="{{url('/ordenservicio/create')}}">                    
                    Crear orden                
                </a>              
            </div>
            @endif
        </div>        
    </div>
</div>
@endsection