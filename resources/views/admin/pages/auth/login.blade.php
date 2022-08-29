<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>
    <base href="{{asset('')}}">
    @include('admin.includes.add-css')
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a>
                                <img src="admins/images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                        @endif
                        <div class="login-form">
                            <form action="{{route('admin.post.login')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" 
                                    value="{{old('email')}}"
                                    class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    </span>
                                @endif
                                
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <small class="text-danger">{{ $errors->first('password') }}</small>
                                    </span>
                                @endif
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('admin.includes.add-js')
</body>

</html>
<!-- end document-->