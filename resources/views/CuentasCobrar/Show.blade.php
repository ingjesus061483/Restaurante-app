@extends('shared/layout')
@section('title','Detalle cuentas cobrar')
@section('content')  
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-6" style="padding: 10px"><strong>Fecha:</strong></div>
                    <div class="col-6" style="padding: 10px">{{$cuentasCobrar->fecha}} </div>
                    <div class="col-6" style="padding: 10px"><strong>Monto interes:</strong> </div>
                    <div class="col-6" style="padding: 10px" >${{number_format( $cuentasCobrar->monto+$cuentasCobrar->interes)}} </div>
                    <div class="col-6" style="padding: 10px"><strong>Tiempo:</strong></div>
                    <div class="col-6" style="padding: 10px">{{$cuentasCobrar->tiempo}}</div>
                    <div class="col-6" style="padding: 10px"><strong>Tipo cobro:</strong></div>
                    <div class="col-6" style="padding: 10px">{{$cuentasCobrar->TipoCobro->nombre}} </div>
                    <div class="col-6" style="padding: 10px"><strong>Codigo orden:</strong> </div>
                    <div class="col-6" style="padding: 10px">{{$cuentasCobrar->OrdenEncabezado->codigo}}</div>                
                    <div class="col-6" style="padding: 10px"><strong>Cliente:</strong> </div>
                    <div class="col-6" style="padding: 10px">{{$cuentasCobrar->OrdenEncabezado->cliente->identificacion.' - '.$cuentasCobrar->OrdenEncabezado->cliente->nombre.' '.$cuentasCobrar->OrdenEncabezado->cliente->apellido}}</div>                
                    <div class="col-6" style="padding: 10px"><strong>Estado orden:</strong> </div>
                    <div class="col-6" style="padding: 10px">{{$cuentasCobrar->OrdenEncabezado->estado->nombre}}</div>               
                </div>
            </div>
            <div class="col-6">
                <div class="row">                    
                    <div class="col-12">                        
                        <table class="table">
                            <thead>
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Valor</th>                    
                            </thead>
                            <tbody>
                                @foreach( $detalleCuentasCobrar as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->fecha}}</td>
                                    <td>${{number_format( $item->valor)}}</td>
                                </tr>
                                @endforeach
                            </tbody>                
                        </table>
                    </div>
                </div>
                <div class="row">     
                    <div class="col-4" ></div>                    
                    <div class="col-8">
                        <div class="mb-3">
                            <strong>Total abonado:</strong>&nbsp;&nbsp;${{number_format($totalizar)}}
                        </div>                        
                        <div class="mb-3">
                            <strong>Total deuda:</strong>&nbsp;&nbsp;${{number_format($totaladeudado)}} 
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection
