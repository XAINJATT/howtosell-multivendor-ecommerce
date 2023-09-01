@extends('admin.layouts.app')
@section('content')
    <div class="page-content">
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
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="mb-3 mb-md-0">Settings > <span
                                            class="text-secondary">Edit</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('setting.update') }}" method="post">
                            @csrf
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <label for="email_template" class="font-weight-bold">Email Template </label>
                                    <textarea name="email_template">

                                    </textarea>
                                </div>
                            
                                <div class="col-md-12 mt-2">
                                    <label for="STRIPE_PUBLIC_KEY" class="font-weight-bold">STRIPE PUBLIC KEY </label>
                                    <input type="text" class="form-control" placeholder="Enter STRIPE PUBLIC KEY" name="STRIPE_PUBLIC_KEY" id="STRIPE_PUBLIC_KEY">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="STRIPE_SECRET_KEY" class="font-weight-bold">STRIPE SECRET KEY </label>
                                    <input type="text" class="form-control" placeholder="Enter STRIPE SECRET KEY" name="STRIPE_SECRET_KEY" id="STRIPE_SECRET_KEY">
                                </div>
                                
                                <div class="col-md-12 text-right mt-3">
                                    <input type="submit" class="btn btn-primary" id="saveSettingsBtn"
                                           value="Save"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.tiny.cloud/1/i5qmxl137r5zeebnoqa6n5z9yjlxi59kxzs5kpdylbf1j5e7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant"))
    });
  </script>
@endsection
