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

        .deals,
        .deals-inner-half {
            margin: 0 -5px;
        }

        .product-section-upper,
        .categories-section-upper {
            padding: 0 8px;
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
            <div class="container-fluid">
                @include('front_site.common.garments-nav-service')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{ url('services/hr-and-admin') }}">Textile Services</a>
                        <?php $geturl = url()->current();
                        $urlslug = basename($geturl);

                        $cat_name = \App\Category::where('slug',$urlslug)->pluck('name');
                        ?>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{Request::url()}}">{{$cat_name[0]}}</a></li>
                    </ol>
                </nav>
                <div class="mini-content-container">
                    <div class="row deals">
                        <div class="col-xl-10 col-lg-9 col-md-8 half-side-content">
                            <div class="position-relative">
                                <h3 class="main-heading">ALL ONE TIME SELLING DEALS</h3>
                            </div>
                            <div class="row deals-inner-half" id="sellingDeals">
                                <div class="col-xl-3 col-lg-3 categories-section-upper">
                                    <div class="d-flex flex-column justify-content-between categories-section content-column scroll-bar">
                                        <ul>
                                            <li class="heading">CATEGORIES</li>
                                            @foreach($subcategories as  $subcategory)
                                                <li>
                                                    <a href="{{route('subcategory-one-time-services',['category'=>$subcategory->category->slug,'subcategory'=>$subcategory->slug])}}">{{$subcategory->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <ul class="all-categories-link">
                                            <li><a href="#" class="all-categories">All Services</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="p-0 col-xl-9 col-lg-9 content-column">
                                    <div class="row m-0 product-section-outer">
                                        @if(count($buyselltopten_selling) > 0)
                                            @foreach($buyselltopten_selling as $i => $prod)
                                                <div class="my-2 content-column product-section-upper col-xl-2 col-6">
                                                    <div class="product-section">
                                                        <a class="text-decoration-none text-reset" href="{{ route('serviceDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                        <div class="position-relative suppliers-buyers">
                                                                <?php $img = \DB::table('buysell_images')->where('buy_sell_id',$prod->id)->get();?>
                                                                @foreach($img as $i => $image)
                                                                    @if($loop->first)
                                                                        <img src="{{$ASSETS}}/{{$image->image}}"
                                                                             class="w-100 h-100 certified-suppliers-img border-grey">
                                                                            @if($prod->is_certified ==1)
                                                                                <img src="{{$ASSET}}/front_site/images/certified_company.png" width="50" height="50" class="position-absolute certified-logo">
                                                                            @endif
                                                                            @if($prod->is_featured ==1)
                                                                                <span class="position-absolute left-0 Featured-txt">Featured</span>
                                                                            @endif
                                                                            <div class="position-absolute heart-icon-div">
                                                                                <a class="text-decoration-none text-reset" href="#add-fav-{{$prod->reference_no}}" data-toggle="modal">
                                                                           <span class="text-decoration-none add-to-fav">
                                                                                    <span class="@if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists()) check-heart fa fa-heart @else check-heart fa fa-heart-o @endif"></span>
                                                                           </span>
                                                                                </a>
                                                                            </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </a>
                                                        <div id="add-fav-{{$prod->reference_no}}" class="change-password-modal modal fade">
                                                            <div class="modal-dialog modal-dialog-centered modal-login">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                                @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                                <span class="modal-title">REMOVE FROM FAVOURITE</span>
                                                                                @else
                                                                                <span class="modal-title">ADD TO FAVOURITE</span>
                                                                                @endif
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body pt-3">
                                                                                @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                                    <p style="color: white">Are you sure your product will be removed from the favourite</p>
                                                                                @else
                                                                                    <p style="color: white">A notification will be sent to supplier/buyer to contact you back</p>
                                                                                @endif
                                                                        <div class="form-group mt-4 mb-0">
                                                                            <button @if(Auth::check()) class="red-btn add-to-favourite" data-dismiss="modal" prod_id="{{$prod->id}}" product_service_name="{{$prod->product_service_name}}" product_service_types="{{$prod->product_service_types}}" reference_no="{{$prod->reference_no}}"  @else class="red-btn" data-dismiss="modal" data-toggle="modal" data-target="#login-form" @endif type="submit">Yes</button>
                                                                            <button class="red-btn" data-dismiss="modal" aria-hidden="true">No</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a class="text-decoration-none text-reset" href="{{ route('serviceDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                        <div class="product-info">
                                                            <p class="heading overflow-text-dots-subject">{{$prod->product_service_name}}</p>
                                                            <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                                            <p class="mb-0">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                                            <p class="price font-500 overflow-text-dots-subject"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ moneyFormat($prod->unit_price_from) }} - {{ moneyFormat($prod->unit_price_to) }}   @else {{ moneyFormat($prod->target_price_from) }} - {{ moneyFormat($prod->target_price_to) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                                            <p class="mt-2 mb-0 text-uppercase place-day">{{ $prod->city }}, {{ $prod->country }} <span class="pull-right">{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span></p>
                                                        </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="pt-3 px-3">No Product Found Related To This Category...</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-auto col-xl-2 col-lg-3 col-md-4 half-side-content">
                            <h3 class="mb-0 text-center main-heading" style="height: 5.7%">TOP COMPANIES</h3>
                            <div class="top-companies" style="height: 94.3%">
                                @foreach($topcompanies as $comp)
                                    <div class="my-3 top-companies-card">
                                        <img alt="100x100" src="{{$ASSET.'/front_site/images/company-images/'.$comp->logo }}"
                                             data-holder-rendered="true" height="145" class="w-100 object-contain border-grey">
                                        <a class="text-reset text-decoration-none" href="{{route('about-us-suppliers',$comp->id)}}">
                                            <div class="companies-card-content">
                                                <img src="{{$ASSET}}/front_site/images/groupsl-224.png">
                                                <span class="company-nm">{{$comp->company_name}}</span>
                                                <p class="company-content">{{substr_replace($comp->company_introduction, "...", 100) }}</p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                                <div class="text-right">
                                    <a href="{{route('view-all-companies')}}" class="red-link view-all">VIEW ALL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3 my-4 deals product-section-outer" id="buyingDeals">
                        @if(count($buysell_selling) > 0)
                            @foreach($buysell_selling as $i => $prod)
                                <div class="product-box content-column col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                                    <div class="content-column-inner">
                                        <a class="text-decoration-none text-reset" href="{{ route('serviceDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                        <div class="position-relative suppliers-buyers" style="height: 65%">
                                                <?php $img = \DB::table('buysell_images')->where('buy_sell_id',$prod->id)->get();?>
                                                @foreach($img as $i => $image)
                                                    @if($loop->first)
                                                        <img src="{{$ASSETS}}/{{$image->image}}"
                                                             class="w-100 h-100 certified-suppliers-img border-grey">
                                                            @if($prod->is_certified ==1)
                                                                <img src="{{$ASSET}}/front_site/images/certified_company.png" width="50" height="50" class="position-absolute certified-logo">
                                                            @endif
                                                            @if($prod->is_featured ==1)
                                                                <span class="position-absolute left-0 Featured-txt">Featured</span>
                                                            @endif
                                                            <div class="position-absolute heart-icon-div">
                                                                <a class="text-decoration-none text-reset" href="#add-fav-{{$prod->reference_no}}" data-toggle="modal">
                                                                           <span class="text-decoration-none add-to-fav">
                                                                                    <span class="@if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists()) check-heart fa fa-heart @else check-heart fa fa-heart-o @endif"></span>
                                                                           </span>
                                                                </a>
                                                            </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </a>
                                        <div id="add-fav-{{$prod->reference_no}}" class="change-password-modal modal fade">
                                            <div class="modal-dialog modal-dialog-centered modal-login">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                                                @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                                <span class="modal-title">REMOVE FROM FAVOURITE</span>
                                                                                @else
                                                                                <span class="modal-title">ADD TO FAVOURITE</span>
                                                                                @endif
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body pt-3">
                                                                                @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                                    <p style="color: white">Are you sure your product will be removed from the favourite</p>
                                                                                @else
                                                                                    <p style="color: white">A notification will be sent to supplier/buyer to contact you back</p>
                                                                                @endif
                                                        <div class="form-group mt-4 mb-0">
                                                            <button @if(Auth::check()) class="red-btn add-to-favourite" data-dismiss="modal" prod_id="{{$prod->id}}" product_service_name="{{$prod->product_service_name}}" product_service_types="{{$prod->product_service_types}}" reference_no="{{$prod->reference_no}}"  @else class="red-btn" data-dismiss="modal" data-toggle="modal" data-target="#login-form" @endif type="submit">Yes</button>
                                                            <button class="red-btn" data-dismiss="modal" aria-hidden="true">No</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="text-decoration-none text-reset" href="{{ route('serviceDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                        <div class="product-info">
                                            <p class="heading overflow-text-dots-subject">{{$prod->product_service_name}}</p>
                                            <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                            <p class="mb-0">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                            <p class="price font-500 overflow-text-dots-subject"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ moneyFormat($prod->unit_price_from) }} - {{ moneyFormat($prod->unit_price_to) }}   @else {{ moneyFormat($prod->target_price_from) }} - {{ moneyFormat($prod->target_price_to) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                            <p class="mt-2 mb-0 text-uppercase place-day">{{ $prod->city }}, {{ $prod->country }} <span class="pull-right">{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span></p>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="px-3"></p>
                        @endif
                    </div>
                    <div align="center" class="my-2">
                        <a href="#" class="load-more red-btn">Load More<span class="ml-2 fa fa-spinner" aria-hidden="true"></span></a>
                    </div>
                    <div class="my-4 position-relative">
                        <h3 class="main-heading">PREMIUM SUPPLIERS</h3>
                        <a href="{{route('view-all-companies')}}" class="position-absolute red-link view-all">VIEW ALL</a>
                    </div>
                    <div class="premium-suppliers-outer">
                        <div class="premium-suppliers">
                            @foreach($companies as $comp)
                                <div class="content-column text-center">
                                    <a class="text-reset text-decoration-none" href="{{route('about-us-suppliers',$comp->id)}}">
                                        <p class="mb-0 font-500 text-uppercase company-name overflow-text-dots-one-line">{{$comp->company_name}}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="my-4 position-relative">
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
        $(document).delegate('.add-to-favourite', 'click', function(e) {
            e.preventDefault();
            $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
            var reference_no=$(this).attr("reference_no");
            var prod_id = $(this).attr("prod_id");
            var product_service_name=$(this).attr("product_service_name");
            var product_service_types=$(this).attr("product_service_types");
            var token='{{csrf_token()}}';
            var thisVariable = $(this);
            // console.log($(this).text());
            $.ajax({
                type:'POST',
                url: '{{ url('/favourite-product-ajax') }}',
                data:{reference_no:reference_no,prod_id:prod_id,product_service_types:product_service_types,product_service_name:product_service_name,_token:token},
                cache: false,
                success: function(data) {

                    response = $.parseJSON(data);
                    if (response.feedback === "false") {
                        toastr.error(response.msg).fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        $("#loader").hide();
                        toastr.success(response.msg).fadeOut(2500);

                        let heart_btn = $(thisVariable).closest('.change-password-modal').siblings('.suppliers-buyers').find('.check-heart');
                        console.log(heart_btn);
                        if($(heart_btn).hasClass('fa-heart-o'))
                        {
                            console.log(heart_btn);
                            $(heart_btn).removeClass('fa-heart-o').addClass('fa-heart');
                        }
                        else if($(heart_btn).hasClass('fa-heart')){
                            $(heart_btn).removeClass('fa-heart').addClass('fa-heart-o');
                        }
                        // setTimeout(() => {
                        //     window.location.href = response.close();
                        // }, 500);
                    }
                }
            });
        });
    </script>

@endpush
