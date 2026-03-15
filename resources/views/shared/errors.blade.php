@if($errors->any())
<div  id="errors" class="alert alert-danger" style="display:none">
    <ul>
        @foreach ($errors->all() as $error)
        <li style="list-style: none">{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
