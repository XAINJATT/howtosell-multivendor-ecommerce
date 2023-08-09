@extends('admin.layouts.app')
@section('content')
    <div class="page-content" id="editJob">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Ceo Event Management > <span class="text-primary">Edit User</span></h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <button type="button" class="btn btn-primary"
                        onclick="window.location.href='{{route('users')}}';">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Back
                </button>
            </div>
        </div>
        <form action="{{route('users.update')}}" method="post" id="editJobForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="job_id" value="{{$id}}"/>
            <!-- Start Contact Area -->
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
                            <div id="success-alert" class="alert alert-success" style="display: none;"></div>
                            <div id="error-alert" class="alert alert-danger" style="display: none;"></div>

                            @if((\Carbon\Carbon::parse($UserDetails[0]->visa_issue_expiry) <= \Carbon\Carbon::now()) || (\Carbon\Carbon::parse($UserDetails[0]->emirates_id_expiry_date) <= \Carbon\Carbon::now()))
                                <div class="alert alert-danger">Some documents are expired!</div>
                            @endif
                        </div>

                        {{--Job Details--}}
                        <div class="col-md-8 grid-margin stretch-card ">
                            <div class="card">
                                <div class="card-body">
                                    {{--Row 1--}}
                                    <div class="row">
                                        <!--First Name-->
                                        <div class="col-md-4 mt-2">
                                            <label for="firstname">First Name</label>
                                            <input type="text" class="form-control"
                                                   placeholder="Enter First Name"
                                                   value="{{$UserDetails[0]->firstname}}"
                                                   name="firstname" id="firstname" required>
                                        </div>
                                        <!--Last Name-->
                                        <div class="col-md-4 mt-2">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control"
                                                   placeholder="Enter Last Name"
                                                   value="{{$UserDetails[0]->lastname}}"
                                                   name="lastname" id="lastname" required>
                                        </div>
                                        <!--Mobile-->
                                        <div class="col-md-4 mt-2">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control"
                                                   onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                   placeholder="Enter mobile"
                                                   value="{{$UserDetails[0]->mobile}}"
                                                   name="mobile" id="mobile" required>
                                        </div>
                                    </div>
                                    {{--Row 2--}}
                                    <div class="row">
                                        <!--Qualification-->
                                        <div class="col-md-4 mt-2">
                                            <label for="qualification">Qualification</label>
                                            <input type="text" class="form-control"
                                                   placeholder="Enter Qualification"
                                                   value="{{$UserDetails[0]->qualification}}"
                                                   name="qualification" id="qualification" required>
                                        </div>
                                        {{--Rating--}}
                                        <div class="col-md-4 mt-2">
                                            <label for="rating">Rating</label>
                                            <input type="number" min="0" max="5" step="any" class="form-control"
                                                   placeholder="Enter Rating"
                                                   value="{{$UserDetails[0]->rating}}"
                                                   name="rating" id="rating" required>
                                        </div>
                                        {{--Vaccination Status--}}
                                        <div class="col-md-4 mt-2">
                                            <label for="vaccination_status">Vaccination Status</label>
                                            <select class="form-control select2" name="vaccination_status"
                                                    id="vaccination_status" required>
                                                <option value="">Select</option>
                                                <option value="partially vaccinated" <?php if ($UserDetails[0]->vaccination_status == "0") {
                                                    echo "selected";
                                                } ?>>Partially Vaccinated
                                                </option>
                                                <option value="fully vaccinated" <?php if ($UserDetails[0]->vaccination_status == "1") {
                                                    echo "selected";
                                                } ?>>Fully Vaccinated
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    {{--Row 3--}}
                                    <div class="row">
                                        {{--Gender--}}
                                        <div class="col-md-4 mt-2">
                                            <label for="gender">Gender</label>
                                            <select class="form-control select2" name="gender" id="gender" required>
                                                <option value="">Select</option>
                                                <option value="Male" <?php if ($UserDetails[0]->gender == "Male") {
                                                    echo "selected";
                                                } ?>>Male
                                                </option>
                                                <option value="Female" <?php if ($UserDetails[0]->gender == "Female") {
                                                    echo "selected";
                                                } ?>>Female
                                                </option>
                                            </select>
                                        </div>
                                        {{--Visa--}}
                                        <div class="col-md-4 mt-2">
                                            <label for="visa">Visa
                                                @if($UserDetails[0]->visa != "")
                                                    <a href="<?= asset('public/storage/user-documents') . '/' . $UserDetails[0]->visa;?>"
                                                       download="{{$UserDetails[0]->visa}}"><i
                                                                class="fa fa-download float-right"
                                                                aria-hidden="true"></i></a></label>
                                            @endif
                                            <input type="hidden" class="form-control"
                                                   value="{{$UserDetails[0]->visa}}"
                                                   name="visa" id="visa">
                                            <input type="file" class="form-control"
                                                   name="new_visa" id="new_visa">
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label for="visa_issue_date">Visa Issue Date</label>
                                                <input type="date" class="form-control"
                                                       name="visa_issue_date" id="visa_issue_date" value="{{\Carbon\Carbon::parse($UserDetails[0]->visa_issue_date)->format('Y-m-d')}}">
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label for="visa_issue_expiry">Visa Expiry Date</label>
                                            <input type="date" class="form-control"
                                                   name="visa_issue_expiry" id="visa_issue_expiry" value="{{\Carbon\Carbon::parse($UserDetails[0]->visa_issue_expiry)->format('Y-m-d')}}">
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label for="gender">Language</label>
                                            <select class="form-control select2" name="language[]" id="language"
                                                    multiple required>
                                                <option value="">Select</option>
                                                <?php
                                                $userLanguages = array();
                                                if ($UserDetails[0]->languages != "") {
                                                    $userLanguages = explode(',', $UserDetails[0]->languages);
                                                }
                                                ?>
                                                @foreach($languages as $language)
                                                    <option value="{{$language->id}}" <?php if (in_array($language->id, $userLanguages)) {
                                                        echo "selected";
                                                    } ?>>{{$language->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--Row 4--}}
                                    <div class="row">
                                        {{--Vaccination Certificate--}}
                                        <div class="col-md-4 mt-2">
                                            <label for="vaccination_certificate">Vaccination Certificate
                                                @if($UserDetails[0]->vaccination_certificate != "")
                                                    <a href="<?= asset('public/storage/user-documents') . '/' . $UserDetails[0]->vaccination_certificate; ?>"
                                                       download="{{$UserDetails[0]->vaccination_certificate}}"><i
                                                                class="fa fa-download float-right"
                                                                aria-hidden="true"></i></a>
                                                @endif
                                            </label>
                                            <input type="hidden" class="form-control"
                                                   value="{{$UserDetails[0]->vaccination_certificate}}"
                                                   name="vaccination_certificate" id="vaccination_certificate">
                                            <input type="file" class="form-control"
                                                   name="new_vaccination_certificate"
                                                   value="{{$UserDetails[0]->vaccination_certificate}}"
                                                   id="new_vaccination_certificate">
                                        </div>
                                        {{--Emirates id--}}
                                        <div class="col-md-4 mt-2">
                                            <label for="emirates_id">Emirates Id
                                                @if($UserDetails[0]->emirates_id != "")
                                                    <a href="<?= asset('public/storage/user-documents') . '/' . $UserDetails[0]->emirates_id;?>"
                                                       download="{{$UserDetails[0]->emirates_id}}"><i
                                                                class="fa fa-download float-right"
                                                                aria-hidden="true"></i></a></label>
                                            @endif
                                            <input type="hidden" class="form-control"
                                                   value="{{$UserDetails[0]->emirates_id}}"
                                                   name="emirates_id" id="emirates_id">
                                            <input type="file" class="form-control"
                                                   name="new_emirates_id" id="new_emirates_id">
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label for="emirates_id_issue_date">Emirates Id Issue Date</label>
                                            <input type="date" class="form-control"
                                                   name="emirates_id_issue_date" id="emirates_id_issue_date" value="{{\Carbon\Carbon::parse($UserDetails[0]->emirates_id_issue_date)->format('Y-m-d')}}">
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label for="emirates_id_expiry_date">Emirates Id Expiry Date</label>
                                            <input type="date" class="form-control"
                                                   name="emirates_id_expiry_date" id="emirates_id_expiry_date" value="{{\Carbon\Carbon::parse($UserDetails[0]->emirates_id_expiry_date)->format('Y-m-d')}}">
                                        </div>
                                        {{--Passport--}}
                                        <div class="col-md-4 mt-2">
                                            <label for="new_passport">Passport
                                                @if($UserDetails[0]->passport != "")
                                                    <a href="<?= asset('public/storage/user-documents') . '/' . $UserDetails[0]->passport;?>"
                                                       download="{{$UserDetails[0]->passport}}"><i
                                                                class="fa fa-download float-right"
                                                                aria-hidden="true"></i></a></label>
                                            @endif
                                            <input type="hidden" class="form-control"
                                                   value="{{$UserDetails[0]->passport}}"
                                                   name="passport" id="passport">
                                            <input type="file" class="form-control"
                                                   name="new_passport" id="new_passport">
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label for="passport_issue_date">Passport Issue Date</label>
                                            <input type="date" class="form-control"
                                                   name="passport_issue_date" id="passport_issue_date" value="{{\Carbon\Carbon::parse($UserDetails[0]->passport_issue_date)->format('Y-m-d')}}">
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label for="passport_expiry_date">Passport Expiry Date</label>
                                            <input type="date" class="form-control"
                                                   name="passport_expiry_date" id="passport_expiry_date" value="{{\Carbon\Carbon::parse($UserDetails[0]->passport_expiry_date)->format('Y-m-d')}}">
                                        </div>
                                        {{--cv--}}
                                        <div class="col-md-4 mt-2">
                                            <label for="cv">Cv
                                                @if($UserDetails[0]->cv != "")
                                                    <a href="<?= asset('public/storage/user-documents') . '/' . $UserDetails[0]->cv;?>"
                                                       download="{{$UserDetails[0]->cv}}"><i
                                                                class="fa fa-download float-right"
                                                                aria-hidden="true"></i></a>
                                            </label>
                                            @endif
                                            <input type="hidden" class="form-control"
                                                   value="{{$UserDetails[0]->cv}}"
                                                   name="cv" id="cv">
                                            <input type="file" class="form-control"
                                                   name="new_cv" id="new_cv">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary mt-5" name="submit">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Job Preference/Experience - START --}}
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        Job Experience/Preferences
                                    </h6>
                                    <div class="table-responsive">
                                        <table id="admin_user_experience_table" class="table table-bordered w-100">
                                            <thead>
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th style="width: 55%;">Job Type</th>
                                                <th style="width: 40%;">Experience</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $counter = 1;
                                            @endphp
                                            @foreach($JobPreference as $index => $value)
                                                <tr>
                                                    <td>{{$counter}}</td>
                                                    <td>{{$value->title}}</td>
                                                    @if($value->job_experience == 0)
                                                        <td>N/A</td>
                                                    @else
                                                        <td>{{$value->job_experience}} years</td>
                                                    @endif
                                                </tr>
                                                @php
                                                    $counter++;
                                                @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(count($Images) > 0)
                        <div class="col-md-12 grid-margin stretch-card ">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Gallery Image -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="card-title">
                                                User Gallery
                                            </h6>
                                            <div class="row" id="">
                                                @foreach ($Images as $key => $image)
                                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                                        <div class="img-upload-preview">
                                                            <img src="{{ asset('public/storage/user-gallery' . '/' . $image->image) }}"
                                                                 alt="Product Gallery Image" class="img-fluid" height="200">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection
