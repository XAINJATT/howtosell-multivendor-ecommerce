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
                                    <div class="col-md-6 form-group">
                                        <label for="language">Language</label>
                                        <select class="form-control" name="language" id="language">
                                            <option value="">Select</option>
                                            @foreach($languages as $lang)
                                            <option value="{{$lang->id}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="product_name"> <small>[
                                                Enter footer Content
                                                ]</small></label>
                                        <input type="text" class="form-control" name="f_content" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Customer Service</small></label>
                                        <input type="text" class="form-control" name="customerservice" />
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
                                        <label><small>14-Day Return</small></label>
                                        <input type="text" class="form-control" name="14-dayreturn" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>24/7 Support</small></label>
                                        <input type="text" class="form-control" name="24/7support" />
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
                                        <label><small>Description</small></label>
                                        <input type="text" class="form-control" name="description" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Reviews</small></label>
                                        <input type="text" class="form-control" name="reviews" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Leave a review</small></label>
                                        <input type="text" class="form-control" name="leaveareview" />
                                    </div>
                                    <!-- <div class="col-md-4 form-group">
                                        <label><small>Get In Touch</small></label>
                                        <input type="text" class="form-control" name="get_in_touch" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>GetInTouch Description</small></label>
                                        <input type="text" class="form-control" name="get_in_touch_description" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>Quick Shop</small></label>
                                        <input type="text" class="form-control" name="quick_shop" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>NewSletter</small></label>
                                        <input type="text" class="form-control" name="newsletter" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>NewSletter Description</small></label>
                                        <input type="text" class="form-control" name="newsletter_description" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label><small>FOLLOW US</small></label>
                                        <input type="text" class="form-control" name="follow_us" />
                                    </div> -->
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