

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
    <form id="login-form" class="form" action="{{route('post.password.new.frontend' )}}" method="post">
        @csrf
        <h3 class="text-center text-info">Password new</h3>
        <div class="form-group">
            <label for="username" class="text-info">password:</label><br>
            <input type="hidden" name="email" value="{{$email}}">
            <input type="hidden" name="hash" value="{{$hash}}">
            <input type="password" name="password" 
            class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
        </div>
        @if ($errors->has('password'))
            <span class="help-block">
                <small class="text-danger">{{ $errors->first('password') }}</small>
            </span>
        @endif

        <div class="form-group">
            <label for="username" class="text-info">Re password:</label><br>
            <input type="password" name="re_password" 
            class="form-control {{$errors->has('re_password') ? 'is-invalid' : ''}}">
        </div>
        @if ($errors->has('re_password'))
            <span class="help-block">
                <small class="text-danger">{{ $errors->first('re_password') }}</small>
            </span>
        @endif

        <div class="form-group ">
            <input type="submit" name="submit" class="btn btn-info btn-md w-100 mt-3" value="Submit">
        </div>
        <div id="register-link " class="text-right m-3">
            <a href="{{route('login.frontend')}}" class="text-info">Login</a>
        </div>
    </form>
    @endsection

