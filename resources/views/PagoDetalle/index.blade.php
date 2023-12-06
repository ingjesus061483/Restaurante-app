@extends('shared/layout')
@section('title','Totales de pago por formas de pagos')
@section('content')  
<div class="card mb-4">  
    <div class="card-header">
        <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label" for="codigo">
                        Forma de pago                
                    </label>                    
                    <select name="" class="form-select" id="forma-pago">
                        <option value="">seleccione una forma de pago </option>
                        @foreach($formaPagos as $item)
                            <option value="{{$item->id}}"{{isset($formaPago)?$item->id==$formaPago?'selected':'':'' }}>{{$item->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-9">
                <form action="{{url('/pagodetalle')}}">   
                    <input type="hidden" name="forma_pago"value="{{$formaPago!=null?$formaPago:''}}" >                       
                    <div class="row">
                        <div class="col-4" >
                            <label class="form-label" for="codigo">                        
                                Fecha inicio                                           
                            </label>                    
                            <input name="fechaIni" value="{{$fechaIni}}"  class="form-control" type="date"/>                                        
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="codigo">                        
                                Fecha fin                                           
                            </label>                                        
                            <input name="fechaFin" class="form-control" value="{{$fechaFin}}" type="date"/>
                        </div>
                        <div class="col-4">
                            <br>
                            <button type="submit" class="btn btn-primary"> Buscar</button>    
                        </div>
                    </div>                              
                </form>
            </div>
        </div>
        
    </div> 
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>             
                    <th>Forma  pago</th>                    
                    <th> Total valor recibido</th>                    
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Forma  pago</th>                                        
                    <th> Total valor recibido</th>
                </tr>        
            </tfoot>
            <tbody>
                @foreach($pagosdetalles as $item)
                <tr>               
                    <td>{{$item->forma_pago}}</td>                                     
                    <td>${{number_format($item->Total_valor_recibido)}}</td>                                
                </tr>
                @endforeach   
            </tbody>        
        </table>
    </div>
</div>
@endsection
