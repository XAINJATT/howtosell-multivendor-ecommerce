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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"/>

    <link href="{{asset('public/frontend/asset/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/frontend/asset/css/style.css')}}" rel="stylesheet" />
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
          const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 5000,
              timerProgressBar: true,
              didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
          });
      </script>
  </head>
<body>

    <!-- ****** Header Section Start Here ****** -->

    @include('frontend.inc.header', ['query' => $query ?? ''])

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

    <script>
        {{--function AddToCart(id) {--}}
        {{--    $.ajax({--}}
        {{--        type: "POST",--}}
        {{--        url: "{{ url('add-to-cart') }}",--}}
        {{--        data: {--}}
        {{--            '_token': "{{csrf_token()}}",--}}
        {{--            'id': id,--}}
        {{--        },--}}
        {{--        dataType: "json",--}}
        {{--        success: function (response) {--}}
        {{--            Toast.fire('success',response.msg,'success');--}}
        {{--            location.reload();--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}

        function favoriteProduct(id) {
            $.ajax({
                type: "POST",
                url: "{{ url('favorite-product') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,
                },
                dataType: "json",
                success: function (response) {
                    Toast.fire('success', response.msg, 'success');
                    location.reload();
                },
                error: function (xhr) {
                    if (xhr.status === 403) {
                        Toast.fire('error', xhr.responseJSON.msg, 'error');
                    }
                }
            });
        }

    </script>


    @include('frontend.includes.flash_messages')
</body>

</html>
