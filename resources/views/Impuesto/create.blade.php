@extends('shared/layout')
@section('title','Crear impuesto')
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
        <form action="{{url('/')}}/impuestos" autocomplete="off" method="post">
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