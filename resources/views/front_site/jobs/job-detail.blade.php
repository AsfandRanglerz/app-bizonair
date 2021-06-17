@extends('front_site.master_layout')
@section('content')
    <body>
    <main id="maincontent" class="d-flex flex-column job-details-container">
        <div class="banner-outer">
            <div class="banner">
                <h3 class="text-white text-center heading">Apply Now – It only takes few seconds</h3>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="px-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{url('jobs-portal')}}">Careers</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{Request::url()}}">Careers Detail</a></li>
            </ol>
        </nav>
        <div class="container-fluid px-2">
            <div class="row m-0 pt-1">
                @foreach($jobsdet as $job)
                <div class="col-xl-3 col-lg-4 col-md-5 pl-md-2 pr-md-2 p-0">
                    <div class="h-100 side-details">
                        <a href="#" class="w-100 mb-sm-3 mb-2 text-center red-btn">Apply</a>
                        <div class="row m-0">
                            <div class="col-6 px-sm-3 px-0">
                                <p class="font-weight-bold mb-0 heading">Company </p>
                                <p class="mb-sm-3 mb-1">{{ $job->company }}</p>
{{--                                <p class="d-flex font-weight-bold mb-3 heading" style="color: #A52C3E">@if($compLogo->logo !=null){{ $job->company }} <img class="ml-2" src="{{$ASSET.'/front_site/images/company-images/'.$compLogo->logo }}" height="25" width="25"  data-placement="top"> @else - @endif</p>--}}
                                <p class="font-weight-bold mb-0 heading">Designation </p>
                                <p class="mb-sm-3 mb-1">{{ $job->designation }}</p>
                                <p class="font-weight-bold mb-0 heading">Salary</p>
                                <p class="mb-sm-3 mb-1">{{ $job->salary_unit }}. {{ number_format($job->salary) }} Per Month</p>
                                <p class="font-weight-bold mb-0 heading">Gender</p>
                                <p class="mb-sm-3 mb-1">{{ $job->gender }}</p>
                                <p class="font-weight-bold mb-0 heading">Location</p>
                                <p class="mb-sm-3 mb-1">{{ $job->city }}, {{ $job->country }}</p>
                                <p class="font-weight-bold mb-0 heading">Work Experience</p>
                                <p class="mb-sm-3 mb-1">{{ $job->work_experience }} Years</p>
                            </div>
                            <div class="col-6 px-sm-3 px-0">
                                @if(!empty($job->work_hour))
                                    <p class="font-weight-bold mb-0 heading">Work Hours</p>
                                    <p class="mb-sm-3 mb-1">{{ $job->work_hour }}</p>
                                @endif
                                <p class="font-weight-bold mb-0 heading">No. Of Vacancies</p>
                                <p class="mb-sm-3 mb-1">{{ $job->vacancies }}</p>
                                <p class="font-weight-bold mb-0 heading">Last Date to Apply</p>
                                <p class="mb-sm-3 mb-1">{{ date("d-F-Y", strtotime($job->created_at)) }}</p>
                                <p class="font-weight-bold mb-0 heading">Office Address</p>
                                <p class="mb-sm-3 mb-1">{{ $job->address }}</p>
                                <p class="font-weight-bold mb-0 heading">Email Address </p>
                                <p class="mb-sm-3 mb-1">{{ $job->email }}</p>
                                <p class="font-weight-bold mb-0 heading">Job Type</p>
                                <p class="mb-sm-3 mb-1">{{ $job->job_type }} </p>
                            </div>
                        </div>
                        <p class="font-weight-bold mb-0 heading">Share This Job</p>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="#" class="text-decoration-none share-btn"><span class="fa fa-facebook"></span></a>
                            <a href="#" class="text-decoration-none share-btn"><span class="fa fa-linkedin"></span></a>
                            <a href="#" class="text-decoration-none share-btn"><span class="fa fa-whatsapp"></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8 col-md-7 pl-lg-2 pr-md-2 p-0 mt-md-0 mt-2">

                    <div class="h-100 details-content">
                        <div class="row">
                            <div class="col-6">
                                <p class="font-weight-bold mb-0 heading">Job Title</p>
                                <p class="mb-sm-3 mb-1 listing">{{ $job->title }}</p>
                                <p class="font-weight-bold mb-0 heading">Job Sector</p>
                                <p class="mb-sm-3 mb-1 listing">{{ $job->textile_sector }}</p>

                                <p class="font-weight-bold mb-0 heading">Functional Area</p>
                                <p class="mb-sm-3 mb-1 listing">{{ $job->functional_area }}</p>

                                <p class="font-weight-bold mb-0 heading">Career Level</p>
                                <p class="mb-sm-3 mb-1 listing">{{ $job->job_level }}</p>
                            </div>
                            <div class="col-6">
                                <p class="font-weight-bold mb-0 heading">Qualification</p>
                                <p class="mb-sm-3 mb-1 listing">{{ $job->qualification }}</p>

                                <p class="font-weight-bold mb-0 heading">Key Skills</p>

                                <p class="mb-sm-3 mb-1 listing">{{ $job->skills }}</p>

                                @if(!empty($job->job_description))
                                <p class="font-weight-bold mb-0 heading">Job Description</p>
                                <p class="mb-sm-3 mb-1 listing">{{ $job->job_description }}</p>
                                @endif
                            </div>
                        </div>



                            @if(!empty($job->image))
                                <p class="font-weight-bold mb-0 heading">Attachment </p>
                            <div class="mt-md-4 mt-2">
                                <?php $pathinfo = pathinfo($job->image);
                                $supported_ext = array('docx', 'xlsx', 'pdf');
                                $src_file_name = $job->image;
                                $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                @if($ext=="docx")
                                    <a class="text-decoration-none text-reset" href="{{url('public/'.$job->image)}}">
                                        <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center">
                                            <img class="img-responsive product-img"
                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png"
                                                 style="filter: brightness(0.5);width: 80px;height: 80px;">

                                            <button class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>

                                        </li>
                                    </a>
                                @elseif($ext=="xlsx")
                                    <a class="text-decoration-none text-reset" href="{{url('public/'.$job->image)}}">
                                        <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center">
                                            <img class="img-responsive product-img"
                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png"
                                                 style="filter: brightness(0.5);width: 80px;height: 80px;">
                                            <button
                                                class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                        </li>
                                    </a>
                                @elseif($ext=="pdf")
                                    <a class="text-decoration-none text-reset" href="{{url('public/'.$job->image)}}">
                                        <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center">
                                            <img class="img-responsive product-img"
                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png"
                                                 style="filter: brightness(0.5);width: 80px;height: 80px;">
                                            <button
                                                class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                        </li>
                                    </a>
                                @else
                                    <img src="{{$ASSETS}}/{{ $job->image }}" class="job-detail-img">
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="px-2 col-12">
                    <div class="job-suggestions">
                        <h4 class="my-md-3 my-1 heading">Job suggestions</h4>
                        <div class="form-row">
                            @foreach($suggestions as $job)
                                <div class="col-xl-4 col-lg-6 px-0">
                                    <div class="description-container">
                                        <div class="short-job-description">
                                            <a href="{{ route('jobs-detail',$job->id) }}" class="text-reset text-decoration-none">
                                                <h6 class="title overflow-text-dots-one-line">{{ $job->title }}</h6>
                                                <span class="d-block tag-line">{{ $job->city }}</span>
                                                <p class="short-description overflow-text-dots my-2">{{ $job->job_description }}</p>
                                                <div class="d-flex justify-content-between date-salery">
                                                    <span><span class="fa fa-calendar pr-2" aria-hidden="true"></span>{{ date("d-F-Y", strtotime($job->closing_date)) }}</span>
                                                    <span><span class="fa fa-file pr-2" aria-hidden="true"></span>{{ $job->work_experience }} Year</span>
                                                    <span><span class="fa fa-money pr-2" aria-hidden="true"></span>{{ number_format($job->salary) }}</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
