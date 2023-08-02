@extends('shared/layout')
@section('title','Editar roles')
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
        <form action="{{url('/')}}/roles/{{$role->id}}" autocomplete="off" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{$role->id}}" id="id" >
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{$role->nombre}}">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Descripcion
                </label>
                
                <textarea name="descripcion" id="descripcion"  class="form-control"
                cols="30" rows="10">
                    {{$role->descripcion}}
               </textarea>
            </div>
            <a class="btn btn-primary" href="{{url('/')}}/roles">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>


@endsection