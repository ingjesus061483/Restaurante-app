@extends('shared/layout')
@section('title','Listado de cumpleaños')
@section('content')  
<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Identificacion</th>
                    <th>Nombre completo </th>            
                    <th>Fecha nacimiento</th>                  
                    <th>Role</th>                    
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Identificacion</th>
                    <th>Nombre completo </th>            
                    <th>Fecha nacimiento</th>
                    <th>Role</th>
                    
                </tr>        
            </tfoot>
            <tbody>
                @foreach($empleados as $item)
                <tr>
                    <td>{{$item->id}}</td>            
                    <td>{{$item->identificacion}}</td>
                    <td>{{$item->nombre .' '.$item->apellido}}</td>            
                    <td>{{$item->fecha_nacimiento}}</td>
                    <td>{{$item->usuario->role->nombre}}</td>
                </tr>
                @endforeach   
            </tbody>        
        </table>
    </div>
</div>
@endsection
