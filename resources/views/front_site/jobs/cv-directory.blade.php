@extends('front_site.master_layout')
@section('content')
    <body>
    <main id="maincontent" class="d-flex flex-column page-main job-directory-container">

        <div class="has-search">
            <form action="{{ route('cv-directory') }}">
                <div class="form-row">
                    <div class="form-group col-md-5 col-sm-6">
                        <label class="d-block mb-0 text-white font-500">What?</label>
                        <label class="d-block text-white">Job title, keywords, or company</label>
                        <div class="position-relative">
                            <input class="form-control bg-white border-white mr-sm-2" type="search" aria-label="Search" placeholder="Job title, keywords, or company" name="cv-title" required>
                            <span class="fa fa-search position-absolute" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-sm-6">
                        <label class="d-block mb-0 text-white font-500">Where?</label>
                        <label class="d-block text-white">City or province</label>
                        <div class="position-relative">
                            <input class="form-control bg-white border-white mr-sm-2" type="search" aria-label="Search" placeholder="City or province" name="cv-location" required>
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
                        href="{{Request::url()}}">CVs Directory</a></li>
            </ol>
        </nav>
        <button type="button" class="filters-btn">Filters<span class="fa fa-bars"></span></button>
        <div class="container-fluid job-portal-inner">
            <div class="form-row">
                <div class="col-md-3 col-sm-4 pt-3 pb-sm-3 filter-container">
                    <form class="filter-form" action="{{ route('cv-search') }}">
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
                                <h6 class="heading">Functional Area</h6>
                                <input class="form-control" type="text" id="customControl1" name="functional_area">
                            </div>
                            <div>
                                <h6 class="heading">Job Sector</h6>
                                <input class="form-control" type="text" id="customControl1" name="job_sector">
                            </div>
                            <div>
                                <h6 class="heading">Experience</h6>
                                <input class="form-control" type="text" id="customControl1" name="experience">
                            </div>
                            <div>
                                <h6 class="heading">Skills</h6>
                                <input class="form-control" type="text" id="customControl1" name="skills">
                            </div>
                            <div>
                                <h6 class="heading">Education Level</h6>
                                <input class="form-control" type="text" id="customControl1" name="edu_level">
                            </div>

                            <div align="right">
                                <button type="submit" class="red-btn">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="form-row">
                        @foreach($cvs as $cv)
                        <div class="col-md-6 pt-3 pb-sm-3">
                            <div class="description-container">
                                <div class="short-job-description">
                                    <a href="{{ route('cvc-detail',$cv->id) }}" class="position-relative d-block text-reset text-decoration-none">
                                    <h6 class="title">{{ $cv->fname }} {{ $cv->lname }}</h6>
                                    <span class="d-block tag-line">{{ $cv->textile_sector }},{{ $cv->functional_area }}</span>
                                    <p class="short-description">{{ $cv->city }}, {{ $cv->country }}</p>
                                    <p class="short-description>{{ $cv->email }}</p>
                                    <p class="short-description">{{ $cv->phone_no }}</p>
                                            <?php $pathinfo = pathinfo($cv->image);
                                            $supported_ext = array('docx', 'xlsx', 'pdf');
                                            $src_file_name = $cv->image;
                                            $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                            @if($ext=="docx")
                                                <a class="text-decoration-none text-reset" href="{{url('public/'.$cv->image)}}">
                                                    <div>
                                                        <img class="img-responsive product-img"
                                                             src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png"
                                                             style="filter: brightness(0.5);width: 50px;height: 50px;">

                                                        <button class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>

                                                    </div>
                                                </a>
                                            @elseif($ext=="xlsx")
                                                <a class="text-decoration-none text-reset" href="{{url('public/'.$cv->image)}}">
                                                    <div>
                                                        <img class="img-responsive product-img"
                                                             src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png"
                                                             style="filter: brightness(0.5);width: 50px;height: 50px;">
                                                        <button
                                                            class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                    </div>
                                                </a>
                                            @elseif($ext=="pdf")
                                                <a class="text-decoration-none text-reset" href="{{url('public/'.$cv->image)}}">
                                                    <div>
                                                        <img class="img-responsive product-img"
                                                             src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png"
                                                             style="filter: brightness(0.5);width: 50px;height: 50px;">
                                                        <button class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                    </div>
                                                </a>
                                    </div>
                                    <div class="mt-4" style="height: 335px">
                                        @else
                                            <img src="{{$ASSETS}}/{{ $cv->image }}" style="width: 50px;height: 50px;" class="position-absolute right-0 top-0">
                                            @endif
                                        <div class="d-flex justify-content-between date-salery">
                                            <span><span class="fa fa-calendar pr-2" aria-hidden="true"></span>{{ date("d-F-Y", strtotime($cv->created_at)) }}</span>
                                            <span><span class="fa fa-file pr-2" aria-hidden="true"></span>{{ $cv->total_experience }} Year Experience</span>
                                            <span><span class="fa fa-money pr-2" aria-hidden="true"></span>{{ number_format($cv->exp_salary) }} {{$cv->sal_unit}} Expected</span>
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
                        <a href="#" class="red-btn">View All CVs</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
@endsection
