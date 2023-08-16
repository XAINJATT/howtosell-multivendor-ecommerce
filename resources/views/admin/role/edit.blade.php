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
                                    <h5 class="mb-3 mb-md-0">Roles > <span class="text-secondary">Edit Role</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('role.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $role->id }}">
                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <label for="name" class="font-weight-bold">Role Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Role Name" name="name" value="{{ $role->name }}" id="name" required>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label class="font-weight-bold text-black" for="permission">Permissions <span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="permission[]" id="permission" multiple required>
                                            <option value="" disabled>Select permissions</option>
                                            @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}" {{ $role->permissions->contains('id', $permission->id) ? 'selected' : '' }}>
                                                {{ $permission->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-4 text-right">
                                        <button type="submit" class="btn btn-primary" name="submit">
                                            <i class="fa-solid fa-floppy-disk"></i> Save Changes
                                        </button>
                                        <a href="{{ route('role') }}" class="btn btn-light px-4 py-2">Cancel</a>
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