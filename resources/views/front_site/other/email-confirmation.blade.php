@extends('front_site.master_layout')
@section('content')
    <body class="email-confirmation">
    <main id="maincontent" class="page-main">
        <div class="row m-0">
            <div class="col-lg-9 col-md-8 switch-tabs-section">
                <div class="switch-tabs" id="formSections">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="w-50 nav-item">
                            <a class="nav-link btnsEmial active" data-toggle="tab" href="#section1">Email
                                Confirmation</a>
                        </li>
                        <li class="w-50 nav-item">
                            <a class="nav-link btnsEmial disabled" data-toggle="tab" href="#section2">Registration
                                Form</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="section1" class="container tab-pane active">
                            <div class="alert alert-success m-0 mb-2" id='alert-success'
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
                            <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error'
                                 style="display:none;"
                                 role="alert">
                            </div>
                            <div class="create-account">
                                <form id="emailConfirmationForm" method="POST"
                                      action="{{route('get-email-verification-code')}}">
                                    @csrf
                                    <h6 class="text-center">Create Account</h6>
                                    <p class="text-center mb-md-3 mb-2">Register using social media icons</p>
                                    <div class="form-row">
                                        <div class="w-100 form-group social-links" align="center">
                                            <a href="{{route('facebook-sign-up')}}" class="facebook-icon"><span
                                                    class="fa fa-facebook" aria-hidden="true"></span>Facebook</a>
                                            <a href="{{route('linkedin-sign-up')}}" class="linkedin-icon"><span
                                                    class="fa fa-linkedin" aria-hidden="true"></span>LinkedIn</a>
                                            <a href="{{route('google-sign-up')}}" class="google-icon"><span
                                                    class="fa fa-google" aria-hidden="true"></span>Google</a>
                                        </div>
                                        <div class="w-100 opt-br">
                                            <div>
                                                <span>OR</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 mb-md-3 mb-0">
                                            <label>Email</label>
                                            <div class="form-row">
                                                <div class="form-group col-xl-9 col-lg-8">
                                                    <input type="email"
                                                           @if(isset($_GET['email']))
                                                           value="{{$_GET['email']}}"
                                                           @else
                                                           value="{{ old('email') }}"
                                                           @endif
                                                           name="email"
                                                           id="email" class="form-control"
                                                           placeholder="example@email.com" required>
                                                </div>
                                                <div class="form-group col-xl-3 col-lg-4 mb-md-3 mb-0" align="center">
                                                    <button class="verify-btn " id="code" type="submit">Verify Email
                                                    </button>
                                                    <button  disabled class="btn-pro d-none verify-btn">
                                                        <span class="spinner-border spinner-border-sm mr-1"
                                                              role="status" aria-hidden="true"></span>Processing
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{--                                <form class="d-none" method="POST" action="{{route('check-verification-code')}}"--}}
                                {{--                                      id="verifyCodeForm">--}}
                                {{--                                    @csrf--}}
                                {{--                                    <input type="hidden" name="email" id="verifyemail">--}}
                                {{--                                    <label>Verification Code</label>--}}
                                {{--                                    <div class="form-row">--}}
                                {{--                                        <div class="form-group col-xl-9 col-lg-8">--}}
                                {{--                                            <input type="text" maxlength="6" name="verification_code"--}}
                                {{--                                                   class="form-control"--}}
                                {{--                                                   placeholder="Please enter the verification code you recieved">--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="form-group col-sm-12" align="center">--}}
                                {{--                                            <button class="next-btn" type="submit">Next</button>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </form>--}}
                            </div>
                        </div>
                        {{--                        <div id="section2" class="container tab-pane fade"><br>--}}
                        {{--                            --}}{{--              <p>sample text sample text sample text</p>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 px-md-3 px-2 join-us-sidebar">
                @include("front_site.common.join-us-sidebar")
            </div>
            <div>
            </div>
    </main>
    </body>

@endsection
@push('js')

    <script>
        $(document).ready(function () {
            $("#emailConfirmationForm").validate({
                onkeyup: function (element) {
                    var $element = $(element);
                    $element.valid();
                },
                rules: {
                    email: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Email is required",
                        email: "Please enter a valid email"
                    },
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid'
            });
            //     $(document).on("click","#code",function() {
            //         var email = $('#email').val();
            //         // alert(email);
            //         $.ajax({
            //             url:"getlink",
            //             method:'post',
            //             data:{email:email,"_token": "{{ csrf_token() }}"},
            //             success:function(data)
            //             {
            //                 $('#message').text(data.message);
            //                 $('#message').css('display','block');
            //                 $('#message').addClass(data.class);
            //             }
            //         });
            //     });
            // });
            {{--var options_verifycode = {--}}
            {{--    dataType: 'Json',--}}
            {{--    beforeSubmit: function (arr, $form) {--}}
            {{--    },--}}
            {{--    success: function (data) {--}}
            {{--        // alert(data);--}}
            {{--        $('#alert-success').hide();--}}
            {{--        $('#alert-error').hide();--}}
            {{--        response = data;--}}
            {{--        if (response.feedback == 'false') {--}}

            {{--        } else if (response.feedback == 'invalid') {--}}
            {{--            $('#alert-error').html(response.msg);--}}
            {{--            $('#alert-error').show();--}}
            {{--            // setTimeout(() => {--}}
            {{--            // 	window.location.reload();--}}
            {{--            // }, 1000);--}}
            {{--        } else if (response.feedback == 'true') {--}}
            {{--            // $('#code').attr('disabled');--}}
            {{--            $('#alert-success').html(response.msg);--}}
            {{--            $('#alert-success').show();--}}
            {{--            setTimeout(() => {--}}
            {{--                window.location.href = response.url;--}}
            {{--            }, 1500);--}}
            {{--        }--}}
            {{--    },--}}
            {{--    error: function (jqXHR, exception) {--}}
            {{--        $('#alert-success').hide();--}}
            {{--        $('#alert-error').hide();--}}
            {{--        // form.find('button[type=submit]').html('<i aria-hidden="true" class="fa fa-check"></i> {{ __('Save') }}');--}}
            {{--        var msg = '';--}}
            {{--        if (jqXHR.status === 0) {--}}
            {{--            msg = 'Not Connected.\n Verify Network.';--}}
            {{--        } else if (jqXHR.status == 404) {--}}
            {{--            msg = 'Requested page not found. [404]';--}}
            {{--        } else if (jqXHR.status == 500) {--}}
            {{--            msg = 'Internal Server Error [500].';--}}
            {{--        } else if (exception === 'parsererror') {--}}
            {{--            msg = 'Requested JSON parse failed.';--}}
            {{--        } else if (exception === 'timeout') {--}}
            {{--            msg = 'Time out error.';--}}
            {{--        } else if (exception === 'abort') {--}}
            {{--            msg = 'Ajax request aborted.';--}}
            {{--        } else {--}}
            {{--            msg = 'Uncaught Error, Please try again later';--}}
            {{--        }--}}
            {{--        $('#alert-error').html(msg);--}}
            {{--        $('#alert-error').show();--}}
            {{--    },--}}

            {{--};--}}

            var options_emailconfirmation = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('#code').addClass('d-none');
                    // $('#verifyCodeForm').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                },
                success: function (data) {
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#code').removeClass('d-none');
                    if (response.feedback == 'false') {

                    } else if (response.feedback == 'invalid') {
                        $('#alert-error').html(response.msg);
                        $('#alert-error').show();
                        // setTimeout(() => {
                        // 	window.location.reload();
                        // }, 1000);
                    } else if (response.feedback == 'true') {
                        // $('#code').attr('disabled');
                        // $('#verifyCodeForm').removeClass('d-none')
                        $('#alert-success').html(response.msg);
                        $('#alert-success').show();
                        let email = $('#email').val();
                        $('#verifyemail').val(email);
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 1000);
                    }
                },
                error: function (jqXHR, exception) {
                    $('#alert-success').hide();
                    $('#alert-error').hide();
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
                    $('#alert-error').html(msg);
                    $('#alert-error').show();
                },

            };

            $('#emailConfirmationForm').ajaxForm(options_emailconfirmation);
            // $('#verifyCodeForm').ajaxForm(options_verifycode);

        });
    </script>
@endpush
