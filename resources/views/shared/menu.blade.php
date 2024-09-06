
<div class="nav">    
    <div class="sb-sidenav-menu-heading">Aplicaciones</div>
    @if(auth()->user()->role_id==1||auth()->user()->role_id==2)
    <a class="nav-link" href="{{url('/existencias')}}">
        <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>

        Inventario
    </a>
    @endif
   <!--<a class="nav-link" href="{{url('/')}}">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Alquiler
    </a>-->
    <a class="nav-link" href="{{url('/ordenservicio')}}">
        <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard-list"></i></div>
        Orden de servicio
    </a>  
    <a class="nav-link" href="{{url('reporte')}}">impresoras </a>                          
    @if(auth()->user()->role_id==1||auth()->user()->role_id==2)
    <a class="nav-link" href="{{url('/cuentascobrar')}}">
        <div class="sb-nav-link-icon"><i class="fa-regular fa-credit-card"></i></div>
        Cartera
    </a>          
    <a class="nav-link" href="{{url('/pagos')}}">
        <div class="sb-nav-link-icon"><i class="fa-regular fa-money-bill-1"></i></div>
        Pagos
    </a>      
    <div class="sb-sidenav-menu-heading">Administracion del sistema</div>
    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon"><i class="fa-solid fa-gears"></i></div>
        Administracion
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">                                                                     
            <a class="nav-link" href="{{url('/formapagos')}}">Formas de pagos</a>
            <a class="nav-link" href="{{url('/configuracion')}}">Configuracion</a>                                    
            <a class="nav-link" href="{{url('/impresoras')}}">Impresoras</a>
            <a class="nav-link" href="{{url('/categorias')}}">Categorias</a>
            <a class="nav-link" href="{{url('/unidad_medida')}}">Unidades de medida</a>
            <a class="nav-link" href="{{url('/materiaprimas')}}">Materia primas</a>
        <!--    <a class="nav-link" href="{{url('/insumos')}}">Insumos</a>-->
            <a class="nav-link" href="{{url('/cajas')}}">Cajas</a>
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
    @endif
</div>
