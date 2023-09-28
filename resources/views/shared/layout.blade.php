<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>                
        <link rel="stylesheet" href="{{url('/')}}/jquery-ui-1.12.1.custom/jquery-ui.css">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{url('/')}}/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>        
    </head>
    <body class="sb-nav-fixed">
        <input type="hidden" name="base_url" id="base_url" value="{{url('/')}}">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{url('/')}}">{{auth()->user()->empresa->nombre}}</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
        <!--    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>-->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li> <a class="dropdown-item"  href="{{url('/usuarios')}}/{{auth()->user()->id}}/edit">Cambiar Contraseña </a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Aplicaciones</div>
                            <a class="nav-link" href="{{url('/existencias')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Inventario
                            </a>
                   <!--         <a class="nav-link" href="{{url('/')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Alquiler
                            </a>-->
                            <a class="nav-link" href="{{url('/ordenservicio')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Orden de servicio
                            </a>                            
                           <!-- <a class="nav-link" href="{{url('/facturacion')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Ventas
                            </a>        -->                   
                            <div class="sb-sidenav-menu-heading">Administracion del sistema</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Administrador
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url('/formapagos')}}">Formas de pagos</a>
                                    <a class="nav-link" href="{{url('/configuracion')}}">Configuracion</a>
                                    <a class="nav-link" href="{{url('/pagos')}}">Pagos</a>
                                    <a class="nav-link" href="{{url('/impresoras')}}">Impresoras</a>
                                    <a class="nav-link" href="{{url('/categorias')}}">Categorias</a>
                                    <a class="nav-link" href="{{url('/unidad_medida')}}">Unidades de medida</a>
                                    <a class="nav-link" href="{{url('/materiaprimas')}}">Materia primas</a>
                                    <a class="nav-link" href="{{url('/cabañas')}}">Cabañas</a>
                                    <a class="nav-link" href="{{url('/productos')}}">Productos</a>
                                    <a class="nav-link" href="{{url('/empleados')}}">Empleados</a>
                                    <a class="nav-link" href="{{url('/empresas')}}">Empresas</a>
                                    <a class="nav-link" href="{{url('/clientes')}}">Clientes</a>
                                    <a class="nav-link" href="{{url('/roles')}}">Roles</a>
                                    <a class="nav-link" href="{{url('/impuestos')}}">Impuestos</a> 
                                    <a class="nav-link" href="{{url('/observaciones')}}">Observaciones</a> 
                                </nav>
                            </div>                         
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logueado como:</div>
                        {{auth()->user()->name}}                        
                        <form action="{{url('/login')}}/{{auth()->user()->id }}"
                             onsubmit="validar('desea cerrar la sesion')" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"  >Cerrar sesion</button>

                        </form>
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">@yield('title')</h1>
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website {{date('Y')}}</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- dialog-->        
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
                                <img id="producto_img" src="" alt="">

                            </div>
                            
                        </div>                             
                        
                    </form>
                    
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
        <!-- fin dialog -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{url('/')}}/js/scripts.js"></script>        
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{url('/')}}/js/datatables-simple-demo.js"></script>
        <script src="{{url('/')}}/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
        <script src="{{ url('/')}}/alertifyjs/alertify.min.js"></script>        
        <link href="{{ url('/')}}/alertifyjs/css/alertify.min.css" rel="stylesheet">     
        <script src="{{url('/')}}/js/agendamiento.js">                       
        </script>  
        <script type="text/javascript">    
           var observacions=[];               
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



            })
            $("#cliente").change(function(event){
                var identificacion=this.value;
                if(identificacion.length>=7)
                {

                    mostrar(identificacion);
                }
             });
            $("#cantidadDetalleOrden").keyup(function(event){
                //console.log(event.which);
                if(event.which==13)
                {
                    GuardarDetalle();
                }

            });
            $("#detalle").click(function(){  
                var faltante={{isset($faltante)? $faltante:0}}              
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
                    $("#cliente").fadeIn();
                    $("#pnlcabaña").fadeOut();

                }
                else{
                    $("#cliente").fadeOut();
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
                var orden_id={{isset( $ordenServicio)?$ordenServicio->id:0}}
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
                var producto_id=document.getElementById('producto_id').value;
                var cantidad=document.getElementById('cantidadDetalleOrden').value;
                if(cantidad==""){
                    alertify.error("este campo no puede ser nulo");
                    return;
                }
                $.ajax({
                    url:"{{url('/ordendetalles')}}",
                    type: "POST",
                    dataType: "json",
                    data: {   
                        _token:"{{csrf_token()}}",     
                        producto_id:producto_id,
                        cantidad:cantidad,                    
                    },
                    success: function (result){
                        alertify.success(result.message);
                        if(result.encontrado)
                        {
                            window.location.href="{{url('/ordendetalles')}}";
                        }
                        
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
        </script>   
    </body>
</html>
