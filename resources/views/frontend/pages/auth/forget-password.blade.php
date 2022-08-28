

@extends('frontend.layouts.main-login')

@section('main-login')
    @if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @endif
    <form id="login-form" class="form" action="{{route('forget.password.post.frontend')}}" method="post">
        @csrf
        <h3 class="text-center text-info">Forgot password</h3>
        <div class="form-group">
            <label for="username" class="text-info">Email:</label><br>
            <input type="text" name="email" id="username"
            value="{{old('email', $dataForm != null ? $dataForm : null)}}"
            class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}">
        </div>
        @if ($errors->has('email'))
        <span class="help-block">
            <small class="text-danger">{{ $errors->first('email') }}</small>
        </span>
    @endif
        <div class="form-group ">
            <input type="submit" name="submit" class="btn btn-info btn-md w-100 mt-3" value="submit">
        </div>
        <div id="register-link " class="text-right m-3">
            <a href="{{route('login.frontend')}}" class="text-info">Login</a>
        </div>
    </form>
    @endsection

