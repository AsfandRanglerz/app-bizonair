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

                    <div id="jobTab1">
                        <ul class="nav nav-tabs" id="myCompanyLinks" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="linkProfile" data-toggle="tab" href="#tabProfile"
                                   role="tab" aria-controls="tabProfile" aria-selected="true">Job</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myCompanyTab">
                            <div class="p-2 tab-pane fade show active" id="tabProfile" role="tabpanel"
                                 aria-labelledby="linkProfile">
                                <div class="row">
                                    <div class="col-sm-6 order-sm-1 order-2">
                                        <div class="edit-company-section">
                                            <h6 class="heading">Job Detail   <span class="fa fa-edit edit-btn job-edit-btn" style="cursor: pointer"></span></h6>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Job Title</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->title }}</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Designation </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->designation }}</span>
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
                                                    <span class="font-500">Salary Per Month</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->salary }}</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Currency </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                     <span>{{$info->salary_unit}} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Job Sector </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{$info->textile_sector}}  </span>
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
                                                    <span class="font-500">Job Type </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->job_type }} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Career Level </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->job_level }} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Work Experience </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->work_experience }} </span>
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
                                                    <span class="font-500">City  </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{$info->city}} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Address  </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{$info->address}} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Gender  </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{$info->gender}} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Work Hours </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{$info->work_hour}} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Qualification </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{$info->qualification}} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Key Skills </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->skills }} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Number Of Vacancies </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{$info->vacancies}} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Last Date to Apply </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{date("d-F-Y", strtotime($info->closing_date))}} </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Company  </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $info->company }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 order-sm-2 order-1 mb-2">
                                        <div class="row text">
                                            <div class="col-sm-3">
                                                <h3>Image</h3>
                                            </div>
                                        </div>
                                        <?php $ext = strtolower(pathinfo($info->image, PATHINFO_EXTENSION)); ?>
                                        @if($ext=="docx")
                                            <img class="img-responsive product-img" src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png">
                                        @elseif($ext=="xlsx")
                                            <img class="img-responsive product-img" src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png">
                                        @elseif($ext=="pdf")
                                            <img class="img-responsive product-img" src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png">
                                        @else
{{--                                            <img class="object-contain header-profile-pic" src="{{ $info->image }}">--}}
                                            <img class="border-grey company-profile-logo" src="{{ $info->image }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-sm-12">
                                        <span class="font-500">Job Description</span>
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-sm-12">
                                        <span>{!! $info->job_description !!}</span>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="jobTab2" style="display: none">
                            <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                                 role="alert">
                            </div>
                            <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                                 role="alert">
                            </div>
                            <ul class="mb-2 nav nav-tabs" id="aboutLinks" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="linkReg" data-toggle="tab" href="#tabReg" role="tab"
                                       aria-controls="tabReg" aria-selected="true">JOBS DETAILS</a>
                                </li>
                                <li class="nav-item ml-auto">
                                    <button class="red-btn close-form">Close</button>
                                </li>
                            </ul>
                        <form id="updateJobForm" name="updateJobForm" method="POST" action="{{route('update-view-job-management')}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}">

                            <input type="hidden" name="id" value="{{ $info->id }}">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="text" placeholder="Job Title (Mandatory)"
                                           name="title" id="title" value="{{ $info->title }}" class="form-control" required>
                                    <small class="text-danger" id="title_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" placeholder="Job Designation (Mandatory)"
                                           name="designation" id="designation" value="{{ $info->designation }}" class="form-control"
                                           required>
                                    <small class="text-danger" id="designation_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="email" placeholder="Email Address To Apply (Mandatory)"
                                           name="email" id="email" value="{{ $info->email }}" class="form-control"
                                           required>
                                    <small class="text-danger" id="email_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <label class="font-500 label">Job Description <span>(Optional)</span></label>
                                        <span class="d-block font-500">(Limit = 1200 Characters)</span>
                                    </div>
                                    <textarea class="form-control" id="editor1" name="job_description" placeholder="Job Description">{!! $info->job_description !!}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <input type="number" placeholder="Salary Per Month (Mandatory)"
                                           name="salary" id="salary" value="{{ $info->salary }}" class="form-control"
                                           required>
                                    <small class="text-danger" id="salary_error"></small>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control single-select-dropdown"
                                            id="unit" name="unit" required>
                                        <option value=""></option>
                                        <option disabled>Select Unit (Mandatory)</option>
                                        <option value="PKR" @if($info->salary_unit == "PKR") selected @endif>
                                            PKR
                                        </option>
                                        <option value="USD" @if($info->salary_unit == "USD") selected @endif>
                                            USD
                                        </option>
                                        <option value="Euro" @if($info->salary_unit == "Euro") selected @endif>
                                            Euro
                                        </option>
                                        <option value="Yuan" @if($info->salary_unit == "Yuan") selected @endif>
                                            Yuan
                                        </option>
                                        <option value="Swiss Franc" @if($info->salary_unit == "Swiss Franc") selected @endif>
                                            Swiss Franc
                                        </option>
                                        <option value="JPY" @if($info->salary_unit == "JPY") selected @endif>
                                            JPY
                                        </option>
                                    </select>
                                    <small class="text-danger" id="unit_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <select class="form-control single-select-dropdown"
                                            id="textile_sector" name="textile_sector" required>
                                        <option value=""></option>
                                        <option disabled>Select Job Sector (Mandatory)</option>
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
                                    <select class="form-control single-select-dropdown"
                                            id="functional_area" name="functional_area" required>
                                        <option value=""></option>
                                        <option disabled>Select Functional Area (Mandatory)</option>
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
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="job_type" id="job_type" class="form-control single-select-dropdown" required>
                                        <option value=""></option>
                                        <option disabled>Select Job Type (Mandatory)</option>
                                        <option value="{{ $info->job_type }}" selected>{{ $info->job_type }}</option>
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
                                        <option value=""></option>
                                        <option disabled>Select Career Level (Mandatory)</option>
                                        <option value="{{ $info->job_level }}" selected>{{ $info->job_level }}</option>
                                        <option value="Intern Level">Intern Level</option>
                                        <option value="Entry Level">Entry Level</option>
                                        <option value="Intermediate Level">Intermediate Level</option>
                                        <option value="Mid Level">Mid Level</option>
                                        <option value="Senior Level">Senior Level</option>
                                    </select>
                                    <small class="text-danger" id="job_level_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <select class="form-control single-select-dropdown"
                                            id="work_experience" name="work_experience" required>
                                        <option value=""></option>
                                        <option disabled>Select Experience (Mandatory)</option>
                                        <option value="Fresh / No Experience" @if($info->work_experience == "Fresh / No Experience") selected @endif>
                                            Fresh / No Experience
                                        </option>
                                        <option value="01-03 Years" @if($info->work_experience == "01-03 Years") selected @endif>
                                            01-03 Years
                                        </option>
                                        <option value="03-05 Years" @if($info->work_experience == "03-05 Years") selected @endif>
                                            03-05 Years
                                        </option>
                                        <option value="05-07 Years" @if($info->work_experience == "05-07 Years") selected @endif>
                                            05-07 Years
                                        </option>
                                        <option value="07-10 Years" @if($info->work_experience == "07-10 Years") selected @endif>
                                            07-10 Years
                                        </option>
                                        <option value="10-15 Years" @if($info->work_experience == "10-15 Years") selected @endif>
                                            10-15 Years
                                        </option>
                                        <option value="20+ Years" @if($info->work_experience == "20+ Years") selected @endif>
                                            20+ Years
                                        </option>
                                    </select>
                                    <small class="text-danger" id="work_experience_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="country" id="countryId" class="form-control single-select-dropdown" required>
                                        <option value=""></option>
                                        <option disabled>Select Country (Mandatory)</option>
                                        @foreach ($countries as $item)
                                            <option value="{{$item->name->common}}" @if($info->country == $item->name->common) selected @endif >{{$item->name->common}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger" id="country_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="city" id="cityId" class="form-control single-select-dropdown" required>
                                        <option value=""></option>
                                        <option disabled>Select City (Mandatory)</option>
                                        <option value="{{$info->city}}" selected>{{$info->city}}</option>
                                    </select>
                                    <small class="text-danger" id="city_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" placeholder="Input Office Address (Mandatory)"
                                           name="address" id="address"  value="{{ $info->address }}" class="form-control" required>
                                    <small class="text-danger" id="address_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="gender" id="gender" class="form-control single-select-dropdown">
                                        <option value=""></option>
                                        <option disabled>Select Gender (Mandatory)</option>
                                        <option value="{{$info->gender}}" selected>{{ucfirst($info->gender)}}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Any">Any</option>
                                    </select>
                                    <small class="text-danger" id="gender_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="number" placeholder="Input Job Work Hours (Optional)"
                                           name="work_hour" id="work_hour" value="{{ $info->work_hour }}" class="form-control"
                                    >
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" placeholder="Input Required Qualification (Mandatory)"
                                           name="qualification" id="qualification" value="{{ $info->qualification }}" class="form-control" required>
                                    <small class="text-danger" id="qualification_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="text" placeholder="Input Required Job Skills (Mandatory)"
                                           name="skills" id="skills" value="{{ $info->skills }}" class="form-control">
                                    <small class="text-danger" id="skills_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="number" placeholder="Input Number Of Job Vacancies (Mandatory)"
                                           name="vacancies" id="vacancies" value="{{ $info->vacancies }}" class="form-control"
                                           required>
                                    <small class="text-danger" id="vacancies_error"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" autocomplete="off" placeholder="Set Closing Date (Mandatory)"
                                           name="datePicker" value="{{ $info->closing_date }}"
                                           class="form-control closingdatepicker"
                                           required>
                                    <small class="text-danger" id="datePicker_error"></small>
                                </div>
                            </div>
                            <div class="form-row">
                                @if(getCompanies(auth()->id())->isNotEmpty())
                                    <div class="form-group col-md-4">
                                        <label class="d-none font-500">Company <span class="required">*</span></label>
                                        <select name="company" id="company" class="form-control other-option-included single-select-dropdown" required>
                                            <option value=""></option>
                                            <option disabled>Select Company (Mandatory)</option>
                                            @foreach(getCompanies(auth()->id()) as $company)
                                                <option value="{{$company->company_name}}" @if($info->company == $company->company_name) selected @endif>{{ucwords($company->company_name)}}</option>
                                            @endforeach
                                            <option value="Other" class="other-check" @if($info->company == "Other") selected @endif>Other</option>
                                        </select>
                                        <small class="text-danger" id="company_error"></small>
                                    </div>
                                    <div class="form-group other-div col-md-4" @if($info->company == "Other") style="display: block"; @endif>
                                        <label class="d-none font-500">Other Company Name <span class="required">*</span></label>
                                        <input type="text" name="ocompany" id="ocompany" value="{{$info->other_company}}" class="form-control" placeholder="Input Other Company Name">
                                        <small class="text-danger" id="ocompany_error"></small>
                                    </div>
                                @else
                                    <div class="form-group col-md-4">
                                        <label class="d-none font-500">Company <small class="font-500">(Optional)</small></label>
                                        <input type="text" name="company" placeholder="Input Company Name" id="company" class="form-control" placeholder="Input Company Name"  value="{{$info->company}}">
                                    </div>
                                @endif
                                <div class="form-group col-md-4 career-img-drop-outer attachment-img-file">
                                    <label class="d-block text-left mb-2 font-500">Attachment <small class="font-500">(Optional | Attach Reference or Image)</small></label>
                                    <div class="custom-file">
                                        <input type="file" name="image" id="image" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"><span class="fa fa-upload"></span></label>
                                        <small class="text-danger" id="image_error"></small>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="px-2 product-img-spec-container">
                                        <h6 class="mt-2 heading pro-spec-heading">Attachment</h6>
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
<!--                                                    <img class="img-responsive product-img attachment-img" src="{{$info->image}}">-->
                                                    <img class="border-grey company-profile-logo" src="{{$info->image}}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 mt-2">
                                    <button class="verify-btn red-btn" type="submit" id="job_update_btn">Update Job
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
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        // CKEDITOR.replace( 'job_description' );
        // CKEDITOR.config.width = '100%';
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
        $(document).ready(function () {
            /*select single dropdown*/
            $("#unit").select2({
                placeholder: "Select Unit (Mandatory)"
            });

            $("#textile_sector").select2({
                placeholder: "Select Job Sector (Mandatory)"
            });

            $("#functional_area").select2({
                placeholder: "Select Functional Area (Mandatory)"
            });

            $("#job_type").select2({
                placeholder: "Select Job Type (Mandatory)"
            });

            $("#job_level").select2({
                placeholder: "Select Career Level (Mandatory)"
            });

            $("#work_experience").select2({
                placeholder: "Select Experience (Mandatory)"
            });

            $("#countryId").select2({
                placeholder: "Select Country (Mandatory)"
            });

            $("#cityId").select2({
                placeholder: "Select City (Mandatory)"
            });

            $("#gender").select2({
                placeholder: "Select Gender (Mandatory)"
            });

            $("#company").select2({
                placeholder: "Select Company (Mandatory)"
            });
            /*select single dropdown*/

            $('#company').change(function () {
                if ($(this).val() == 'Other') {
                    $(this).closest('.form-group').siblings('.other-div').show();
                }
                else {
                    $(this).closest('.form-group').siblings('.other-div').hide();
                }
            });
            // // console.log('ready')
            $('.closingdatepicker').datepicker({
                startDate: "0d",
                autoclose: true,
                format: 'yyyy-mm-dd',
                orientation: "bottom left"
            });
            $("textarea[name='job_description']").on('keyup',function() {
                $(this).siblings('span').find('.counter-total-digits').text($(this).val().length);
            });

            $('.job-edit-btn').click(function () {
                $('#jobTab1').hide();
                $('#jobTab2').show();
                $("form[name='updateJobForm']").valid();
            });
            if(window.location.href.includes('jobTab2'))
            {
                $('#jobTab1').hide();
                $('#jobTab2').show();
                $("form[name='updateJobForm']").valid();
                $('.close-form').hide();
            }
            $('.close-form').click(function () {
                window.location.reload();
            });

            var validator = $("form[name='updateJobForm']").validate({
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
                    $('#job_update_btn').addClass('d-none');
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
                    $('#job_update_btn').removeClass('d-none');
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

                        $('#job_update_btn').attr('disabled');
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
                    $('#job_update_btn').removeClass('d-none');
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
            $('#updateJobForm').ajaxForm(options);
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
