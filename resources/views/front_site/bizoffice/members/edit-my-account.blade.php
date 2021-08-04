@extends('front_site.master_layout')
@section('content')
    <body class="dashboard">
    <style>
        .iti.iti--allow-dropdown {
            width: 100%;
        }
    </style>
    <main id="maincontent" class="page-main">
        <div class="d-flex edit-company-profile" id="dashboardWrapper">
            <!-- Sidebar -->
        <!-- Sidebar -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper" >
                <div class="px-2 py-1">
                    <div id="companyTab1">
                        <ul class="nav nav-tabs" id="myCompanyLinks" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="linkProfile" data-toggle="tab" href="#tabProfile"
                                   role="tab" aria-controls="tabProfile" aria-selected="true">PROFILE</a>
                            </li>
                            {{--                            <li class="nav-item">--}}
                            {{--                                <a class="nav-link" id="linkLocation" data-toggle="tab" href="#tabLocation" role="tab"--}}
                            {{--                                   aria-controls="tabLocation" aria-selected="false">ADDITIONAL INFO</a>--}}
                            {{--                            </li>--}}
                        </ul>
                        <div class="tab-content" id="myCompanyTab">
                            <div class="px-0 py-3 tab-pane fade show active" id="tabProfile" role="tabpanel"
                                 aria-labelledby="linkProfile">
                                <div class="row">
                                    <div class="col-md-8 order-md-1 order-2">
                                        <div class="edit-company-section">
                                            <h6 class="heading">Personal Information<span
                                                    class="fa fa-edit edit-btn profile-edit-btn"></span></h6>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Name</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Email</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $user->email }}</span>
                                                </div>
                                            </div>
                                            @if($user->is_owner)
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Member Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
											<span>
												@for( $i=0; $i < count($user->types) ; $i++ )
                                                    @if( $i == count($user->types)-1 )
                                                        {{ $user->types[$i]->title }}
                                                    @else
                                                        {{ $user->types[$i]->title }},
                                                    @endif
                                                @endfor
											</span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Designation</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->designation) {{ $user->designation }} @else - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Gender</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->gender) {{ $user->gender }} @else - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Mobile</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $user->registration_phone_no }}</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Address</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                            <span>@if($user->street_address) {{ $user->street_address }}
                                                ,@endif {{ $user->city }}, {{ $user->state }}, {{ $user->country }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4 order-md-2 order-1 my-md-0 text-md-left text-center">
                                        <img class="object-cover rounded-circle header-profile-pic" src="{{ get_user_image(Auth::user()) }}" width="135" height="135">
                                    </div>
                                </div>
                                <div class="my-1">
                                    <hr>
                                </div>
                                <div class="edit-location-section">
                                    <h6 class="heading">Additional Information<span
                                            class="fa fa-edit edit-btn profile-edit-btn"></span></h6>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Whatsapp Number</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->whatsapp_number && $user->whatsapp_number != '+92') {{ $user->whatsapp_number }} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Telephone</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->telephone && $user->telephone != '+92') {{ $user->telephone }} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Fax</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->fax && $user->fax != '+92') {{ $user->fax }} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Post Code</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->postcode) {{ $user->postcode }} @else - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Website</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>
                                                        @if($user->website)
                                                            <a href="{{ $user->website }}">{{ $user->website }}</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <hr>
                                </div>
                                <div class="edit-location-section">
                                    <h6 class="heading">Parent Company Name</h6>
                                    <div class="row text">
                                        <div class="col-sm-6 col-6">
                                            <?php $comp = \App\CompanyProfile::where('user_id',auth()->id())->first();?>
                                            <span class="font-500">@if($comp) {{getUserFirstCompany()}} @else - @endif </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            <div class="p-3 tab-pane fade" id="tabLocation" role="tabpanel"--}}
                            {{--                                 aria-labelledby="linkLocation">--}}


                            {{--                                <div class="my-1">--}}
                            {{--                                    <hr>--}}
                            {{--                                </div>--}}

                            {{--                            </div>--}}
                        </div>
                    </div>
                    <div id="companyTab2">
                        <div id='alert-success-update-account' class="alert alert-success py-2" style="display: none;">
                        </div>
                        <div id='alert-error-update-account' class="alert alert-danger py-2" style="display: none;">
                        </div>
                        <ul class="nav nav-tabs" id="aboutLinks" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="linkReg" data-toggle="tab" href="#tabReg" role="tab"
                                   aria-controls="tabReg" aria-selected="true">ACCOUNT DETAILS</a>
                            </li>
                            <li class="nav-item ml-auto">
                                <button class="red-btn close-form">Close</button>
                            </li>
                            {{--                            <li class="nav-item">--}}
                            {{--                                <a class="nav-link" id="linkInfo" data-toggle="tab" href="#tabInfo" role="tab"--}}
                            {{--                                   aria-controls="tabInfo" aria-selected="false">ADDITIONAL INFO</a>--}}
                            {{--                            </li>--}}
                        </ul>
                        <form id="updateAccount" name="updateAccount" method="post"
                              action="{{ route('update-my-account') }}">
                            @csrf
                            @method('put')
                            <div class="tab-content" id="myCompanyTab">
                                <div class="px-0 py-1 tab-pane fade show active" id="tabReg" role="tabpanel"
                                     aria-labelledby="tabReg">
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="email" id="email" class="form-control" name="email"
                                                   value="{{ old('email', $user->email) }}" placeholder="Email - example@gmail.com">
                                            <small class="text-danger" id="email_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <select id="designation" name='designation'
                                                    class="form-control choose-country">
                                                <option selected disabled>--- Select Designation (Optional) ---</option>
                                                <option value="Director"
                                                        @if($user->designation == "Director") selected @endif >Director
                                                </option>
                                                <option value="CEO" @if($user->designation == "CEO") selected @endif >
                                                    CEO
                                                </option>
                                                <option value="General Manager"
                                                        @if($user->designation == "General Manager") selected @endif >
                                                    General Manager
                                                </option>
                                                <option value="Owner"
                                                        @if($user->designation == "Owner") selected @endif >Owner
                                                </option>
                                                <option value="Entrepreneur"
                                                        @if($user->designation == "Entrepreneur") selected @endif >
                                                    Entrepreneur
                                                </option>
                                                <option value="Marketing"
                                                        @if($user->designation == "Marketing") selected @endif >
                                                    Marketing
                                                </option>
                                                <option value="Sales"
                                                        @if($user->designation == "Sales") selected @endif >Sales
                                                </option>
                                                <option value="Purchasing"
                                                        @if($user->designation == "Purchasing") selected @endif >
                                                    Purchasing
                                                </option>
                                                <option value="Technical & Engineering"
                                                        @if($user->designation == "Technical & Engineering") selected @endif >
                                                    Technical & Engineering
                                                </option>
                                                <option value="Administration"
                                                        @if($user->designation == "Administration") selected @endif >
                                                    Administration
                                                </option>
                                                <option value="Others" id="otherUser"
                                                        @if($user->designation == "Other") selected @endif >Other</option>
                                            </select>
                                            <small class="text-danger" id="designation_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="text" class="form-control"
                                                   value="{{ old('first_name', $user->first_name) }}"
                                                   placeholder="First Name" name="first_name" id="first_name">
                                            <small class="text-danger" id="first_name_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="text" name="last_name" class="form-control"
                                                   value="{{ old('last_name', $user->last_name) }}"
                                                   placeholder="Last Name" id="last_name">
                                            <small class="text-danger" id="last_name_error"></small>
                                        </div>
                                    </div>
                                    @if($user->is_owner)
                                        <div class="form-row user-type-section">
                                            {{--                                            <h6 class="w-100 pl-0">User Type <span class="required">*</span></h6>--}}
                                            <div class="form-group mb-1 user-type col-xl-9 col-lg-12">
                                                <label for="last_name" class="font-500">User Type <span
                                                        class="required">*</span></label>
                                                @foreach (\App\UType::limit(3)->get() as $type)
                                                    @if($user->types->find($type->id))
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input" id="{{$type->id}}" value="{{$type->id}}" data-id="{{$type->id}}" name="user_type[]" checked>
                                                            <label class="custom-control-label" for="{{$type->id}}">{{$type->title}}</label>
                                                        </div>
                                                    @else
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input" id="{{$type->id}}" value="{{$type->id}}" data-id="{{$type->id}}" name="user_type[]">
                                                            <label class="custom-control-label" for="{{$type->id}}">{{$type->title}}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <small class="text-danger" id="user_type_error"></small>
                                            </div>
                                        </div>
                                    @endif
                                    <label class="font-500">Gender <span class="required">*</span></label>
                                    <div class="my-1 d-flex flex-row">
                                        <div class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                            <input type="radio" class="custom-control-input" name="gender" id="male"
                                                   value="Male" @if($user->gender == "Male") checked @endif>
                                            <label class="custom-control-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                            <input type="radio" class="custom-control-input" name="gender" id="female"
                                                   value="Female" @if($user->gender == "Female") checked @endif>
                                            <label class="custom-control-label" for="female">Female</label>
                                        </div>
                                        <small class="text-danger" id="gender_error"></small>
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label for="last_name" class="font-500">Gender <span--}}
{{--                                                class="required">*</span></label>--}}
{{--                                        <div class="form-check-inline">--}}
{{--                                            <input class="form-check-input" type="radio" name="gender" id="male"--}}
{{--                                                   value="Male" @if($user->gender == "Male") checked @endif >--}}
{{--                                            <label class="form-check-label" for="male">Male</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-check-inline">--}}
{{--                                            <input class="form-check-input" type="radio" name="gender" id="female"--}}
{{--                                                   value="Female" @if($user->gender == "Female") checked @endif >--}}
{{--                                            <label class="form-check-label" for="female">Female</label>--}}
{{--                                        </div>--}}
{{--                                        <small class="text-danger" id="gender_error"></small>--}}
{{--                                    </div>--}}
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <select name="country" id="country_id" class="form-control choose-country"
                                                    required="required">
                                                <option value="" selected disabled>Select Country</option>
                                                @foreach($countries as $country)
                                                        <option value="{{ $country->name->common }}" {{($user->country == $country->name->common)?'selected':''}}>{{ $country->name->common }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="country_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <select name="state" id="state" required
                                                    class="form-control single-select-dropdown">
                                                <option value="{{$user->state}}">{{$user->state}}</option>
                                            </select>
                                            <small class="text-danger" id="state_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <select name="city" id="city" required class="form-control single-select-dropdown">
                                                <option value="{{$user->city}}">{{$user->city}}</option>
                                            </select>
                                            <small class="text-danger" id="city_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="text" id="Cty" class="form-control" name="street_address"
                                                   value="{{ old('street_address', $user->street_address) }}"
                                                   placeholder="Street Address (Optional)">
                                            <small class="text-danger" id="street_address_error"></small>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="tel" required name="mobileNumber"
                                                   class="form-control inteltel is-valid"
                                                   id="mobileNumber"
                                                   value="{{ old('mobile', $user->registration_phone_no) }}" placeholder="Mobile - 03xxxxxxxxx/3xxxxxxxxx">
                                            <span class="text-danger hide row pl-3 tel-error-msg">Please enter valid mobile number</span>
                                            <input type="hidden" name="mobile_country_code">
                                            <small class="text-danger d-block" id="mobileNumber_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="text" id="postcode" class="form-control" name="postcode"
                                                   value="{{ old('postcode', $user->postcode) }}"
                                                   placeholder="Post Code (Optional)">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="url" id="url" class="form-control" name="url"
                                                   value="{{ old('url', $user->website) }}"
                                                   placeholder="Website (Optional) - Example: https://www.bizonair.com">
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="tel" id="whatsappNumber" class="form-control inteltel is-valid"
                                                   name="whatsapp"
                                                   value="{{ old('whatsapp', $user->whatsapp_number) }}"
                                                   placeholder="Whatsapp (Optional) - 03xxxxxxxxx/3xxxxxxxxx">
                                            <span class="text-danger hide row pl-3 tel-error-msg">Please enter valid mobile number</span>
                                            <input type="hidden" name="whatsapp_country_code">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="text" id="mobileNumber3"
                                                   class="form-control mobileNum inteltel is-valid"
                                                   name="telephone"
                                                   value="{{ old('telephone', $user->telephone) }}"
                                                   placeholder="Telephone (Optional) - 03xxxxxxxxx/3xxxxxxxxx">
                                            <span class="text-danger hide row pl-3 tel-error-msg">Please enter valid mobile number</span>
                                            <input type="hidden" name="telephone_country_code">
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="tel" id="mobileNumber4" class="form-control" name="fax"
                                                   value="{{ old('fax', $user->fax) }}" placeholder="Fax (Optional)">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-1">
                                        <button type="submit" class="red-btn">Update</button>
                                    </div>
                                    <div class="my-1">
                                        <hr>
                                    </div>
                                </div>
                                {{--                                <div class="p-3 tab-pane fade" id="tabInfo" role="tabpanel" aria-labelledby="tabInfo">--}}
                                {{--                                    --}}
                                {{--                                    <div class="d-flex justify-content-between mt-1">--}}
                                {{--                                        <button type="submit" class="red-btn">SAVE</button>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="my-1">--}}
                                {{--                                        <hr>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </main>
    </body>

@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var validator = $("form[name='updateAccount']").validate({
                onfocusout: function (element) {
                    var $element = $(element);
                    if ($element.prop('required')) {
                        this.element(element)
                    } else if ($element.val() != '') {
                        this.element($element)
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
                    country: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    whatsapp: {
                        phoneNumberFormat: true
                    },
                    mobileNumber: {
                        phoneNumberFormat: true
                    },
                    telephone: {
                        phoneNumberFormat: true
                    },
                },
                messages: {
                    first_name: "Please enter your firstname",
                    last_name: "Please enter your lastname",
                    email: "Please enter a valid email address",
                    country: "Please select country",
                    city: "Please select city",
                    state: "Please select state",
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    if (elem.hasClass('form-check-input')) {
                        var element2 = elem.closest('.form-group').find('.form-check-inline:last');
                        error.insertAfter(element2);
                    } else if (elem.hasClass('inteltel')) {
                        var element2 = elem.closest('.iti');
                        error.insertAfter(element2);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $('#updateAccount').find('input').focusout(function () {
                $("form[name='updateAccount']").valid();
            });

            $("#updateAccount").ajaxForm({
                dataType: 'JSON',
                beforeSerialize: function ($form, options) {
                    $('input[name=mobile_country_code]').val($("#mobileNumber").intlTelInput('getSelectedCountryData').dialCode);
                    $('input[name=whatsapp_country_code]').val($("#whatsappNumber").intlTelInput('getSelectedCountryData').dialCode);
                    $('input[name=telephone_country_code]').val($(".mobileNum").intlTelInput('getSelectedCountryData').dialCode);
                },
                beforeSubmit: function (arr, $form) {
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
                },
                success: function (response, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-update-account').hide();
                    $('#alert-error-update-account').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    if (response.feedback == "updated") {
                        // $('html, body').animate({scrollTop: 0}, 'slow');
                        toastr.success("Account updated successfully");
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 2000);
                    } else if (response.feedback == "validation_error") {
                        $form.find('button[type=submit]').prop('disabled', false);
                        $('html, body').animate({scrollTop: ($('#' + Object.keys(response.errors)[0]).offset().top)}, 'slow');
                        $('#' + Object.keys(response.errors)[0]).focus();
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    }

                },
                error: function (jqXHR, exception) {
                    $("#loader").hide();
                    $('button[type=submit]').prop('disabled', false);
                    $('#alert-success-update-account').hide();
                    $('#alert-error-update-account').hide();
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
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-error-update-account').show().html(msg);
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
                        $('#state').html('<option value="">Select State</option>');
                        $.each(result.states,function(key,value){
                            $("#state").append('<option value="'+value+'">'+value+'</option>');
                        });
                        $('#city').html('<option value="">Select City</option>');
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
            {{--                $("#city").append('<option value="'+value.name+'">'+value.name+'</option>');--}}
            {{--            });--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
        });
    </script>
@endpush
