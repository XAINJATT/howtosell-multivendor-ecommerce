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
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach($cart as $item)
                        <tr>
                        <td class="align-middle">
                            <img src="{{asset('public/storage/product/'.$item->options->img)}}" alt="" style="width: 50px"/>
                            {{$item->name}}
                        </td>
                        <td class="align-middle">${{$item->price}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px" data-quantity="quantity">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus qtyBtn" data-quantityBtn="decrement"
                                            data-rowId="{{ $item->rowId }}" data-weight="{{$item->weight}}">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input
                                    type="text"
                                    class="form-control form-control-sm bg-secondary border-0 text-center"
                                    value="{{$item->qty}}"
                                    data-rowId="{{ $item->rowId }}" data-weight="{{$item->weight}}"
                                />
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus qtyBtn" data-quantityBtn="increment"
                                            data-rowId="{{ $item->rowId }}" data-weight="{{$item->weight}}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">${{ $item->price * $item->qty }}</td>
                        <td class="align-middle">
                            <button class="btn btn-sm btn-danger">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input
                            type="text"
                            class="form-control border-0 p-4"
                            placeholder="Coupon Code"
                        />
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Cart Summary</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>$150</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>$160</h5>
                        </div>
                        <button
                            class="btn btn-block btn-primary font-weight-bold my-3 py-3"
                        >
                            Proceed To Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection

@push('front_js')
    <script>
        let quantitySection = document.querySelector("[data-quantity='quantity']");
        let quantityBtns = quantitySection.querySelectorAll("[data-quantityBtn]");
        quantityBtns.forEach((quantityBtn) => {
            quantityBtn.onclick = (e) => {
                let targetBtn = e.currentTarget;
                let action = targetBtn.getAttribute("data-quantityBtn");
                let qty = 0;
                if (action === "increment") {
                    qty = ++quantityInput.value;
                } else if (action === "decrement") {
                    if (quantityInput.value > 1) {
                        qty = --quantityInput.value;
                    }
                } else {
                    qty = quantityInput.value;
                }
                let rowId = targetBtn.getAttribute("data-rowId");
                let weight = targetBtn.getAttribute("data-weight");
                console.log(qty)
                var product_IDD = $('.product_sku').val();
                if (product_IDD == 'SO-BBOX31' && qty > '2') {
                    $('#exampleModal').modal('show');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('update-cart') }}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'quantity': qty,
                            'rowId': rowId,
                            'weight': weight
                        },
                        dataType: "json",
                        success: function (response) {
                            location.reload();
                        }
                    });
                }

                let calculatedTotalPrice = parseInt(price) * parseInt(quantityInput.value);
                totalPrice.innerHTML = calculatedTotalPrice;
                totalPriceInput.value = calculatedTotalPrice;
            }
        })
    </script>
@endpush
