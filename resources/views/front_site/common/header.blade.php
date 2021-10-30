<!DOCTYPE html>
<html lang="en">
<head>
<!-- <title>{{isset($title)? ($title? $title.' - Bizonair' : 'Bizonair') : 'Bizonair'}}</title> -->
    <?php if(\Auth::user()){ ?><title>{{setting('site.title')}} | Pakistan's #1 Textile Portal</title> <?php } else { ?>
    <title>{{setting('site.title')}} | Pakistan's #1 Textile Portal</title> <?php }?>
    <meta charset="utf-8">
    <meta name="token" content="123456789">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/png" href="{{$ASSET}}/front_site/images/favicon.png">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/css/slick.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/css/slick-theme.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/css/fonts5/fonts/fontawesome-free-5.3.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/css/bootstrap-4.5.0.min.css">
    <link rel="stylesheet"
          href="{{$ASSET}}/front_site/css/bootstrap-slider.min.css">
    <link type="text/css" rel="stylesheet" href="{{$ASSET}}/front_site/plugins/light-slider/css/lightslider.css"/>
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/build/css/intlTelInput.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/multiple-select/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/multi-selectable-tree/jquery.tree-multiselect.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/select2/css/select-picker.min.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/DataTables/datatables.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/light-gallery/css/lightgallery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"/>
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/password-preview/css/font-awesome-eyes.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/multi-image-selector/styles.imageuploader.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
          rel="stylesheet">
    {{--    <link rel="stylesheet" type="text/css" href="{{$ASSET}}/front_site/css/font-raleway.css">--}}
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{$ASSET}}/front_site/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{$ASSET}}/front_site/css/toastr.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
    <meta name="robots" content="noindex"/>
    @yield('metadata')
    @stack('css')
</head>
<header class="header d-lg-block d-none">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <?php $siteLogo = 'https://app.bizonair.com/public/storage/settings/November2020/E0uP1eE694Dov6zjO3A2.png';?>
            <a class="navbar-brand" href="{{route('home')}}"><img src="{{$siteLogo}}"></a>
            <div class="d-flex">
                <img src="{{$ASSET}}/front_site/images/android-icon.png" class="mr-2 d-lg-none android-icon" data-toggle="tooltip" data-placement="bottom" title="Bizonair Mobile App - Launching Soon">
                <div class="d-lg-none d-block position-static nav-item search-dropdown dropdown category-nav-Search mobile-search">
                    <button class="mr-2 red-btn nav-search-btn z-index-1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SEARCH<span class="pl-2 fa fa-search" aria-hidden="true"></span></button>
                    <div class="w-100 m-0 p-0 dropdown-menu animated-dropdown slideIn" aria-labelledby="navbarDropdown">
                        <form class="form-inline" action="{{route('search_product')}}">
                            <div class="w-100 px-2" style="background: #12253D">
                                <select class="w-100 px-0 py-1 rounded-0 select-cat" name="category" style="background: #12253D">
                                    <option value="" selected disabled>Select Category</option>
                                    <option value="Regular Supplier">Regular Supplier</option>
                                    <option value="Regular Buyer">Regular Buyer</option>
                                    <option value="One-Time Supplier">One-Time Supplier</option>
                                    <option value="One-Time Buyer">One-Time Buyer</option>
                                    <option value="Regular Services">Service Providers</option>
                                    <option value="One-Time Services">Service Seekers</option>
                                    <option value="Reference Number">Reference Number</option>
                                    <option value="Keywords">Keywords</option>
                                    <option value="Companies">Companies</option>
                                    <option value="articles">Articles</option>
                                    <option value="news">News</option>
                                    <option value="events">Events</option>
                                </select>
                            </div>
                            <div class="w-100 position-relative d-flex align-items-center" style="border-top: 1px solid #FFF">
                                <input class="w-100 pt-4 pb-4 mr-0 form-control" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn search-btn" type="submit"><span class="fa fa-search" aria-hidden="true"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <button class="navbar-toggler"  data-toggle="collapse" data-target="#bizonairNav" aria-controls="bizonairNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizonairNav">
                <ul class="navbar-nav">
                    <div class="deals-btn">
                        <button id="bizDeals" class="biz-btn-tooltip" data-placement="bottom" title="<p>Post your One-time Buying, Selling & Service Deals for Free. Posted Ad will Expire in max 30 days. </p><p class='mb-1'>For Regular Business Leads visit MyBiz Office or Learn More From FAQs.</p>" data-toggle="tooltip">
                            <span @if(Auth::check())  onclick="location.href='{{ route('buy-sell.index') }}'"
                                  @else data-toggle="modal" data-target="#login-form" @endif><img src="{{$ASSET}}/front_site/images/bizDeals.png">BUY / SELL</span>
                        </button>
                        <button id="bizOffice" class="biz-btn-tooltip" data-placement="bottom" title='<p>Post your Regular Buying, Selling & Service Business Leads From "MyBiz Leads" for Free. Posted Leads will always remain Accessible on your Microsite. Post your Lead now or Learn More From FAQs.</p><p class="mb-1">Create your own Free Virtual Office/Offices. Add Team Members, Assign Roles, Post Regular Business Leads, Chat with Teammates, Schedule Meetings, Business Dashboard & much More for Free.</p>' data-toggle="tooltip">
                            <span @if(Auth::check()) onclick="location.href='{{ route('my-biz-office') }}'" @else data-toggle="modal" data-target="#login-form" @endif>
                                <img src="{{$ASSET}}/front_site/images/bizOffice.png">MYBIZ OFFICE</span>
                        </button>
                    </div>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="{{ url('business-products/fibers-and-materials') }}" id="navbarDropdownMenuLink" data-hover="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            Textile Business<span class="fa fa-angle-down" aria-hidden="true"></span>
                        </a>
                        <div class="dropdown-menu animated-dropdown slideIn business-services-dropdown" aria-labelledby="navbarDropdownMenuLink">
                            <div class="row w-100 m-0 dropdown-container">
                                <div class="col-sm-12 p-0">
                                    <div class="row w-100">
                                        @foreach(getCategories('Business') as  $cat)
                                            <div class="col-sm-2">
                                                <ul class="links-container">
                                                    <li class="heading"><a href="{{ route('business-products',$cat->slug) }}" class="font-500 menu-link">{{ $cat->name }}</a></li>
                                                    @foreach (getSubCategories($cat->id) as $subcat)
                                                        <li><a href="{{ route('suppliers-subcategory-products',[$cat->slug,$subcat->slug]) }}" target="_blank" class="menu-link">{{$subcat->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="{{ url('services/hr-and-admin') }}" id="navbarDropdownMenuLink" data-hover="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            Textile Services<span class="fa fa-angle-down" aria-hidden="true"></span>
                        </a>
                        <div class="dropdown-menu animated-dropdown slideIn business-services-dropdown" aria-labelledby="navbarDropdownMenuLink">
                            <div class="row w-100 m-0 dropdown-container">
                                <div class="col-sm-12 p-0">
                                    <div class="row w-100">
                                        @foreach(getCategories('Services') as  $cat)
                                            <div class="col-sm-2">
                                                <ul class="links-container">
                                                    <li class="heading"><a href="{{ route('service-products',$cat->slug) }}" class="font-500 menu-link">{{ $cat->name }}</a></li>
                                                    @foreach (getSubCategories($cat->id) as $subcat)
                                                        <li><a href="#" target="_blank" class="menu-link">{{$subcat->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="{{ url('jobs-portal') }}" id="navbarDropdownMenuLink" data-hover="dropdown"
                           aria-haspopup="true" aria-expanded="false">Careers<span class="fa fa-angle-down"
                                                                                   aria-hidden="true"></span>
                        </a>
                        <div class="mb-3 dropdown-menu animated-dropdown slideIn" aria-labelledby="navbarDropdownMenuLink">
                            <div class="row w-100 m-0 dropdown-container">
                                <ul class="socialLinks">
                                    <li><a href="{{ route('jobs-portal') }}" target="_blank" class="menu-link">Post A Job
                                        </a></li>
                                    <li><a href="#" target="_blank" class="menu-link">Post Your CV
                                        </a></li>
                                    <li><a href="#" target="_blank" class="menu-link">Explore All Jobs
                                        </a></li>

                                </ul>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="{{ url('journal') }}" id="navbarDropdownMenuLink" data-hover="dropdown"
                           aria-haspopup="true" aria-expanded="false">JOURNAL<span class="fa fa-angle-down"
                                                                                   aria-hidden="true"></span>
                        </a>
                        <div class="mb-3 dropdown-menu animated-dropdown slideIn" aria-labelledby="navbarDropdownMenuLink">
                            <div class="row w-100 m-0 dropdown-container">
                                <ul class="socialLinks">
                                    <li><a href="{{route('news')}}" target="_blank" class="menu-link">News</a></li>
                                    <li><a href="{{route('blogs')}}" target="_blank" class="menu-link">Blogs</a></li>
                                    <li><a href="{{route('articles')}}" target="_blank" class="menu-link">Research / Articles</a></li>
                                    <li><a href="{{route('events')}}" target="_blank" class="menu-link">Upcoming Events</a></li>
                                    <li><a href="{{route('projects')}}" target="_blank" class="menu-link">Student Projects</a></li>
                                    <li><a href="{{route('calculation-formula')}}" target="_blank" class="menu-link">Textile Calculations</a></li>
                                    <li><a href="{{ route('currency-rates') }}" target="_blank" class="menu-link">Currency Rates</a></li>
                                    <li><a href="{{route('cotton-rates')}}" target="_blank" class="menu-link">Cotton Rates</a></li>
                                    <li><a href="{{route('bizonair-404')}}" target="_blank" class="menu-link">Yarn Rates</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item search-dropdown dropdown category-nav-Search desktop-search">
                        <button class="red-btn nav-search-btn z-index-1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SEARCH<span class="pl-2 fa fa-search" aria-hidden="true"></span></button>
                        <div class="p-0 dropdown-menu" aria-labelledby="navbarDropdown">
                            <form class="form-inline" action="{{route('search_product')}}">
                                <div class="w-100 px-2" style="background: #12253D">
                                    <select class="w-100 px-0 py-1 rounded-0 select-cat" id="searchFilt" name="category" style="background: #12253D">
                                        <option value="" selected disabled>Select Category</option>
                                        <option value="Regular Supplier">Regular Supplier</option>
                                        <option value="Regular Buyer">Regular Buyer</option>
                                        <option value="One-Time Supplier">One-Time Supplier</option>
                                        <option value="One-Time Buyer">One-Time Buyer</option>
                                        <option value="Regular Services">Service Providers</option>
                                        <option value="One-Time Services">Service Seekers</option>
                                        <option value="Reference Number">Reference Number</option>
                                        <option value="Keywords">Keywords</option>
                                        <option value="Companies">Companies</option>
                                        <option value="articles">Articles</option>
                                        <option value="news">News</option>
                                        <option value="events">Events</option>
                                    </select>
                                </div>
                                <div class="w-100 position-relative d-flex align-items-center" style="border-top: 1px solid #FFF">
                                    <input class="w-100 pt-4 pb-4 mr-0 form-control" type="search" placeholder="Search" aria-label="Search" name="keywords">
                                    <button class="btn search-btn" type="submit"><span class="fa fa-search" aria-hidden="true"></span></button>
                                </div>
                            </form>
                        </div>
                    </li>
                    <img src="{{$ASSET}}/front_site/images/android-icon.png" class="d-lg-inline-block d-none android-icon" data-toggle="tooltip" data-placement="bottom" title="Bizonair Mobile App - Launching Soon">
                    @if(Auth::check() && Auth::user()->role_id == 2  )
                        <li class="nav-item dropdown profile-icon-main">
                            <a class="p-0 nav-link" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="true">
                                <img src="{{ get_user_image(Auth::user()) }}" width="45" height="45" alt="logo" class="rounded-circle header-profile-pic">
                            </a>
                            <div class="dropdown-menu animated-dropdown slideIn profile-icon-dropdown"
                                 aria-labelledby="navbarDropdownMenuLink">
                                <div class="row w-100 m-0 dropdown-container">
                                    <ul class="socialLinks">
                                        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                        <li><a href="{{ url('my-account-detail') }}">Edit Profile</a></li>
                                        <li><a href="#change-password-form" data-toggle="modal">Change Password</a></li>
                                        <li><a href="{{url('logout')}}">Log Out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="#login-form" class="nav-link login trigger-btn" data-toggle="modal">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-header for tablets and mobiles view->
<header class="d-lg-none px-2 py-2 header tab-mob-header">
    <div id="sidenav-overlay"></div>
    <div class="biz-nav">
        <div class="p-2 d-flex justify-content-between login-cross-btns">
            @if(\Auth::user())
                <div class="d-flex">
                    <div class="d-flex justify-content-center align-items-center avatar-wrapper">
                        <div class="position-absolute spinner-border text-danger loader-spinner d-none" role="status" style="z-index: 1">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <img class="profile-pic" id="uploaded_image" src="{{ get_user_image(Auth::user()) }}"/>
                        <div class="upload-button">
                            <span class="fa fa-plus"></span>
                        </div>
                        <input class="file-upload" name="avatar" id="avatar" type="file" accept="image/*"/>
                    </div>
                    <div class="ml-3">
                        <p class="mb-0 biz-user">{{ auth()->user()->name }}</p>
                        <p class="mb-0 biz-country">{{ auth()->user()->country }}</p>
                        <div class="progress mt-2">
                            <div class="progress-bar" role="progressbar"
                                 aria-valuenow="{{ $profile_percentage = get_user_profile_percentage(auth()->id()) }}"
                                 aria-valuemin="0" aria-valuemax="100">{{ $profile_percentage }}%</div>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{route('log-in-pre')}}" class="biz-login"><span class="mr-2 fa fa-sign-in"></span>Login</a>
            @endif
            <span class="close-nav fa fa-times"></span>
        </div>
        @if(\Auth::user())
        <?php $company = \App\UserCompany::where('user_id',\Auth::id())->first();?>
        @if(!$company)
            <aside class="side-nav w-100 biz-nav-content">

                <ul class="mb-0 categories">
                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="My Dashboard"><img class="dashboard-sidebar-img" src="https://cdn2.iconfinder.com/data/icons/thin-charts-analytics/24/thin-1086_kpi_dashboard_monitor-512.png" height="20"><a href="{{route('user-dashboard')}}" class="sidebar-links">Dashboard</a>
                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="My Account"><img class="mr-2 dashboard-sidebar-img" src="https://image.flaticon.com/icons/png/128/2321/2321232.png" height="20"><a href="{{ route('my-account-detail') }}" class="sidebar-links">My
                            Account</a></li>
                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="Business Profile"><img class="mr-2 dashboard-sidebar-img" src="https://cdn.iconscout.com/icon/premium/png-256-thumb/work-desk-1-982669.png" height="20"><a href="{{route('company-profile')}}" class="sidebar-links">Create New Biz Office</a><span class="badge new-badge">New</span></li>
                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="One-Time Deals"><img class="mr-2 dashboard-sidebar-img" src="https://static.thenounproject.com/png/1353582-200.png" height="20"><a href="javascript:;">One-Time Deals</a><span class="biz-badge blue-badge">{{ \App\BuySell::where('user_id', \Auth::user()->id)->count() }}</span>
                        <ul class="side-nav-dropdown">
                            <li data-toggle="tooltip" data-placement="bottom" title="Add New One-Time Deal">
                                <a href="{{route('buy-sell.create')}}" class="sidebar-links">Add A New Deal
                                </a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="All One-Time Deals">
                                <a href="{{route('buy-sell.index')}}" class="sidebar-links">View All Deals
                                </a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Archived Deals Listing">
                                <a href="{{url('/buy-sells?case=archive')}}" class="sidebar-links">Archived Deals
                                </a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Your Favourite Deals">
                                <a href="{{route('view-deal-favourites')}}" class="sidebar-links">Your Favourite Deals <span class="biz-badge blue-badge">{{ getBuysellFavCount() }}</span></a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Deal Inquiries">
                                <a href="{{route('buysell-inquiries')}}" class="sidebar-links">Deal Inquiries <span class="biz-badge" id="dealinq"></span></a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Deal Inquiries">
                                <a href="{{route('get-one-time-fav')}}" class="sidebar-links">Deal Favorites <span class="biz-badge" id="fdealinq"></span></a></li>
                        </ul>
                    </li>
                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Careers"><img class="mr-2 dashboard-sidebar-img" src="https://www.pngrepo.com/png/128160/512/worker-career.png" height="20"><a href="javascript:;">Careers</a>
                        <ul class="side-nav-dropdown">
                            <li data-toggle="tooltip" data-placement="bottom"
                                title="Add New Job"><a href="{{route('view-form-job-management')}}"
                                                       class="sidebar-links">Add New Job</a>
                            </li>
                            <li data-toggle="tooltip" data-placement="bottom"
                                title="View All Jobs"><a href="{{route('view-job-management')}}"
                                                         class="sidebar-links">All Jobs</a>
                            </li>
                            <li data-toggle="tooltip" data-placement="bottom"
                                title="Post Your CV"><a href="{{route('post-ur-cv')}}"
                                                        class="sidebar-links">Post Your CV</a>
                            </li>
                            <li data-toggle="tooltip" data-placement="bottom"
                                title="View All CVs"><a href="{{route('view-all-cvs')}}"
                                                        class="sidebar-links">All CVs</a>
                            </li>
                        </ul>
                    </li>
                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Journal"><img class="mr-2 dashboard-sidebar-img" src="https://www.biotechconnection-sg.org/wp-content/uploads/2018/06/seo-and-web-glyph-3-04-512.png" height="20"><a href="javascript:;">Journal</a>
                        <ul class="side-nav-dropdown">
                            <li  data-toggle="tooltip" data-placement="bottom" title="Add Journal">
                                <a href="{{  route('view-form-blog') }}" class="sidebar-links">Add Journal</a></li>
                            <li  data-toggle="tooltip" data-placement="bottom" title="View All Journal">
                                <a href="{{route('view-blogs')}}" class="sidebar-links">View All Journal</a></li>

                        </ul>
                    </li>
                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="Contact us"><img class="mr-2 dashboard-sidebar-img" src="https://cdn2.iconfinder.com/data/icons/basics-vol-2/354/out_exit_comeout_goout_getout_dropout_moveout-512.png"><a href="{{url('logout')}}" class="sidebar-links"> Sign Out</a>
                    </li>
                    <li class="invisible"></li>
                    <li class="invisible"></li>
                </ul>

            </aside>
        @else
            <aside class="side-nav w-100 biz-nav-content">
                <ul class="mb-0 categories">
                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="My Dashboard"><img class="mr-2 dashboard-sidebar-img" src="https://cdn2.iconfinder.com/data/icons/thin-charts-analytics/24/thin-1086_kpi_dashboard_monitor-512.png" height="20"><a href="{{route('user-dashboard')}}" class="sidebar-links">Dashboard</a>
                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="My Account"><img class="mr-2 dashboard-sidebar-img" src="https://image.flaticon.com/icons/png/128/2321/2321232.png" height="20"><a href="{{ route('my-account-detail') }}" class="sidebar-links">My
                            Account</a></li>

                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Business Profile"><img class="mr-2 dashboard-sidebar-img" src="https://cdn.iconscout.com/icon/premium/png-256-thumb/business-profile-3-919606.png" height="20"><a href="javascript:;">Business Profile</a>
                        <ul class="side-nav-dropdown">

                            <li  data-toggle="tooltip" data-placement="bottom" title="View Your Business Profile">

                                <a href="{{ route('my-company-profile',[session()->get('company_id')]) }}" class="sidebar-links">View Your Business Profile</a></li>
                            <li  data-toggle="tooltip" data-placement="bottom" title="Create & Manage your company page">
                                <a href="{{route('suppliers-about-us')}}" class="sidebar-links">View Your Company Page</a></li>

                        </ul>
                    </li>
                    </li>

                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Business Profile"><img class="mr-2 dashboard-sidebar-img" src="https://cdn.iconscout.com/icon/premium/png-256-thumb/work-desk-1-982669.png" height="20"><a href="javascript:;">MyBiz
                            Office</a><span class="biz-badge blue-badge">{{ \App\UserCompany::where('user_id', \Auth::user()->id)->count() }}</span>
                        <ul class="side-nav-dropdown">
                            <li data-toggle="tooltip" data-placement="bottom" title="Biz Offices"><a
                                    href="{{route('my-bizoffices')}}" class="sidebar-links">Biz Offices</a></li>
                            <li  data-toggle="tooltip" data-placement="bottom"
                                 title="Create & Manage your Virtual Office">
                                <a href="{{route('company-profile')}}">Add New Biz Office </a></li>
                            <?php $usercompany = \App\UserCompany::where('user_id',\Auth::id())->where('company_id',session()->get('company_id'))->where('is_admin',1)->first();?>
                            @if($usercompany)
                                <li data-toggle="tooltip" data-placement="bottom"
                                    title="Add New Member To This Bizoffice"><a href="{{route('create-member')}}"
                                                                                class="sidebar-links">Add New Member</a>
                                </li>
                            @endif
                            <li data-toggle="tooltip" data-placement="bottom" title="View All Members"><a
                                    href="{{route('get-members')}}" class="sidebar-links">All Members <span class="biz-badge blue-badge">{{getCompanyMembersCount(session()->get('company_id')) }}</span></a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="View All Meetings"><a
                                    href="{{route('company-get-meetings')}}" class="sidebar-links">All Meetings <span class="biz-badge" id="meeti"></span></a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Communicate With The Members"><a href="{{route('company-group-chat')}}" class="sidebar-links">Chat <span class="biz-badge" id="chati"></span></a></li>
                        </ul>
                    </li>

                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Business Leads"><img class="mr-2 dashboard-sidebar-img" src="https://cdn4.iconfinder.com/data/icons/reputation-management-2/66/95-512.png" height="20"><a href="javascript:;">MyBiz
                            Leads</a><span class="biz-badge blue-badge">{{ \App\Product::where('company_id',session()->get('company_id'))->count() }}</span>
                        <ul class="side-nav-dropdown">
                            <li data-toggle="tooltip" data-placement="bottom" title="Add new product">
                                <a href="{{ route('products.create') }}" class="sidebar-links">Add A New Lead</a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Product Listing">
                                <a href="{{ route('products.index') }}" class="sidebar-links">All Active Leads</a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Archived Leads Listing">
                                <a href="{{url('/products?case=archive')}}" class="sidebar-links">Archived Leads</a></li>

                            <li data-toggle="tooltip" data-placement="bottom" title="Your Favourite Leads">
                                <a href="{{route('view-lead-favourites')}}" class="sidebar-links">Your Favourite Leads <span class="biz-badge blue-badge">{{ getProductFavCount(session()->get('company_id')) }}</span></a></li>
                            <?php $company = \App\UserCompany::where('user_id',\Auth::id())->where('company_id',session()->get('company_id'))->first();?>
                            @if($company)
                                <li data-toggle="tooltip" data-placement="bottom" title="Lead Inquiries">
                                    <a href="{{route('product-inquiries')}}" class="sidebar-links">Lead Inquiries <span class="biz-badge" id="leadinq">0</span></a></li>
                            @endif
                            <li data-toggle="tooltip" data-placement="bottom" title="Deal Inquiries">
                                <a href="{{route('get-lead-fav')}}" class="sidebar-links">Lead Favorites <span class="biz-badge" id="fleadinq">0</span></a></li>
                        </ul>
                    </li>

                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="One-Time Deals"><img class="mr-2 dashboard-sidebar-img" src="https://static.thenounproject.com/png/1353582-200.png" height="20"><a href="javascript:;">One-Time Deals</a><span class="biz-badge blue-badge">{{ \App\BuySell::where('user_id', \Auth::user()->id)->count() }}</span>
                        <ul class="side-nav-dropdown">
                            <li data-toggle="tooltip" data-placement="bottom" title="Add New One-Time Deal">
                                <a href="{{route('buy-sell.create')}}" class="sidebar-links">Add A New Deal
                                </a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="All One-Time Deals">
                                <a href="{{route('buy-sell.index')}}" class="sidebar-links">View All Deals
                                </a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Archived Deals Listing">
                                <a href="{{url('/buy-sells?case=archive')}}" class="sidebar-links">Archived Deals
                                </a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Your Favourite Deals">
                                <a href="{{route('view-deal-favourites')}}" class="sidebar-links">Your Favourite Deals <span class="biz-badge blue-badge">{{ getBuysellFavCount() }}</span></a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Deal Inquiries">
                                <a href="{{route('buysell-inquiries')}}" class="sidebar-links">Deal Inquiries <span class="biz-badge" id="dealinq"></span></a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Deal Inquiries">
                                <a href="{{route('get-one-time-fav')}}" class="sidebar-links">Deal Favorites <span class="biz-badge" id="fdealinq"></span></a></li>
                        </ul>
                    </li>

                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Careers"><img class="mr-2 dashboard-sidebar-img" src="https://www.pngrepo.com/png/128160/512/worker-career.png" height="20"><a href="javascript:;">Careers</a><span class="biz-badge blue-badge">{{ \App\JobManagement::where('user_id', \Auth::user()->id)->count() }}</span>
                        <ul class="side-nav-dropdown">
                            <li data-toggle="tooltip" data-placement="bottom"
                                title="Add New Job"><a href="{{route('view-form-job-management')}}"
                                                       class="sidebar-links">Add New Job</a>
                            </li>
                            <li data-toggle="tooltip" data-placement="bottom"
                                title="View All Jobs"><a href="{{route('view-job-management')}}"
                                                         class="sidebar-links">All Jobs</a>
                            </li>
                            <li data-toggle="tooltip" data-placement="bottom"
                                title="Post Your CV"><a href="{{route('post-ur-cv')}}"
                                                        class="sidebar-links">Post Your CV</a>
                            </li>
                            <li data-toggle="tooltip" data-placement="bottom"
                                title="View All CVs"><a href="{{route('view-all-cvs')}}"
                                                        class="sidebar-links">All CVs</a>
                            </li>
                        </ul>
                    </li>

                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Journal"><img class="mr-2 dashboard-sidebar-img" src="https://www.biotechconnection-sg.org/wp-content/uploads/2018/06/seo-and-web-glyph-3-04-512.png" height="20"><a href="javascript:;">Journal</a><span class="biz-badge blue-badge">{{ \App\Journal::where('user_name', \Auth::user()->name)->count() }}</span>
                        <ul class="side-nav-dropdown">
                            <li  data-toggle="tooltip" data-placement="bottom" title="Add Journal">
                                <a href="{{  route('view-form-blog') }}" class="sidebar-links">Add Journal</a></li>
                            <li  data-toggle="tooltip" data-placement="bottom" title="View All Journal">
                                <a href="{{route('view-blogs')}}" class="sidebar-links">View All Journal</a></li>

                        </ul>
                    </li>
                    <?php $user_company = \App\UserCompany::where('company_id',session()->get('company_id'))->where('user_id',\Auth::id())->first();?>
                    @if($user_company)
                        @if($user_company->is_owner != 1)
                            @if($user_company->is_admin == 1 || $user_company->is_member == 1)
                                <li class="position-relative  leave-btn" data-toggle="tooltip" data-placement="bottom" title="leave office" user_id="{{$user_company->user_id}}" company_id="{{$user_company->company_id}}">
                                    <img class="mr-2 dashboard-sidebar-img" src="https://cdn2.iconfinder.com/data/icons/basics-vol-2/354/out_exit_comeout_goout_getout_dropout_moveout-512.png"><a href="javascript:;" class="sidebar-links">leave office</a></li>
                            @endif
                        @endif
                    @endif
                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="Contact us"><img class="mr-2 dashboard-sidebar-img" src="https://cdn1.iconfinder.com/data/icons/communication-set-1-1/100/Untitled-1-18-512.png" height="20"><a href="{{route('contact-us')}}" class="sidebar-links"> Contact us</a>
                    </li>
                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="Contact us"><img class="mr-2 dashboard-sidebar-img" src="https://cdn2.iconfinder.com/data/icons/basics-vol-2/354/out_exit_comeout_goout_getout_dropout_moveout-512.png"><a href="{{url('logout')}}" class="sidebar-links"> Sign Out</a>
                    </li>
                    <li class="invisible"></li>
                    <li class="invisible"></li>
                </ul>
            </aside>
        @endif
        @else
            <aside class="side-nav w-100 biz-nav-content">
                <ul class="mb-0 categories">
                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="Contact us"><img class="mr-2 dashboard-sidebar-img" src="https://cdn1.iconfinder.com/data/icons/communication-set-1-1/100/Untitled-1-18-512.png" height="20"><a href="{{route('contact-us')}}" class="sidebar-links"> Contact us</a>
                    </li>
                    <li class="invisible"></li>
                    <li class="invisible"></li>
                </ul>
            </aside>
        @endif

    </div>
    <div class="w-100 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <span class="open-nav">&#9776;</span>
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{$siteLogo}}" class="ml-2 navbar-logo"/>
            </a>
        </div>
        <div class="d-flex align-items-center">
            @if(auth()->check())
                <div class="mr-3 d-flex align-items-center header-profile-info">
                    <img src="{{ get_user_image(Auth::user()) }}" width="45" height="45" alt="logo" class="rounded-circle header-profile-pic">
                    <div class="ml-2">
                        <p class="mb-0 text-white biz-user overflow-text-dots-one-line">{{auth()->user()->name}}</p>
                    </div>
                </div>
            @endif

             <a class="nav-link p-0" href="#" id="navbarDropdownMenuLink" data-hover="dropdown"
                aria-haspopup="true" aria-expanded="false">
            <span class="position-relative fa fa-bell notification-bell-icon">
               @if(auth()->check())  <span class="biz-badge" id="notify"></span> @endif
            </span>
             </a>
             <div class="overflow-auto mb-3 p-2 dropdown-menu animated-dropdown slideIn notifications-scroll" aria-labelledby="navbarDropdownMenuLink">
                 <div class="row w-100 m-0 dropdown-container">
                     <ul id="isdiplay">

                     </ul>
                 </div>
             </div>

        </div>
    </div>
    @include('front_site.common.search-bar')
</header>
<!-header for tablets and mobiles view->

<div id="loader">
    <span id="loaderGif"></span>
</div>
<!-- login-form -->
<div id="login-form" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
{{--            <form action="{{route('user-do-login')}}" method="post" id="loginForm">--}}
{{--                @csrf--}}
{{--                <div class="modal-header">--}}
{{--                    <span class="modal-title">Login</span>--}}
{{--                    <a class="close red-btn" data-dismiss="modal" aria-hidden="true">&times;</a>--}}
{{--                </div>--}}
{{--                <div class="modal-body pt-3">--}}
{{--                    <div class="empty-div mb-2"></div>--}}
{{--                    <div class="alert alert-success mb-2 text-center" id='alert-success-login' style="display: none"--}}
{{--                         role="alert">--}}
{{--                    </div>--}}
{{--                    <div class="alert alert-danger mb-2 text-center" id='alert-error-login' style="display: none"--}}
{{--                         role="alert">--}}
{{--                    </div>--}}
{{--                    <img src="{{$ASSET}}/front_site/images/favicon.png" class="mb-5">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="email" class="form-control" name="email_login" id="emailId" placeholder="E-mail">--}}
{{--                        <small class="text-white" id="email_login_error"></small>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="password" name="login_password" class="form-control preview-password d-inline-block" placeholder="Password">--}}
{{--                        <small class="text-white" id="login_password_error"></small>--}}
{{--                    </div>--}}
{{--                    <div class="form-group ticks-checkbox" style="margin: 35px 0">--}}
{{--                        <!-- <ul data-toggle="buttons" class="mb-0 text-center">--}}

{{--                            <li class="btn d-inline">--}}

{{--                                <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Remember me--}}

{{--                            </li>--}}

{{--                        </ul> -->--}}
{{--                        <div--}}
{{--                            class="form-check form-check-inline custom-control custom-checkbox d-flex justify-content-center">--}}
{{--                            <input type="checkbox" class="custom-control-input" id="userCheckbox">--}}
{{--                            <label class="custom-control-label remember-check" for="userCheckbox">Remember me</label>--}}
{{--                        </div>--}}
{{--                        <input type="submit" class="btn login-btn" value="Login"><br>--}}
{{--                        <a href="{{route('forgot-password')}}" style="font-size: 13px;color: #FFF;font-weight: 100">Forgot your--}}
{{--                            password?</a>--}}
{{--                    </div>--}}
{{--                    <p style="color: #FFF;font-size: 16px;font-weight: 100">Don't have an account? <a--}}
{{--                            href="{{route('email-confirmation')}}" class="sign-up">Sign up</a></p>--}}
{{--                </div>--}}
{{--            </form>--}}
        </div>
    </div>
</div>
<!-- login-form -->

<!-- change-password-form -->
<div id="change-password-form" class="change-password-modal modal fade">
    <div class="modal-dialog modal-dialog-centered modal-login">
        <div class="modal-content">
            <form method="POST" action="{{route('change-password')}}" id="pchanged" name="pchanged">
                @csrf
                <div class="modal-header">
                    <span class="modal-title">CHANGE PASSWORD</span>
                    <a class="close red-btn" data-dismiss="modal" aria-hidden="true">&times;</a>
                </div>
                <div class="modal-body pt-3">
                    <div class="alert alert-success mb-2 text-center" id='alert-success-change-password' style="display: none"
                         role="alert">
                    </div>
                    <div class="alert alert-danger mb-2 text-center" id='alert-error-change-password' style="display: none"
                         role="alert">
                    </div>
                    <img src="{{$ASSET}}/front_site/images/favicon.png" class="mb-5">
                    <div class="form-group position-relative">
                        <span toggle="#prev_password" class="position-absolute mt-0 fa fa-fw fa-eye toggle-password-eye" style="top:13px;right:5px;color: rgb(153, 153, 153)"></span>
                        <input type="password" id="prev_password" class="form-control"
                               name="current_password" placeholder="Old Password">
                        <small class="text-danger" id="current_password_error"></small>
                    </div>
                    <div class="form-group position-relative">
                        <span toggle="#new_password" class="position-absolute mt-0 fa fa-fw fa-eye toggle-password-eye" style="top:13px;right:5px;color: rgb(153, 153, 153)"></span>
                        <input type="password" id="new_password" class="form-control"
                               name="new_password" placeholder="New Password">
                        <small class="text-danger" id="new_password_error"></small>
                    </div>
                    <div class="form-group position-relative">
                        <span toggle="#new_confirm_password" class="position-absolute mt-0 fa fa-fw fa-eye toggle-password-eye" style="top:13px;right:5px;color: rgb(153, 153, 153)"></span>
                        <input type="password" id="new_confirm_password" class="form-control"
                               name="new_confirm_password" placeholder="Confirm Password">
                        <small class="text-danger" id="new_confirm_password_error"></small>
                    </div>
                    <div class="form-group mt-4 mb-0">
                        <button class="red-btn" id="change-password" type="submit">Update</button>
                        <button class="red-btn" data-dismiss="modal" aria-hidden="true">Cancel</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- change-password-form -->
<div id="notific" class="notific-modal modal fade">
    <div class="modal-dialog modal-dialog-centered modal-login notafic">
    </div>
</div>

@push('js')

    <script type="text/javascript">
        $(document).on('click','#megasearch',function() {
            var verified1 = $('#searchFilt').val();
            var verified2 = $('#searchKey').val();
            console.log(verified1);
            if (verified1 && verified2) {
                return true;
            }else {
                alert('Please Input Complete Search Details.');
                return false;
            }
        });
        $(document).on('click', '.leave-btn', function () {
            btn = $(this);
            var user_id = $(this).attr("user_id");
            var company_id = $(this).attr("company_id");
            swal({
                title: "Are you sure that you want to leave?",
                // text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#ajax-preloader").show();
                        $.post("{{ route('company-leave-office') }}", {
                            _token: '{{ csrf_token() }}',
                            user_id: user_id,
                            company_id: company_id,
                            json: 'yes'
                        }, function (data) {
                            // document.getElementById("wait").style.display = "none";
                            $("#ajax-preloader").hide();
                            response = $.parseJSON(data);
                            if (response.feedback == 'encrypt_issue') {
                                toastr.error(response.msg, 'Error');
                                $('#alert-error').html('response.msg')
                                $('#alert-error').show().fadeOut(2500);
                            } else if (response.feedback == 'true') {
                                toastr.success(response.msg, 'Success');
                                // $('#alert-success').html(response.msg)
                                // $('#alert-success').show().fadeOut(2500);
                                setTimeout(() => {
                                    window.location.href = response.url
                                }, 3000);
                            } else {
                                // toastr.error('Something went Wrong', 'Error');
                                $('#alert-error').html('Something went Wrong')
                                $('#alert-error').show().fadeOut(2500);
                            }
                        });
                    }
                });
        });

        $(document).on('change', '#avatar', function () {
            var name = document.getElementById("avatar").files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            var $this = $(this);
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("avatar").files[0]);

            form_data.append("avatar", document.getElementById('avatar').files[0]);
            $.ajax({
                url: "{{route('upload-user-avatar')}}",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                    $this.siblings('.loader-spinner').removeClass('d-none');
                    $this.siblings('.upload-button').css('background', 'rgb(0 0 0 / 65%)');
                },
                success: function (data) {
                    $this.siblings('.loader-spinner').addClass('d-none');
                    $this.siblings('.upload-button').css('background', 'unset');
                    $('#uploaded_image').html(data);
                }
            });
        });

        @if(!Request::is('my-company-profile/'.Session::get('company_id')))
        $(document).delegate('#compani_id', 'change', function(e) {
            e.preventDefault();
            var company_id=$(this).val();
            var token='{{csrf_token()}}';
            $.ajax({
                type:'POST',
                url: '{{ url('/ajax-company-id-get') }}',
                data:{company_id:company_id,_token:token},
                cache: false,
                success: function(data) {

                    window.location = window.location.href;
                }
            });
        });
        @else
        $(document).delegate('#compani_id', 'change', function(e) {
            e.preventDefault();
            var company_id=$(this).val();
            var token='{{csrf_token()}}';
            $.ajax({
                type:'POST',
                url: '{{ url('/ajax-company-id-get') }}',
                data:{company_id:company_id,_token:token},
                cache: false,
                dataType: 'json',
                success: function(data) {
                    window.location.href = data.url;
                }
            });
        });
        @endif

        var validator = $("form[name='pchanged']").validate({
            onfocusout: function (element) {
                var $element = $(element);
                // console.log($element);
                if ($element.prop('required')) {
                    this.element(element)
                } else if ($element.val() != '') {
                    this.element($element)
                } else {
                    $element.removeClass('is-valid');
                }
            },
            rules: {
                'current_password': {
                    required: true,
                    minlength: 8
                },
                'new_password':{
                    required: true,
                    minlength: 8
                },
                'new_confirm_password':{
                    required: true,
                    minlength: 8,
                    equalTo : '[name="new_password"]'
                },
                onkeyup: function (element) {
                    var $element = $(element);
                    $element.valid();
                },
            },
            messages: {
                'current_password': {
                    required: "Please enter your old password.",
                    minlength: "Input min length 8 characters."
                },
                'new_password': {
                    required: "Please enter new password.",
                    minlength: "Input min length 8 characters."
                },
                'new_confirm_password': {
                    required: "Re-enter New Password.",
                    minlength: "Input min length 8 characters.",
                    equalTo: "New Password Do Not Match."
                },
            },
            errorClass: 'is-invalid error',
            validClass: 'is-valid',
            highlight: function (element, errorClass, validClass) {
                var elem = $(element);
                if (elem.attr('type') == 'password'){
                    elem.addClass(errorClass);
                    elem.removeClass(validClass);
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                var elem = $(element);
                if (elem.attr('type') == 'password'){
                    elem.removeClass(errorClass);
                    elem.addClass(validClass);
                }
                if (elem.siblings('small.text-danger')) {
                    elem.siblings('small.text-danger').html('');
                } else if (elem.closest('.form-group').find('small.text-danger')) {
                    elem.closest('.form-group').find('small.text-danger').html('');
                } else if (elem.closest('.form-group').closest('.form-group').find('small.text-danger')) {
                    elem.closest('.form-group').closest('.form-group').find('small.text-danger').html('');
                }
            },
            errorPlacement: function (error, element) {
                var elem = $(element);
                if (elem.attr('type') == 'password') {
                    error.insertAfter(element);
                }
            }
        });
        var options_change_password = {
            dataType: 'Json',
            success: function (data) {
                $('html, body').animate({scrollTop: 0}, 'slow');
                $('#alert-success-change-password').hide();
                $('#alert-error-change-password').hide();
                response = data;
                if (response.feedback == 'false') {
                    $.each(response.errors, function (key, value) {
                        $('#' + key + '_error').html(value[0]);
                        $(":input[name=" + key + "]").addClass('is-invalid');
                    });
                } else if (response.feedback == 'invalid') {
                    $('#alert-error-change-password').html(response.msg);
                    $('#alert-error-change-password').show();

                } else {

                    $('#alert-error-change-password').hide();
                    $('#alert-success-change-password').html(response.msg);
                    $('#alert-success-change-password').show();
                    setTimeout(() => {
                        window.location.href = response.url;
                    }, 3000);
                    toastr.success(response.messag);

                }
            },
            error: function (jqXHR, exception) {
                $('html, body').animate({scrollTop: 0}, 'slow');
                $('#alert-success-change-password').hide();
                $('#alert-error-change-password').hide();
                // form.find('button[type=submit]').html('<i aria-hidden="true" class="fa fa-check"></i> {{ __('Save') }}');
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not Connected.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error, Please try again later';
                }
                $('#alert-error-change-password').html(msg);
                $('#alert-error-change-password').show();
            },

        };
        $('#pchanged').ajaxForm(options_change_password);

        $(document).delegate('.is-read', 'click', function() {
            var notifi_id=$(this).siblings("input[name='read']").val();
            var token='{{csrf_token()}}';
            $("#ajax-preloader").show();
            $.ajax({
                type:'POST',
                url: '{{ url('/is-read-notification') }}',
                data:{notifi_id:notifi_id,_token:token},
                cache: false,
                success: function(data) {
                }
            });
        });
        $(document).delegate('.is-display', 'click', function() {
            var notifi_id=$(this).siblings("input[name='display']").val();
            var token='{{csrf_token()}}';
            $("#ajax-preloader").show();
            $.ajax({
                type:'POST',
                url: '{{ url('/is-display-notification') }}',
                data:{notifi_id:notifi_id,_token:token},
                cache: false,
                success: function(data) {
                    // window.location.reload();
                }
            });
        });

        $(document).delegate('#view-page', 'click', function() {
            var notifi_id=$(this).attr("attr-val");
            var token='{{csrf_token()}}';
            $.ajax({
                type:'POST',
                url: '{{ url('/send-notification-id') }}',
                data:{notifi_id:notifi_id,_token:token},
                cache: false,
                success: function(data) {
                    if (data.feedback) {
                        window.location.href = data.url;
                    }
                }
            });
        });
    </script>
    @if(Auth::check())
        <script type="text/javascript">
            // if (!(location.href.match('/products/create') || location.href.match('/create/buy-sell') || location.href.match('/company-profile') || location.href.match('/my-company-profile/') || location.href.match('/edit/buy-sell/'))) {
            setInterval(function()
            {
                $.ajax({
                    type:"post",
                    url:"{{route('notification')}}",
                    data:{_token: "{{csrf_token()}}" , current_url: '{{url()->current()}}' },
                    dataType: 'Json',
                    success: function (data) {
                        console.log(data);
                        $(".notafic").text('');
                        $("#notify").text(data.notify);
                        $('#isdiplay').html(data.output);
                        $("#meeti").text(data.meetnoti);
                        $("#chati").text(data.chatnoti);
                        if(data.leadinq ==0){
                            $("#leadinq").text(0);
                        }else{
                            $("#leadinq").text(data.leadinq);
                        }
                        $("#dealinq").text(data.dealinq);
                        if(data.fleadinq ==0){
                            $("#fleadinq").text(0);
                        }else{
                            $("#fleadinq").text(data.fleadinq);
                        }
                        $("#fdealinq").text(data.fdealinq);
                        if (data.notifiactions){
                            @if(!(\Request::is('group-chat')))
                            var content = '<div class="modal-content">'+
                                '<div class="modal-header">'+
                                '<span class="modal-title">Notification</span>'+
                                '<input type="hidden" name="display" value="'+data.notifiactions.id+'"/>'+
                                '<button type="button" class="close is-display" data-dismiss="modal" aria-hidden="true">&times;</button>'+
                                '</div>'+
                                '<div class="modal-body pt-3">'+
                                '<p style="color: white;">'+data.notifiactions.notification_text+'</p>'+
                                '<input type="button" id="view-page" class="red-btn" attr-val="'+data.notifiactions.id+'" value="View">'+
                                '</div>'+
                                "</div>";
                            $('#notific').modal('show');
                            $(".notafic").append(content);
                            @endif
                        }
                    }
                });
            }, 1000);//time in milliseconds
            // }else{
            //     $(".notifications-scroll").css("display", "none");
            //     $(".biz-notifications").hover(function() {
            //         $(this).addClass('disable-notify');
            //     });
            //     console.log('return false');
            // }
        </script>
    @endif

@endpush
