@extends('shared/layout')
@section('title','Editar empleado')
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
        <form action="{{url('/')}}/empleados/{{$empleado->id}}" autocomplete="off" method="post">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label class="form-label" for="identificacion">
                    Identificacion
                </label>
                <input type="text" name="identificacion" value="{{$empleado->identificacion}}"
                 class="form-control" id="identificacion">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" class="form-control" value="{{$empleado->nombre}}"
                 id="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Apellido
                </label>
                <input type="text" name="apellido" class="form-control" value="{{$empleado->apellido}}" 
                id="apellido">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="direccion">
                    Direccion
                </label>
                <input type="text" name="direccion" id="direccion" value="{{$empleado->direccion}}"
                 class="form-control">        
            </div>
            
            <div class ="mb-3">
                <label class="form-label" for="direccion">
                    Telefono
                </label>
                <input type="text" name="telefono" id="telefono" value="{{$empleado->telefono}}" class="form-control">        
            </div>
            
            <div class ="mb-3">
                <label class="form-label" for="direccion">
                    Email
                </label>
                <input type="text" name="email" readonly id="email" value="{{$empleado->usuario->email}}" class="form-control">        
            </div>
            <div class="mb-3">
                <label class="form-label" for="role">
                    Role                
                </label>
                <select class="form-select" name="role" id="role">
                    <option value="">seleccione un role</option>
                    @foreach ($roles as $item)
                    <option value="{{$item->id}}"
                        @if($item->id==$empleado->usuario->role_id)
                        {{"selected"}}
                        @endif
                        >{{$item->nombre}}</option>        
                    @endforeach
                </select>
            </div>
            <a class="btn btn-primary" href="{{url('/')}}/empleados">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection