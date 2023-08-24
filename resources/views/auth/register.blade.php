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
    <link href="{{asset('public/frontend/asset/css/style.css')}}" rel="stylesheet" />
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
    <div class="container-fluid bg-white py-2">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none logo">
                <span class="h1 text-uppercase text-primary bg-dark px-2" style="background-color: #3D464D !important">How to</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1" style="background-color: #FFD333 !important">Sell?</span>
                </a>
            </div>
            <div class="col-4"></div>
            <div class="col-4"></div>
        </div>
    </div>
    <div class="container my-auto">
        <div class="row no-gutters h-100">
            <div class="col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4 m-auto py-5">
                <div class="logo text-center mb-2">
                    <div class="logo text-center  mb-4">
                        <a href="" class="text-decoration-none logo">
                            <span class="h1 text-uppercase text-primary px-5" style="font-size: 5.0rem !important; color: #3D464D !important">Welcome</span>
                        </a>
                    </div>
                </div>
                <h5 class="text-muted font-weight-normal mb-4 text-center color-custom-primary primaryColor"  style="color: #3D464D !important">Register to your account</h5>
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
                <form id="registerForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="vertical-input-group ">
                        <div class="input-group">
                            <div class="col-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name" autofocus />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group mt-2">
                            <div class="col-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group mt-2">
                            <div class="col-12">
                                <select id="role" class="form-control @error('role') is-invalid @enderror select2" name="role" required>
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="VENDOR" {{ old('role') === 'VENDOR' ? 'selected' : '' }}>Vendor</option>
                                    <option value="USER" {{ old('role') === 'USER' ? 'selected' : '' }}>User</option>
                                </select>
                                @error('role')
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
                                       placeholder="Password" required autocomplete="new-password"/>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="input-group mt-2">
                            <div class="col-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                       placeholder="Confirm Password" required autocomplete="new-password" />
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary btn-block shadow-none my-4 bg-custom-primary btnPrimaryColor"
                                    type="submit"> {{ __('Register') }}</button>
                        </div>
                    </div>
                </form>
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
