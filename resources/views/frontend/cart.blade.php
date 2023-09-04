@extends('frontend.layouts.app')

@section('front_content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table
                    class="table table-light table-borderless table-hover text-center mb-0"
                >
                    <thead class="thead-dark">
                    <tr>
                        <th>{{ webTranslation('products') }}</th>
                        <th>{{ webTranslation('price') }}</th>
                        <th>{{ webTranslation('quantity') }}</th>
                        <th>{{ webTranslation('total') }}</th>
                        <th>{{ webTranslation('remove') }}</th>
                    </tr>
                    </thead>
                    <tbody class="align-middle">
                    @foreach($cart as $index=>$item)
                        <tr data-card="product">
                            <td class="align-middle">
                                <img src="{{asset('public/storage/product/'.$item->options->img)}}" alt=""
                                     style="width: 50px"/>
                                {{$item->name}}
                            </td>
                            <td class="align-middle">${{$item->price}}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px" data-quantity="quantity">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus qtyBtn"
                                                data-quantityBtn="decrement"
                                                onclick="updateCart($(this),'{{$index}}')"
                                                data-rowId="{{ $item->rowId }}" data-productId="{{ $item->id }}"
                                                data-weight="{{$item->weight}}">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control form-control-sm bg-secondary border-0 text-center quantityInput"
                                        value="{{$item->qty}}"
                                        id="qtyInp{{$index}}"
                                        data-rowId="{{ $item->rowId }}" data-weight="{{$item->weight}}"
                                    />
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus qtyBtn"
                                                data-quantityBtn="increment"
                                                onclick="updateCart($(this),'{{$index}}')"
                                                data-rowId="{{ $item->rowId }}" data-productId="{{ $item->id }}"
                                                data-weight="{{$item->weight}}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">${{ $item->price * (int) $item->qty }}</td>
                            <td class="align-middle">
                                <button class="btn btn-sm btn-danger" onclick="removeProduct('{{$item->rowId}}')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                @if($coupon_amount == 0)
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code" id="coupon_code"/>
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="applyCoupon()">{{ webTranslation('applycoupon') }}</button>
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-between" style="border: 1px solid gray">
                        <div>
                            <h3 class="text-success" style="text-decoration: underline">{{$coupon_code}}</h3>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-danger btn-sm">{{ webTranslation('remove') }}</button>
                        </div>
                    </div>
                @endif
                <h5 class="section-title position-relative text-uppercase mb-3 mt-2">
                    <span class="bg-secondary pr-3">{{ webTranslation('cartsummary') }}</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>{{ webTranslation('subtotal') }}</h6>
                            <h6>${{$total}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
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
                            <h5>{{ webTranslation('total') }}</h5>
                            <h5>${{$total - $coupon_amount}}</h5>
                        </div>
                        <a href="{{url('checkout')}}"
                            class="btn btn-block btn-primary font-weight-bold my-3 py-3"
                        >
                            {{ webTranslation('proceedtocheckout') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection

@push('front_js')
    <script>

        function updateCart(e,index) {
            console.log(e.attr("data-quantityBtn"));

            let action = e.attr("data-quantityBtn");
            let quantityInput = $('#qtyInp'+index).val();
            let qty = 0;
            if (action === "increment") {
                qty = ++quantityInput;
            } else if (action === "decrement") {
                if (quantityInput > 1) {
                    qty = --quantityInput;
                }
            } else {
                qty = quantityInput;
            }
            let rowId = e.attr("data-rowId");
            let product_id = e.attr("data-productId");
            let weight = e.attr("data-weight");
            $.ajax({
                type: "POST",
                url: "{{ url('update-cart') }}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'quantity': qty,
                    'rowId': rowId,
                    'weight': weight,
                    'product_id': product_id
                },
                dataType: "json",
                success: function (response) {
                    location.reload();
                }
            });
        }

        function applyCoupon() {
            if($('#coupon_code').val()) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('apply-coupon') }}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'code': $('#coupon_code').val(),
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.status) {
                            location.reload();
                        }else{
                            Toast.fire('',response.msg,'error')
                        }
                    }
                });
            }
        }

        function removeProduct(rowId) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('remove-product') }}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'rowId': rowId
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.status) {
                            location.reload();
                        }else{
                            Toast.fire('',response.msg,'error')
                        }
                    }
                });
        }
    </script>
@endpush
