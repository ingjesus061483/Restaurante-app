@extends('shared/layout')
@section('title','Restaurant-Master')
@section('content')
<div class="jumbotron">
    <div class="row" >
        <div class="col-12">
            <p class="lead">Bienvenido </p>
            @include('shared.accordion')
        </div>
        <div class="col-12" style="padding-top: 5px">
            <p>Aplicacion para restaurantes con inventario y facturacion de comidas</p>
        </div>
    </div>
</div>
@endsection
