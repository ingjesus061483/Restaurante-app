@extends('shared/layout')
@section('title','Restaurant-Master')
@section('content') 
<div class="jumbotron">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>                    
            @endforeach
        </ul>
    </div>
    @endif    
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
                                <a title="{{$item->ocupado==1?'La mesa esta ocupada':'La mesa esta libre'}}" class ="{{$item->ocupado==1?'btn btn-danger':'btn btn-primary'}}" href="{{url('/cabañas')}}/{{$item->id}}">
                                    @if($item->imagen!=null)
                                    <img src="{{url("/img/$item->imagen")}}" height="50"width="50">
                                    @endif                                
                                    {{$item->nombre}}&nbsp; ${{number_format($item->venta_diaria)}}

                                </a>                            
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