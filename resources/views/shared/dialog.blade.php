<div id="egreso" class="container">
    <input type="hidden" id="caja_id" value="{{isset($caja)?$caja->id:''}}">
    <div class="mb-3">
        <label class="form-label" for="unidad_medida">
            Concepto                
        </label>
        <input type="text" name="detallepago"  class="form-control"
        id="concepto">
    </div>                 
    <div class="mb-3">
        <label class="form-label" for="unidad_medida">
            Valor                 
        </label>
        <input type="text" name="valor"  class="form-control"
        id="valor">
    </div>            
</div>     
<div id="existencias" class="container">
    <div class="card mb-4">                
        <div class="card-body">
            <div class="card mb-4">
                <div class="card-header">
                    Datos de <span id="tipo_ex"></span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="codigo">
                                    Codigo
                                </label>
                                <span id="codigo_ex"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="codigo">
                                    Nombre
                                </label>
                                <span id="nombre_ex"></span>
                            </div>
                        </div>                                
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    Datos de inventario
                </div>
                <div class="card-body">        
                    <form action="">
                        <input type="hidden" name="materiaprima_id" id="materiaprima_id">
                        <div class="mb-3">
                            <label class="form-label" for="codigo">
                                Fecha
                            </label>
                            <input class="form-control" type="date" value="{{date('Y-m-d')}}" name="fecha" id="fecha_ex">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="codigo">
                                Cantidad
                            </label>
                            <input type="text" class="form-control" name="catidad" id="cantidad_ex">
                        </div>                
                    </form>
                </div>
            </div>
        </div>                   
</div>
<div id="ingredientes" class="container">
    <div class="card mb-4">                
        <div class="card-body">
            <div class="card mb-4">
                <div class="card-header">
                    Datos de producto
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label" for="codigo">
                                    Codigo
                                </label>
                                <span id="codigo"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label" for="codigo">
                                    Nombre
                                </label>
                                <span id="nombre"></span>
                            </div>
                        </div>                          
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    Datos de ingredientes
                </div>
                <div class="card-body">        
                    <form action="">         
                        <input type="hidden" id="ingrediente_id">                       
                        <input type="hidden" id="materia_prima_id">
                        <div class="mb-3">
                            <label class="form-label" for="codigo">
                                Materia prima
                            </label>
                            <input class="form-control" type="text"  name="ingrediente" 
                            id="ingrediente">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="cantidad">
                                Cantidad
                            </label>
                            <input type="text" class="form-control"value="1" name="cantidad" id="cantidad">
                        </div>                                   
                    </form>
                </div>
            </div>
        </div>                                   
</div>
<div id="DetalleOrden" class="container">
    <div class="card mb-4">                
        <div class="card-body">                    
            <form action="">         
                <input type="hidden" value="{{isset($orden_id)?$orden_id:0}}" id="orden_id">
                <input type="hidden" id="ordendetalle_id">                                               
                <input type="hidden" id="producto_id">                  
                <div class="row" >
                    <div class="col-7">
                        <div class="mb-3">
                            <label class="form-label" for="cantidad">
                                Cantidad
                            </label>
                            <input type="text" class="form-control" value="1" name="cantidad" id="cantidadDetalleOrden">
                        </div>                
                        <div class="mb-3">
                            <label class="form-label" for="codigo">
                                Detalle
                            </label>
                            <input class="form-control" type="text"  name="detalleOrden" 
                            id="detalleOrden">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="unidad_medida">
                                Valor unitario
                            </label>
                            <input class="form-control" type="text"  name="ValorUnitarioDetalleOrden" 
                            id="ValorUnitarioDetalleOrden">
                        </div>                                                       
                    </div>
                    <div class="col-5">
                        <img id="producto_img" src="" alt="" style="width:90%;heigth:100%">

                    </div>
                    
                </div>                             
                
            </form>
            
        </div> 
    </div>                                  
</div>
<div id="formasPagos" class="container">
    <div class="mb-3">
        <label class="form-label" for="categoria">
            Forma pago                
        </label>
        @if(isset($forma_pago))
        <select type="text" name="forma_pago" class="form-select"
         id="forma_pago">
         <option value="">seleccione una forma pago</option>
         @foreach($forma_pago as $item)
         <option value="{{$item->id}}">{{$item->nombre}}</option>
         @endforeach
        </select>            
        @endif  
    </div>
    <div class="mb-3">
        <label class="form-label" for="unidad_medida">
            Detalle pago                
        </label>
        <input type="text" name="detallepago"  class="form-control"
        id="detallepago">
    </div>                 
    <div class="mb-3">
        <label class="form-label" for="unidad_medida">
            Valor recibido                
        </label>
        <input type="text" name="valorRecibido"  class="form-control"
        id="valorRecibido">
    </div>            
</div>