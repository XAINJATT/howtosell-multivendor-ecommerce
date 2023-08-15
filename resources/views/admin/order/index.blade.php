@extends('admin.layouts.app')
@section('content')
<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->has('success-message'))
            <div class="alert alert-success">
                {{ session('success-message') }}
            </div>
            @elseif(session()->has('error-message'))
            <div class="alert alert-danger">
                {{ session('error-message') }}
            </div>
            @endif
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h5 class="mb-3 mb-md-0">Orders > <span class="text-secondary">Order List</span></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="order_table" class="table w-100">
                            <thead>
                                <tr>
                                    <th style="width:5%;">#</th>
                                    <th style="width:12%;">Order Status</th>
                                    <th style="width:12%;">Sub Total</th>
                                    <th style="width:12%;">Shipping Amount</th>
                                    <th style="width:10%;">Total</th>
                                    <th style="width:14%;">Order Description</th>
                                    <th style="width:12%;">Payment Status</th>
                                    <th style="width:12%;">Delivery Note</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection