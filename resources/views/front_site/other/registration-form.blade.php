@extends('front_site.master_layout')
@section('content')
    <body class="registration-form">
        <style type="text/css" media="screen">
            .iti {
                width: 100%;
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
                            <div id="section2" class="container tab-pane active">
                                <div class="alert alert-success m-0 mb-2 text-center" id='alert-success-reg'
                                     style="display:none;"
                                     role="alert">
                                </div>
                                <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error-reg'
                                     style="display:none;"
                                     role="alert">
                                </div>
                                <div class="create-account">
                                    <form id="registrationForm" name="registration" autocomplete="off"
                                          action="{{route('register-user')}}" method="post">
                                        @csrf
                                        <div class="form-row">
                                            <h6 class="w-100">Create Account</h6>
                                            <div class="form-group col-md-6 mb-1">
                                                <label class="d-none">Account Email <span class="required">*</span></label>
                                                <input type="hidden" name="email" value="{{$email}}">
                                                <input type="email" value="{{$email}}" class="form-control is-valid"
                                                       placeholder="Account Email - example@email.com" disabled="disabled">
                                                <small class="text-danger" id="email_error"></small>
                                            </div>
                                            <div class="form-group col-md-6 mb-1">
                                                <label class="mb-2 w-100 text-center font-500">Profile Picture (Optional)</label>
                                                <div class="mx-auto d-flex justify-content-center align-items-center avatar-wrapper rounded create-account-avatar">
                                                    {{--<img class="profile-pic" id="uploaded_image" src="{{ get_user_image(Auth::user()) }}"/>--}}
                                                    <div class="position-absolute spinner-border text-danger loader-spinner d-none" role="status" style="z-index: 1">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                    <img class="w-100 h-100 object-cover rounded header-profile-pic" id="uploaded_image1" src="{{$ASSET}}/front_site/images/preview.svg">
                                                    <div class="upload-button rounded">
                                                        <span class="fa fa-plus"></span>
                                                    </div>
                                                    <input class="file-upload d-none" name="avatar" id="avatar1" type="file" accept="image/*"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 mb-1">
                                                <label class="d-none">First Name <span class="required">*</span></label>
                                                <input type="text" class="form-control required-control" placeholder="First Name - Input First Name"
                                                       name="first_name">
                                                <small class="text-danger" id="first_name_error"></small>
                                            </div>
                                            <div class="form-group col-md-6 mb-1">
                                                <label class="d-none">Last Name <span class="required">*</span></label>
                                                <input type="text" name="last_name" class="form-control required-control"
                                                       placeholder="Last Name - Input Last Name">
                                                <small class="text-danger" id="last_name_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 mb-1">
                                                <label class="d-none">Password <span class="required">*</span></label>
                                                <span toggle="#reg_password" class="fa fa-fw fa-eye toggle-password-eye"></span>
                                                <input type="password" id="reg_password" class="form-control"
                                                       placeholder="Password - Choose a password atleast 8 characters long"
                                                       name="password">
                                                <small class="text-danger" id="password_error"></small>
                                            </div>
                                            <div class="form-group col-md-6 mb-1">
                                                <label class="d-none">Confirm Password <span class="required">*</span></label>
                                                <span toggle="#confirm_password"
                                                      class="fa fa-fw fa-eye toggle-password-eye"></span>
                                                <input type="password" id="confirm_password" class="form-control"
                                                       placeholder="Confirm Password" name="confirm_password">
                                                <small class="text-danger" id="confirm_password_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 mb-1">
                                                <label for="mobileNumber" class="d-none">Mobile Number <span
                                                        class="required">*</span></label>
                                                <!-- <input type="tel" class="form-control" id="phone" name="registration_phone_no" > -->
                                                <input type="tel" name="registration_phone_no" class="form-control"
                                                       id="mobileNumber" placeholder="Mobile Number - +923xxxxxxxxx">
                                                <input type="hidden" name="registration_phone_no_country_code">
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
                                        <div class="mx-0 mb-1 w-100 user-type-section">
                                            <h6 class="w-100 pl-0 mb-0">Gender <span class="required">*</span></h6>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="exampleRadios1" name="gender" value="Male" class="custom-control-input" required>
                                                <label class="custom-control-label" for="exampleRadios1">Male</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="exampleRadios2" name="gender" value="Female" class="custom-control-input" required>
                                                <label class="custom-control-label" for="exampleRadios2">Female</label>
                                            </div>
                                            <small class="text-danger" id="gender_error"></small>
                                        </div>
                                        <div class="mx-0 w-100 form-row user-type-section">
                                            <h6 class="w-100 px-0">User Type <span class="required">*</span></h6>
                                            <div class="form-group user-type col-xl-9 col-lg-12 px-0">
                                                @foreach (\App\UType::all() as $item)
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input @if($item->id == 4) service-provider @endif" id="{{$item->id}}" value="{{$item->id}}" data-id="{{$item->id}}" name="user_type[]">
                                                    <label class="custom-control-label" for="{{$item->id}}">{{$item->title}}</label>
                                                    <span class="ml-1 fa fa-question-circle d-flex align-items-center" data-toggle="tooltip"
                                                          data-placement="top" title="{{ $item->title }}"
                                                          aria-hidden="true"></span>
                                                </div>
                                                @endforeach
                                                <small class="text-danger" id="user_type_error"></small>
{{--                                                <div>--}}
{{--                                                    <ul data-toggle="buttons">--}}
{{--                                                        @foreach (\App\UType::all() as $item)--}}
{{--                                                            <li class="btn @if($item->id == 4) service-provider @endif">--}}
{{--                                                                <input class="input fa fa-square-o required-control" type="checkbox"--}}
{{--                                                                       value="{{$item->id}}" data-id="{{$item->id}}"--}}
{{--                                                                       name="user_type[]">{{$item->title}}--}}
{{--                                                                <span class="ml-1 fa fa-question-circle" data-toggle="tooltip"--}}
{{--                                                                      data-placement="top" title="{{ $item->title }}"--}}
{{--                                                                      aria-hidden="true"></span>--}}
{{--                                                            </li>--}}
{{--                                                        @endforeach--}}
{{--                                                    </ul>--}}
{{--                                                    <small class="text-danger" id="user_type_error"></small>--}}
{{--                                                </div>--}}
                                            </div>
                                            <select
                                                class="form-control choose-services col-xl-3 col-lg-12 select2-multiple-services "
                                                multiple name="userservices[]">
                                                @foreach (\App\Subservice::all() as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 mb-1">
                                                <label class="d-none">Company/Institute Name <small class="font-500">(Optional)</small></label>
                                                <input type="text" class="form-control" placeholder="Company/Institute Name (Optional) - Input Business Company Name OR Institute Name for Students"
                                                       name="company_name">
                                                <small class="text-danger" id="company_name_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
{{--                                            <div class="form-group check-stats">--}}
{{--                                                <ul class="pl-2">--}}
{{--                                                    <li class="w-100 btn d-flex" id="termsCheckbox">--}}
{{--                                                        <input class="input fa fa-square-o" type="checkbox"--}}
{{--                                                               id="termsCheckboxinput">--}}
{{--                                                        <div id="termsCheckboxdiv">--}}
{{--                                                            I Agree to the <a href="{{route('terms-of-use')}}" class="text-link" target="_blank">Terms of--}}
{{--                                                                Services</a> and <a href="{{route('privacy-policy')}}" class="text-link" target="_blank">Privacy--}}
{{--                                                                Policy</a>--}}
{{--                                                        </div>--}}
{{--                                                    </li>--}}
{{--                                                    <li class="w-100 btn active">--}}
{{--                                                        <input class="input fa fa-square-o" type="checkbox"--}}
{{--                                                               name="industry_information_check" id="infoCheckbox" value="1"--}}
{{--                                                               checked="">I would like to recieve information related to my--}}
{{--                                                        industry--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
                                            <div class="form-group check-stats pl-2">
                                                <div class="flex-column-reverse custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" name="termsCheckboxinput" id="termsCheckboxinput">
                                                    <label class="custom-control-label" for="termsCheckboxinput">I Agree to the <a href="{{url('terms-of-use')}}" class="text-link">Terms of Services</a> and <a href="{{url('privacy')}}" class="text-link">Privacy Policy</a></label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" name="infoCheckbox" id="infoCheckbox" value="1">
                                                    <label class="custom-control-label" for="infoCheckbox">I would like to recieve information related to my industry</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-12 mb-1" align="center">
                                                <input type="submit" id="accoutn_btn" class="red-btn create-btn" value="Create My Account" disabled>
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
            </div>
        </main>
    </body>

@endsection

@push('js')
    <script src="{{$ASSET}}/front_site/js/jquery.date-dropdowns.min.js"></script>
    <script>
        /*checkbox: "I Agree to the Terms of Services and Privacy Policy"*/
        $(document).on('click', '#termsCheckbox', function(){
            if($(this).is(":checked") == false){
                $('button[type="submit"]').prop("disabled", true);
            }
            else if($(this).is(":checked") == true){
                $('button[type="submit"]').prop("disabled", false);
            }
        });
        /*checkbox: "I Agree to the Terms of Services and Privacy Policy"*/

        /*scroll to error div*/
        $(document).on('click', '#accoutn_btn', function () {
            setTimeout(() => {
                var navbarHeight = $('.navbar').innerHeight();
                $('html,body').animate({
                        scrollTop: $('.text-danger:not(:empty), .error:not(:empty)').eq(0).closest('.form-group').offset().top - (navbarHeight)},
                    'slow');
            }, 500);
        });
        /*scroll to error div*/

        $(document).on('click', '#termsCheckboxdiv', function () {
            if (!$('#termsCheckboxinput').is(':checked')) {
                $('#termsCheckboxinput-error').hide();

            }
            // else {
            //     $('#accoutn_btn').attr('disabled', true);
            // }
        });

        $(document).on('click', '#termsCheckboxinput', function () {
            if ($('#termsCheckboxinput').prop('checked') == true) {
                $('#accoutn_btn').attr('disabled', false);
            } else {
                $('#accoutn_btn').attr('disabled', true);
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

            $('.select2-multiple-services').select2({
                closeOnSelect: false,
                placeholder: "Select Service Type",
            });
            $(".select2-container--default").hide();
            $(".select2-container--default").addClass('col-lg-12 mt-2 mb-2');
            $(".select2-search--inline").find('input').attr('placeholder', 'Select Service Type');

            var validator = $("form[name='registration']").validate({
                ignore: [],
                onfocusout: function (element) {
                    var $element = $(element);
                    if ($element.hasClass('select2-search__field')) {
                        var $element2 = $element.closest('.form-row').find('.select2-multiple-services');
                        if ($element2.prop('required')) {
                            this.element($element2)
                        } else if ($element2.val() != '') {
                            this.element($element2)
                        }
                    } else if ($element.hasClass('dob-picker') && $element.val() == '') {
                        this.element($('input[name=birthday]'))
                    } else {
                        this.element(element)
                    }
                },
                onkeyup: function (element) {
                    var $element = $(element);
                    $element.valid();
                },
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
                    company_name: {
                        required: false
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    confirm_password: {
                        required: true,
                        minlength: 8,
                        equalTo: '#reg_password'
                    },
                    termsCheckboxinput: {
                        required: true,
                    },
                    gender: {
                        required: true
                    },
                    birthday: {
                        required: true
                    }
                },
                messages: {
                    first_name: "Please enter your firstname",
                    last_name: "Please enter your lastname",
                    reg_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    confirm_password: {
                        required: "Please enter the confirm password.",
                        minlength: "Password do no match",
                        equalTo: "Please enter the same password as above"
                    },
                    termsCheckboxinput: {
                        required: "Agree to proceed further"
                    },
                    email: "Please enter a valid email address",
                    gender: "Please select gender",
                    birthday: "Please enter complete birthday"
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                highlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        elem.closest('.form-row').find('.select2-container input').addClass(errorClass);
                        elem.closest('.form-row').find('.select2-container input').removeClass(validClass);
                        elem.closest('.form-row').find('span.select2-selection').addClass(errorClass);
                        elem.closest('.form-row').find('span.select2-selection').removeClass(validClass);
                    } else if (elem.hasClass('birthday')) {
                        var newelem = elem.closest('.form-group');
                        if (newelem.find('select.day').val() == '') {
                            newelem.find('select.day').addClass(errorClass)
                        }
                        if (newelem.find('select.month').val() == '') {
                            newelem.find('select.month').addClass(errorClass)
                        }
                        if (newelem.find('select.year').val() == '') {
                            newelem.find('select.year').addClass(errorClass)
                        }
                    } else {
                        elem.addClass(errorClass);
                    }
                },
                unhighlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        elem.closest('.form-row').find('.select2-container input').removeClass(errorClass);
                        elem.closest('.form-row').find('.select2-container input').addClass(validClass);
                        elem.closest('.form-row').find('span.select2-selection').removeClass(errorClass);
                        elem.closest('.form-row').find('span.select2-selection').addClass(validClass);
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
                        element = elem.closest('.form-row').find('.select2-container--default');
                        error.insertAfter(element);
                    } else if (elem.attr('name') == 'gender') {
                        element2 = $('#gender_error');
                        error.insertAfter(element2);
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
                beforeSerialize: function ($form, options) {
                    $('input[name=registration_phone_no_country_code]').val($("#mobileNumber").intlTelInput('getSelectedCountryData').dialCode);
                },
                beforeSubmit: function (arr, $form) {
                    if ($("form[name='registration']").valid() && !$("#mobileNumber").hasClass("is-invalid")) {
                        $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                        // $form.find('button[type=submit]').prop('disabled', true);
                        $('#accoutn_btn').addClass('d-none');
                        $('.btn-pro').removeClass('d-none');
                        $('#alert-error-reg').hide();
                    }
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-reg').hide();
                    $('#alert-error-reg').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#accoutn_btn').removeClass('d-none');
                    if (response.feedback == "false") {
                        // $form.find('button[type=submit]').prop('disabled', false);
                        // $('html, body').animate({scrollTop: ($('#' + Object.keys(response.errors)[0]).offset().top)}, 'slow');
                        // $(":input[name=" + Object.keys(response.errors)[0] + "]").focus();
                        $.each(response.errors, function (key, value) {
                            console.log(key+' '+value[0]);
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
                        $('#alert-error-reg').html(response.custom_msg);
                        $('#alert-error-reg').show().fadeOut(2500);
                    }  else if (response.feedback === 'true') {

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
                    console.log(error);
                    $("#loader").hide();
                    $('button[type=submit]').prop('disabled', false);
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-reg').hide();
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
                    $('#alert-error-reg').html(msg);
                    $('#alert-error-reg').show();
                },

            };
            $('#registrationForm').ajaxForm(options);

        });
    </script>
@endpush
