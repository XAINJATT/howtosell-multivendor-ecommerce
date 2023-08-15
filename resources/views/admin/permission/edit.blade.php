@extends('admin.layouts.app')
@section('content')
    <div class="page-content">
        <section class="contact-area pb-5">
            <div class="container">
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
                    <div class="col-md-4 offset-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div>
                                        <h5 class="mb-3 mb-md-0">Permissions > <span class="text-secondary">Edit Permission</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('permission.update')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$permission->id}}">
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <label for="name" class="font-weight-bold">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   placeholder="Enter Name"
                                                   name="name" value="{{$permission->name}}" id="name" required>
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="guard_name" class="font-weight-bold">Guard Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   placeholder="Enter Permission Name"
                                                   name="guard_name" value="{{$permission->guard_name}}" id="guard_name" required>
                                        </div>
                                        <div class="col-md-12 mt-4 text-right">
                                            <button type="submit" class="btn btn-primary" name="submit">
                                                <i class="fa-solid fa-floppy-disk"></i> Submit
                                            </button>
                                            <button type="button" class="btn btn-light px-4 py-2"
                                                    onclick="window.location.href='{{route('permission')}}'">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
