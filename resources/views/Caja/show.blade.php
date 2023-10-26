@extends('shared/layout')
@section('title','Listado de cajas')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        Caja
    </div>
    <div class="card-body">
        <div  class="row" >
            <div class="col-6">
                <label class="form-label" for="">Codigo </label> 
                {{$caja->codigo}}
            </div>
            <div class="col-6">
                <label class="form-label"> Nombre</label> {{$caja->nombre}}            
            </div>
        </div>
        <div  class="row" >
            <div class="col-6">
                <label class="form-label" for="">
                    Valor inicial                    
                </label>
                <td>{{$caja->valor_inicial}}</td>                    
            </div>            
            <div class="col-6">
                <label class="form-label" for="">
                    Descripcion
                </label>
                {{$caja->descripcion}}
            </div>
        </div>       
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <div class ="row" >
            <div class="col-3">
                <br>
                <a id="movimiento" class="btn btn-primary">Crear movimiento </a>
            </div>
            <div class="col-9">
                <form action="{{url('/cajas')}}/{{$caja->id}}">
                    <div class="row">
                        <div class="col-4">
                            <label class="form-label" for="">
                                Fecha inicial                    
                            </label>
                            <input type="date" class="form-control" name="fechaIni" id="">
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="">
                                Fecha fin                    
                            </label>
                            <input type="date" class="form-control" name="fechaFin" id="">
                        </div>
                        <div class="col-4">
                            <br>
                            <button class="btn btn-success" type="submit">
                                Buscar
                            </button>                
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Caja</th>
                            <th>Fecha hora</th>
                            <th>Concepto</th>
                            <th>Valor</th>                                     
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cajaMovimientos as $item)                        
                        <tr style="{{$item->ingreso==1?'color:green':'color:red'}}"  >
                            <td>{{$item->id}}</td>
                            <td>{{$item->caja}}</td>
                            <td>{{$item->fecha_hora}}</td>            
                            <td>{{$item->concepto}}</td>
                            <td>{{$item->valor}}</td>                                        
                        </tr>
                        @endforeach   
                    </tbody>
                </table>
            </div>            
        </div>
        <div class="row">
            <div class="col-4">
                <label class="form-label" for="">
                   Total ingresos
                </label>                
                {{$ingreso}}               
            </div>
            <div class="col-4">
                <label class="form-label" for="">
                   Total egresos
                </label>                
                {{$egreso}}               
            </div>
            <div class="col-4">
                <label class="form-label" for="">
                    Total en caja                
                </label>                 
                 {{$ingreso-$egreso}}
            </div>
        </div>
        <a class="btn btn-primary" href="{{url('/cajas')}}">
            Regresar
        </a> 
    </div>
</div>
@endsection
