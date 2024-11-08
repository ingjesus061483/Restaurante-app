@extends('shared/layout')
@section('title','Editar proveedor')
@section('content')  
<div class="card mb-4">
    <div class="card-body">        
        <form action="{{url('/proveedores')}}/{{$proveedor->id}}" autocomplete="off" method="post">
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{$proveedor->id}}">
            <div class="mb-3">
                <label class="form-label" for="identificacion">
                    Identificacion
                </label>
                <input type="text" name="identificacion" value="{{$proveedor->identificacion}}"
                 class="form-control" id="identificacion">
            </div>
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Nombre
                </label>
                <input type="text" name="nombre" class="form-control" value="{{$proveedor->nombre}}"
                 id="nombre">
            </div>
            <div class ="mb-3">
                <label class="form-label" for="direccion">
                    Direccion
                </label>
                <input type="text" name="direccion" id="direccion" value="{{$proveedor->direccion}}"
                 class="form-control">        
            </div>
            
            <div class ="mb-3">
                <label class="form-label" for="direccion">
                    Telefono
                </label>
                <input type="text" name="telefono" id="telefono" value="{{$proveedor->telefono}}" class="form-control">        
            </div>
            
            <div class ="mb-3">
                <label class="form-label" for="direccion">
                    Email
                </label>
                <input type="text" name="email"  id="email" value="{{$proveedor->email}}" class="form-control">        
            </div>
            <a class="btn btn-primary" href="{{url('/')}}/proveedores">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection