@extends('front_site.master_layout')
@section('content')
    <body>
    <main id="maincontent" class="d-flex flex-column job-portal-container">
        <div class="has-search">
            <form action="{{ route('jobs-directory') }}">
                <div class="form-row">
                    <div class="form-group col-md-5 col-sm-6">
                        <label class="d-block mb-0 text-white font-500">What?</label>
                        <label class="d-block text-white">Job title, keywords, or company</label>
                        <div class="position-relative">
                            <input class="form-control bg-white border-white mr-sm-2" type="search" aria-label="Search" placeholder="Job title, keywords, or company" name="job-title" style="padding-right: 1.8rem" required>
                            <span class="fa fa-search position-absolute" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-sm-6">
                        <label class="d-block mb-0 text-white font-500">Where?</label>
                        <label class="d-block text-white">City or province</label>
                        <div class="position-relative">
                            <input class="form-control bg-white border-white mr-sm-2" type="search" aria-label="Search" placeholder="City or province" name="job-location" style="padding-right: 1.8rem" required>
                            <span class="fa fa-map-marker position-absolute" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-2 d-flex align-items-end">
                        <button  type="submit" class="text-center red-btn w-100">Find Jobs</button>
                    </div>
                </div>
            </form>

        </div>
        <nav aria-label="breadcrumb" class="px-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{Request::url()}}">Careers</a></li>
            </ol>
        </nav>
        <div class="container px-sm-0 px-2">
            <h4 class="text-center mb-1">CAREERS</h4>
            <p class="mb-1 text-justify paragraph">Bizonair careers is a platform that provides amazing opportunities, to both the job seekers and employers in this gigantic textile industry worldwide. Established companies, SME’s and recruiters can find the biggest pool of professionals for their next hire. Students, graduates and Professionals can seek internships, jobs and attractive career opportunities according to their interests, skills and experience on this online portal. Instead of visiting companies’ websites and job hunting in person you can visit a place where everything is available at a single click.</p>
        </div>

        <div class="container-fluid mb-1 px-2">
            <div class="m-0 row job-explore-post">
                <div class="col-sm-6 px-sm-1 px-0">
                    <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center job-explore-sec">
                        <p class="paragraph">Your Next Hire Is Here</p>
                        <a @if(!Auth::check()) data-toggle="modal" data-target="#login-form" @else href="{{route('view-form-job-management')}}" @endif class="text-center red-btn link">POST JOB</a>
                    </div>
                    <!-- Post a job form -->
                {{--                    <div id="postJobForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="postJobForm" aria-hidden="true">--}}
                {{--                        <div class="modal-dialog contact-form modal-lg" role="document">--}}
                {{--                            <div class="modal-content">--}}
                {{--                                <div class="modal-header">--}}
                {{--                                    <span class="modal-title">Post Your Job</span>--}}
                {{--                                    <button  class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                {{--                                </div>--}}
                {{--                                <div class="modal-body">--}}
                {{--                                    <div class="alert alert-success mb-2 text-center" id='alert-success-post-job' style="display: none"--}}
                {{--                                         role="alert">--}}
                {{--                                    </div>--}}
                {{--                                    <div class="alert alert-danger mb-2 text-center" id='alert-error-post-job' style="display: none"--}}
                {{--                                         role="alert">--}}
                {{--                                    </div>--}}
                {{--                                    <form id="addJobb" name="addJobb" method="POST" action="{{route('create-jobs')}}">--}}
                {{--                                        @csrf--}}
                {{--                                        <div class="form-row">--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <input type="text" class="form-control" name="title" id="title" placeholder="Input Job Title" required="required">--}}
                {{--                                                <small class="text-danger" id="title_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <input type="text" class="form-control" name="designation" id="designation"  placeholder="Enter Designation" required>--}}
                {{--                                                <small class="text-danger" id="designation_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <input type="email" class="form-control" name="email" id="email" placeholder="Input Email Address To Apply" required="required">--}}
                {{--                                                <small class="text-danger" id="email_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}

                {{--                                        <div class="form-group">--}}
                {{--                                            <div id="totalCharLeft">1000 characters remaining</div>--}}
                {{--                                            <textarea class="mb-4 textarea-box form-control" id="job_description" name="job_description" placeholder="Input Job Description" maxlength="1000" ></textarea>--}}
                {{--                                        </div>--}}

                {{--                                        <div class="form-row">--}}
                {{--                                            <div class="form-group col-md-2">--}}
                {{--                                                <input type="number" class="form-control" name="salary" id="salary" placeholder="Salary" required="required">--}}
                {{--                                                <small class="text-danger" id="salary_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-2">--}}
                {{--                                                <select class="form-control"--}}
                {{--                                                        id="unit" name="unit" required>--}}
                {{--                                                    <option value="" selected disabled>Currency</option>--}}
                {{--                                                    <option value="PKR">PKR</option>--}}
                {{--                                                    <option value="USD">USD</option>--}}
                {{--                                                    <option value="Euro">Euro</option>--}}
                {{--                                                    <option value="Yuan">Yuan</option>--}}
                {{--                                                    <option value="Swiss Franc">Swiss Franc</option>--}}
                {{--                                                    <option value="JPY">JPY</option>--}}
                {{--                                                </select>--}}
                {{--                                                <small class="text-danger" id="unit_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <select class="form-control"--}}
                {{--                                                        id="functional_area" name="functional_area" required>--}}
                {{--                                                    <option value="" selected disabled>Functional Area</option>--}}
                {{--                                                    <option value="Electrical">Electrical </option>--}}
                {{--                                                    <option value="Mechanical">Mechanical</option>--}}
                {{--                                                    <option value="Human Resources">Human Resources</option>--}}
                {{--                                                    <option value="Admin">Admin</option>--}}
                {{--                                                    <option value="Engineering">Engineering</option>--}}
                {{--                                                    <option value="Commissioning">Commissioning</option>--}}
                {{--                                                    <option value="Product Development">Product Development</option>--}}
                {{--                                                    <option value="Sourcing">Sourcing</option>--}}
                {{--                                                    <option value="Quality Control">Quality Control</option>--}}
                {{--                                                    <option value="Testing & Inspection">Testing & Inspection</option>--}}
                {{--                                                    <option value="Consultation">Consultation</option>--}}
                {{--                                                    <option value="Production">Production</option>--}}
                {{--                                                    <option value="Operation">Operation</option>--}}
                {{--                                                    <option value="MIS">MIS</option>--}}
                {{--                                                    <option value="Designing">Designing</option>--}}
                {{--                                                    <option value="Supply Chain">Supply Chain</option>--}}
                {{--                                                    <option value="Accounts">Accounts</option>--}}
                {{--                                                    <option value="Information Technology">Information Technology</option>--}}
                {{--                                                    <option value="Sales & Merchandizing">Sales & Merchandizing</option>--}}
                {{--                                                    <option value="Marketing">Marketing</option>--}}
                {{--                                                    <option value="Procurement">Procurement</option>--}}
                {{--                                                    <option value="PPC">PPC</option>--}}
                {{--                                                    <option value="Imports & Exports">Imports & Exports</option>--}}
                {{--                                                    <option value="Audit">Audit</option>--}}
                {{--                                                    <option value="Utilities">Utilities</option>--}}
                {{--                                                    <option value="ERP">ERP</option>--}}
                {{--                                                    <option value="Branding">Branding</option>--}}
                {{--                                                    <option value="Warehouse">Warehouse</option>--}}
                {{--                                                    <option value="Transportation">Transportation</option>--}}
                {{--                                                    <option value="Other">Other</option>--}}
                {{--                                                </select>--}}
                {{--                                                <small class="text-danger" id="functional_area_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <select class="form-control"--}}
                {{--                                                        id="textile_sector" name="textile_sector" required>--}}
                {{--                                                    <option value="" selected disabled>Jobs Sector</option>--}}
                {{--                                                    <option value="Ginning">Ginning </option>--}}
                {{--                                                    <option value="Spinning">Spinning</option>--}}
                {{--                                                    <option value="Knitting">Knitting</option>--}}
                {{--                                                    <option value="Weaving">Weaving</option>--}}
                {{--                                                    <option value="Non-Woven">Non-Woven</option>--}}
                {{--                                                    <option value="Wet Processing">Wet Processing</option>--}}
                {{--                                                    <option value="Embroidery">Embroidery</option>--}}
                {{--                                                    <option value="Garments">Garments</option>--}}
                {{--                                                    <option value="Accessories">Accessories</option>--}}
                {{--                                                    <option value="Dyes & Chemicals">Dyes & Chemicals</option>--}}
                {{--                                                    <option value="Retail">Retail</option>--}}
                {{--                                                    <option value="Personal Protective Equipment">Personal Protective Equipment</option>--}}
                {{--                                                    <option value="Institutional">Institutional </option>--}}
                {{--                                                    <option value="Leather">Leather</option>--}}
                {{--                                                    <option value="Footwear & Bags">Footwear & Bags</option>--}}
                {{--                                                    <option value="Home Textiles">Home Textiles</option>--}}
                {{--                                                    <option value="Technical Textiles">Technical Textiles</option>--}}
                {{--                                                    <option value="Other">Other</option>--}}
                {{--                                                </select>--}}
                {{--                                                <small class="text-danger" id="textile_sector_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="form-row">--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <select name="job_type" id="job_type" class="form-control" required="required">--}}
                {{--                                                    <option value="" selected disabled>--- Select Job Type ---</option>--}}
                {{--                                                    <option value="Freelance">Freelance</option>--}}
                {{--                                                    <option value="Full Time">Full Time</option>--}}
                {{--                                                    <option value="Part Time">Part Time</option>--}}
                {{--                                                    <option value="Contractual">Contractual</option>--}}
                {{--                                                    <option value="Others">Others</option>--}}
                {{--                                                </select>--}}
                {{--                                                <small class="text-danger" id="job_type_error"></small>--}}
                {{--                                            </div>--}}

                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <select name="job_level" id="job_level" class="form-control" required="required">--}}
                {{--                                                    <option value="" selected disabled>--- Select Career Level ---</option>--}}
                {{--                                                    <option value="Fresh">Fresh</option>--}}
                {{--                                                    <option value="Experienced">Experienced</option>--}}
                {{--                                                </select>--}}
                {{--                                                <small class="text-danger" id="job_level_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <input type="number" class="form-control" name="work_hour" id="work_hour" placeholder="Input Job work Hours">--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <div class="form-row">--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <select name="country" id="cntryIdd" class="form-control" required>--}}
                {{--                                                    <option value="" selected disabled>--- Select Country ---</option>--}}
                {{--                                                    @foreach ($countries as $item)--}}
                {{--                                                        <option value="{{$item->name->common}}">{{$item->name->common}}</option>--}}
                {{--                                                    @endforeach--}}
                {{--                                                </select>--}}
                {{--                                                <small class="text-danger" id="country_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <select name="city" id="ctyId" class="form-control" required>--}}
                {{--                                                    <option value="" selected disabled>--- Select City ---</option>--}}
                {{--                                                </select>--}}
                {{--                                                <small class="text-danger" id="city_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <input type="text" class="form-control" name="city" id="city" placeholder="Input Job City" required="required">--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <input type="text" class="form-control" name="address" id="address" placeholder="Input Complete Address" required="required">--}}
                {{--                                                <small class="text-danger" id="address_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}

                {{--                                        <div class="form-row">--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <input type="text" class="form-control" name="qualification" id="qualification" placeholder="Input Required Qualification" required="required">--}}
                {{--                                                <small class="text-danger" id="qualification_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <input type="text" class="form-control" name="skills" id="skills" placeholder="Input Required Job Skills" required="required">--}}
                {{--                                                <small class="text-danger" id="skills_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <input type="number" class="form-control" name="work_experience" id="work_experience" placeholder="Enter Job Work Experience Years" required="required">--}}
                {{--                                                <small class="text-danger" id="work_experience_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}

                {{--                                        <div class="form-row">--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <select name="gender" id="gender" class="form-control" required="required">--}}
                {{--                                                    <option value="" selected disabled>--- Gender ---</option>--}}
                {{--                                                    <option value="male">Male</option>--}}
                {{--                                                    <option value="female">Female</option>--}}
                {{--                                                    <option value="Any">Any</option>--}}
                {{--                                                </select>--}}
                {{--                                                <small class="text-danger" id="gender_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <input type="number" class="form-control" name="vacancies" id="vacancies" placeholder="Input Number of Job Vacancies" required="required">--}}
                {{--                                                <small class="text-danger" id="vacancies_error"></small>--}}
                {{--                                            </div>--}}
                {{--                                            <div class="form-group col-md-4">--}}
                {{--                                                <input type="text" class="form-control" id="datePicker" name="datePicker" placeholder="Set Closing Date" required="required">--}}
                {{--                                                <small class="text-danger" id="datePicker_error"></small>--}}
                {{--                                            </div>--}}

                {{--                                        </div>--}}
                {{--                                        <div class="form-row">--}}
                {{--                                            @if(getCompanies(auth()->id())->isNotEmpty())--}}
                {{--                                                <div class="form-group col-md-4">--}}
                {{--                                                    <select name="company" id="company" class="form-control" required="required">--}}
                {{--                                                        <option value="" selected disabled>--- Select company ---</option>--}}
                {{--                                                        @foreach(getCompanies(auth()->id()) as $company)--}}
                {{--                                                            <option value="{{$company->company_name}}">{{ucwords($company->company_name)}}</option>--}}
                {{--                                                        @endforeach--}}
                {{--                                                    </select>--}}
                {{--                                                    <small class="text-danger" id="company_error"></small>--}}
                {{--                                                </div>--}}
                {{--                                            @else--}}
                {{--                                                <div class="form-group col-md-4">--}}
                {{--                                                    <input type="text" class="form-control" name="company" id="company" placeholder="Input Company Name" >--}}
                {{--                                                    <small class="text-danger" id="company_error"></small>--}}
                {{--                                                </div>--}}
                {{--                                            @endif--}}

                {{--                                                <div class="mt-3 form-group col-md-12 career-img-drop-outer attachment-img-file">--}}
                {{--                                                    <label class="d-block text-left text-white mb-2 font-500">Attachment <small class="font-500">(Attach Reference or Image)</small></label>--}}
                {{--                                                    <div class="custom-file">--}}
                {{--                                                        <input type="file" name="image" id="image" class="custom-file-input" id="customFile">--}}
                {{--                                                        <label class="custom-file-label" for="customFile"><span class="fa fa-download"></span></label>--}}
                {{--                                                        <small class="text-danger" id="image_error"></small>--}}
                {{--                                                    </div>--}}
                {{--                                                </div>--}}

                {{--                                        </div>--}}

                {{--                                        <div class="form-group mt-4 mb-0 text-md-right text-center">--}}
                {{--                                            <button type="submit" class="red-btn" id="job_create_btnnn">POST JOB</button>--}}
                {{--                                            <button  disabled class="btn-pro d-none red-btn"><span--}}
                {{--                                                    class="spinner-border  spinner-border-sm mr-1" role="status"--}}
                {{--                                                    aria-hidden="true"></span>Processing--}}
                {{--                                            </button>--}}
                {{--                                        </div>--}}

                {{--                                    </form>--}}

                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                <!-- Post a job form -->
                </div>
                <div class="col-sm-6 px-sm-1 px-0">
                    <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center job-post-sec">
                        <p class="paragraph">Find Your Next Job</p>
                        <a href="{{ route('jobs-directory') }}" class="text-center red-btn link">EXPLORE JOBS</a>
                    </div>
                </div>
                <div class="col-sm-6 px-sm-1 my-1 px-0">
                    <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center job-explore-sec">
                        <p class="paragraph">It Only Takes A Few Seconds</p>
                        <a @if(!Auth::check()) data-toggle="modal" data-target="#login-form" @else href="{{route('post-ur-cv')}}" @endif class="text-center red-btn link">POST CV</a>
                    </div>
                    <!-- Post a cv form -->
{{--                    <div id="postcvForm"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="postcvForm" aria-hidden="true">--}}
{{--                        <div class="modal-dialog contact-form modal-lg" role="document">--}}
{{--                            <div class="modal-content">--}}
{{--                                <div class="modal-header">--}}
{{--                                    <span class="modal-title">Post Your CV</span>--}}
{{--                                    <button  class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
{{--                                </div>--}}
{{--                                <div class="modal-body">--}}
{{--                                    <div class="alert alert-success mb-2 text-center" id='alert-success-post-cv' style="display: none"--}}
{{--                                         role="alert">--}}
{{--                                    </div>--}}
{{--                                    <div class="alert alert-danger mb-2 text-center" id='alert-error-post-cv' style="display: none"--}}
{{--                                         role="alert">--}}
{{--                                    </div>--}}
{{--                                    <form id="addcv" name="addcv" method="POST" action="{{route('upload-cv')}}">--}}
{{--                                        @csrf--}}
{{--                                        <div class="form-row">--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <input type="text" class="form-control" name="fname" id="fname" placeholder="Input First Name" required="required">--}}
{{--                                                <small class="text-danger" id="fname_error"></small>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <input type="text" class="form-control" name="lname" id="lname"  placeholder="Input Last Name" required="required">--}}
{{--                                                <small class="text-danger" id="lname_error"></small>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Input Phone Number" required="required">--}}
{{--                                                <small class="text-danger" id="phone_no_error"></small>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-row">--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <input type="email" class="form-control" name="email" id="email" placeholder="Input Email Address" required="required">--}}
{{--                                                <small class="text-danger" id="email_error"></small>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <input type="number" class="form-control" name="total_experience" id="total_experience" placeholder="Input Total Experience (Years)" required="required">--}}
{{--                                                <small class="text-danger" id="total_experience_error"></small>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <input type="text" class="form-control" name="edu_level" id="edu_level" placeholder="Input Highest Education Level" required>--}}
{{--                                                <small class="text-danger" id="edu_level_error"></small>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-row">--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <select class="form-control"--}}
{{--                                                        id="functional_area" name="functional_area" required>--}}
{{--                                                    <option value="" selected disabled>Functional Area</option>--}}
{{--                                                    <option value="Electrical">Electrical </option>--}}
{{--                                                    <option value="Mechanical">Mechanical</option>--}}
{{--                                                    <option value="Human Resources">Human Resources</option>--}}
{{--                                                    <option value="Admin">Admin</option>--}}
{{--                                                    <option value="Engineering">Engineering</option>--}}
{{--                                                    <option value="Commissioning">Commissioning</option>--}}
{{--                                                    <option value="Product Development">Product Development</option>--}}
{{--                                                    <option value="Sourcing">Sourcing</option>--}}
{{--                                                    <option value="Quality Control">Quality Control</option>--}}
{{--                                                    <option value="Testing & Inspection">Testing & Inspection</option>--}}
{{--                                                    <option value="Consultation">Consultation</option>--}}
{{--                                                    <option value="Production">Production</option>--}}
{{--                                                    <option value="Operation">Operation</option>--}}
{{--                                                    <option value="MIS">MIS</option>--}}
{{--                                                    <option value="Designing">Designing</option>--}}
{{--                                                    <option value="Supply Chain">Supply Chain</option>--}}
{{--                                                    <option value="Accounts">Accounts</option>--}}
{{--                                                    <option value="Information Technology">Information Technology</option>--}}
{{--                                                    <option value="Sales & Merchandizing">Sales & Merchandizing</option>--}}
{{--                                                    <option value="Marketing">Marketing</option>--}}
{{--                                                    <option value="Procurement">Procurement</option>--}}
{{--                                                    <option value="PPC">PPC</option>--}}
{{--                                                    <option value="Imports & Exports">Imports & Exports</option>--}}
{{--                                                    <option value="Audit">Audit</option>--}}
{{--                                                    <option value="Utilities">Utilities</option>--}}
{{--                                                    <option value="ERP">ERP</option>--}}
{{--                                                    <option value="Branding">Branding</option>--}}
{{--                                                    <option value="Warehouse">Warehouse</option>--}}
{{--                                                    <option value="Transportation">Transportation</option>--}}
{{--                                                    <option value="Other">Other</option>--}}
{{--                                                </select>--}}
{{--                                                <small class="text-danger" id="functional_area_error"></small>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <select class="form-control"--}}
{{--                                                        id="textile_sector" name="textile_sector" required>--}}
{{--                                                    <option value="" selected disabled>Jobs Sector</option>--}}
{{--                                                    <option value="Ginning">Ginning </option>--}}
{{--                                                    <option value="Spinning">Spinning</option>--}}
{{--                                                    <option value="Knitting">Knitting</option>--}}
{{--                                                    <option value="Weaving">Weaving</option>--}}
{{--                                                    <option value="Non-Woven">Non-Woven</option>--}}
{{--                                                    <option value="Wet Processing">Wet Processing</option>--}}
{{--                                                    <option value="Embroidery">Embroidery</option>--}}
{{--                                                    <option value="Garments">Garments</option>--}}
{{--                                                    <option value="Accessories">Accessories</option>--}}
{{--                                                    <option value="Dyes & Chemicals">Dyes & Chemicals</option>--}}
{{--                                                    <option value="Retail">Retail</option>--}}
{{--                                                    <option value="Personal Protective Equipment">Personal Protective Equipment</option>--}}
{{--                                                    <option value="Institutional">Institutional</option>--}}
{{--                                                    <option value="Leather">Leather</option>--}}
{{--                                                    <option value="Footwear & Bags">Footwear & Bags</option>--}}
{{--                                                    <option value="Home Textiles">Home Textiles</option>--}}
{{--                                                    <option value="Technical Textiles">Technical Textiles</option>--}}
{{--                                                    <option value="Other">Other</option>--}}
{{--                                                </select>--}}
{{--                                                <small class="text-danger" id="textile_sector_error"></small>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-2">--}}
{{--                                                <input type="number" class="form-control" name="exp_salary" id="exp_salary" placeholder="Expected Salary" required="required">--}}
{{--                                                <small class="text-danger" id="exp_salary_error"></small>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-2">--}}
{{--                                                <select class="form-control"--}}
{{--                                                        id="unit" name="unit" required>--}}
{{--                                                    <option value="" selected disabled>Currency</option>--}}
{{--                                                    <option value="PKR">PKR</option>--}}
{{--                                                    <option value="USD">USD</option>--}}
{{--                                                    <option value="Euro">Euro</option>--}}
{{--                                                    <option value="Yuan">Yuan</option>--}}
{{--                                                    <option value="Swiss Franc">Swiss Franc</option>--}}
{{--                                                    <option value="JPY">JPY</option>--}}
{{--                                                </select>--}}
{{--                                                <small class="text-danger" id="unit_error"></small>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-row">--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <select name="country" id="countryIdd" class="form-control" required>--}}
{{--                                                    <option value="" selected disabled>--- Select Country ---</option>--}}
{{--                                                    @foreach ($countries as $item)--}}
{{--                                                        <option value="{{$item->name->common}}">{{$item->name->common}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                                <small class="text-danger" id="country_error"></small>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <select name="city" id="cityId" class="form-control" required>--}}
{{--                                                    <option value="" selected disabled>--- Select City ---</option>--}}
{{--                                                </select>--}}
{{--                                                <small class="text-danger" id="city_error"></small>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-4">--}}
{{--                                                <input type="text" class="form-control" name="key_skills" id="key_skill" placeholder="Input Key Skills" required="required">--}}
{{--                                                <small class="text-danger" id="key_skills_error"></small>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-row">--}}
{{--                                            <div class="mt-3 form-group col-md-12 career-img-drop-outer attachment-img-file">--}}
{{--                                                <label class="d-block text-left text-white mb-2 font-500">Attachment <small class="font-500">(Attach CV)</small></label>--}}
{{--                                                <div class="custom-file">--}}
{{--                                                    <input type="file" name="image" id="image" class="custom-file-input" id="customFile">--}}
{{--                                                    <label class="custom-file-label" for="customFile"><span class="fa fa-download"></span></label>--}}
{{--                                                    <small class="text-danger" id="image_error"></small>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group mt-4 mb-0 text-md-right text-center">--}}
{{--                                            <button type="submit" class="red-btn" id="cv_create_btnnn">POST YOUR CV</button>--}}
{{--                                            <button  disabled class="btn-pro d-none red-btn"><span--}}
{{--                                                    class="spinner-border  spinner-border-sm mr-1" role="status"--}}
{{--                                                    aria-hidden="true"></span>Processing--}}
{{--                                            </button>--}}
{{--                                        </div>--}}

{{--                                    </form>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!-- Post a cv form -->
                </div>
                <div class="col-sm-6 px-sm-1 my-1 px-0">
                    <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center job-post-sec">
                        <p class="paragraph">Find Best Human Talent</p>
                        <a href="{{ route('cv-directory') }}" class="text-center red-btn link">EXPLORE All CVs</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-grey">
            <div class="container-fluid pl-md-4 pr-md-4 pb-2 px-2">
                <div class="form-row">
                    <div class="col-xl-4 col-sm-6 order-xl-1 order-1 job-func-loc">
                        <h3 class="text-center my-2 heading">Jobs by Functional Area</h3>
                        <div class="area-loc-section">
                            @foreach($bfarea as $funarea)
                            <a href="{{ route('jobs-directory').'?byfunction='.$funarea->functional_area }}" class="link text-capitalize biz-btn-tooltip" data-placement="bottom" title="<p class='mb-1'>{{$funarea->functional_area}}</p>" data-toggle="tooltip">{{$funarea->functional_area}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-12 order-xl-2 order-3 job-func-loc">
                        <h3 class="text-center mt-xl-0 my-2 heading">Jobs by Sector</h3>
                        <div class="area-loc-section">
                            @foreach($bsector as $tsector)
                                <a href="{{ route('jobs-directory').'?bysector='.$tsector->textile_sector }}" class="link text-capitalize biz-btn-tooltip" data-placement="bottom" title="<p class='mb-1'>{{$tsector->textile_sector}}</p>" data-toggle="tooltip">{{$tsector->textile_sector}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 order-xl-3 order-1 job-func-loc">
                        <h3 class="text-center mt-sm-0 my-2 heading">Jobs by Location</h3>
                        <div class="area-loc-section">
                            @foreach($bcity as $bycity)
                            <a href="{{ route('jobs-directory').'?bylocation='.$bycity->city }}" class="link text-capitalize biz-btn-tooltip" data-placement="bottom" title="<p class='mb-1'>{{$bycity->city}}</p>" data-toggle="tooltip">{{$bycity->city}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid recent-jobs pb-sm-3 pl-md-4 pr-md-4 px-2">
            <div class="text-center position-relative">
                <h3 class="my-2 heading">Recent Jobs</h3>
                <a href="{{ route('jobs-directory') }}" class="position-absolute red-link view-all">VIEW ALL</a>
            </div>
            <div class="form-row">
                @foreach($latest_jobs as $job)
                    <div class="col-lg-4 col-md-6">
                        <div class="description-container">
                            <a href="{{ route('jobs-detail',$job->id) }}" class="red-link text-decoration-none">
                                <div class="short-job-description">
                                <a href="{{ route('jobs-detail',$job->id) }}" class="text-reset text-decoration-none">
                               <h6 class="title">{{ $job->title }}</h6>
                                <span class="d-block tag-line">{{ $job->city }}</span>
                               <p class="short-description mb-2 overflow-text-dots" id="$job->id">{{ $job->job_description }}</p>
                                <div class="d-flex justify-content-between date-salery">
                                    <span><span class="fa fa-calendar pr-2" aria-hidden="true"></span>{{ date("d-F-Y", strtotime($job->closing_date)) }}</span>
                                    <span><span class="fa fa-file pr-2" aria-hidden="true"></span>{{ $job->work_experience }} Year</span>
                                    <span><span class="fa fa-money pr-2" aria-hidden="true"></span>{{ number_format($job->salary) }}</span>
                                </div>
                                </a>
                            </div>
                            </a>
                            <div class="my-2">
                                <hr class="horizontal-line">
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="container-fluid all-jobs pl-md-4 pr-md-4 px-2">

            <div class="text-center position-relative">
                <h3 class="heading">All Jobs</h3>
                <a href="{{ route('jobs-directory') }}" class="position-absolute red-link view-all">VIEW ALL</a>
            </div>
            <div class="form-row">

                @foreach($jobs as $job)
                <div class="col-lg-4 col-md-6">
                    <div class="description-container">
                        <div class="short-job-description">
                            <a href="{{ route('jobs-detail',$job->id) }}" class="text-reset text-decoration-none">
                            <h6 class="title">{{ $job->title }}</h6>
                            <span class="d-block tag-line">{{ $job->city }}</span>
                            <p class="short-description mt-2 overflow-text-dots" id="$job->id">{{ $job->job_description }}</p>
                            <div class="d-flex justify-content-between date-salery">
                                <span><span class="fa fa-calendar pr-2" aria-hidden="true"></span>{{ date("d-F-Y", strtotime($job->closing_date)) }}</span>
                                <span><span class="fa fa-file pr-2" aria-hidden="true"></span>{{ $job->work_experience }} Year</span>
                                <span><span class="fa fa-money pr-2" aria-hidden="true"></span>{{ number_format($job->salary) }}</span>
                            </div>
                            </a>
                        </div>
                        <div class="my-2">
                            <hr class="horizontal-line">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
    </body>
@endsection
@push('js')
    <script src="{{$ASSET}}/front_site/js/timepicker.min.js"></script>

    <script>
        $(document).ready(function () {

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

            var optionscv = {
                dataType: 'Json',

                success: function (data) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-post-cv').hide();
                    $('#alert-error-post-cv').hide();
                    response = data;
                    if (response.feedback == 'false') {
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    } else if (response.feedback == 'invalid') {
                        $('#alert-error-post-cv').html(response.msg);
                        $('#alert-error-post-cv').show();

                    } else {

                        $('#alert-error-post-cv').hide();
                        $('#alert-success-post-cv').html(response.msg);
                        $('#alert-success-post-cv').show();
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);

                    }
                },
                error: function (jqXHR, exception) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-post-cv').hide();
                    $('#alert-error-post-cv').hide();
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
                    $('#alert-error-post-cv').html(msg);
                    $('#alert-error-post-cv').show();
                },

            };
            $('#postcvForm').ajaxForm(optionscv);

            // // console.log('ready')
            $('.closingdatepicker').datepicker({
                startDate: "0d",
                autoclose: true,
                format: 'yyyy-mm-dd',
                // minDate:0,
            });

            var validator = $("form[name='addJobb']").validate({
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
            var optionsjob = {
                dataType: 'Json',

                success: function (data) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-post-job').hide();
                    $('#alert-error-post-job').hide();
                    response = data;
                    if (response.feedback == 'false') {
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    } else if (response.feedback == 'invalid') {
                        $('#alert-error-post-job').html(response.msg);
                        $('#alert-error-post-job').show();

                    } else {

                        $('#alert-error-post-job').hide();
                        $('#alert-success-post-job').html(response.msg);
                        $('#alert-success-post-job').show();
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);

                    }
                },
                error: function (jqXHR, exception) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-post-job').hide();
                    $('#alert-error-post-job').hide();
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
                    $('#alert-error-post-job').html(msg);
                    $('#alert-error-post-job').show();
                },

            };
            $('#addJobb').ajaxForm(optionsjob);
        });
        $(document).delegate('#countryIdd', 'change', function(e) {
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

        $(document).delegate('#cntryIdd', 'change', function(e) {
            var country_id = this.value;
            $("#ctyId").html('');
            $.ajax({
                url:"{{url('/get-state-list')}}",
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: '{{csrf_token()}}'
                },
                dataType : 'json',
                success: function(result){
                    $('#ctyId').html('<option value="" selected disabled>Select City</option>');
                    $.each(result.cities,function(key,value){
                        $("#ctyId").append('<option value="'+value+'">'+value+'</option>');
                    });
                }
            });
        });
    </script>
@endpush
