@extends('frontend.layouts.app')

@section('front_content')
<!-- Checkout Start -->
<div class="container-fluid">
    <form action="{{url('save-order-details')}}" method="POST">
        @csrf
        <div class="row px-xl-5">
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>First Name</label>
                        <input class="form-control" type="text" placeholder="John" name="first_name">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Last Name</label>
                        <input class="form-control" type="text" placeholder="Doe" name="last_name">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" placeholder="example@email.com" name="email">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Mobile No</label>
                        <input class="form-control" type="text" placeholder="+123 456 789" name="phone">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address Line 1</label>
                        <input class="form-control" type="text" placeholder="123 Street" name="address">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Country</label>
                        <select class="custom-select" name="country">
                            <option selected>United States</option>
                            <option>Afghanistan</option>
                            <option>Albania</option>
                            <option>Algeria</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>City</label>
                        <input class="form-control" type="text" placeholder="New York" name="city">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>State</label>
                        <input class="form-control" type="text" placeholder="New York" name="state">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>ZIP Code</label>
                        <input class="form-control" type="text" placeholder="123" name="zip_code">
                    </div>
{{--                    <div class="col-md-12 form-group">--}}
{{--                        <div class="custom-control custom-checkbox">--}}
{{--                            <input type="checkbox" class="custom-control-input" id="newaccount">--}}
{{--                            <label class="custom-control-label" for="newaccount">Create an account</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="custom-control custom-checkbox">--}}
{{--                            <input type="checkbox" class="custom-control-input" id="shipto">--}}
{{--                            <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
{{--            <div class="collapse mb-5" id="shipping-address">--}}
{{--                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">{{ webTranslation('shipping') }} Address</span></h5>--}}
{{--                <div class="bg-light p-30">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6 form-group">--}}
{{--                            <label>First Name</label>--}}
{{--                            <input class="form-control" type="text" placeholder="John">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 form-group">--}}
{{--                            <label>Last Name</label>--}}
{{--                            <input class="form-control" type="text" placeholder="Doe">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 form-group">--}}
{{--                            <label>E-mail</label>--}}
{{--                            <input class="form-control" type="text" placeholder="example@email.com">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 form-group">--}}
{{--                            <label>Mobile No</label>--}}
{{--                            <input class="form-control" type="text" placeholder="+123 456 789">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 form-group">--}}
{{--                            <label>Address Line 1</label>--}}
{{--                            <input class="form-control" type="text" placeholder="123 Street">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 form-group">--}}
{{--                            <label>Address Line 2</label>--}}
{{--                            <input class="form-control" type="text" placeholder="123 Street">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 form-group">--}}
{{--                            <label>Country</label>--}}
{{--                            <select class="custom-select">--}}
{{--                                <option selected>United States</option>--}}
{{--                                <option>Afghanistan</option>--}}
{{--                                <option>Albania</option>--}}
{{--                                <option>Algeria</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 form-group">--}}
{{--                            <label>City</label>--}}
{{--                            <input class="form-control" type="text" placeholder="New York">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 form-group">--}}
{{--                            <label>State</label>--}}
{{--                            <input class="form-control" type="text" placeholder="New York">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 form-group">--}}
{{--                            <label>ZIP Code</label>--}}
{{--                            <input class="form-control" type="text" placeholder="123">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <h6 class="mb-3">{{ webTranslation('products') }}</h6>
                    @foreach($cart as $item)
                    <div class="d-flex justify-content-between">
                        <p>{{$item->name}}</p>
                        <p>${{$item->price}}</p>
                    </div>
                    @endforeach
                </div>
                <div class="border-bottom pt-3 pb-2">
                    <div class="d-flex justify-content-between mb-2">
                        <h6>{{ webTranslation('subtotal') }}</h6>
                        <h6>${{$total}}</h6>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="font-weight-medium">{{ webTranslation('shipping') }}</h6>
                        <h6 class="font-weight-medium">${{$shipping_amount}}</h6>
                    </div>
                    @if($coupon_amount>0)
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Discount</h6>
                        <h6 class="font-weight-medium">-${{$coupon_amount}}</h6>
                    </div>
                        @endif
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>${{$total - $coupon_amount}}</h5>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                <div class="bg-light p-30">
                    <!-- <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="paypal">
                            <label class="custom-control-label" for="paypal">Paypal</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                            <label class="custom-control-label" for="directcheck">Direct Check</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                            <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                        </div>
                    </div> -->
{{--                    <form action="{{url('stripe')}}">--}}
                        <input type="hidden" value="{{$total - $coupon_amount}}" name="total">
                        <button class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
{{--                    </form>--}}
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<!-- Checkout End -->

@endsection
