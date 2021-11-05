@extends('front_site.master_layout')
@section('content')
    <body>
    <main id="maincontent" class="d-flex flex-column job-details-container">
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
        <div class="container-fluid px-2">
            <div class="row m-0 pb-5">
                @foreach($cvsdet as $job)
                <div class="col-xl-3 col-lg-4 col-md-5 pl-md-2 pr-md-2 p-0">
                    <div class="h-100 side-details">
                        <div class="row">
                            <div class="container-fluid">
{{--                                <a href="#" class="w-100 mb-3 text-center red-btn">Apply</a>--}}
                                <p class="font-weight-bold mb-0 heading">Location</p>
                                <p class="mb-1">{{ $job->city }}, {{ $job->country }}</p>
                                <p class="font-weight-bold mb-0 heading">Functional Area</p>
                                <p class="mb-1">{{ $job->functional_area }}</p>
                                <p class="font-weight-bold mb-0 heading">Textile Sector</p>
                                <p class="mb-1">{{ $job->textile_sector }}</p>
                                <p class="font-weight-bold mb-0 heading">Expected Salary</p>
                                <p class="mb-1">{{ $job->sal_unit }} {{ number_format($job->exp_salary) }}  Per Month</p>
                                <p class="font-weight-bold mb-0 heading">Contact Number </p>
                                <p class="mb-1">{{ $job->phone_code }} {{ $job->phone_no }}</p>
                                <p class="font-weight-bold mb-0 heading">Contact Email </p>
                                <p class="mb-1">{{ $job->email }}</p>

                            </div>
                        </div>
{{--                        <p class="font-weight-bold mb-0 heading">Created At</p>--}}
{{--                        <p>{{ date("d-F-Y", strtotime($job->created_at)) }}</p>--}}
                        <p class="font-weight-bold mb-0 heading">Share This Job</p>
                        <div class="d-flex justify-content-center mt-1">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="social-button text-decoration-none share-btn" id=""><span class="fa fa-facebook"></span></a>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{url()->current()}}&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button text-decoration-none share-btn" id=""><span class="fa fa-linkedin"></span></a>
                            <a href="https://wa.me/?text={{url()->current()}}" class="social-button text-decoration-none share-btn" id=""><span class="fa fa-whatsapp"></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8 col-md-7 pl-lg-2 pr-md-2 p-0 mt-md-0 mt-2">

                    <div class="h-100 details-content">
                        <div>
                            <p class="font-weight-bold mb-0 heading">Name</p>
                            <div>
                                <p class="mb-1 listing">{{ $job->fname }} {{ $job->lname }}</p>
                            </div>

                            <p class="font-weight-bold mb-0 heading">Key Skills</p>
                            <div>
                                <p class="mb-1 listing">{{ $job->key_skills }}</p>
                            </div>

                            <p class="font-weight-bold mb-0 heading">Highest Education Level</p>
                            <div>
                                <p class="mb-1 listing">{{ $job->edu_level }}</p>
                            </div>
                            <p class="font-weight-bold mb-0 heading">Total Experience (Years)</p>
                            <div>
                                <p class="mb-1 listing">{{ $job->total_experience }}</p>
                            </div>
                            @if(!empty($job->image))
                            <p class="font-weight-bold mb-0 heading">Attachment </p>
                            <div class="mt-2">
                                <?php $pathinfo = pathinfo($job->image);
                                $supported_ext = array('docx', 'xlsx', 'pdf');
                                $src_file_name = $job->image;
                                $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                @if($ext=="docx")
                                        <a class="text-decoration-none text-reset" href="{{$job->image}}">
                                            <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center">
                                                <img class="img-responsive product-img"
                                                     src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png"
                                                     style="filter: brightness(0.5);width: 80px;height: 80px;">

                                                <button class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>

                                            </li>
                                        </a>
                                @elseif($ext=="xlsx")
                                        <a class="text-decoration-none text-reset" href="{{$job->image}}">
                                    <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center">
                                        <img class="img-responsive product-img"
                                             src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png"
                                             style="filter: brightness(0.5);width: 80px;height: 80px;">
                                        <button
                                            class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                    </li>
                                        </a>
                                @elseif($ext=="pdf")
                                        <a class="text-decoration-none text-reset" href="{{$job->image}}">
                                    <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center">
                                        <img class="img-responsive product-img"
                                             src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png"
                                             style="filter: brightness(0.5);width: 80px;height: 80px;">
                                        <button
                                            class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                    </li>
                                        </a>
                            </div>
                                @else
                                <div class="mt-4" style="height: 335px">
                                    <img src="{{ $job->image }}">
                                </div>
                                    @endif
                                @endif
                        </div>
                    </div>

                </div>

                <div class="px-0 col-12">
                    <div class="job-suggestions">
                        <h4 class="my-1 heading">CV Suggestions</h4>
                        <div class="form-row mx-0">
                            @if(count($suggestions) > 0)
                            @foreach($suggestions as $cv)
                                <div class="col-xl-4 col-lg-6 p-md-1 p-0">
                                    <div class="description-container">
                                        <div class="short-job-description">
                                            <a href="{{ route('cvc-detail',$cv->id) }}" class="text-reset text-decoration-none">
                                                <h6 class="title">{{ $cv->fname }} {{ $cv->lname }}</h6>
                                                <span class="d-block tag-line">{{ $cv->textile_sector }}, {{ $cv->functional_area }}</span>
                                                <p class="short-description">{{ $cv->city }}, {{ $cv->country }}</p>
                                                <p class="short-description">{{ $cv->email }}</p>
                                            </a>
                                            <?php $pathinfo = pathinfo($cv->image);
                                            $supported_ext = array('docx', 'xlsx', 'pdf');
                                            $src_file_name = $cv->image;
                                            $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                            @if($ext=="docx")
                                                <a class="text-decoration-none text-reset" href="{{$cv->image}}">
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
                                                <a class="text-decoration-none text-reset" href="{{$cv->image}}">
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

                                                <a class="text-decoration-none text-reset" href="{{$cv->image}}" download>
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
                                                <img src="{{ $cv->image }}" style="width: 50px;height: 50px;" class="position-absolute dir-download-img">
                                            @endif
                                                <div class="d-flex justify-content-between date-salery">
                                                    <span><span class="fa fa-calendar pr-2" aria-hidden="true"></span>{{ date("d-F-Y", strtotime($cv->created_at)) }}</span>
                                                    <span><span class="fa fa-file pr-2" aria-hidden="true"></span>{{ $cv->total_experience }} Experience</span>
                                                    <span><span class="fa fa-money pr-2" aria-hidden="true"></span>{{$cv->sal_unit}} {{ number_format($cv->exp_salary) }}  Expected</span>
                                                </div>

                                        </div>
                                        <div class="my-2">
                                            <hr class="horizontal-line">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                                <div class="col-xl-4 col-lg-6 p-md-1 p-0">
                                    <div class="description-container">
                                        <div class="short-job-description">
                                            <p>No Suggestions Found</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
