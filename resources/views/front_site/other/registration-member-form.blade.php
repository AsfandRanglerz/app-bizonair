@extends('front_site.master_layout')
@section('content')

    <body class="registration-form">
    <style type="text/css" media="screen">
        .iti {
            width: 100%;
        }

        .iti label#mobileNumber-error {
            position: absolute;
        }

        .date-dropdowns {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .dob-picker {
            flex: 0 0 31.333333%;
            margin-right: 2%;
            max-width: 31.333333%;
        }

        .dob-picker:last-child {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            margin-right: 0;
        }
    </style>
    <main id="maincontent" class="page-main" >
        <div class="row m-0">
            <div class="col-lg-9 col-md-8 switch-tabs-section">

                <div class="switch-tabs" id="formSections">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="w-50 nav-item">
                            <a class="nav-link btnsEmial disabled" data-toggle="tab" href="#section1">Email
                                Confirmation</a>
                        </li>
                        <li class="w-50 nav-item">
                            <a class="nav-link btnsEmial active" data-toggle="tab" href="#section2">Registration
                                Form</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="section1" class="container tab-pane fade"><br>
                            <p>samole text samole text samole text</p>
                        </div>
                        <div id="section2" class="container tab-pane active"><br>
                            <div class="alert alert-success m-0 mb-2 text-center" id='alert-success'
                                 style="display:none;"
                                 role="alert">
                            </div>
                            <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error'
                                 style="display:none;"
                                 role="alert">
                            </div>
                            <div class="create-account">
                                <form id="registrationForm" name="registration" autocomplete="off"
                                      action="{{route('register-member')}}"
                                      method="post">
                                    @csrf
                                    <div class="form-row">
                                        <h6 class="w-100">Create Member Account</h6>
                                        <div class="form-group col-md-12">
                                            <label>Account Email <span class="required">*</span></label>
                                            <input type="hidden" name="reciever" value="{{$reciever_mail}}"
                                                   id="reciever">
                                            <input type="hidden" name="email" value="{{$email}}">
                                            <input type="email" value="{{$email}}" class="form-control"
                                                   placeholder="example@email.com" disabled="disabled">
                                            <small class="text-danger" id="email_error"></small>
                                        </div>

{{--                                        <div class="form-group col-md-6">--}}
{{--                                            <label>Password <span class="required">*</span></label>--}}
{{--                                            <span toggle="#password" class="fa fa-fw fa-eye toggle-password-eye"></span>--}}
{{--                                            <input type="password" id="password" class="form-control"--}}
{{--                                                   placeholder="Choose a password atleast 8 characters long"--}}
{{--                                                   name="password">--}}
{{--                                            <small class="text-danger" id="password_error"></small>--}}
{{--                                        </div>--}}
                                        <div class="form-group col-md-6 mb-1">
                                            <label>Password <span class="required">*</span></label>
                                            <span toggle="#reg_password" class="fa fa-fw fa-eye toggle-password-eye"></span>
                                            <input type="password" id="reg_password" class="form-control"
                                                   placeholder="Choose a password atleast 8 characters long"
                                                   name="password">
                                            <small class="text-danger" id="password_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <label>Confirm Password <span class="required">*</span></label>
                                            <span toggle="#confirm_password"
                                                  class="fa fa-fw fa-eye toggle-password-eye"></span>
                                            <input type="password" id="confirm_password" class="form-control"
                                                   placeholder="Confirm Password" name="confirm_password">
                                            <small class="text-danger" id="confirm_password_error"></small>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <h6 class="w-100">Designation <small class="font-500">(Optional)</small></h6>

                                        <div class="form-group col-sm-12">

                                            <select name='designation' class="form-control choose-country">

                                                <option value="">Select your designation</option>
                                                <option>Director</option>

                                                <option value="CEO">CEO</option>

                                                <option value="General Manager">General Manager</option>

                                                <option value="Owner">Owner</option>

                                                <option value="Entrepreneur">Entrepreneur</option>

                                                <option value="Marketing">Marketing</option>

                                                <option value="Sales">Sales</option>

                                                <option value="Purchasing">Purchasing</option>

                                                <option value="Technical & Engineering">Technical & Engineering</option>

                                                <option value="Administration">Administration</option>

                                                <option value="Others" id="otherUser">Others</option>

                                            </select>

                                            <small class="text-danger" id="designation_error"></small>

                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <h6 class="w-100">Enter your business information</h6>
                                        <div class="form-group col-sm-12">
                                            <label>Country Region <span class="required">*</span></label>
                                            <select name="country_id" class="form-control choose-country">
                                                <option disabled="" selected="">--Country Region--</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{$country->id}}"
                                                            countrycode="{{$country->country_code}}">{{$country->country_name}}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="country_id_error"></small>
                                        </div>

                                    </div>


                                    {{--                                    <div class="form-row">--}}
                                    {{--                                        <div class="form-group col-md-12">--}}
                                    {{--                                            <label>Biz Office Code <span class="required">*</span></label>--}}
                                    {{--                                            <input type="text" class="form-control" required placeholder="Biz Office Code"--}}
                                    {{--                                                   name="office_code">--}}
                                    {{--                                            <small class="text-danger" id="office_code_error"></small>--}}
                                    {{--                                        </div>--}}

                                    {{--                                    </div>--}}

                                    <div class="form-row">
                                        <h6 class="w-100">Contact Person</h6>
                                        <div class="form-group col-md-6 mb-1">
                                            <label>First Name <span class="required">*</span></label>
                                            <input type="text" class="form-control" placeholder="First Name"
                                                   name="first_name">
                                            <small class="text-danger" id="first_name_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input type="text" name="last_name" class="form-control"
                                                   placeholder="Last Name">
                                            <small class="text-danger" id="last_name_error"></small>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <label for="mobileNumber">Enter your phone number: <span
                                                    class="required">*</span></label>
                                            <!-- <input type="tel" class="form-control" id="phone" name="registration_phone_no" > -->
                                            <input type="tel" name="registration_phone_no" class="form-control"
                                                   id="mobileNumber" placeholder="03xxxxxxxxx/3xxxxxxxxx">
                                            {{--                                            <span id="error-msg" class="text-danger hide">Please enter valid mobile number</span>--}}
                                            <small class="text-danger d-block" id="registration_phone_no_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <label for="birthday">Date of Birth <span class="required">*</span></label>
                                            <input type="text" name="birthday" placeholder="Date of Birth"
                                                   class="form-control birthday" id="birthday" required>
                                            <small class="text-danger" id="birthday_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group check-stats col-sm-12">

                                            <ul data-toggle="buttons">
                                                <li class="w-100 btn d-flex" id="termsCheckbox">
                                                    <input class="input fa fa-square-o" type="checkbox"
                                                           id="termsCheckboxinput">
                                                    <div id="termsCheckboxdiv">
                                                        I Agree to the <a href="#" class="text-link">Terms of
                                                            Services</a> and <a href="#" class="text-link">Privacy
                                                            Policy</a>
                                                    </div>
                                                </li>
                                                {{-- <li class="w-100 btn active">
                                                  <input class="input fa fa-square-o" type="checkbox" name="industry_information_check" id="infoCheckbox" value="1" checked="">I would like to recieve information related to my industry
                                                </li> --}}
                                            </ul>

                                        </div>
                                    </div>

                                    <div class="form-row mt-3">
                                        <div class="form-group col-sm-12" align="center">
                                            <button type="submit" id="accoutn_btn" disabled class="create-btn">
                                                Create My Account
                                            </button>
                                            <button  disabled class="btn-pro d-none create-btn"><span
                                                    class="spinner-border spinner-border-sm mr-1" role="status"
                                                    aria-hidden="true"></span>Processing
                                            </button>
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

    </main>
    </body>

@endsection

@push('js')
    <script src="{{$ASSET}}/front_site/js/jquery.date-dropdowns.min.js"></script>
    <script>

        $(document).on('click', '#termsCheckboxdiv', function () {
            // alert('hello');
            if (!$('#termsCheckboxinput').is(':checked')) {
                $('#accoutn_btn').removeClass('fade').attr('disabled', false);
            } else {
                $('#accoutn_btn').addClass('fade').attr('disabled', 'true');
            }
        });

        $(document).on('click', '#termsCheckboxinput', function () {
            // alert('hello');
            if ($('#termsCheckboxinput').prop('checked') == true) {
                $('#accoutn_btn').removeClass('fade').attr('disabled', false);
            } else {
                $('#accoutn_btn').addClass('fade').attr('disabled', 'true');
            }
        });


        $(document).ready(function () {
            $("#birthday").dateDropdowns({
                submitFormat: "dd-mm-yyyy",
                dropdownClass: 'form-control col-sm-4 dob-picker',
                wrapperClass: "date-dropdowns row",
                daySuffixValues: ['st', 'nd', 'rd', 'th'],
                daySuffixes: false,
                monthSuffixes: false,
                // required: true
            });

            var validator = $("form[name='registration']").validate({
                ignore: [],
                onfocusout: function (element) {
                    var $element = $(element);
                    console.log($element);
                    if ($element.hasClass('dob-picker') && $element.val() == '') {
                        this.element($('input[name=birthday]'))
                    } else {
                        this.element(element)
                    }
                },
                // ignore: '#mobileNumber',
                rules: {
                    first_name: "required",
                    last_name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    registration_phone_no: {
                        mobilenumber: true
                    },
                    onkeyup: function (element) {
                        var $element = $(element);
                        $element.valid();
                    },
                    country_id: {
                        required: true
                    },
                    company_name: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    // confirm_password: {
                    //     required: true,
                    //     equalTo: '#password'
                    // },
                    birthday: {
                        required: true
                    }
                },
                messages: {
                    first_name: "Please enter your firstname",
                    last_name: "Please enter your lastname",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    // confirm_password: {
                    //     equalTo: "Password does not match"
                    // },
                    email: "Please enter a valid email address",
                    birthday: "Please enter complete birthday"
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                highlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        elem.closest('.form-group').find('.select2-container').addClass(errorClass);
                    } else if (elem.hasClass('birthday')) {
                        var newelem = elem.closest('.form-group');
                        if (newelem.find('select.day').val() == '') {
                            newelem.find('select.day').addClass(errorClass);
                        }
                        if (newelem.find('select.month').val() == '') {
                            newelem.find('select.month').addClass(errorClass);
                        }
                        if (newelem.find('select.year').val() == '') {
                            newelem.find('select.year').addClass(errorClass);
                        }
                    } else {
                        elem.addClass(errorClass);
                    }
                },
                unhighlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        elem.closest('.form-group').find('.select2-container').removeClass(errorClass);
                    } else if (elem.hasClass('dob-picker')) {
                        elem.removeClass(errorClass);
                        elem.addClass(validClass);
                        var newelem = elem.closest('.form-group');
                        if (newelem.find('select.day').val() != '' && newelem.find('select.month').val() != '' && newelem.find('select.year').val() != '') {
                            newelem.find('#birthday-error').remove();
                        }
                    } else {
                        elem.removeClass(errorClass);
                        elem.addClass(validClass);
                    }
                },
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        element = elem.closest('.form-group').find('.select2-container');
                        error.insertAfter(element);
                    } else if (elem.hasClass('birthday')) {
                        element = elem.closest('.form-group').find('.date-dropdowns');
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $('.dob-picker').on("change", function (e) {
                $("form[name='companyForm']").valid()
            });

            var options = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    if ($("form[name='registration']").valid() && !$("#mobileNumber").hasClass("is-invalid")) {
                        $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                        $form.find('button[type=submit]').prop('disabled', true);
                        $('#accoutn_btn').addClass('d-none');
                        $('.btn-pro').removeClass('d-none');
                        return true;
                    } else {
                        return false;
                    }
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
                        // $('html, body').animate({scrollTop: ($('#' + Object.keys(response.errors)[0]).offset().top)}, 'slow');
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
                        $('#alert-error').show();
                    } else {
                        // $('#btn-pro').addClass('d-none');
                        // $('html, body').animate({scrollTop: 0}, 'slow');
                        $('#alert-error').hide();
                        $('#accoutn_btn').attr('disabled');
                        // $('#alert-success').html(response.msg);
                        // $('#alert-success').show();
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
            $('#registrationForm').ajaxForm(options);
        });
    </script>
@endpush
