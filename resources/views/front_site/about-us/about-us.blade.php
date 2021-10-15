@extends('front_site.master_layout')

@section('content')
    <body>
    <main id="maincontent" class="page-main">
        <div class="container mt-3 mb-3">
            <div class="row static-content-page">
                @foreach($data as $dat)
                <div class="container-fluid">
                    <p>{!! $dat->description !!}</p>

                </div>
                @endforeach
            </div>
        </div>
    </body>
@endsection
