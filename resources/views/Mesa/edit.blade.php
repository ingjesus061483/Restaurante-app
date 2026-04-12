@extends('shared/layout')
@section('title','Editar mesa')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form action="{{url('/mesas')}}/{{$cabana->id}}" enctype="multipart/form-data"
              autocomplete="off" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{$cabana->id}}">

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
            <div class="mb-3">
                <label class="form-label" for="dependencia_id">
                    Dependencia
                </label>
                <select name="dependencia" id="dependencia" class="form-select">
                    <option value="">Seleccione una dependencia</option>
                    @foreach($dependencias as $item)
                    <option value="{{$item->id}}" {{$cabana->dependencia_id==$item->id?'selected':''}}>
                        {{$item->nombre}}
                    </option>
                    @endforeach
                </select>
            <a title="Regresar" class="btn btn-primary" href="{{url('/mesas')}}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <button title="Guardar" class="btn btn-success" type="submit">
                <i class="fa-regular fa-floppy-disk"></i>
            </button>
        </form>
    </div>
</div>
@endsection
