@extends('shared/layout')
@section('title','Editar cabaña')

@section('content')  
<div class="card mb-4">
    <div class="card-body">        
        <form action="{{url('/cabañas')}}/{{$cabana->id}}" enctype="multipart/form-data"
              autocomplete="off" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label class="form-label" for="codigo">
                    Codigo
                </label>
                <input type="text" name="codigo" value="{{$cabana->codigo}}" class="form-control" id="codigo">
            </div>

            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" value="{{$cabana->nombre}}" class="form-control" id="nombre">
            </div>

            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Descripcion
                </label>
                <textarea name="descripcion" id="descripcion"  class="form-control"
                 cols="30" rows="10">
                 {{$cabana->descripcion}}
                </textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="imagen">
                    Imagen
                </label>
                <input type="file" name="imagen" accept="image/*"   class="form-control" id="imagen">
            </div>         
            <div class="mb-3">
                <label class="form-label" for="capacidad">
                    Capacidad
                </label>
                <input type="text" name="capacidad" value="{{$cabana->capacidad_maxima}}" class="form-control" id="capacidad">
            </div>


            <a class="btn btn-primary" href="{{url('/cabañas')}}">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection