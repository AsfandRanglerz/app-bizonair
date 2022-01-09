@extends('front_site.master_layout')
@section('content')
    <body class="product-main product-listing">
    <main id="maincontent" class="page-main">
        @include('front_site.common.product-banner')
        <div class="main-container">
            <div class="container-fluid px-2 py-2">
                @include('front_site.common.garments-nav')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{ url('business-products/fibers-and-materials') }}">Textile Business</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{Request::url()}}"> {{$category->name}}</a></li>
                    </ol>
                </nav>
                <div class="mini-content-container">
                    <div class="row deals">
                        <div class="col-xl-10 col-lg-9 col-md-8 half-side-content">
                            <div class="mb-1 d-flex justify-content-between column-gap-4">
                                <h3 class="mb-0 main-heading">REGULAR SUPPLIERS LEADS</h3>
                                <div class="d-flex flex-column-reverse flex-end align-items-end">
                                    @if(!Auth::check())
                                        <a href="{{ url('log-in-pre') }}" class="mr-sm-2 mr-0 red-btn post-btn px-2">Post Your Regular Lead</a>
                                    @else
                                        <a href="{{ route('products.create') }}" class="mr-sm-2 mr-0 red-btn post-btn px-2">Post Your Regular Lead</a>
                                    @endif
                                    <a href="{{route('regular-suppliers',$slug)}}" class="red-link view-all">VIEW ALL</a>
                                </div>
                            </div>
{{--                            <div class="my-1 position-relative">--}}
{{--                                <h3 class="main-heading">SUB-CATEGORIES</h3>--}}
{{--                            </div>--}}
                            <nav class="my-1 navbar navbar-expand-lg navbar-light">
                                <a class="navbar-brand" href="#" data-toggle="collapse" data-target="#subCatPanel">Sub-Categories</a>
                                <button class="navbar-toggler" data-toggle="collapse" data-target="#subCatPanel" aria-controls="subCatPanel" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="fa fa-angle-down"></span>
                                </button>
                                <div class="py-1 collapse navbar-collapse" id="subCatPanel">
                                <div class="row mx-0 categories-side-section">
                                    <div class="col-6 p-0 categories-side-section-inner scroll-cat">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                @php
                                                    $sub_id_arr = [];
                                                @endphp
                                                @foreach(\App\Subcategory::where('category_id', $category->id)->get() as $i =>  $subcategory)
                                                    @php
                                                        array_push($sub_id_arr, $subcategory->id);
                                                    @endphp
                                                    <a class="d-flex justify-content-between align-items-center column-gap-10 nav-link @if($i == 0) active @endif" id="v-pills-cats-tab" data-toggle="pill" href="#v-pills-cats{{$subcategory->id}}" role="tab" aria-controls="v-pills-cats" aria-selected="true"><span class="overflow-text-dots-one-line" onclick="location.href='{{route('suppliers-subcategory-products',['category'=>$subcategory->category->slug,'subcategory'=>$subcategory->slug])}}'">{{$subcategory->name}}</span><span class="fa fa-angle-double-right"></span></a>
                                                @endforeach
                                            </div>
                                    </div>
                                    <div class="col-6 p-0 categories-side-section-inner scroll-cat">
                                        <span class="sub-sub-cat-heading">SUB SUB-Categories</span>
                                        <div class="tab-content" id="v-pills-tabContent">
                                            @foreach( $sub_id_arr as $key =>  $value)
                                                <div class="tab-pane fade @if ($key == 0) active show @endif" id="v-pills-cats{{$value}}" role="tabpanel" aria-labelledby="v-pills-cats-tab">
                                                    @foreach(\App\Childsubcategory::where('subcategory_id',$value)->orderby('subcategory_id','asc')->get() as $key =>  $childsubcat)
                                                        <a href="{{route('suppliers-products',['category'=>$subcategory->category->slug,'subcategory'=>$childsubcat->subcategory->slug,'childsubcategory'=>$childsubcat->slug])}}" class="nav-link red-link overflow-text-dots-one-line">{{$childsubcat->name}}</a>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </nav>
{{--                            <div class="categories-slider-outer">--}}
{{--                                <div class="categories-slider">--}}
{{--                                    @php--}}
{{--                                        $sub_id_arr = [];--}}
{{--                                    @endphp--}}
{{--                                    @foreach(\App\Subcategory::where('category_id', $category->id)->get() as $i =>  $subcategory)--}}
{{--                                        @php--}}
{{--                                            array_push($sub_id_arr, $subcategory->id);--}}
{{--                                        @endphp--}}
{{--                                        <div class="px-1 content-column text-center">--}}
{{--                                            <a class="text-decoration-none red-btn overflow-text-dots-one-line text-uppercase cat-link" href="{{route('suppliers-subcategory-products',['category'=>$subcategory->category->slug,'subcategory'=>$subcategory->slug])}}">{{$subcategory->name}}</a>--}}
{{--                                            <a class="fa fa-angle-down sub-cat-arrow-block"></a>--}}
{{--                                        </div>--}}
{{--                                        <a class="nav-link" id="v-pills-cats-tab" data-toggle="pill" href="#v-pills-cats{{$subcategory->id}}" role="tab" aria-controls="v-pills-cats" aria-selected="true" onclick="location.href='{{route('suppliers-subcategory-products',['category'=>$subcategory->category->slug,'subcategory'=>$subcategory->slug])}}'"><span class="fa fa-angle-double-right mr-2"></span>{{$subcategory->name}}</a>--}}
{{--                                    @endforeach--}}


{{--                                </div>--}}
{{--                                <div class="sub-cat-box">--}}
{{--                                    <h6 class="heading"><a class="fa fa-angle-left sub-cat-arrow-left"></a>Child Sub Categories</h6>--}}
{{--                                    <ul class="pl-3 sub-cat-listing-box">--}}
{{--                                        @foreach( $sub_id_arr as $key =>  $value)--}}
{{--                                            @foreach(\App\Childsubcategory::where('subcategory_id',$value)->orderby('subcategory_id','asc')->get() as $key =>  $childsubcat)--}}
{{--                                        <li><a href="{{route('suppliers-products',['category'=>$subcategory->category->slug,'subcategory'=>$childsubcat->subcategory->slug,'childsubcategory'=>$childsubcat->slug])}}" class="link">{{$childsubcat->name}}</a></li>--}}
{{--                                            @endforeach--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row deals-inner-half" id="sellingDeals">
                                <div class="p-0 col-xl-9 col-lg-9 content-column">
                                    <div class="row m-0 product-section-outer">
                                        @if(count($topsellproduct) > 0)
                                            @foreach($topsellproduct as $i => $prod)
                                                <div class="my-1 content-column product-section-upper col-xl-2 col-6">
                                                    <div class="product-section">
                                                        <a class="text-decoration-none text-reset" href="{{ route('productDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                            <div class="position-relative suppliers-buyers">
                                                                    @if($prod->product_image->isNotEmpty())
                                                                      @foreach($prod->product_image as $j => $image)
                                                                        @if($loop->first)
                                                                            <img src="{{$image->image}}"
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
                                                                    @else
                                                                        <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img border-grey">
                                                                    @endif
                                                            </div>
                                                            <div id="add-fav-{{$prod->reference_no}}" class="change-password-modal modal fade">
                                                                <div class="modal-dialog modal-dialog-centered modal-login">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                                <span class="modal-title">REMOVE FROM FAVOURITE</span>
                                                                            @else
                                                                                <span class="modal-title">ADD TO FAVOURITE</span>
                                                                            @endif
                                                                            <a class="close red-btn" data-dismiss="modal" aria-hidden="true">&times;</a>
                                                                        </div>
                                                                        <div class="modal-body pt-3">
                                                                            @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                                <p style="color: white">Are you sure your product will be removed from the favourite</p>
                                                                            @else
                                                                                <p style="color: white">A notification will be sent to supplier/buyer to contact you back</p>
                                                                            @endif
                                                                            <div class="form-group mt-4 mb-0">
                                                                                @if(!Auth::check())
                                                                                    <button href="{{url('log-in-pre')}}" class="red-btn">Yes</button>
                                                                                @else
                                                                                    <button class="red-btn add-to-favourite" data-dismiss="modal" prod_id="{{$prod->id}}" product_service_name="{{$prod->product_service_name}}" product_service_types="{{$prod->product_service_types}}" reference_no="{{$prod->reference_no}}" type="submit">Yes</button>
                                                                                @endif
                                                                                <button class="red-btn" data-dismiss="modal" aria-hidden="true">No</button>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="text-decoration-none text-reset" href="{{ route('productDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                            <div class="product-info">
                                                                <p class="heading overflow-text-dots-subject">{{$prod->product_service_name}}</p>
                                                                <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                                                <p class="mb-0">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                                                <p class="price font-500 overflow-text-dots-subject"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ number_format($prod->unit_price_from) }} - {{ number_format($prod->unit_price_to) }}   @else {{ number_format($prod->target_price_from) }} - {{ number_format($prod->target_price_to) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                                                <div class="d-flex justify-content-between mt-2 mb-0 text-uppercase place-day">
                                                                    <span class="place">{{ $prod->city }}, {{ $prod->country }}</span>
                                                                    <span>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="mb-0 py-2 px-2">No Product Found Related To This Category...</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-md-0 mt-2 h-auto col-xl-2 col-lg-3 col-md-4 half-side-content">
                            <h3 class="text-center main-heading">TOP COMPANIES</h3>
                            <div class="position-relative top-companies">
                                @foreach($topcompanies as $comp)
                                    <a class="text-reset text-decoration-none" href="{{url($comp->id.'/'.$comp->company_name.'/about-us-suppliers')}}">
                                    <div class="top-companies-card">
                                        <img alt="100x100" src="{{$comp->logo }}"
                                             data-holder-rendered="true" height="145" class="w-100 object-contain border-grey">
                                            <div class="companies-card-content">
                                                <img src="{{$ASSET}}/front_site/images/groupsl-224.png">
                                                <span class="company-nm">{{$comp->company_name}}</span>
                                                <p class="company-content overflow-text-dots-three-line">{!!strip_tags($comp->company_introduction)!!}</p>
                                            </div>
                                    </div>
                                    </a>
                                @endforeach
                                <a href="{{route('view-all-companies',['category'=>$category->slug])}}" class="position-absolute red-link view-all" style="right: 15px;bottom: 5px">VIEW ALL</a>
                            </div>
                        </div>
                    </div>
                    <div class="row my-1 deals product-section-outer" id="buyingDeals">
                        <div class="col-12 my-1 px-1 d-flex justify-content-between">
                            <h3 class="mb-0 main-heading">REGULAR BUYERS LEADS</h3>
                            <div class="d-flex flex-column-reverse align-items-end">
                                @if(!Auth::check())
                                    <a href="{{ url('log-in-pre') }}" class="mr-sm-2 mr-0 red-btn post-btn px-2">Post Your Regular Lead</a>
                                @else
                                    <a href="{{ route('products.create') }}" class="mr-sm-2 mr-0 red-btn post-btn px-2">Post Your Regular Lead</a>
                                @endif
                                <a href="{{route('regular-buyers',$slug)}}" class="red-link view-all">VIEW ALL</a>
                            </div>
                        </div>
                        @if(count($topbuyproduct) > 0)
                            @foreach($topbuyproduct as $i => $prod)
                                <div class="content-column col-xl-2 col-lg-3 col-md-4 col-6 my-1">
                                    <div class="content-column-inner">
                                        <a class="text-decoration-none text-reset" href="{{ route('productDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                            <div class="position-relative suppliers-buyers" style="height: 65%;">
                                                @if($prod->product_image->isNotEmpty())
                                                @foreach($prod->product_image as $i => $image)
                                                    @if($loop->first)
                                                        <img src="{{$image->image}}"
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
                                                @else
                                                    <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img border-grey">
                                                @endif
                                            </div>
                                            <div id="add-fav-{{$prod->reference_no}}" class="change-password-modal modal fade">
                                                <div class="modal-dialog modal-dialog-centered modal-login">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                <span class="modal-title">REMOVE FROM FAVOURITE</span>
                                                            @else
                                                                <span class="modal-title">ADD TO FAVOURITE</span>
                                                            @endif
                                                            <a class="close red-btn" data-dismiss="modal" aria-hidden="true">&times;</a>
                                                        </div>
                                                        <div class="modal-body pt-3">
                                                            @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                <p style="color: white">Are you sure your product will be removed from the favourite</p>
                                                            @else
                                                                <p style="color: white">A notification will be sent to supplier/buyer to contact you back</p>
                                                            @endif
                                                            <div class="form-group mt-4 mb-0">
                                                                @if(!Auth::check())
                                                                    <a href="{{url('log-in-pre')}}" class="red-btn">Yes</a>
                                                                @else
                                                                    <button class="red-btn add-to-favourite" data-dismiss="modal" prod_id="{{$prod->id}}" product_service_name="{{$prod->product_service_name}}" product_service_types="{{$prod->product_service_types}}" reference_no="{{$prod->reference_no}}" type="submit">Yes</button>
                                                                @endif
                                                                <button class="red-btn" data-dismiss="modal" aria-hidden="true">No</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="text-decoration-none text-reset" href="{{ route('productDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                            <div class="product-info">
                                                <p class="heading overflow-text-dots-subject">{{$prod->product_service_name}}</p>
                                                <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                                <p class="mb-0">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                                <p class="price font-500 overflow-text-dots-subject"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ number_format($prod->unit_price_from) }} - {{ number_format($prod->unit_price_to) }}  @else {{ number_format($prod->target_price_from) }} - {{ number_format($prod->target_price_to) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                                <div class="d-flex justify-content-between mt-2 mb-0 text-uppercase place-day">
                                                    <span class="place">{{ $prod->city }}, {{ $prod->country }}</span>
                                                    <span>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="mb-0 py-2 px-2">No Product Found Related To This Category...</p>
                        @endif
                    </div>

                    <div href="#" class="position-relative my-1 d-flex justify-content-end">
                        <a @if(auth()->check()) href="{{ route('buy-sell.create') }}" @else href="{{ route('log-in-pre') }}" @endif class="position-absolute post-requirement-btn">POST YOUR REQUIREMENT</a>
                        @foreach($ads as $ad)
                            <a href="{{ $ad->link }}" class="w-100">
                                <img src="{{ $ad->image }}" class="w-100">
                            </a>
                        @endforeach
                    </div>
                    <div class="row my-1 deals certified-suppliers product-section-outer">
                        <div class="col-12 my-1 px-1 d-flex justify-content-between">
                            <h3 class="mb-0 main-heading">ONE-TIME SELLING DEALS</h3>
                            <div class="d-flex flex-column-reverse align-items-end">
                                @if(!Auth::check())
                                    <a href="{{ url('log-in-pre') }}" class="mr-sm-2 mr-0 red-btn post-btn px-2">Post Your One-Time Deal</a>
                                @else
                                    <a href="{{ route('buy-sell.create') }}" class="mr-sm-2 mr-0 red-btn post-btn px-2">Post Your One-Time Deal</a>
                                @endif
                                <a href="{{route('one-time-selling-deals',$slug)}}" class="red-link view-all">VIEW ALL</a>
                            </div>
                        </div>
                        @if(count($buysell_selling) > 0)
                            @foreach($buysell_selling as $i => $prod)
                                <div class="content-column col-xl-2 col-lg-3 col-md-4 col-6 my-1">
                                    <div class="h-100 content-column-inner">
                                        <a class="text-decoration-none text-reset" href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                            <div class="position-relative suppliers-buyers">
                                                <?php $img = \DB::table('buysell_images')->where('buy_sell_id',$prod->id)->get();?>
                                                    @if($img->isNotEmpty())
                                                    @foreach($img as $i => $image)
                                                    @if($loop->first)
                                                        <img src="{{$image->image}}"
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
                                                    @else
                                                        <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img border-grey">
                                                    @endif
                                            </div>
                                            <div id="add-fav-{{$prod->reference_no}}" class="change-password-modal modal fade">
                                                <div class="modal-dialog modal-dialog-centered modal-login">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                <span class="modal-title">REMOVE FROM FAVOURITE</span>
                                                            @else
                                                                <span class="modal-title">ADD TO FAVOURITE</span>
                                                            @endif
                                                            <a class="close red-btn" data-dismiss="modal" aria-hidden="true">&times;</a>
                                                        </div>
                                                        <div class="modal-body pt-3">
                                                            @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                <p style="color: white">Are you sure your product will be removed from the favourite</p>
                                                            @else
                                                                <p style="color: white">A notification will be sent to supplier/buyer to contact you back</p>
                                                            @endif
                                                            <div class="form-group mt-4 mb-0">
                                                                @if(!Auth::check())
                                                                    <a href="{{url('log-in-pre')}}" class="red-btn">Yes</a>
                                                                @else
                                                                    <button class="red-btn add-to-favourite" data-dismiss="modal" prod_id="{{$prod->id}}" product_service_name="{{$prod->product_service_name}}" product_service_types="{{$prod->product_service_types}}" reference_no="{{$prod->reference_no}}" type="submit">Yes</button>
                                                                @endif
                                                                <button class="red-btn" data-dismiss="modal" aria-hidden="true">No</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="text-decoration-none text-reset" href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                            <div class="product-info">
                                                <p class="heading overflow-text-dots-subject">{{$prod->product_service_name}}</p>
                                                <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                                <p class="mb-0">Quantity : @if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif @if($prod->available_unit == "Other") {{$prod->other_available_unit}} @else {{$prod->available_unit}} @endif</p>
                                                <p class="price font-500 overflow-text-dots-subject"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ number_format($prod->unit_price_from) }}  @else {{ number_format($prod->target_price_from) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                                <div class="d-flex justify-content-between mt-2 mb-0 text-uppercase place-day">
                                                    <span class="place">{{ $prod->city }}, {{ $prod->country }}</span>
                                                    <span>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="mb-0 py-2 px-2">No Product Found Related To This Category...</p>
                        @endif
                    </div>
                    <div class="row deals certified-suppliers product-section-outer">
                        <div class="col-12 my-1 px-1 d-flex justify-content-between">
                            <h3 class="mb-0 main-heading">ONE-TIME BUYING DEALS</h3>
                            <div class="d-flex flex-column-reverse align-items-end">
                                @if(!Auth::check())
                                    <a href="{{ url('log-in-pre') }}" class="mr-sm-2 mr-0 red-btn post-btn px-2">Post Your One-Time Deal</a>
                                @else
                                    <a href="{{ route('buy-sell.create') }}" class="mr-sm-2 mr-0 red-btn post-btn px-2">Post Your One-Time Deal</a>
                                @endif
                                <a href="{{route('one-time-buying-deals',$slug)}}" class="red-link view-all">VIEW ALL</a>
                            </div>
                        </div>
                        @if(count($buysell_buying) > 0)
                            @foreach($buysell_buying as $i => $prod)
                                <div class="content-column col-xl-2 col-lg-3 col-md-4 col-6 my-1">
                                    <div class="h-100 content-column-inner">
                                        <a class="text-decoration-none text-reset" href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                            <div class="position-relative suppliers-buyers">
                                                <?php $img = \DB::table('buysell_images')->where('buy_sell_id',$prod->id)->get();?>
                                                    @if($img->isNotEmpty())
                                                @foreach($img as $i => $image)
                                                    @if($loop->first)
                                                        <img src="{{$image->image}}"
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
                                                    @else
                                                        <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img border-grey">
                                                    @endif
                                            </div>
                                            <div id="add-fav-{{$prod->reference_no}}" class="change-password-modal modal fade">
                                                <div class="modal-dialog modal-dialog-centered modal-login">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                <span class="modal-title">REMOVE FROM FAVOURITE</span>
                                                            @else
                                                                <span class="modal-title">ADD TO FAVOURITE</span>
                                                            @endif
                                                            <a class="close red-btn" data-dismiss="modal" aria-hidden="true">&times;</a>
                                                        </div>
                                                        <div class="modal-body pt-3">
                                                            @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                <p style="color: white">Are you sure your product will be removed from the favourite</p>
                                                            @else
                                                                <p style="color: white">A notification will be sent to supplier/buyer to contact you back</p>
                                                            @endif
                                                            <div class="form-group mt-4 mb-0">
                                                                @if(!Auth::check())
                                                                    <a href="{{url('log-in-pre')}}" class="red-btn">Yes</a>
                                                                @else
                                                                    <button class="red-btn add-to-favourite" data-dismiss="modal" prod_id="{{$prod->id}}" product_service_name="{{$prod->product_service_name}}" product_service_types="{{$prod->product_service_types}}" reference_no="{{$prod->reference_no}}" type="submit">Yes</button>
                                                                @endif
                                                                <button class="red-btn" data-dismiss="modal" aria-hidden="true">No</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="text-decoration-none text-reset" href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                            <div class="product-info">
                                                <p class="heading overflow-text-dots-subject">{{$prod->product_service_name}}</p>
                                                <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                                <p class="mb-0">Quantity : @if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif @if($prod->available_unit == "Other") {{$prod->other_available_unit}} @else {{$prod->available_unit}} @endif</p>
                                                <p class="price font-500 overflow-text-dots-subject"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ number_format($prod->unit_price_from) }}  @else {{ number_format($prod->target_price_from) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                                <div class="d-flex justify-content-between mt-2 mb-0 text-uppercase place-day">
                                                    <span class="place">{{ $prod->city }}, {{ $prod->country }}</span>
                                                    <span>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="mb-0 py-2 px-2">No Product Found Related To This Category...</p>
                        @endif
                    </div>
                    <div class="my-1 position-relative">
                        <h3 class="main-heading">RELATED COMPANIES</h3>
                        <a href="{{route('view-all-companies',['category'=>$category->slug])}}" class="position-absolute red-link view-all">VIEW ALL</a>
                    </div>
                    @if(count($companies) > 0)
                    <div class="premium-suppliers-outer">
                        <div class="premium-suppliers">
                            @foreach($companies as $comp)
                                <div class="content-column text-center">
                                    <a class="text-reset text-decoration-none" href="{{route('about-us-suppliers',['id'=>$comp->id,'company'=>$comp->company_name])}}">
                                        <p class="mb-0 font-500 company-name overflow-text-dots-one-line text-uppercase">{{$comp->company_name}}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                        <p>No Related Companies to Show at Present</p>
                    @endif
                    <div class="my-1 position-relative">
                        <h3 class="main-heading text-center">TEXTILE PARTNERS</h3>
                    </div>
                    <div class="container-fluid logo-slider">
                        <div class="slider slider-nav w-100">
                            @foreach($textile_partners as $text_partners)
                                <a href="{{ $text_partners->link }}" class="logo-container"><img
                                        src="{{ $text_partners->image }}"
                                        alt="100x100" data-holder-rendered="true"
                                        class="w-100 h-100">
                                </a>
                            @endforeach
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
