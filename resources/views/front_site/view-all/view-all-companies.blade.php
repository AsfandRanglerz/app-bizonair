@extends('front_site.master_layout')
@section('content')
<body>
<main id="maincontent" class="product-listing view-all-pg">
    <nav aria-label="breadcrumb" class="px-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{Request::url()}}">Companies</a></li>
        </ol>
    </nav>
    <div class="container-fluid px-1">
        <div class="row m-0">
                @foreach($allcompanies as $company)
                    <div class="product-box col-md-3 col-6 px-0 textile-box">
                        <div class="border-0 p-0 d-block top-companies">
                            <div class="top-companies-card">
                                <img alt="100x100" src="{{$company->logo }}"
                                     data-holder-rendered="true" class="w-100 object-contain top-company-img border-grey">
                                <a class="text-reset text-decoration-none" href="{{route('about-us-suppliers',['id'=>$company->id,'company'=>$company->company_name])}}">
                                    <div class="companies-card-content">
                                        <img src="{{$ASSET}}/front_site/images/groupsl-224.png" class="companies-card-img">
                                        <span class="company-nm">{{$company->company_name}}</span>
                                        <p class="overflow-text-dots company-content">{!!strip_tags($company->company_introduction)!!}</p>
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

