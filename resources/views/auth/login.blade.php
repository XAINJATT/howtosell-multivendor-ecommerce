<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('public/storage/logo/logo.png')}}" type="img/png">
    <title>{{\App\Helpers\SiteHelper::settings()['AppName']}}</title>
    <meta name="description" content="{{\App\Helpers\SiteHelper::settings()['AppName']}}">
    <meta name="author" content="High App Solutions">

    <!-- Web Fonts
      ========================= -->
    <link rel='stylesheet' href='{{asset('public/assets_login/css/fonts.css')}}' type='text/css'>

    <!-- Stylesheet
      ========================= -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets_login/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets_login/css/all.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets_login/css/stylesheet.css')}}"/>
    <!-- Colors Css -->
    <link id="color-switcher" type="text/css" rel="stylesheet" href="#"/>

    <style rel="stylesheet" type="text/css">
        .color-custom-primary{
            color: {{\App\Helpers\SiteHelper::settings()['PrimaryColor']}} !important;
        }

        .bg-custom-primary{
            background-color: {{\App\Helpers\SiteHelper::settings()['PrimaryColor']}} !important;
        }

        .primaryColor{
          color: #ffc800 !important;
        }

        .btnPrimaryColor{
          background-color: #ffc800 !important;
          border-color: #ffc800 !important;
        }

        .oxyy-login-register .text-primary, .oxyy-login-register .btn-link {
          color: #ffc800 !important;
        }

        .oxyy-login-register .form-control:focus, .oxyy-login-register .custom-select:focus {
            -webkit-box-shadow: 0 0 5px rgb(255 255 255 / 50%);
            border-color: #ffc800 !important;
        }

        .oxyy-login-register .btn-link:hover {
            color: #ffc800 !important;
        }
    </style>
</head>
<body>

<div id="main-wrapper" class="oxyy-login-register h-100 d-flex flex-column bg-transparent">
    <div class="container my-auto">
        <div class="row no-gutters h-100">
            <div class="col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4 m-auto py-5">
                <div class="logo text-center mb-2">
                    <img src="{{ asset('public/storage/logo/logo.png')}}" alt="logo-small" class="img-fluid mb-3" style="height: 110px;width: 110px;">
                </div>
                <h5 class="text-muted font-weight-normal mb-4 text-center color-custom-primary primaryColor">Log in to your account</h5>
                <div class="row">
                    <div class="col-md-12">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
                <form id="loginForm" method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="vertical-input-group ">
                        <div class="input-group">
                            <div class="col-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" placeholder="Email" required
                                       autocomplete="off" autofocus/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group mt-2">
                            <div class="col-12">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       placeholder="Password" required autocomplete="off"/>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group remember_filed">
                            <label class="form-check-label color-custom-primary primaryColor" for="remember">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' :'' }}>
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary btn-block shadow-none my-4 bg-custom-primary btnPrimaryColor"
                                    type="submit"> {{ __('Login') }}</button>
                        </div>

                    </div>
                </form>
                <p class="text-center forget_button color-custom-primary">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link primaryColor" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white py-2">
        <p class="text-center text-2 text-muted mb-0">Copyright © {{date("Y")}} <a href="{{url('/')}}" style="color: black !important;">Rental Management System</a>
            <br>All Rights Reserved.
        </p>
    </div>
</div>

<!-- Script -->
<script src="{{asset('public/assets_login/js/jquery.min.js')}}"></script>
<script src="{{asset('public/assets_login/js/bootstrap.bundle.min.js')}}"></script>
<!-- Style Switcher -->
<script src="{{asset('public/assets_login/js/switcher.min.js')}}"></script>
<script src="{{asset('public/assets_login/js/theme.js')}}"></script>
</body>
</html>
