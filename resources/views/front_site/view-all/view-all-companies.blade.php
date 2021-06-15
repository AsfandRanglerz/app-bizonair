@extends('front_site.master_layout')
@section('content')
<body>
<style type="text/css" media="screen">
    /*top companies blocks styling here*/
    .view-all-pg .top-companies .top-company-img {
        height: 225px;
    }
    .view-all-pg .top-companies .company-content {
        font-size: 15px!important;
        line-height: unset!important;
    }
    .view-all-pg .top-companies .companies-card-img {
        width: 65px!important;
        height: 65px!important;
        margin-top: -55px!important;
    }
    /*top companies blocks styling here*/

    /*view all page*/
    .view-all-pg .banner .banner-content {
        top: 0;
        background: #00000085;
    }

    .view-all-pg .banner-img {
        height: 325px;
        object-fit: cover;
    }
    .view-all-pg .banner-main-heading {
        margin-top: 75px;
    }

    .view-all-pg .banner-text {
        font-size: 24px;
    }
    /*view all page*/

    @media (max-width: 991px) {
        /*view all page*/
        .view-all-pg .banner-text {
            font-size: 18px;
        }

        .view-all-pg .banner-main-heading {
            font-size: 24px;
        }
        /*view all page*/
    }
    @media (max-width: 575px) {
        /*view all page*/
        .view-all-pg .banner-text {
            font-size: 14px;
        }

        .view-all-pg .banner-img {
            height: 265px;
        }
        /*view all page*/
    }
</style>
<main id="maincontent" class="product-listing view-all-pg">
    <div class="position-relative banner">
        <img src="{{$ASSET}}/front_site/images/Research Artciles Page.png" class="w-100 banner-img">
        <div class="position-absolute w-100 h-100 d-flex flex-column align-items-center banner-content">
            <h1 class="animated fadeInLeft text-white text-uppercase font-500 banner-main-heading">Companies</h1>
            <h4 class="animated fadeInRight text-white text-uppercase text-center pl-4 pr-4 banner-text">Sample Text Sample Text Sample Text Sample Text</h4>

            @include('front_site.common.search-bar')
        </div>
    </div>
    <nav aria-label="breadcrumb" class="px-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{Request::url()}}">Companies</a></li>
        </ol>
    </nav>
    <div class="my-3 px-0 container-fluid">
        <div class="row m-0">
                @foreach($allcompanies as $company)
                    <div class="col-lg-3 col-md-6 product-box textile-box">
                        <div class="border-0 p-0 d-block top-companies">
                            <div class="my-2 top-companies-card">
                                <img alt="100x100" src="{{$ASSET.'/front_site/images/company-images/'.$company->logo }}"
                                     data-holder-rendered="true" class="w-100 object-contain top-company-img border-grey">
                                <a class="text-reset text-decoration-none" href="{{route('about-us-suppliers',$company->id)}}">
                                    <div class="companies-card-content">
                                        <img src="{{$ASSET}}/front_site/images/groupsl-224.png" class="companies-card-img">
                                        <span class="company-nm" style="font-size: 16px">{{$company->company_name}}</span>
                                        <p class="overflow-text-dots company-content">{{substr_replace($company->company_introduction, "...", 100) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
        <div align="center" class="my-2">
            <a href="#" class="load-more red-btn">Load More<span class="ml-2 fa fa-spinner" aria-hidden="true"></span></a>
        </div>
    </div>
</main>
</body>
@endsection

