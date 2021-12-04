@extends('front_site.master_layout')

@section('content')

    <body>
    <style>
        /*contact us*/
        .contact-us-form {
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 0%), 0 6px 20px 0 rgb(0 0 0 / 18%);
            padding: 8px;
            max-width: 720px;
            border-radius: 8px;
        }

        .contact-us-form .paragraph {
            color: #344356;
        }
        /*contact us*/

        @media only screen and (max-width: 575px) {
            /*contact us*/
            .contact-us-form {
                width: 95%;
            }
            /*contact us*/
        }
    </style>
    <main id="maincontent" class="pt-sm-5 pt-3 pb-sm-5 pb-3 page-main">
        <div class="container contact-us-form">
            <span class="d-block text-center mb-2 heading font-500 font-24">Contact Us</span>
            <div class="alert alert-success mb-2 text-center" id='alert-success-contact' style="display: none"
                 role="alert">
            </div>
            <div class="alert alert-danger mb-2 text-center" id='alert-error-contact' style="display: none"
                 role="alert">
            </div>
            <form id="contactUs" name="contactUs" method="POST" action="{{route('create-contact-us')}}">
                @csrf
                <input type="hidden" class="form-control" name="type" value="admin">
                <div class="form-group">
                    <select class="form-control" id="inquiryFor" name="inquiryFor" required>
                        <option value=""></option>
                        <option disabled>Select Contact For *</option>
                        <option value="Advertising/Marketing">Advertising/Marketing</option>
                        <option value="Customer Care">Customer Care</option>
                        <option value="Site/Technical Problem">Site/Technical Problem</option>
                        <option value="Joint Ventures/Business Development">Joint Ventures/Business Development</option>
                        <option value="Suggestions">Suggestions</option>
                    </select>
                    <small class="text-danger" id="inquiryFor_error"></small>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <input type="text" class="form-control" name="userName" id="userName"  placeholder="Name *" @if(auth()->check()) value="{{\Auth::user()->name}}" @endif required>
                        <small class="text-danger" id="userName_error"></small>
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="email" class="form-control" name="emailAddress" id="emailAddress" placeholder="Email * - example@gmail.com" @if(auth()->check()) value="{{\Auth::user()->email}}" @endif required>
                        <small class="text-danger" id="emailAddress_error"></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <input type="text" class="form-control" id="companyName" name="company_name" placeholder="Company Name (Optional) - My Textile">
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="number" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Phone * - 123-4567-890" @if(auth()->check()) value="{{\Auth::user()->registration_phone_no}}" @endif required>
                        <small class="text-danger" id="phoneNumber_error"></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <input type="text" value="" class="form-control" id="designationUser" name="designation" placeholder="Designation (Optional)">
                    </div>
                    <div class="form-group col-sm-6">
                        <select name="country" class="form-control" id="countries" required>
                            <option value=""></option>
                            <option disabled>Choose Country *</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->name->common }}" @if(auth()->check()) {{(\Auth::user()->country == $country->name->common)?'selected':''}} @endif>{{ $country->name->common }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="country_error"></small>
                    </div>
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="description" id="description" placeholder="Message *" style="height: 115px" required></textarea>
                    <small class="text-danger" id="description_error"></small>
                </div>
                <div class="form-group mb-0">
                    <div class="mt-1 mb-0 form-group col-md-12 px-0 career-img-drop-outer attachment-img-file">
                        <label class="label" for="image">Attachment <small class="font-500"> (Optional |</small> <small class="font-500">Attach Reference or Image)</small></label>
                        <div class="custom-file">
                            <input type="file" name="image" id="image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile" style="color: #A52C3E;"><span class="fa fa-upload"></span></label>
                        </div>
                    </div>
                </div>
                <div class="form-group check-stats">
                    <div class="custom-control custom-checkbox d-flex flex-column-reverse">
                        <input type="checkbox" class="custom-control-input" name="terms" id="terms" required>
                        <label class="custom-control-label" for="terms">I Agree to the <a href="{{url('terms-of-use')}}" class="text-link">Terms of Services</a> and <a href="{{url('privacy')}}" class="text-link">Privacy Policy</a></label>
                    </div>
                </div>
                <h3 class="mt-2 mb-0">Contact Details</h3>
                <div class="mb-1 mx-0 form-row d-flex justify-content-between">
                    <div class="form-group mb-0 font-18">
                        <label class="label" for="contactEmail">Contact Email</label>
                        <a href="mailto:info@bizonair.com" class="d-block red-link">info@bizonair.com</a>
                    </div>
                    <div class="form-group mb-0 font-18">
                        <label class="label" for="contactPhone">Contact Number</label>
                        <p class="mb-0 paragraph">+92 3213222254</p>
                    </div>
                </div>
                <div>
                    <input type="submit" class="rounded px-4 red-btn submit-btn" id="contact-create" value="Submit" disabled="true">
                </div>
            </form>
        </div>
    </main>
    </body>

@endsection
@push('js')

    <script>
        $(document).ready(function () {
            /*for select single place holders*/
            $("#inquiryFor").select2({
                placeholder: "Select Contact For *"
            });

            $("#countries").select2({
                placeholder: "Choose Country *"
            });
            /*for select single place holders*/

            var validator = $("form[name='contactUs']").validate({
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
                    'terms':{
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
                    'terms': {
                        required: "Agree to proceed further"
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
                    $('#contact-create').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-error-contact').hide();
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-contact').hide();
                    $('#alert-error-contact').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#contact-create').removeClass('d-none');
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
                        $('#alert-error-contact').html(response.custom_msg);
                        $('#alert-error-contact').show().fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        // $('html, body').animate({scrollTop:0}, 'slow');

                        $('#contact-create').attr('disabled');
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
                    $('#alert-success-contact').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#contact-create').removeClass('d-none');
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
                    $('#alert-error-contact').html(msg);
                    $('#alert-error-contact').show();
                },

            };
            $('#contactUs').ajaxForm(options);
        });
    </script>

@endpush
