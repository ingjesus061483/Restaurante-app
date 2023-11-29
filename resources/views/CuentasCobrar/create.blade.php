@extends('shared/layout')
@section('title','Crear cuentas cobrar')
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
        <form action="{{url('/cuentascobrar')}}" autocomplete="off" method="post">
            @csrf
            <input type="hidden" name="orden_id" value="{{$orden_id}}">
            <div class="mb-3">
                <label class="form-label" for="nombre">
                    Fecha
                </label>
                <input type="date" name="fecha" value="{{old('fecha')}}" class="form-control" id="nombre">
            </div>
            @if($cliente==null)
            <div class="mb-3">
                <label class="form-label">
                    Cliente
                </label>
                <div class="row">
                    <div class="col-10">                        
                        <input type="text" name="cliente"style="display:none"                        
                        value="{{old('cliente')}}" class="form-control" id="cliente">
                    </div>
                    <div class="col-2">                        
                        <a class="btn btn-success" href="{{url('/clientes/create')}}">                            
                            Nuevo cliente                                                
                        </a>
                    </div>
                </div>
            </div>
            @else
            <input type="hidden" name="cliente"style="display:none"                        
            value="{{$cliente->identificacion.'-'.$cliente->nombre}}" class="form-control">
            @endif
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Tiempo
                </label>
                <input type="number" class="form-control" name="tiempo" value="{{old('tiempo')}}" id="">                
            </div>
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Monto
                </label>
                <input type="number" class="form-control" name="monto" value="{{$monto}}" id="">                
            </div>
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Interes
                </label>
                <input type="number" class="form-control" name="interes" value="{{$interes}}" id="">                
            </div>
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Valor recibido    
                </label>
                <input type="number" class="form-control" name="valorRecibido" value="{{$valorRecibido}}" id="">                
            </div>
            <div class ="mb-3">
                <label class="form-label" for="descripcion">
                    Tipo cobro
                </label>
                <select class="form-select" name="tipo_cobro" id="">
                    <option value="">seleccione un tipo de cobro</option>
                    @foreach($tipoCobro as $item)                                        
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                
            </div>
            <a class="btn btn-primary" href="{{url('/')}}/categorias">
                Regresar
            </a> 
            <button class="btn btn-success" type="submit">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection