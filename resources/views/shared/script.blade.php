<script src="{{url('js/Boostrap.js')}}" crossorigin="anonymous"></script>
<script src="{{url('js/datatable.js')}}" crossorigin="anonymous"></script>
<script src="{{url('js/jquery.js')}}" crossorigin="anonymous"></script>
<!--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>    -->
<script src="{{url('/')}}/js/scripts.js"></script>        
<script src="{{url('/')}}/js/datatables-simple-demo.js"></script>
<script src="{{url('/')}}/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<script src="{{ url('/')}}/alertifyjs/alertify.min.js"></script>        
<link href="{{ url('/')}}/alertifyjs/css/alertify.min.css" rel="stylesheet">     
<script src="{{url('/')}}/js/restaurante-app.js"></script>
<script  type="text/javascript">         
    console.log($("#errors"))  
    const myTimeout = setTimeout(myGreeting, 5000);
   $(function(){
        $( document ).tooltip();
   });
   /*$(".slider").bxSlider({
    minSlides: 3,
    maxSlides: 3,            
    slideWidth: 360,            
    slideMargin: 5,            
    ticker: true,
    speed: 60000
   });*/
  var slider= $(".slider").bxSlider({
    slideWidth: 1000, 
    mode: 'fade',           
    slideMargin: 10, 
   });
   var producto=null;
   var observacions=[];               
   var clientes=[];
   var opcion='';
   $.ajax({
        url:"{{url('/clientes/GetClientes/1')}}",
        type: "GET",
        dataType: "json",
        success: function (result) 
        {
            var clients=result.clientes;
            var cont=0;
            for(i=0;i<=clients.length-1;i++)
            {
                clientes[cont]=clients[i].cliente;
            }
        }
   });
   $.ajax({
        url: "{{url('/observaciones/GetObservacions/null')}}",
        type: "GET",
        dataType: "json",
        success: function (result) 
        {
            var observaciones=result.observaciones
            var cont=0;
            for(i=0;i<=observaciones.length-1;i++)
            {
                observacions[cont]=observaciones[i].descripcion
                cont++;
            }
        }            
    });     
    var dialogformasPagos=$("#formasPagos").dialog({
        autoOpen: false,
        height:450,
        width: 600,
        modal: true,
        buttons: 
        {
            "Guardar": function(){GuardarformaPago()},
            "Cerrar": function() 
            {
                dialogformasPagos.dialog( "close" );                    
            }
        }
    });   
    var dialogCambioDeMesa=$("#CambioDeMesa").dialog({
        autoOpen: false,
        height:450,
        width: 600,
        modal: true,
        buttons: 
        {
            "Guardar": function(){Trasladar()},
            "Cerrar": function() 
            {
                dialogCambioDeMesa.dialog( "close" );                    
            }
        }
    });   

    var dialogEgreso=$("#egreso").dialog({
        autoOpen: false,
        height:450,
        width: 600,
        modal: true,
        buttons: 
        {
            "Guardar": function(){GuardarMovimiento()},
            "Cerrar": function() 
            {
                dialogformasPagos.dialog( "close" );                    
            }
        }
    });   
    var dialogDetalleOrden=$("#DetalleOrden").dialog({
        autoOpen: false,
        height:450,
        width: 600,
        modal: true,
        buttons: 
        {
            "Guardar": function(){GuardarDetalle()},
            "Cerrar": function() 
            {
                opcion='';
                dialogDetalleOrden.dialog( "close" );                    
            }
        }
    });              
    var dialogingrediente=$("#ingredientes").dialog({
        autoOpen: false,
        height:520,
        width: 500,
        modal: true,
        buttons: 
        {
            "Guardar": function(){GuardarIngrediente()},
            "Cerrar": function() 
            {
                dialogingrediente.dialog( "close" );                    
            }
        }
    });   
    var dialogexistencia=$("#existencias").dialog({
        autoOpen: false,
        height:520,
        width: 500,
        modal: true,
        buttons: 
        {
            "Guardar": function(){GuardarExistencia();},
            "Cerrar": function() {dialogexistencia.dialog( "close" );}
        }
    });    
    $("#venta_costo").change(function(){
        if($("#venta_costo").prop('checked')){
            document.getElementById('ValorUnitarioDetalleOrden').value=producto.costo_unitario.toLocaleString();                  
        }
        else
        {
            document.getElementById('ValorUnitarioDetalleOrden').value=producto.precio.toLocaleString();                    
        }
    });
 $("#ordenServicio").click(function(){
    console.log (slider);
    var current=slider.getCurrentSlideElement();
    var mesa = current[0].children[0].children[0].innerText;
    window.location.href="{{url('/cabañas')}}/"+mesa;
    console.log (current[0].children[0].children[0].innerText/*.find("#mesa-id")*/);
 })
    $("#cliente").autocomplete({
        source:clientes
    });
    $("#observaciones").autocomplete({                
        source:observacions             
    });  
    if($("#procesado")!=null)
    {
        if($("#procesado").prop('checked'))
        {
            if( $("#inventario")!=null)
            {
                $("#inventario").fadeOut();                    
            }
            $("#coccion").fadeIn();                      
            $("#preparacion").fadeIn();
        }
        else
        {
            if( $("#inventario")!=null)
            {
                $("#inventario").fadeIn();                    
            }                    
            $("#coccion").fadeOut();                      
            $("#preparacion").fadeOut();
        }

    }
    $("#procesado").change( function(){
        //alert(this.checked);

        if(this.checked)
        {
            if( $("#inventario")!=null)
            {
                $("#inventario").fadeOut();
            }
            $("#coccion").fadeIn();
            $("#preparacion").fadeIn();
        }
        else
        {
            if( $("#inventario")!=null)
            {
                $("#inventario").fadeIn();
            }
            $("#coccion").fadeOut();
            $("#preparacion").fadeOut();
        }            
    });
    $("#forma-pago").change(function(){
        window.location.href="{{url('/pagodetalle')}}?forma_pago="+this.value; 
    });
    $("#forma_pago").change(function(){
       var detallepago=document.getElementById('detallepago');
       var valorRecibido=document.getElementById('valorRecibido');
       var total_pagar=document.getElementById('total_pagar').value;
       var faltante={{isset($faltante)? $faltante:0}}              
        if (this.value==1)
        {
            detallepago.value="Pago de contado";
            valorRecibido.value=total_pagar;                
            return;
        }
        detallepago.value="";                
        valorRecibido.value=faltante; 
        detallepago.focus();                            
    });
    $("#cantidadDetalleOrden").keyup(function(event){
        //console.log(event.which);
        if(event.which==13)
        {
            GuardarDetalle();
        }

    });
    $("#movimiento").click(function(){
        dialogEgreso.dialog('open');
    });
    $("#detalle").click(function(){  
        var faltante={{isset($faltante)? $faltante:0}}              
        if(faltante<=0)
        {
            alertify.error('');
            return;
        }
        dialogformasPagos.dialog("open");                
    });        
    $("#chkcliente").change( function(){
        //alert(this.checked);
        if(this.checked)
        {
            $("#pnlcliente").fadeIn();
            $("#pnlcabaña").fadeOut();
        }
        else{
            $("#pnlcliente").fadeOut();
            $("#pnlcabaña").fadeIn();

        }            
    });   
    function CambiarMesa(mesa ,ordenId)
    {               
        document.getElementById("source").innerHTML=mesa;
        document.getElementById("ordenId").value=ordenId;             
        dialogCambioDeMesa.dialog('open');
    }
    function Trasladar()
    {
      var ordenId=  document.getElementById("ordenId").value;   
      arr=document.getElementById("source").innerHTML.split('-');     
      source=arr[0].trim();
     moveTo= document.getElementById("moveTo").value;             
     if(moveTo==0)
     {
        alertify.error('Escoje una cabaña');
     }
     $.ajax({
            url:"{{url('/ordenservicio/MoveTableByOrder')}}/"+ordenId,
            type: "POST",
            dataType: "json",
            data:{   
                _token:"{{csrf_token()}}",    
                _method: 'PATCH',   
                ordenId:ordenId,
                source:source,
                moveTo:moveTo,                        
            },
            success: function (result){                        
                    alertify.success(result.message);   
                console.log(result.cabana)
                var url="{{url('/ordenservicio')}}"
                window.location.href=url
            }
        });             



    }
    function categorias(categoria,page){        
        window.location.href="{{url('/')}}/"+page +"?categoria="+categoria.value; 
    }           
    function mostrarEliminar(id){
        alert(id);
        CancelarOrden.dialog('open');            
    }
    function GuardarMovimiento()
    {
        total_caja={{isset($ingreso)&&isset($egreso)?$ingreso-$egreso:0}} 
        var ingreso=0;
        valor_inicial="{{isset($caja)?$caja->valor_inicial:'0'}}";
        var caja_id=document.getElementById("caja_id").value;
        var concepto=document.getElementById( "concepto").value;
        var valor= document.getElementById("valor").value;
        if(concepto=='')
        {
            alertify.error('');
            return;
        }
        if(valor=='')
        {
            alertify.error('');
            return;                
        }                
        $.ajax({
            url:"{{url('/movimientocaja')}}",
            type: "POST",
            dataType: "json",
            data:{   
                _token:"{{csrf_token()}}",     
                total_caja:total_caja,
                caja_id:caja_id,
                concepto:concepto,
                valor:valor,
                ingreso:ingreso
            },
            success: function (result){
                if(result.error){
                    alertify.error(result.message);   
                }
                else
                {
                    alertify.success(result.message);   
                }
                var url="{{url('/cajas')}}/"+caja_id
                window.location.href=url
            }
        });             
    }

    function mostrar_Cliente(identificacion){
        console.log(identificacion);
        $.ajax({
            url:"{{url('/clientes/showClient')}}/"+identificacion,
            type: "get",
            dataType: "json",                    
            success: function (result){
                var cliente =result.cliente;
                if(cliente ==null)
                {
                    if(confirm("Guardar cliente?"))                            
                    {
                        window.location.href="{{url('/clientes/create')}}";                                
                        return;  
                    }
                    else                            
                    {
                        return;                            
                    }                    
                }
                alertify.success("<strong>Nombre completo: </strong>"+cliente.nombre+' '+cliente.apellido+"</br>"+"<strong>Direccion: </strong>"+cliente.direccion+"</br>"+"<strong>Telefono: </strong>"+cliente.telefono );                                                
            }
        });             
    }
    function GuardarformaPago()
    {
        var orden_id={{isset( $ordenServicio)?$ordenServicio->id:0}}
        var detallepago=document.getElementById('detallepago').value;
       var valorRecibido=document.getElementById('valorRecibido').value;
       var total_pagar=document.getElementById('total_pagar').value;
       var forma_pago=document.getElementById('forma_pago').value;
       if(detallepago=="")
       {
           alertify.error('Detalle de pago no valido');
           return; 
       }
       if(valorRecibido=="")
       {
          alertify.error('Valor recibido no valido');
          return;

       }
       if(forma_pago=="")
       {
            alertify.error('Formade pago no valida');
             return ;
       }
       $.ajax({
            url:"{{url('/pagodetalle')}}",
            type: "POST",
            dataType: "json",
            data: {   
                _token:"{{csrf_token()}}",     
                detallepago:detallepago,
                valorRecibido:valorRecibido,
                totalpagar:total_pagar,
                forma_pago:forma_pago            
            },
            success: function (result){
                if(result.error){
                    alertify.error(result.message);   
                }
                else
                {
                    alertify.success(result.message);   
                }
                var url="{{url('/')}}/pagos/create?id="+orden_id
                window.location.href=url
            }
        });             
    }
    function GuardarDetalle(){                
         var detalle_id= document.getElementById('ordendetalle_id').value;
        var orden_id=document.getElementById('orden_id').value;
        var producto_id=document.getElementById('producto_id').value;
        var cantidad=document.getElementById('cantidadDetalleOrden').value;
        var observaciones=document.getElementById('observaciones') .value;      
        var  venta_costo=$("#venta_costo").prop('checked');          
        if(cantidad==""){
            alertify.error("este campo no puede ser nulo");
            return;
        }
        switch (opcion)
        {             
            case 'guardar' :
            {
                $.ajax({                        
                    url:"{{url('/ordendetalles/')}}",                        
                    type: "POST",                        
                    dataType: "json",                        
                    data: {                               
                        _token:"{{csrf_token()}}",                                 
                        orden_id:orden_id,                            
                        producto_id:producto_id,                            
                        cantidad:cantidad,
                        venta_costo:venta_costo,                              
                        observaciones:observaciones
                    },                        
                    success: function (result){                                                                                    
                        if(!result.encontrado)                            
                        {
                            alertify.error(result.message);                                                            
                        }                               
                        else                                                            
                        {                                    
                            alertify.success(result.message);                                
                            window.location.href=result.orden_id==0?"{{url('/ordendetalles/create/')}}":"{{url('/ordendetalles')}}?id="+result.orden_id //"{{url('/reportes/printComandaSesion/')}}/"+result.orden_id                                                    
                        }                       
                    },
                    error : function(xhr, status) 
                    {        
                        console.log(xhr.responseJSON);
                        alertify.error(xhr.responseJSON.message);                            
                    }          
                });  
                break;
            }
            case 'editar':
            {
                $.ajax({                        
                    url:"{{url('/ordendetalles')}}/"+detalle_id,                        
                    type: "POST",                        
                    dataType: "json",                        
                    data: {                               
                        _token:"{{csrf_token()}}",                                 
                        _method: 'PATCH',  
                        orden_id:orden_id,                         
                        producto_id:producto_id,                            
                        cantidad:cantidad,  
                        venta_costo:venta_costo,                              
                        observaciones:observaciones                            
                    },                        
                    success: function (result){                                                 
                        alertify.success(result.message);                                       
                        window.location.href=result.orden_id==0?"{{url('ordenservicio/create')}}":"{{url('/ordenservicio/')}}/"+result.orden_id                                                    
                    }                    
                });  
            }
        }
    }
    function EditarDetalleOrden(id)
    {                
        $.ajax({
            url:"{{url('/ordendetalles')}}/"+id,          
            type: "GET",               
            dataType: "json",                
            success: function (result){
                var detalle=result.detalle;     
                producto=result.producto              
                document.getElementById('orden_id').value=detalle.orden_id;                       
                document.getElementById('ordendetalle_id').value=detalle.detalle_id;
                document.getElementById('cantidadDetalleOrden').value=detalle.cantidad;
                document.getElementById('producto_id').value=detalle.producto_id;
                document.getElementById('detalleOrden').value=detalle.detalleOrden;
                document.getElementById('observaciones').value=detalle.observaciones;
                document.getElementById('ValorUnitarioDetalleOrden').value=detalle.valor_unitario;
                document.getElementById('producto_img').src="{{url('/')}}/img/"+detalle.imagen;
                $("#venta_costo").prop('checked',detalle.venta_costo);
                dialogDetalleOrden.dialog('open');
                opcion="editar";
            }                
        });

    }
    function ordenservicio(id)
    {                
        $.ajax({
            url:"{{url('/')}}/productos/BuscarProductos/"+id,          
            type: "GET",               
            dataType: "json",                
            success: function (result){
                producto=result.producto;        
                document.getElementById('producto_id').value=producto.id;
                document.getElementById('detalleOrden').value=producto.nombre;
                document.getElementById('ValorUnitarioDetalleOrden').value=producto.precio.toLocaleString();
                document.getElementById('producto_img').src="{{url('/')}}/img/"+producto.imagen;
                dialogDetalleOrden.dialog('open');
                opcion='guardar';
            }                
        });
    }
    function existencias (button,tipo){
        var tr=button.parentElement.parentElement;
        var tdcolection=tr.children;
        var id=tdcolection[0].innerHTML;
        var codigo= tdcolection[1].innerHTML;
        var nombre= tdcolection[2].innerHTML;              
        $("#materiaprima_id").val(id);
        document.getElementById('tipo_ex').innerHTML=tipo
        document.getElementById('codigo_ex').innerHTML=codigo;
        document.getElementById('nombre_ex').innerHTML=nombre;
        console.log(tdcolection);            
        dialogexistencia.dialog("open");
    }
    function editar_ingredientes(ingrediente){
        var producto_id=document.getElementById('producto_id').value;
        $.ajax({
            url:"{{url('/')}}/productos/BuscarProductos/"+producto_id,
            type: "GET",
            dataType: "json",
            success: function (result){
                var producto=result.producto;
                var tr=ingrediente.parentElement.parentElement;
                var tdcolection=tr.children;
                console.log(tdcolection);
                document.getElementById("codigo").innerHTML=producto.codigo;
                document.getElementById("nombre").innerHTML=producto.nombre;                        
                document.getElementById("ingrediente_id").value=tdcolection[0].innerHTML;
                document.getElementById("ingrediente").value=tdcolection[1].innerHTML;
                document.getElementById("cantidad").value=tdcolection[2].innerHTML;
                dialogingrediente.dialog("open");
                //window.location.href="{{url('/')}}//"+result.materiaprima.id;
            }
        }); 
    }
    function GuardarIngrediente()
    {
        var ingrediente_id= document.getElementById("ingrediente_id").value;
        var producto_id=document.getElementById('producto_id').value;
        var materiaprima= document.getElementById('ingrediente').value;
        var cantidad=document.getElementById('cantidad').value;
       var materia_prima_id= document.getElementById('materia_prima_id').value
        if(materiaprima=="")
        {
            alertify.error('este campo no puede ser vacio');
            return;
        }
        if(cantidad=="")
        {
            alertify.error('este campo no puede ser vacio');
            return;                    
        }
        if(ingrediente_id=="")
        {
            $.ajax({
            url:"{{url('/ingredientes')}}",
            type: "POST",
            dataType: "json",
            data: {   
                _token:"{{csrf_token()}}",     
                materiaprima:materiaprima,                    
                materia_prima_id:materia_prima_id,
                producto_id:producto_id,
                cantidad:cantidad                
            },
            success: function (result){
                alertify.success(result.message);
                window.location.href="{{url('/')}}/productos/"+producto_id;
            }
        });             
    }
    else{
        $.ajax({
            url:"{{url('/ingredientes')}}/"+ingrediente_id,
            type: "POST",
            dataType: "json",
            data: {   
                _token:"{{csrf_token()}}",     
                _method:"patch",
                materiaprima:materiaprima,                    
                producto_id:producto_id,
                cantidad:cantidad                       
            },
            success: function (result){
                alertify.success(result.message);
                window.location.href="{{url('/')}}/productos/"+producto_id;
            }
        });             

    }

}

function GuardarExistencia()        
{       
    var tipo=document.getElementById('tipo_ex').innerHTML
    var materiaprima_id=document.getElementById('materiaprima_id').value;            
    var fecha=document.getElementById('fecha_ex').value;            
    var cantidad=document.getElementById('cantidad_ex').value;            
    if(fecha=="")            
    {            
        alertify.error("El campo fecha es requerido");            
        return;            
    }            
    if(cantidad=="")            
    {            
        alertify.error("El campo cantidad es requerido");            
        return;            
    }            
    $.ajax({
    
        url:"{{url('/')}}/existencias",                
        type: "POST",                
        dataType: "json",                
        data: {   
            _token:"{{csrf_token()}}",                         
            materiaprima_id:materiaprima_id,                                        
            fecha:fecha,                    
            tipo:tipo,
            esEntrada:1,
            cantidad:cantidad,                    
        },               
        success: function (result){                        
            alertify.success(result.mensaje);          
            var modulo=result.tipo=="materia_prima"?"materiaprimas":result.tipo=="insumo"?"insumos":"productos";   
            window.location.href="{{url('/')}}/"+modulo+"/"+result.id;                    
        }
    }); 
}        
function InsertarIgredientes(button){                        
    var producto_id =document.getElementById('producto_id').value;            
    $.ajax({
        url:"{{url('/')}}/productos/BuscarProductos/"+producto_id,          
        type: "GET",               
        dataType: "json",                
        success: function (result)
        {
            var producto=result.producto;
            var tr=button.parentElement.parentElement;                        
            var tdcolection=tr.children;                        
            var id=tdcolection[0].innerHTML;                                            
            var codigo= tdcolection[1].innerHTML;                                       
            var nombre= tdcolection[2].innerHTML;                                  
            document.getElementById("materia_prima_id").value=id;                    
            document.getElementById("ingrediente").value=codigo+' - '+nombre;                    
            document.getElementById("codigo").innerHTML=producto.codigo;                    
            document.getElementById("nombre").innerHTML=producto.nombre;                    
            dialogingrediente.dialog("open");                    
            //window.location.href="{{url('/')}}//"+result.materiaprima.id;
        }
    });
}
function myGreeting() 
{
    $("#errors").fadeOut();
}
</script>   
