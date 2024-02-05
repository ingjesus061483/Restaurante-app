@extends('shared/layout')
@section('title','Detalle de insumos')
@section('content')  
<div class="card mb-4">
    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                Datos de materia prima
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row">                        
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="codigo">
                                        Codigo                
                                    </label>
                                    {{$materiaprima->codigo}}
                                </div>                        
                            </div>                        
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="codigo">
                                        Nombre
                                    </label>
                                    {{$materiaprima->nombre}}
                                </div>
                            </div>       
                            <div class="col-4">                        
                                <div class="mb-3">                            
                                    <label class="form-label" for="costo_unitario">                                
                                        Costo unitario                            
                                    </label>                            
                                    {{number_format( $materiaprima->costo_unitario)}}                                                    
                                </div>                    
                            </div>                    
                        </div>
                        <div class="row">                              
                            <div class="col-4">                        
                                <div class="mb-3">                            
                                    <label class="form-label" for="categoria">                                
                                        Categoria                                            
                                    </label>                            
                                    {{$materiaprima->categoria->nombre}}                        
                                </div>                    
                            </div>                    
                            <div class="col-4">                        
                                <div class="mb-3">                            
                                    <label class="form-label" for="unidad_medida">                                
                                        Unidad medida                                            
                                    </label>                            
                                    {{$materiaprima->unidad_medida->nombre}}                        
                                </div>                    
                            </div>                        
                        </div>                
                        <div class="row">                            
                            <div class="col-12">                            
                                <div class ="mb-3">                                
                                    <label class="form-label" for="descripcion">                                                                            
                                        Descripcion                                                                    
                                    </label>                                
                                        {{$materiaprima->descripcion}}                                                        
                                </div>      
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">                            
                            <label class="form-label" for="imagen">                                
                                Imagen                            
                            </label>  
                            @if($materiaprima->imagen!=null)
                            <img src="{{url('/')}}/img/{{$materiaprima->imagen}}" class="img-thumbnail" alt="">                          
                            @endif                        
                        </div>                          
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                Detalles de movimiento
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">                            
                            Detalles de entrada                        
                        </div>
                        <div class="mb-3">                            
                            <table class="table">
                                <thead>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Cantidad</th>
                                </thead>
                                <tbody>                                    
                                    @foreach($entradas as $item )
                                    <tr>
                                        <td>{{ $item->id}}</td>
                                        <td>{{ $item->fecha}}</td>
                                        <td>{{ number_format(  $item->cantidad)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">                            
                            Detalles de salida                        
                        </div>
                        <div class="mb-3">                            
                            <table class="table">
                                <thead>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Cantidad</th>
                                </thead>
                                <tbody>                                    
                                    @foreach($salidas as $item )
                                    <tr>
                                        <td>{{ $item->id}}</td>
                                        <td>{{ $item->fecha}}</td>
                                        <td>{{number_format( $item->cantidad)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>                        
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-4" >
                        <div class="mb-3">                            
                            <label class="form-label" for="imagen">                                
                                Total entrada                           
                            </label>                            
                            {{number_format( $total_entrada)}}                        
                        </div>                                       

                    </div>
                    <div class="col-4" >
                        <div class="mb-3">                            
                            <label class="form-label" for="imagen">                                
                                Total salida
                            </label>                            
                            {{number_format( $total_salida)}}                        
                        </div>                                       

                    </div>
                    <div class="col-4" >

                        <div class="mb-3">                            
                            <label class="form-label" for="imagen">                                
                                Total movimiento
                            </label>                            
                            {{number_format( $total_entrada-$total_salida)}}                        
                        </div>                                       

                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-primary" href="{{url('/materiaprimas')}}">           
            Regresar
        </a>
        <a class="btn btn-danger" href="{{url('/reportes/movimiento/')}}/{{$materiaprima->id}}">            
            PDF
        </a>
    </div>
</div>
@endsection