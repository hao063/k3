

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
    <form id="login-form" class="form" action="{{route('post.confirm.token.frontend' )}}" method="post">
        @csrf
        <h3 class="text-center text-info">Confirm email</h3>
        <div class="form-group">
            <label for="username" class="text-info">Token:</label><br>
            <input type="hidden" name="email" value="{{$email}}">
            <input type="hidden" name="hash" value="{{$hash}}">
            <input type="number" name="token" id="username" 
            maxlength="6"
            value="{{old('token')}}"
            class="form-control text-center {{$errors->has('token') ? 'is-invalid' : ''}}">
        </div>
        @if ($errors->has('token'))
            <span class="help-block">
                <small class="text-danger">{{ $errors->first('token') }}</small>
            </span>
        @endif
        <div class="form-group ">
            <input type="submit" name="submit" class="btn btn-info btn-md w-100 mt-3" value="Submit">
        </div>
        <div id="register-link " class="text-right m-3">
            <a href="{{route('forget.password.frontend', ['email' => $email])}}" class="text-info m-3">Token not received?</a>
            <a href="{{route('login.frontend')}}" class="text-info">Login</a>
        </div>
    </form>
    @endsection

