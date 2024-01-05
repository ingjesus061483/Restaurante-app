@extends('shared/layout')
@section('title','Restaurant-Master')
@section('content') 
<div class="jumbotron">
    <div class="row" >
        <div class="col-6">
            <p class="lead">bienvenido </p>
            <hr class="my-4">
            <p>Aplicacion para restaurantes con inventario y facturacion de comidas y alquiler de cabañas</p>           
        </div>
        <div class="col-6">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($cabanas as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->codigo}}</td>
                        <td>{{$item->nombre}}</td>            
                        <td>{{$item->capacidad_maxima}}</td>
                        <td>                 
                            <p> <a class ="btn btn-primary" href="{{url('/cabañas')}}/{{$item->id}}"> Ordenar  </a></p>
                        </td>
                    </tr>
                    @endforeach   
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection