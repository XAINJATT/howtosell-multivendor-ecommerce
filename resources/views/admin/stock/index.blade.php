@extends('admin.layouts.app')
@section('content')
<style>
    form div {
    margin-bottom: 0px !important;
    }

    .dataTables_wrapper.dt-bootstrap4 .dataTables_length select {
        width: 30% !important;
    }

    div.dataTables_wrapper div.dataTables_filter label {
        text-align: right;
    }
</style>
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
                <form action="{{ route('stock.store') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="mb-3 mb-md-0">Products Stock > <span class="text-secondary">Product Stock List</span></h5>
                            </div>
                            <div class="d-flex align-items-center flex-wrap text-nowrap mr-1">
                                <button type="submit" class="btn btn-primary">Save Stock</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="stock_table" class="table w-100">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">#</th>
                                        <th style="width:10%;">Image</th>
                                        <th style="width:10%;">Name</th>
                                        <th style="width:10%;">Price</th>
                                        <th style="width:10%;">Discounted Price</th>
                                        <th style="width:20%;">Short Description</th>
                                        <th style="width:10%;">Starting Quantity</th>
                                        <th style="width:25%;">Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection