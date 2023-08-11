@extends('shared/layout')
@section('title','Listado de configuraciones')
@section('content')  
<div class="card mb-4">    
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Valor</th>                    
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Valor</th>                    
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($configuraciones as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->nombre}}</td>            
                    <td>{{$item->valor}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{url('/')}}/configuracion/{{$item->id}}/edit">
                            Editar 
                        </a>
                    </td>
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
</div>
@endsection
