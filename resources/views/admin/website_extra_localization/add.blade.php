@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <section class="contact-area pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
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
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div>
                                    <h5 class="mb-3 mb-md-0">Set Website Language > <span class="text-secondary">Create Website Language</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('website_extra_localization.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="language">Language</label>
                                        <select class="form-control" name="language" id="language">
                                            <option value="">Select</option>
                                            @foreach($languages as $lang)
                                            <option value="{{$lang->id}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Customer Service</small></label>
                                        <input type="text" class="form-control" name="customerservice" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Home</small></label>
                                        <input type="text" class="form-control" name="home" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Shop</small></label>
                                        <input type="text" class="form-control" name="shop" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Men Fashion</small></label>
                                        <input type="text" class="form-control" name="menfashion" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Women Fashion</small></label>
                                        <input type="text" class="form-control" name="womenfashion" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Kids Fashion</small></label>
                                        <input type="text" class="form-control" name="kidsfashion" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Shop Now</small></label>
                                        <input type="text" class="form-control" name="shownow" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Sell Now</small></label>
                                        <input type="text" class="form-control" name="sellnow" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>EARN PROFIT</small></label>
                                        <input type="text" class="form-control" name="earnprofit" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Want to Sell?</small></label>
                                        <input type="text" class="form-control" name="wanttosell" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>SAVE</small></label>
                                        <input type="text" class="form-control" name="save" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Special Offer</small></label>
                                        <input type="text" class="form-control" name="specialoffer" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Categories</small></label>
                                        <input type="text" class="form-control" name="categories" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Quality Product</small></label>
                                        <input type="text" class="form-control" name="qualityproduct" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Free Shipping</small></label>
                                        <input type="text" class="form-control" name="freeshipping" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Day Return</small></label>
                                        <input type="text" class="form-control" name="dayreturn" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Support</small></label>
                                        <input type="text" class="form-control" name="support" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Recent Product</small></label>
                                        <input type="text" class="form-control" name="recentproduct" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Filter By Price</small></label>
                                        <input type="text" class="form-control" name="filterbyprice" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Filter By Color</small></label>
                                        <input type="text" class="form-control" name="filterbycolor" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Filter By Size</small></label>
                                        <input type="text" class="form-control" name="filterbysize" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Apply Filter</small></label>
                                        <input type="text" class="form-control" name="applyfilter" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Sizes</small></label>
                                        <input type="text" class="form-control" name="sizes" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Colors</small></label>
                                        <input type="text" class="form-control" name="colors" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Share on</small></label>
                                        <input type="text" class="form-control" name="shareon" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Description</small></label>
                                        <input type="text" class="form-control" name="description" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Product Description</small></label>
                                        <input type="text" class="form-control" name="productdescription" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Reviews</small></label>
                                        <input type="text" class="form-control" name="reviews" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Leave a review</small></label>
                                        <input type="text" class="form-control" name="leaveareview" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Products</small></label>
                                        <input type="text" class="form-control" name="products" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Price</small></label>
                                        <input type="text" class="form-control" name="price" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Quantity</small></label>
                                        <input type="text" class="form-control" name="quantity" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Total</small></label>
                                        <input type="text" class="form-control" name="total" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Remove</small></label>
                                        <input type="text" class="form-control" name="remove" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Apply Coupon</small></label>
                                        <input type="text" class="form-control" name="applycoupon" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>CART SUMMARY</small></label>
                                        <input type="text" class="form-control" name="cartsummary" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Subtotal</small></label>
                                        <input type="text" class="form-control" name="subtotal" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Shipping</small></label>
                                        <input type="text" class="form-control" name="shipping" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Proceed To Checkout</small></label>
                                        <input type="text" class="form-control" name="proceedtocheckout" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Get In Touch</small></label>
                                        <input type="text" class="form-control" name="getintouch" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>GetInTouch Description</small></label>
                                        <input type="text" class="form-control" name="getintouchdescription" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Quick Shop</small></label>
                                        <input type="text" class="form-control" name="quickshop" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>NewSletter</small></label>
                                        <input type="text" class="form-control" name="newsletter" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>NewSletter Description</small></label>
                                        <input type="text" class="form-control" name="newsletterdescription" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>FOLLOW US</small></label>
                                        <input type="text" class="form-control" name="followus" />
                                    </div>
                                    <div class="col-md-12 mt-4 text-right">
                                        <button type="submit" class="btn btn-primary submitBtn" name="submit">
                                            <i class="fa-solid fa-floppy-disk"></i> Submit
                                        </button>
                                        <button type="button" class="btn btn-light px-4 py-2" onclick="window.location.href='{{route('website_extra_localization')}}'">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection