@extends('shared/layout')
@section('title','Editar categorias')
@section('content')  
<div class="card mb-4">
    <div class="card-body">        
        <form action="{{url('/unidad_medida')}}/{{$unidadMedida->id}}" autocomplete="off" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{$unidadMedida->id}}" id="id" >
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{$unidadMedida->nombre}}">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Descripcion
                </label>
                
                <textarea name="descripcion" id="descripcion"  class="form-control"
                cols="30" rows="10">
                    {{$unidadMedida->descripcion}}
               </textarea>
            </div>
            <a class="btn btn-primary" href="{{url('/unidad_medida')}}">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection