@extends('front_site.master_layout')
@section('content')
    <body>
    <main id="maincontent" class="article-details">
        <nav aria-label="breadcrumb" class="px-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{ route('journal') }}">Journal</a></li>
                    @foreach($journal as $article)
                        @if($article->journal_type_name == 'Upcomming Events')
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{url('/journal/events')}}">Events</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{Request::url()}}">Events Detail</a></li>
                    @elseif($article->journal_type_name == 'Student Projects')
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{url('/journal/projects')}}">Project</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{Request::url()}}">Project Detail</a></li>
                    @elseif($article->journal_type_name == 'Articles')
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{url('/journal/articles')}}">Article</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{Request::url()}}">Article Detail</a></li>
                    @endif
                    @endforeach
            </ol>
        </nav>
        <div class="mt-2 mb-5 container-fluid px-2">
            <div class="row m-0">
                @foreach($journal as $article)
                    <div class="px-0 col-xl-9 col-md-8 overflow-auto article-details-outer scroll-bar">
                        <div class="row mx-0">
                            <div class="offset-sm-2 col-sm-8 px-0">
                                    @if(isset($article->image))
                                        <img src="{{ $article->image }}" class="w-100 object-contain journal-banner-img">
                                    @else
                                        <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 object-contain journal-banner-img">
                                    @endif
                                <h4 class="my-2 px-2 heading">{{$article->title}}</h4>
                            </div>
                        </div>
                        <div class="text-justify article-details-content px-2">
                            <p>{!! $article->description !!}</p>
                        </div>
                    </div>
                @endforeach
                <div class="col-xl-3 col-md-4 px-md-3 p-0 mt-md-0 mt-2">
                    <div class="p-2 articles-sidebar">
                        <div class="quick-links">
                            <span class="d-block heading">Quick Links</span>
                            <a href="{{ route('articles') }}" class="text-decoration-none red-link d-block">Articles</a>
                            <a href="{{ route('news') }}" class="text-decoration-none red-link d-block">News</a>
                            <a href="{{route('blogs')}}" class="text-decoration-none red-link d-block">Blogs</a>
                            <a href="{{ route('events') }}" class="text-decoration-none red-link d-block">Events</a>
                            <a href="{{ route('projects') }}" class="text-decoration-none red-link d-block">Project</a>
                        </div>
                        @if($related->isNotEmpty())
                        <div class="my-1 d-flex justify-content-between">
                            @foreach($journal as $article)
                                @if($article->journal_type_name == 'Upcomming Events')
                                    <span class="heading">Related Events</span>
                                @elseif($article->journal_type_name == 'Student Projects')
                                    <span class="heading">Related Projects</span>
                                @elseif($article->journal_type_name == 'Articles')
                                    <span class="heading">Related Articles</span>
                                @endif
                            @endforeach
                            <a href="{{route('journal')}}" class="red-link view-all">View All</a>
                        </div>
                        <div class="articles-widget">
                            @foreach($related as $post)
                            <a href="{{route('journal-detail',['type'=>$post->journal_type_name,'id'=>$post->id])}}" class="text-decoration-none text-reset">
                                <div class="d-flex articles-block">
                                    @if(isset($post->image))
                                        <img src="{{$post->image}}" class="articles-img">
                                    @else
                                        <img src="{{$ASSET}}/front_site/images/noimage.png" class="articles-img">
                                    @endif
                                    <div class="d-flex flex-column articles-info-inner">
                                        <span class="pl-3 articles-date">{{date("d-F-Y", strtotime($post->publish_date))}}</span>
                                        <p class="pl-3 mb-0 title overflow-text-dots">{{ucwords($post->title)}}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @endif
                        @if($latest->isNotEmpty())
                            <div class="my-1 d-flex justify-content-between">
                                @foreach($journal as $article)
                                    @if($article->journal_type_name == 'Upcomming Events')
                                        <span class="heading">Latest Events</span>
                                    @elseif($article->journal_type_name == 'Student Projects')
                                        <span class="heading">Latest Projects</span>
                                    @elseif($article->journal_type_name == 'Articles')
                                        <span class="heading">Latest Articles</span>
                                    @endif
                                @endforeach
                                <a href="{{route('journal')}}" class="red-link view-all">View All</a>
                            </div>
                            <div class="articles-widget">
                                @foreach($latest as $post)
                                    <a href="{{route('journal-detail',['type'=>$post->journal_type_name,'id'=>$post->id])}}" class="text-decoration-none text-reset">
                                        <div class="d-flex articles-block">
                                            @if(isset($post->image))
                                                <img src="{{$post->image}}" class="articles-img">
                                            @else
                                                <img src="{{$ASSET}}/front_site/images/noimage.png" class="articles-img">
                                            @endif
                                            <div class="d-flex flex-column articles-info-inner">
                                                <span class="pl-3 articles-date">{{date("d-F-Y", strtotime($post->publish_date))}}</span>
                                                <p class="pl-3 mb-0 title overflow-text-dots">{{ucwords($post->title)}}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-3 position-relative ads">
                            @foreach($ads as $ad)
                                <a href="{{ $ad->link }}" class="text-decoration-none">
                                   <img src="{{ $ad->image }}" class="w-100 ads-img" alt="">
                                </a>
                                <span class="fa fa-info position-absolute info-icon"></span>
                                <span class="img-info"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
@endsection
