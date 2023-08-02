@extends('shared/layout')
@section('title','Listado de productos')
@section('content')  
<div class="card mb-4">
    <div class="card-body">   
        <div class="row">
            @foreach($productos as $item)
            <div class="col-4">
                <div class="card mb-4" id="{{$item->id}}">
                    <div  class="card-header">
                        <h4 style="text-align: center">{{$item->nombre}}</h4>
                    </div>
                    <div class="card-body">                             
                        @if ($item->imagen!=null)                                                                                     
                        <div class="mb-3">                  
                            <img class="img-fluid" src="{{url('/')}}/img/{{$item->imagen}}" alt="" sizes="" srcset="">                                                                                        
                            <hr>                                                                                                                                              
                        </div>                                        
                        @endif                                        
                        @if ($item->descripcion!=null)                                                
                        <div class="mb-3">                            
                            <h6 style="text-align: justify">{{$item->descripcion}}</h6>                                                                                                          
                        </div>                                                    
                        @endif
                                                            
                    </div>
                    <div class="card-footer">
                        <div class="mb-3 embed-responsive" >
                            <div class="row">                                                                             
                                <div class="col-auto">                                                                    
                                    <h6>${{number_format( $item->precio)}}</h6>                                        
                                </div>                                           
                                <div class="col-auto">                                    
                                    <a  onclick="ordenservicio({{$item->id}});" class="btn btn-primary">Comprar</a>                                                               
                                </div>                          
                            </div>
                        </div> 
                    </div>
                </div>         
            </div>    
            @endforeach
        </div>
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