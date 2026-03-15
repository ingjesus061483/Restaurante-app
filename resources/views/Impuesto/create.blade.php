@extends('shared/layout')
@section('title','Crear impuesto')
@section('content')
<div class="card mb-4">
    <div class="card-body">

        <form action="{{url('/impuestos')}}" autocomplete="off" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" value="{{old('nombre')}}"
                class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="valor">
                    Valor
                </label>
                <input type="text" name="valor" value="{{old('valor')}}"
                 class="form-control" id="valor">
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
            <a title="Regresar" class="btn btn-primary" href="{{url('/impuestos')}}">
               <i class="fa-solid fa-arrow-left"></i>
            </a>
            <button title="Guardar" class="btn btn-success" type="submit">
                <i class="fa-regular fa-floppy-disk"></i>
            </button>
        </form>
    </div>
</div>
@endsection
