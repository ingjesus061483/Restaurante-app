<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
        <title>@yield('title')</title>   
        <link rel="shortcut icon" type="image/x-icon" href="{{url('/restaurante-app.ico')}}" />             
        <link rel="stylesheet" href="{{url('/jquery-ui-1.12.1.custom/jquery-ui.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{url('/css/styles.css')}}" rel="stylesheet" />
        <script src="{{url('/js/fontawesome.js')}}"></script>
        <!--<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>  -->      
    </head>
    <body class="sb-nav-fixed">
        <input type="hidden" name="base_url" id="base_url" value="{{url('/')}}">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{url('/')}}">{{auth()->user()->empresa->nombre}}</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!--<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>-->
            <!-- Navbar-->    
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
          
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}&nbsp;<i class="fas fa-user fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @if(auth()->user()->role_id==1||auth()->user()->role_id==2)
                        <li><a class="dropdown-item" href="{{url('/configuracion')}}">Configuracion</a> </li>
                        <li><a class="dropdown-item" href="#!">Registro de actividad</a></li> 
                        <li><hr class="dropdown-divider" /></li> 
                        @endif                                 
                        <li> <a class="dropdown-item"  href="{{url('/usuarios')}}/{{auth()->user()->id}}/edit">Cambiar Contraseña </a></li>
                        <li>
                          <form class="d-none d-md-inline-block form-inline" action="{{url('/login')}}/{{auth()->user()->id }}"                                    
                                    onsubmit="return validar('Desea cerrar la sesion?')" method="post">
                                @csrf
                                @method('delete')
                                <button title="Cerrar sesion" type="submit" class="btn">
                                  Cerrar sesion  <i class="fa-solid fa-right-from-bracket"></i>                                
                                </button>
                            </form>    
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        @include('shared/menu')
                    </div>
                    <div class="sb-sidenav-footer">                        
                      
                    </div>                
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">@yield('title')</h1>
                        @include('shared/errors')    
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy;  {{auth()->user()->empresa->nombre.' '.date('Y')}}</div>
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
        @include('shared/dialog')
        <!-- fin dialog -->
        <!-- script -->
        @include('shared/script')
        <!-- fin script-->
    </body>
</html>
