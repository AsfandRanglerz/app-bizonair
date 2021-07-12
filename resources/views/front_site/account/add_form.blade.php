@extends('front_site.master_layout')



@push('css')

    <style>
        .sub_category_btn button, .category_btn button {

            background-color: rgb(217 238 254);

            /* border: rgb(52 67 86); */

            border-color: rgb(52 67 86);

        }

        .select2-container--default .select2-selection--multiple {

            background-color: rgb(217 238 254);

            border-color: rgb(52 67 86);

        }

        .iti {
            width: 100%;
        }

        .mobilverifynumber input {
            width: calc(100% - 120px);
        }
    </style>

@endpush



@section('content')
    <body class="registration-form my-account">
        <main id="maincontent" class="page-main">
            <div class="row m-0">
                <div class="col-lg-12 col-md-12 switch-tabs-section">
                <!-- Nav tabs -->
                <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="section2" class="container tab-pane active">
                            <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                                 role="alert">
                            </div>
                            <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                                 role="alert">
                            </div>
                            <div class="create-account">
                                <form action="{{route('save-my-account')}}" name="updateAccount" method="post"
                                      id="accountForm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <h5 class="w-100">My Account</h5>
                                    <div class="form-group mb-1">
                                        <label class="d-none">Account Email<span class="required">*</span></label>
                                        <input type="email" value="{{$user->email}}" class="form-control is-valid"
                                               placeholder="Account Email - example@email.com" disabled="disabled">
                                    </div>
                                    <div class="form-row">
                                        <h6 class="w-100">Contact Person</h6>
                                        <div class="form-group col-md-6 mb-1">
                                            <label class="d-none">First Name <span class="required">*</span></label>
                                            <input type="text" name="first_name" value="{{$user->first_name}}"
                                                   class="form-control is-valid" required placeholder="First Name - First Name">
                                            <small class="text-danger" id="last_name_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <label class="d-none">Last Name <span class="required">*</span></label>
                                            <input type="text" name="last_name" class="form-control is-valid"
                                                   value="{{$user->last_name}}" required placeholder="Last Name">
                                            <small class="text-danger" id="last_name_error"></small>
                                        </div>
                                    </div>
                                    {{-- <div class="w-100 form-row user-type-section">

                                        <h6 class="w-100 pl-0">Member Type <span class="required">*</span></h6>

                                        <div class="form-group user-type col-lg-8 pl-0">

                                            <ul data-toggle="buttons">

                                                <li class="btn">

                                                <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">General User

                                                </li>

                                                <li class="btn active">

                                                <input class="input fa fa-square-o" type="checkbox" id="buyerCheckbox">Buyer

                                                </li>

                                                <li class="btn">

                                                <input class="input fa fa-square-o" type="checkbox" id="sellerCheckbox">Seller

                                                </li>

                                            </ul>

                                        </div>

                                    </div> --}}
                                    <div class="w-100 pl-2 form-row user-type-section">
                                        <h6 class="w-100 pl-0 mb-0">Gender <span class="required">*</span></h6>
{{--                                        <div class="form-group user-type col-lg-6 pl-0">--}}
                                        <div class="mt-1 d-flex flex-row form-group user-type col-lg-6 pl-0">
                                            <div
                                                class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                <input type="radio" required
                                                       class="custom-control-input"
                                                       value="Male" id="exampleRadios1"
                                                       name="gender">
                                                <label class="custom-control-label" for="exampleRadios1">Male</label>
                                            </div>
                                            <div
                                                class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                <input type="radio" required
                                                       class="custom-control-input"
                                                       value="Female" id="exampleRadios2"
                                                       name="gender">
                                                <label class="custom-control-label" for="exampleRadios2">Female</label>
                                            </div>
                                            <small class="text-danger" id="gender_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <h6 class="w-100 p-0 d-none">Designation <small class="font-500">(Optional)</small>
                                            </h6>
                                            <select name='designation' class="form-control">
                                                <option value="">Select Designation (Optional)</option>
                                                <option value="Director">Director</option>
                                                <option value="CEO">CEO</option>
                                                <option value="General Manager">General Manager</option>
                                                <option value="Owner">Owner</option>
                                                <option value="Entrepreneur">Entrepreneur</option>
                                                <option value="Businessman">Businessman</option>
                                                <option value="Self-Employed">Self-Employed</option>
                                                <option value="Manager">Manager</option>
                                                <option value="Executive">Executive</option>
                                                <option value="Other" id="otherUser" class="other-check">Other</option>
                                            </select>
                                            <small class="text-danger" id="designation_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 other-div">
                                            <h6 class="w-100 p-0 d-none">Add Designation <span class="required">*</span></h6>
                                            <input type="text" name="other_designation" class="form-control" placeholder="Add Designation">
                                        </div>
                                    </div>
                                    {{-- <div class="form-row">

                                        <h6 class="w-100">I am interested in <small class="font-500">(Optional)</small></h6>

                                        <div class="form-group col-sm-12">

                                            <select id="multiSelectCat" name="user_categories" multiple="multiple">

                                                @foreach (\App\Category::all() as $item)

                                                <option value="{{$item->id}}" data-section="Categories">{{$item->name}}</option>

                                                @endforeach



                                            </select>

                                            <span class="d-block text-sm-right text-center mini-txt">Choose at most 5 categories</span>

                                        </div>

                                    </div> --}}
                                    <div class="form-row">
                                        <h6 class="w-100">I am interested in <small class="font-500">(Optional)</small></h6>
                                        <div class="form-group col-md-6 category_btn">
                                            <label class="d-none">Categories</label>
                                            <select name="category[]" class="form-control select2-multiple" id="category"
                                                    multiple>
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach (\App\Category::all() as $item)

                                                    <option value="{{$item->id}}">{{$item->name}}</option>

                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="category_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 sub_category_btn">
                                            <label class="d-none">Sub Categories</label>
                                            <select name="sub_category[]" id="sub_category1"
                                                    class="form-control select2-multiple5" multiple>
                                                <option value="" disabled selected>Select Sub-Category</option>
                                            </select>
                                            <small class="text-danger" id="sub_category_error"></small>
                                            <span class="d-block text-sm-right text-center mini-txt">Choose at most 5 sub categories</span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <label class="d-none">Country/Region <span class="required">*</span></label>
                                            <select name="country" id="country_id" required class="form-control choose-country">
                                                <option disabled selected>Select Country/Region</option>
                                                @foreach ($countries as $item)
                                                    <option value="{{$item->name->common}}" @if($item->name->common == $user->country) selected @endif >{{$item->name->common}}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="country_id_error"></small>
                                        </div>

                                        <div class="form-group col-md-6 d-flex flex-column">
                                            <label class="d-none">State/Province <span class="required">*</span></label>
                                            <select name="state" id="state" required
                                                    class="form-control single-select-dropdown">
                                                <option value="" disabled selected></option>
                                            </select>
                                            <small class="text-danger" id="state_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 d-flex flex-column">
                                            <label class="d-none">City <span class="required">*</span></label>
                                            <select name="city" id="city" required
                                                    class="form-control single-select-dropdown">
                                                <option value="" disabled selected></option>
                                            </select>
                                            <small class="text-danger" id="city_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <label class="d-none">Street Address <small class="font-500">(Optional)</small></label>
                                            <input type="text" name="street_address" class="form-control"
                                                   placeholder="Street Address (Optional) - Input Business Address OR Home Address">
                                            <small class="text-danger" id="street_address_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mobilverifynumber">
                                            <div>
                                                <label class="d-none">Mobile <span class="required">*</span></label>
                                                <input type="tel" readonly="" name="phone_no"
                                                       value="{{$user->registration_phone_no}}"
                                                       class="form-control d-inline" id="" placeholder="Mobile - 03xxxxxxxxx/3xxxxxxxxx">
                                                <button class="red-btn mt-sm-0 mt-2" type="button">Verify Mobile</button>
                                            </div>
                                            <small class="text-danger" id="phone_no_error"></small>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div>
                                                <label class="d-none">WhatsApp Number <small
                                                        class="font-500">(Optional)</small></label>
                                                <input type="tel" placeholder="WhatsApp Number (Optional) - 03xxxxxxxxx/3xxxxxxxxx"
                                                       name="whatsapp_number"
                                                       class="form-control inteltel"
                                                       id="whatsappNumber">
                                                <input type="hidden" name="whatsapp_number_country_code">
                                            </div>
                                            <small class="text-danger" id="whatsapp_number_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <div>
                                                <label class="d-none">Telephone <small
                                                        class="font-500">(Optional)</small></label>
                                                <input type="tel" name="telephone" placeholder="Telephone (Optional) - 042xxxxxxxx"
                                                       class="form-control mobileNum inteltel">
                                                <input type="hidden" name="telephone_country_code">
                                            </div>
                                            <small class="text-danger" id="telephone_error"></small>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div>
                                                <label class="d-none">Fax <small
                                                        class="font-500">(Optional)</small></label>
                                                <input type="tel" name="fax" class="form-control" id="" placeholder="Fax (Optional) - Input Fax Number">
                                            </div>
                                            <small class="text-danger" id="fax_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <label class="d-none">Postcode <small class="font-500">(Optional)</small></label>
                                            <input type="text" name="postcode" class="form-control" id="postCode" placeholder="Postcode (Optional) - Input Post Code">
                                            <small class="text-danger" id="postcode_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <label class="d-none">Website <small class="font-500">(Optional)</small></label>
                                            <input type="url" name="website" class="form-control" id="webSite"
                                                   name="website" placeholder="Website (Optional) - Example: https://www.bizonair.com">
                                            <small class="text-danger" id="website_error"></small>
                                        </div>
                                    </div>
                                    <button type="submit" id="accoutn_btn" class="red-btn" disabled>Submit</button>
                                    <button type="button" disabled class="btn-pro d-none red-btn"><span
                                            class="spinner-border spinner-border-sm mr-1" role="status"
                                            aria-hidden="true"></span>Processing
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>

@endsection



@push('js')



    <script>
        $(document).on("change", 'select[name=designation]', function () {
            var other_div = $(this).closest('.form-group').siblings('.other-div');
            if ($(this).val() == 'Other') {
                other_div.show();
                other_div.find('input[name=other_designation]').prop('required', true);
            } else {
                other_div.hide();
                other_div.find('input[name=other_designation]').prop('required', false);
            }
        });
        $(function () {
            $('#state').select2({
                placeholder: "Select State/Province",
            });

            $('#city').select2({
                placeholder: "Select City",
            });

            $('.select2-multiple').select2({
                closeOnSelect: false,
                placeholder: "Categories - Select interest categories",
            });

            $('.select2-multiple5').select2({
                maximumSelectionLength: 5,
                closeOnSelect: false,
                placeholder: "Sub-Categories - Select interest sub categories",
            });

            var validator = $("form[name='updateAccount']").validate({
                onfocusout: function (element) {
                    var $element = $(element);
                    if (!$element.prop('required') && ($element.val() == '' || $element.val() == null)) {
                        $element.removeClass('is-valid');
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
                    city: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    countries: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    whatsapp_number: {
                        phoneNumberFormat: true
                    },
                    telephone: {
                        phoneNumberFormat: true
                    }
                },
                messages: {
                    first_name: "Please enter your firstname",
                    last_name: "Please enter your lastname",
                    email: "Please enter a valid email address",
                    website: "Please enter a valid URL starts from https",
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    if (elem.attr('type') == 'radio') {
                        element2 = elem.closest('.form-group').find('#gender_error');
                        error.insertAfter(element2);
                    } else if (elem.hasClass('inteltel')) {
                        var element2 = elem.closest('.iti');
                        error.insertAfter(element2);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });


        var options = {

            dataType: 'Json',
            beforeSerialize: function ($form, options) {
                $('input[name=whatsapp_number_country_code]').val($("#whatsappNumber").intlTelInput('getSelectedCountryData').dialCode);
                $('input[name=telephone_country_code]').val($(".mobileNum").intlTelInput('getSelectedCountryData').dialCode);
            },

            beforeSubmit: function (arr, $form) {
                if ($("form[name='updateAccount']").valid() && !$("#mobileNumber").hasClass("is-invalid")) {
                    $('#accoutn_btn').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
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


                    $('#alert-error').hide();

                    $('#accoutn_btn').attr('disabled');
                    // $('html, body').animate({scrollTop: 0}, 'slow');

                    // $('#alert-success').html(response.msg);
                    //
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

        $('#accountForm').ajaxForm(options);

        $('#category').on('change', function () {
            $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
            var categories = $(this).val();

            var sub_categories = $('#sub_category1').val();

            $.ajax({
                url: '{{ route("get-sub-category") }}',
                type: "POST",
                data: {
                    categories: categories,
                    sub_categories: sub_categories,
                    _token: '{{ csrf_token()}}',
                    json: 'yes'
                },
                success: function (data) {
                    response = $.parseJSON(data);
                    if (response.feedback == 'true') {
                        // console.log(response.output);
                        $('#sub_category1').html(response.output)
                    } else if (response.feedback == 'false') {

                    }
                    $("#loader").hide();
                },

            });

        });

    </script>

    <script>
        $(document).ready(function() {
            $('#country_id').on('change', function() {
                var country_id = this.value;
                $("#state").html('');
                $.ajax({
                    url:"{{url('/get-state-list')}}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType : 'json',
                    success: function(result){
                        $('#state').html('<option value="" selected disabled></option>');
                        $.each(result.states,function(key,value){
                            $("#state").append('<option value="'+value+'">'+value+'</option>');
                        });
                        $('#city').html('<option value="" selected disabled></option>');
                        $.each(result.cities,function(key,value){
                            $("#city").append('<option value="'+value+'">'+value+'</option>');
                        });
                    }
                });
            });
            {{--$('#state').on('change', function() {--}}
            {{--    var state_id = this.value;--}}
            {{--    $("#city").html('');--}}
            {{--    $.ajax({--}}
            {{--        url:"{{url('/get-city-list')}}",--}}
            {{--        type: "POST",--}}
            {{--        data: {--}}
            {{--            state_id: state_id,--}}
            {{--            _token: '{{csrf_token()}}'--}}
            {{--        },--}}
            {{--        dataType : 'json',--}}
            {{--        success: function(result){--}}
            {{--            $('#city').html('<option value="">Select City</option>');--}}
            {{--            $.each(result.cities,function(key,value){--}}
            {{--                $("#city").append('<option value="'+value.id+'">'+value.name+'</option>');--}}
            {{--            });--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
        });
    </script>

@endpush
