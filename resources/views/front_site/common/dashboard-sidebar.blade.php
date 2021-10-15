<div class="border-right" id="dashboardSidebar">
    <div class="pl-3 pt-3 pr-3">
        <div class="company-info-container d-flex m-0 mb-3">
            <div class="avatar-wrapper">
                <img class="profile-pic" id="uploaded_image" src="{{ get_user_image(Auth::user()) }}"/>
                <div class="upload-button">
                    <span class="fa fa-plus"></span>
                </div>
                <input class="file-upload" name="avatar" id="avatar" type="file" accept="image/*"/>
            </div>
            <div class="company-info">

                <span class="d-block font-500">{{ company_name(session()->get('company_id'))??'' }}</span>

                <span class="d-block user-name">{{ getUserNameById($user->id) }}</span>
                <p class="mb-0">{{$user->country->country_name??''}}</p>
                <p class="mb-0">Basic Member <a href="#" class="text-decoration-none font-500 red-link">(Upgrade)</a></p>
            </div>
        </div>
        <div class="progress mb-3">
            <div class="progress-bar" role="progressbar"
                 aria-valuenow="{{ $profile_percentage = get_user_profile_percentage($user->id) }}"
                 aria-valuemin="0" aria-valuemax="100">{{ $profile_percentage }}%</div>
        </div>
    </div>
    <aside class="side-nav">
        <ul class="mb-0 categories">
            <?php $company = \App\UserCompany::where('user_id',\Auth::id())->first();?>
            @if(!$company)
                <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="My Dashboard"><img class="mr-2" src="https://cdn2.iconfinder.com/data/icons/thin-charts-analytics/24/thin-1086_kpi_dashboard_monitor-512.png" height="20"><a href="{{route('user-dashboard')}}" class="sidebar-links">Dashboard</a>
                <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="My Account"><img class="mr-2" src="https://image.flaticon.com/icons/png/128/2321/2321232.png" height="20"><a href="{{ route('my-account-detail') }}" class="sidebar-links">My
                        Account</a></li>
                <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="Business Profile"><img class="mr-2" src="https://cdn.iconscout.com/icon/premium/png-256-thumb/work-desk-1-982669.png" height="20"><a href="{{route('company-profile')}}" class="sidebar-links">Create New Biz Office</a><span class="badge new-badge">New</span></li>
                <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                    title="MyBiz Deals instant Buy & Sell textile products for daily use"><img class="mr-2" src="https://static.thenounproject.com/png/1353582-200.png" height="20"><a href="javascript:;">MyBiz Deals (Buy/Sell)</a><span class="biz-badge">{{ \App\BuySell::where('user_id', \Auth::user()->id)->count() }}</span>
                    <ul class="side-nav-dropdown">
                        <li data-toggle="tooltip" data-placement="bottom" title="Add New Buy/Sell">
                            <a href="{{route('buy-sell.create')}}" class="sidebar-links">Add A New Deal
                            </a></li>
                        <li data-toggle="tooltip" data-placement="bottom" title="All Buy/Sell">
                            <a href="{{route('buy-sell.index')}}" class="sidebar-links">View All Deals
                            </a></li>


                    </ul>
                </li>
                <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                    title="Careers"><img class="mr-2" src="https://www.pngrepo.com/png/128160/512/worker-career.png" height="20"><a href="javascript:;">Careers</a>
                    <ul class="side-nav-dropdown">
                        <li data-toggle="tooltip" data-placement="bottom"
                            title="Add New Jobs"><a href="{{route('view-form-job-management')}}"
                                                    class="sidebar-links">Add New Job</a>
                        </li>
                        <li data-toggle="tooltip" data-placement="bottom"
                            title="View Jobs"><a href="{{route('view-job-management')}}"
                                                 class="sidebar-links">All Jobs</a>
                        </li>
                    </ul>
                </li>
                <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                    title="Journal"><img class="mr-2" src="https://www.biotechconnection-sg.org/wp-content/uploads/2018/06/seo-and-web-glyph-3-04-512.png" height="20"><a href="javascript:;">Journal</a>
                    <ul class="side-nav-dropdown">
                        <li  data-toggle="tooltip" data-placement="bottom" title="Consultancy">
                            <a href="{{  route('view-form-blog') }}" class="sidebar-links">Add Journal</a></li>
                        <li  data-toggle="tooltip" data-placement="bottom" title="Consultancy">
                            <a href="{{route('view-blogs')}}" class="sidebar-links">View All Journal</a></li>

                    </ul>
                </li>
            @else


                <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="My Dashboard"><img class="mr-2" src="https://cdn2.iconfinder.com/data/icons/thin-charts-analytics/24/thin-1086_kpi_dashboard_monitor-512.png" height="20"><a href="{{route('user-dashboard')}}" class="sidebar-links">Dashboard</a>
                <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="My Account"><img class="mr-2" src="https://image.flaticon.com/icons/png/128/2321/2321232.png" height="20"><a href="{{ route('my-account-detail') }}" class="sidebar-links">My
                        Account</a></li>

{{--                @if(checkOwnerCompany(auth()->id(),session()->get('company_id'))->is_owner == 1 || checkOwnerCompany(auth()->id(),session()->get('company_id'))->is_admin == 1 || checkOwnerCompany(auth()->id(),session()->get('company_id'))->is_member == 1)--}}

                        <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Business Profile"><img class="mr-2" src="https://cdn.iconscout.com/icon/premium/png-256-thumb/business-profile-3-919606.png" height="20"><a href="javascript:;">Business Profile</a>
                        <ul class="side-nav-dropdown">
                            {{--                        <li  data-toggle="tooltip" data-placement="bottom" title="Business Profile">--}}
                            {{--                            <a href="#" class="sidebar-links">Business Profile</a></li>--}}
                            <li  data-toggle="tooltip" data-placement="bottom" title="Create & Manage your your company page">
                                <a href="{{route('suppliers-about-us')}}" class="sidebar-links">View Your Company Page</a></li>

                        </ul>
                    </li>
{{--                    @endif--}}
                    </li>

                    {{--                @if($user->my_office)--}}

                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Business Profile"><img class="mr-2" src="https://cdn.iconscout.com/icon/premium/png-256-thumb/work-desk-1-982669.png" height="20"><a href="javascript:;">MyBiz
                            Office</a><span class="biz-badge">{{ \App\CompanyProfile::where('user_id', \Auth::user()->id)->count() }}</span>
                        <ul class="side-nav-dropdown">
                            <li data-toggle="tooltip" data-placement="bottom" title="Biz Offices"><a
                                    href="{{route('my-bizoffices')}}" class="sidebar-links">Biz Offices</a></li>
                            <li  data-toggle="tooltip" data-placement="bottom"
                                 title="Create & Manage your Virtual Office">
                                <a href="{{route('company-profile')}}">Add New Biz Office </a></li>
                            <?php $company = \App\CompanyProfile::where('user_id',\Auth::id())->where('id',session()->get('company_id'))->first();?>
                            @if($company)
                            <li data-toggle="tooltip" data-placement="bottom"
                                    title="Add New Member To This Bizoffice"><a href="{{route('create-member')}}"
                                    class="sidebar-links">Add New Member</a>
                                </li>
                            @endif
                            <li data-toggle="tooltip" data-placement="bottom" title="View All Members"><a
                                    href="{{route('get-members')}}" class="sidebar-links">All Members</a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="View All Meetings"><a
                                    href="{{route('company-get-meetings')}}" class="sidebar-links">All Meetings</a></li>
                            <li class="position-relative" data-toggle="tooltip" data-placement="bottom"
                                title="Communicate With The Members"><a
                                    href="{{route('company-group-chat')}}" class="sidebar-links">Chat</a></li>
                        </ul>
                    </li>

                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Business Leads"><img class="mr-2" src="https://cdn4.iconfinder.com/data/icons/reputation-management-2/66/95-512.png" height="20"><a href="javascript:;">MyBiz
                            Leads</a><span class="biz-badge">{{ \App\Product::where('company_id',session()->get('company_id'))->count() }}</span>
                        <ul class="side-nav-dropdown">
                            <li data-toggle="tooltip" data-placement="bottom" title="Add new product">
                                <a href="{{ route('products.create') }}" class="sidebar-links">Add A New Lead</a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Product Listing">
                                <a href="{{ route('products.index') }}" class="sidebar-links">All Active Leads</a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="Product Listing">
                                <a href="#" class="sidebar-links">Archived Leads</a></li>
                        </ul>
                    </li>

                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="MyBiz Deals instant Buy & Sell textile products for daily use"><img class="mr-2" src="https://static.thenounproject.com/png/1353582-200.png" height="20"><a href="javascript:;">MyBiz Deals (Buy/Sell)</a><span class="biz-badge">{{ \App\BuySell::where('user_id', \Auth::user()->id)->count() }}</span>
                        <ul class="side-nav-dropdown">
                            <li data-toggle="tooltip" data-placement="bottom" title="Add New Buy/Sell">
                                <a href="{{route('buy-sell.create')}}" class="sidebar-links">Add A New Deal
                                </a></li>
                            <li data-toggle="tooltip" data-placement="bottom" title="All Buy/Sell">
                                <a href="{{route('buy-sell.index')}}" class="sidebar-links">View All Deals
                                </a></li>

                        </ul>
                    </li>


{{--                    @if((\Auth::user()->is_admin == 1 && \Auth::user()->is_member == 0 && \Auth::user()->is_owner == 1) || (\Auth::user()->is_admin == 1 && \Auth::user()->is_member == 1))--}}
                        <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                            title="Careers"><img class="mr-2" src="https://www.pngrepo.com/png/128160/512/worker-career.png" height="20"><a href="javascript:;">Careers</a>
                            <ul class="side-nav-dropdown">
                                <li data-toggle="tooltip" data-placement="bottom"
                                    title="Add New Jobs"><a href="{{route('view-form-job-management')}}"
                                                            class="sidebar-links">Add New Job</a>
                                </li>
                                <li data-toggle="tooltip" data-placement="bottom"
                                    title="View Jobs"><a href="{{route('view-job-management')}}"
                                                         class="sidebar-links">All Jobs</a>
                                </li>
                            </ul>
                        </li>
{{--                @endif--}}

                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Journal"><img class="mr-2" src="https://www.biotechconnection-sg.org/wp-content/uploads/2018/06/seo-and-web-glyph-3-04-512.png" height="20"><a href="javascript:;">Journal</a>
                        <ul class="side-nav-dropdown">
                            <li  data-toggle="tooltip" data-placement="bottom" title="Consultancy">
                                <a href="{{  route('view-form-blog') }}" class="sidebar-links">Add Journal</a></li>
                            <li  data-toggle="tooltip" data-placement="bottom" title="Consultancy">
                                <a href="{{route('view-blogs')}}" class="sidebar-links">View All Journal</a></li>

                        </ul>
                    </li>

                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="Preferences">
                        <img class="mr-2" src="https://cdn.iconscout.com/icon/premium/png-512-thumb/setting-176-244097.png" height="20"><a href="javascript:void(0)"
                                                                                                                                           class="sidebar-links">Preferences</a></li>
{{--                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="Inquiry Management">--}}
{{--                        <img class="mr-2" src="https://cdn.iconscout.com/icon/premium/png-512-thumb/setting-176-244097.png" height="20"><a href="{{route('inquiries')}}" class="sidebar-links">Inquiry Management</a></li>--}}
                    <li class="position-relative" data-toggle="tooltip" data-placement="bottom" title="Contact us"><img class="mr-2" src="https://cdn1.iconfinder.com/data/icons/communication-set-1-1/100/Untitled-1-18-512.png" height="20"><a href="{{route('contact-us')}}" class="sidebar-links"> Contact us</a>
                    </li>

                    <li class="position-relative dropdown" data-toggle="tooltip" data-placement="bottom"
                        title="Testimonials"><img class="mr-2" src="https://www.pinclipart.com/picdir/middle/181-1817932_gray-comments-icon-comment-icon-vector-png-clipart.png" height="20"><a href="#"> Testimonials</a>
                        <ul class="side-nav-dropdown">
                            <li><a href="{{route('single-chat-box')}}" class="sidebar-links">Single Chat Box</a></li>
                            <li><a href="#" class="sidebar-links">sample text</a></li>
                            <li><a href="#" class="sidebar-links">sample text</a></li>
                            <li><a href="#" class="sidebar-links">sample text</a></li>
                            <li><a href="#" class="sidebar-links">sample text</a></li>
                        </ul>
                    </li>

                    {{--                @endif--}}
                @endif
                @if(\Auth::user()->is_owner != 1)
                    @if(\Auth::user()->is_admin == 1 || \Auth::user()->is_member == 1)
                        <li class="position-relative  leave-btn"><span class="fa fa-bolt fa-fw mr-2"></span><a href="javascript:;">
                                leave office</a></li>
                    @endif
                @endif
        </ul>
    </aside>
    <button class="w-100 position-sticky bottom-arrow">
        <span class="d-flex justify-content-center align-items-center fa fa-arrow-down" aria-hidden="true"></span>
    </button>
    <button class="w-100 position-sticky top-arrow" style="display: none">
        <span class="d-flex justify-content-center align-items-center fa fa-arrow-up" aria-hidden="true"></span>
    </button>
</div>
