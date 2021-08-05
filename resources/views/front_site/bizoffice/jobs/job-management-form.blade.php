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
                    <span class="main-heading">Jobs</span>
                    <div class="alert alert-success m-0 mb-2 text-center" id='alert-success-jbbac' style="display:none;"
                         role="alert">
                    </div>
                    <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error-jbbac' style="display:none;"
                         role="alert">
                    </div>
                    <div class="create-account">
                        <form id="addJobForm" name="addJobpost" method="POST" action="{{route('create-view-job-management')}}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="text" name="title" id="title" class="form-control"
                                           placeholder="Job Title" required>
                                    <small class="text-danger" id="title_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="designation" id="designation" class="form-control"
                                           placeholder="Job Designation" required>
                                    <small class="text-danger" id="designation_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="email" name="email" id="email" class="form-control"
                                           placeholder="Email Address To Apply" required>
                                    <small class="text-danger" id="email_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div for="job_description" class="form-group col-md-12">
                                    <span class="pull-right font-500"><span class="counter-total-digits">0</span>/1200</span>
                                    <textarea name="job_description" id="editor1" class="form-control" maxlength = "1200" rows="6" placeholder="Job Description (Optional)" ></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <input type="number" name="salary" id="salary" class="form-control"
                                           placeholder="Salary Per Month" required>
                                    <small class="text-danger" id="salary_error"></small>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control single-select-dropdown" id="unit" name="unit" required>
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
                                <div class="form-group col-md-4">
                                    <select class="form-control single-select-dropdown"
                                            id="textile_sector" name="textile_sector" required>
                                        <option value="" selected disabled>Select Job Sector</option>
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
                                <div class="form-group col-md-4">
                                    <select class="form-control single-select-dropdown"
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
                                        <option value="Quality Audit">Quality Audit</option>
                                        <option value="Utilities">Utilities</option>
                                        <option value="ERP">ERP</option>
                                        <option value="Branding">Branding</option>
                                        <option value="Warehouse">Warehouse</option>
                                        <option value="Transportation">Transportation</option>
                                        <option value="Finance">Finance</option>
                                        <option value="Financial Audit">Financial Audit</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <small class="text-danger" id="functional_area_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="job_type" id="job_type" class="form-control single-select-dropdown" required>
                                        <option value="" selected disabled>--- Select Job Type ---</option>
                                        <option value="Freelance">Freelance</option>
                                        <option value="Full Time">Full Time</option>
                                        <option value="Part Time">Part Time</option>
                                        <option value="Contractual">Contractual</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <small class="text-danger" id="job_type_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="job_level" id="job_level" class="form-control single-select-dropdown" required>
                                        <option value="" selected disabled>--- Select Career Level ---</option>
                                        <option value="Intern Level">Intern Level</option>
                                        <option value="Entry Level">Entry Level</option>
                                        <option value="Intermediate Level">Intermediate Level</option>
                                        <option value="Mid Level">Mid Level</option>
                                        <option value="Senior Level">Senior Level</option>
                                    </select>
                                    <small class="text-danger" id="job_level_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <select class="form-control single-select-dropdown" id="work_experience" name="work_experience" required>
                                        <option value="" selected disabled>Select Experience </option>
                                        <option value="Fresh / No Experience">Fresh / No Experience</option>
                                        <option value="01-03 Years">01-03 Years</option>
                                        <option value="03-05 Years">03-05 Years</option>
                                        <option value="05-07 Years">05-07 Years</option>
                                        <option value="07-10 Years">07-10 Years</option>
                                        <option value="10-15 Years">10-15 Years</option>
                                        <option value="15-20 Years">15-20 Years</option>
                                        <option value="20+ Years">20+ Years</option>
                                    </select>
                                    <small class="text-danger" id="work_experience_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="country" id="countryId" class="form-control single-select-dropdown" required>
                                        <option value="" selected disabled>--- Select Country ---</option>
                                        @foreach ($countries as $item)
                                            <option value="{{$item->name->common}}">{{$item->name->common}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger" id="country_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="city" id="cityId" class="form-control single-select-dropdown" required>
                                        <option value="" selected disabled>--- Select City ---</option>
                                    </select>
                                    <small class="text-danger" id="city_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text"
                                           name="address" id="address" class="form-control"
                                           placeholder="Office Address" required>
                                    <small class="text-danger" id="address_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="gender" id="gender" class="form-control single-select-dropdown" required>
                                        <option value="" selected disabled>--- Select Gender ---</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="Any">Any</option>
                                    </select>
                                    <small class="text-danger" id="gender_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="number"
                                           name="work_hour" id="work_hour" class="form-control"
                                           placeholder="Work Hours (Optional)">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text"
                                           name="qualification" id="qualification" class="form-control"
                                           placeholder="Qualification" required>
                                    <small class="text-danger" id="qualification_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="text"
                                           name="skills" id="skills" class="form-control"
                                           placeholder="Key Skills" required>
                                    <small class="text-danger" id="skills_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="number"
                                           name="vacancies" id="vacancies" class="form-control"
                                           placeholder="Number Of Vacancies" required>
                                    <small class="text-danger" id="vacancies_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" autocomplete="off"
                                           name="datePicker" class="form-control closingdatepicker"
                                           placeholder="Last Date to Apply" required>
                                    <small class="text-danger" id="datePicker_error"></small>
                                </div>
                            </div>
                            <div class="form-row">


                                @if(getCompanies(auth()->id())->isNotEmpty())
                                    <div class="form-group col-md-4">
                                        <select name="company" id="company" class="form-control single-select-dropdown" required>
                                            <option value="" selected disabled>--- Select Company ---</option>
                                            @foreach(getCompanies(auth()->id()) as $company)
                                                <option value="{{$company->company_name}}">{{ucwords($company->company_name)}}</option>
                                            @endforeach
                                            <option value="Other" class="other-check" id="other_company">Other</option>
                                        </select>
                                        <small class="text-danger" id="company_error"></small>
                                    </div>
                                    <div class="form-group col-md-4 other-div">
                                        <input type="text" name="ocompany" id="ocompany" class="form-control" placeholder="Input Other Company Name">

                                    </div>
                                @else
                                    <div class="form-group col-md-4">
                                        <input type="text" name="company" id="company" class="form-control" placeholder="Input Company Name" >
                                    </div>
                                @endif
                                <div class="form-group col-md-4 career-img-drop-outer attachment-img-file">
                                    <div class="custom-file">
                                        <input type="file" name="image" id="image" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"><span class="fa fa-upload"></span></label>
                                        <small class="text-danger" id="image_error"></small>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-12 mt-2">
                                <button class="verify-btn red-btn" type="submit" id="job_create_btn">POST JOB
                                </button>
                                <button  disabled class="btn-pro d-none red-btn"><span
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
            $('#company').change(function () {
                if ($(this).val() == 'Other') {
                    $(this).closest('.form-group').siblings('.other-div').show();
                }
                else {
                    $(this).closest('.form-group').siblings('.other-div').hide();
                }
            });

            // CKEDITOR.replace( 'job_description' );
            // CKEDITOR.config.width = '100%';
            ClassicEditor
                .create(document.querySelector('#editor1'))
                .catch(error => {
                    console.error(error);
                });
            // // console.log('ready')
            $('.closingdatepicker').datepicker({
                startDate: "0d",
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $("textarea[name='job_description']").on('keyup',function() {
                $(this).siblings('span').find('.counter-total-digits').text($(this).val().length);
            });


            var validator = $("form[name='addJobPost']").validate({
                onfocusout: function (element) {
                    var $element = $(element);
                    console.log($element);
                    if ($element.prop('required')) {
                        this.element(element)
                    } else if ($element.val() != '') {
                        this.element($element)
                    } else {
                        $element.removeClass('is-valid');
                    }
                },
                rules: {
                    'title': {
                        required: true,
                    },
                    'designation':{
                        required: true,
                    },
                    'email':{
                        required: true,
                    },
                    'salary': {
                        required: true,
                    },
                    'functional_area':{
                        required: true,
                    },
                    'textile_sector':{
                        required: true,
                    },
                    'job_type': {
                        required: true,
                    },
                    'job_level':{
                        required: true,
                    },
                    'address':{
                        required: true,
                    },
                    'city': {
                        required: true,
                    },
                    'country':{
                        required: true,
                    },
                    'gender':{
                        required: true,
                    },
                    'work_experience': {
                        required: true,
                    },
                    'qualification':{
                        required: true,
                    },
                    'skills':{
                        required: true,
                    },
                    'vacancies': {
                        required: true,
                    },
                    'datePicker': {
                        required: true,
                    },
                    onkeyup: function (element) {
                        var $element = $(element);
                        $element.valid();
                    },
                },
                messages: {
                    'title': {
                        required: "Title is required."
                    },
                    'designation': {
                        required: "Designation is required."
                    },
                    'email': {
                        required: "Email is required."
                    },
                    'salary': {
                        required: "Salary is required."
                    },
                    'functional_area': {
                        required: "Functional area is required."
                    },
                    'textile_sector': {
                        required: "Textile sector is required."
                    },
                    'job_type': {
                        required: "Job type is required."
                    },
                    'job_level': {
                        required: "Job level is required."
                    },
                    'address': {
                        required: "Address is required."
                    },
                    'city': {
                        required: "City is required."
                    },
                    'country': {
                        required: "Country is required."
                    },
                    'gender': {
                        required: "Gender is required."
                    },
                    'work_experience': {
                        required: "Work experience is required."
                    },
                    'qualification': {
                        required: "Qualification is required."
                    },
                    'skills': {
                        required: "Skills is required."
                    },
                    'vacancies': {
                        required: "Vacancies is required."
                    },
                    'datePicker': {
                        required: "Date is required."
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
                    $('#job_create_btn').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-error-jbbac').hide();
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-jbbac').hide();
                    $('#alert-error-jbbac').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#job_create_btn').removeClass('d-none');
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
                        $('#alert-error-jbbac').html(response.custom_msg);
                        $('#alert-error-jbbac').show().fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        // $('html, body').animate({scrollTop:0}, 'slow');

                        $('#job_create_btn').attr('disabled');
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
                    $('#alert-success-jbbac').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#job_create_btn').removeClass('d-none');
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
                    $('#alert-error-jbbac').html(msg);
                    $('#alert-error-jbbac').show();
                },

            };
            $('#addJobForm').ajaxForm(options);
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
