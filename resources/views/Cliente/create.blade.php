@extends('shared/layout')
@section('title','Crear cliente')
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
        <form action="{{url('/clientes')}}" autocomplete="off" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="identificacion">
                    Identificacion
                </label>
                <input type="text" value="{{old('identificacion')}}" name="identificacion" class="form-control" id="identificacion">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Apellido
                </label>
                <input type="text" name="apellido" value="{{old('apellido')}}" class="form-control" id="apellido">
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
                <label class="form-label" for="usuario">
                    usuario
                </label>
                <input type="text" name="name" id="name" value="{{old('usuario')}}" class="form-control">        
            </div>
            <div class ="mb-3">
                <label class="form-label" for="password">
                    Contraseña
                </label>
                <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control">        
            </div> <div class ="mb-3">
                <label class="form-label" for="password-confirmation">
                    Confirmar Contraseña
                </label>
                <input type="password" name="password_confirmation" id="password" class="form-control">        
            </div>
            <a class="btn btn-primary" href="{{url('/')}}/clientes">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection