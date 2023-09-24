@extends('shared/layout')
@section('title','Listado de clientes')
@section('content')  
<div class="card mb-4">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Identificacion</th>
                    <th>Nombre completo </th>            
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>                                       
                </tr>
            </thead>
            <tbody>                
                <tr>
                    <td>{{$cliente->id}}</td>            
                    <td>{{$cliente->identificacion}}</td>
                    <td>{{$cliente->nombre .' '.$cliente->apellido}}</td>            
                    <td>{{$cliente->direccion}}</td>
                    <td>{{$cliente->telefono}}</td>
                    <td>{{$cliente->usuario->email}}</td>                  
                </tr>
            </tbody>        
        </table>
    </div>
</div>
@endsection
