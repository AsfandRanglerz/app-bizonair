@extends('front_site.master_layout')
@section('content')
    <body>
    <style>
        /*vertical currency rates css*/
        .currency-rates-block .gcw_mainFDsCtQHhM * {
            font-size: 10px!important;
        }

        .currency-rates-block .gcw_flagFDsCtQHhM {
            padding-right: 5px!important;
        }

        .currency-rates-block .gcw_headerFDsCtQHhM {
            border: 1px solid #A52C3E!important;
            background-color: #A52C3E!important;
        }

        .currency-rates-block .gcw_mainFDsCtQHhM {
            max-width: 100%!important;
        }

        .currency-rates-block .gcw_ttlFDsCtQHhM {
            width: 100%!important;
        }

        .currency-rates-block #gcw_refreshFDsCtQHhM, .currency-rates-block .gcw_inputFDsCtQHhM {
            color: #a52c3e!important;
        }
        /*vertical currency rates css*/

        /*horizontal currency rates css*/
        .currency-rates-block {
            overflow-x: auto;
        }

        .currency-rates-block #gcw_mainFJegLMB4I .gcw_headerFJegLMB4I {
            border: 1px solid #A52C3E!important;
            background-color: #A52C3E!important;
        }

        .currency-rates-block .gcw_headerFJegLMB4I a {
            font-weight: 100!important;
            font-size: 12px!important;
        }

        .currency-rates-block .gcw_mainFJegLMB4I * {
            font-size: 10px!important;
        }

        .currency-rates-block #gcw_siteFJegLMB4I {
            text-align: left;
            width: inherit;
            margin: 4px 0;
        }

        .currency-rates-block .gcw_mainFAGlYeDQz {
            max-width: unset!important;
            margin-bottom: 15px!important
        }

        .currency-rates-block .gcw_value-revFJegLMB4I, .currency-rates-block td.gcw_value-dirFJegLMB4I {
            padding: 0px 6px!important;
        }
        /*horizontal currency rates css*/
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
                    <div class="col-sm-9 px-0 mb-sm-0 mb-2 currency-rates-block">
                        <!--Vertical Currency Converter widget by FreeCurrencyRates.com -->
                        <div id='gcw_mainFDsCtQHhM' class='gcw_mainFDsCtQHhM'></div>
                        <script>
                            function reloadFDsCtQHhM() {
                                var sc = document.getElementById('scFDsCtQHhM');
                                if (sc) sc.parentNode.removeChild(sc);
                                sc = document.createElement('script');
                                sc.type = 'text/javascript';sc.charset = 'UTF-8';
                                sc.async = true;sc.id='scFDsCtQHhM';
                                sc.src = 'https://freecurrencyrates.com/en/widget-vertical?iso=USD-EUR-GBP-JPY-CNY-XUL-BCH&df=1&p=FDsCtQHhM&v=fits&source=fcr&width=245&width_title=0&firstrowvalue=1&thm=A6C9E2,FCFDFD,4297D7,5C9CCC,FFFFFF,C5DBEC,FCFDFD,2E6E9E,000000&title=Currency%20Rates&tzo=480';
                                var div = document.getElementById('gcw_mainFDsCtQHhM');
                                div.parentNode.insertBefore(sc, div);
                            }
                            reloadFDsCtQHhM();
                        </script>
                        <!-- put custom styles here: .gcw_mainFDsCtQHhM{}, .gcw_headerFDsCtQHhM{}, .gcw_ratesFDsCtQHhM{}, .gcw_sourceFDsCtQHhM{} -->
                        <!--End of Vertical Currency Converter widget by FreeCurrencyRates.com -->

                        <!--Horizontal Currency Converter widget by FreeCurrencyRates.com -->
<!--                        <div id='gcw_mainFJegLMB4I' class='gcw_mainFJegLMB4I'></div>
                        <script>
                            function reloadFJegLMB4I() {
                                var sc = document.getElementById('scFJegLMB4I');
                                if (sc) sc.parentNode.removeChild(sc);
                                sc = document.createElement('script');
                                sc.type = 'text/javascript';
                                sc.charset = 'UTF-8';
                                sc.async = true;
                                sc.id = 'scFJegLMB4I';
                                sc.src = 'https://freecurrencyrates.com/en/widget-table?iso=USD-EUR-GBP-RUB&df=1&p=FJegLMB4I&v=fi&source=fcr&width=900&width_title=0&firstrowvalue=1&thm=A6C9E2,FCFDFD,4297D7,5C9CCC,FFFFFF,C5DBEC,FCFDFD,2E6E9E,000000&title=Currency%20Rates&tzo=-300';
                                var div = document.getElementById('gcw_mainFJegLMB4I');
                                div.parentNode.insertBefore(sc, div);
                            }
                            reloadFJegLMB4I();
                        </script>-->
                        <!-- put custom styles here: .gcw_mainFJegLMB4I{}, .gcw_headerFJegLMB4I{}, .gcw_ratesFJegLMB4I{}, .gcw_sourceFJegLMB4I{} -->
                        <!--End of Horizontal Currency Converter widget by FreeCurrencyRates.com -->
                    </div>
                    <div class="col-sm-3 px-0">
                        <div class="position-relative ads">
                            @foreach($ads as $ad)
                            <a href="{{ $ad->link }}" class="text-decoration-none" target="_blank">
                                <img src="{{ $ad->image }}" class="w-100 ads-img" alt="">
                            </a>
                            <span class="fa fa-info position-absolute info-icon"></span>
                            <span class="img-info"></span>
                            @endforeach
                        </div>
                        <div class="position-relative mt-3 ads">
                            @foreach($ads1 as $ad)
                           <a href="{{ $ad->link }}" class="text-decoration-none" target="_blank">
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
@push('js')
    <script src="{{$ASSET}}/front_site/plugins/DataTables/datatables.js"></script>
@endpush
