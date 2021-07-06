@extends('front_site.master_layout')

@section('content')
    <body class="dashboard">
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->
        <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper">


                <div class="d-container">
                    <span class="main-heading my-2">{{$title}}</span>
                    <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                         role="alert">
                    </div>
                    <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                         role="alert">
                    </div>
                    <div class="create-account">
                        <form id="inviteForm" method="POST" action="{{route('invite-member-via-email')}}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6 offset-md-3">
                                    <div class="form-row">
                                        <div class="form-group col-xl-12 col-md-12">
                                            <input type="email" value="{{ old('email') }}"
                                                   name="email" id="email" class="form-control"
                                                   placeholder="Email - example@email.com">
                                            <small class="text-danger" id="email_error"></small>
                                        </div>
                                        <div class="form-group col-xl-12 col-lg-12" align="center">
                                            <button class="verify-btn red-btn" type="submit" id="accoutn_btn" disabled>Invite A New Member
                                            </button>
                                            <button type="button" disabled class="btn-pro d-none red-btn"><span
                                                    class="spinner-border  spinner-border-sm mr-1" role="status"
                                                    aria-hidden="true"></span>Processing
                                            </button>
                                        </div>
                                    </div>
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

    <script>
        $(document).ready(function () {
            var options = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
                    $('#accoutn_btn').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#accoutn_btn').removeClass('d-none');
                    $form.find('button[type=submit]').prop('disabled', false);
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
                        $('html, body').animate({scrollTop: 0}, 'slow');
                        $('#alert-error').html(response.custom_msg);
                        $('#alert-error').show();
                    } else if (response.feedback === 'true') {
                        // $('html, body').animate({scrollTop: 0}, 'slow');
                        toastr.success(response.custom_msg);
                        $('#alert-success').html(response.custom_msg);
                        $('#alert-success').show();
                    } else {
                        $('#alert-error').hide();
                        $('html, body').animate({scrollTop: 0}, 'slow');
                        $('#accoutn_btn').attr('disabled');
                        // $('#alert-success').html(response.msg);
                        // $('#alert-success').show();
                        toastr.success(response.msg);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                },

                error: function (jqXHR, exception) {
                    $("#loader").hide();
                    $('button[type=submit]').prop('disabled', false);
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#accoutn_btn').removeClass('d-none');
                    $form.find('button[type=submit]').prop('disabled', false);
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
            $('#inviteForm').ajaxForm(options);
        });
    </script>
@endpush
