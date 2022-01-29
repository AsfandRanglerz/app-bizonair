@extends('front_site.master_layout')
@section('metadata')
    <link rel="stylesheet" type="text/css" href="{{$ASSET}}/front_site/css/animate.min.css">
@endsection
@section('content')
    <body class="product-details">
    <style>
        .product-banner-container .banner-search {
            bottom: 0;
        }
    </style>
    <main id="maincontent" class="page-main">
        {{--        <div class="position-relative" style="height: 90px">--}}
        {{--            @include('front_site.common.search-bar')--}}
        {{--        </div>--}}
        <div class="suppliers-buyers">
            <div class="container-fluid px-2 py-2">
                <div class="mb-2 font-500 searh-status">Search Criteria : <span class="grey-text">Search Name - </span>{{ $search }}, <span class="grey-text">Type - </span>{{ $category }} <span class="grey-text">({{count($buysell)}} PRODUCTS)</span></div>
                <div class="row mx-0 mb-4 search-main-container">
                    <div class="col-md-12 p-2">
                        <div class="d-flex flex-wrap justify-content-around link-heading-container">
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=Regular+Supplier&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">MYBIZ LEADS ({{getRegularSupplier(request()->keywords)+getRegularBuyer(request()->keywords)}})</a></h6></h6>
                            <h6 class="position-relative link-heading active-heading"><a href="{{url('search-product?category=One-Time+Supplier&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">ONE-TIME DEALS ({{getOneTimeSupplier(request()->keywords)+getOneTimeBuyer(request()->keywords)}})</a></h6></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=Regular+Services&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">SERVICES ({{getServiceProviders(request()->keywords)+getServiceSeekers(request()->keywords)}})</a></h6></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=Companies&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">COMPANIES ({{getSearchCompanies(request()->keywords)}})</a></h6></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=articles&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">ARTICLES ({{getArticles(request()->keywords)}})</a></h6></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=news&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">NEWS ({{getNews(request()->keywords)}})</a></h6></h6>
                            <h6 class="position-relative link-heading"><a href="{{url('search-product?category=events&keywords='.request()->keywords)}}" class="text-reset text-decoration-none">EVENTS ({{getEvents(request()->keywords)}})</a></h6>
                        </div>
                        <div class="mt-2 product-main-container">
                            <ul class="ml-1 mr-1 nav nav-tabs">
                                <li class="list">
                                    <a href="{{url('search-product?category=One-Time+Supplier&keywords='.request()->keywords)}}" class="text-uppercase link">ONE-TIME SELLING ({{getOneTimeSupplier(request()->keywords)}})</a>
                                </li>

                                <li class="active list">
                                    <a href="{{Request::fullUrl()}}" class="text-uppercase link">ONE-TIME BUYING ({{count($buysell)}})</a>
                                </li>
                            </ul>
                            <div class="mt-3 compare-container">
                                <div class="mb-2 compare-cancel-btns">
                                    <a class="pt-1 pb-1 pl-2 pr-2 red-btn" id="compa">Compare</a>
                                    <a class="pt-1 pb-1 pl-2 pr-2 red-btn cancel-btn" id="cancel">Cancel</a>
                                </div>
                            </div>
                            <?php $categ = ''; $subcat = ''; ?>
                            @if(!empty($buysell) && count($buysell)> 0)
                                @isset($buysell)
                                    @foreach($buysell as $i => $prod)
                                        <?php $categ = get_category_slug($prod->category_id); $subcat = get_sub_category_slug($prod->subcategory_id);?>
                                        <div class="ml-1 mr-1 mb-2 row product-content-container">
                                            <div class="col-xl-3 col-lg-6 p-lg-2 p-0 product-img-container">
                                                @if($prod->product_service_types == 'Service')
                                                    <a class="text-decoration-none text-reset" href="{{ route('serviceDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                        @else
                                                            <a href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                                @endif

                                                                <div class="position-relative product-img-container">
                                                                    <?php $img = \DB::table('buysell_images')->where('buy_sell_id',$prod->id)->get();?>
                                                                    @if($img->isNotEmpty())
                                                                        @foreach($img as $i => $image)
                                                                            @if($loop->first)
                                                                                <img id="productImg1" src="{{$image->image}}" class="w-100 product-img border-grey">
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <img id="productImg1" src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 product-img border-grey">
                                                                    @endif
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
                                                                                    <button  class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                </div>
                                                                                <div class="modal-body pt-3">
                                                                                    @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists())
                                                                                        <p style="color: white">Are you sure your product will be removed from the favourite</p>
                                                                                    @else
                                                                                        <p style="color: white">A notification will be sent to supplier/buyer to contact you back</p>
                                                                                    @endif

                                                                                    <div class="form-group mt-4 mb-0">
                                                                                        @if(!Auth::check())
                                                                                            <button onclick="location.href={{url('login')}}" class="red-btn" type="submit">Yes</button>
                                                                                        @else
                                                                                            <button class="red-btn add-to-favourite" data-dismiss="modal" prod_id="{{$prod->id}}" product_service_name="{{$prod->product_service_name}}" product_service_types="{{$prod->product_service_types}}" reference_no="{{$prod->reference_no}}" type="submit">Yes</button>
                                                                                        @endif
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
                                            <div class="col-xl-5 col-lg-5 p-lg-2 p-0  product-details">
                                                <a class="text-reset text-decoration-none" href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                    <p class="title font-weight-bold overflow-text-dots-subject">{{$prod->product_service_name}}</p>
                                                </a>
                                                <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                                <p class="mb-0">Quantity : @if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif @if($prod->available_unit == "Other") {{$prod->other_available_unit}} @else {{$prod->available_unit}} @endif</p>
                                                <p class="price font-500"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ number_format($prod->unit_price_from) }}   @else {{ number_format($prod->target_price_from) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                                <p class="mt-2 mb-0 text-uppercase place-day">{{ $prod->city }}, {{ $prod->country }} <span class="pl-5">{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span></p>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 p-3 border-grey">
                                                <div>
                                                    <div class="d-flex membersince">Member <span class="number">since</span><span class="years">{{get_buysell_created_at($prod->user_id)}}</span></div>
                                                    <p class="text-uppercase font-500 font-24 overflow-text-dots-one-line">{{get_buysell_user_name($prod->user_id)}}</p>
                                                    <small class="d-block grey-text">{{ $prod->city }}, {{get_buysell_country($prod->user_id)}} </small>
                                                    <div class="mb-2 membericon">
                                                        <a href="#">
                                                            <img alt="Premium Member" src="{{$ASSETS}}/assets/front_site/images/deals-membership.png"   title="We are working on this feature and will enable this soon" data-toggle="tooltip" data-placement="bottom">
                                                        </a>
                                                    </div>
                                                    {{--                                        <div class="my-2 d-inline-block font-500 add-inquiry-basket" required="false">--}}
                                                    {{--                                            <span class="fa fa-plus mr-2" style="color: #A52C3E"></span>Add to Inquiry Basket--}}
                                                    {{--                                        </div>--}}
                                                    <div class="d-sm-inline-block d-flex flex-column align-items-center">
                                                        @if(!Auth::check())
                                                            <a href="{{url('login')}}" class="mb-md-0 mb-1 p-0 red-btn"><span class="d-inline-block py-1 px-2" data-placement="bottom" title="Send an Inquiry to company on Bizonair portal" data-toggle="tooltip">SEND A MESSAGE</span></a>
                                                        @else
                                                            <a href="#" class="mb-md-0 mb-1 p-0 red-btn" data-toggle="modal" data-target="#contactFormPDP"><span class="d-inline-block py-1 px-2" data-placement="bottom" title="Send an Inquiry to company on Bizonair portal" data-toggle="tooltip">SEND A MESSAGE</span></a>
                                                    @endif
                                                    <!-- Modal -->
                                                        <div class="modal fade" id="contactFormPDP" tabindex="-1" role="dialog" aria-labelledby="contactForm" aria-hidden="true">
                                                            <div class="modal-dialog contact-form" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <span class="modal-title">Send Inquiry</span>
                                                                        <button  class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="alert alert-success mb-2 text-center" id='alert-success-inquiry' style="display: none"
                                                                             role="alert">
                                                                        </div>
                                                                        <div class="alert alert-danger mb-2 text-center" id='alert-error-inquiry' style="display: none"
                                                                             role="alert">
                                                                        </div>
                                                                        <form id="mainSearchBuysellinquiry" method="POST" action="{{route('post-inquiry')}}">
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
                                                                                        <label class="custom-file-label" for="customFile"><span class="fa fa-upload"></span></label>
                                                                                        <small class="text-danger" id="image_error"></small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div align="left">
                                                                                <div class="mb-0 form-group">
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" name="sample_with_specification_sheet" id="sample_with_specification_sheet" value="Sample with specification sheet">
                                                                                        <label class="text-left text-white font-weight-100 custom-control-label" for="sample_with_specification_sheet">Sample with specification sheet</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-0 form-group">
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" name="latest_price_quotation" id="latest_price_quotation" value="Latest Price Quotation">
                                                                                        <label class="text-left text-white font-weight-100 custom-control-label" for="latest_price_quotation">Latest Price Quotation</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-0 form-group">
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" name="compliance_certification_required" id="compliance_certification_required" value="Compliance certification required">
                                                                                        <label class="text-left text-white font-weight-100 custom-control-label" for="compliance_certification_required">Compliance certification required</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-0 form-group">
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" name="preferred_payment_terms" id="preferred_payment_terms" value="Preferred payment terms">
                                                                                        <label class="text-left text-white font-weight-100 custom-control-label" for="preferred_payment_terms">Preferred payment terms</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-0 form-group">
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" name="production_capacity" id="production_capacity" value="Production Capacity">
                                                                                        <label class="text-left text-white font-weight-100 custom-control-label" for="production_capacity">Production Capacity</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-0 form-group">
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" name="qcis" id="qcis" value="I am looking for Quality, Consultation & Inspection Services from Bizonair Team">
                                                                                        <label class="text-left text-white font-weight-100 custom-control-label" for="qcis">I am looking for Quality, Consultation & Inspection Services from Bizonair Team</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-0 form-group">
                                                                                    <div class="custom-control custom-checkbox">
                                                                                        <input type="checkbox" class="custom-control-input" name="terms_condition" id="termsCheckbox" required>
                                                                                        <label class="text-left text-white font-weight-100 custom-control-label" for="termsCheckbox">Please agree to the <a href="{{url('terms-of-use')}}" class="text-link">Terms of Services</a> and <a href="{{url('privacy')}}" class="text-link">Privacy Policy</a></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <button type="submit" class="btn submit-btn" id="inquiry_create_btn" disabled="true">Send Inquiry Now</button>
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
                                            {{--                                            <div class="w-100 mt-lg-0 mt-2 d-flex flex-lg-row flex-column justify-content-lg-around align-items-center" >--}}
                                            {{--                                                <a href="{{route('other-product-this-supplier',[$prod->subcategory->slug,$prod->company_id])}}" class="text-decoration-none red-link">Other products from this--}}
                                            {{--                                                    Supplier</a>--}}
                                            {{--                                                <a href="{{route('similar-product-this-supplier',[$prod->subcategory->slug,$prod->company_id])}}" class="text-decoration-none red-link">Similar product from this--}}
                                            {{--                                                    Supplier</a>--}}
                                            {{--                                            </div>--}}
                                        </div>

                                    @endforeach
                                @endisset
                            @else
                                <div class="product-box">
                                    <div class="ml-1 mr-1 mb-2 row product-content-container">
                                        <p class="mb-0">Sorry, there were no items that matched your criteria.</p>
                                    </div>
                                </div>
                            @endif
{{--                            <nav>--}}
{{--                                <ul class="mb-0 mr-1 d-flex justify-content-end pagination">--}}
{{--                                        <li class="page-item disabled">--}}
{{--                                        <span class="page-link">Previous</span>--}}
{{--                                    </li>--}}
{{--                                        <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                                        <li class="page-item active">--}}
{{--                                        <span class="page-link">2<span class="sr-only">(current)</span>--}}
{{--                                    </span>--}}
{{--                                    </li>--}}
{{--                                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                    <li class="page-item">--}}
{{--                                    <a class="page-link" href="#">Next</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </nav>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
@endsection
@push('js')

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
                        @if($categ)
                            window.location.href= "{{route('products-compare',['category'=>$categ,'subcategory'=>$subcat])}}";
                        @endif
                    }
                });
            }
        });

        $(document).ready(function () {
            var options_emailconfirmation = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $('#code').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                },
                success: function (data) {
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#code').removeClass('d-none');
                    if (response.feedback == 'false') {

                    } else if (response.feedback == 'invalid') {
                        $('#alert-error').html(response.msg);
                        $('#alert-error').show();
                        // setTimeout(() => {
                        // 	window.location.reload();
                        // }, 1000);
                    } else if (response.feedback == 'true') {
                        // $('#code').attr('disabled');
                        // $('#alert-success').html('Email has been sent successfully.');
                        // $('#alert-success').show();
                        // let email = $('#email').val();
                        // $('#verifyemail').val(email);
                        window.location.href = '{{ route('email-confirmation') }}?from=home&email=' + $('#email').val();
                    }
                },
                error: function (jqXHR, exception) {
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#code').removeClass('d-none');
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
                    $('#alert-error').html(msg);
                    $('#alert-error').show();
                },

            };

            $('#emailConfirmationForm').ajaxForm(options_emailconfirmation);


        });
    </script>

    <script type="text/javascript">
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
                    $('#alert-success-inquiryy').hide();
                    $('#alert-error-inquiryy').hide();
                    response = data;
                    if (response.feedback == 'false') {
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    } else if (response.feedback == 'invalid') {
                        $('#alert-error-inquiryy').html(response.msg);
                        $('#alert-error-inquiryy').show();

                    } else {

                        $('#alert-error-inquiryy').hide();
                        $('#alert-success-inquiryy').html(response.msg);
                        $('#alert-success-inquiryy').show();
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);

                    }
                },
                error: function (jqXHR, exception) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-inquiryy').hide();
                    $('#alert-error-inquiryy').hide();
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
                    $('#alert-error-inquiryy').html(msg);
                    $('#alert-error-inquiryy').show();
                },

            };

            $('#mainSearchProductinquiry').ajaxForm(options_inquiry);
            $('#countryp').on('change', function() {
                var country_id = this.value;
                $("#citydw").html('');
                $.ajax({
                    url:"{{url('/get-state-list')}}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType : 'json',
                    success: function(result){
                        $('#citydw').html('<option value="" selected disabled>Select City</option>');
                        $.each(result.cities,function(key,value){
                            $("#citydw").append('<option value="'+value+'">'+value+'</option>');
                        });
                    }
                });
            });

        });
        $(document).ready(function () {
            var options_inquiryy = {
                dataType: 'Json',
                success: function (data) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
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

            $('#mainSearchBuysellinquiry').ajaxForm(options_inquiryy);

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
