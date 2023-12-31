@extends('frontend.layouts.app')

@section('front_content')
<style>
.star-outline {
    color: transparent; /* Hide the default star icon color */
    border: 1px solid currentColor; /* Use the icon's current color for the border */
    padding: 0; /* Remove any padding */
    margin: 0; /* Remove any margin */
}
</style>
<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    @if(session('success-message'))
    <div class="alert alert-success">{{ session('success-message') }}</div>
    @endif
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    @foreach($product->ProductImages as $index=>$image)
                    <div class="carousel-item {{$index==0 ? 'active' : '' }}">
                        <img class="w-100 h-100" src="{{asset($image->image)}}" alt="Image">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{$product->name}}</h3>
                <div class="d-flex mb-3">
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
                <h3 class="font-weight-semi-bold mb-4">${{$product->discounted_price}}</h3>
                <p class="mb-4">{{$product->short_description}}</p>
                <div class="d-flex mb-3">
                    <strong class="text-dark mr-3">{{ webTranslation('sizes') }}:</strong>
                    @foreach($product->ProductSizes as $sizes)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="size-{{$sizes->id}}" value="{{$sizes->id}}" name="size">
                        <label class="custom-control-label" for="size-{{$sizes->id}}">{{$sizes->Size->name}}</label>
                    </div>
                    @endforeach
                    {{-- <div class="custom-control custom-radio custom-control-inline">--}}
                    {{-- <input type="radio" class="custom-control-input" id="size-2" name="size">--}}
                    {{-- <label class="custom-control-label" for="size-2">S</label>--}}
                    {{-- </div>--}}
                    {{-- <div class="custom-control custom-radio custom-control-inline">--}}
                    {{-- <input type="radio" class="custom-control-input" id="size-3" name="size">--}}
                    {{-- <label class="custom-control-label" for="size-3">M</label>--}}
                    {{-- </div>--}}
                    {{-- <div class="custom-control custom-radio custom-control-inline">--}}
                    {{-- <input type="radio" class="custom-control-input" id="size-4" name="size">--}}
                    {{-- <label class="custom-control-label" for="size-4">L</label>--}}
                    {{-- </div>--}}
                    {{-- <div class="custom-control custom-radio custom-control-inline">--}}
                    {{-- <input type="radio" class="custom-control-input" id="size-5" name="size">--}}
                    {{-- <label class="custom-control-label" for="size-5">XL</label>--}}
                    {{-- </div>--}}
                </div>
                <div class="d-flex mb-4">
                    <strong class="text-dark mr-3">{{ webTranslation('colors') }}:</strong>
                    @foreach($product->ProductColors as $color)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="color-{{$color->id}}" value="{{$color->id}}" name="color">
                        <label class="custom-control-label" for="color-{{$color->id}}">{{$color->Color->name}}</label>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id="qty">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary px-3" onclick="AddToCart({{$product->id}})"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart
                    </button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">{{ webTranslation('shareon') }}:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">{{ webTranslation('description') }}</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">{{ webTranslation('reviews') }} ({{ $product->reviews->count() }})</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">{{ webTranslation('productdescription') }}</h4>
                        <p>{{$product->long_description}}</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">1 review for "Product Name"</h4>
                                <div class="media mb-4">
                                    <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam
                                            ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod
                                            ipsum.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">{{ webTranslation('leaveareview') }}</h4>
                                <small>Your email address will not be published. Required fields are marked
                                    *</small>

                                <form action="{{ route('review.create') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>

                                        <div class="text-primary rating ms-2 mb-2">
                                            <input type="hidden" id="rating_result" name="rating">
                                            <i class="rating_star far fa-star"></i>
                                            <i class="rating_star far fa-star"></i>
                                            <i class="rating_star far fa-star"></i>
                                            <i class="rating_star far fa-star"></i>
                                            <i class="rating_star far fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" name="review" cols="30" rows="5" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    const ratingStars = [...document.getElementsByClassName("rating_star")];
    const ratingResult = document.querySelector("#rating_result");

    printRatingResult(ratingResult);

    function executeRating(stars, result) {
        const starClassActive = "rating_star fas fa-star";
        const starClassUnactive = "rating_star far fa-star";
        const starsLength = stars.length;

        stars.forEach((star, index) => {
            star.onclick = () => {
                if (star.className.indexOf(starClassUnactive) !== -1) {
                    for (let i = 0; i <= index; i++) {
                        stars[i].className = starClassActive;
                    }
                    printRatingResult(result, index + 1);
                } else {
                    for (let i = index; i < starsLength; i++) {
                        stars[i].className = starClassUnactive;
                    }
                    printRatingResult(result, index);
                }
            };
        });
    }

    function printRatingResult(result, num = 0) {
        result.value = num;
    }

    executeRating(ratingStars, ratingResult);


    function AddToCart(id) {
        let qty = $('#qty').val();
        $.ajax({
            type: "POST",
            url: "{{ url('add-to-cart') }}",
            data: {
                '_token': "{{csrf_token()}}",
                'id': id,
                'qty':qty,
                'size_id':$('input[name="size"]:checked').val(),
                'color_id':$('input[name="color"]:checked').val()
            },
            dataType: "json",
            success: function (response) {
                Toast.fire('success',response.msg,'success');
                location.href = '{{url('products')}}';
            }
        });
    }
</script>



@endsection
