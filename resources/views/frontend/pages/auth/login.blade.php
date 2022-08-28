
@extends('frontend.layouts.main-login')

@section('main-login')
    @if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif


    <form id="login-form" class="form" action="{{route('login.post.frontend')}}" method="post">
        @csrf
        <h3 class="text-center text-info">Login</h3>
        <div class="form-group">
            <label for="username" class="text-info">Email:</label><br>
            <input type="text" name="email" id="username"
            value="{{old('email')}}"
            class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}">
        </div>
        @if ($errors->has('email'))
        <span class="help-block">
            <small class="text-danger">{{ $errors->first('email') }}</small>
        </span>
    @endif
        <div class="form-group">
            <label for="password" class="text-info">Password:</label><br>
            <input type="password" name="password" id="password" 
            class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
            @if ($errors->has('password'))
                <span class="help-block">
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember" type="checkbox"></span></label><br>
            <input type="submit" name="submit" class="btn btn-info btn-md w-100 mt-3" value="submit">
        </div>
        <div id="register-link" class="text-right">
            <a href="{{route('forget.password.frontend')}}" class="text-info">Forgot password</a>
        </div>
    </form>
                       
    @endsection
