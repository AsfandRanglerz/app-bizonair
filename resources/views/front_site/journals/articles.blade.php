@extends('front_site.master_layout')
@section('content')
<body>
<style type="text/css" media="screen">
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
<main id="maincontent" class="view-all-pg">
    <nav aria-label="breadcrumb" class="px-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ url('journal') }}">Journal</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{Request::url()}}">Article</a></li>
        </ol>
    </nav>
    <div class="container-fluid px-2">
        <div class="row m-0 textile-news-inner">
            @foreach($articles as $article)
                <div class="product-box col-md-3 col-6 px-1 my-1 textile-box">
                    <a href="{{route('journal-detail',['type'=>$article->journal_type_name,'id'=>$article->id])}}" class="text-decoration-none">
                        @if(\File::exists('public/assets/front_site/blogs/'.$article->image))
                        <img src="{{$article->image}}">
                        @else
                        <img src="{{ $article->image }}">
                        @endif
                        <div class="mb-0 textile-caption">
                            <span>{{$article->journal_type_name}} | {{date("d-F-Y", strtotime($article->publish_date))}}</span>
                            <p class="overflow-text-dots">{{substr_replace($article->title, "...", 50) }}</p>
                        </div>
                    </a>
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

