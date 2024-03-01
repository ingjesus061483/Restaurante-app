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
        <form action="{{url('/productos')}}" enctype="multipart/form-data" autocomplete="off" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="codigo">
                    Codigo
                </label>
                <input type="text" name="codigo" value="{{old('codigo')}}" class="form-control" id="codigo">
            </div>            
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="costo_unitario">
                    Costo unitario
                </label>
                <input type="text" name="costo_unitario" value="{{old('costo_unitario')}}" class="form-control"
                 id="costo_unitario">
            </div>                        
            <div class="mb-3">
                <label class="form-label" for="precio">
                    Precio
                </label>
                <input type="text" name="precio" value="{{old('precio')}}" class="form-control"
                 id="precio">
            </div>                                 
            <div class="mb-3">
                <label class="form-label" for="categoria">
                    Categoria                
                </label>
                <select type="text" name="categoria" class="form-select"
                 id="categoria">
                 <option value="">seleccione una categoria</option>
                 @foreach($categorias as $item)
                 <option value="{{$item->id}}">{{$item->nombre}}</option>
                 @endforeach
                </select>
            </div>            
            <div class="mb-3">
                <label class="form-label" for="categoria">
                    Impressoras               
                </label>
                <select type="text" name="impresora" class="form-select"
                 id="impresora">
                 <option value="">seleccione una impresora</option>
                 @foreach($impresoras as $item)
                 <option value="{{$item->id}}">{{$item->codigo.' - '.$item->nombre}}</option>
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
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="imagen">
                    Imagen
                </label>
                <input type="file" name="imagen" accept="image/*"   class="form-control" id="imagen">
            </div>         
            <div class="mb-3">
                <label class="form-label" for="foraneo">
                    Foraneo
                </label>
                <input type="checkbox" name="foraneo" class="form-check-inline" id="foraneo">
            </div>                     
            <div class="mb-3" id="coccion" >
                <label class="form-label" for="tiempo_coccion">
                    Tiempo coccion
                </label>
                <input type="text" name="tiempo_coccion" value="{{old('tiempo_coccion')}}" class="form-control"
                 id="tiempo_coccion">
            </div>
            <div class="mb-3" id="inventario" >
                <label class="form-label" for="tiempo_coccion">
                    Existencias
                </label>
                <input type="text" name="existencias" value="{{old('tiempo_coccion')}}" class="form-control"
                 id="existencia">
            </div>                        
            <div class ="mb-3" id="preparacion">
                <label class="form-label" for="preparacion">
                    Preparacion
                </label>
                <textarea name="preparacion" id="preparacion"  class="form-control"
                 cols="30" rows="10">
                 {{old('preparacion')}}
                </textarea>
            </div>
            <div class ="mb-3" >
                <label class="form-label" for="preparacion">
                    Descripcion
                </label>
                <textarea name="descripcion" id="descripcion"  class="form-control"
                 cols="30" rows="10">
                 {{old('descripcion')}}
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