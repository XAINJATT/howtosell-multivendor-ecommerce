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
                                        <h5 class="mb-3 mb-md-0">Cities > <span class="text-secondary">Edit City</span></h5>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $subCitiesArray = $city[0]->sub_cities != '' ? explode(",", $city[0]->sub_cities) : array();
                            ?>
                            <div class="card-body">
                                <form action="{{route('city.update')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$city[0]->id}}">
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <label for="city" class="font-weight-bold">City <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   placeholder="Enter City"
                                                   name="city" value="{{$city[0]->city}}" id="city" required>
                                            @error('city')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label for="sub_cities" class="font-weight-bold">Sub Cities</label>
                                            <select class="form-control select2" name="sub_cities[]" id="sub_cities" multiple>
                                                <option value="" disabled="disabled">Select City</option>
                                                @foreach($Cities as $index => $value)
                                                    <option value="{{$value->id}}" {{ in_array($value->id, $subCitiesArray) ? 'selected' : '' }}>{{$value->city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-4 text-right">
                                            <button type="submit" class="btn btn-primary" name="submit">
                                                <i class="fa-solid fa-floppy-disk"></i> Submit
                                            </button>
                                            <button type="button" class="btn btn-light px-4 py-2"
                                                    onclick="window.location.href='{{route('city')}}'">
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
