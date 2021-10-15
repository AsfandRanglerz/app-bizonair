@extends('front_site.master_layout')
@section('content')
<body>
<main id="maincontent" class="pt-sm-5 pt-3 pb-sm-5 pb-3 page-main">
    <div class="p-3 col-sm-6 col-11 login-form popup-center">
        <span class="d-block text-center heading font-500">Login</span>
        <form name="Login" action="{{route('user-do-login')}}" method="post" id="logForm">
            @csrf
        <form name="Login" action="myFunction()" method="post" id="logForm">
            @csrf
            <div class="empty-div my-2"></div>
            <div class="alert alert-success my-2 text-center" id='alert-success-log' style="display: none"
                 role="alert">
            </div>
            <div class="alert alert-danger my-2 text-center" id='alert-error-log' style="display: none"
                 role="alert">
            </div>
            <div class="my-4" align="center">
                <img src="{{$ASSET}}/front_site/images/favicon.png">
            </div>
            <div class="form-group">
                <label class="label" for="email">Email</label>
                <input type="email" class="form-control" name="email_login" id="emailid" placeholder="example@gmail.com">
                <small class="text-white" id="email_login_error"></small>
            </div>
            <div class="form-group">
                <label class="label" for="password">Password</label>
                <div class="position-relative d-flex align-items-center">
                    <input type="password" name="login_password" id="userPassword" class="form-control" placeholder="Password">
                    <span toggle="#userPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <small class="text-white" id="login_password_error"></small>
            </div>
            <div class="form-group text-center mb-0 py-1">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="rememberPassword">
                    <label class="custom-control-label" for="rememberPassword">Remember me</label>
                </div>

                <input type="submit" class="rounded px-4 my-2 red-btn login-btn" value="Login"><br>
                <a href="#" class="font-500 red-link">Forgot your password?</a>
            </div>
{{--            {{route('email-confirmation')}}--}}
{{--            {{route('forgot-password')}}--}}
            <p class="mb-0 text-center paragraph">Don't have an account? <a href="#"  class="font-500 red-link">Sign up</a></p>
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
