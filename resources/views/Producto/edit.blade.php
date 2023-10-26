@extends('shared/layout')
@section('title','Crear productos')
@section('content')  
<div class="card mb-4">
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>                    
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{url('/productos')}}/{{$producto->id}}" enctype="multipart/form-data" autocomplete="off" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label class="form-label" for="codigo">
                    Codigo
                </label>
                <input type="text" name="codigo" value="{{$producto->codigo}}" class="form-control" id="codigo">
            </div>
            
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" value="{{$producto->nombre}}" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="costo_unitario">
                    Costo unitario
                </label>
                <input type="text" name="costo_unitario" value="{{$producto->costo_unitario}}" class="form-control"
                 id="costo_unitario">
            </div>            
            
            <div class="mb-3">
                <label class="form-label" for="precio">
                    Precio
                </label>
                <input type="text" name="precio" value="{{$producto->precio}}" class="form-control"
                 id="precio">
            </div>     
            <div class="mb-3">
                <label class="form-label" for="tiempo_coccion">
                    Tiempo coccion
                </label>
                <input type="text" name="tiempo_coccion" value="{{$producto->tiempo_coccion}}" class="form-control"
                 id="precio">
            </div>         
                
            <div class="mb-3">
                <label class="form-label" for="foraneo">
                    Foraneo
                </label>
                <input type="checkbox" name="foraneo" {{$producto->foraneo==1?'checked':''}} class="form-check-inline" id="foraneo">
            </div>                     
            <div class="mb-3">
                <label class="form-label" for="categoria">
                    Categoria                
                </label>
                <select type="text" name="categoria" class="form-select"
                 id="categoria">
                 <option value="">seleccione una categoria</option>
                 @foreach($categorias as $item)
                 <option value="{{$item->id}}"
                    @if($item->id==$producto->categoria->id)
                    {{'selected'}}
                    @endif>{{$item->nombre}}</option>
                 @endforeach
                </select>
            </div>            
            <div class="mb-3">
                <label class="form-label" for="categoria">
                    Impresora               
                </label>
                <select type="text" name="impresora" class="form-select"
                 id="categoria">
                 <option value="">seleccione una impresora</option>
                 @foreach($impresoras as $item)
                 <option value="{{$item->id}}"
                    @if($item->id==$producto->impresora->id)
                    {{'selected'}}
                    @endif>{{$item->nombre}}</option>
                 @endforeach
                </select>
            </div>            
            <div class="mb-3">
                <label class="form-label" for="unidad_medida">
                    Unidad medida                
                </label>
                <select type="text" name="unidad_medida" class="form-select"
                 id="unidad_medida">
                    <option value="">seleccione unidad de medida</option>
                    @foreach($unidad_medida as $item)
                    <option value="{{$item->id}}"
                        @if($item->id==($producto->unidad_medida==null?'': $producto->unidad_medida->id))
                    {{'selected'}}
                    @endif>{{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="imagen">
                    Imagen
                </label>
                <input type="file" name="imagen" accept="image/*"   class="form-control" id="imagen">
            </div>                        
            <div class ="mb-3">
                <label class="form-label" for="preparacion">
                    Preparacion
                </label>
                <textarea name="preparacion" id="preparacion"  class="form-control"
                 cols="30" rows="10">
                 {{$producto->preparacion}}
                </textarea>
            </div>
            <div class ="mb-3" id="descripcion">
                <label class="form-label" for="preparacion">
                    Descripcion
                </label>
                <textarea name="descripcion" id="descripcion"  class="form-control"
                 cols="30" rows="10">
                 {{$producto->descripcion}}
                </textarea>
            </div>
            <a class="btn btn-primary" href="{{url('/productos')}}">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection