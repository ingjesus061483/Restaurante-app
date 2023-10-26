@extends('shared/layout')
@section('title','Editar observacion')
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
            <a class="btn btn-primary" href="{{url('/')}}/observaciones">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection