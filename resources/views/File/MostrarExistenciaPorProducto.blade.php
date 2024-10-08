@extends('shared/reportes')
@section('title','Detalle de productos')
@section('content')  
<div class="card mb-4">
    <input type="hidden" id="producto_id" value="{{$producto->id}}">
    <div class="card-body"> 
        <div class="card mb-4">
            <div class="card-header">
                Datos de productos
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
                                    {{$producto->codigo}}
                                </div>                        
                            </div>                        
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="codigo">
                                        Nombre
                                    </label>
                                    {{$producto->nombre}}
                                </div>
                            </div>       
                            <div class="col-4">                        
                                <div class="mb-3">                            
                                    <label class="form-label" for="costo_unitario">                                
                                        Costo unitario                            
                                    </label>                            
                                    ${{number_format($producto->costo_unitario)}}                                                    
                                </div>                    
                            </div>                    
                        </div>
                        <div class="row">  
                            <div class="col-4">                        
                                <div class="mb-3">                            
                                    <label class="form-label" for="costo_unitario">                                
                                        Precio                            
                                    </label>                            
                                    ${{number_format($producto->precio)}}                                                    
                                </div>                    
                            </div>                                     
                            <div class="col-4">                        
                                <div class="mb-3">                            
                                    <label class="form-label" for="categoria">                                
                                        Categoria                                            
                                    </label>                            
                                    {{$producto->categoria->nombre}}                        
                                </div>                    
                            </div>                    
                            <div class="col-4">                        
                                <div class="mb-3">                            
                                    <label class="form-label" for="unidad_medida">                                
                                        Unidad medida                                            
                                    </label>                            
                                    {{$producto->unidad_medida!=null?$producto->unidad_medida->nombre:''}}                        
                                </div>                    
                            </div>                                                    
                        </div>   
                        <div class="row">
                            <div class="col-4">                        
                                <div class="mb-3">                            
                                    <label class="form-label" for="costo_unitario">                                
                                        Procesado                            
                                    </label>                            
                                    {{$producto->procesado==1?'si':'no'}}                                                    
                                </div>                    
                            </div>                        
                            <div class="col-4">                        
                                <div class="mb-3">                            
                                    <label class="form-label" for="costo_unitario">                                
                                        Impresora asociada                            
                                    </label>                            
                                    {{$producto->impresora->nombre}}                                                    
                                </div>                    
                            </div>                        
                        </div>             
                        <div class="row">                            
                            <div class="col-12">                            
                                <div class ="mb-3">                                
                                    <label class="form-label" for="descripcion">                                                                            
                                        Preparacion         
                                    </label>                                
                                        {{$producto->preparacion}}                                                        
                                </div>      
                            </div>
                        </div>                        
                    </div>
                    <div class="col-6">
                        @if($producto->imagen!=null)
                        <div class="mb-3">                            
                            <label class="form-label" for="imagen">                                
                                Imagen                            
                            </label>                          
                            <img src="{{url('/')}}/img/{{$producto->imagen}}" class="img-thumbnail" alt="">                                                            
                        </div>                          
                        @endif                  
                    </div>
                </div>
            </div>
        </div>
        @if($producto->procesado==1)
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-4" >
                        
                    </div>                    
                    <div class="col-4" >                        
                        Ingredientes
                    </div>                    
                    <div class="col-4" >                        
                    </div>
                </div>                
            </div>
            <div class="card-body">                
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Id</th>                            
                            <th>Materia prima</th>
                            <th>Cantidad</th>                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    
                    <tbody>    
                        @foreach($producto->preparacions as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->materia_prima->codigo.' - '.$item->materia_prima->nombre}}</td>
                            <td>{{$item->cantidad}}</td>           
                          
                        </tr>
                        @endforeach   
                    </tbody>
                </table>
            </div>
        </div>
        @else
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
                                        <td>{{number_format( $item->cantidad)}}</td>
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
                            {{ number_format($total_salida)}}                        
                        </div>                                       

                    </div>
                    <div class="col-4" >

                        <div class="mb-3">                            
                            <label class="form-label" for="imagen">                                
                                Total movimiento
                            </label>                            
                            {{number_format($total_entrada-$total_salida)}}                        
                        </div>                                       

                    </div>
                </div>
            </div>
        </div>
        @endif       
    </div>
</div>
@endsection