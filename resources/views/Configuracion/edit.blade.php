@extends('shared/layout')
@section('title','Editar configuraciones')
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
            <a class="btn btn-primary" href="{{url('/')}}/configuracion">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>


@endsection