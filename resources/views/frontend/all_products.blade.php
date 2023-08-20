@extends('frontend.layouts.app')

@section('front_content')


<form action="{{ route('frontend.filter-products') }}" method="get">
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1" name="price_range[]" value="0-100">
                        <label class="custom-control-label" for="price-1">$0 - $100</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2" name="price_range[]" value="100-200">
                        <label class="custom-control-label" for="price-2">$100 - $200</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3" name="price_range[]" value="200-300">
                        <label class="custom-control-label" for="price-3">$200 - $300</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4" name="price_range[]" value="300-400">
                        <label class="custom-control-label" for="price-4">$300 - $400</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="price-5" name="price_range[]" value="400-500">
                        <label class="custom-control-label" for="price-5">$400 - $500</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </div>
                <!-- Price End -->

                <input type="hidden" name="selected_price_ranges" id="selected_price_ranges" value="">

                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <!-- All Color option -->
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="color-all">
                        <label class="custom-control-label" for="color-all">All Color</label>
                        <span class="badge border font-weight-normal">{{ $colors->sum('product_count') }}</span>
                    </div>
                    <!-- Color options -->
                    @foreach($colors as $color)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-{{ $color->id }}" name="color[]" value="{{ $color->id }}">
                        <label class="custom-control-label" for="color-{{ $color->id }}">{{ $color->name }}</label>
                        <span class="badge border font-weight-normal">{{ $color->product_count }}</span>
                    </div>
                    @endforeach
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <!-- All Size option -->
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="size-all">
                        <label class="custom-control-label" for="size-all">All Size</label>
                        <span class="badge border font-weight-normal">{{ $sizes->sum('product_count') }}</span>
                    </div>
                    <!-- Size options -->
                    @foreach($sizes as $size)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="size-{{ $size->id }}" name="size[]" value="{{ $size->id }}">
                        <label class="custom-control-label" for="size-{{ $size->id }}">{{ $size->name }}</label>
                        <span class="badge border font-weight-normal">{{ $size->product_count }}</span>
                    </div>
                    @endforeach
                </div>
                <!-- Size End -->
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                            </div>
                            {{-- <div class="ml-2">--}}
                            {{-- <div class="btn-group">--}}
                            {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>--}}
                            {{-- <div class="dropdown-menu dropdown-menu-right">--}}
                            {{-- <a class="dropdown-item" href="#">Latest</a>--}}
                            {{-- <a class="dropdown-item" href="#">Popularity</a>--}}
                            {{-- <a class="dropdown-item" href="#">Best Rating</a>--}}
                            {{-- </div>--}}
                            {{-- </div>--}}
                            {{-- <div class="btn-group ml-2">--}}
                            {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>--}}
                            {{-- <div class="dropdown-menu dropdown-menu-right">--}}
                            {{-- <a class="dropdown-item" href="#">10</a>--}}
                            {{-- <a class="dropdown-item" href="#">20</a>--}}
                            {{-- <a class="dropdown-item" href="#">30</a>--}}
                            {{-- </div>--}}
                            {{-- </div>--}}
                            {{-- </div>--}}
                        </div>
                    </div>
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{asset('public/storage/product/'.$product->product_image)}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{url('product-detail/'.$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
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
                                <a class="h6 text-decoration-none text-truncate" href="{{url('product-detail/'.$product->id)}}">{{$product->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
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
                    <div class="col-12">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
</form>
<!-- Shop End -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceCheckboxes = document.querySelectorAll('input[name="price_range[]"]');
        const selectedPriceRangesInput = document.getElementById('selected_price_ranges');

        priceCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const selectedPriceRanges = Array.from(priceCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                selectedPriceRangesInput.value = selectedPriceRanges.join(',');
            });
        });
    });
</script>

@endsection
