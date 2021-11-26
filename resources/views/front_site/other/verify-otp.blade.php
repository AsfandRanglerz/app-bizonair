@extends('front_site.master_layout')
@section('content')
    <body>
        <main class="py-2 page-main">
                <div class="bg-white popup-center verification-code">
                    <h3 class="mb-0 text-center">Please enter the 6-digit verification code we sent via Email:</h3>
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
                            <input type="text" maxLength="1" name="digit_1" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" name="digit_2" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" name="digit_3" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" name="digit_4" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" name="digit_5" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" name="digit_6" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <button class="btn red-btn" id="otp-create" type="submit">Verify</button>
                    </div>
                    </form>
                    <div class="alert alert-success m-0 mb-2" id='alert-success-otp'
                         @if(!isset($_GET['from']))
                         style="display:none;"
                         @endif
                         role="alert">
                        @if(isset($_GET['from']) && $_GET['from'] == 'home')
                            Email has been sent successfully. Please confirm authenticity of your email address.
                            <br>If you are unable to find email, please;
                            <ol style="margin-left: 2em;">
                                <li>Recheck provided email address</li>
                                <li>Check the Spam/Junk folder in your emails</li>
                                <li>Get intouch with us at info@bizonair.com</li>
                            </ol>
                        @endif
                    </div>
                    <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error-otp'
                         style="display:none;"
                         role="alert">
                    </div>
                    <p class="mt-3 mb-0 text-center">Didn't receive the code?</p>
                    <form id="resendotp" method="POST" action="{{route('get-email-verification-code')}}">
                        @csrf
                        <input type="hidden" name="email" value="{{request()->email}}">
                        <div align="center">
                            <button type="submit" class="red-btn">Send code again</button>
                        </div>
                    </form>
                </div>
        </main>
    </body>
@endsection
@push('js')

    <script>
        $(document).ready(function () {
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
    <script>
        $(document).ready(function () {
            var options_resendotp = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $('#alert-success-otp').hide();
                    $('#alert-error-otp').hide();
                    $('#code').addClass('d-none');
                    // $('#verifyCodeForm').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                },
                success: function (data) {
                    $('#alert-success-otp').hide();
                    $('#alert-error-otp').hide();
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#code').removeClass('d-none');
                    if (response.feedback == 'false') {

                    } else if (response.feedback == 'invalid') {
                        $('#alert-error-otp').html(response.msg);
                        $('#alert-error-otp').show();
                        // setTimeout(() => {
                        // 	window.location.reload();
                        // }, 1000);
                    } else if (response.feedback == 'true') {
                        // $('#code').attr('disabled');
                        // $('#verifyCodeForm').removeClass('d-none')
                        $('#alert-success-otp').html(response.msg);
                        $('#alert-success-otp').show();
                        let email = $('#email').val();
                        $('#verifyemail').val(email);
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 1000);
                    }
                },
                error: function (jqXHR, exception) {
                    $('#alert-success-otp').hide();
                    $('#alert-error-otp').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#code').removeClass('d-none');
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
                    $('#alert-error-otp').html(msg);
                    $('#alert-error-otp').show();
                },

            };

            $('#resendotp').ajaxForm(options_resendotp);

        });
    </script>
@endpush
