<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/pdf.ico')}}" />

  <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <!--<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>-->
</head>
<body class="sb-nav-fixed">
    <header>
        <div class="row">
            <div class=" col-3">
                @if(auth()->user()->empresa->logo!=null)
                <img class="img-thumbnail" src="{{url('/img/'.auth()->user()->empresa->logo)}}"/>
                @endif
            </div>
            <div class="col-9">
                <h1 style="text-align: center">{{auth()->user()->empresa->nombre}}</h1>
                <h6 style="text-align: center">{{auth()->user()->empresa->nit}}</h6>
                <h6 style="text-align: center">{{auth()->user()->empresa->direccion}}</h6>
                <h6 style="text-align: center">{{auth()->user()->empresa->telefono}}</h6>
            </div>
        </div>
    </header>
    <hr>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                @yield('content')
            </div>
        </main>

    </div>
    <hr>
    <footer>
        @if(auth()->user()->empresa->slogan!=null)
        <h6 style="text-align: center">{{auth()->user()->empresa->slogan}}</h6>
        @endif
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{url('/')}}/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{url('/')}}/js/datatables-simple-demo.js"></script>
</body>
</html>
