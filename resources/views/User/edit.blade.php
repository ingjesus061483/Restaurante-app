@extends('shared/layout')
@section('title','Cambio de contraseña')
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
        <form id="frmUpdate" action="{{url('/usuarios')}}/{{auth()->user()->id}}" method="post">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    email
                </label>
                <input type="text" name="user_email" value="{{auth()->user()->email}}" class="form-control" id="user_name">
            </div>

            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Usuario
                </label>
                <input type="text" name="user_name" value="{{auth()->user()->name}}" class="form-control" id="user_name">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Contraseña actual                    
                </label>
                <input type="password" name="current_password" value="" class="form-control" id="current_passowrd">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nueva Contraseña                        
                </label>
                <input type="password" name="password"  class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Confirmar Contraseña
                </label>
                <input type="password" name="password_confirmation"  class="form-control" id="password_confirmation">
            </div>
            <a class="btn btn-primary" href="{{url('/')}}">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Cambiar contraseña            
            </button>
        </form>                    
    </div>
</div>
@endsection