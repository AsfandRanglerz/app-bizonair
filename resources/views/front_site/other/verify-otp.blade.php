@extends('front_site.master_layout')
@section('content')
    <body>
        <main class="py-2 page-main">
                <div class="bg-white popup-center verification-code">
                    <h3 class="mb-0 text-center">Please enter the 6-digit verification code we sent via SMS:</h3>
                    <p class="text-center">(we want to make sure it's you before we contact our movers)</p>
                    <div class="alert alert-success text-center" id='alert-success-verify' style="display: none"
                         role="alert">
                    </div>
                    <div class="alert alert-danger text-center" id='alert-error-verify' style="display: none"
                         role="alert">
                    </div>
                    <form id="verify-otp" name="verify-otp" method="POST" action="{{route('verify-email')}}">
                        @csrf
                        <input type="hidden" class="form-control" name="verifyOtp" value="{{$code}}">
                    <div class="row mx-0">
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" name="digit-1" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" name="digit-2" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" name="digit-3" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" name="digit-4" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" name="digit-5" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" name="digit-6" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <button class="btn red-btn" id="otp-create" type="submit">Verify</button>
                        <p class="mt-3 mb-0">Didn't receive the code?</p>
                        <p class="mb-0"><a href="{{route('email-confirmation')}}" class="red-link">Send code again</a></p>
{{--                        <p class="mb-0"><a href="#" class="red-link">Change phone number</a></p>--}}
                    </div>
                    </form>
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
                    $('#otp-create').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-error-verify').hide();
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-verify').hide();
                    $('#alert-error-verify').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#otp-create').removeClass('d-none');
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
                        $('#alert-error-verify').html(response.custom_msg);
                        $('#alert-error-verify').show().fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        // $('html, body').animate({scrollTop:0}, 'slow');

                        $('#otp-create').attr('disabled');
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
                    $('#alert-success-verify').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#otp-create').removeClass('d-none');
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
                    $('#alert-error-verify').html(msg);
                    $('#alert-error-verify').show();
                },

            };
            $('#verify-otp').ajaxForm(options);
        });
    </script>

@endpush
