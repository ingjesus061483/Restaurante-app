

@extends('shared/layout')
@section('title','Editar impresora')
@section('content')  
<div class="card mb-4">
    <div class="card-body">        
        <form action="{{url('/impresoras')}}/{{$impresora->id}}" autocomplete="off" method="post">
            @method('PATcH')
            @csrf
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Codigo
                </label>
                <input type="text" name="codigo" value="{{$impresora->codigo}}" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" value="{{$impresora->nombre}}" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Recurso compartido
                </label>
                <input type="text" name="recurso_compartido" value="{{$impresora->recurso_compartido}}" class="form-control" id="nombre">
            </div>

            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Tamaño fuente encabezado                
                </label>
                <input type="text" name="tamaño_fuente_encabezado" value="{{$impresora->tamaño_fuente_encabezado}}" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    tamaño fuente contenido
                </label>
                <input type="text" name="tamaño_fuente_contenido" value="{{$impresora->tamaño_fuente_contenido}}" class="form-control" id="nombre">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Descripcion
                </label>
                <textarea name="descripcion" id="descripcion"  class="form-control"
                 cols="30" rows="10">
                 {{$impresora->descripcion}}
                </textarea>
            </div>
            <a class="btn btn-primary" href="{{url('/')}}/impresoras">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection