@extends('shared/layout')
@section('title','Editar observacion')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form action="{{url('/observaciones')}}/{{$observacion->id}}" autocomplete="off" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label class="form-label" for="codigo">
                    codigo
                </label>
                <input type="text" name="codigo" value="{{$observacion->codigo}}" class="form-control" id="codigo">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Descripcion
                </label>
                <textarea name="descripcion" id="descripcion"  class="form-control"
                 cols="30" rows="10">
                 {{$observacion->descripcion}}
                </textarea>
            </div>
            <a title="Regresar" class="btn btn-primary" href="{{url('/')}}/observaciones">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <button title="Guardar" class="btn btn-success" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
            </button>
        </form>
    </div>
</div>
@endsection
