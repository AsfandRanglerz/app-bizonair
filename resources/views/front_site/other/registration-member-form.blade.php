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
                                        <div class="form-group col-md-6 mb-1">
                                            <label class="mb-1 w-100 font-500">Profile Picture (Optional)</label>
                                            <div class="d-flex justify-content-center align-items-center avatar-wrapper rounded create-account-avatar">
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
                                        <div class="form-group col-md-6 mb-1">
                                            <label>Account Email <span class="required">(Mandatory)</span></label>
                                            <input type="hidden" name="reciever" value="{{$reciever_mail}}"
                                                   id="reciever">
                                            <input type="hidden" name="email" value="{{$email}}">
                                            <input type="hidden" name="registeration_member_company_id" value="{{\session()->get('company_id')}}">
                                            <input type="email" value="{{$email}}" class="form-control"
                                                   placeholder="example@email.com" disabled="disabled">
                                            <small class="text-danger" id="email_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <label>First Name <span class="required">(Mandatory)</span></label>
                                            <input type="text" class="form-control" placeholder="First Name"
                                                   name="first_name">
                                            <small class="text-danger" id="first_name_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <label>Last Name <span class="required">(Mandatory)</span></label>
                                            <input type="text" name="last_name" class="form-control"
                                                   placeholder="Last Name">
                                            <small class="text-danger" id="last_name_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <label>Password <span class="required">(Mandatory)</span></label>
                                            <span toggle="#reg_password" class="fa fa-fw fa-eye toggle-password-eye"></span>
                                            <input type="password" id="reg_password" class="form-control"
                                                   placeholder="Choose a password atleast 8 characters long"
                                                   name="password">
                                            <small class="text-danger" id="password_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <label>Confirm Password <span class="required">(Mandatory)</span></label>
                                            <span toggle="#confirm_password"
                                                  class="fa fa-fw fa-eye toggle-password-eye"></span>
                                            <input type="password" id="confirm_password" class="form-control"
                                                   placeholder="Confirm Password" name="confirm_password">
                                            <small class="text-danger" id="confirm_password_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <label for="mobileNumber">Enter your phone number: <span
                                                    class="required">*</span></label>
                                            <!-- <input type="tel" class="form-control" id="phone" name="registration_phone_no" > -->
                                            <input type="number" name="registration_phone_no" class="form-control"
                                                   id="mobileNumber" placeholder="03xxxxxxxxx/3xxxxxxxxx">
                                            {{--                                            <span id="error-msg" class="text-danger hide">Please enter valid mobile number</span>--}}
                                            <small class="text-danger d-block" id="registration_phone_no_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <label for="birthday">Date of Birth <span class="required">(Mandatory)</span></label>
                                            <input type="text" name="birthday" placeholder="Date of Birth"
                                                   class="form-control birthday" id="birthday" required>
                                            <small class="text-danger" id="birthday_error"></small>
                                        </div>
                                    </div>
{{--                                    <div class="form-row">--}}

{{--                                        <h6 class="w-100">Designation <small class="font-500">(Optional)</small></h6>--}}

{{--                                        <div class="form-group col-sm-12">--}}

{{--                                            <select name='designation' class="form-control choose-country">--}}

{{--                                                <option value="">Select your designation</option>--}}
{{--                                                <option>Director</option>--}}

{{--                                                <option value="CEO">CEO</option>--}}

{{--                                                <option value="General Manager">General Manager</option>--}}

{{--                                                <option value="Owner">Owner</option>--}}

{{--                                                <option value="Entrepreneur">Entrepreneur</option>--}}

{{--                                                <option value="Marketing">Marketing</option>--}}

{{--                                                <option value="Sales">Sales</option>--}}

{{--                                                <option value="Purchasing">Purchasing</option>--}}

{{--                                                <option value="Technical & Engineering">Technical & Engineering</option>--}}

{{--                                                <option value="Administration">Administration</option>--}}

{{--                                                <option value="Others" id="otherUser">Others</option>--}}

{{--                                            </select>--}}

{{--                                            <small class="text-danger" id="designation_error"></small>--}}

{{--                                        </div>--}}

{{--                                    </div>--}}
                                    <div class="mx-0 w-100 form-row user-type-section">
                                        <h6 class="w-100 pl-0">Gender <span class="required">(Mandatory)</span></h6>
                                        <div class="custom-control custom-radio custom-control-inline flex-column-reverse">
                                            <input type="radio" id="exampleRadios1" name="gender" value="Male" class="custom-control-input" required>
                                            <label class="custom-control-label" for="exampleRadios1">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="exampleRadios2" name="gender" value="Female" class="custom-control-input" required>
                                            <label class="custom-control-label" for="exampleRadios2">Female</label>
                                        </div>
                                        <small class="text-danger" id="gender_error"></small>
                                    </div>
                                    <div class="w-100 form-row user-type-section">
                                        <h6 class="w-100 pl-0">User Type <span class="required">(Mandatory)</span></h6>
                                        <div class="form-group user-type col-xl-9 col-lg-12 pl-0">
                                            @foreach (\App\UType::all() as $item)
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input @if($item->id == 4) service-provider @endif" id="{{$item->id}}" value="{{$item->id}}" data-id="{{$item->id}}" name="user_type[]">
                                                    <label class="custom-control-label" for="{{$item->id}}">{{$item->title}}</label>
                                                    <span class="ml-1 fa fa-question-circle d-flex align-items-center" data-toggle="tooltip"
                                                          data-placement="top" title="{{ $item->tooltip }}"
                                                          aria-hidden="true"></span>
                                                </div>
                                            @endforeach
                                            <small class="text-danger" id="user_type_error"></small>
                                        </div>
                                        <select class="form-control choose-services col-xl-3 col-lg-12 select2-multiple-services " multiple name="userservices[]">
                                            @foreach (\App\Subservice::all() as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Company/Institute Name <small class="font-500">(Optional)</small></label>
                                            <input type="text" class="form-control" placeholder="Input Business Company Name OR Institute Name for Students"
                                                   name="company_name">
                                            <small class="text-danger" id="company_name_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group check-stats pl-2">
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" name="termsCheckboxinput" id="termsCheckboxinput">
                                                <label class="custom-control-label" for="termsCheckboxinput">I Agree to the <a href="{{url('terms-of-use')}}" class="text-link">Terms of Services</a> and <a href="{{url('privacy')}}" class="text-link">Privacy Policy</a></label>
                                            </div>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" name="infoCheckbox" id="infoCheckbox" value="1">
                                                <label class="custom-control-label" for="infoCheckbox">I would like to recieve information related to my industry</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-row mt-3">
                                        <div class="form-group col-sm-12" align="center">
                                            <button type="submit" id="accoutn_btn" class="create-btn">
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

        /*
                $(document).on('click', '#termsCheckboxinput', function () {
                    // alert('hello');
                    if ($('#termsCheckboxinput').prop('checked') == true) {
                        $('#accoutn_btn').removeClass('fade').attr('disabled', false);
                    } else {
                        $('#accoutn_btn').addClass('fade').attr('disabled', 'true');
                    }
                });
        */

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
                    password: {
                        required: true,
                        minlength: 8
                    },
                    // confirm_password: {
                    //     required: true,
                    //     equalTo: '#password'
                    // },
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
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    // confirm_password: {
                    //     equalTo: "Password does not match"
                    // },
                    email: "Please enter a valid email address",
                    gender: "Please select gender",
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
