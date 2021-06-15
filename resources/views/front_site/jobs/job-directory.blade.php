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
                        <div class="position-relative">
                            <input class="form-control bg-white border-white mr-sm-2" type="search" aria-label="Search" placeholder="Job title, keywords, or company" name="job-title" required>
                            <span class="fa fa-search position-absolute" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-sm-6">
                        <label class="d-block mb-0 text-white font-500">Where?</label>
                        <label class="d-block text-white">City or province</label>
                        <div class="position-relative">
                            <input class="form-control bg-white border-white mr-sm-2" type="search" aria-label="Search" placeholder="City or province" name="job-location" required>
                            <span class="fa fa-map-marker position-absolute" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-2 d-flex align-items-end">
                        <button  type="submit" class="text-center red-btn w-100">Find Jobs</button>
                    </div>
                </div>
            </form>
        </div>
        <nav aria-label="breadcrumb" class="px-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{url('jobs-portal')}}">Careers</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{Request::url()}}">Careers Directory</a></li>
            </ol>
        </nav>
        <button type="button" class="filters-btn">Filters<span class="fa fa-bars"></span></button>
        <div class="container-fluid job-portal-inner">
            <div class="form-row">
                <div class="col-md-3 col-sm-4 pt-3 pb-sm-3 filter-container">
                    <form class="filter-form" action="{{ route('job-search') }}">
                        <div class="filter-inner">
                            <h6>Filter Your Search</h6>
                            <div class="salary-range">
                                <h6 class="heading">Min. Salary</h6>
                                <div id="slider-range" class="mt-3 mb-3"></div>
                                <div class="form-row mb-3 slider-labels">
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
                            <div>
                                <h6 class="heading">Job Title</h6>
                                <div data-toggle="buttons">
                                    <p>
                                        <input class="form-control" type="text" id="customControl1" name="title">
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h6 class="heading">Functional Area</h6>
                                <div data-toggle="buttons">
                                    <p>
                                        <input class="form-control" type="text" id="customControl1" name="functional_area">
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h6 class="heading">Job Sector</h6>
                                <div data-toggle="buttons">
                                    <p>
                                        <input class="form-control" type="text" id="customControl1" name="textile_sector">
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h6 class="heading">Experience</h6>
                                <div data-toggle="buttons">
                                    <p>
                                        <input class="form-control" type="text" id="customControl1" name="experience">
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h6 class="heading">Skills</h6>
                                <div data-toggle="buttons">
                                    <p>
                                        <input class="form-control" type="text" id="customControl1" name="skills">
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h6 class="heading">Job Type</h6>
                                <ul data-toggle="buttons">
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
                <div class="col-md-9 col-sm-8">
                    <div class="form-row">
                        @foreach($jobs as $job)
                        <div class="col-md-6 pt-3 pb-sm-3">
                            <div class="description-container">
                                <div class="short-job-description">
                                    <a href="{{ route('jobs-detail',$job->id) }}" class="text-reset text-decoration-none">
                                    <h6 class="title">{{ $job->title }}</h6>
                                    <span class="d-block tag-line">{{ $job->city }}</span>
                                    <p class="short-description mt-2 overflow-text-dots">{{ $job->job_description }}</p>
                                    <div class="d-flex justify-content-between date-salery">
                                        <span><span class="fa fa-calendar pr-2" aria-hidden="true"></span>{{ date("d-F-Y", strtotime($job->closing_date)) }}</span>
                                        <span><span class="fa fa-file pr-2" aria-hidden="true"></span>{{ $job->work_experience }} Year</span>
                                        <span><span class="fa fa-money pr-2" aria-hidden="true"></span>{{ number_format($job->salary) }}</span>
                                    </div>
                                    </a>
                                </div>
                                <div class="mt-4 mb-4">
                                    <hr class="horizontal-line">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mb-4" align="center">
                        <a href="#" class="red-btn">View All Jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
@endsection
