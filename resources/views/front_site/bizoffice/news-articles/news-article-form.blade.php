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
            <div id="page-content-wrapper" >
                <div class="d-container py-2">
                    <span class="main-heading">News & Articles</span>
                    <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                         role="alert">
                    </div>
                    <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                         role="alert">
                    </div>
                    <div class="create-account">
                        <form id="addNewsArticleForm" method="POST" action="{{route('create-blog')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text"
                                           name="title" id="title" class="form-control"
                                           placeholder="Title - Enter title">
                                    <small class="text-danger" id="title_error"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="mb-0 form-group col-md-12 px-0 career-img-drop-outer attachment-img-file">
                                        <label class="label" for="image">Image <span class="required">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile" style="color: #A52C3E;"><span class="fa fa-upload"></span></label>
                                        </div>
                                    </div>
                                    <small class="text-danger" id="image_error"></small>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <textarea name="description" id="description" class="form-control ckeditor" style="min-height:200px;"></textarea>

                                </div>

{{--                                <div class="form-group col-md-4">--}}
{{--                                    <label>Date <span class="required">*</span></label>--}}
{{--                                    <input type="text" autocomplete="off"--}}
{{--                                           name="date" id="date"--}}
{{--                                           class="form-control closingdatepicker"--}}
{{--                                           placeholder="Publish Date">--}}
{{--                                    <small class="text-danger" id="date_error"></small>--}}
{{--                                </div>--}}

                                <div class="form-group col-md-4">
                                    <select name="journal_type" id="journal_type" class="form-control">
                                        <option value="" selected disabled>Type (Mandatory)</option>
                                        @foreach(\App\JournalType::all() as $type)
                                        <option value="{{$type->name}}">{{$type->name}}</option>
                                        @endforeach

                                    </select>
                                    <small class="text-danger" id="journal_type_error"></small>

                                </div>
                                <div class="form-group col-xl-12 col-lg-12">
                                    <button class="verify-btn red-btn" type="submit" id="blog_create_btn">Create Post
                                    </button>
                                    <button type="button" disabled class="btn-pro d-none red-btn"><span
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
    <script src="{{$ASSET}}/front_site/js/timepicker.min.js"></script>

    <script>
        $(document).ready(function () {
            // // // console.log('ready')
            // $('.closingdatepicker').datepicker({
            //     startDate: "0d",
            //     autoclose: true,
            //     format: 'yyyy-mm-dd',
            //     // minDate:0,
            // })



            var options = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
                    $('#blog_create_btn').addClass('d-none');
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
                    $('#blog_create_btn').removeClass('d-none');
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

                        $('#blog_create_btn').attr('disabled');
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
                    $('#blog_create_btn').removeClass('d-none');
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
            $('#addNewsArticleForm').ajaxForm(options);
        });
    </script>
@endpush

