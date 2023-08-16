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
                                        <h5 class="mb-3 mb-md-0">Roles > <span class="text-secondary">Create Role</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('role.store')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <label for="name" class="font-weight-bold">Role Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   placeholder="Enter Role Name"
                                                   name="name" id="name" required>
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label class="font-weight-bold text-black" for="Permissions">Permissions <span
                                                        class="text-danger">*</span></label>
                                            <select class="form-control select2" name="permission[]" id="permission" multiple required>
                                                <option value="" disabled>Select Permissions</option>
                                                @foreach($Permissions as $index => $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-4 text-right">
                                            <button type="submit" class="btn btn-primary submitBtn" name="submit">
                                                <i class="fa-solid fa-floppy-disk"></i> Submit
                                            </button>
                                            <button type="button" class="btn btn-light px-4 py-2"
                                                    onclick="window.location.href='{{route('role')}}'">
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
