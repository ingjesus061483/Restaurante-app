@extends('shared/layout')
@section('title','Listado de productos')
@section('content')  
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>                    
        @endforeach
    </ul>
</div>
@endif
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
                            <button title="Ver reporte" type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-file-pdf"></i>
                                
                            </button>    
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
                    <th>Total existencias</th>
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
                    <th>Total existencias</th>
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
                    <td>{{$item->unidad_medida}}</td>
                    <td>{{$item->categoria}}</td>
                    <td>{{$item->foraneo==1?'Si':'No'}}</td>
                    <td>{{number_format($item->total_inventario)}}</td>
                    <td>
                        @if($item->foraneo)
                        <button title="Existencias" onclick="existencias(this,'producto');" class="btn btn-info" >
                            <i class="fa-solid fa-warehouse"></i>
                            
                        </button>
                        @endif
                    </td>
                    <td>
                        <a title="Ver detalles" class="btn btn-success" href="{{url('/productos')}}/{{$item->id}}">
                            <i class="fa-solid fa-eye"></i>                            
                        </a>
                    </td>                    
                    <td>
                        <a title="Editar" class="btn btn-warning" href="{{url('/productos')}}/{{$item->id}}/edit">
                            <i class="fa-solid fa-pen"></i>  
                        </a>
                    </td>
                    <td>                
                        <form action="{{url('/productos')}}/{{$item->id}}" 
                            onsubmit="return validar('Desea eliminar este registro?');" method="post">
                            @csrf
                            @method('delete')
                            <button title="Eliminar" class="btn btn-danger" type="submit"> 
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
</div>
@endsection

