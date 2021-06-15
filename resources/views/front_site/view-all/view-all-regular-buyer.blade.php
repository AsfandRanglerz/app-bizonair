@extends('front_site.master_layout')
@section('content')
    <body class="product-main product-listing">
    <style>
        .overflow-text-dots-subject {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }

        @media (min-width: 1200px) {
            .certified-suppliers .col-xl-2,
            #buyingDeals .col-xl-2,
            .categories-section.col-xl-2,
            .half-side-content.col-xl-2,
            .categories-section-upper.col-xl-2 {
                -ms-flex: 0 0 20%!important;
                flex: 0 0 20%!important;
                max-width: 20%!important;
            }

            .content-column.col-xl-2 {
                -ms-flex: 0 0 33.3%;
                flex: 0 0 33.3%;
                max-width: 33.3%;
            }

            .content-column.col-xl-10,
            .half-side-content.col-xl-10 {
                -ms-flex: 0 0 80%;
                flex: 0 0 80%;
                max-width: 80%;
            }
        }
    </style>
    <main id="maincontent" class="page-main">
        @include('front_site.common.product-banner')
        <div class="main-container">
            <div class="container-fluid px-2">
                @include('front_site.common.garments-nav')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{ url('business-products/fibers-and-materials') }}">Textile Business</a></li>
                        <?php $geturl = url()->current();
                        $urlslug = basename($geturl);

                        $cat_name = \App\Category::where('slug',$urlslug)->pluck('name');
                        ?>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{Request::url()}}"> {{$cat_name[0]}}</a></li>
                    </ol>
                </nav>
                <div class="mini-content-container">
                    <div class="row deals">
                        <div class="col-xl-10 col-lg-9 col-md-8 half-side-content">
                            <div class="position-relative">
                                <h3 class="main-heading">ALL REGULAR BUYERS</h3>
                            </div>
                            <div class="row deals-inner-half" id="sellingDeals">
                                <div class="col-xl-3 col-lg-3 categories-section-upper">
                                    <div class="d-flex flex-column justify-content-between categories-section content-column scroll-bar">
                                        <ul>
                                            <li class="heading">CATEGORIES</li>
                                            @foreach($subcategories as  $subcategory)
                                                <li>
                                                    <a href="{{route('suppliers-subcategory-products',['category'=>$subcategory->category->slug,'subcategory'=>$subcategory->slug])}}">{{$subcategory->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <ul class="all-categories-link">
                                            <li><a href="#" class="all-categories">All Products</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="px-0 col-xl-9 col-lg-9 content-column">
                                    <div class="row m-0 product-section-outer">
                                        @if(count($toptenbuyproduct) > 0)
                                            @foreach($toptenbuyproduct as $i => $prod)
                                                <div class="my-1 content-column product-section-upper col-xl-2 col-6">
                                                    <div class="product-section">

                                                        <div class="position-relative suppliers-buyers">
                                                            @foreach($prod->product_image as $j => $image)
                                                                @if($loop->first)
                                                                    <a href="{{ route('productDetail',$prod->slug) }}">
                                                                    <img src="{{$ASSETS}}/{{$image->image}}"
                                                                         class="w-100 h-100 certified-suppliers-img">
                                                                    </a>
                                                                    <img src="{{$ASSET}}/front_site/images/certified_company.png" width="50" height="50" class="position-absolute certified-logo">
                                                                    <div class="position-absolute heart-icon-div">
                                                                        <span  @if(Auth::check()) class="text-decoration-none add-to-fav" prod_id="{{$prod->id}}" product_service_name="{{$prod->product_service_name}}" product_service_types="{{$prod->product_service_types}}" reference_no="{{$prod->reference_no}}"  @else class="text-decoration-none pre-login" @endif><span class="@if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists()) check-heart fa fa-heart @else check-heart fa fa-heart-o @endif"></span></span>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>

                                                        <div class="product-info clearfix">
                                                            <p class="heading overflow-text-dots-subject">{{$prod->product_service_name}}</p>
                                                            <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                                            <p class="mb-0">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                                            <p class="price font-500 overflow-text-dots-subject"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ $prod->unit_price_from }} - {{ $prod->unit_price_to }}   @else {{ $prod->target_price_from }} - {{ $prod->target_price_to }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                                            <div class="d-flex justify-content-between mt-2 mb-0 text-uppercase place-day">
                                                                <span class="place">{{ get_product_city($prod->company_id) }}, {{$prod->origin}}</span>
                                                                <span>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="px-3">No Product Found Related To This Category...</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-md-0 mt-2 h-auto col-xl-2 col-lg-3 col-md-4 half-side-content">
                            <h3 class="text-center main-heading">TOP COMPANIES</h3>
                            <div class="position-relative top-companies" style="height: calc(100% - 24px);">
                                <div class="top-companies-card">
                                    <img class="w-100" alt="100x100" src="http://localhost/app-bizonair/public/assets/front_site/images/ad-1.png" data-holder-rendered="true">
                                    <div class="companies-card-content">
                                        <img src="http://localhost/app-bizonair/public/assets/front_site/images/groupsl-224.png">
                                        <span class="company-nm">Company Name</span>
                                        <p class="company-content">Description sample text sample text sample</p>
                                        <p class="company-content">Description sample text sample text sample</p>
                                    </div>
                                </div>
                                <div class="top-companies-card">
                                    <img class="w-100" alt="100x100" src="http://localhost/app-bizonair/public/assets/front_site/images/ad-1.png" data-holder-rendered="true">
                                    <div class="companies-card-content">
                                        <img src="http://localhost/app-bizonair/public/assets/front_site/images/groupsl-224.png">
                                        <span class="company-nm">Company Name</span>
                                        <p class="company-content">Description sample text sample text sample</p>
                                        <p class="company-content">Description sample text sample text sample</p>
                                    </div>
                                </div>
                                <a href="#" class="position-absolute red-link view-all" style="right: 15px;bottom: 5px">VIEW ALL</a>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3 deals product-section-outer" id="buyingDeals">
                        @if(count($topbuyproduct) > 0)
                            @foreach($topbuyproduct as $i => $prod)
                                <div class="product-box content-column col-xl-2 col-lg-3 col-md-4 col-6 my-1">
                                    <div class="content-column-inner">
                                        <a href="{{ route('productDetail',$prod->slug) }}">
                                            <div class="position-relative suppliers-buyers" style="height: 65%">
                                                @foreach($prod->product_image as $i => $image)
                                                    @if($loop->first)
                                                        <a href="{{ route('productDetail',$prod->slug) }}">
                                                        <img src="{{$ASSETS}}/{{$image->image}}"
                                                             class="w-100 h-100 certified-suppliers-img">
                                                        </a>
                                                        <img src="{{$ASSET}}/front_site/images/certified_company.png" width="50" height="50" class="position-absolute certified-logo">
                                                        <div class="position-absolute heart-icon-div">
                                                            <span  @if(Auth::check()) class="text-decoration-none add-to-fav" prod_id="{{$prod->id}}" product_service_name="{{$prod->product_service_name}}" product_service_types="{{$prod->product_service_types}}" reference_no="{{$prod->reference_no}}"  @else class="text-decoration-none pre-login" @endif><span class="@if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists()) check-heart fa fa-heart @else check-heart fa fa-heart-o @endif"></span></span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </a>
                                        <div class="product-info clearfix">
                                            <p class="heading overflow-text-dots-subject">{{$prod->product_service_name}}</p>
                                            <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                            <p class="mb-0">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                            <p class="price font-500 overflow-text-dots-subject"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ $prod->unit_price_from }} - {{ $prod->unit_price_to }}   @else {{ $prod->target_price_from }} - {{ $prod->target_price_to }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                            <div class="d-flex justify-content-between mt-2 mb-0 text-uppercase place-day">
                                                <span class="place">{{ get_product_city($prod->company_id) }}, {{$prod->origin}}</span>
                                                <span>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="px-3">No Product Found Related To This Category...</p>
                        @endif
                    </div>
                    <div align="center" class="my-2">
                        <a href="#" class="load-more red-btn">Load More<span class="ml-2 fa fa-spinner" aria-hidden="true"></span></a>
                    </div>
                    <div class="my-3 position-relative">
                        <h3 class="main-heading">PREMIUM SUPPLIERS</h3>
                        <a href="#" class="position-absolute red-link view-all">VIEW ALL</a>
                    </div>
                    <div class="row premium-suppliers">
                        <div class="col-sm-3 col-4 content-column">
                            <img src="{{$ASSET}}/front_site/images/bizonair-logo.png" class="w-100 h-100 object-contain">
                        </div>
                        <div class="col-sm-3 col-4 content-column">
                            <img src="{{$ASSET}}/front_site/images/bizonair-logo.png" class="w-100 h-100 object-contain">
                        </div>
                        <div class="col-sm-3 col-4 content-column">
                            <img src="{{$ASSET}}/front_site/images/bizonair-logo.png" class="w-100 h-100 object-contain">
                        </div>
                        <div class="col-sm-3 col-4 content-column">
                            <img src="{{$ASSET}}/front_site/images/bizonair-logo.png" class="w-100 h-100 object-contain">
                        </div>
                        <div class="col-sm-3 col-4 content-column">
                            <img src="{{$ASSET}}/front_site/images/bizonair-logo.png" class="w-100 h-100 object-contain">
                        </div>
                        <div class="col-sm-3 col-4 content-column">
                            <img src="{{$ASSET}}/front_site/images/bizonair-logo.png" class="w-100 h-100 object-contain">
                        </div>
                        <div class="col-sm-3 col-4 content-column">
                            <img src="{{$ASSET}}/front_site/images/bizonair-logo.png" class="w-100 h-100 object-contain">
                        </div>
                        <div class="col-sm-3 col-4 content-column">
                            <img src="{{$ASSET}}/front_site/images/bizonair-logo.png" class="w-100 h-100 object-contain">
                        </div>
                    </div>
                    <div class="my-3 position-relative">
                        <h3 class="main-heading text-center">TEXTILE PARTNERS</h3>
                    </div>
                    <div class="container-fluid logo-slider">
                        <div class="slider slider-nav w-100">
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/4-box.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/act.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100"></a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/adm.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/alkaram.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100"></a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/apparel-textile-logo.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/archroma.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100"></a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/azgard.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/cotton-web.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100"></a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/cresent.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/feroze.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/gadoon.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100"></a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/gohar.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/interlop.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/kohinoor.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100"></a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/mtm.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/naveena.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/nishat.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100"></a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/rajby.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/sapphire.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/sarena.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100"></a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/sgs.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/sockoye.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/style-textile.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/y-txt.jpeg"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100"></a>
                            <a href="#" class="logo-container"><img
                                    src="{{$ASSET}}/front_site/images/our-clients-logos/zsk.png"
                                    alt="100x100" data-holder-rendered="true"
                                    class="w-100 h-100">
                            </a>
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
        $(document).on('click','.pre-login',function(){
            window.location.href = "{{ route('log-in-pre')}}";
        });
        $(document).delegate('.add-to-fav', 'click', function(e) {
            e.preventDefault();
            var reference_no=$(this).attr("reference_no");
            var prod_id = $(this).attr("prod_id");
            var product_service_name=$(this).attr("product_service_name");
            var product_service_types=$(this).attr("product_service_types");
            var token='{{csrf_token()}}';
            $("#ajax-preloader").show();
            $.ajax({
                type:'POST',
                url: '{{ url('/favourite-product-ajax') }}',
                data:{reference_no:reference_no,prod_id:prod_id,product_service_types:product_service_types,product_service_name:product_service_name,_token:token},
                cache: false,
                success: function(data) {
                    $("#ajax-preloader").hide();
                    response = $.parseJSON(data);
                    if (response.feedback === "false") {
                        $('html, body').animate({scrollTop: ($('#' + Object.keys(response.errors)[0]).offset().top)}, 'slow');
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                        });
                    } else if (response.feedback === 'true') {
                        toastr.success(response.msg);

                        setTimeout(() => {
                            window.location.href = response.close();
                        }, 1000);
                    }
                }
            });
        });
    </script>

@endpush
