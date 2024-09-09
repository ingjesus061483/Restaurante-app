@extends('shared/layout')
@section('title','Editar cliente')
@section('content')  
<div class="card mb-4">
    <div class="card-body">        
        <form action="{{url('/clientes')}}/{{$cliente->id}}" autocomplete="off" method="post">
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{$cliente->id}}">
            <div class="mb-3">
                <label class="form-label" for="identificacion">
                    Identificacion
                </label>
                <input type="text" name="identificacion" value="{{$cliente->identificacion}}"
                 class="form-control" id="identificacion">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" class="form-control" value="{{$cliente->nombre}}"
                 id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Apellido
                </label>
                <input type="text" name="apellido" class="form-control" value="{{$cliente->apellido}}" 
                id="apellido">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="direccion">
                    Direccion
                </label>
                <input type="text" name="direccion" id="direccion" value="{{$cliente->direccion}}"
                 class="form-control">        
            </div>
            
            <div class ="mb-3">
                <label class="form-label" for="direccion">
                    Telefono
                </label>
                <input type="text" name="telefono" id="telefono" value="{{$cliente->telefono}}" class="form-control">        
            </div>
            
            <div class ="mb-3">
                <label class="form-label" for="direccion">
                    Email
                </label>
                <input type="text" name="email"  id="email" value="{{$cliente->email}}" class="form-control">        
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