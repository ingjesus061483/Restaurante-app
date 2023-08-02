@extends('shared/layout')
@section('title','Listado de materias primas')
@section('content')  
<input type="hidden" id="producto_id" value="{{$producto_id}}">
<div class="card mb-4">    
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Costo unitario</th>                    
                    <th>Unidad medida</th>
                    <th>Categoria</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>                   
                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Costo unitario</th>                    
                    <th>Unidad medida</th>
                    <th>Categoria</th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>    
                @foreach($materiaprimas as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td>{{number_format( $item->costo_unitario)}}</td>                    
                    <td>{{$item->unidad_medida->nombre}}</td>
                    <td>{{$item->categoria->nombre}}</td>
                    <td>
                        <a class="btn btn-success" onclick="InsertarIgredientes(this);" >Abrir formulario</a>
                    </td>
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
</div>
@endsection