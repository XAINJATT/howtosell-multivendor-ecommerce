@extends('admin.layouts.app')
@section('content')
    <style media="screen">
        @media only screen and (min-width: 768px) {
            div.dataTables_wrapper div.dataTables_filter {
                text-align: right;
            }

            .table-responsive {
                display: block;
                width: 100%;
                overflow: auto;
                -webkit-overflow-scrolling: touch;
            }

            .w-100, .dataTables_wrapper.dt-bootstrap4 .dataTables_length select {
                width: 150px !important;
            }

            div.dataTables_wrapper div.dataTables_filter {
                text-align: right;
                float: right;
            }
        }
    </style>
    <div class="page-content" id="usersPage">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">CEO Event Management > <span class="text-primary">All Users</span></h4>
            </div>
        </div>

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
            <div class="col-12 col-md-1" id="beforeTablePage"></div>
            <div class="col-12 col-md-10 grid-margin stretch-card" id="tablePage">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            Details
                            <button class="btn btn-primary float-right mb-3" data-toggle="tooltip"
                                    title="Filter" onclick="UserFilterBackButton();">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-primary float-right mb-3 mr-2" data-toggle="tooltip"
                                    title="Send Message" onclick="SendMessageToAllUsers();"
                                    id="sendMessageBtn" style="display:none;">
                                <i class="fas fa-sms mr-1"></i>
                            </button>
                        </h6>
                        <div class="table-responsive">
                            <form action="{{url('')}}" method="post" enctype="multipart/form-data" id="usersForm">
                                @csrf
                                @include('admin.users.sendMessageModal')
                                <table id="admin_user_table" class="table w-100">
                                    <thead>
                                    <tr>
                                        <th class="allUsersActionCheckBoxColumn">
                                            <input type="checkbox" name="checkAllBox" class="allUsersCheckBox"
                                                   id="checkAllBox" onchange="CheckAllUserRecords(this);"/>
                                        </th>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 5%;">Name</th>
                                        <th style="width: 20%;">Email</th>
                                        <th style="width: 5%;">Gender</th>
                                        <th style="width: 15%;">Vaccination Status</th>
                                        <th style="width: 5%;">Rating</th>
                                        <th style="width: 10%;">Status</th>
                                        <th style="width: 5%;">Verification</th>
                                        <th style="width: 30%;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{--User Filter - START--}}
            <div class="col-12 col-md-1 grid-margin stretch-card" id="filterPage" style="display:none;">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            Filter
                            <i class="fa fa-window-close float-right" style="font-size: 16px;
                          cursor: pointer;" aria-hidden="true" onclick="UserFilterCloseButton();"></i>
                        </h6>
                        <div class="row">
                            <div class="col-md-12 mt-2 mb-3">
                                <label for="user_rating">Rating</label>
                                <select class="form-control select2" name="user_rating" id="user_rating">
                                    <option value="">Select</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2 mb-3">
                                <label for="user_experience">Experience</label>
                                <select class="form-control select2" name="user_experience" id="user_experience">
                                    <option value="">Select</option>
                                    <option value="1">Upto 1 Year</option>
                                    <option value="2">Upto 2 Years</option>
                                    <option value="3">Upto 3 Years</option>
                                    <option value="4">Upto 4 Years</option>
                                    <option value="5">Upto 5 Years</option>
                                    <option value="6">Upto 6 Years</option>
                                    <option value="7">Upto 7 Years</option>
                                    <option value="8">Upto 8 Years</option>
                                    <option value="9">Upto 9 Years</option>
                                    <option value="10">Upto 10 Years</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2 mb-3">
                                <label for="user_jobtype">Job Type</label>
                                <select class="form-control select2" name="user_jobtype[]" id="user_jobtype" multiple>
                                    {{--<option value="">Select</option>--}}
                                    @foreach($JobTypes as $index => $value)
                                        <option value="{{$value->id}}">{{$value->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-2 mb-3">
                                <label for="user_vaccinationtype">Vaccination Type</label>
                                <select class="form-control select2" name="user_vaccinationtype" id="user_vaccinationtype">
                                    <option value="">Select</option>
                                    <option value="0">Partially Vaccinated</option>
                                    <option value="1">Fully Vaccinated</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2 mb-3">
                                <label for="user_language">Language</label>
                                <select class="form-control select2" name="user_language[]" id="user_language" multiple>
                                    {{--<option value="">Select</option>--}}
                                    @foreach($Languages as $index => $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-2 mb-3">
                                <label for="user_gender">Gender</label>
                                <select class="form-control select2" name="user_gender" id="user_gender">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Both">Both</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2 mb-3">
                                <label for="user_status">Status</label>
                                <select class="form-control select2" name="user_status" id="user_status">
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Ban</option>
                                    <option value="Both">Both</option>
                                </select>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" onclick="MakeUserTable();">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--User Filter - END--}}
        </div>
    </div>
    @include('admin.users.deleteUserModel')
    @include('admin.users.banUserModal')
    @include('admin.users.verifyUserModal')
@endsection
