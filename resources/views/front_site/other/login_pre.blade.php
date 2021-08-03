@extends('front_site.master_layout')
@section('content')
<body>
<main id="maincontent" class="py-2 page-main">
    <div class="mx-2 p-2 login-form popup-center">
        <span class="d-block text-center heading font-500">Login</span>
            <form name="Login" action="{{route('user-do-login-pre')}}" method="post" id="logForm">
                @csrf
            <div class="empty-div my-2"></div>
                @if(session()->has('message'))
                    <div class="alert alert-success mb-2 text-center"
                         role="alert">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(session()->has('invalid'))
                    <div class="alert alert-danger mb-2 text-center"
                         role="alert">
                        {{ session('invalid') }}
                    </div>
                @endif

                <div class="alert alert-danger mb-2 text-center" id='alert-error-login' style="display: none"
                     role="alert">
                </div>
            <div class="my-2" align="center">
                <img src="{{$ASSET}}/front_site/images/favicon.png" class="biz-logo">
            </div>
                @if(url()->previous() == url('login'))
                    <input type="hidden" class="form-control" name="previous_url" value="{{url('/')}}">
                @else
                    <input type="hidden" class="form-control" name="previous_url" value="{{url()->previous()}}">
                @endif
            <div class="form-group">
                <input type="email" class="form-control" name="email_login" id="emailid" placeholder="Email-example@gmail.com">
                <small class="text-white" id="email_login_error"></small>
            </div>
            <div class="form-group">
                <div class="position-relative d-flex align-items-center">
                    <input type="password" name="login_password" id="userPassword" class="form-control pr-4" placeholder="Password">
                    <span toggle="#userPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <small class="text-white" id="login_password_error"></small>
            </div>
            <div class="form-group text-center mb-0">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="rememberPassword">
                    <label class="custom-control-label" for="rememberPassword">Remember me</label>
                </div>

                <input type="submit" id="login-create" class="rounded px-4 my-1 red-btn login-btn" value="Login"><br>
                <a href="{{route('forgot-password')}}" class="font-500 red-link" disabled>Forgot your password?</a>
            </div>
            <p class="mb-0 text-center paragraph">Don't have an account? <a href="{{route('email-confirmation')}}"  class="font-500 red-link" disabled>Sign up</a></p>
        </form>
    </div>
</main>
</body>
@endsection
@push('js')
    <script>


        $(document).ready(function () {
            var validator = $("form[name='Login']").validate({
                onfocusout: function (element) {
                    var $element = $(element);
                    if ($element.prop('required')) {
                        this.element(element)
                    } else if ($element.val() != '') {
                        this.element($element)
                    } else {
                        $element.removeClass('is-valid');
                    }
                },
                rules: {
                    'email_login': {
                        required: true,
                    },
                    'login_password':{
                        required: true,
                    },
                    onkeyup: function (element) {
                        var $element = $(element);
                        $element.valid();
                    },
                },
                messages: {
                    'email_login': {
                        required: "Email is required"
                    },
                    'login_password': {
                        required: "Password is required"
                    },
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                highlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    elem.addClass(errorClass);
                    elem.removeClass(validClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    elem.removeClass(errorClass);
                    elem.addClass(validClass);
                    if (elem.siblings('small.text-danger')) {
                        elem.siblings('small.text-danger').html('');
                    } else if (elem.closest('.form-group').find('small.text-danger')) {
                        elem.closest('.form-group').find('small.text-danger').html('');
                    } else if (elem.closest('.form-group').closest('.form-group').find('small.text-danger')) {
                        elem.closest('.form-group').closest('.form-group').find('small.text-danger').html('');
                    }
                },
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    error.insertAfter(element);
                }
            });
            var options = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
                    $('#login-create').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-error-login').hide();
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-login').hide();
                    $('#alert-error-login').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#login-create').removeClass('d-none');
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
                        $('#alert-error-login').html(response.custom_msg);
                        $('#alert-error-login').show().fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        // $('html, body').animate({scrollTop:0}, 'slow');

                        $('#login-create').attr('disabled');
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
                    $('#alert-success-login').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#login-create').removeClass('d-none');
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
                    $('#alert-error-login').html(msg);
                    $('#alert-error-login').show();
                },

            };

            $('#logForm').ajaxForm(options_login);

        });
        // toastr.options = {
        //     "closeButton": true,
        //     "debug": false,
        //     "newestOnTop": false,
        //     "progressBar": false,
        //     "positionClass": "toast-bottom-left",
        //     "preventDuplicates": false,
        //     "onclick": null,
        //     "showDuration": "0",
        //     "hideDuration": "0",
        //     "timeOut": "0",
        //     "extendedTimeOut": "0",
        //     "showEasing": "swing",
        //     "hideEasing": "linear",
        //     "showMethod": "fadeIn",
        //     "hideMethod": "fadeOut"
        // }
    </script>

@endpush
