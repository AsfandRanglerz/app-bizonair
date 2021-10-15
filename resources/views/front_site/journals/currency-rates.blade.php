@extends('front_site.master_layout')
@section('content')
    <body>
    <style>
        /*currency rates css*/
        .currency-rates-block .gcw_mainFAGlYeDQz {
            max-width: unset!important;
            margin-bottom: 15px!important
        }

        .gcw_mainFAGlYeDQz .gcw_valblockFAGlYeDQz {
            width: 25%;
            font-size: 10px!important;
        }

        .gcw_mainFAGlYeDQz .gcw_ttlFAGlYeDQz {
            font-size: 10px!important;
        }

        .gcw_mainFAGlYeDQz .gcw_flagFAGlYeDQz {
            width: 15px!important;
            max-width: 15px!important;
        }

        .gcw_mainFAGlYeDQz .gcw_headerFAGlYeDQz {
            padding: 3px!important;
            text-align: center!important;
            border: 1px solid #A52C3E!important;
            background-color: #A52C3E!important;
            font-size: 12px!important;
            margin-bottom: 4px!important;
        }

        .gcw_mainFAGlYeDQz .gcw_sourceFAGlYeDQz {
            padding-top: 0!important;
        }

        .gcw_infoFAGlYeDQz {
            display: none;
        }

        .gcw_mainFAGlYeDQz .gcw_inputFAGlYeDQz {
            border: 1px solid #A52C3E!important;
        }

        #gcw_refreshFAGlYeDQz {
            margin-right: 0!important;
            display: block;
            text-align: center;
            font-weight: bold!important;
        }
        /*currency rates css*/
    </style>
    <main id="maincontent" class="blogs-page">
        @include('front_site.common.product-banner')
        <div class="main-container">
            <nav aria-label="breadcrumb" class="px-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{ url('journal') }}">Journal</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{Request::url()}}">Currency Rates</a></li>
                </ol>
            </nav>
            <div class="container-fluid px-2">
                <div class="row mx-0">
                    <div class="col-sm-9 px-0 currency-rates-block">
                        <!--Currency Converter widget by FreeCurrencyRates.com -->
                        <div id='gcw_mainFAGlYeDQz' class='gcw_mainFAGlYeDQz'></div>
                        <script>function reloadFAGlYeDQz(){
                                var sc = document.getElementById('scFAGlYeDQz');if (sc) sc.parentNode.removeChild(sc);sc = document.createElement('script');sc.type = 'text/javascript';sc.charset = 'UTF-8';sc.async = true;sc.id='scFAGlYeDQz';sc.src = 'https://freecurrencyrates.com/en/widget-vertical?iso=USD-EUR-GBP-JPY-CNY-RUB-PKR&df=2&p=FAGlYeDQz&v=fi&source=fcr&width=130&width_title=0&firstrowvalue=1&thm=aaaaaa,ffffff,FF6B7F,DB4865,FFFFFF,4297D7,ffffff,2C4359,000000&title=Currency%20Converter&tzo=-300';var div = document.getElementById('gcw_mainFAGlYeDQz');div.parentNode.insertBefore(sc, div);} reloadFAGlYeDQz();
                        </script>
                        <!--Currency Converter widget by FreeCurrencyRates.com -->
                    </div>
                    <div class="col-sm-3 px-0">
                        <div class="position-relative ads">
                            <img src="{{$ASSET}}/front_site/images/ads/texpo-2021-digital.jpg" class="w-100 ads-img"
                                 alt="">
                            <span class="fa fa-info position-absolute info-icon"></span>
                            <span class="img-info"></span>
                        </div>
                        <div class="position-relative mt-3 ads">
                            <img src="{{$ASSET}}/front_site/images/ads/texpo-2021-happening.jpg" class="w-100 ads-img"
                                 alt="">
                            <span class="fa fa-info position-absolute info-icon"></span>
                            <span class="img-info"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
@endsection
