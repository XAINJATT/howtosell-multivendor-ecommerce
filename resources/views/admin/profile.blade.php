@extends('admin.layouts.app')
@section('content')
    <style type="text/css" rel="stylesheet">
        .upload_image_box {
            width: 70%;
            margin-left: 15%;
            margin-right: 15%;
            height: 146px;
            /*background-color: #16192F;*/
            background-clip: padding-box;
            border: 1px solid #2D3153;
            border-radius: 5px;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .upload_image_box.uploaded img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media only screen and (max-width: 767px) {
            .upload_image_box {
                width: 270px;
                height: 270px;
                margin: auto;
            }
        }

        @media only screen and (max-width: 390px) {
            .upload_image_box {
                width: 200px;
                height: 200px;
                margin: auto;
            }
        }
    </style>

    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Azer App > <span class="text-primary">EDIT PROFILE</span></h4>
            </div>
        </div>

        <div class="row" id="updateProfilePage">
            <div class="col-12">
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
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            Personal Details
                        </h6>
                        <?php
                            $Url = url('update-personal-details');
                        ?>
                        <form action="{{$Url}}" method="post" id="updatePersonalDetailsForm"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- Personal Details Fields --}}
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="firstName">
                                                    Name</label>
                                                <input type="text"
                                                       class="form-control"
                                                       name="name"
                                                       id="name"
                                                       value="{{$Profile[0]->name}}"
                                                       <?php if ($Role != 1) {
                                                           echo "disabled";
                                                       } ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary"
                                            name="updatePersonalDetails"
                                            id="updatePersonalDetails"><i
                                                class="fa fa-check"></i> Save
                                        Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            Account Security
                            <small>(You will be logout)</small>
                        </h6>
                        <?php
                            $Url = url('update-account-security');
                        ?>
                        <form method="post" action="{{$Url}}" id="changePasswordForm">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id"
                                   value="{{\Illuminate\Support\Facades\Auth::id()}}"/>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="newPassword">New
                                            Password</label>
                                        <input type="password" class="form-control"
                                               name="newPassword" id="newPassword"
                                               autocomplete="off"
                                               placeholder="New Password" required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="w-100" for="confirmPassword">Confirm
                                            Password</label>
                                        <input type="password" class="form-control"
                                               name="confirmPassword"
                                               id="confirmPassword"
                                               autocomplete="off"
                                               placeholder="New Password" required/>
                                        <span id="changePasswordError"
                                              class="text-small text-danger"
                                              style="display: none;">Passwords not matched</span>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary"
                                            name="updateSecurityDetails"
                                            id="updateSecurityDetails"><i
                                                class="fa fa-check"></i> Save
                                        Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
