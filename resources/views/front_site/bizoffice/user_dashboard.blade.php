@extends('front_site.master_layout')

@section('content')

    <body class="dashboard main-dashboard">
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->

        <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')

            <div @if(\App\UserCompany::where('user_id',auth()->id())->first()) id="page-content-wrapper" @endif>
                <div class="px-2">
                    <span class="main-heading my-1">DASHBOARD</span>
                    <div class="row cards-container">
                        <?php $userComp = \App\UserCompany::where('user_id',auth()->id())->where('company_id',session()->get('company_id'))->first(); ?>
                        @if($userComp)
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('products.index') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
{{--                                            <div class="cards-img">--}}
{{--                                                <span class="w-100 fa fa-heart-o fa-2x fa-icons"></span>--}}
{{--                                            </div>--}}
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">MyBiz Leads</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <img src="https://bizonair.com/public/assets/front_site/images/mybiz-leads.png" class="dashboard-board-icons">
                                                    </div>
                                                    <span class="value-txt">{{ \App\Product::where('company_id', session()->get('company_id'))->count() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{route('view-lead-favourites')}}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Favourite Leads</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <span class="w-100 fa fa-heart-o fa-2x fa-icons"></span>
                                                    </div>
                                                    <span class="value-txt">{{ getProductFavCount(session()->get('company_id')) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('product-inquiries') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Lead Inquiries</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <img src="https://bizonair.com/public/assets/front_site/images/transparent-bag.png" class="dashboard-board-icons">
                                                    </div>
                                                    <span class="value-txt">{{ countInquiries(auth()->id(),session()->get('company_id')) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('products.index') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Lead Views</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <img src="https://bizonair.com/public/assets/front_site/images/transparent-eye.png" class="dashboard-board-icons">
                                                    </div>
                                                    <span class="value-txt">{{getProductViewsdashboardCount()}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('get-members') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Members</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <span class="w-100 fa fa-users fa-2x fa-icons"></span>
                                                    </div>
                                                    <span class="value-txt">{{getCompanyMembersCount(session()->get('company_id')) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('company-get-meetings') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Meetings</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <span class="w-100 fa fa-handshake-o fa-2x fa-icons"></span>
                                                    </div>
                                                    <span class="value-txt">{{ \App\Meeting::where('company_id',session()->get('company_id'))->count() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('buy-sell.index') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">One-Time Deals</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <img src="https://bizonair.com/public/assets/front_site/images/one-time-deals.png" class="dashboard-board-icons">
                                                    </div>
                                                    <span class="value-txt">{{ \App\BuySell::where('user_id', \Auth::user()->id)->count() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('buy-sell.index') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Favourite Deals</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <span class="w-100 fa fa-heart fa-2x fa-icons"></span>
                                                    </div>
                                                    <span class="value-txt">{{ getBuysellFavCount() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('buysell-inquiries') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Deal Inquiries</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <span class="w-100 fa fa-shopping-bag w-100 fa-2x fa-icons"></span>
                                                    </div>
                                                    <span class="value-txt">{{ countInquiriesBuysell(auth()->id()) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('buy-sell.index') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Deal Views</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <span class="w-100 fa fa-eye fa-2x fa-icons"></span>
                                                    </div>
                                                    <span class="value-txt">{{getBuySellViewsdashboardCount()}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('view-job-management') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Careers</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <img src="https://bizonair.com/public/assets/front_site/images/worker-career.png" class="dashboard-board-icons">
                                                    </div>
                                                    <span class="value-txt">{{ \App\JobManagement::where('user_id', \Auth::user()->id)->count() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                        @else
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('buy-sell.index') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">One-Time Deals</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <img src="https://bizonair.com/public/assets/front_site/images/one-time-deals.png" class="dashboard-board-icons">
                                                    </div>
                                                    <span class="value-txt">{{ \App\BuySell::where('user_id', \Auth::user()->id)->count() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('view-deal-favourites') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Favourite Deals</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <span class="w-100 fa fa-heart fa-2x fa-icons"></span>
                                                    </div>
                                                    <span class="value-txt">{{ getBuysellFavCount() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('buysell-inquiries') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Inquiries</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <span class="w-100 fa fa-shopping-bag fa-2x fa-icons"></span>
                                                    </div>
                                                    <span class="value-txt">{{ countInquiriesBuysell(auth()->id()) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('buy-sell.index') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Deal Views</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <span class="w-100 fa fa-eye fa-2x fa-icons"></span>
                                                    </div>
                                                    <span class="value-txt">{{getBuySellViewsdashboardCount()}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-1 col-xl-3 col-lg-4 col-sm-4 col-3">
                                    <a href="{{ route('view-job-management') }}" class="text-decoration-none text-reset d-block">
                                        <div class="cards">
                                            <div class="cards-content text-center">
                                                <span class="overflow-text-dots-one-line text font-500">Careers</span>
                                                <div class="d-flex column-gap-4">
                                                    <div class="cards-img">
                                                        <span class="w-100 fa fa-heart-o fa-2x fa-icons"></span>
                                                    </div>
                                                    <span class="value-txt">{{ \App\JobManagement::where('user_id', \Auth::user()->id)->count() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            @endif
                    </div>
                    @if($userComp)
                    <div class="position-relative chart-container">
                        <select class="position-absolute mx-auto w-auto form-control" id="filterselector">
                            <option value="asc">Newest To Oldest </option>
                            <option value="desc">Oldest To Newest </option>
                        </select>
                        <canvas id="myChart" width="400" height="200"></canvas>
                        <canvas id="myChartt" width="400" height="200"></canvas>
                    </div>
                    @endif
                    <div class="chart-container">
                        <canvas id="myChartBuysell" width="400" height="200"></canvas>
                        <canvas id="myyChartBuysell" width="400" height="200"></canvas>
                    </div>

                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </main>
    </body>

@endsection

@push('chart')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="text/javascript">
        $('#filterselector').on('change', function() {
            if ( this.value == 'asc')
            {
                $("#myChart").show();
                $("#myChartt").hide();


                $("#myChartBuysell").show();
                $("#myyChartBuysell").hide();
            }
            else if(this.value == 'desc')
            {
                $("#myChartt").show();
                $("#myChart").hide();

                $("#myyChartBuysell").show();
                $("#myChartBuysell").hide();
            }
        }).trigger( "change" );
        /*dashboard*/
        if ($('div').hasClass('chart-container')) {
            var ctx = $('#myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @for($i=0;$i<count(getProductViewsCount()[0]); $i++ )
                            "{{getProductViewsCount()[0][$i]}}",
                        @endfor
                    ],

                    datasets: [{
                        label: 'Views',
                        data: [{{implode(',',getProductViewsCount()[1])}}],
                        backgroundColor: '#344256',

                    },{
                        label: 'Favourite',
                        data: [{{implode(',',getProductViewsCount()[2])}}],
                        backgroundColor: '#A52C3E',
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            barPercentage: 0.4,
                            stacked: true,
                            ticks: {
                                fontSize: 10
                            },
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                fontSize: 10
                            },
                            type: 'linear',
                        }]
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'MyBiz Leads',
                        fontSize: 10
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    }
                }
            });
        }

        if ($('div').hasClass('chart-container')) {
            var ctx = $('#myChartt');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @for($i=0;$i<count(getProductViewsCountt()[0]); $i++ )
                            "{{getProductViewsCountt()[0][$i]}}",
                        @endfor
                    ],

                    datasets: [{
                        label: 'Views',
                        data: [{{implode(',',getProductViewsCountt()[1])}}],
                        backgroundColor: '#344256',

                    },{
                        label: 'Favourite',
                        data: [{{implode(',',getProductViewsCountt()[2])}}],
                        backgroundColor: '#A52C3E',
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            barPercentage: 0.4,
                            stacked: true,
                            ticks: {
                                fontSize: 10
                            },
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                fontSize: 10
                            },
                            type: 'linear',
                        }]
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'MyBiz Leads',
                        fontSize: 10
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    }
                }
            });
        }

        if ($('div').hasClass('chart-container')) {
            var ctx = $('#myChartBuysell');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @for($i=0;$i<count(getBuysellViewsCount()[0]); $i++ )
                            "{{getBuysellViewsCount()[0][$i]}}",
                        @endfor
                    ],

                    datasets: [{
                        label: 'Views',
                        data: [{{implode(',',getBuysellViewsCount()[1])}}],
                        backgroundColor: '#344256',

                    },{
                        label: 'Favourite',
                        data: [{{implode(',',getBuysellViewsCount()[2])}}],
                        backgroundColor: '#A52C3E',
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            barPercentage: 0.4,
                            stacked: true,
                            ticks: {
                                fontSize: 10
                            },
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                fontSize: 10
                            },
                            type: 'linear',
                        }]
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'One-Time Deals',
                        fontSize: 10
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    }
                }
            });
        }

        if ($('div').hasClass('chart-container')) {
            var ctx = $('#myyChartBuysell');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @for($i=0;$i<count(getBuysellViewsCountt()[0]); $i++ )
                            "{{getBuysellViewsCountt()[0][$i]}}",
                        @endfor
                    ],

                    datasets: [{
                        label: 'Views',
                        data: [{{implode(',',getBuysellViewsCountt()[1])}}],
                        backgroundColor: '#344256',

                    },{
                        label: 'Favourite',
                        data: [{{implode(',',getBuysellViewsCountt()[2])}}],
                        backgroundColor: '#A52C3E',
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            barPercentage: 0.4,
                            stacked: true,
                            ticks: {
                                fontSize: 10
                            },
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                fontSize: 10
                            },
                            type: 'linear',
                        }]
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'One-Time Deals',
                        fontSize: 10
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    }
                }
            });
        }
        /*dashboard*/
    </script>
@endpush
