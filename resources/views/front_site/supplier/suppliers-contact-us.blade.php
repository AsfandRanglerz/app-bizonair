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
            padding: 35px;
            max-width: 805px;
            border-radius: 8px;
        }

        .contact-us-form .check-stats li.btn {
            align-items: baseline;
            text-align: left;
            color: #344356;
            border: none;
        }
        /*contact us*/

        @media only screen and (max-width: 575px) {
            /*contact us*/
            .contact-us-form {
                padding: 15px;
            }

            .contact-us-form .check-stats li.btn {
                font-size: 14px;
            }
            /*contact us*/
        }
    </style>
    <main id="maincontent" class="suppliers-contact-us">
        @include('front_site.common.suppliers-banner')
        <div class="my-2 container-lg">
            <h3 class="mb-2 font-weight-bold heading">Contact Us</h3>
                <div class="m-auto contact-us-form">
                    <form id="contactUsSupplier" name="contactUsSupplier" method="POST" action="{{route('create-contact-us-user')}}">
                        @csrf
                        <input type="hidden" class="form-control" name="type" value="supplier">
                        <input type="hidden" class="form-control" name="userId" value="{{$contact_us->user_id}}">
                        <div class="form-group">
                            <label class="label" for="inquiryFor">Subject <span class="required">*</span></label>
                            <input type="text" class="form-control" id="inquiryFor" name="inquiryFor" placeholder="Subject" required>
                            <small class="text-danger" id="inquiryFor_error"></small>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label class="label" for="userName">Name <span class="required">*</span></label>
                                <input type="text" class="form-control" id="userName" name="userName" placeholder="Name" value="{{\Auth::user()->name}}" required>
                                <small class="text-danger" id="userName_error"></small>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="label" for="emailAddress">Email <span class="required">*</span></label>
                                <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="example@gmail.com" value="{{\Auth::user()->email}}" required>
                                <small class="text-danger" id="emailAddress_error"></small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label class="label" for="companyName">Company Name <small class="font-500"> (Optional)</small></label>
                                <input type="text" class="form-control" id="companyName" name="company_name" placeholder="My Textile" value="{{ company_name(session()->get('company_id'))??'' }}" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="label" for="phoneNumber">Phone <span class="required">*</span></label>
                                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="123-4567-8901" value="{{\Auth::user()->registration_phone_no}}" required>
                                <small class="text-danger" id="phoneNumber_error"></small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label class="label" for="designationUser">Designation <small class="font-500"> (Optional)</small></label>
                                <input type="text" value="" class="form-control" id="designationUser" name="designation" placeholder="Designation" required="required">
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="label" for="countries">Choose Country <span class="required">*</span></label>
                                <select name="country" class="form-control" id="countries" required="required">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->name->common }}" {{(\Auth::user()->country == $country->name->common)?'selected':''}}>{{ $country->name->common }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger" id="country_error"></small>
                            </div>
                        </div>
                        <div class="form-group check-stats">
                            <ul data-toggle="buttons">
                                <li class="w-100 btn d-flex pl-0">
                                    <input class="input fa fa-square-o" type="checkbox" name="terms" id="terms">
                                    <div class="text-justify">
                                        I Agree to the <a href="#" class="text-link">Terms of Services</a> and <a href="#" class="text-link">Privacy Policy</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label class="label" for="description">Message <span class="required">*</span></label>
                            <textarea class="form-control" name="description" id="description" placeholder="Message" style="height: 115px"></textarea>
                            <small class="text-danger" id="description_error"></small>
                        </div>
                        <div class="form-group">
                            <div class="mt-3 form-group col-md-12 career-img-drop-outer attachment-img-file" style="padding-left: 0px;">
                                <label class="d-block text-left mb-2 font-500">Attachment <small class="font-500"> (Optional | </small><small class="font-500">Attach Reference or Image)</small></label>
                                <div class="custom-file">
                                    <input type="file" name="image" id="image" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile" style="color: #A52C3E;"><span class="fa fa-download"></span></label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="submit" class="red-btn submit-btn" id="contact-create-supplier" value="Submit">
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
            var options = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
                    $('#contact-create-supplier').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-error').hide();
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#contact-create-supplier').removeClass('d-none');
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
                        $('#alert-error').html(response.custom_msg);
                        $('#alert-error').show().fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        // $('html, body').animate({scrollTop:0}, 'slow');

                        $('#contact-create-supplier').attr('disabled');
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
                    $('#alert-success').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#contact-create-supplier').removeClass('d-none');
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
            $('#contactUsSupplier').ajaxForm(options);
        });
    </script>

@endpush
