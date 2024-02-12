@extends('shared/layout')
@section('title','Listado de productos')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-3">             
                <br>                           
                <a href="{{url('/productos/create')}}" class="btn btn-primary">Crear productos </a>
            </div>
            <div class="col-9">
                <form target="blank" action="{{url('reportes/ProductosVendidosByFecha')}}">
                    <div class="row">
                        <div class="col-4" >
                            <label class="form-label" for="codigo">                        
                                Fecha inicio                                           
                            </label>                    
                            <input name="fechaIni" value=""  class="form-control" type="date"/>                                        
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="codigo">                        
                                Fecha fin                                           
                            </label>                                        
                            <input name="fechaFin" class="form-control" value="" type="date"/>
                        </div>
                        <div class="col-4">
                            <br>                    
                            <button type="submit" class="btn btn-danger">PDF </button>    
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Codigo </th>
                    <th>Nombre</th>
                    <th>Preparacion</th>
                    <th>Costo unitario</th>                    
                    <th>Precio</th>
                    <th>Tiempo de coccion</th>
                    <th>Unidad medida</th>
                    <th>Categoria</th>
                    <th>Foraneo</th>
                    <th>impresora</th>
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
                    <th>Preparacion</th>
                    <th>Costo unitario</th>                    
                    <TH>Precio</TH>
                    <th>Tiempo de coccion</th>
                    <th>Unidad medida</th>
                    <th>Categoria</th>
                    <th>Foraneo</th>
                    <th>impresora</th>
                    <th></th>
                    <th></th>                    
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>    
                @foreach($productos as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->Preparacion}}</td>
                    <td>${{number_format($item->costo_unitario)}}</td>                    
                    <td>${{ number_format($item->precio)}}</td>
                    <td>{{$item->tiempo_coccion}}</td>
                    <td>{{$item->unidad_medida!=null?$item->unidad_medida->nombre:''}}</td>
                    <td>{{$item->categoria->nombre}}</td>
                    <td>{{$item->foraneo==1?'Si':'No'}}</td>
                    <td>{{$item->impresora->nombre}}</td>
                    <td>
                        @if($item->foraneo)
                        <button onclick="existencias(this,'producto');" class="btn btn-info" >Existencias </button>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-success" href="{{url('/productos')}}/{{$item->id}}">Ver</a>
                    </td>                    
                    <td>
                        <a class="btn btn-warning" href="{{url('/productos')}}/{{$item->id}}/edit">
                            Editar 
                        </a>
                    </td>
                    <td>                
                        <form action="{{url('/productos')}}/{{$item->id}}" 
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

