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
            <div id="page-content-wrapper" style="background: #d9eefe8c">

                <div class="d-container mx-3">
                    <span class="main-heading mt-3 mb-3">{{$title}}</span>
                    <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                         role="alert">
                    </div>
                    <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                         role="alert">
                    </div>
                    <div class="create-account">
                        <form id="addMeetingForm" method="POST" action="{{route('company-save-meeting')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{encrypt(session()->get('company_id'))}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Title <span class="required">*</span></label>
                                    <input type="text"
                                           name="title" id="title" class="form-control"
                                           placeholder="Enter meeting title" maxlength="100">
                                    <small class="text-danger" id="title_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Date <span class="required">*</span></label>
                                    <input type="text" autocomplete="off"
                                           name="meeting_date" id="meeting_date"
                                           class="form-control meetingdatepicker"
                                           placeholder="Set Meeting Date">
                                    <small class="text-danger" id="meeting_date_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Time <small class="font-500">(24 hours Format)</small> <span
                                            class="required">*</span></label>
                                    <input type="text"
                                           name="meeting_time" id="meeting_time"
                                           class="form-control bs-timepicker"
                                           placeholder="Set Meeting Time">
                                    <small class="text-danger" id="meeting_time_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Reminder Email <span class="required">*</span></label>
                                    <select name="reminde_before" id="reminde_before" class="form-control">
                                        <option value="" selected disabled>--- Reminders ---</option>
                                        {{--                                                @if(\App\Helpers\MeetingHelper::CheckTodayMeeting())--}}
                                        <option value="0">Today</option>
                                        {{--                                                @endif--}}
                                        <option value="1">1 day before meeting</option>
                                        <option value="2">2 days before meeting</option>
                                        <option value="3">3 days before meeting</option>
                                        <option value="4">4 days before meeting</option>
                                        <option value="5">5 days before meeting</option>
                                        <option value="6">6 days before meeting</option>
                                    </select>
                                    <small class="text-danger" id="reminde_before_error"></small>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Detail <span class="required">*</span></label>
                                    <textarea name="detail" id="detail" class="form-control" rows="6"
                                              placeholder="Enter Meeting Details"></textarea>
                                    <small class="text-danger" id="detail_error"></small>
                                </div>
                                <div class="form-group col-xl-12 col-lg-12">
                                    <button class="verify-btn red-btn" type="submit" id="accoutn_btn" disabled>Schedule Meeting
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
            // console.log('ready')
            $('.meetingdatepicker').datepicker({
                startDate: "0d",
                autoclose: true,
                format: 'dd-mm-yyyy',
                // minDate:0,
            })
            $('.bs-timepicker').timepicker();


            var options = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
                    $('#accoutn_btn').addClass('d-none');
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
                    $('#accoutn_btn').removeClass('d-none');
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

                        $('#accoutn_btn').attr('disabled');
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
                    $('#accoutn_btn').removeClass('d-none');
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
            $('#addMeetingForm').ajaxForm(options);
        });
    </script>
@endpush
