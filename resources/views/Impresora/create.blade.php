@extends('shared/layout')
@section('title','Crear impresora')
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
        <form action="{{url('/impresoras')}}" autocomplete="off" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Codigo
                </label>
                <input type="text" name="codigo" value="{{old('codigo')}}" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Recurso compartido
                </label>
                <input type="text" name="recurso_compartido" value="{{old('recurso_compartido')}}" class="form-control" id="nombre">
            </div>

            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Tamaño fuente encabezado                
                </label>
                <input type="text" name="tamaño_fuente_encabezado" value="{{old('tamaño_fuente_encbezado')}}" class="form-control" id="nombre">
            </div>

            <div class="mb-3">
                <label class="form-label" for="nombre">
                    tamaño fuente contenido
                </label>
                <input type="text" name="tamaño_fuente_contenido" value="{{old('tamaño_fuente_contenido')}}" class="form-control" id="nombre">
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