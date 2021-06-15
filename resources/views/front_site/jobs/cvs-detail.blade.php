@extends('front_site.master_layout')
@section('content')
    <body>
    <main id="maincontent" class="d-flex flex-column bg-grey job-details-container">
        <div class="banner-outer">
            <div class="banner">
                <h3 class="text-white text-center heading">Hire Now – It only takes few seconds</h3>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="px-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{url('jobs-portal')}}">Careers</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{Request::url()}}">CVs Detail</a></li>
            </ol>
        </nav>
        <div class="container-fluid">
            <div class="row m-0 pt-2 pb-5">
                @foreach($cvsdet as $job)
                <div class="col-xl-3 col-lg-4 col-md-5 pl-md-2 pr-md-2 p-0">
                    <div class="h-100 side-details">
                        <div class="row">
                            <div class="container-fluid">
{{--                                <a href="#" class="w-100 mb-3 text-center red-btn">Apply</a>--}}
                                <p class="font-weight-bold mb-0 heading">Location</p>
                                <p>{{ $job->city }}, {{ $job->country }}</p>
                                <p class="font-weight-bold mb-0 heading">Functional Area</p>
                                <p>{{ $job->functional_area }}</p>
                                <p class="font-weight-bold mb-0 heading">Textile Sector</p>
                                <p>{{ $job->textile_sector }}</p>
                                <p class="font-weight-bold mb-0 heading">Expected Salary</p>
                                <p>{{ $job->sal_unit }} {{ number_format($job->exp_salary) }}  Per Month</p>
                                <p class="font-weight-bold mb-0 heading">Contact Number </p>
                                <p>{{ $job->phone_no }}</p>
                                <p class="font-weight-bold mb-0 heading">Contact Email </p>
                                <p>{{ $job->email }}</p>

                            </div>
                        </div>
{{--                        <p class="font-weight-bold mb-0 heading">Created At</p>--}}
{{--                        <p>{{ date("d-F-Y", strtotime($job->created_at)) }}</p>--}}
                        <p class="font-weight-bold mb-0 heading">Share This Job</p>
                        <div class="d-flex justify-content-center mt-2">
                            <a href="#" class="text-decoration-none share-btn"><span class="fa fa-facebook"></span></a>
                            <a href="#" class="text-decoration-none share-btn"><span class="fa fa-linkedin"></span></a>
                            <a href="#" class="text-decoration-none share-btn"><span class="fa fa-whatsapp"></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8 col-md-7 pl-lg-2 pr-md-2 p-0 mt-md-0 mt-3">

                    <div class="h-100 details-content">
                        <div>
                            <p class="font-weight-bold mb-0 heading">Name</p>
                            <div class="pl-4">
                                <p class="listing">{{ $job->fname }} {{ $job->lname }}</p>
                            </div>

                            <p class="font-weight-bold mb-0 heading">Key Skills</p>
                            <div class="pl-4">
                                <p class="listing">{{ $job->key_skills }}</p>
                            </div>

                            <p class="font-weight-bold mb-0 heading">Highest Education Level</p>
                            <div class="pl-4">
                                <p class="listing">{{ $job->edu_level }}</p>
                            </div>
                            <p class="font-weight-bold mb-0 heading">Total Experience (Years)</p>
                            <div class="pl-4">
                                <p class="listing">{{ $job->total_experience }}</p>
                            </div>
                            @if(!empty($job->image))
                            <p class="font-weight-bold mb-0 heading">Attachment </p>
                            <div class="mt-4">
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
                            </div>
                            <div class="mt-4" style="height: 335px">
                                @else
                                <img src="{{$ASSETS}}/{{ $job->image }}">
                                    @endif
                            </div>
                                @endif
                        </div>
                    </div>

                </div>

                <div class="px-2 col-12">
                    <div class="job-suggestions">
                        <h4 class="mt-3 heading">CV Suggestions</h4>
                        <div class="form-row">
                            @foreach($suggestions as $cv)
                                <div class="col-xl-4 col-lg-6 pt-3 p-md-1 p-0">
                                    <div class="description-container">
                                        <div class="short-job-description">
                                            <a href="{{ route('cvc-detail',$cv->id) }}" class="text-reset text-decoration-none">
                                                <h6 class="title">{{ $cv->key_skills }}</h6>
                                                <span class="d-block tag-line">{{ $cv->city }},{{ $cv->country }}</span>
                                                <p class="short-description">{{ $cv->functional_area }}</p>
                                                <p class="short-description>{{ $cv->textile_sector }}</p>
                                                  <p class="short-description">{{ $cv->email }}</p>
                                                <p class="short-description overflow-text-dots">{{ $cv->edu_level }}</p>
                                                <div class="d-flex justify-content-between date-salery">
                                                    <span><span class="fa fa-calendar pr-2" aria-hidden="true"></span>{{ date("d-F-Y", strtotime($cv->created_at)) }}</span>
                                                    <span><span class="fa fa-file pr-2" aria-hidden="true"></span>{{ $cv->total_experience }} Year Experience</span>
                                                    <span><span class="fa fa-money pr-2" aria-hidden="true"></span>{{ number_format($cv->exp_salary) }} {{$cv->sal_unit}} Expected</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 mb-4">
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
    <script>

    </script>

    @endpush
