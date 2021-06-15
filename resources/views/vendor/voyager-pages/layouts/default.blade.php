@include('voyager-pages::partials.meta')

<main class="main-content">
    <div class="container mt-3 mb-3">
        <div class="row privacy-policy">
            <div class="container-fluid">
                <h4 class="mb-3 main-heading">@yield('page_title')</h4>
                @if (View::hasSection('page_subtitle'))
                    <p>@yield('page_subtitle')</p>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
</main>

@include('voyager-pages::partials.footer')
