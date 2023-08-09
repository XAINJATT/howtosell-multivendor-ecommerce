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
            <div class="col-md-8 offset-md-2 grid-margin stretch-card mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="mb-3 mb-md-0">Change Password</h5>
                            </div>
                        </div>
                    </div>
                    <form action="{{route('updatePassword')}}" enctype="multipart/form-data" id="changePassword"
                          method="post">
                        @csrf
                        <div class="card-body mb-0">
                            {{--General Detals - Start--}}
                            <div class="row mb-0">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="font-weight-bold text-black">Password <span
                                                class="text-danger">*</span></label>
                                    <input type="password" class="form-control"
                                           name="password" id="password"
                                           placeholder="Enter Password" required>
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="font-weight-bold text-black">Password
                                        Confirmation <span
                                                class="text-danger">*</span></label>
                                    <input type="password" class="form-control"
                                           name="password_confirmation" id="password_confirmation"
                                           placeholder="Enter Confirm Password" required
                                    >
                                    @error('password_confirmation')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right mb-0">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="fa-solid fa-floppy-disk"></i> Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection