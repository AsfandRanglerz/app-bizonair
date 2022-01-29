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
                <div class="mb-2 font-500 searh-status">Search Criteria : <span class="grey-text">Search Name - </span>{{ $search }}, <span class="grey-text">Type - </span>{{ $category }} <span class="grey-text">({{count($data)}} NEWS)</span></div>
                <div class="row mx-0 mb-4 search-main-container">
                    <div class="col-md-12 p-2">
                        <div class="d-flex flex-wrap justify-content-around link-heading-container">
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=Regular+Supplier&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">MYBIZ LEADS ({{getRegularSupplier(request()->keywords)+getRegularBuyer(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=One-Time+Supplier&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">ONE-TIME DEALS ({{getOneTimeSupplier(request()->keywords)+getOneTimeBuyer(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=Regular+Services&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">SERVICES ({{getServiceProviders(request()->keywords)+getServiceSeekers(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=Companies&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">COMPANIES ({{getSearchCompanies(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=articles&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">ARTICLES ({{getArticles(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading active-heading"><a href="{{url('search-product?category=news&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">NEWS ({{getNews(request()->keywords)}})</a></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=events&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">EVENTS ({{getEvents(request()->keywords)}})</a></h6>
                        </div>
                        <div class="mb-2 px-0 container-fluid">
                            <div class="mt-2 product-main-container">
                                <div class="row m-0 textile-news-inner">
                                    @if(count($data) > 0)
                                    @foreach($data as $article)
                                        <div class="product-box col-lg-3 col-6 my-1 px-1 textile-box">
                                            <a href="{{route('news-detail',['id'=>$article->id])}}" class="text-decoration-none">
                                                @if(isset($article->image))
                                                    <img src="{{$article->image}}">
                                                @else
                                                    <img src="{{$ASSET}}/front_site/images/noimage.png">
                                                @endif
                                                <div class="mb-0 textile-caption">
                                                    <span class="overflow-text-dots-one-line">News | {{date("d-F-Y", strtotime($article->publish_date))}}</span>
                                                    <p class="overflow-text-dots">{{$article->title}}</p>
                                                </div>
                                            </a>
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
