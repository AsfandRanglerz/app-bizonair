@extends('front_site.master_layout')

@section('content')
    <body class="faqs">
    <main id="maincontent" class="page-main faq-container">
            @include('front_site.common.product-banner')
        <div class="main-container">
            @foreach($data as $dat)
            <div class="container mt-5 mb-5">
                <p>{!! $dat->description !!}</p>
            </div>
            @endforeach
        </div>
    </main>
    </body>
@endsection
