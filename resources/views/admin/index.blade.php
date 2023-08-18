@extends('admin.layouts.app')
@section('content')
    <style media="screen">
        @media only screen and (min-width: 1025px) {
            div.dataTables_wrapper div.dataTables_filter {
                text-align: right;
                margin-right: 185px;
            }

            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: hidden;
                -webkit-overflow-scrolling: touch;
            }

            .btn-primary {
                color: #ffffff;
                background-color: {{\App\Helpers\SiteHelper::settings()['PrimaryColor']}};
                border-color: {{\App\Helpers\SiteHelper::settings()['PrimaryColor']}};
            }

            .btn-primary:hover {
                color: #ffffff;
                background-color: {{\App\Helpers\SiteHelper::settings()['PrimaryColor']}};
                border-color: {{\App\Helpers\SiteHelper::settings()['PrimaryColor']}};
            }

            .btn-primary:not(:disabled):not(.disabled):active {
                color: #ffffff;
                background-color: {{\App\Helpers\SiteHelper::settings()['PrimaryColor']}};
                border-color: {{\App\Helpers\SiteHelper::settings()['PrimaryColor']}};
            }
        }
    </style>
    <div class="page-content" id="DashboardPage">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
            </div>
        </div>
        <!-- Cards Start -->
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4>Total Products <br>{{ $totalProducts }}</h4>
                                    <div>
                                        <img src="{{asset('public/storage/logo/product.png')}}" style="height: 100px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4>Total Orders <br>{{ $totalOrders }}</h4>
                                    <div>
                                        <img src="{{asset('public/storage/logo/orders.jpg')}}" style="height: 100px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4>Total Categories <br>{{ $totalCategories }}</h4>
                                    <div>
                                        <img src="{{asset('public/storage/logo/categories.jpg')}}" style="height: 100px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
