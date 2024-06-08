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
                                    <div class="row">
                                        <div class="col-12" >
                                            {{$item->nombre}}                                     
                                        </div>                                            
                                    </div>
                                    <div class="row">                                        
                                        <div class="col-12">
                                            @if($item->imagen!=null)
                                            <img src="{{url("/img/$item->imagen")}}" height="100"width="100">
                                            @endif 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6" style="font-size: 10px" >                                            
                                            @if(auth()->user()->role_id==1||auth()->user()->role_id==2)                                                                                                            
                                               Venta: ${{number_format($item->venta_diaria)}}                                                                                
                                            @endif
                                        </div>
                                        <div class="col-6" style="font-size: 10px" >                                            
                                            Cap. max:  {{$item->capacidad_maxima}}                                            
                                        </div>
                                    </div>
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