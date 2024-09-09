@extends('shared/layout')
@section('title','Crear empresa')
@section('content')  
<div class="card mb-4">
    <div class="card-body">        
        <form action="{{url('/empresas')}}/{{$empresa->id}}" enctype="multipart/form-data" autocomplete="off" method="post">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label class="form-label" for="identificacion">
                    Nit
                </label>
                <input type="text" value="{{$empresa->nit}}" name="nit" class="form-control" id="nit">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" value="{{$empresa->nombre}}" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="camara_de_comercio">
                    Camara de comercio
                </label>
                <input type="text" name="camara_de_comercio" value="{{$empresa->camara_de_comercio}}" class="form-control" id="camara_de_comercio">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="direccion">
                    Direccion
                </label>
                <input type="text" name="direccion" id="direccion" value="{{$empresa->direccion}}" class="form-control">        
            </div>
            
            <div class ="mb-3">
                <label class="form-label" for="telefono">
                    Telefono
                </label>
                <input type="text" name="telefono" id="telefono" value="{{$empresa->telefono}}" class="form-control">        
            </div>
            
            <div class ="mb-3">
                <label class="form-label" for="email">
                    Email
                </label>
                <input type="text" name="email" id="email" value="{{$empresa->email}}" class="form-control">        
            </div>
            <div class ="mb-3">
                <label class="form-label" for="contacto">
                    Contacto
                </label>
                <input type="text" name="contacto" id="contacto" value="{{$empresa->contacto}}" class="form-control">        
            </div>
            <div class ="mb-3">
                <label class="form-label" for="imagen">
                    Logo
                </label>
                <input type="file" name="imagen" accept="image/*"   class="form-control" id="imagen">
            </div> 
            <div class ="mb-3">
                <label class="form-label" for="slogan">
                    Slogan
                </label>
                <textarea name="slogan" id="slogan" class="form-control" cols="30" rows="10">
                    {{$empresa->slogan}}
                </textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="tipo_regimen">
                    Tipo regimen            
                </label>
                <select class="form-select" name="tipo_regimen" id="tipo_regimen">
                    <option value="">seleccione un tipo regimen</option>
                    @foreach ($tipo_regimen as $item)
                    <option value="{{$item->id}}"
                        @if($item->id==$empresa->tipo_regimen_id)
                        {{'selected'}}
                        @endif
                        >{{$item->nombre}}</option>        
                    @endforeach
                </select>
            </div>
           
            <a class="btn btn-primary" href="{{url('/')}}/empresas">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection