@extends('front_site.master_layout')
@section('content')
    <body>
    <main id="maincontent" class="d-flex flex-column page-main job-directory-container">

        <div class="has-search">
            <form action="{{ route('jobs-directory') }}">
                <div class="form-row">
                    <div class="form-group col-md-5 col-sm-6">
                        <label class="d-block mb-0 text-white font-500">What?</label>
                        <label class="d-block text-white">Job title, keywords, or company</label>
                        <div class="position-relative d-flex align-items-center">
                            <input class="pr-4 form-control bg-white border-white" type="search" aria-label="Search" placeholder="Job title, keywords, or company" name="job-title" required>
                            <span class="fa fa-search position-absolute" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-sm-6">
                        <label class="d-block mb-0 text-white font-500">Where?</label>
                        <label class="d-block text-white">City or province</label>
                        <div class="position-relative d-flex align-items-center">
                            <input class="pr-4 form-control bg-white border-white" type="search" aria-label="Search" placeholder="City or province" name="job-location" required>
                            <span class="fa fa-map-marker position-absolute" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-2 d-flex align-items-end">
                        <button  type="submit" class="text-center red-btn w-100">Find Jobs</button>
                    </div>
                </div>
            </form>
        </div>
        <nav aria-label="breadcrumb" class="px-md-3 px-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{url('jobs-portal')}}">Careers</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{Request::url()}}">Careers Directory</a></li>
            </ol>
        </nav>
        <button  class="filters-btn">Filters<span class="fa fa-bars"></span></button>
        <div class="container-fluid job-portal-inner px-md-3 px-2">
            <div class="form-row mx-0">
                <div class="col-md-3 col-sm-4 pt-md-3 pt-2 pb-sm-3 pr-md-3 px-0 filter-container">
                    <form class="filter-form" action="{{ route('job-search') }}">
                        <div class="filter-inner">
                            <h6>Filter Your Search</h6>
                            <div class="salary-range">
                                <h6 class="heading">Min. Salary</h6>
                                <div id="slider-range" class="mt-md-2 mt-2"></div>
                                <div class="form-row my-md-3 my-2 slider-labels">
                                    <div class="col-xs-6 caption">
                                        <strong>Min:</strong> <span id="slider-range-value1"></span>
                                    </div>
                                    <div class="col-xs-6 text-right caption">
                                        <strong>Max:</strong> <span id="slider-range-value2"></span>
                                    </div>
                                </div>
                                <input type="hidden" name="min-value" id="min-salary">
                                <input type="hidden" name="max-value" id="max-salary">
                            </div>
                            <div class="my-1">
                                <input class="form-control" type="text" id="customControl1" name="title" placeholder="Job Title" value="{{ Request::query('title') }}">
                            </div>
                            <div class="my-1">
                                <select class="form-control" id="customControl1" name="functional_area">
                                    <option value="" selected disabled>Functional Area</option>
                                    <option value="Electrical" @if(Request::query('functional_area') == 'Electrical') selected @endif>Electrical </option>
                                    <option value="Mechanical" @if(Request::query('functional_area') == 'Mechanical') selected @endif>Mechanical</option>
                                    <option value="Human Resources" @if(Request::query('functional_area') == 'Human Resources') selected @endif>Human Resources</option>
                                    <option value="Admin" @if(Request::query('functional_area') == 'Admin') selected @endif>Admin</option>
                                    <option value="Engineering" @if(Request::query('functional_area') == 'Engineering') selected @endif>Engineering</option>
                                    <option value="Commissioning" @if(Request::query('functional_area') == 'Commissioning') selected @endif>Commissioning</option>
                                    <option value="Product Development" @if(Request::query('functional_area') == 'Product Development') selected @endif>Product Development</option>
                                    <option value="Sourcing" @if(Request::query('functional_area') == 'Sourcing') selected @endif>Sourcing</option>
                                    <option value="Quality Control" @if(Request::query('functional_area') == 'Quality Control') selected @endif>Quality Control</option>
                                    <option value="Testing & Inspection" @if(Request::query('functional_area') == 'Testing & Inspection') selected @endif>Testing & Inspection</option>
                                    <option value="Consultation" @if(Request::query('functional_area') == 'Consultation') selected @endif>Consultation</option>
                                    <option value="Production" @if(Request::query('functional_area') == 'Production') selected @endif>Production</option>
                                    <option value="Operation" @if(Request::query('functional_area') == 'Operation') selected @endif>Operation</option>
                                    <option value="MIS" @if(Request::query('functional_area') == 'MIS') selected @endif>MIS</option>
                                    <option value="Designing" @if(Request::query('functional_area') == 'Designing') selected @endif>Designing</option>
                                    <option value="Supply Chain" @if(Request::query('functional_area') == 'Supply Chain') selected @endif>Supply Chain</option>
                                    <option value="Accounts" @if(Request::query('functional_area') == 'Accounts') selected @endif>Accounts</option>
                                    <option value="Information Technology" @if(Request::query('functional_area') == 'Information Technology') selected @endif>Information Technology</option>
                                    <option value="Sales & Merchandizing" @if(Request::query('functional_area') == 'Sales & Merchandizing') selected @endif>Sales & Merchandizing</option>
                                    <option value="Marketing" @if(Request::query('functional_area') == 'Marketing') selected @endif>Marketing</option>
                                    <option value="Procurement" @if(Request::query('functional_area') == 'Procurement') selected @endif>Procurement</option>
                                    <option value="PPC" @if(Request::query('functional_area') == 'PPC') selected @endif>PPC</option>
                                    <option value="Imports & Exports" @if(Request::query('functional_area') == 'Imports & Exports') selected @endif>Imports & Exports</option>
                                    <option value="Quality Audit" @if(Request::query('functional_area') == 'Quality Audit') selected @endif>Quality Audit</option>
                                    <option value="Utilities" @if(Request::query('functional_area') == 'Utilities') selected @endif>Utilities</option>
                                    <option value="ERP" @if(Request::query('functional_area') == 'ERP') selected @endif>ERP</option>
                                    <option value="Branding" @if(Request::query('functional_area') == 'Branding') selected @endif>Branding</option>
                                    <option value="Warehouse" @if(Request::query('functional_area') == 'Warehouse') selected @endif>Warehouse</option>
                                    <option value="Transportation" @if(Request::query('functional_area') == 'Transportation') selected @endif>Transportation</option>
                                    <option value="Finance" @if(Request::query('functional_area') == 'Finance') selected @endif>Finance</option>
                                    <option value="Financial Audit" @if(Request::query('functional_area') == 'Financial Audit') selected @endif>Financial Audit</option>
                                </select>
                            </div>
                            <div class="my-1">
                                <select class="form-control" id="customControl1" name="textile_sector">
                                    <option value="" selected disabled>Job Sector</option>
                                    <option value="Ginning" @if(Request::query('textile_sector') == 'Ginning') selected @endif>Ginning </option>
                                    <option value="Spinning" @if(Request::query('textile_sector') == 'Spinning') selected @endif>Spinning</option>
                                    <option value="Knitting" @if(Request::query('textile_sector') == 'Knitting') selected @endif>Knitting</option>
                                    <option value="Weaving" @if(Request::query('textile_sector') == 'Weaving') selected @endif>Weaving</option>
                                    <option value="Non-Woven" @if(Request::query('textile_sector') == 'Non-Woven') selected @endif>Non-Woven</option>
                                    <option value="Wet Processing" @if(Request::query('textile_sector') == 'Wet Processing') selected @endif>Wet Processing</option>
                                    <option value="Embroidery" @if(Request::query('textile_sector') == 'Embroidery') selected @endif>Embroidery</option>
                                    <option value="Garments" @if(Request::query('textile_sector') == 'Garments') selected @endif>Garments</option>
                                    <option value="Accessories" @if(Request::query('textile_sector') == 'Accessories') selected @endif>Accessories</option>
                                    <option value="Dyes & Chemicals" @if(Request::query('textile_sector') == 'Dyes & Chemicals') selected @endif>Dyes & Chemicals</option>
                                    <option value="Retail" @if(Request::query('title') == 'textile_sector') selected @endif>Retail</option>
                                    <option value="Personal Protective Equipment" @if(Request::query('textile_sector') == 'Personal Protective Equipment') selected @endif>Personal Protective Equipment</option>
                                    <option value="Institutional" @if(Request::query('textile_sector') == 'Institutional') selected @endif>Institutional </option>
                                    <option value="Leather" @if(Request::query('textile_sector') == 'Leather') selected @endif>Leather</option>
                                    <option value="Footwear & Bags" @if(Request::query('textile_sector') == 'Footwear & Bags') selected @endif>Footwear & Bags</option>
                                    <option value="Home Textiles" @if(Request::query('textile_sector') == 'Home Textiles') selected @endif>Home Textiles</option>
                                    <option value="Technical Textiles" @if(Request::query('textile_sector') == 'Technical Textiles') selected @endif>Technical Textiles</option>
                                </select>
                            </div>
                            <div class="my-1">
                                <select class="form-control" id="customControl1" name="experience">
                                    <option value="" selected disabled>Experience </option>
                                    <option value="Fresh / No Experience" @if(Request::query('experience') == 'Fresh / No Experience') selected @endif>Fresh / No Experience</option>
                                    <option value="01-03 Years" @if(Request::query('experience') == '01-03 Years') selected @endif>01-03 Years</option>
                                    <option value="03-05 Years" @if(Request::query('experience') == '03-05 Years') selected @endif>03-05 Years</option>
                                    <option value="05-07 Years" @if(Request::query('experience') == '05-07 Years') selected @endif>05-07 Years</option>
                                    <option value="07-10 Years" @if(Request::query('experience') == '07-10 Years') selected @endif>07-10 Years</option>
                                    <option value="10-15 Years" @if(Request::query('experience') == '10-15 Years') selected @endif>10-15 Years</option>
                                    <option value="15-20 Years" @if(Request::query('experience') == '15-20 Years') selected @endif>15-20 Years</option>
                                    <option value="20+ Years" @if(Request::query('experience') == '20+ Years') selected @endif>20+ Years</option>
                                </select>
                            </div>
                            <div class="my-1">
                                <input class="form-control" type="text" id="customControl1" name="skills" placeholder="Skills" value="{{ Request::query('skills') }}">
                            </div>
                            <div>
                                <h6 class="heading my-2">Job Type</h6>
                                <ul data-toggle="buttons" class="mb-md-3 mb-0">
                                    <li class="btn">
                                        <input class="input fa fa-square-o" type="checkbox" id="customControl1" value="Freelance" name="job_type[]">
                                        <label for="customControl1">Freelance</label>
                                    </li>
                                    <li class="btn">
                                        <input class="input fa fa-square-o" type="checkbox" id="customControl2" value="Full Time" name="job_type[]">
                                        <label for="customControl2">Full Time</label>
                                    </li>
                                    <li class="btn">
                                        <input class="input fa fa-square-o" type="checkbox" id="customControl3" value="Part Time" name="job_type[]">
                                        <label for="customControl3">Part Time</label>
                                    </li>
                                    <li class="btn">
                                        <input class="input fa fa-square-o" type="checkbox" id="customControl3" value="Contractual" name="job_type[]">
                                        <label for="customControl3">Contractual</label>
                                    </li>
                                    <li class="btn">
                                        <input class="input fa fa-square-o" type="checkbox" id="customControl3" value="Others" name="job_type[]">
                                        <label for="customControl3">Others</label>
                                    </li>
                                </ul>
                            </div>

                            <div align="right">
                                <button type="submit" class="red-btn">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-9 col-sm-8 px-0 mt-md-3 mt-2">
                    <div class="form-row mx-0">
                        @foreach($jobs as $job)
                        <div class="col-md-6 px-md-2 px-0 product-box">
                            <div class="description-container">
                                <div class="short-job-description">
                                    <a href="{{ route('jobs-detail',$job->id) }}" class="text-reset text-decoration-none">
                                    <h6 class="title overflow-text-dots-one-line">{{ $job->title }}</h6>
                                    <span class="d-block tag-line">{{ $job->city }}, {{ $job->country }}</span>
                                    <p class="short-description my-2 overflow-text-dots"> {!!  strip_tags(\Illuminate\Support\Str::limit($job->job_description, 100))  !!}</p>
                                    <div class="d-flex justify-content-between date-salery">
                                        <span><span class="fa fa-calendar pr-2" aria-hidden="true"></span>{{ date("d-F-Y", strtotime($job->closing_date)) }}</span>
                                        <span><span class="fa fa-file pr-2" aria-hidden="true"></span>{{ $job->work_experience }} Experience</span>
                                        <span><span class="fa fa-money pr-2" aria-hidden="true"></span>{{$job->salary_unit}} {{ number_format($job->salary) }}</span>
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
                    <div align="center" class="my-2">
                        <a href="#" class="load-more red-btn">Load More<span class="ml-2 fa fa-spinner" aria-hidden="true"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
@endsection
@push('js')
    <script src="{{$ASSET}}/front_site/js/range-selector.js"></script>
@endpush
