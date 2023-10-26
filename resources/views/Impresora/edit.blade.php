

@extends('shared/layout')
@section('title','Editar impresora')
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
                    Anchura papel
                </label>
                <input type="text" name="anchura_papel" value="{{$impresora->anchura_papel}}" class="form-control" id="nombre">
            </div>

            <div class="mb-3">
                <label class="form-label" for="nombre">
                    tamaño_fuente
                </label>
                <input type="text" name="tamaño_fuente" value="{{$impresora->tamaño_fuente}}" class="form-control" id="nombre">
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