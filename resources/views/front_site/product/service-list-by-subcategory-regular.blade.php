@extends('front_site.master_layout')

@section('content')

    <body class="product-main product-details product-listing">
    <main id="maincontent" class="suppliers-buyers">

        @include('front_site.common.product-banner')


        <div class="main-container">
            <div class="container-fluid px-2 py-2">

                @include('front_site.common.garments-nav-service')

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('services/hr-and-admin') }}">Textile Services</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('services/'.$category->slug) }}">{{ucfirst($category->name)}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{Request::url()}}">{{ucfirst($sub_category->name)}}</a></li>
                    </ol>
                </nav>
                <div id="prodError"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="px-0 col-xl-10 col-lg-9 col-md-8 half-side-content">
                            <div class="d-md-flex text-center justify-content-between align-items-center mb-2">
                                <p class="mb-md-0 mb-1 font-500">{{ strtoupper(str_replace('-', ' ', $subcategory)) }} REGULAR SERVICES <span style="color: #999">({{ $viewCount}} PRODUCTS)</span></p>
                                <a href="#" class="red-btn" >POST YOUR REQUIREMENT</a>
                            </div>

                            <div class="mt-2 product-main-container">
                                <ul class="ml-1 mr-1 nav nav-tabs">
                                    <li class="active list">
                                        <a href="{{route('subcategory-regular-services',['category'=>$category->slug,'subcategory'=>$subcategory])}}" class="text-uppercase link">REGULAR SERVICES</a>
                                    </li>

                                    <li class="list">
                                        <a href="{{route('subcategory-one-time-services',['category'=>$category->slug,'subcategory'=>$subcategory])}}" class="text-uppercase link">ONE-TIME SERVICES</a>
                                    </li>


                                </ul>

                                @if(count($products) > 0)
                                    @foreach($products as $i => $prod)
                                        <div class="mt-2 product-box">
                                            <div class="mx-0 mt-3 row product-content-container">
                                                <div class="col-xl-3 col-lg-6 p-lg-2 p-0 product-img-container">
                                                    <a href="{{ route('serviceDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                        <div class="position-relative product-img-container">

                                                            @foreach($prod->product_image as $j => $image)
                                                                @if(!empty($image))
                                                                    <img id="productImg1" src="{{$image->image}}" class="w-100 product-img">

                                                                    @if($j==0)
                                                                        @break
                                                                    @endif
                                                                @else
                                                                    <img id="productImg1" src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 product-img">
                                                                @endif
                                                            @endforeach
                                                            <div class="position-absolute heart-icon-div">
                                                                <span  @if(Auth::check()) class="text-decoration-none add-to-fav" prod_id="{{$prod->id}}" product_service_name="{{$prod->product_service_name}}" product_service_types="{{$prod->product_service_types}}" reference_no="{{$prod->reference_no}}"  @else class="text-decoration-none pre-login" @endif><span class="@if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$prod->reference_no])->exists()) check-heart fa fa-heart @else check-heart fa fa-heart-o @endif"></span></span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-xl-5 col-lg-5 p-lg-2 p-0  product-details"><p class="mb-1 title font-weight-bold overflow-text-dots-subject">{{$prod->product_service_name}}</p>
                                                    <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                                    <p class="mb-0">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                                    <p class="price font-500 overflow-text-dots-one-line"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ $prod->unit_price_from }} - {{ $prod->unit_price_to }}   @else {{ $prod->target_price_from }} - {{ $prod->target_price_to }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                                    <p class="my-1 text-uppercase place-day">{{ get_product_city($prod->company_id) }}, {{$prod->origin}} <span class="ml-3">{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span></p>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 p-lg-2 p-0 ">
                                                    {{--                                        <div class="d-flex membersince">Member <span class="number">since</span><span class="years">{{get_product_created_at($prod->company_id)}}</span></div>--}}
                                                    <a href="{{route('about-us-suppliers',$prod->company_id)}}" class="text-reset text-decoration-none" @if(!Auth::check()) class="pre-login" @endif> <p class="mb-1 text-uppercase font-500 font-24">{{get_product_company($prod->company_id)}}</p></a>
                                                    <small class="d-block mb-2 grey-text">{{get_product_city($prod->company_id)}}, {{get_product_country($prod->company_id)}}</small>
                                                    <div class="membericon">
                                                        <a href="{{route('bizonair-404')}}" class="text-reset text-decoration-none">
                                                            <img alt="Premium Member" src="https://static.fibre2fashion.com/shared/membership/pm.png" title="Premium Member">
                                                        </a>
                                                    </div>
                                                    {{--                                        <div class="my-2 d-inline-block font-500 add-inquiry-basket" required="false">--}}
                                                    {{--                                            <span class="fa fa-plus mr-2" style="color: #A52C3E"></span>Add to Inquiry Basket--}}
                                                    {{--                                        </div>--}}
                                                    <div class="d-sm-inline-block my-1">
                                                        <a href="{{route('contact-us-suppliers',$prod->company_id)}}" class="pt-1 pb-1 pl-2 pr-2 red-btn"  @if(!Auth::check())  class="pre-login" @endif><span aria-hidden="true" class="fa fa-comments mr-2"></span>CONTACT</a>
                                                        <a href="#" class="pt-1 pb-1 pl-2 pr-2 red-btn"  @if(!Auth::check()) class="pre-login" @endif data-toggle="modal" data-target="#contactFormPDP">LEAVE A MESSAGE</a>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="contactFormPDP" tabindex="-1" role="dialog" aria-labelledby="contactForm" aria-hidden="true">
                                                            <div class="modal-dialog contact-form" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <span class="modal-title">Send Inquiry To Supplier</span>
                                                                        <button  class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
                                                                            <input type="hidden" class="form-control" value="{{\Auth::id()}}" name="userID">
                                                                            <input type="hidden" class="form-control" value="{{$prod->id}}" name="prodId">
                                                                            <input type="hidden" class="form-control" value="Lead" name="prodType">
                                                                            <input type="hidden" class="form-control" value="{{$prod->product_service_types}}" name="serviceTypes">
                                                                            <input type="hidden" class="form-control" value="{{$prod->reference_no}}" name="referenceNo">
                                                                            <div class="form-row">
                                                                                <div class="form-group col-md-6">
                                                                                    <input type="text" class="form-control" id="contactName" name="contactName" placeholder="Contact Name" required="required">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Company Name" required="required">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-row">
                                                                                <div class="form-group col-md-6">
                                                                                    <input type="number" class="form-control" id="contactNumber" name="contactNumber" placeholder="Contact Number" required="required">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <input type="email" class="form-control" id="emailId" name="emailId" placeholder="E-mail" required="required">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-row">
                                                                                <div class="form-group col-md-6">
                                                                                    <select name="country" class="form-control" id="country" required="required">
                                                                                        <option value="" selected disabled>--- Country ---</option>
                                                                                        @foreach (\App\Country::all() as $item)

                                                                                            <option value="{{$item->country_name}}">{{$item->country_name}}</option>

                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <input type="text" class="form-control" id="city" name="city" placeholder="City" required="required">
                                                                                </div>
                                                                            </div>

                                                                            <div id="totalCharLeft">1000 characters remaining</div>
                                                                            <textarea id="description" class="mb-4 textarea-box form-control" name="description" placeholder="Describe Your Requirement..." maxlength="1000"></textarea>

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
                                                                                    </ul>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group ticks-checkbox mt-3 mb-3">
                                                                                <ul data-toggle="buttons" class="mb-0">
                                                                                    <li class="w-100 btn d-flex">
                                                                                        <input class="input fa fa-square-o" type="checkbox" id="termsCheckbox" name="terms_condition" value="Terms & Conditions">
                                                                                        <div>Please refer our <a href="#" class="text-link">Privacy Policy</a> and <a href="#" class="text-link">Terms & Conditions</a> before submitting your information</div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>

                                                                            <input type="submit" class="btn submit-btn" id="inquiry_create_btn" value="Send Inquiry Now" disabled>

                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal -->
                                                    </div>
                                                </div>
{{--                                                <div class="w-100 mt-lg-0 mt-2 d-flex flex-lg-row flex-column justify-content-lg-around align-items-center" >--}}
{{--                                                    <a href="{{route('other-product-this-supplier',['subcategory'=>get_sub_category_slug($prod->subcategory_id),'company'=>$prod->company_id])}}" class="text-decoration-none red-link">Other products from this--}}
{{--                                                        Supplier</a>--}}
{{--                                                    <a href="{{route('similar-product-this-supplier',[get_sub_category_slug($prod->subcategory_id),$prod->company_id])}}" class="text-decoration-none red-link">Similar product from this--}}
{{--                                                        Supplier</a>--}}
{{--                                                </div>--}}
                                                <div class="w-100 mt-lg-0 mt-2 d-flex flex-lg-row flex-column justify-content-lg-around align-items-center" >

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="ml-1 mr-1 row product-content-container">
                                        <p class="mb-0 py-2 px-2">No Product Found Related To This Category...</p>
                                    </div>
                                @endif
                            </div>
                            <div align="center" class="my-2">
                                <a href="#" class="load-more red-btn">Load More<span class="ml-2 fa fa-spinner" aria-hidden="true"></span></a>
                            </div>
                            {{--                            {{ $products->links() }}--}}
                        </div>

                        <div class="h-auto col-xl-2 col-lg-3 col-md-4 pl-sm-3 px-0 half-side-content">
                            <h3 class="text-center main-heading">TOP COMPANIES</h3>
                            <div class="h-auto position-relative top-companies">
                                @foreach($topcompanies as $comp)
                                    <div class="top-companies-card">
                                        <a class="text-reset text-decoration-none" href="{{route('about-us-suppliers',['id'=>$comp->id,'company'=>$comp->company_name])}}">
                                            <img class="w-100" alt="100x100" src="{{$comp->logo }}"
                                                 data-holder-rendered="true">
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
