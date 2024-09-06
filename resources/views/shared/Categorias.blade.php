<label class="form-label" for="codigo"> 
    Categorias
</label>   
<select class="form-select"onchange="categorias(this,'{{$page}}')" name="categoria" id="">
    <option value="">Seleccione categoria</option>    
    @foreach($categorias as $item )    
    <option value="{{$item->id}}"        
        @if($categoria_id==$item->id)                        
        {{'selected'}}        
        @endif        
        >{{$item->nombre}} 
    </option>    
    @endforeach
</select>