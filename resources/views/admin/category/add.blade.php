@extends('admin.layouts.app')
@section('content')
<style>
        .label-style {
            border: 1px solid grey;
            border-radius: 7px;
            padding: 42px 33px;
        }

        .input-style {
            border: 1px grey !important;
            padding: 35px 10px 29px 0;
            display: none;
        }

        form div {
            margin-bottom: 0;
        }
    </style>
    <div class="page-content">
        <section class="contact-area pb-5">
            <div class="container">
                <div class="row justify-content-center">
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
                    <div class="col-8 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div>
                                        <h5 class="mb-3 mb-md-0">Categories > <span class="text-secondary">Create Category</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <label for="name" class="font-weight-bold">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" onchange="CheckForAdvanceDuplicateCategory('', this.value);"
                                                   placeholder="Enter Category"
                                                   name="name" id="name" required>
                                            <span class="error d-none duplicateCategoryError" id="duplicateCategoryError">The name has already been taken.</span>
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror

                                        </div>

                                        <div class="col-md-12 mt-2">
                                            <label for="image" class="font-weight-bold">Image <span
                                                        class="text-danger">*</span></label>
                                            <img src="" alt="" class="picture-src" id="image_preview"
                                                 onclick="$(this).next().trigger('click')"
                                                 style="width: 60%; display: none;">
                                            <label class="label-style" id="image_browse">
                                                <span class="d-flex justify-content-center align-items-center">
                                                    <span><i class="fa fa-2x fa-camera"></i></span>
                                                    <span>&nbsp;Browse</span>
                                                </span>
                                                <input type="file" class="input-style" name="image" onchange="ReadUrl(this, 'image_preview', 'image_browse');" required>
                                            </label>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                            <label for="parent_id" class="font-weight-bold">Parent Category</label>
                                            <select class="form-control select2" name="parent_id" id="parent_id">
                                                <option value="">Select</option>
                                                @foreach($Categories as $index => $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-4 text-right">
                                            <button type="submit" class="btn btn-primary submitBtn" name="submit">
                                                <i class="fa-solid fa-floppy-disk"></i> Submit
                                            </button>
                                            <button type="button" class="btn btn-light px-4 py-2"
                                                    onclick="window.location.href='{{route('category')}}'">
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
