@extends('front_site.master_layout')



@section('content')

    <body class="dashboard">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/css/timepicker.min.css">
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->

        <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper">

                <div class="d-container py-2">
                    <span class="main-heading">Post Your CV</span>
                    <div class="alert alert-success m-0 mb-2 text-center" id='alert-success-cv' style="display:none;"
                         role="alert">
                    </div>
                    <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error-cv' style="display:none;"
                         role="alert">
                    </div>
                    <div class="create-account">
                        <form id="addcv" name="addcv" method="POST" action="{{route('upload-cv')}}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name - Input First Name" required="required">
                                    <small class="text-danger" id="fname_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="lname" id="lname"  placeholder="Last Name - Input Last Name" required="required">
                                    <small class="text-danger" id="lname_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Contact Number - Input Contact Number" required="required">
                                    <small class="text-danger" id="phone_no_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email - example@gmail.com" required="required">
                                    <small class="text-danger" id="email_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="number" class="form-control" name="total_experience" id="total_experience" placeholder="Total Experience (Years) - Input Total Experience (Years)" required="required">
                                    <small class="text-danger" id="total_experience_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="edu_level" id="edu_level" placeholder="Highest Education Level - Input Highest Education Level" required>
                                    <small class="text-danger" id="edu_level_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select class="form-control"
                                            id="functional_area" name="functional_area" required>
                                        <option value="" selected disabled>Select Functional Area</option>
                                        <option value="Electrical">Electrical </option>
                                        <option value="Mechanical">Mechanical</option>
                                        <option value="Human Resources">Human Resources</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Engineering">Engineering</option>
                                        <option value="Commissioning">Commissioning</option>
                                        <option value="Product Development">Product Development</option>
                                        <option value="Sourcing">Sourcing</option>
                                        <option value="Quality Control">Quality Control</option>
                                        <option value="Testing & Inspection">Testing & Inspection</option>
                                        <option value="Consultation">Consultation</option>
                                        <option value="Production">Production</option>
                                        <option value="Operation">Operation</option>
                                        <option value="MIS">MIS</option>
                                        <option value="Designing">Designing</option>
                                        <option value="Supply Chain">Supply Chain</option>
                                        <option value="Accounts">Accounts</option>
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Sales & Merchandizing">Sales & Merchandizing</option>
                                        <option value="Marketing">Marketing</option>
                                        <option value="Procurement">Procurement</option>
                                        <option value="PPC">PPC</option>
                                        <option value="Imports & Exports">Imports & Exports</option>
                                        <option value="Audit">Audit</option>
                                        <option value="Utilities">Utilities</option>
                                        <option value="ERP">ERP</option>
                                        <option value="Branding">Branding</option>
                                        <option value="Warehouse">Warehouse</option>
                                        <option value="Transportation">Transportation</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <small class="text-danger" id="functional_area_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <select class="form-control"
                                            id="textile_sector" name="textile_sector" required>
                                        <option value="" selected disabled>Select Jobs Sector</option>
                                        <option value="Ginning">Ginning </option>
                                        <option value="Spinning">Spinning</option>
                                        <option value="Knitting">Knitting</option>
                                        <option value="Weaving">Weaving</option>
                                        <option value="Non-Woven">Non-Woven</option>
                                        <option value="Wet Processing">Wet Processing</option>
                                        <option value="Embroidery">Embroidery</option>
                                        <option value="Garments">Garments</option>
                                        <option value="Accessories">Accessories</option>
                                        <option value="Dyes & Chemicals">Dyes & Chemicals</option>
                                        <option value="Retail">Retail</option>
                                        <option value="Personal Protective Equipment">Personal Protective Equipment</option>
                                        <option value="Institutional">Institutional </option>
                                        <option value="Leather">Leather</option>
                                        <option value="Footwear & Bags">Footwear & Bags</option>
                                        <option value="Home Textiles">Home Textiles</option>
                                        <option value="Technical Textiles">Technical Textiles</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <small class="text-danger" id="textile_sector_error"></small>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="number" class="form-control" name="exp_salary" id="exp_salary" placeholder="Expected Salary" required="required">
                                    <small class="text-danger" id="exp_salary_error"></small>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control"
                                            id="unit" name="unit" required>
                                        <option value="" selected disabled>Select Currency</option>
                                        <option value="PKR">PKR</option>
                                        <option value="USD">USD</option>
                                        <option value="Euro">Euro</option>
                                        <option value="Yuan">Yuan</option>
                                        <option value="Swiss Franc">Swiss Franc</option>
                                        <option value="JPY">JPY</option>
                                    </select>
                                    <small class="text-danger" id="unit_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="country" id="countryId" class="form-control" required>
                                        <option value="" selected disabled>Select Country</option>
                                        @foreach ($countries as $item)
                                            <option value="{{$item->name->common}}">{{$item->name->common}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger" id="country_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="city" id="cityId" class="form-control" required>
                                        <option value="" selected disabled>Select City</option>
                                    </select>
                                    <small class="text-danger" id="city_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="key_skills" id="key_skill" placeholder="Key Skills - Input Key Skills" required="required">
                                    <small class="text-danger" id="key_skills_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 career-img-drop-outer attachment-img-file">
                                    <label for="image" class="d-block text-left mb-2 font-500">Attachment <span class="required">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="image" class="custom-file-input" id="customFile" required>
                                        <label class="custom-file-label" for="customFile"><span class="fa fa-download"></span></label>
                                        <small class="text-danger" id="image_error"></small>
                                    </div>
                                </div>
                            </div>
                                <div class="px-0 form-group col-12">
                                    <button class="verify-btn red-btn" type="submit" id="post_cv_btn" disabled>POST CV
                                    </button>
                                    <button type="button" disabled class="btn-pro d-none red-btn"><span
                                            class="spinner-border  spinner-border-sm mr-1" role="status"
                                            aria-hidden="true"></span>Processing
                                    </button>
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
    <script src="{{$ASSET}}/front_site/js/timepicker.min.js"></script>

    <script>
        $(document).ready(function () {
            // // console.log('ready')
            $('.closingdatepicker').datepicker({
                startDate: "0d",
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            var validator = $("form[name='addcv']").validate({
                onfocusout: function (element) {
                    var $element = $(element);
                    // console.log($element);
                    if ($element.prop('required')) {
                        this.element(element)
                    } else if ($element.val() != '') {
                        this.element($element)
                    } else {
                        $element.removeClass('is-valid');
                    }
                },
                rules: {
                    'fname': {
                        required: true,
                    },
                    'lname':{
                        required: true,
                    },
                    'phone_no':{
                        required: true,
                    },
                    'email': {
                        required: true,
                    },
                    'total_experience':{
                        required: true,
                    },
                    'edu_level':{
                        required: true,
                    },
                    'functional_area': {
                        required: true,
                    },
                    'textile_sector':{
                        required: true,
                    },
                    'exp_salary':{
                        required: true,
                    },
                    'unit': {
                        required: true,
                    },
                    'city':{
                        required: true,
                    },
                    'country':{
                        required: true,
                    },
                    'key_skills': {
                        required: true,
                    },
                    onkeyup: function (element) {
                        var $element = $(element);
                        $element.valid();
                    },
                },
                messages: {
                    'fname': {
                        required: "First name is required."
                    },
                    'lname': {
                        required: "Last name is required."
                    },
                    'phone_no': {
                        required: "Phone number is required."
                    },
                    'email': {
                        required: "Email is required."
                    },
                    'total_experience': {
                        required: "Total Experience is required."
                    },
                    'edu_level': {
                        required: "Education level is required."
                    },
                    'functional_area': {
                        required: "Functional area is required."
                    },
                    'textile_sector': {
                        required: "Job sector is required."
                    },
                    'exp_salary': {
                        required: "Expected salary is required."
                    },
                    'unit': {
                        required: "Salary unit is required."
                    },
                    'city': {
                        required: "City is required."
                    },
                    'country': {
                        required: "Country is required."
                    },
                    'key_skills': {
                        required: "Key Skill is required."
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
                    $('#post_cv_btn').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-error-cv').hide();
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-cv').hide();
                    $('#alert-error-cv').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#post_cv_btn').removeClass('d-none');
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
                        $('#alert-error-cv').html(response.custom_msg);
                        $('#alert-error-cv').show().fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        // $('html, body').animate({scrollTop:0}, 'slow');

                        $('#post_cv_btn').attr('disabled');
                        // $('#alert-success').html(response.msg);
                        // $('#alert-success').show().fadeOut(2500);

                        toastr.success(response.msg);
                        window.location.reload();
                    }

                },

                error: function (jqXHR, exception) {
                    $("#loader").hide();
                    $('button[type=submit]').prop('disabled', false);
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-cv').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#post_cv_btn').removeClass('d-none');
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
                    $('#alert-error-cv').html(msg);
                    $('#alert-error-cv').show();
                },

            };
            $('#addcv').ajaxForm(options);
        });

        $(document).delegate('#countryId', 'change', function(e) {
            var country_id = this.value;
            $("#cityId").html('');
            $.ajax({
                url:"{{url('/get-state-list')}}",
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: '{{csrf_token()}}'
                },
                dataType : 'json',
                success: function(result){
                    $('#cityId').html('<option value="" selected disabled>Select City</option>');
                    $.each(result.cities,function(key,value){
                        $("#cityId").append('<option value="'+value+'">'+value+'</option>');
                    });
                }
            });
        });
    </script>

@endpush
