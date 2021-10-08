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
            <div id="page-content-wrapper" >
                <div class="px-2 py-1">
                    <div id="cvTab1">
                        <ul class="nav nav-tabs" id="myCompanyLinks" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="linkProfile" data-toggle="tab" href="#tabProfile"
                                   role="tab" aria-controls="tabProfile" aria-selected="true">CV</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myCompanyTab">
                            <div class="p-3 tab-pane fade show active" id="tabProfile" role="tabpanel"
                                 aria-labelledby="linkProfile">
                                <div class="row">
                                    <div class="col-sm-6 order-sm-1 order-2">
                                        <div class="edit-company-section">
                                            <h6 class="heading">CV Detail   <span class="fa fa-edit edit-btn cv-edit-btn" style="cursor: pointer"></span></h6>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Name </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->fname  }} {{ $info->lname  }}</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Phone Number </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->phone_no }}</span>
                                                </div>
                                            </div>


                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Email </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->email }}</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Experience (Years)</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->total_experience }}</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Education Level </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                     <span>{{$info->edu_level}} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Functional Area </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{$info->functional_area}} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Textile Sector </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{$info->textile_sector}}  </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Expected Salary </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->exp_salary }} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Salary Unit </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->sal_unit }} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">City </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->city }} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Country  </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{$info->country}} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Key Skills  </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{$info->key_skills}} </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-6 order-sm-2 order-1 my-sm-0 mt-2 mb-4">
                                        <div class="row text">
                                            <div class="col-sm-3">
                                                <span class="font-500">image  </span>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <br>
                                        </div>
                                        <?php $ext = strtolower(pathinfo($info->image, PATHINFO_EXTENSION)); ?>
                                        @if($ext=="docx")
                                            <img class="img-responsive product-img" src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png">
                                        @elseif($ext=="xlsx")
                                            <img class="img-responsive product-img" src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png">
                                        @elseif($ext=="pdf")
                                            <img class="img-responsive product-img" src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png">
                                        @else
                                            <img class="object-contain header-profile-pic" src="{{ $info->image }}" width="135" height="135">
                                        @endif

                                    </div>
                                </div>
                                <div class="my-1">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cvTab2" style="display: none">
                            <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                                 role="alert">
                            </div>
                            <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                                 role="alert">
                            </div>
                            <ul class="nav nav-tabs" id="aboutLinks" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="linkReg" data-toggle="tab" href="#tabReg" role="tab"
                                       aria-controls="tabReg" aria-selected="true">CV DETAILS</a>
                                </li>
                                <li class="nav-item ml-auto">
                                    <button class="red-btn close-form">Close</button>
                                </li>
                            </ul>
                        <form id="updateCvForm" name="updateCvForm" method="POST" action="{{route('update-view-cv-management')}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}">

                            <input type="hidden" name="id" value="{{ $info->id }}">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="font-500">First Name <span class="required">*</span></label>
                                    <input type="text"
                                           name="fname" id="fname" value="{{ $info->fname }}" class="form-control" required>
                                    <small class="text-danger" id="fname_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-500">Last Name <span class="required">*</span></label>
                                    <input type="text"
                                           name="lname" id="lname" value="{{ $info->lname }}" class="form-control"
                                           required>
                                    <small class="text-danger" id="lname_error"></small>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="font-500">Phone Code <span class="required">*</span></label>
                                    <select name="phone_code" id="phone_code" class="form-control single-select-dropdown" required>
                                        <option value="" selected disabled>Select</option>
                                        @foreach (\DB::table('countries')->get() as $item)
                                            <option value="+{{$item->phonecode}}" @if($info->phone_code == +$item->phonecode) selected @endif>+{{$item->phonecode}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger" id="phone_code_error"></small>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="font-500">Contact Number <span class="required">*</span></label>
                                    <input type="text"
                                           name="phone_no" id="phone_no" value="{{ $info->phone_no }}" class="form-control"
                                           required>
                                    <small class="text-danger" id="phone_no_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="font-500">Email Address <span class="required">*</span></label>
                                    <input type="email"
                                           name="email" id="email" value="{{ $info->email }}" class="form-control"
                                           required>
                                    <small class="text-danger" id="email_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-500">Total Experience (Years) <span class="required">*</span></label>
                                    <select class="form-control single-select-dropdown"
                                            id="total_experience" name="total_experience" required>
                                        <option value="Fresh / No Experience" @if($info->total_experience == "Fresh / No Experience") selected @endif>
                                            Fresh / No Experience
                                        </option>
                                        <option value="01-03 Years" @if($info->total_experience == "01-03 Years") selected @endif>
                                            01-03 Years
                                        </option>
                                        <option value="03-05 Years" @if($info->total_experience == "03-05 Years") selected @endif>
                                            03-05 Years
                                        </option>
                                        <option value="05-07 Years" @if($info->total_experience == "05-07 Years") selected @endif>
                                            05-07 Years
                                        </option>
                                        <option value="07-10 Years" @if($info->total_experience == "07-10 Years") selected @endif>
                                            07-10 Years
                                        </option>
                                        <option value="10-15 Years" @if($info->total_experience == "10-15 Years") selected @endif>
                                            10-15 Years
                                        </option>
                                        <option value="20+ Years" @if($info->total_experience == "20+ Years") selected @endif>
                                            20+ Years
                                        </option>
                                    </select>
                                    <small class="text-danger" id="total_experience_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-500">Highest Education Level <span class="required">*</span></label>
                                    <input type="text"
                                           name="edu_level" id="edu_level" value="{{ $info->edu_level }}" class="form-control"
                                           required>
                                    <small class="text-danger" id="edu_level_error"></small>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="font-500">Job Sector <span class="required">*</span></label>
                                    <select class="form-control single-select-dropdown"
                                            id="textile_sector" name="textile_sector" required>
                                        <option value="Ginning" @if($info->textile_sector == "Ginning") selected @endif>Ginning </option>
                                        <option value="Spinning" @if($info->textile_sector == "Spinning") selected @endif>Spinning</option>
                                        <option value="Knitting" @if($info->textile_sector == "Knitting") selected @endif>Knitting</option>
                                        <option value="Weaving" @if($info->textile_sector == "Weaving") selected @endif>Weaving</option>
                                        <option value="Non-Woven" @if($info->textile_sector == "Non-Woven") selected @endif>Non-Woven</option>
                                        <option value="Wet Processing" @if($info->textile_sector == "Wet Processing") selected @endif>Wet Processing</option>
                                        <option value="Embroidery" @if($info->textile_sector == "Embroidery") selected @endif>Embroidery</option>
                                        <option value="Garments" @if($info->textile_sector == "Garments") selected @endif>Garments</option>
                                        <option value="Accessories" @if($info->textile_sector == "Accessories") selected @endif>Accessories</option>
                                        <option value="Dyes & Chemicals" @if($info->textile_sector == "Dyes & Chemicals") selected @endif>Dyes & Chemicals</option>
                                        <option value="Retail" @if($info->textile_sector == "Retail") selected @endif>Retail</option>
                                        <option value="Personal Protective Equipment" @if($info->textile_sector == "Personal Protective Equipment") selected @endif>Personal Protective Equipment</option>
                                        <option value="Institutional" @if($info->textile_sector == "Institutional") selected @endif>Institutional </option>
                                        <option value="Leather" @if($info->textile_sector == "Leather") selected @endif>Leather</option>
                                        <option value="Footwear & Bags" @if($info->textile_sector == "Footwear & Bags") selected @endif>Footwear & Bags</option>
                                        <option value="Home Textiles" @if($info->textile_sector == "Home Textiles") selected @endif>Home Textiles</option>
                                        <option value="Technical Textiles" @if($info->textile_sector == "Technical Textiles") selected @endif>Technical Textiles</option>
                                        <option value="Other" @if($info->textile_sector == "Other") selected @endif>Other</option>
                                    </select>
                                    <small class="text-danger" id="textile_sector_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-500">Functional Area <span class="required">*</span></label>
                                    <select class="form-control single-select-dropdown"
                                            id="functional_area" name="functional_area" required>
                                        <option value="Electrical" @if($info->functional_area == "Electrical") selected @endif>Electrical </option>
                                        <option value="Mechanical" @if($info->functional_area == "Mechanical") selected @endif>Mechanical</option>
                                        <option value="Human Resources" @if($info->functional_area == "Human Resources") selected @endif>Human Resources</option>
                                        <option value="Admin" @if($info->functional_area == "Admin") selected @endif>Admin</option>
                                        <option value="Engineering" @if($info->functional_area == "Engineering") selected @endif>Engineering</option>
                                        <option value="Commissioning" @if($info->functional_area == "Commissioning") selected @endif>Commissioning</option>
                                        <option value="Product Development" @if($info->functional_area == "Product Development") selected @endif>Product Development</option>
                                        <option value="Sourcing" @if($info->functional_area == "Sourcing") selected @endif>Sourcing</option>
                                        <option value="Quality Control" @if($info->functional_area == "Quality Control") selected @endif>Quality Control</option>
                                        <option value="Testing & Inspection" @if($info->functional_area == "Testing & Inspection") selected @endif>Testing & Inspection</option>
                                        <option value="Consultation" @if($info->functional_area == "Consultation") selected @endif>Consultation</option>
                                        <option value="Production" @if($info->functional_area == "Production") selected @endif>Production</option>
                                        <option value="Operation" @if($info->functional_area == "Operation") selected @endif>Operation</option>
                                        <option value="MIS" @if($info->functional_area == "MIS") selected @endif>MIS</option>
                                        <option value="Designing" @if($info->functional_area == "Designing") selected @endif>Designing</option>
                                        <option value="Supply Chain" @if($info->functional_area == "Supply Chain") selected @endif>Supply Chain</option>
                                        <option value="Accounts" @if($info->functional_area == "Accounts") selected @endif>Accounts</option>
                                        <option value="Information Technology" @if($info->functional_area == "Information Technology") selected @endif>Information Technology</option>
                                        <option value="Sales & Merchandizing" @if($info->functional_area == "Sales & Merchandizing") selected @endif>Sales & Merchandizing</option>
                                        <option value="Marketing" @if($info->functional_area == "Marketing") selected @endif>Marketing</option>
                                        <option value="Procurement" @if($info->functional_area == "Procurement") selected @endif>Procurement</option>
                                        <option value="PPC" @if($info->functional_area == "PPC") selected @endif>PPC</option>
                                        <option value="Imports & Exports" @if($info->functional_area == "Imports & Exports") selected @endif>Imports & Exports</option>
                                        <option value="Quality Audit" @if($info->functional_area == "Quality Audit") selected @endif>Quality Audit</option>
                                        <option value="Utilities" @if($info->functional_area == "Utilities") selected @endif>Utilities</option>
                                        <option value="ERP" @if($info->functional_area == "ERP") selected @endif>ERP</option>
                                        <option value="Branding" @if($info->functional_area == "Branding") selected @endif>Branding</option>
                                        <option value="Warehouse" @if($info->functional_area == "Warehouse") selected @endif>Warehouse</option>
                                        <option value="Transportation" @if($info->functional_area == "Transportation") selected @endif>Transportation</option>
                                        <option value="Finance" @if($info->functional_area == "Finance") selected @endif>Finance</option>
                                        <option value="Financial Audit" @if($info->functional_area == "Financial Audit") selected @endif>Financial Audit</option>
                                        <option value="Other" @if($info->functional_area == "Other") selected @endif>Other</option>
                                    </select>
                                    <small class="text-danger" id="functional_area_error"></small>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="font-500">Expected Salary <span class="required">*</span></label>
                                    <input type="number"
                                           name="exp_salary" id="exp_salary" value="{{ $info->exp_salary }}" class="form-control"
                                           required>
                                    <small class="text-danger" id="exp_salary_error"></small>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="font-500">Currency <span class="required">*</span></label>
                                    <select class="form-control single-select-dropdown"
                                            id="unit" name="unit" required>
                                        <option value="PKR" @if($info->sal_unit == "PKR") selected @endif>
                                            PKR
                                        </option>
                                        <option value="USD" @if($info->sal_unit == "USD") selected @endif>
                                            USD
                                        </option>
                                        <option value="Euro" @if($info->sal_unit == "Euro") selected @endif>
                                            Euro
                                        </option>
                                        <option value="Yuan" @if($info->sal_unit == "Yuan") selected @endif>
                                            Yuan
                                        </option>
                                        <option value="Swiss Franc" @if($info->sal_unit == "Swiss Franc") selected @endif>
                                            Swiss Franc
                                        </option>
                                        <option value="JPY" @if($info->sal_unit == "JPY") selected @endif>
                                            JPY
                                        </option>
                                    </select>
                                    <small class="text-danger" id="unit_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="countryId" class="font-500">Country <span class="required">*</span></label>
                                    <select name="country" id="countryId" class="form-control single-select-dropdown" required>
                                        <option value="" selected disabled>--- Select Country ---</option>
                                        @foreach ($countries as $item)
                                            <option value="{{$item->name->common}}" @if($info->country == $item->name->common) selected @endif >{{$item->name->common}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger" id="country_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cityId" class="font-500">City <span class="required">*</span></label>
                                    <select name="city" id="cityId" class="form-control single-select-dropdown" required>
                                        <option value="{{$info->city}}" selected>{{$info->city}}</option>
                                    </select>
                                    <small class="text-danger" id="city_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-500">Key Skills  <span class="required">*</span></label>
                                    <input type="text"
                                           name="key_skills" id="key_skills"  value="{{ $info->key_skills }}" class="form-control" required>
                                    <small class="text-danger" id="key_skills_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 career-img-drop-outer attachment-img-file">
                                    <label class="d-block text-left mb-2 font-500">Attachment <small class="font-500"></small></label>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="image" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"><span class="fa fa-upload"></span></label>
                                        <small class="text-danger" id="image_error"></small>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="px-3 product-img-spec-container">
                                        <h6 class="mt-3 px-2 heading pro-spec-heading">Attachment</h6>
                                        <div class="product-images-gallery">
                                            <div class="row mx-0 my-2 product-gallery">
                                                <?php $ext = strtolower(pathinfo($info->image, PATHINFO_EXTENSION)); ?>
                                                @if($ext=="docx")
                                                    <img class="img-responsive product-img attachment-img" src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png">
                                                @elseif($ext=="xlsx")
                                                    <img class="img-responsive product-img attachment-img" src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png">
                                                @elseif($ext=="pdf")
                                                    <img class="img-responsive product-img attachment-img" src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png">
                                                @else
                                                    <img class="img-responsive product-img attachment-img" src="{{$info->image}}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 mt-2">
                                    <button class="verify-btn red-btn" type="submit" id="cv_update_btn">Submit
                                    </button>
                                    <button  disabled class="btn-pro d-none red-btn"><span
                                            class="spinner-border  spinner-border-sm mr-1" role="status"
                                            aria-hidden="true"></span>Processing
                                    </button>
                                </div>
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
            })
            $('.cv-edit-btn').click(function () {
                $('#cvTab1').hide();
                $('#cvTab2').show();
                $("form[name='updateCvForm']").valid();
            });
            $('.close-form').click(function () {
                window.location.reload();
            });

            var validator = $("form[name='updateCvForm']").validate({
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
                    $('#cv_update_btn').addClass('d-none');
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
                    $('#cv_update_btn').removeClass('d-none');
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

                        $('#cv_update_btn').attr('disabled');
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
                    $('#cv_update_btn').removeClass('d-none');
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
            $('#updateCvForm').ajaxForm(options);
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
