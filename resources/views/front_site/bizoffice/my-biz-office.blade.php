@extends('front_site.master_layout')

@section('content')

    <body class="dashboard">
    <style type="text/css">
        .cards .fa-icons {
            font-size: 75px;
            color: #a52c3ebf;
        }
    </style>
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->

        <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                @include('front_site.common.dashboard-toggle')
                <div style="padding: 0 30px 30px">
                    <span class="main-heading mt-3 mb-3">MyBiz Office</span>
                    <div class="row cards-container">
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('get-members') }}" class="text-decoration-none text-reset d-block">
                                <div class="cards flex-column align-items-center h-100">
                                    <div class="cards-img">
                                        <span class="fa fa-users w-100 fa-icons"></span>
                                    </div>
                                    <div class="cards-content mt-3">
                                        <span class="font-500">MyBiz Members</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('company-get-meetings') }}"
                               class="text-decoration-none text-reset d-block">
                                <div class="cards flex-column align-items-center h-100">
                                    <div class="cards-img">
                                        <span class="fa fa-handshake-o w-100 fa-icons"></span>
                                    </div>
                                    <div class="cards-content mt-3">
                                        <span class="font-500">MyBiz Meetings</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('company-group-chat') }}" class="text-decoration-none text-reset d-block">
                                <div class="cards flex-column align-items-center h-100">
                                    <div class="cards-img">
                                        <span class="fa fa-comment w-100 fa-icons"></span>
                                    </div>
                                    <div class="cards-content mt-3">
                                        <span class="font-500">MyBiz Chat</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </main>
    </body>

@endsection
