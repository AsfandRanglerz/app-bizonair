@extends('front_site.master_layout')
@section('content')
    <body class="product-main">
    <main id="maincontent" class="blogs-page">
        @include('front_site.common.product-banner')
        <div class="main-container">
            <div class="container-fluid px-md-3 px-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{Request::url()}}">Journal</a></li>
                    </ol>
                </nav>
                <div class="row mx-0">
                    <div class="col-lg-3 px-0">
                            @include('front_site.common.journal-sidebar')
                    </div>
                    <div class="col-lg-9 px-0">
                        <div class="row mx-0">
                            <div class="col-lg-6 col-md-6 px-0">
                                <h3 class="py-1 heading">Research/Articles</h3>
                                <div class="mb-1 journal-content">
                                    <div class="journal-content-inner">
                                        @foreach($articles as $article)
                                        <a href="{{route('journal-detail',['type'=>$article->journal_type_name,'id'=>$article->id])}}" class="text-decoration-none text-reset">
                                            <div class="d-flex articles-block">
                                                @if(\File::exists('public/assets/front_site/blogs/'.$article->image))
                                                    <img src="{{$ASSET}}/front_site/blogs/{{$article->image}}" class="articles-img">
                                                @else
                                                    <img src="{{ url('storage/app/public/'.$article->image) }}" class="articles-img">
                                                @endif
                                                <div class="d-flex flex-column articles-info-inner">
                                                    <span class="pl-3 articles-date">{{date("d-F-Y", strtotime($article->publish_date))}}</span>
                                                    <p class="pl-3 mb-0 title overflow-text-dots">{{$article->title}}</p>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                    <div class="pr-2 pb-1 text-right">
                                        <a href="{{route('articles')}}" class="red-link view-all-link">View All</a>
                                    </div>
                                </div>

                                <h3 class="py-1 heading">Student Projects</h3>
                                <div class="mb-1 journal-content">
                                    <div class="journal-content-inner">
                                        @foreach($events as $article)
                                            <a href="{{route('journal-detail',['type'=>$article->journal_type_name,'id'=>$article->id])}}" class="text-decoration-none text-reset">
                                                <div class="d-flex articles-block">
                                                    @if(\File::exists('public/assets/front_site/blogs/'.$article->image))
                                                        <img src="{{$ASSET}}/front_site/blogs/{{$article->image}}" class="articles-img">
                                                    @else
                                                        <img src="{{ url('storage/app/public/'.$article->image) }}" class="articles-img">
                                                    @endif
                                                    <div class="d-flex flex-column articles-info-inner">
                                                        <span class="pl-3 articles-date">{{date("d-F-Y", strtotime($article->publish_date))}}</span>
                                                        <p class="pl-3 mb-0 title overflow-text-dots">{{$article->title}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="pr-2 pb-1 text-right">
                                        <a href="{{route('projects')}}" class="red-link view-all-link">View All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 px-0">

                                <h3 class="py-1 heading">Upcoming Events</h3>
                                <div class="mb-1 journal-content">
                                    <div class="journal-content-inner">
                                        @foreach($sprojects as $article)
                                            <a href="{{route('journal-detail',['type'=>$article->journal_type_name,'id'=>$article->id])}}" class="text-decoration-none text-reset">
                                                <div class="d-flex articles-block">
                                                    @if(\File::exists('public/assets/front_site/blogs/'.$article->image))
                                                        <img src="{{$ASSET}}/front_site/blogs/{{$article->image}}" class="articles-img">
                                                    @else
                                                        <img src="{{ url('storage/app/public/'.$article->image) }}" class="articles-img">
                                                    @endif
                                                    <div class="d-flex flex-column articles-info-inner">
                                                        <span class="pl-3 articles-date">{{date("d-F-Y", strtotime($article->publish_date))}}</span>
                                                        <p class="pl-3 mb-0 title overflow-text-dots">{{$article->title}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="pr-2 pb-1 text-right">
                                        <a href="{{route('events')}}" class="red-link view-all-link">View All</a>
                                    </div>
                                </div>


                                <h3 class="py-1 heading">News</h3>
                                <div class="mb-1 journal-content">
                                    <div class="journal-content-inner">
                                        @foreach($news as $article)
                                            <a href="{{route('news-detail',['id'=>$article->id])}}" class="text-decoration-none text-reset">
                                                <div class="d-flex articles-block">
                                                    @if(\File::exists('public/assets/front_site/blogs/'.$article->image))
                                                        <img src="{{$ASSET}}/front_site/blogs/{{$article->image}}" class="articles-img">
                                                    @else
                                                        <img src="{{ url('storage/app/public/'.$article->image) }}" class="articles-img">
                                                    @endif
                                                    <div class="d-flex flex-column articles-info-inner">
                                                        <span class="pl-3 articles-date">{{date("d-F-Y", strtotime($article->publish_date))}}</span>
                                                        <p class="pl-3 mb-0 title overflow-text-dots">{{$article->title}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="pr-2 pb-1 text-right">
                                        <a href="{{route('news')}}" class="red-link view-all-link">View All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-1 w-100 d-flex justify-content-around">
                                <a href="{{ route('calculation-formula') }}" class="m-sm-0 m-1 text-center red-link pg-red-link">Textile Calculations</a>
                                <a href="{{ route('currency-rates') }}" class="m-sm-0 m-1 text-center red-link pg-red-link">Currency Rates</a>
                                <a href="{{route('cotton-rates')}}" class="m-sm-0 m-1 text-center red-link pg-red-link">Cotton Rates</a>
                                <a href="{{route('bizonair-404')}}" class="m-sm-0 m-1 text-center red-link pg-red-link">Yarn Rates</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
@endsection
