@extends('front_site.master_layout')

@section('content')
    <body>
    <style>
        .head-office-info .red-link {
            font-size: unset;
        }

        /*contact us*/
        .contact-us-form {
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 0%), 0 6px 20px 0 rgb(0 0 0 / 18%);
            padding: 8px;
            max-width: 805px;
            border-radius: 8px;
        }

        .contact-us-form .check-stats li.btn {
            text-align: left;
            color: #344356;
            border: none;
        }
        /*contact us*/

        @media only screen and (max-width: 575px) {
            /*contact us*/
            .contact-us-form {
                width: 95%;
            }

            .contact-us-form .check-stats li.btn {
                font-size: 10px;
            }
            /*contact us*/
        }
    </style>
    <main id="maincontent" class="suppliers-contact-us">
        @include('front_site.common.user-suppliers-banner')
        <div class="mt-4 mb-4 container-lg">
            <div class="alert alert-success mb-2 text-center" id='alert-success-contact-supplier' style="display: none"
                 role="alert">
            </div>
            <div class="alert alert-danger mb-2 text-center" id='alert-error-contact-supplier' style="display: none"
                 role="alert">
            </div>
                    <div class="m-auto contact-us-form">
                        <form id="contactUsUserSupplier" name="contactUsSupplier" method="POST" action="{{route('save-contact-us-supplier')}}">
                            @csrf
                            <input type="hidden" class="form-control" name="type" value="supplier">
                            <input type="hidden" class="form-control" name="userId" value="{{$about_us['user_id']}}">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inquiryFor" name="inquiryFor" placeholder="Subject" required>
                                <small class="text-danger" id="inquiryFor_error"></small>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control" id="userName" name="userName" placeholder="Name" value="@if(\Auth::user()){{\Auth::user()->name}}@endif" required>
                                    <small class="text-danger" id="userName_error"></small>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Email - example@gmail.com" value="@if(\Auth::user()){{\Auth::user()->email}}@endif" required>
                                    <small class="text-danger" id="emailAddress_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control" id="companyName" name="company_name" placeholder="Company Name (Optional) - My Textile" value="@if(session()->get('company_id')){{ company_name(session()->get('company_id')) }}@endif" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Phone - 123-4567-8901" value="@if(\Auth::user()){{\Auth::user()->registration_phone_no}}@endif" required>
                                    <small class="text-danger" id="phoneNumber_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <input type="text" value="" class="form-control" id="designationUser" name="designation" placeholder="Designation (Optional)" required="required">
                                </div>
                                <div class="form-group col-sm-6">
                                    <select name="country" class="form-control" id="countries" required="required">
                                        <option value="" selected disabled>Choose Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->name->common }}" @if(\Auth::user()){{(\Auth::user()->country == $country->name->common)?'selected':''}}@endif>{{ $country->name->common }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger" id="country_error"></small>
                                </div>
                            </div>
                            <div class="form-group check-stats">
                                <div class="custom-control custom-checkbox d-flex flex-column-reverse">
                                    <input type="checkbox" class="custom-control-input" name="terms" id="terms" required>
                                    <label class="custom-control-label" for="terms">I Agree to the <a href="{{url('terms-of-use')}}" class="text-link">Terms of Services</a> and <a href="{{url('privacy')}}" class="text-link">Privacy Policy</a></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="description" id="description" placeholder="Message" style="height: 115px"></textarea>
                                <small class="text-danger" id="description_error"></small>
                            </div>
                            <div class="form-group">
                                <div class="form-group col-md-12 px-0 career-img-drop-outer attachment-img-file">
                                    <label class="d-block text-left mb-2 font-500">Attachment <small class="font-500"> (Optional | </small><small class="font-500">Attach Reference or Image)</small></label>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="image" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile" style="color: #A52C3E;"><span class="fa fa-upload"></span></label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="submit" class="red-btn submit-btn" id="contact-create-user-supplier" value="Submit" disabled>
                            </div>
                        </form>
                    </div>
        </div>

    </main>
    </body>
@endsection
@push('js')

    <script>
        $(document).ready(function () {
            var validator = $("form[name='contactUsSupplier']").validate({
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
                    'inquiryFor': {
                        required: true,
                    },
                    'userName':{
                        required: true,
                    },
                    'emailAddress':{
                        required: true,
                    },
                    'phoneNumber':{
                        required: true,
                    },
                    'country':{
                        required: true,
                    },
                    'description':{
                        required: true,
                    },
                    onkeyup: function (element) {
                        var $element = $(element);
                        $element.valid();
                    },
                },
                messages: {
                    'inquiryFor': {
                        required: "Contact inquiry is required"
                    },
                    'userName': {
                        required: "Contact name is required"
                    },
                    'emailAddress': {
                        required: "Contact email is required"
                    },
                    'phoneNumber': {
                        required: "Contact phone is required"
                    },
                    'country': {
                        required: "Contact country is required"
                    },
                    'description': {
                        required: "Contact description is required"
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
                    $('#contact-create-user-supplier').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-error-contact-supplier').hide();
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-contact-supplier').hide();
                    $('#alert-error-contact-supplier').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#contact-create-user-supplier').removeClass('d-none');
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
                        $('#alert-error-contact-supplier').html(response.custom_msg);
                        $('#alert-error-contact-supplier').show().fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        // $('html, body').animate({scrollTop:0}, 'slow');

                        $('#contact-create-user-supplier').attr('disabled');
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
                    $('#alert-success-contact-supplier').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#contact-create-user-supplier').removeClass('d-none');
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
                    $('#alert-error-contact-supplier').html(msg);
                    $('#alert-error-contact-supplier').show();
                },

            };
            $('#contactUsUserSupplier').ajaxForm(options);
        });
    </script>

@endpush
