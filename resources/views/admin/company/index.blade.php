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
                overflow: hidden;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
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
            <div class="col-md-6 offset-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="mb-3 mb-md-0">Companies > <span class="text-secondary">Company List</span></h5>
                            </div>
                            <div class="d-flex align-items-center flex-wrap text-nowrap mr-1">
                                <button type="button" class="btn btn-primary mb-2 mb-md-0"
                                        data-toggle="tooltip" title="Add Company"
                                        onclick="window.location.href='{{route('company.add')}}';">
                                    <i class="fa fa-plus mr-1"></i>Add Company
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="company_table" class="table w-100">
                                <thead>
                                <tr>
                                    <th style="width:10%;">#</th>
                                    <th style="width:70%;">Image</th>
                                    <th style="width:20%;">Action</th>
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
    @include('admin.company.delete')
@endsection
