 @extends('frontend.layouts.app')

 @section('front_content')
     <!-- Vendor Start -->
 <!-- Carousel Start -->
 <div class="container-fluid mb-3">
    <div class="row px-xl-5">
      <div class="col-lg-8">
        <div
          id="header-carousel"
          class="carousel slide carousel-fade mb-30 mb-lg-0"
          data-ride="carousel"
        >
          <ol class="carousel-indicators">
            <li
              data-target="#header-carousel"
              data-slide-to="0"
              class="active"
            ></li>
            <li data-target="#header-carousel" data-slide-to="1"></li>
            <li data-target="#header-carousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div
              class="carousel-item position-relative active"
              style="height: 430px"
            >
              <img
                class="position-absolute w-100 h-100"
                src="{{asset('public/frontend/asset/img/carousel-1.jpg')}}"
                style="object-fit: cover"
              />
              <div
                class="carousel-caption d-flex flex-column align-items-center justify-content-center"
              >
                <div class="p-3" style="max-width: 700px">
                  <h1
                    class="display-4 text-white mb-3 animate__animated animate__fadeInDown"
                  >
                    Men Fashion
                  </h1>
                  <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                    Lorem rebum magna amet lorem magna erat diam stet. Sadips
                    duo stet amet amet ndiam elitr ipsum diam
                  </p>
                  <a
                    class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                    href="{{route('products')}}"
                    >Shop Now</a
                  >
                </div>
              </div>
            </div>
            <div
              class="carousel-item position-relative"
              style="height: 430px"
            >
              <img
                class="position-absolute w-100 h-100"
                src="{{asset('public/frontend/asset/img/carousel-2.jpg')}}"
                style="object-fit: cover"
              />
              <div
                class="carousel-caption d-flex flex-column align-items-center justify-content-center"
              >
                <div class="p-3" style="max-width: 700px">
                  <h1
                    class="display-4 text-white mb-3 animate__animated animate__fadeInDown"
                  >
                    Women Fashion
                  </h1>
                  <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                    Lorem rebum magna amet lorem magna erat diam stet. Sadips
                    duo stet amet amet ndiam elitr ipsum diam
                  </p>
                  <a
                    class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                    href="{{route('products')}}"
                    >Shop Now</a
                  >
                </div>
              </div>
            </div>
            <div
              class="carousel-item position-relative"
              style="height: 430px"
            >
              <img
                class="position-absolute w-100 h-100"
                src="{{asset('public/frontend/asset/img/carousel-3.jpg')}}"
                style="object-fit: cover"
              />
              <div
                class="carousel-caption d-flex flex-column align-items-center justify-content-center"
              >
                <div class="p-3" style="max-width: 700px">
                  <h1
                    class="display-4 text-white mb-3 animate__animated animate__fadeInDown"
                  >
                    Kids Fashion
                  </h1>
                  <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                    Lorem rebum magna amet lorem magna erat diam stet. Sadips
                    duo stet amet amet ndiam elitr ipsum diam
                  </p>
                  <a
                    class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                    href="{{route('products')}}"
                    >Shop Now</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="product-offer mb-30" style="height: 200px">
          <img
            class="img-fluid"
            src="{{asset('public/frontend/asset/img/joyful-teenage-girl-with-dollars-her-hands-pointed-them-isolated.jpg')}}"
            alt=""
          />
          <div class="offer-text">
            <h6 class="text-white text-uppercase">Earn Profit</h6>
            <h3 class="text-white mb-3">Want to Sell?</h3>
            <a href="{{route('product.add')}}" class="btn btn-primary">Sell Now</a>
          </div>
        </div>
        <div class="product-offer mb-30" style="height: 200px">
          <img class="img-fluid" src="{{asset('public/frontend/asset/img/offer-2.jpg')}}" alt="" />
          <div class="offer-text">
            <h6 class="text-white text-uppercase">Save 20%</h6>
            <h3 class="text-white mb-3">Special Offer</h3>
            <a href="{{route('products')}}" class="btn btn-primary">Shop Now</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                @foreach ($companyDetails as $companyDetail)
                    <div class="bg-light p-4">
                      <a href="{{ $companyDetail->link }}">
                        <img src="{{ asset('public/storage/company/' . $companyDetail->image) }}" alt="" />
                      </a>  
                      </div>
                @endforeach
            </div>
        </div>
    </div>
  </div>
      <!-- Vendor End -->

      <!-- Categories Start -->
      <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
          <span class="bg-secondary pr-3">Categories</span>
        </h2>
        <div class="row px-xl-5 pb-3">
          @foreach ($categoryDetails as $category)
            @php
                $productCount = $productCounts[$category->id] ?? 0;
            @endphp
          <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
              <a class="text-decoration-none" href="{{ $category->slug }}">
                <div class="cat-item d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px">
                      <img class="img-fluid" src="{{asset('public/storage/category' . '/' . $category->image)}}" alt="" />
                    </div>
                    <div class="flex-fill pl-3">
                      <h6>{{ $category->name }}</h6>
                      <small class="text-body">{{ $productCount }} Products</small>
                    </div>
                </div>
              </a>
          </div>
        @endforeach
        </div>
      </div>
      <!-- Categories End -->

      <!-- Featured Start -->
      <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
          <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div
              class="d-flex align-items-center bg-light mb-4"
              style="padding: 30px"
            >
              <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
              <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div
              class="d-flex align-items-center bg-light mb-4"
              style="padding: 30px"
            >
              <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
              <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div
              class="d-flex align-items-center bg-light mb-4"
              style="padding: 30px"
            >
              <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
              <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div
              class="d-flex align-items-center bg-light mb-4"
              style="padding: 30px"
            >
              <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
              <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
          </div>
        </div>
      </div>
      <!-- Featured End -->


      <!-- Offer Start -->
      <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
          <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px">
              <img class="img-fluid" src="{{asset('public/frontend/asset/img/joyful-teenage-girl-with-dollars-her-hands-pointed-them-isolated.jpg')}}" alt="" />
              <div class="offer-text">
                  <h6 class="text-white text-uppercase">Earn Profit</h6>
                  <h3 class="text-white mb-3">Want to Sell?</h3>
                  <a href="{{route('product.add')}}" class="btn btn-primary">Sell Now</a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px">
              <img class="img-fluid" src="{{asset('public/frontend/asset/img/offer-2.jpg')}}" alt="" />
              <div class="offer-text">
                <h6 class="text-white text-uppercase">Save 20%</h6>
                <h3 class="text-white mb-3">Special Offer</h3>
                <a href="{{route('products')}}" class="btn btn-primary">Shop Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Offer End -->

      <!-- Products Start -->
      <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
          <span class="bg-secondary pr-3">Recent Products</span>
        </h2>
        <div class="row px-xl-5">
          @foreach ($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
              <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                  <img class="img-fluid w-100" src="{{asset('public/storage/product' . '/' . $product->product_image)}}" alt="" />
                  <div class="product-action">
                    <a class="btn btn-outline-dark btn-square" href="{{url('product-detail/'.$product->slug)}}"
                      ><i class="fa fa-shopping-cart"></i
                    ></a>
                    <a class="btn btn-outline-dark btn-square" onclick="favoriteProduct({{ $product->id }})">
                        @if($product->isFavorite())
                            <i class="fas fa-heart text-outline-dark"></i>
                        @else
                            <i class="far fa-heart"></i>
                        @endif
                    </a>
                  </div>
                </div>
                <div class="text-center py-4">
                  <a class="h6 text-decoration-none text-truncate" href="{{url('product-detail/'.$product->slug)}}">
                      {{ $product->name }}
                  </a>
                  <div
                    class="d-flex align-items-center justify-content-center mt-2"
                  >
                    <h5>${{ $product->discounted_price }}</h5>
                    <h6 class="text-muted ml-2"><del>${{ $product->price }}</del></h6>
                  </div>
                  <div class="d-flex align-items-center justify-content-center mb-1">
                    <!-- Average star rating -->
                    @if ($product->reviews->count() > 0)
                        @php
                            $averageRating = $product->reviews->avg('rating');
                            $roundedRating = round($averageRating / 5 * 5); // Convert to a 5-star rating
                        @endphp
                        <div class="text-primary mr-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $roundedRating)
                                    <i class="fas fa-star text-primary mr-1"></i>
                                @else
                                    <i class="far fa-star text-primary mr-1"></i>
                                @endif
                            @endfor
                            <small>({{ $product->reviews->count() }})</small>
                        </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <!-- Products End -->
 @endsection
@push('front_js')
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
    </script>


@endpush
