@extends('shared/layout')
@section('title','Listado de insumos')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        <a href="{{url('/materiaprimas/create')}}" class="btn btn-primary">Crear isumos </a>
    </div>
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
                    <th></th>
                    <th></th>
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
                    <th></th>
                    <th></th>
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
                        <a class="btn btn-success" href="{{url('/materiaprimas')}}/{{$item->id}}">Ver</a>
                    </td>
                    <td>
                        <button onclick="existencias(this,'materia_prima');" class="btn btn-info" >Existencias </button>
                    </td>
                    <td>
                        <a class="btn btn-warning" href="{{url('/materiaprimas')}}/{{$item->id}}/edit">
                            Editar 
                        </a>
                    </td>
                    <td>                
                        <form action="{{url('/materiaprimas')}}/{{$item->id}}" 
                            onsubmit="return validar('Desea eliminar este registro?');" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit"> Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
</div>
@endsection

