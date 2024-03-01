@extends('shared/layout')
@section('title','Listado de cuentas Cobrar')
@section('content')  
<div class="card mb-4">
    <div class="card-header">
        <form action="{{url('/cuentascobrar')}}" method="GET">
            <label class="form-label">
                Cliente
            </label>
            <div class="row">            
                <div class="col-10">                                        
                    <input type="text" name="cliente" class="form-control" >                    
                </div>                
                <div class="col-2">                                            
                    <button class="btn btn-primary"  type="submit">                        
                        Buscar                        
                    </button>                     
                </div>                        
            </div>
        </form>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Codigo orden</th>
                    <th>Tiempo</th>
                    <th>Monto interes</th>
                    <th>Tipo cobro</th>                    
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Codigo orden</th>
                    <th>Tiempo</th>
                    <th>Monto interes</th>
                    <th>Tipo cobro</th>                    
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($cuentasCobrar as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->fecha}}</td>            
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->tiempo}}</td>
                    <td>${{number_format($item->monto+$item->interes)}}</td>
                    <td>{{$item->tipo_cobro}}</td>
                    <td>
                        <a title="Ver detalles" class="btn btn-success" href="{{url('/cuentascobrar')}}/{{$item->id}}">
                            <i class="fa-solid fa-eye"></i>                        
                        </a>                                        
                    </td>
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
</div>
@endsection
