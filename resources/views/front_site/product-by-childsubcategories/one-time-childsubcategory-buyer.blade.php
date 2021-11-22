@extends('front_site.master_layout')

@section('content')

<body class="product-main product-details product-listing">

<main id="maincontent" class="suppliers-buyers">

         @include('front_site.common.product-banner')


        <div class="main-container">
            <div class="container-fluid px-2 py-2">

              @include('front_site.common.garments-nav')

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('business-products/fibers-and-materials') }}">Textile Business</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('business-products/'.$category->slug) }}">{{ucfirst($category->name)}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('business-products/'.$category->slug.'/'.$sub_category->slug.'/one-time-buyers') }}">{{ucfirst($sub_category->name)}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{Request::url()}}">{{ucfirst($childsubcategory->name)}}</a></li>
                    </ol>
                </nav>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9 p-lg-3 p-0">
                            <div class="d-md-flex text-center justify-content-between align-items-center mb-3">
                                <p class="mb-md-0 mb-2 font-500">{{ strtoupper($childsubcategory->name) }} > ONE-TIME BUYERS <span style="color: #999">({{ $viewCount}} PRODUCTS)</span></p>
                                @if(!Auth::check())
                                    <a href="{{ url('login') }}" class="red-btn">Post Your One-Time Deal</a>
                                @else
                                    <a href="{{ route('buy-sell.create') }}" class="red-btn">Post Your One-Time Deal</a>
                                @endif
                            </div>
                            <div class="row m-0 search-container">
                                <div class="col-md-8 p-1 text-md-left text-center">
                                    <h6 class="mt-2 text-left">TOP MANUFACTURING CITIES FOR {{ strtoupper($childsubcategory->name) }}</h6>
                                    <div class="cities-btn">
                                        @foreach($prod_city_search as $prod_city)
                                            <a href="{{route('search-otbuy',['category'=>$category->slug,'subcategory'=>$subcategory,'childsubcategory'=>$childsubcategory->slug,'city'=>$prod_city->city])}}" target="_blank" class="mb-2 link">{{$prod_city->city}}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4 p-1 d-flex align-items-end">
                                    <form class="mb-2 w-100 d-flex" action="{{route('search-otbuy',['category'=>$category->slug,'subcategory'=>$subcategory,'childsubcategory'=>$childsubcategory->slug])}}" method="get">
                                        <input class="form-control mr-2 mb-0" id="city" name="city" type="search" value="{{ isset($city) ? $city : '' }}" placeholder="Search City" aria-label="Search">
                                        <button class="btn my-sm-0 search-btn" type="submit"><span class="fa fa-search" aria-hidden="true"></span></button>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-2 compare-container">
                                <div class="mb-2 compare-cancel-btns">
                                    <a class="pt-1 pb-1 pl-2 pr-2 red-btn" id="compa">Compare</a>
                                    <a class="pt-1 pb-1 pl-2 pr-2 red-btn cancel-btn" id="cancel" >Cancel</a>
                                </div>
                            </div>

                            <div class="mt-2 product-main-container">
                                <ul class="ml-1 mr-1 nav nav-tabs">
                                    <li class="list">
                                        <a href="{{route('suppliers-products',['category'=>$category->slug,'subcategory'=>$subcategory,'childsubcategory'=>$childsubcategory->slug])}}" class="text-uppercase link">REGULAR SUPPLIERS</a>
                                    </li>

                                    <li class="list">
                                        <a href="{{route('buyers-products',['category'=>$category->slug,'subcategory'=>$subcategory,'childsubcategory'=>$childsubcategory->slug])}}" class="text-uppercase link">REGULAR BUYERS</a>
                                    </li>

                                    <li class="list">
                                        <a href="{{route('one-time-seller-deals',['category'=>$category->slug,'subcategory'=>$subcategory,'childsubcategory'=>$childsubcategory->slug])}}" class="text-uppercase link">ONE-TIME SELLERS</a>
                                    </li>

                                    <li class="active list">
                                        <a href="{{route('one-time-buyer-deals',['category'=>$category->slug,'subcategory'=>$subcategory,'childsubcategory'=>$childsubcategory->slug])}}" class="text-uppercase link">ONE-TIME BUYERS</a>
                                    </li>

                                </ul>
                                <div class="mx-1 my-1 d-flex prod-li-by-sub-cat-checkboxes">
                                    <div class="d-inline-block custom-control custom-checkbox">
                                        <input type="checkbox" value="premium" class="custom-control-input" id="Premium">
                                        <label class="custom-control-label" for="Premium">Premium</label>
                                    </div>
                                    <div class="d-inline-block ml-lg-2 custom-control custom-checkbox">
                                        <input type="checkbox" value="corporate" class="custom-control-input" id="Corporate">
                                        <label class="custom-control-label" for="Corporate">Corporate</label>
                                    </div>
                                    <div class="d-inline-block ml-lg-2 custom-control custom-checkbox">
                                        <input type="checkbox" value="trustsign" class="custom-control-input" id="trustSign">
                                        <label class="custom-control-label" for="trustSign">Trust Sign</label>
                                    </div>
                                </div>
                                @if(count($buysell_buying) > 0)
                                    @foreach($buysell_buying as $i => $prod)
                                        <div class="mt-2 product-box">
                                            <div class="mx-0 row product-content-container">
                                                <div class="col-xl-3 col-lg-6 p-lg-2 p-0 product-img-container">
                                                    <a href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                        <div class="mb-2 position-relative product-img-container">
                                                            <?php $img = \DB::table('buysell_images')->where('buy_sell_id',$prod->id)->get();?>
                                                            @foreach($img as $i => $image)
                                                                @if($loop->first)
                                                                    <img id="productImg1" src="{{$image->image}}" class="w-100 product-img border-grey">
                                                                @endif
                                                            @endforeach
                                                            <div class="position-absolute heart-icon-div">
                                                                <a class="text-decoration-none text-reset" href="#add-fav-{{$prod->reference_no}}" data-toggle="modal">
                                                       <span class="text-decoration-none add-to-fav">
                                                          <span class="@if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists()) check-heart fa fa-heart @else check-heart fa fa-heart-o @endif"></span>
                                                       </span>
                                                                </a>
                                                            </div>
                                                            <div id="add-fav-{{$prod->reference_no}}" class="change-password-modal modal fade">
                                                                <div class="modal-dialog modal-dialog-centered modal-login">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                                <span class="modal-title">REMOVE FROM FAVOURITE</span>
                                                                            @else
                                                                                <span class="modal-title">ADD TO FAVOURITE</span>
                                                                            @endif
                                                                            <a class="close red-btn" data-dismiss="modal" aria-hidden="true">&times;</a>
                                                                        </div>
                                                                        <div class="modal-body pt-3">
                                                                            @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                                <p style="color: white">Are you sure your product will be removed from the favourite</p>
                                                                            @else
                                                                                <p style="color: white">A notification will be sent to supplier/buyer to contact you back</p>
                                                                            @endif
                                                                            <div class="form-group mt-4 mb-0">
                                                                                <button @if(Auth::check()) class="red-btn add-to-favourite" data-dismiss="modal" prod_id="{{$prod->id}}" product_service_name="{{$prod->product_service_name}}" product_service_types="{{$prod->product_service_types}}" reference_no="{{$prod->reference_no}}"  @else class="red-btn" data-dismiss="modal" data-toggle="modal" data-target="#login-form" @endif type="submit">Yes</button>
                                                                                <button class="red-btn" data-dismiss="modal" aria-hidden="true">No</button>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="mt-2 custom-control custom-checkbox">
                                                        <input type="checkbox" value="{{$prod->reference_no}}" class="custom-control-input add-product-to-compare"
                                                               id="customCheck{{$i}}" name="reference_no">
                                                        <label class="custom-control-label font-500" for="customCheck{{$i}}">Add to Compare</label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-5 col-lg-5 p-lg-2 p-0 product-details">
                                                    <a class="text-reset text-decoration-none" href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                        <p class="title font-weight-bold overflow-text-dots-subject">{{$prod->product_service_name}}</p>
                                                    </a>
                                                    <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                                    <p class="mb-0">Quantity : @if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif @if($prod->available_unit == "Other") {{$prod->other_available_unit}} @else {{$prod->available_unit}} @endif</p>
                                                    <p class="price font-500 overflow-text-dots-one-line"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ number_format($prod->unit_price_from) }} - {{ number_format($prod->unit_price_to) }}   @else {{ number_format($prod->target_price_from) }} - {{ number_format($prod->target_price_to) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                                    <div class="mt-2 mb-0 text-uppercase place-day">
                                                        <span class="place">{{ $prod->city }}, {{ $prod->country }}</span>
                                                        <p>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-6 p-1 border-grey">
                                                    <div>
                                                        <div class="d-flex membersince">Member <span class="number">since</span><span class="years">{{get_buysell_created_at($prod->user_id)}}</span></div>
                                                        <p class="mb-1 text-uppercase font-500">{{get_buysell_user_name($prod->user_id)}}</p>
                                                        <small class="d-block mb-2 grey-text">{{ $prod->city }}, {{ $prod->country }}</small>
                                                        <div class="mb-2 membericon">
                                                            <a href="#">
                                                                <img alt="Premium Member" src="{{$ASSETS}}/assets/front_site/images/deals-membership.png"   title="We are working on this feature and will enable this soon" data-toggle="tooltip" data-placement="bottom">
                                                            </a>
                                                        </div>
                                                        {{--                                                <div class="my-2 d-inline-block font-500 add-inquiry-basket" required="false">--}}
                                                        {{--                                                    <span class="fa fa-plus mr-2" style="color: #A52C3E"></span>Add to Inquiry Basket--}}
                                                        {{--                                                </div>--}}
                                                        <div class="d-flex column-gap-4">
                                                            <a class="p-0 red-btn"  @if(!Auth::check()) href="{{url('log-in-pre')}}" @endif data-toggle="modal" data-target="#contactFormPDP"><span class="d-inline-block py-1 px-2" data-placement="bottom" title="Send an Inquiry to company on Bizonair portal" data-toggle="tooltip">MESSAGE</span></a>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="contactFormPDP" tabindex="-1" role="dialog" aria-labelledby="contactForm" aria-hidden="true">
                                                                <div class="modal-dialog contact-form" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <span class="modal-title">Send Inquiry</span>
                                                                            <a class="close red-btn" data-dismiss="modal" aria-hidden="true">&times;</a>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="alert alert-success mb-2 text-center" id='alert-success-inquiry' style="display: none"
                                                                                 role="alert">
                                                                            </div>
                                                                            <div class="alert alert-danger mb-2 text-center" id='alert-error-inquiry' style="display: none"
                                                                                 role="alert">
                                                                            </div>
                                                                            <form id="postInquiry" method="POST" action="{{route('post-inquiry')}}">
                                                                                @csrf
                                                                                <input type="hidden" class="form-control" @if(auth()->check()) value="{{\Auth::id()}}" @endif name="userID">
                                                                                <input type="hidden" class="form-control" value="{{$prod->id}}" name="buysellId">
                                                                                <input type="hidden" class="form-control" value="Deal" name="prodType">
                                                                                <input type="hidden" class="form-control" value="{{$prod->product_service_types}}" name="serviceTypes">
                                                                                <input type="hidden" class="form-control" value="{{$prod->reference_no}}" name="referenceNo">
                                                                                <div class="form-row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <input type="text" class="form-control" id="contactName" name="contactName" placeholder="Contact Name" @if(auth()->check()) value="{{\Auth::user()->name}}" @endif required="required">
                                                                                    </div>
                                                                                    <div class="form-group col-md-6">
                                                                                        <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Company Name" required="required">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <input type="number" class="form-control" id="contactNumber" name="contactNumber" placeholder="Contact Number" @if(auth()->check()) value="{{\Auth::user()->registration_phone_no}}" @endif required="required">
                                                                                    </div>
                                                                                    <div class="form-group col-md-6">
                                                                                        <input type="email" class="form-control" id="emailId" name="emailId" placeholder="E-mail" @if(auth()->check()) value="{{\Auth::user()->email}}" @endif required="required">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <select name="country" class="form-control" id="country" required="required">
                                                                                            <option value="" selected disabled>--- Select Country/Region ---</option>
                                                                                            @foreach ($countries as $item)
                                                                                                <option value="{{$item->name->common}}">{{$item->name->common}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group col-md-6">
                                                                                        <select name="city" id="citydwn" required class="form-control">
                                                                                            <option disabled selected>Select City</option>
                                                                                        </select>
                                                                                        <small class="text-danger" id="city_error"></small>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="totalCharLeft">1000 characters remaining</div>
                                                                                <textarea id="description" class="mb-4 textarea-box form-control" name="description" placeholder="Describe Your Requirement..." maxlength="1000"></textarea><div class="form-row">
                                                                                    <div class="form-group col-md-12 career-img-drop-outer attachment-img-file">
                                                                                        <label class="d-block text-left text-white mb-2 font-500">Attachment <small class="font-500">(Attach Reference or Image)</small></label>
                                                                                        <div class="custom-file">
                                                                                            <input type="file" name="image" id="image" class="custom-file-input" id="customFile">
                                                                                            <label class="custom-file-label" for="customFile"><span class="fa fa-download"></span></label>
                                                                                            <small class="text-danger" id="image_error"></small>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-row">
                                                                                    <div class="form-group ticks-checkbox col-md-12 mt-0 mb-0">
                                                                                        <ul data-toggle="buttons" class="mb-0">
                                                                                            <li class="btn">
                                                                                                <input class="input fa fa-square-o" type="checkbox" id="sample_with_specification_sheet" name="sample_with_specification_sheet" value="Sample with specification sheet">Sample with specification sheet
                                                                                            </li>
                                                                                            <li class="btn">
                                                                                                <input class="input fa fa-square-o" type="checkbox" id="latest_price_quotation" name="latest_price_quotation" value="Latest Price Quotation">Latest Price Quotation
                                                                                            </li>
                                                                                            <li class="btn">
                                                                                                <input class="input fa fa-square-o" type="checkbox" id="compliance_certification_required" name="compliance_certification_required" value="Compliance certification required">Compliance certification required
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="form-group ticks-checkbox col-md-12 mt-0 mb-0">
                                                                                        <ul data-toggle="buttons" class="mb-0">
                                                                                            <li class="btn">
                                                                                                <input class="input fa fa-square-o" type="checkbox" id="preferred_payment_terms" name="preferred_payment_terms" value="Preferred payment terms">Preferred payment terms
                                                                                            </li>
                                                                                            <li class="btn">
                                                                                                <input class="input fa fa-square-o" type="checkbox" id="production_capacity" name="production_capacity" value="Production Capacity">Production Capacity
                                                                                            </li>
                                                                                            <li class="btn">
                                                                                                <input class="input fa fa-square-o" type="checkbox" id="qcis" name="qcis" value="I am looking for Quality, Consultation & Inspection Services from Bizonair Team">I am looking for Quality, Consultation & Inspection Services from Bizonair Team
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group ticks-checkbox mt-3 mb-3">
                                                                                    <ul data-toggle="buttons" class="mb-0">
                                                                                        <li class="w-100 btn d-flex">
                                                                                            <input class="input fa fa-square-o" type="checkbox" id="termsCheckbox" name="terms_condition" value="Terms & Conditions">
                                                                                            <div>Please refer our <a href="{{route('privacy-policy')}}" target="_blank" class="text-link">Privacy Policy</a> and <a href="{{route('terms-of-use')}}" target="_blank" class="text-link">Terms & Conditions</a> before submitting your information</div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>

                                                                                <button type="submit" class="btn submit-btn" id="inquiry_create_btn">Send Inquiry Now</button>
                                                                                <button type="submit" disabled class="btn submit-btn btn-proo d-none">
                                                                                    <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Send Inquiry Now
                                                                                </button>

                                                                            </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="mx-0 row product-content-container">
                                        <p class="mb-0 py-2 px-2">No Product Found Related To This Category...</p>
                                    </div>
                                @endif
                            </div>
                            <div align="center">
                        <a href="#" class="load-more red-btn">Load More<span class="ml-2 fa fa-spinner" aria-hidden="true"></span></a>
                    </div>
{{--                            {{ $products->links() }}--}}
                        </div>

                        <div class="px-0 mt-md-0 mt-2 h-auto col-xl-2 col-lg-3 col-md-4 half-side-content">
                            <h3 class="text-center main-heading">TOP COMPANIES</h3>
                            <div class="position-relative top-companies">
                                @foreach($topcompanies as $comp)
                                    <div class="top-companies-card">
                                        <a class="text-reset text-decoration-none" href="{{route('about-us-suppliers',['id'=>$comp->id,'company'=>$comp->company_name])}}">
                                        <img alt="100x100" src="{{$comp->logo }}"
                                             data-holder-rendered="true" height="145" class="w-100 object-contain border-grey">
                                            <div class="companies-card-content">
                                                <img src="{{$ASSET}}/front_site/images/groupsl-224.png">
                                                <span class="company-nm">{{$comp->company_name}}</span>
                                                <p class="company-content overflow-text-dots-three-line">{!!strip_tags($comp->company_introduction)!!}</p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                                <a href="{{route('view-all-companies',['category'=>$category->slug])}}" class="position-absolute red-link view-all" style="right: 15px;bottom: 5px">VIEW ALL</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
</main>



</body>



@endsection
@push('js')

    <!--  /*add to compare model*/ -->

    <script type="text/javascript">
        var ref = [];
        $(".add-product-to-compare").click(function(){
            // Initializing array with Checkbox checked values
            if(ref.length > 2){
                alert('you cannot select more then three products to compare');
                this.checked = false;
            }else{
                ref.push(this.value);
            }
            console.log(ref);
        });

        $("#compa").click(function(){
            var token='{{csrf_token()}}';
            if(ref != ''){
                $.ajax({
                    type:'POST',
                    url: '{{ url('/compare-product-ajax') }}',
                    data:{ref:ref,_token:token},
                    cache: false,
                    success: function(response) {
                        window.location.href= "{{route('products-compare',['category'=>$category->slug,'subcategory'=>$sub_category->slug])}}";
                    }
                });
            }
        });
        $(document).delegate('#cancel', 'click', function(e) {
            e.preventDefault();
            var token='{{csrf_token()}}';
            $.ajax({
                type:'DELETE',
                url: '{{ url('/compare-product-all-deleted-ajax') }}',
                data:{_token:token},
                cache: false,
                success: function(response) {
                    console.log(response);
                }
            });
        });
        $(document).delegate('.add-to-favourite', 'click', function(e) {
            e.preventDefault();
            $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
            var reference_no=$(this).attr("reference_no");
            var prod_id = $(this).attr("prod_id");
            var product_service_name=$(this).attr("product_service_name");
            var product_service_types=$(this).attr("product_service_types");
            var token='{{csrf_token()}}';
            var thisVariable = $(this);
            // console.log($(this).text());
            $.ajax({
                type:'POST',
                url: '{{ url('/favourite-product-ajax') }}',
                data:{reference_no:reference_no,prod_id:prod_id,product_service_types:product_service_types,product_service_name:product_service_name,_token:token},
                cache: false,
                success: function(data) {

                    response = $.parseJSON(data);
                    if (response.feedback === "false") {
                        toastr.error(response.msg).fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        $("#loader").hide();
                        toastr.success(response.msg).fadeOut(2500);

                        let heart_btn = $(thisVariable).closest('.change-password-modal').siblings('.heart-icon-div').find('.check-heart');
                        console.log(heart_btn);
                        if($(heart_btn).hasClass('fa-heart-o'))
                        {
                            console.log(heart_btn);
                            $(heart_btn).removeClass('fa-heart-o').addClass('fa-heart');
                        }
                        else if($(heart_btn).hasClass('fa-heart')){
                            $(heart_btn).removeClass('fa-heart').addClass('fa-heart-o');
                        }
                        // setTimeout(() => {
                        //     window.location.href = response.close();
                        // }, 500);
                    }
                }
            });
        });
        $(document).ready(function () {
            var options_inquiry = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $('#alert-success-inquiry').hide();
                    $('#alert-error-inquiry').hide();
                    $('#inquiry_create_btn').addClass('d-none');
                    $('.btn-proo').removeClass('d-none');
                },
                success: function (data) {
                    $('.btn-proo').addClass('d-none');
                    $('#inquiry_create_btn').removeClass('d-none');
                    $('html, .modal').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-inquiry').hide();
                    $('#alert-error-inquiry').hide();
                    response = data;
                    if (response.feedback == 'false') {
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    } else if (response.feedback == 'invalid') {
                        $('#alert-error-inquiry').html(response.msg);
                        $('#alert-error-inquiry').show();

                    } else {

                        $('#alert-error-inquiry').hide();
                        $('#alert-success-inquiry').html(response.msg);
                        $('#alert-success-inquiry').show();
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);

                    }
                },
                error: function (jqXHR, exception) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-inquiry').hide();
                    $('#alert-error-inquiry').hide();
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
                    $('#alert-error-inquiry').html(msg);
                    $('#alert-error-inquiry').show();
                },

            };

            $('#postInquiry').ajaxForm(options_inquiry);

            $('#country').on('change', function() {
                var country_id = this.value;
                $("#citydwn").html('');
                $.ajax({
                    url:"{{url('/get-state-list')}}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType : 'json',
                    success: function(result){
                        $('#citydwn').html('<option value="" selected disabled>Select City</option>');
                        $.each(result.cities,function(key,value){
                            $("#citydwn").append('<option value="'+value+'">'+value+'</option>');
                        });
                    }
                });
            });

        });
    </script>

@endpush
