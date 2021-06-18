@extends('front_site.master_layout')
@section('content')
<body>
<main id="maincontent" class="py-2 page-main">
    <div class="mx-2 p-2 login-form popup-center">
        <span class="d-block text-center heading font-500">Login</span>
            <form name="Login" action="{{route('user-do-login-pre')}}" method="post" id="logForm">
                @csrf
            <div class="empty-div my-2"></div>
            <div class="alert alert-success my-2 text-center" id='alert-success-log' style="display: none"
                 role="alert">
            </div>
            <div class="alert alert-danger my-2 text-center" id='alert-error-log' style="display: none"
                 role="alert">
            </div>
            <div class="my-2" align="center">
                <img src="{{$ASSET}}/front_site/images/favicon.png" class="biz-logo">
            </div>
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

                <input type="submit" class="rounded px-4 my-1 red-btn login-btn" value="Login"><br>
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

            var options_login = {
                dataType: 'Json',
                success: function (data) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-log').hide();
                    $('#alert-error-log').hide();
                    $('.empty-div').show();
                    response = data;
                    if (response.feedback == 'false') {
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    } else if (response.feedback == 'invalid') {
                        $('#alert-error-log').html(response.msg);
                        $('#alert-error-log').show();
                        $('.empty-div').hide();

                    } else {

                        $('#alert-error-login').hide();
                        $('#alert-success-log').html(response.msg);
                        $('#alert-success-log').show();
                        $('.empty-div').hide();
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 1000);

                    }
                },
                error: function (jqXHR, exception) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-log').hide();
                    $('#alert-error-log').hide();
                    $('.empty-div').show();
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
                    $('#alert-error-log').html(msg);
                    $('#alert-error-log').show();
                    $('.empty-div').hide();
                },

            };

            $('#logForm').ajaxForm(options_login);

        });
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "0",
            "hideDuration": "0",
            "timeOut": "0",
            "extendedTimeOut": "0",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

@endpush
