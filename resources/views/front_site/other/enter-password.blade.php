@extends('front_site.master_layout')
@section('content')
    <body class="email-confirmation">
    <main id="maincontent" class="page-main" style="background: #d9eefe8c">
        <div class="row m-0">
            <div class="col-lg-9 col-md-8 switch-tabs-section">


                <div class="switch-tabs" id="formSections">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="w-100 nav-item">
                            <a class="nav-link btnsEmial active" data-toggle="tab" href="#section1">Password</a>
                        </li>
{{--                        <li class="w-50 nav-item">--}}
{{--                            <a class="nav-link btnsEmial disabled" data-toggle="tab" href="#section2">Registration Form</a>--}}
{{--                        </li>--}}
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="section1" class="container tab-pane active"><br>

                            <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                                 role="alert">
                            </div>
                            <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                                 role="alert">
                            </div>

                            <div class="create-account">
                                <form method="POST" action="{{route('get-socialite-password')}}" id="passwordForm" >
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-xl-12 col-lg-12">
                                            <label>Password</label>
                                            <input type="text" name="password"
                                                   class="form-control" placeholder="Please enter the password for your account">
                                            <small class="text-danger" id="password_error"></small>

                                        </div>
                                        <div class="form-group col-xl-12 col-lg-12">
                                            <label>Confirm Password</label>
                                            <input type="text" name="c_password"
                                                   class="form-control" placeholder="Confirm your Password">
                                            <small class="text-danger" id="c_password_error"></small>

                                        </div>
                                        <div class="form-group col-sm-12" align="center">
                                            <button class="next-btn"   type="submit">Next</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-4 join-us-sidebar">
                @include("front_site.common.join-us-sidebar")
            </div>
            <div>

            </div>
        </div>

    </main>

    </body>

@endsection
@push('js')

    <script>
        $(document).ready(function(){
            var password_options={
                dataType: 'Json',
                success: function(data){
                    $('html, body').animate({scrollTop:0}, 'slow');
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#accoutn_btn').removeClass('d-none');
                    if(response.feedback === "false"){
                        $.each(response.errors , function(key ,value){
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name="+key+"]").addClass('is-invalid');
                        });
                    }
                    else if(response.feedback === "other_error"){
                        $('#' + response.id).html(response.custom_msg);
                    }
                    else if(response.feedback === 'other'){

                        $('#alert-error').html(response.custom_msg);
                        $('#alert-error').show();
                    }
                    else{
                        // $('#btn-pro').addClass('d-none');

                        $('#alert-error').hide();
                        $('#accoutn_btn').attr('disabled');
                        $('#alert-success').html(response.msg);
                        $('#alert-success').show();
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 1000);
                    }
                },
                error: function (jqXHR, exception) {
                    $('html, body').animate({scrollTop:0}, 'slow');
                    $('#alert-success').hide();
                    $('#alert-error').hide();
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
            $('#passwordForm').ajaxForm(password_options);

        });




    </script>
@endpush
