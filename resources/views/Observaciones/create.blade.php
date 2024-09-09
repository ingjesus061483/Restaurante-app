@extends('shared/layout')
@section('title','Crear observacion')
@section('content')  
<div class="card mb-4">
    <div class="card-body">
        
        <form action="{{url('/')}}/observaciones" autocomplete="off" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="codigo">
                    Codigo
                </label>
                <input type="text" name="codigo" value="{{old('codigo')}}" class="form-control" id="codigo">
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