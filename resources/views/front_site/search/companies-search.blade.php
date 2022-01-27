@extends('front_site.master_layout')
@section('metadata')
    <link rel="stylesheet" type="text/css" href="{{$ASSET}}/front_site/css/animate.min.css">
@endsection
@section('content')
    <body class="product-details">
    <style>
        .product-banner-container .banner-search {
            bottom: 0;
        }
    </style>
    <main id="maincontent" class="page-main">
{{--        <div class="position-relative" style="height: 90px">--}}
{{--            @include('front_site.common.search-bar')--}}
{{--        </div>--}}

        <div class="suppliers-buyers">
            <div class="container-fluid px-2 py-2">
                <div class="mb-2 font-500 searh-status">Search Criteria : <span class="grey-text">Search Name - </span>{{ $search }}, <span class="grey-text">Lead Type - </span>{{ $category }} <span class="grey-text">({{count($allcompanies)}} COMPANIES)</span></div>
                <div class="row mx-0 mb-4 search-main-container">
                    <div class="col-md-12 p-2">
                        <div class="d-flex flex-wrap justify-content-around link-heading-container">
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=Regular+Supplier&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">MYBIZ LEADS ({{getRegularSupplier(request()->keywords)+getRegularBuyer(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=One-Time+Supplier&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">ONE-TIME DEALS ({{getOneTimeSupplier(request()->keywords)+getOneTimeBuyer(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=Regular+Services&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">SERVICES ({{getServiceProviders(request()->keywords)+getServiceSeekers(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading active-heading"><a href="{{url('search-product?category=Companies&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">COMPANIES ({{getSearchCompanies(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=articles&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">ARTICLES ({{getArticles(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=news&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">NEWS ({{getNews(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=events&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">EVENTS ({{getEvents(request()->keywords)}})</a></h6>
                        </div>
                        <div class="mb-2 px-0 container-fluid">
                            <div class="mt-2 product-main-container">
                                <div class="row m-0">
                                    @if(count($allcompanies) > 0)
                                    @foreach($allcompanies as $company)
                                        <div class="col-lg-3 col-6 product-box textile-box">
                                            <div class="border-0 p-0 d-block top-companies">
                                                <a class="text-reset text-decoration-none" href="{{route('about-us-suppliers',['id'=>$company->id,'company'=>$company->company_name])}}">
                                                    <div class="my-2 top-companies-card">
                                                        <img alt="100x100" src="{{$company->logo }}"
                                                            data-holder-rendered="true" class="w-100 object-contain top-company-img border-grey">
                                                        <div class="companies-card-content">
                                                            <img src="{{$ASSET}}/front_site/images/groupsl-224.png" class="companies-card-img">
                                                            <span class="company-nm" style="font-size: 16px">{{$company->company_name}}</span>
                                                            <p class="overflow-text-dots company-content">{!!strip_tags($company->company_introduction)!!}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    @else
                                    <div class="w-100 product-box">
                                        <div class="ml-1 mr-1 row product-content-container">
                                            <p class="mb-0">Sorry, there were no items that matched your criteria.</p>
                                        </div>
                                    </div>
                                    @endif
{{--                                    <nav class="w-100 mt-3">--}}
{{--                                        <ul class="mb-0 mr-1 d-flex justify-content-end pagination">--}}
{{--                                                <li class="page-item disabled">--}}
{{--                                                <span class="page-link">Previous</span>--}}
{{--                                            </li>--}}
{{--                                                <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                                                <li class="page-item active">--}}
{{--                                                <span class="page-link">2<span class="sr-only">(current)</span>--}}
{{--                                            </span>--}}
{{--                                            </li>--}}
{{--                                            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                            <li class="page-item">--}}
{{--                                            <a class="page-link" href="#">Next</a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </nav>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
@endsection
