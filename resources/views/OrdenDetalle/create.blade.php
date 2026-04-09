@extends('shared/layout')
@section('title','Listado de productos')
@section('content')
<div class="card mb-4">
    <div  class="card-header">
        @include('shared/Categorias')
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <th></th>
                <th>Id</th>
                <th>Detalle</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>

            </thead>
            <tfoot>
                <th></th>
                <th>Id</th>
                <th>Detalle</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Imagen</th>
            </tfoot>
            <tbody>
                @foreach($productos as $item)
                <tr>
		            <td>
                        <a title="Comprar" onclick="ordenservicio({{$item->id}});" class="btn btn-primary">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td>${{number_format( $item->precio)}}</td>
                    <td>
                        @if ($item->imagen!=null)
                          <img class="img-fluid" src="{{url('/img')}}/{{$item->imagen}}" alt="" sizes="" srcset="" width="50px" height="50px">
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <a title="Regresar" class="btn btn-primary" href="{{url('/ordenservicio')}}">
            <i class="fa-solid fa-circle-arrow-left"></i>
        </a>
        @if(!isset($orden_id))
        <a title="Crear orden" class="btn btn-primary" href="{{url('/ordenservicio/create')}}">
            <i class="fa-solid fa-receipt"></i>
        </a>
        @endif
    </div>
</div>
@endsection
