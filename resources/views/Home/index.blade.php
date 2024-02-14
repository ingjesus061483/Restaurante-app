@extends('shared/layout')
@section('title','Restaurant-Master')
@section('content') 
<div class="jumbotron">
    <div class="row" >
        <div class="col-12">
            <p class="lead">Bienvenido </p>
            <hr class="my-4">            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">           
                        @foreach($cabanas as $item)
                        <div class="col-4"> 
                            <div style="padding: 5px">
                                <a class ="btn btn-primary" href="{{url('/cabañas')}}/{{$item->id}}"><img src="{{url('/img/mesa.png')}}" height="50"width="50"> {{$item->nombre}}  </a>                            
                            </div>                           
                        </div>                             
                        @endforeach 
                    </div>                  
                </div>
            </div>
            
        </div>
        <div class="col-12">           
            <hr class="my-4">
            <p>Aplicacion para restaurantes con inventario y facturacion de comidas</p>                       
        </div>
    </div>
</div>
@endsection