<div id="accordion">
    @for ($i=0;$i<=count($dependencias)-1;$i++)
     <h3>
        <i class="fa-solid fa-id-card"></i>
         {{$dependencias[$i]->dependencia->nombre}}
    </h3>
    <div>
         <div class="row">
        @foreach ($dependencias[$i]->Mesas as $mesa)
            <div class="col-4">
                <div style="padding: 5px">
                    <a title="{{$mesa->ocupado==1?'La mesa esta ocupada':'La mesa esta libre'}}" class ="{{$mesa->ocupado==1?'btn btn-danger':'btn btn-primary'}}" href="{{url('/mesas')}}/{{$mesa->id}}">
                        <div class="row">
                            <div class="col-12" style="font-size:12px;font-weight: bold">
                                {{$mesa->nombre}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @if($mesa->imagen!=null)
                                <img src="{{url("/img/$mesa->imagen")}}" height="50"width="50">
                                @endif
                            </div>
                        </div>
                        <div style="font-size: 10px" >
                            <strong>Cap. max:</strong>  {{$mesa->capacidad_maxima}}
                        </div>
                        @if(auth()->user()->role_id==1||auth()->user()->role_id==2)
                        <div style="font-size: 8px" >
                            <strong>Venta:</strong> ${{number_format($mesa->venta_diaria)}}
                         </div>
                        @endif
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endfor
</div>
