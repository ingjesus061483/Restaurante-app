@extends('shared/layout')
@section('title','Editar impuesto')
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
        <form action="{{url('/')}}/impuestos/{{$impuesto->id}}" autocomplete="off" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" value="{{$impuesto->nombre}}" 
                class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="valor">
                    Valor
                </label>
                <input type="text" name="valor" value="{{$impuesto->valor}}"
                 class="form-control" id="valor">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Descripcion
                </label>
                <textarea name="descripcion" id="descripcion"  class="form-control"
                 cols="30" rows="10">
                 {{$impuesto->descripcion}}
                </textarea>
            </div>
            <a class="btn btn-primary" href="{{url('/')}}/impuestos">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection