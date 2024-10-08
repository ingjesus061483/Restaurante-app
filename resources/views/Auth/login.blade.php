
@extends('shared/login')
@section('title','login')
@section('content')  
<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>                    
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{url('/login')}}"  autocomplete="off" method="post">
            @csrf        
            <div class="form-floating mb-3">
                <input class="form-control" name="email" id="inputEmail" 
                            type="email" placeholder="name@example.com" />
                <label for="inputEmail">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputPassword" name="password" 
                    type="password" placeholder="Password" />
                <label for="inputPassword">Password</label>
            </div>
            <div class="form-check mb-3">
               <!-- <input name ="remember" class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>-->
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">                
               <!-- <a class="small" href="{{url('/usuarios')}}/-1/edit">Forgot Password?</a>-->
                <button style="width: 100%" class="btn btn-primary" >Login</button>
            </div>
        </form>
    </div>
    <div class="card-footer text-center py-3">
        <!--<div class="small"><a href="register.html">Need an account? Sign up!</a></div>-->
    </div>
</div>
@endsection