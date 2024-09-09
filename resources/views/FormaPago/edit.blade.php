@extends('shared/layout')
@section('title','Editar forma de pagos')
@section('content')  
<div class="card mb-4">
    <div class="card-body">        
        <form action="{{url('/')}}/formapagos/{{$formapago->id}}" autocomplete="off" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{$formapago->id}}" id="id" >
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{$formapago->nombre}}">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Descripcion
                </label>
                
                <textarea name="descripcion" id="descripcion"  class="form-control"
                cols="30" rows="10">
                    {{$formapago->descripcion}}
               </textarea>
            </div>
            <a class="btn btn-primary" href="{{url('/')}}/formapagos">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection