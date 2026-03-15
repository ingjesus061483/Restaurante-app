@extends('shared/layout')
@section('title','Listado de cajas')
@section('content')
<div class="card mb-4">
    <div class="card-header">
       <i class="fa-solid fa-cash-register"></i>&nbsp; Caja
    </div>
    <div class="card-body">
        <div  class="row" >
            <div class="col-6">
                <label class="form-label" style="font-weight: bold" for="">Codigo: </label>
                {{$caja->codigo}}
            </div>
            <div class="col-6">
                <label class="form-label" style="font-weight: bold" for="">Nombre: </label>
                {{$caja->nombre}}
            </div>
        </div>
        <div  class="row" >
            <div class="col-6">
                <label class="form-label" style="font-weight: bold" for="">
                    Valor inicial
                </label>
                ${{number_format($caja->valor_inicial)}}
            </div>
            <div class="col-6">
                <label class="form-label" style="font-weight: bold" for="">
                    Descripcion
                </label>
                {{$caja->descripcion}}
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-filter"></i> &nbsp; Filtros
            </div>
            <div class="card-body">
                <div class ="row" >
                    <form action="{{url('/cajas')}}/{{$caja->id}}">
                        <div class="row">
                            <div class="col-6">
                            <label class="form-label" for="">
                                Fecha inicial
                            </label>
                            <input type="date" class="form-control" name="fechaIni" id="">
                            </div>
                            <div class="col-6">
                            <label class="form-label" for="">
                                Fecha fin
                            </label>
                            <input type="date" class="form-control" name="fechaFin" id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="padding-top: 10px" >
                                <button class="btn btn-success" title="Buscar" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="padding-bottom: 10px">
        <a id="movimiento" title="Crear movimiento" class="btn btn-primary">
            <i class="fa-solid fa-hand-holding-dollar"></i>
        </a>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Caja</th>
                            <th>Fecha hora</th>
                            <th>Concepto</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cajaMovimientos as $item)
                        <tr style="{{$item->ingreso==1?'color:green':'color:red'}}"  >
                            <td>{{$item->id}}</td>
                            <td>{{$item->caja}}</td>
                            <td>{{$item->fecha_hora}}</td>
                            <td>{{$item->concepto}}</td>
                            <td>${{number_format( $item->valor)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <label class="form-label" for="">
                   Total ingresos
                </label>
                ${{number_format($ingreso)}}
            </div>
            <div class="col-4">
                <label class="form-label" for="">
                   Total egresos
                </label>
                ${{number_format($egreso)}}
            </div>
            <div class="col-4">
                <label class="form-label" for="">
                    Total en caja
                </label>
                 ${{number_format($ingreso-$egreso)}}
            </div>
        </div>
    </div>

</div>
<div style="padding-bottom :10px;">
    <a title="Regresar" class="btn btn-primary" href="{{url('/cajas')}}">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
</div>
@endsection
