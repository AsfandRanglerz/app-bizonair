@extends('front_site.master_layout')
@section('content')
    <body>
    <style>
        /*calculation formula*/
        .calc-content-container .nav-pills .nav-link {
            border-radius: .25rem;
            color: #FFF;
            background: #A52C3E;
            border-radius: 0;
            transition: .5s background-color;
            font-weight: 500;
        }

        .calc-content-container .nav-pills .nav-link.active {
            background: #12253D;
        }

        .calc-content-container {
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 0%), 0 6px 20px 0 rgb(0 0 0 / 18%);
        }

        .calc-content-container .calc-sidebar {
            background: #A52C3E;
            padding: 0;
        }
        /*calculation formula*/

        @media (min-width: 1200px) {
            /*calculation formula*/
            .calc-content-container .calc-sidebar {
                -ms-flex: 0 0 20%;
                flex: 0 0 20%;
                max-width: 20%;
            }
            .calc-content-container .calc-content {
                -ms-flex: 0 0 75%;
                flex: 0 0 80%;
                max-width: 80%;
            }
            /*calculation formula*/
        }
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
                            href="{{Request::url()}}">Textile Calculations</a></li>
                </ol>
            </nav>
            <div class="container-fluid px-sm-3 px-2">
                <div class="row m-0">
                    <div class="col-lg-12 p-0 calc-content-container">
                        <div class="row m-0">
                            <div class="col-sm-3 h-auto calc-sidebar">
                                <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Spinning</a>
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Weaving</a>
                                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Processing</a>
                                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Garments Manufacturing</a>
                                    <a class="nav-link" id="v-pills-settings1-tab" data-toggle="pill" href="#v-pills-settings1" role="tab" aria-controls="v-pills-settings1" aria-selected="false">Other</a>
                                </div>
                            </div>
                            <div class="p-0 col-sm-9 overflow-auto">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="overflow-auto tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <img src="{{$ASSET}}/front_site/images/Spinning1.jpg" style="width: 100%" />
                                    </div>
                                    <div class="overflow-auto tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <img src="{{$ASSET}}/front_site/images/Weaving1.jpg" style="width: 100%" />
                                    </div>
                                    <div class="overflow-auto tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <p><h1 style="margin-top: 121px; text-align: center">Comming Soon..</h1></p>
                                    </div>
                                    <div class="overflow-auto tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                        <p><h1 style="margin-top: 121px; text-align: center">Comming Soon..</h1></p>
                                    </div>
                                    <div class="overflow-auto tab-pane fade" id="v-pills-settings1" role="tabpanel" aria-labelledby="v-pills-settings1-tab">
                                        <p><h1 style="margin-top: 121px; text-align: center">Comming Soon..</h1></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
@endsection
