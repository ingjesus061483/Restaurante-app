@extends('shared/layout')
@section('title','Crear insumo')
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
        <form action="{{url('/materiaprimas')}}" enctype="multipart/form-data" autocomplete="off" method="post">
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
                <label class="form-label" for="costo_unitario">
                    Existencias
                </label>
                <input type="text" name="existencias" value="{{old('existencia')}}" class="form-control">
            </div>            

            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Descripcion
                </label>
                <textarea name="descripcion" id="descripcion"  class="form-control"
                 cols="30" rows="10">
                 {{old('descripcion')}}
                </textarea>
            </div>
            <a class="btn btn-primary" href="{{url('/')}}/categorias">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection