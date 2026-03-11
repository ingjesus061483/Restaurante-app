@extends('shared/layout')
@section('title','Restaurant-Master')
@section('content')
<div class="jumbotron">
    <div class="row" >
        <div class="col-12">
            <p class="lead">Bienvenido </p>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Mesas</h5>
                </div>
                <div class="card-body" style ="height: 300px;overflow-y: auto">
                    <div class="row">
                        @foreach($cabanas as $item)
                        <div class="col-4">
                            <div style="padding: 5px">
                                <a title="{{$item->ocupado==1?'La mesa esta ocupada':'La mesa esta libre'}}" class ="{{$item->ocupado==1?'btn btn-danger':'btn btn-primary'}}" href="{{url('/mesas')}}/{{$item->id}}">
                                    <div class="row">
                                        <div class="col-12" style="font-size:12px;font-weight: bold">
                                            {{$item->nombre}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @if($item->imagen!=null)
                                            <img src="{{url("/img/$item->imagen")}}" height="50"width="50">
                                            @endif
                                        </div>
                                    </div>
                                    <div style="font-size: 10px" >
                                      <strong>Cap. max:</strong>  {{$item->capacidad_maxima}}
                                    </div>
                                    @if(auth()->user()->role_id==1||auth()->user()->role_id==2)
                                    <div style="font-size: 10px" >
                                        <strong>Venta:</strong> ${{number_format($item->venta_diaria)}}
                                    </div>
                                    @endif
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <p>Aplicacion para restaurantes con inventario y facturacion de comidas</p>
        </div>
    </div>
</div>
@endsection
