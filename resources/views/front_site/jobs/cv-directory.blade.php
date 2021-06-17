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
                        <div class="position-relative d-flex align-items-center">
                            <input class="pr-4 form-control bg-white border-white mr-sm-2" type="search" aria-label="Search" placeholder="Job title, keywords, or company" name="cv-title" required>
                            <span class="fa fa-search position-absolute" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-sm-6">
                        <label class="d-block mb-0 text-white font-500">Where?</label>
                        <label class="d-block text-white">City or province</label>
                        <div class="position-relative d-flex align-items-center">
                            <input class="pr-4 form-control bg-white border-white mr-sm-2" type="search" aria-label="Search" placeholder="City or province" name="cv-location" required>
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
                        href="{{url('jobs-portal')}}">Careers</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{Request::url()}}">CVs Directory</a></li>
            </ol>
        </nav>
        <button  class="filters-btn">Filters<span class="fa fa-bars"></span></button>
        <div class="container-fluid job-portal-inner px-md-3 px-2">
            <div class="form-row mx-0">
                <div class="col-md-3 col-sm-4 pt-md-3 pt-2 pb-sm-3 pr-md-3 px-0 filter-container">
                    <form class="filter-form" action="{{ route('cv-search') }}">
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
                                <input class="form-control" type="text" id="customControl1" name="functional_area" placeholder="Functional Area">
                            </div>
                            <div class="my-1">
                                <input class="form-control" type="text" id="customControl1" name="job_sector" placeholder="Job Sector">
                            </div>
                            <div class="my-1">
                                <input class="form-control" type="text" id="customControl1" name="experience" placeholder="Experience">
                            </div>
                            <div class="my-1">
                                <input class="form-control" type="text" id="customControl1" name="skills" placeholder="Skills">
                            </div>
                            <div class="my-1">
                                <input class="form-control" type="text" id="customControl1" name="edu_level" placeholder="Education Level">
                            </div>
                            <div align="right" class="mt-md-3 mt-1">
                                <button type="submit" class="red-btn">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-9 col-sm-8 px-0 mt-md-3 mt-2">
                    <div class="form-row mx-0">
                        @foreach($cvs as $cv)
                            <div class="col-md-6 px-md-2 px-0 product-box">
                                <div class="description-container">
                                    <div class="short-job-description position-relative">
                                        <a href="{{ route('cvc-detail',$cv->id) }}" class="position-relative d-block text-reset text-decoration-none">
                                            <h6 class="title w-75 overflow-text-dots-one-line">{{ $cv->fname }} {{ $cv->lname }}</h6>
                                            <p class="tag-line mb-0 w-75 overflow-text-dots-one-line">{{ $cv->textile_sector }},{{ $cv->functional_area }}</p>
                                            <p class="short-description">{{ $cv->city }}, {{ $cv->country }}</p>
                                            <p class="short-description">{{ $cv->email }}</p>
                                        </a>
                                        <?php $pathinfo = pathinfo($cv->image);
                                        $supported_ext = array('docx', 'xlsx', 'pdf');
                                        $src_file_name = $cv->image;
                                        $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                        @if($ext=="docx")
                                            <a class="text-decoration-none text-reset" href="{{url('public/'.$cv->image)}}">
                                                <div class="position-absolute dir-download-img">
                                                    <div class="position-relative d-flex justify-content-center align-items-center">
                                                        <img class="img-responsive product-img"
                                                             src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png"
                                                             style="filter: brightness(0.5);width: 50px;height: 50px;">
                                                        <button class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                    </div>
                                                </div>
                                            </a>
                                        @elseif($ext=="xlsx")
                                            <a class="text-decoration-none text-reset" href="{{url('public/'.$cv->image)}}">
                                                <div class="position-absolute dir-download-img">
                                                    <div class="position-relative d-flex justify-content-center align-items-center">
                                                        <img class="img-responsive product-img"
                                                             src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png"
                                                             style="filter: brightness(0.5);width: 50px;height: 50px;">
                                                        <button class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                    </div>
                                                </div>
                                            </a>
                                        @elseif($ext=="pdf")
                                            <a class="text-decoration-none text-reset" href="{{url('public/'.$cv->image)}}">
                                                <div class="position-absolute dir-download-img">
                                                    <div class="position-relative d-flex justify-content-center align-items-center">
                                                        <img class="img-responsive product-img"
                                                             src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png"
                                                             style="filter: brightness(0.5);width: 50px;height: 50px;">
                                                        <button class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                    </div>
                                                </div>
                                            </a>
                                        @else
                                            <img src="{{$ASSETS}}/{{ $cv->image }}" style="width: 50px;height: 50px;" class="position-absolute dir-download-img">
                                        @endif
                                        <div class="d-flex justify-content-between date-salery">
                                            <span><span class="fa fa-calendar pr-2" aria-hidden="true"></span>{{ date("d-F-Y", strtotime($cv->created_at)) }}</span>
                                            <span><span class="fa fa-file pr-2" aria-hidden="true"></span>{{ $cv->total_experience }} Year Experience</span>
                                            <span><span class="fa fa-money pr-2" aria-hidden="true"></span>{{ number_format($cv->exp_salary) }} {{$cv->sal_unit}} Expected</span>
                                        </div>
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
