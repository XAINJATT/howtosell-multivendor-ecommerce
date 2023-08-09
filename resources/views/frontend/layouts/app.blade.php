{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extrorent</title>
    <!-- Faviicon -->
    <link rel="shortcut icon" href="{{ asset('public/frontend/asset/logo/faviicon.svg') }}" type="image/x-icon">
    <!-- Fontosome Style Sheet -->
    <link rel="stylesheet" href="{{ asset('public/frontend/asset/css/all.min.css') }}">
    <!-- Bootstarp 5 Style Sheet -->
    <link rel="stylesheet" href="{{ asset('public/frontend/asset/css/bootstrap.min.css') }}">
    <!-- Custom Style Sheet -->
    <link rel="stylesheet" href="{{ asset('public/frontend/asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/asset/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/asset/css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/asset/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/asset/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/asset/icons/fontawesome6/css/all.min.css') }}">

    <style>
        .vendor-carousel img {
          animation: pulse 2s infinite;
          transform: scale(1);
        }
        @keyframes pulse {
          0% {
            transform: scale(0.85);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
          }
  
          70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
          }
  
          100% {
            transform: scale(0.85);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
          }
        }
      </style>
</head> --}}

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>How To Sell? - Online Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />
    <link href="{{asset('favicon.ico')}}" rel="icon" />
    

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    {{-- <link href="lib/animate/animate.min.css" rel="stylesheet" /> --}}
    <!-- <link href="{{asset('public/frontend/asset/lib/animate/animate.min.css')}}" rel="stylesheet" /> -->
    {{-- <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" /> --}}
    <link href="{{asset('public/frontend/asset/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
   
    <link href="{{asset('public/frontend/asset/css/style.css')}}" rel="stylesheet" />
  
  </head>
<body>

    <!-- ****** Header Section Start Here ****** -->

    @include('frontend.inc.header')

    <!-- Header Section End Here -->

    {{-- front content here --}}

    @yield('front_content')
    {{-- front content end --}}

    <!-- Footer Code Start Here -->
    @include('frontend.inc.footer')
    <!-- Footer Code End Here -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"
><i class="fa fa-angle-double-up"></i
></a>

    <!-- *******  JavaScript Files   ******* -->

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('public/frontend/asset/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('public/frontend/asset/lib/owlcarousel/owl.carousel.min.js')}}"></script>

<!-- Contact Javascript File -->
<script src="{{asset('public/frontend/asset/mail/jqBootstrapValidation.min.js')}}"></script>
<script src="{{asset('public/frontend/asset/mail/contact.js')}}"></script>

<!-- Template Javascript -->
<script src="{{asset('public/frontend/asset/js/main.js')}}"></script>

    @stack('front_js')
    @include('frontend.includes.flash_messages')

</body>

</html>
