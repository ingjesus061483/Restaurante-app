@extends('shared/layout')
@section('title','Listado de productos')
@section('content')  
<div class="card mb-4">
    <div class="card-header">        
        <a href="{{url('/ordenservicio/create')}}" class="btn btn-primary">            
            Ordenar        
        </a>            
    </div>
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
                          <img class="img-fluid" src="{{url('/')}}/img/{{$item->imagen}}" alt="" sizes="" srcset="">                                                                                        </td>
                        @endif
                    </td>                                            
                    <td>                        
                        <a  onclick="ordenservicio({{$item->id}});" class="btn btn-primary">Comprar</a>                      
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
                <a class="btn btn-primary" href="{{url('/ordendetalles')}}">                    
                    Regresar                
                </a>                 
              
            </div>
        </div>        
    </div>
</div>
@endsection