@extends('front_site.master_layout')



@section('content')

    <body class="dashboard">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/css/timepicker.min.css">
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->

        <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper">

                <div class="d-container">
                    <span class="main-heading my-2">News & Articles</span>
                    <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                         role="alert">
                    </div>
                    <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                         role="alert">
                    </div>
                    <div class="create-account">
                        <form id="updateNewsArticleForm" method="POST" action="{{route('update-news-article')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $info->id }}">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label  class="d-none font-500">Title <span class="required">(Mandatory)</span></label>
                                        <input type="text" placeholder="Title (Mandatory) - Enter title"
                                               name="title" id="title" value="{{ $info->title }}" class="form-control" required
                                        >
                                        <small class="text-danger" id="title_error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="d-none font-500">Type<span class="required">(Mandatory)</span></label>

                                        <select name="journal_type" id="journal_type" class="form-control" required>
                                            <option value=""></option>
                                            <option disabled>Type (Mandatory)</option>
                                            <option value="{{ $info->journal_type_name }}" selected>{{ $info->journal_type_name }}</option>
                                            @foreach(\App\JournalType::all() as $type)
                                                <option value="{{$type->name}}" @if($type->name == $info->journal_type_name) selected @endif>{{$type->name}}</option>
                                            @endforeach

                                        </select>
                                        <small class="text-danger" id="journal_type_error"></small>

                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="font-500">Description (Optional)</label>
                                        <textarea name="description" id="editor1" placeholder="Description" class="form-control"
                                                  style="min-height:105px">{!! $info->description !!}</textarea>
                                    </div>

                                    <div class="mb-0 form-group col-md-6 career-img-drop-outer attachment-img-file">
                                        <label class="font-500">Image <span class="required">(Mandatory)</span></label>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile"><span class="fa fa-upload"></span></label>
                                            <small class="text-danger" id="image_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-group col-xl-12 col-lg-12">
                                        <button class="verify-btn red-btn" type="submit" id="blog_update_btn">Update Post
                                        </button>
                                        <button  disabled class="btn-pro d-none red-btn"><span
                                                class="spinner-border  spinner-border-sm mr-1" role="status"
                                                aria-hidden="true"></span>Processing
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </main>
    </body>

@endsection

@push('js')
<script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            $('#journal_type').select2({
                closeOnSelect: true,
                placeholder: "Type (Mandatory)"
            });

            ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });



            var options = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
                    $('#blog_update_btn').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-error').hide();
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#blog_update_btn').removeClass('d-none');
                    if (response.feedback === "false") {
                        $form.find('button[type=submit]').prop('disabled', false);
                        $('html, body').animate({scrollTop: ($('#' + Object.keys(response.errors)[0]).offset().top)}, 'slow');
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    } else if (response.feedback === "other_error") {
                        $form.find('button[type=submit]').prop('disabled', false);
                        $('html, body').animate({scrollTop: 0}, 'slow');
                        $('#' + response.id).html(response.custom_msg);
                    } else if (response.feedback === 'other') {
                        $form.find('button[type=submit]').prop('disabled', false);
                        $('html, body').animate({scrollTop: 0}, 'slow');
                        $('#alert-error').html(response.custom_msg);
                        $('#alert-error').show().fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        // $('html, body').animate({scrollTop:0}, 'slow');

                        $('#blog_update_btn').attr('disabled');
                        // $('#alert-success').html(response.msg);
                        // $('#alert-success').show().fadeOut(2500);

                        toastr.success(response.msg);

                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 1000);
                    }

                },

                error: function (jqXHR, exception) {
                    $("#loader").hide();
                    $('button[type=submit]').prop('disabled', false);
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#blog_update_btn').removeClass('d-none');
                    // form.find('button[type=submit]').html('<i aria-hidden="true" class="fa fa-check"></i> {{ __('Save') }}');
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not Connected.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error, Please try again later';
                    }
                    $('#alert-error').html(msg);
                    $('#alert-error').show();
                },

            };
            $('#updateNewsArticleForm').ajaxForm(options);
        });
    </script>
@endpush

