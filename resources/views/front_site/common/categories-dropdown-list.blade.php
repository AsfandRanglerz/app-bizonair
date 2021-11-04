<div class="px-2 d-lg-none mt-2 container-fluid">
    <ul class="nav nav-tabs pro-categories-tab" role="tablist">
        <li class="d-flex nav-item">
            <a class="nav-link active order-2" data-toggle="tab" href="#texBusiness" role="tab" aria-controls="texBusiness"
               aria-selected="true"><span class="fa fa-angle-down"></span></a>
            <a href="{{ url('business-products/fibers-and-materials') }}" class="nav-link main-cat-link order-1">Textile <br> Business</a>
        </li>
        <li class="d-flex nav-item">
            <a class="nav-link order-2" data-toggle="tab" href="#texServices" role="tab" aria-controls="texServices"
               aria-selected="false"><span class="fa fa-angle-down"></span></a>
            <a href="{{ url('services/hr-and-admin') }}" class="nav-link main-cat-link order-1">Textile <br> Services</a>
        </li>
        <li class="d-flex nav-item">
            <a class="nav-link order-2" data-toggle="tab" href="#careersTab" role="tab" aria-controls="careersTab"
               aria-selected="false"><span class="fa fa-angle-down"></span></a>
            <a href="{{ url('jobs-portal') }}" class="nav-link main-cat-link order-1">Careers</a>
        </li>
        <li class="d-flex nav-item">
            <a class="nav-link order-2" data-toggle="tab" href="#journalTab" role="tab" aria-controls="journalTab"
               aria-selected="false"><span class="fa fa-angle-down"></span></a>
            <a href="{{ url('journal') }}" class="nav-link main-cat-link order-1">Journal</a>
        </li>
    </ul>
    <div class="tab-content pro-tab-content">
        <div class="tab-pane fade show active" id="texBusiness" role="tabpanel">
            <div class="row m-0 py-1">
                @foreach(getCategories('Business') as  $cat)
                    <div class="col-4 px-1 pro-categories-tab-links">
                        <a href="{{ route('business-products',$cat->slug) }}" class="py-1 px-2 text-center d-flex flex-column red-btn"><img src="{{ $cat->image }}" class="mb-1 banner-below-adds" width="15" height="15">{{ $cat->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="texServices" role="tabpanel">
            <div class="row m-0 py-1">
                @foreach(getCategories('Services') as  $cat)
                    <div class="col-4 px-1 pro-categories-tab-links">
                        <a href="{{ route('service-products',$cat->slug) }}" class="py-1 px-2 text-center d-flex flex-column red-btn red-btn"><img src="{{ $cat->image }}" class="mb-1 banner-below-adds" width="15" height="15">{{ $cat->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="careersTab" role="tabpanel">
            <div class="row m-0 py-1">
                <div class="col-3 px-1 pro-categories-tab-links pro-cat-careers">
                    <a href="{{ route('view-form-job-management') }}" class="py-1 px-2 text-center d-flex flex-column red-btn"><img src="{{$ASSET}}/front_site/images/Post a Job.png" class="mb-1 banner-below-adds" width="15" height="15">Post A Job</a>
                </div>
                <div class="col-3 px-1 pro-categories-tab-links pro-cat-careers">
                    <a href="#" class="py-1 px-2 text-center d-flex flex-column red-btn"><img src="{{$ASSET}}/front_site/images/red-themed-icons/garments-accessories.png" class="mb-1 banner-below-adds" width="15" height="15">Post Your CV</a>
                </div>
                <div class="col-3 px-1 pro-categories-tab-links pro-cat-careers">
                    <a href="{{ route('jobs-directory') }}" class="py-1 px-2 text-center d-flex flex-column red-btn"><img src="{{$ASSET}}/front_site/images/Explore All Jobs.png" class="mb-1 banner-below-adds" width="15" height="15">Explore All Jobs</a>
                </div>
                <div class="col-3 px-1 pro-categories-tab-links pro-cat-careers">
                    <a href="{{ route('cv-directory') }}" class="py-1 px-2 text-center d-flex flex-column red-btn"><img src="{{$ASSET}}/front_site/images/Post Your CV.png" class="mb-1 banner-below-adds" width="15" height="15">Explore All CV's</a>
                </div>
            </div>
        </div>
        <div class="tab-pane fade position-relative" id="journalTab" role="tabpanel">
            <div class="row m-0 py-1">
                <div class="col-4 px-1 pro-categories-tab-links">
                    <a href="{{route('news')}}" class="py-1 px-2 text-center d-flex flex-column red-btn red-btn"><img src="{{$ASSET}}/front_site/images/NEws.png" class="mb-1 banner-below-adds" width="15" height="15">News</a>
                </div>
                <div class="col-4 px-1 pro-categories-tab-links">
                    <a href="{{route('blogs')}}" class="py-1 px-2 text-center d-flex flex-column red-btn red-btn"><img src="{{$ASSET}}/front_site/images/Blogs.png" class="mb-1 banner-below-adds" width="15" height="15">Blogs</a>
                </div>
                <div class="col-4 px-1 pro-categories-tab-links">
                    <a href="{{route('articles')}}" class="py-1 px-2 text-center d-flex flex-column red-btn red-btn"><img src="{{$ASSET}}/front_site/images/Research Articles.png" class="mb-1 banner-below-adds" width="15" height="15">Research / Articles</a>
                </div>
                <div class="col-4 px-1 pro-categories-tab-links">
                    <a href="{{route('events')}}" class="py-1 px-2 text-center d-flex flex-column red-btn red-btn"><img src="{{$ASSET}}/front_site/images/Events.png" class="mb-1 banner-below-adds" width="15" height="15">Upcoming Events</a>
                </div>
                <div class="col-4 px-1 pro-categories-tab-links">
                    <a href="{{route('projects')}}" class="py-1 px-2 text-center d-flex flex-column red-btn red-btn"><img src="{{$ASSET}}/front_site/images/Student Projects.png" class="mb-1 banner-below-adds" width="15" height="15">Student Projects</a>
                </div>
                <div class="col-4 px-1 pro-categories-tab-links">
                    <a href="{{route('calculation-formula')}}" class="py-1 px-2 text-center d-flex flex-column red-btn red-btn"><img src="{{$ASSET}}/front_site/images/Calculations.png" class="mb-1 banner-below-adds" width="15" height="15">Textile Calculations</a>
                </div>
                <div class="col-4 px-1 pro-categories-tab-links">
                    <a href="{{ route('currency-rates') }}" class="py-1 px-2 text-center d-flex flex-column red-btn red-btn"><img src="{{$ASSET}}/front_site/images/red-themed-icons/ppe-institutional.png" class="mb-1 banner-below-adds" width="15" height="15">Currency Rates</a>
                </div>
                <div class="col-4 px-1 pro-categories-tab-links">
                    <a href="{{route('cotton-rates')}}" class="py-1 px-2 text-center d-flex flex-column red-btn red-btn"><img src="{{$ASSET}}/front_site/images/red-themed-icons/ppe-institutional.png" class="mb-1 banner-below-adds" width="15" height="15">Cotton Rates</a>
                </div>
                <div class="col-4 px-1 pro-categories-tab-links">
                    <a href="{{route('yarn-rates')}}" class="py-1 px-2 text-center d-flex flex-column red-btn red-btn"><img src="{{$ASSET}}/front_site/images/red-themed-icons/ppe-institutional.png" class="mb-1 banner-below-adds" width="15" height="15">Yarn Rates</a>
                </div>
                <button class="m-auto rounded-circle down-arrow-show">
                    <span class="font-weight-bold fa fa-angle-down" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
</div>
