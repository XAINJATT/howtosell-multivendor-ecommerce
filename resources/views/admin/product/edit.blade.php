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
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div>
                                        <h5 class="mb-3 mb-md-0">Products > <span class="text-secondary">Edit Product</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <input type="hidden" name="old_product_image" value="{{$product->product_image}}">
                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <label for="name" class="font-weight-bold">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{$product->name}}" id="name" required>
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="font-weight-bold text-black" for="category">Category <span
                                                        class="text-danger">*</span></label>
                                            <select class="form-control select2" name="category" id="category" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $index => $value)
                                                    <option value="" disabled>Select Category</option>
                                                    @if($product->category_id)
                                                        <option value="{{$value->id}}" {{$product->category_id == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                                    @else
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="price" class="font-weight-bold">Price <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" placeholder="Enter Name" name="price" id="price" value="{{$product->price}}" required>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="discounted_price" class="font-weight-bold">Discounted Price <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" placeholder="Enter Name" name="discounted_price" id="discounted_price" value="{{$product->discounted_price}}" required>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="short_description" class="font-weight-bold">Short Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="short_description" rows="3" required>{{$product->short_description}}</textarea>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="long_description" class="font-weight-bold">Long Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="long_description" rows="3" required>{{$product->long_description}}</textarea>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label class="font-weight-bold text-black" for="Colors">Colors <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="Colors[]" id="Colors" multiple required>
                                                <option value="" disabled>Select Colors</option>
                                                @foreach($Colors as $color)
                                                    <option value="{{$color->id}}"
                                                        {{ $product->ProductColors->contains('color_id', $color->id) ? 'selected' : '' }}>
                                                        {{$color->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label class="font-weight-bold text-black" for="Sizes">Sizes <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="Sizes[]" id="Sizes" multiple required>
                                                <option value="" disabled>Select Sizes</option>
                                                @foreach($Sizes as $size)
                                                    <option value="{{$size->id}}"
                                                        {{ $product->ProductSizes->contains('size_id', $size->id) ? 'selected' : '' }}>
                                                        {{$size->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mt-2">
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
                                                <input type="file" class="input-style" name="image" onchange="ReadUrl(this, 'image_preview', 'image_browse');">
                                            </label>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="other_images">Other Images <span class="text-danger">(If you want to change please upload all image again)</span></label>
                                            <input type="file" class="form-control" name="other_images[]" id="other_images" multiple />
                                            @if(count($product->ProductImages) > 0)
                                            @foreach($product->ProductImages as $pImage)
                                                <img src="{{asset($pImage->image)}}" class="mt-2" alt="" width="100px" height="50px">
                                            @endforeach
                                                @endif
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="soh" class="font-weight-bold">Starting Quantity <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" placeholder="Enter Name" name="soh" id="soh" value="{{$product->soh}}">
                                        </div>
                                        <div class="col-md-12 mt-4 text-right">
                                        <button type="submit" class="btn btn-primary submitBtn" name="submit">
                                                <i class="fa-solid fa-floppy-disk"></i> Submit
                                            </button>
                                            <button type="button" class="btn btn-light px-4 py-2"
                                                    onclick="window.location.href='{{route('product')}}'">
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
