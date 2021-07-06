@extends('front_site.master_layout')

@section('content')

    <body class="dashboard">
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper">

                <div class="d-container py-2">
                    <div class="company-profile">
                        <div>
                            <div class="alert alert-success m-0 mb-0 text-center" id='alert-success' style="display:none;"
                                 role="alert">
                            </div>
                            <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                                 role="alert">
                            </div>
                            <span class="d-block text-center mb-0 heading main-heading font-24">Company Profile</span>
                            <form id="companyForm" name="companyForm" autocomplete="off" action="{{route('company-profile-create')}}"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="office_code" value="{{ rand(2000, 1900000) }}">
                                <span class="d-block mt-0 mb-2 heading basic-info">Basic Info</span>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control is-valid" id="companyName" name="company_name" placeholder="Company Name - My Textile" required>
                                        <small class="text-danger" id="company_name_error"></small>
                                    </div>
                                <!-- <div class="form-group col-md-6">
                                    <label for="companyName" class="label">Industry <span class="required">*</span></label>

                                    <select class="form-control choose-services  selectpicker " multiple name="industry[]">
                                        <option disabled="">--Services--</option>
                                        @foreach (\App\Category::all() as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger" id="industry_error"></small>
                                </div> -->
                                    <div class="form-group col-md-6">
                                        <select class="form-control select2-multiple1" required id="industry" name="industry[]"
                                                multiple>
                                            @foreach (\App\Category::all() as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="industry_error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 business-select">
                                        <select class="form-control select2-multiple2" required name="business_type[]"
                                                multiple="multiple">
                                            <option value="Manufacturer">Manufacturer</option>
                                            <option value="Trading Company">Trading Company</option>
                                            <option value="Supplier Data">Supplier Data</option>
                                            <option value="Agent">Agent</option>
                                            <option value="Other" id="others">Other</option>
                                        </select>
                                        <small class="text-danger" id="business_type_error"></small>
                                    </div>
                                    <div class="form-group col-md-6 other-div">
                                        <input type="text" name="other_business_type" placeholder="Add Business Type - Input Other Business Type"
                                               class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select class="form-control" name="business_nature">
                                            <option value="" selected disabled>Select Nature of Business (Optional)</option>
                                            <option value="Proprietorship">Proprietorship</option>
                                            <option value="Limited">Limited</option>
                                            <option value="Company">Company</option>
                                            <option value="Private Limited Company">Private Limited Company</option>
                                            <option value="Public Limited Company">Public Limited Company</option>
                                            <option value="Partnership">Partnership</option>
                                            <option value="Co-operative">Co-operative</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <small class="text-danger" id="business_nature_error"></small>
                                    </div>
                                    <div class="form-group col-md-6 other-nature-div" style="display: none;">
                                        <input type="text" name="other_business_nature" placeholder="Add Nature of Business - Input Other Nature of Business"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="registeration_no" name="registeration_no"
                                               placeholder="Business License No/Registration No (Optional) - Input Registration Number (if any)">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="year_established" name="year_established"
                                               placeholder="Year Established (Optional) - Input the Year Company was Established">
                                        <small class="text-danger" id="year_established_error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select class="form-control" name="no_of_employees" id="no_of_employees">
                                            <option value="" selected disabled>Number of Employees (Optional) - Input total number of Employees</option>
                                            <option value="0-10">0-10</option>
                                            <option value="Fewer than 50">Fewer than 50</option>
                                            <option value="Fewer than 100">Fewer than 100</option>
                                            <option value="More than 200">More than 200</option>
                                        </select>
                                        <small class="text-danger" id="no_of_employees_error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control"
                                               name="annual_turnover"
                                               id="annual_turnover"
                                               pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"
                                               data-type="currency" placeholder="Annual Turnover (Optional) - Input total turnover in Dollars i.e. $1,000,000">
                                        <small class="text-danger" id="annual_turnover_error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select class="form-control select2-multiple3" name="export_market[]"
                                                multiple="multiple">
                                            <option value="Africa">Africa</option>
                                            <option value="Central Asia">Central Asia</option>
                                            <option value="Eastern Asia">Eastern Asia</option>
                                            <option value="Eastern Europe">Eastern Europe</option>
                                            <option value="Mid East">Mid East</option>
                                            <option value="North America">North America</option>
                                            <option value="Northern Europe">Northern Europe</option>
                                            <option value="Oceania">Oceania</option>
                                            <option value="South America">South America</option>
                                            <option value="South Asia">South Asia</option>
                                            <option value="Southeast Asia">Southeast Asia</option>
                                            <option value="Southeast Europe">Southeast Europe</option>
                                            <option value="Western Europe">Western Europe</option>
                                            <option value="Worldwide">Worldwide</option>
                                        </select>
                                        <small class="text-danger" id="export_market_error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select class="form-control select2-multiple4" name="certifications[]"
                                                multiple="multiple">
                                            <option value="BCI">BCI</option>
                                            <option value="Bluesign">Bluesign</option>
                                            <option value="BSCI">BSCI</option>
                                            <option value="Cradle to Cradle">Cradle to Cradle</option>
                                            <option value="D&B">D&B</option>
                                            <option value="Ecocert">Ecocert</option>
                                            <option value="Fair Trade">Fair Trade</option>
                                            <option value="GOTS">GOTS</option>
                                            <option value="Global Recycle Standard">Global Recycle Standard</option>
                                            <option value="ISO">ISO</option>
                                            <option value="OEKO-TEX">OEKO-TEX</option>
                                            <option value="OHSAS">OHSAS</option>
                                            <option value="REACH">REACH</option>
                                            <option value="Sedex">Sedex</option>
                                            <option value="SA 8000">SA 8000</option>
                                            <option value="WRAP">WRAP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="d-block mb-2 heading">LOGO Image <small class="font-500">(Optional | JPG or PNG file only | Upto
                                                            10MB | Square image recommended)</small></span>
                                    <div class="avatar-wrapper">
                                        <img class="profile-pic" src="{{$ASSET}}/front_site/images/dashboard-logo.jpg"/>
                                        <div class="upload-button">
                                            <span class="fa fa-plus"></span>
                                        </div>
                                        <input class="file-upload" type="file" name="logo_image" accept="image/*"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="d-block mb-2 heading">Company Images <small
                                            class="font-500">(Optional | JPG & PNG files only | Upto 10MB)</small></span>
                                    <div class="dropzone dz-clickable" id="myDrop">
                                        <div class="dz-default dz-message" data-dz-message="">
                                        <span class="fileinput-button">
                                            <span class="fa fa-upload pr-2"></span>
                                            Drop files here to upload
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="company_introduction" maxlength="1200"
                                              placeholder="Company Introduction - Introduce your company in 1200 characters"
                                              id="company_introduction"
                                              rows="5" required></textarea>
                                    <small class="text-danger" id="company_introduction_error"></small>
                                    <span class="text-danger"><span id="company_introduction_count">0</span>/1200</span>
                                </div>
                                <span class="d-block heading additional-info">Additional Business Info</span>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" placeholder="Business Owner (Optional) - Input Business Owner Name"
                                               name="business_owner" id="business_owner">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="tel" class="form-control mobileNum inteltel"
                                               name="alternate_contact"
                                               id="alternate_contact" placeholder="Alternate Contact No (Optional) - 03xxxxxxxxx/3xxxxxxxxx">
                                        <input type="hidden" name="alternate_contact_country_code">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="email" class="form-control" name="alternate_email"
                                               id="alternate_email"
                                               placeholder="Alternate Email (Optional) - Input alternate Email Address">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="alternate_address"
                                               id="alternate_address"
                                               placeholder="Alternate Office Address (Optional) - Input Current Office Address">
                                    </div>
                                </div>
                                <button type="submit" class="red-btn" disabled>Submit</button>
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
        Dropzone.autoDiscover = false;
        $(document).on("change", 'select[name="business_type[]"]', function () {
            var other_div = $(this).closest('.form-group').siblings('.other-div');
            if ($(this).val().includes('Other')) {
                other_div.show();
                other_div.find('input[name=other_business_type]').prop('required', true);
            } else {
                other_div.hide();
                other_div.find('input[name=other_business_type]').prop('required', false);
            }
        });
        $(document).on("change", 'select[name=business_nature]', function () {
            var other_div = $(this).closest('.form-group').siblings('.other-nature-div');
            if ($(this).val() == 'Other') {
                other_div.show();
                other_div.find('input[name=other_business_nature]').prop('required', true);
            } else {
                other_div.hide();
                other_div.find('input[name=other_business_nature]').prop('required', false);
            }
        });
        $(document).ready(function () {
            $("#company_introduction").on('keyup', function () {
                $('#company_introduction_count').text($(this).val().length);
            });
            $('#year_established').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                endDate: '+0d',
                autoclose: true
            });
            $('.select2-multiple1').select2({
                closeOnSelect: false,
                placeholder: "Choose Business Category",
            });
            $('.select2-multiple2').select2({
                closeOnSelect: false,
                placeholder: "Choose Business Type",
            });
            $('.select2-multiple3').select2({
                closeOnSelect: false,
                placeholder: "Choose the Export Market (Optional)",
            });
            $('.select2-multiple4').select2({
                closeOnSelect: false,
                placeholder: "Input Certifications (Optional) (If any)",
            });
            $('.select2-multiple1, .select2-multiple2, .select2-multiple3, .select2-multiple4').on('select2:select', function (e) {
                $(this).siblings('.select2').find('.select2-selection__choice').siblings('.select2-search--inline').css({'width': 'min-content', 'float': 'right'});
            });

            $('.select2-multiple1, .select2-multiple2, .select2-multiple3, .select2-multiple4').on('select2:unselect', function (e) {
                $(this).siblings('.select2').find('.select2-selection__rendered').children('.select2-search--inline').css({'width': '100%', 'float': 'left'});
            });
            var validator = $("form[name='companyForm']").validate({
                ignore: [],
                onfocusout: function (element) {
                    var $element = $(element);
                    if ($element.hasClass('select2-search__field')) {
                        $element2 = $element.closest('.form-group').find('select');
                        if (!$element2.prop('required') && $element2.val() == '') {
                            $element.removeClass('is-valid');
                        } else {
                            this.element($element2)
                        }
                    } else if (!$element.prop('required') && ($element.val() == '' || $element.val() == null)) {
                        $element.removeClass('is-valid');
                    } else {
                        this.element(element)
                    }
                },
                onkeyup: function (element) {
                    var $element = $(element);
                    if ($element.hasClass('select2-search__field')) {
                        $element.closest('.form-group').find('select').valid();
                    } else {
                        $element.valid();
                    }
                },
                rules: {
                    company_name: "required",
                    industry: "required",
                    business_type: "required",
                    alternate_contact: {
                        phoneNumberFormat: true
                    }
                },
                messages: {
                    company_name: "Please enter your company name",
                    industry: "Please select your company",
                    business_type: "Please select your business type",
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                highlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        elem.closest('.form-group').find('input').addClass(errorClass);
                        elem.closest('.form-group').find('input').removeClass(validClass);
                        elem.closest('.form-group').find('span.select2-selection').addClass(errorClass);
                        elem.closest('.form-group').find('span.select2-selection').removeClass(validClass);
                    } else {
                        elem.addClass(errorClass);
                    }
                },
                unhighlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        elem.closest('.form-group').find('input').addClass(validClass);
                        elem.closest('.form-group').find('input').removeClass(errorClass);
                        elem.closest('.form-group').find('span.select2-selection').removeClass(errorClass);
                        elem.closest('.form-group').find('span.select2-selection').addClass(validClass);
                    } else {
                        elem.removeClass(errorClass);
                        elem.addClass(validClass);
                    }
                },
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        var element2 = elem.closest('.form-group').find('.select2-container');
                        error.insertAfter(element2);
                    } else if (elem.hasClass('inteltel')) {
                        var element2 = elem.closest('.iti');
                        error.insertAfter(element2);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $('.select2-multiple').on("change", function (e) {
                $("form[name='companyForm']").valid()
            });
            var myDropzone = new Dropzone("div#myDrop", {
                companyId: '',
                url: "{{route('company-images')}}",
                addRemoveLinks: true,
                dictRemoveFile: '<span class="fa fa-trash delete"></span>',
                autoProcessQueue: false,
                parallelUploads: 5,
                maxThumbnailFilesize: 10,
                maxFilesize: 10,
                maxFiles: 15,
                acceptedFiles: 'image/jpeg,image/png',
                paramName: "file",
                init: function () {
                    let thisDropzone = this;
                    this.on('sending', function (file, xhr, formData) {
                        formData.append('companyId', thisDropzone.companyId);
                    });

                    console.log('init');
                    this.on("maxfilesexceeded", function(file){
                        alert("You cannot upload more than 15 images!");
                        this.removeFile(file);
                    });
                }
            });
            var options = {
                dataType: 'Json',
                beforeSerialize: function ($form, options) {
                    $('input[name=alternate_contact_country_code]').val($(".mobileNum").intlTelInput('getSelectedCountryData').dialCode);
                },
                beforeSubmit: function (arr, $form) {
                    if ($("form[name='companyForm']").valid() && !$("#alternate_contact").hasClass("is-invalid")) {
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
                        myDropzone.companyId = response.company_id;
                        myDropzone.processQueue();
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
            $('#companyForm').ajaxForm(options);
        });
    </script>
@endpush
