@extends('front_site.master_layout')

@section('content')
    <body>
    <main id="maincontent" class="suppliers-about-us">
        @include('front_site.common.user-suppliers-banner')
        <div class="my-sm-5 my-4 container-lg">
            <div class="row mb-3">
                <div class="col-lg-2 mb-lg-0 mb-3 px-0" align="center">
                    <img src="{{ $about_us->logo }}" class="p-1 company-profile-logo border-grey">
                </div>
                <div class="col-lg-10 px-lg-0 px-3">
                    <div class="mb-3 about-us-section">
                        <div class="mb-2 d-flex flex-wrap flex-md-row flex-column justify-content-between align-items-center">
                            <h3 class="mb-md-0 mb-2 font-weight-bold heading">{{$about_us->company_name}}</h3>
                            <div class="d-flex flex-wrap column-gap-4">
                                <a id="shareLinkbtn" class="red-btn">Copy URL </a>
                                <div class="p-0 navbar">
                                    <div class="dropdown">
                                        <a class="d-block red-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="mr-2 fa fa-share-alt"></span>Share</a>
                                        <div class="dropdown-menu animated-dropdown slideIn left-unset right-0 job-details-container">
                                            <div class="d-flex justify-content-center">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="social-button text-decoration-none share-btn" id=""><span class="fa fa-facebook"></span></a>
                                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{url()->current()}}&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button text-decoration-none share-btn" id=""><span class="fa fa-linkedin"></span></a>
                                                <a href="https://wa.me/?text={{url()->current()}}" class="social-button text-decoration-none share-btn" id=""><span class="fa fa-whatsapp"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">
                            {!!  $about_us->company_introduction !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="product-details">
                <div class="mini-content-container">
                    <div class="switch-tabs bg-white rounded" id="productInfoSection">
                        <!-- Nav tabs -->
                    {{--                        <ul class="nav nav-tabs">--}}
                    {{--                            <li class="nav-item">--}}
                    {{--                                <a class="nav-link active" data-toggle="tab" href="#productInfo">COMPANY INFO</a>--}}
                    {{--                            </li>--}}
                    {{--                            <li class="nav-item">--}}
                    {{--                                <a class="nav-link" data-toggle="tab" href="#tradeInfo">COMPANY IMAGES</a>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}

                    <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="productInfo" class="h-100 mt-0 tab-pane product-tab active" style="overflow: unset;max-height: unset">
                                {{--                                    <span class="mt-0 mb-1 heading">About</span>--}}
                                {{--                                    <div>--}}
                                {{--                                        <p class="mb-3">this is test bizonair company</p>--}}
                                {{--                                    </div>--}}
                                <span class="mt-0 text-center font-weight-bold heading">COMPANY INFO</span>
                                <span class="mt-0 heading">Business Information</span>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Company Name</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">{{$about_us->company_name}}</p>
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Business Type</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        @if(str_contains($about_us->business_type, 'Other'))
                                            <p class="mb-sm-0">{{str_replace('Others', ' '.$about_us->other_business_type, $about_us->business_type)}}</p>
                                        @else
                                            <p class="mb-sm-0">{{str_replace(',', '  ,  ', $about_us->business_type)}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Nature of Business</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">{{$about_us->business_nature ?:'-'}}</p>
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Export Market</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">{{$about_us->export_market ?:'-'}}</p>
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Year of Establishment</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">{{$about_us->year_established ?:'-'}}</p>
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>No of Employees</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">{{$about_us->no_of_employees ?:'-'}}</p>
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Certification</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">{{$about_us->certifications ?:'-'}}</p>
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Annual Turnover(In USD Million)</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">{{$about_us->annual_turnover ?:'-'}}</p>
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Licence No/ Reg No</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">{{$about_us->registeration_no ?:'-'}}</p>
                                    </div>
                                </div>

                                <span class="heading">Additional Information</span>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Business Owner</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">{{$about_us->business_owner ?:'-'}}</p>
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Alternate Contact Number</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">@if($about_us->alternate_contact){{$about_us->alternate_contact}}@else - @endif</p>
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Alternate Email</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">{{$about_us->alternate_email ?:'-'}}</p>
                                    </div>
                                </div>
                                <div class="row text">
                                    <div class="col-lg-4 col-sm-6">
                                        <span><b>Alternate Office Address</b></span>
                                    </div>
                                    <div class="col-lg-8 col-sm-6">
                                        <p class="mb-sm-0">{{$about_us->alternate_address ?:'-'}}</p>
                                    </div>
                                </div>

                                <span class="text-center font-weight-bold heading">COMPANY IMAGES</span>
                                <div>
                                    <div class="product-images-gallery">
                                        <ul class="mx-0 my-2 product-gallery edit-comp-prof-imgs">
                                            @if(\App\CompanyImage::where('company_id',$about_us->id)->count() > 0)
                                                @foreach(\App\CompanyImage::where('company_id',$about_us->id)->get() as $file)
                                                    <?php $pathinfo = pathinfo($file->image);
                                                    $supported_ext = array('docx', 'xlsx', 'pdf');
                                                    $src_file_name = $file->image;
                                                    $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                                    @if($ext=="docx")
                                                        <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                            data-src="{{$file->image}}"
                                                            data-pinterest-text="Pin it"
                                                            data-tweet-text="share on twitter">
                                                            <img class="img-responsive product-img"
                                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png"
                                                                 style="filter: brightness(0.5)">
                                                            <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                            <button
                                                                class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                        </li>
                                                    @elseif($ext=="xlsx")
                                                        <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                            data-src="{{$file->image}}"
                                                            data-pinterest-text="Pin it"
                                                            data-tweet-text="share on twitter">
                                                            <img class="img-responsive product-img"
                                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png"
                                                                 style="filter: brightness(0.5)">
                                                            <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                            <button
                                                                class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                        </li>
                                                    @elseif($ext=="pdf")
                                                        <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                            data-src="{{$file->image}}"
                                                            data-pinterest-text="Pin it"
                                                            data-tweet-text="share on twitter">
                                                            <img class="img-responsive product-img"
                                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png"
                                                                 style="filter: brightness(0.5)">
                                                            <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                            <button
                                                                class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                        </li>
                                                    @else
                                                        <li class="position-relative d-inline-block my-1">
                                                            <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                            <div class="include-in-gallery"
                                                                 data-src="{{$file->image}}"
                                                                 data-pinterest-text="Pin it"
                                                                 data-tweet-text="share on twitter">
                                                                <a href="">
                                                                    <img class="img-responsive product-img" src="{{$file->image}}">
                                                                    <div class="demo-gallery-poster">
                                                                        <span class="fa fa-eye text-white"></span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @else
                                                <li><p>No Attachments To View</p></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{--<div id="tradeInfo" class="tab-pane product-tab fade">
                                <div class="product-img-spec-container">
                                    <div class="product-images-gallery">
                                        <ul class="mx-0 my-2 product-gallery edit-comp-prof-imgs">
                                            @if(\App\CompanyImage::where('company_id',$about_us->id)->count() > 0)
                                                @foreach(\App\CompanyImage::where('company_id',$about_us->id)->get() as $file)
                                                    <?php $pathinfo = pathinfo($file->image);
                                                    $supported_ext = array('docx', 'xlsx', 'pdf');
                                                    $src_file_name = $file->image;
                                                    $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                                    @if($ext=="docx")
                                                        <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                            data-src="{{$file->image}}"
                                                            data-pinterest-text="Pin it"
                                                            data-tweet-text="share on twitter">
                                                            <img class="img-responsive product-img"
                                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png"
                                                                 style="filter: brightness(0.5)">
                                                            <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                            <button
                                                                class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                        </li>
                                                    @elseif($ext=="xlsx")
                                                        <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                            data-src="{{$file->image}}"
                                                            data-pinterest-text="Pin it"
                                                            data-tweet-text="share on twitter">
                                                            <img class="img-responsive product-img"
                                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png"
                                                                 style="filter: brightness(0.5)">
                                                            <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                            <button
                                                                class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                        </li>
                                                    @elseif($ext=="pdf")
                                                        <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                            data-src="{{$file->image}}"
                                                            data-pinterest-text="Pin it"
                                                            data-tweet-text="share on twitter">
                                                            <img class="img-responsive product-img"
                                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png"
                                                                 style="filter: brightness(0.5)">
                                                            <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                            <button
                                                                class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                        </li>
                                                    @else
                                                        <li class="position-relative d-inline-block my-1">
                                                            <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                            <div class="include-in-gallery"
                                                                 data-src="{{$file->image}}"
                                                                 data-pinterest-text="Pin it"
                                                                 data-tweet-text="share on twitter">
                                                                <a href="">
                                                                    <img class="img-responsive product-img" src="{{$file->image}}">
                                                                    <div class="demo-gallery-poster">
                                                                        <span class="fa fa-eye text-white"></span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @else
                                                <li><p>No Attachments To View</p></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    </body>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            /*for downloading files*/
            $('.get-file').on('click', function () {
                var GetFile = $(this).parent('li').attr('data-src');
                console.log(GetFile);
                $.ajax({
                    url: GetFile,
                    method: 'GET',
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (data) {
                        var a = document.createElement('a');
                        var url = window.URL.createObjectURL(data);
                        a.href = url;
                        a.download = GetFile;
                        document.body.append(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    }
                });
            });
            /*for downloading files*/
        });
    </script>

@endpush
