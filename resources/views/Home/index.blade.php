@extends('shared/layout')
@section('title','')
@section('content') 
<div class="jumbotron">
    <h1 class="display-4">Restaurant-Master</h1>
    <p class="lead">bienvenido </p>
    <hr class="my-4">
    <p>Aplicacion para restaurantes con inventario y facturacion de comidas y alquiler de cabañas</p>
    <p> <a class ="btn btn-primary" href="{{url('/ordenservicio')}}">¿Puedo tomar su orden?  </a></p>
</div>

@endsection