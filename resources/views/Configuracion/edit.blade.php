@extends('shared/layout')
@section('title','Editar configuraciones')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form action="{{url('/')}}/configuracion/{{$configuracion->id}}" autocomplete="off" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{$configuracion->id}}" id="id" >
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{$configuracion->nombre}}">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Valor
                </label>

                <textarea name="valor" id="descripcion"  class="form-control"
                cols="30" rows="10">
                    {{$configuracion->valor}}
               </textarea>
            </div>
            <a title="Regresar" class="btn btn-primary" href="{{url('/')}}/configuracion">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <button title="Guardar" class="btn btn-success" type="submit">
                <i class="fa-regular fa-floppy-disk"></i>
            </button>
        </form>
    </div>
</div>
@endsection
