@extends('shared/layout')
@section('title','Crear unidad de medida')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form action="{{url('/unidad_medida')}}" autocomplete="off" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" id="nombre">
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
            <a title="Regresar" class="btn btn-primary" href="{{url('/unidad_medida')}}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <button title="Guardar" class="btn btn-success" type="submit">
                <i class="fa-solid fa-save"></i>
            </button>
        </form>
    </div>
</div>
@endsection
