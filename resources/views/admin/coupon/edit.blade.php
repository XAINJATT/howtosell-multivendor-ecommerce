@extends('admin.layouts.app')
@section('content')
    <div class="page-content">
        <section class="contact-area pb-5">
            <div class="container">
                <div class="row justify-content-center">
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
                    <div class="col-8 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div>
                                        <h5 class="mb-3 mb-md-0">Coupons > <span class="text-secondary">Edit Coupon</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('coupon.update')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$coupon->id}}">
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <label for="coupon_code" class="font-weight-bold">Coupon Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   placeholder="Enter Coupon Code"
                                                   name="coupon_code" id="coupon_code" value="{{$coupon->coupon_code}}" >
                                            @error('coupon_code')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror

                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="discount_amount" class="font-weight-bold">Discount Amount<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control"
                                                   placeholder="Enter Coupon Code"
                                                   name="discount_amount" id="discount_amount" value="{{$coupon->discount_amount}}" >
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="start_date" class="font-weight-bold">Start Date<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control"
                                                   placeholder="Enter Coupon Code"
                                                   name="start_date" id="start_date" value="{{$coupon->start_date}}" >
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="end_date" class="font-weight-bold">End Date<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control"
                                                   placeholder="Enter Coupon Code"
                                                   name="end_date" id="end_date" value="{{$coupon->end_date}}" >
                                        </div>

                                        <div class="col-md-12 mt-4 text-right">
                                            <button type="submit" class="btn btn-primary" name="submit">
                                                <i class="fa-solid fa-floppy-disk"></i> Submit
                                            </button>
                                            <button type="button" class="btn btn-light px-4 py-2"
                                                    onclick="window.location.href='{{route('coupon')}}'">
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
