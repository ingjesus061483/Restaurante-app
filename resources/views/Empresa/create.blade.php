@extends('shared/layout')
@section('title','Crear empresa')
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
        <form action="{{url('/empresas')}}" enctype="multipart/form-data" autocomplete="off" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="identificacion">
                    Nit
                </label>
                <input type="text" value="{{old('nit')}}" name="nit" class="form-control" id="nit">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="camara_de_comercio">
                    Camara de comercio
                </label>
                <input type="text" name="camara_de_comercio" value="{{old('camara_de_comercio')}}" class="form-control" id="camara_de_comercio">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="direccion">
                    Direccion
                </label>
                <input type="text" name="direccion" id="direccion" value="{{old('direccion')}}" class="form-control">        
            </div>
            
            <div class ="mb-3">
                <label class="form-label" for="telefono">
                    Telefono
                </label>
                <input type="text" name="telefono" id="telefono" value="{{old('telefono')}}" class="form-control">        
            </div>
            
            <div class ="mb-3">
                <label class="form-label" for="email">
                    Email
                </label>
                <input type="text" name="email" id="email" value="{{old('email')}}" class="form-control">        
            </div>
            <div class ="mb-3">
                <label class="form-label" for="contacto">
                    Contacto
                </label>
                <input type="text" name="contacto" id="contacto" value="{{old('contacto')}}" class="form-control">        
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
                    {{old('slogan')}}
                </textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="tipo_regimen">
                    Tipo regimen            
                </label>
                <select class="form-select" name="tipo_regimen" id="tipo_regimen">
                    <option value="">seleccione un tipo regimen</option>
                    @foreach ($tipo_regimen as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>        
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