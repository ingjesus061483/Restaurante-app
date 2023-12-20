var observacions=[];               
           var clientes=[];
           var opcion=''
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


           })
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
            $("#cliente").autocomplete({
                source:clientes
            })
            $("#observaciones").autocomplete({                
                source:observacions             
            });  
            if($("#foraneo")!=null&&$("#foraneo").checked)
            {
                $("#coccion").fadeOut();                
                $("#descripcion").fadeOut();
            }
            $("#foraneo").change( function(){
                //alert(this.checked);
                if(this.checked)
                {
                    $("#coccion").fadeOut();
                    $("#descripcion").fadeOut();
                }
                else{
                    $("#coccion").fadeIn();
                    $("#descripcion").fadeIn();
                }            
            });
            $("#forma-pago").change(function(){
                window.location.href="{{url('/pagodetalle')}}?forma_pago="+this.value; 
            })
            $("#forma_pago").change(function(){
               var detallepago=document.getElementById('detallepago');
               var valorRecibido=document.getElementById('valorRecibido');
               var total_pagar=document.getElementById('total_pagar').value;
               var faltante="{{isset($faltante)? $faltante:0}}"              
                if (this.value==1)
                {
                    detallepago.value="Pago de contado";
                    valorRecibido.value=total_pagar;                
                    return;
                }
                detallepago.value="";                
                valorRecibido.value=faltante; 
                detallepago.focus();                            
            })
            /*$("#cliente").change(function(event){
                var identificacion=this.value;
                if(identificacion.length>=7)
                {

                    mostrar(identificacion);
                }
             });*/ 
            $("#cantidadDetalleOrden").keyup(function(event){
                //console.log(event.which);
                if(event.which==13)
                {
                    GuardarDetalle();
                }

            });
            $("#movimiento").click(function(){
                dialogEgreso.dialog('open');
            })
            $("#detalle").click(function(){  
                var faltante="{{isset($faltante)? $faltante:0}}"
                if(faltante<=0)
                {
                    alertify.error('');
                    return;
                }
                dialogformasPagos.dialog("open");                
                
            })
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
                    "Cerrar": function() 
                    {
                        dialogexistencia.dialog( "close" );                    
                    }
                }
            });   
            function GuardarMovimiento()
            {
                total_caja="{{isset($ingreso)&&isset($egreso)?$ingreso-$egreso:0}}"
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
            function mostrar(id){
                console.log(id);
                $.ajax({
                    url:"{{url('/clientes/showClient')}}/"+id,
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
                                return ;
                            
                            }     
                            
                        }
                        alertify.success     (cliente.nombre+' '+cliente.apellido+"</br>"+cliente.direccion+"</br>"+cliente.telefono );
                        
                        
                    }
                });             
            }
            function GuardarformaPago()
            {
                var orden_id="{{isset( $ordenServicio)?$ordenServicio->id:0}}"
                var detallepago=document.getElementById('detallepago').value;
               var valorRecibido=document.getElementById('valorRecibido').value;
               var total_pagar=document.getElementById('total_pagar').value;
               var forma_pago=document.getElementById('forma_pago').value;
               if(detallepago=="")
               {
                alertify.error('');
                return; 
               }
               if(valorRecibido==""){
                alertify.error('');
                return ;

               }
               if(forma_pago=="")
               {
                alertify.error('');
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
                            },                        
                            success: function (result){                                                                                    
                                if(!result.encontrado)                            
                                {
                                    alertify.error(result.message);                                                            
                                }                               
                                else                                                            
                                {                                    
                                    alertify.success(result.message);                                
                                    window.location.href=result.orden_id==0?"{{url('/ordendetalles/')}}":"{{url('/ordenservicio/')}}/"+result.orden_id                                                    
                                }                       
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
                            },                        
                            success: function (result){                                                 
                                alertify.success(result.message);                                       
                                window.location.href=result.orden_id==0?"{{url('/ordendetalles/')}}":"{{url('/ordenservicio/')}}/"+result.orden_id                                                    
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
                        document.getElementById('orden_id').value=detalle.orden_id;         
                        document.getElementById('ordendetalle_id').value=detalle.detalle_id;
                        document.getElementById('cantidadDetalleOrden').value=detalle.cantidad;
                        document.getElementById('producto_id').value=detalle.producto_id;
                        document.getElementById('detalleOrden').value=detalle.detalleOrden;
                        document.getElementById('ValorUnitarioDetalleOrden').value=detalle.valor_unitario;
                        document.getElementById('producto_img').src=""
                        dialogDetalleOrden.dialog('open');
                        opcion="editar";
                    }                
                });

            }
            function ordenservicio(id){                
                $.ajax({
                    url:"{{url('/')}}/productos/BuscarProductos/"+id,          
                    type: "GET",               
                    dataType: "json",                
                    success: function (result){
                        var producto=result.producto;        
                        document.getElementById('producto_id').value=producto.id
                        document.getElementById('detalleOrden').value=producto.nombre
                        document.getElementById('ValorUnitarioDetalleOrden').value=producto.precio
                        document.getElementById('producto_img').src=""
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
                    var modulo=result.tipo=="materia_prima"?"materiaprimas":"productos";   
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
                success: function (result){
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
