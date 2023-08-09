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
                                    <h4>Total Drivers <br>3,897</h4>
                                    <div>
                                        <img src="{{asset('public/storage/logo/driver.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4>Total Bookings <br>3,897</h4>
                                    <div>
                                        <img src="{{asset('public/storage/logo/bookings.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4>Total Bookings <br>3,897</h4>
                                    <div>
                                        <img src="{{asset('public/storage/logo/earnings.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Graph Start -->
        <div class="row">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                            <h6 class="card-title mb-0">Revenue</h6>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="dropdownMenuButton3"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right"
                                     aria-labelledby="dropdownMenuButton3">
                                    {{--<a class="dropdown-item d-flex align-items-center" href="#"><i--}}
                                                {{--data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>--}}
                                    {{--<a class="dropdown-item d-flex align-items-center" href="#"><i--}}
                                                {{--data-feather="edit-2" class="icon-sm mr-2"></i> <span--}}
                                                {{--class="">Edit</span></a>--}}
                                    {{--<a class="dropdown-item d-flex align-items-center" href="#"><i--}}
                                                {{--data-feather="trash" class="icon-sm mr-2"></i> <span--}}
                                                {{--class="">Delete</span></a>--}}
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="printer" class="icon-sm mr-2"></i> <span
                                                class="">Print</span></a>
                                    {{--<a class="dropdown-item d-flex align-items-center" href="#"><i--}}
                                                {{--data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>--}}
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col-md-7">
                                <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business has
                                    from its normal business activities, usually from the sale of goods and services
                                    to customers.</p>
                            </div>
                            <div class="col-md-5 d-flex justify-content-md-end">
                                <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-primary">Today</button>
                                    <button type="button" class="btn btn-outline-primary d-none d-md-block">Week</button>
                                    <button type="button" class="btn btn-primary">Month</button>
                                    <button type="button" class="btn btn-outline-primary">Year</button>
                                </div>
                            </div>
                        </div>
                        <div class="flot-wrapper">
                            <div id="flotChart1" class="flot-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Data-Table-->
        <div class="row">
            <div class="col-md-8 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Recent Bookings</h6>
                            <div class="dropdown mb-2">
                                <button class="btn p-0" type="button" id="dropdownMenuButton7"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right"
                                     aria-labelledby="dropdownMenuButton7">
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="edit-2" class="icon-sm mr-2"></i> <span
                                                class="">Edit</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="trash" class="icon-sm mr-2"></i> <span
                                                class="">Delete</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="printer" class="icon-sm mr-2"></i> <span
                                                class="">Print</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Booking ID</th>
                                    <th class="pt-0">Pickup Date & Time</th>
                                    <th class="pt-0">Customer Name</th>
                                    <th class="pt-0">Pickup Location</th>
                                    <th class="pt-0">Amount</th>
                                    <th class="pt-0">Phone No</th>
                                    <th class="pt-0">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>NobleUI jQuery</td>
                                    <td>01/01/2020</td>
                                    <td>26/04/2020</td>
                                    <td>dfsdf</td>
                                    <td>Leonardo Payne</td>
                                    <td>Leonardo Payne</td>
                                    <td>Leonardo Payne</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>NobleUI jQuery</td>
                                    <td>01/01/2020</td>
                                    <td>26/04/2020</td>
                                    <td>dfsdf</td>
                                    <td>Leonardo Payne</td>
                                    <td>Leonardo Payne</td>
                                    <td>Leonardo Payne</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>NobleUI jQuery</td>
                                    <td>01/01/2020</td>
                                    <td>26/04/2020</td>
                                    <td>dfsdf</td>
                                    <td>Leonardo Payne</td>
                                    <td>Leonardo Payne</td>
                                    <td>Leonardo Payne</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>NobleUI jQuery</td>
                                    <td>01/01/2020</td>
                                    <td>26/04/2020</td>
                                    <td>dfsdf</td>
                                    <td>Leonardo Payne</td>
                                    <td>Leonardo Payne</td>
                                    <td>Leonardo Payne</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>NobleUI jQuery</td>
                                    <td>01/01/2020</td>
                                    <td>26/04/2020</td>
                                    <td>dfsdf</td>
                                    <td>Leonardo Payne</td>
                                    <td>Leonardo Payne</td>
                                    <td>Leonardo Payne</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div id="progressbar1" class="mx-auto"></div>
                        <div class="row mt-4 mb-3">
                            <div class="col-6 d-flex justify-content-end">
                                <div>
                                    <label class="d-flex align-items-center justify-content-end tx-10 text-uppercase font-weight-medium">Completed
                                        Jobs <span
                                                class="p-1 ml-1 rounded-circle bg-primary-muted"></span></label>
                                    <h5 class="font-weight-bold mb-0 text-right">9283</h5>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <label class="d-flex align-items-center tx-10 text-uppercase font-weight-medium"><span
                                                class="p-1 mr-1 rounded-circle bg-primary"></span> Cancelled</label>
                                    <h5 class="font-weight-bold mb-0">1,023</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
