@extends('shared/layout')
@section('title','Editar empleado')
@section('content')  
<div class="card mb-4">
    <div class="card-body">            
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
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Fecha de nacimiento
                </label>
                <input type="date" name="fecha_nacimiento" value="{{$empleado->fecha_nacimiento}}" class="form-control" id="fecha_nacimiento">
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
            <div class ="mb-3">
                <label class="form-label" for="usuario">
                    usuario
                </label>
                <input type="text" name="name" id="name" value="{{$empleado->usuario->name}}" class="form-control">        
            </div>
            <div class ="mb-3">
                <label class="form-label" for="password">
                    Contraseña
                </label>
                <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control">        
            </div> 
            <div class ="mb-3">
                <label class="form-label" for="password-confirmation">
                    Confirmar Contraseña
                </label>
                <input type="password" name="password_confirmation" id="password" class="form-control">        
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
            <div class="mb-3">
                <label class="form-label" for="role">
                    Caja
                </label>
                <select class="form-select" name="caja" id="role">
                    <option value="">seleccione una caja</option>
                    @foreach ($cajas as $item)
                    <option value="{{$item->id}}"
                        {{$item->id==$empleado->usuario->caja_id?"selected":''}}
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