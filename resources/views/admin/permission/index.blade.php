@extends('admin.layouts.app')
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-10 offset-md-1">
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
            <div class="col-md-8 offset-md-2 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="mb-3 mb-md-0">Permissions > <span class="text-secondary">Permission List</span></h5>
                            </div>
                            <div class="d-flex align-items-center flex-wrap text-nowrap mr-1">
                                <button type="button" class="btn btn-primary mb-2 mb-md-0"
                                        data-toggle="tooltip" title="Add Permission"
                                        onclick="window.location.href='{{route('permission.add')}}';">
                                    <i class="fa fa-plus mr-1"></i>Add Permission
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="permission_table" class="table w-100">
                                <thead>
                                <tr>
                                    <th style="width:10%;">#</th>
                                    <th style="width:25%;">Name</th>
                                    <th style="width:45%;">Guard Name</th>
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
    @include('admin.permission.delete')
@endsection
