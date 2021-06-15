@extends('front_site.master_layout')

@section('content')
    <body>
    <main id="maincontent" class="suppliers-about-us">
            @include('front_site.common.suppliers-banner')
        <div class="p-2 container-lg">
            <div class="mb-5 about-us-section">
                <h3 class="font-weight-bold heading">{{$about_us->company_name}}</h3>
                <p class="mb-5">
                    {{$about_us->company_introduction}}
                </p>
            </div>
        </div>

    </main>
    </body>
@endsection
