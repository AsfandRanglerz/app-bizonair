@extends('front_site.master_layout')
@section('content')

    <body class="reset-password-page">
    <main id="maincontent" class="page-main">
        <h4 class="my-2 text-center">Reset Your Account Password</h4>
        <div class="container px-md-3 px-2">
            <div class="reset-password">
                <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                     role="alert">
                </div>
                <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                     role="alert">
                </div>
                <form id="passwordReset" method="POST" action="{{url('/reset-password')}}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <h3 class="mb-0 text-center">Please enter the 6-digit verification code we sent via SMS:</h3>
                        <p class="mt-0 mb-2 text-center">(we want to make sure it's you before we contact our movers) *</p>
                        <label class="d-none">OTP</label>
                        <div class="mb-2">
                            <div class="row mx-0 mb-2 error-message-box">
                                <div class="col-2 px-1">
                                    <input type="text" autocomplete="off" maxLength="1" name="digit_1" size="1" min="0" max="9"
                                           pattern="[0-9]{1}" class="form-control verify-field"/>
                                </div>
                                <div class="col-2 px-1">
                                    <input type="text" autocomplete="off" maxLength="1" name="digit_2" size="1" min="0" max="9"
                                           pattern="[0-9]{1}" class="form-control verify-field"/>
                                </div>
                                <div class="col-2 px-1">
                                    <input type="text" autocomplete="off" maxLength="1" name="digit_3" size="1" min="0" max="9"
                                           pattern="[0-9]{1}" class="form-control verify-field"/>
                                </div>
                                <div class="col-2 px-1">
                                    <input type="text" autocomplete="off" maxLength="1" name="digit_4" size="1" min="0" max="9"
                                           pattern="[0-9]{1}" class="form-control verify-field"/>
                                </div>
                                <div class="col-2 px-1">
                                    <input type="text" autocomplete="off" maxLength="1" name="digit_5" size="1" min="0" max="9"
                                           pattern="[0-9]{1}" class="form-control verify-field"/>
                                </div>
                                <div class="col-2 px-1">
                                    <input type="text" autocomplete="off" maxLength="1" name="digit_6" size="1" min="0" max="9"
                                           pattern="[0-9]{1}" class="form-control verify-field"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-none">Email</label>
                        <input id="email" type="email" class="form-control" placeholder="example@gmail.com *" name="email" readonly>
                    </div>
                    <div class="form-group position-relative">
                        <label class="d-none">Password</label>
                        <input type="password" id="password" class="form-control" placeholder="New Password *"
                               name="password" required="required">
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group position-relative">
                        <label class="d-none">Confirm Password</label>
                        <input id="password_confirmation" type="password" class="form-control"
                               name="password_confirmation" placeholder="confirm password *">
                        <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div align="center">
                        <button class="btn submit-btn" type="submit" id="resetPassword">Reset Password
                        </button>
                    </div>
                    <button disabled class="btn-pro d-none red-btn"><span
                            class="spinner-border  spinner-border-sm mr-1" role="status"
                            aria-hidden="true"></span>Processing
                    </button>
                </form>
            </div>
        </div>
    </main>
    </body>

@endsection
@push('js')
    <script>
        $("#passwordReset").validate({
            onkeyup: function (element) {
                var $element = $(element);
                $element.valid();
            },
            rules: {
                email: {
                    required: true
                },
                digit_1: {
                    required: true
                },
                digit_2: {
                    required: true
                },
                digit_3: {
                    required: true
                },
                digit_4: {
                    required: true
                },
                digit_5: {
                    required: true
                },
                digit_6: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: '#password'
                },
            },
            messages: {
                email: {
                    required: "Email is required",
                    email: "Please enter a valid email"
                },
                digit_1: {
                    required: ""
                },
                digit_2: {
                    required: ""
                },
                digit_3: {
                    required: ""
                },
                digit_4: {
                    required: ""
                },
                digit_5: {
                    required: ""
                },
                digit_6: {
                    required: ""
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                password_confirmation: {
                    required: "Please enter the confirm password.",
                    minlength: "Password do no match",
                    equalTo: "Please enter the same password as above"
                },
            },
            errorClass: 'is-invalid error',
            validClass: 'is-valid',
            errorPlacement: function (error, element) {
                var elem = $(element);
                if (elem.attr('name') == 'digit_1') {
                    element2 = elem.closest('.error-message-box');
                    error.insertAfter(element2);
                } else if (elem.attr('name') == 'digit_2') {
                    element2 = elem.closest('.error-message-box');
                    error.insertAfter(element2);
                } else if (elem.attr('name') == 'digit_3') {
                    element2 = elem.closest('.error-message-box');
                    error.insertAfter(element2);
                } else if (elem.attr('name') == 'digit_4') {
                    element2 = elem.closest('.error-message-box');
                    error.insertAfter(element2);
                } else if (elem.attr('name') == 'digit_5') {
                    element2 = elem.closest('.error-message-box');
                    error.insertAfter(element2);
                } else if (elem.attr('name') == 'digit_6') {
                    element2 = elem.closest('.error-message-box');
                    error.insertAfter(element2);
                } else {
                    error.insertAfter(element);
                }
            }
        });
        var optionsreset = {
            dataType: 'Json',
            beforeSubmit: function (arr, $form) {
                $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                $form.find('button[type=submit]').prop('disabled', true);
                $('#resetPassword').addClass('d-none');
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
                $('#resetPassword').removeClass('d-none');
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
                    $('#alert-error').show().fadeOut(5500);
                } else if (response.feedback === 'true') {
                    // $('html, body').animate({scrollTop:0}, 'slow');

                    $('#resetPassword').attr('disabled');
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
                $('#resetPassword').removeClass('d-none');
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
        $('#passwordReset').ajaxForm(optionsreset);

        /*OTP*/
        const $inp = $(".verify-field");

        $inp.on({
            paste(ev) { // Handle Pasting

                const clip = ev.originalEvent.clipboardData.getData('text').trim();
                // Allow numbers only
                if (!/\d{6}/.test(clip)) return ev.preventDefault(); // Invalid. Exit here
                // Split string to Array or characters
                const s = [...clip];
                // Populate inputs. Focus last input.
                $inp.val(i => s[i]).eq(5).focus();
            },
            input(ev) { // Handle typing

                const i = $inp.index(this);
                if (this.value) $inp.eq(i + 1).focus();
            },
            keydown(ev) { // Handle Deleting

                const i = $inp.index(this);
                if (!this.value && ev.key === "Backspace" && i) $inp.eq(i - 1).focus();
            }
        });
        /*OTP*/
    </script>
@endpush
