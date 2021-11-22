@extends('front_site.master_layout')

@push('css')
    <style>
        @media (max-width: 575px) {
            .place-day .place, .place-day .place + span {
                font-size: 10px;
            }
        }
    </style>
@endpush

@section('content')



<body class="product-main product-details product-listing">

  <main id="maincontent" class="details-comparison">

    @include('front_site.common.product-banner')

    <div class="main-container">

      <div class="container-fluid px-2 py-2">

        @include('front_site.common.garments-nav')

          <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Garment</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="{{Request::url()}}">Product</a></li>
              </ol>
          </nav>

          <div class="container-fluid">

              <div class="table-responsive table-bordered table-mt mt-3 products-compare">
                  <table class="table table-borderless" border="0" align="center" cellpadding="5" cellspacing="15" id="ProductCompareList">
                      <tbody>
                      <tr>
                          <td width="175" valign="top" class="name-product-heading">
                              <table class="table table-borderless mb-0" width="100%" border="0" cellspacing="0" cellpadding="0" class="mb-0 table">
                                  <tbody>
                                  <tr>
                                      <td width="75" height="241" valign="top"><b class="product-info-headings text-left"><strong>Name
                                                  of Products</strong></b></td>
                                  </tr>
                                  <tr>
                                      <td><b class="product-info-headings text-left">Price</b></td>
                                  </tr>
                                  <tr>
                                      <td><b class="product-info-headings text-left">Product Availability</b></td>
                                  </tr>
                                  <tr>
                                      <td><b class="product-info-headings text-left">Location</b></td>
                                  </tr>
                                  </tbody>
                              </table>
                          </td>
                          @if((isset($viewproduct) && count($viewproduct)) > 0)
                              @foreach($viewproduct as $key=> $prod)
                                  <td width="170" class="product-info-container" valign="top" data-productleadvalue="20175873">
                                      <table class="table table-borderless mb-0" width="100%" cellspacing="2" cellpadding="0" class="mb-0 table">
                                          <tbody>
                                          <tr>
                                              <td width="100" height="241" bgcolor="#fff" align="center">
                                                  <div align="right">
                                                      <span class="mb-2 fa fa-times cross-icon" aria-hidden="true" id="cross" reference_no="{{$prod->reference_no}}"></span>
                                                  </div>
                                                  <div class="productsweek-img">

                                                      <div class="MainCompareProduct">
                                                          @foreach($prod->product_image as $j => $image)
                                                              @if(!empty($image))
                                                                  <a href="{{ route('productDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                                      <img class="img-responsive" alt="product" src="{{ $image->image }}"  width="170" title="product">
                                                                  </a>
                                                                  @if($j==0)
                                                                      @break
                                                                  @endif
                                                              @else
                                                                  <img class="img-responsive" alt="product" src="{{$ASSET}}/front_site/images/noimage.png"  width="170" title="product">
                                                              @endif
                                                          @endforeach
                                                      </div>

                                                      <br>
                                                      <div>
                                                          <a class="text-decoration-none font-500 red-link" href="#">{{ $prod->product_service_name }}</a>
                                                      </div>
                                                      <br>


                                                      <a @if(!Auth::check()) href="{{url('login')}}" @else data-toggle="modal" data-target="#contactFormPDP" @endif class="d-inline-block red-btn"  class="btns">SEND</a>
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
                                                                      <form id="postInquiry" method="POST" action="{{route('post-inquiry')}}">
                                                                          @csrf
                                                                          <input type="hidden" class="form-control" @if(auth()->check()) value="{{\Auth::id()}}" @endif name="userID">
                                                                          <input type="hidden" class="form-control" value="{{$prod->id}}" name="prodId">
                                                                          <input type="hidden" class="form-control" value="Lead" name="prodType">
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
                                                                                      <input type="checkbox" class="custom-control-input" name="sample_with_specification_sheet" id="sample_with_specification_sheet">
                                                                                      <label class="text-left text-white font-weight-100 custom-control-label" for="sample_with_specification_sheet">Sample with specification sheet</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="mb-0 form-group">
                                                                                  <div class="custom-control custom-checkbox">
                                                                                      <input type="checkbox" class="custom-control-input" name="latest_price_quotation" id="latest_price_quotation">
                                                                                      <label class="text-left text-white font-weight-100 custom-control-label" for="latest_price_quotation">Latest Price Quotation</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="mb-0 form-group">
                                                                                  <div class="custom-control custom-checkbox">
                                                                                      <input type="checkbox" class="custom-control-input" name="compliance_certification_required" id="compliance_certification_required">
                                                                                      <label class="text-left text-white font-weight-100 custom-control-label" for="compliance_certification_required">Compliance certification required</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="mb-0 form-group">
                                                                                  <div class="custom-control custom-checkbox">
                                                                                      <input type="checkbox" class="custom-control-input" name="preferred_payment_terms" id="preferred_payment_terms">
                                                                                      <label class="text-left text-white font-weight-100 custom-control-label" for="preferred_payment_terms">Preferred payment terms</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="mb-0 form-group">
                                                                                  <div class="custom-control custom-checkbox">
                                                                                      <input type="checkbox" class="custom-control-input" name="production_capacity" id="production_capacity">
                                                                                      <label class="text-left text-white font-weight-100 custom-control-label" for="production_capacity">Production Capacity</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="mb-0 form-group">
                                                                                  <div class="custom-control custom-checkbox">
                                                                                      <input type="checkbox" class="custom-control-input" name="qcis" id="qcis">
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
                                              </td>
                                          </tr>

                                          <tr>
                                              <td bgcolor="#fff">

                                                  {{--                                                        {{ $prod->min_order_quantity }}--}}
                                                  <p class="price font-500"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ number_format($prod->unit_price_from) }} - {{ number_format($prod->unit_price_to) }}   @else {{ number_format($prod->target_price_from) }} - {{ number_format($prod->target_price_to) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                              </td>
                                          </tr>
                                          <tr>

                                              <td bgcolor="#fff">
                                                  <p class="mb-0">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td bgcolor="#fff">
                                                  <div class="d-flex justify-content-between text-uppercase place-day">
                                                      <span class="place">{{ $prod->city }}, {{ $prod->country }}</span>
                                                      <span>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span>
                                                  </div>
                                              </td>
                                          </tr>

                                          </tbody>
                                      </table>

                                  </td>
                              @endforeach
                          @elseif((isset($viewbuysell) && count($viewbuysell)) > 0)
                              @foreach($viewbuysell as $key=> $prod)
                                  <td width="170" class="product-info-container" valign="top" data-productleadvalue="20175874">
                                      <table class="table table-borderless mb-0" width="100%" cellspacing="2" cellpadding="0" class="mb-0 table">
                                          <tbody>
                                          <tr>
                                              <td width="100" height="241" bgcolor="#fff" align="center">
                                                  <div align="right">
                                                      <span class="mb-2 fa fa-times cross-icon" aria-hidden="true" id="cross" reference_no="{{$prod->reference_no}}"></span>
                                                  </div>
                                                  <div class="productsweek-img">

                                                      <div class="MainCompareProduct">
                                                          <?php $img = \DB::table('buysell_images')->where('buy_sell_id',$prod->id)->get();?>
                                                          @if($img->isNotEmpty())
                                                              @foreach($img as $i => $image)
                                                                  @if($loop->first)
                                                                      <a href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                                          <img class="img-responsive" alt="product" src="{{ $image->image }}"  width="170" title="product">
                                                                      </a>
                                                                  @endif
                                                              @endforeach
                                                          @else
                                                              <img class="img-responsive" alt="product" src="{{$ASSET}}/front_site/images/noimage.png"  width="170" title="product">
                                                          @endif
                                                      </div>

                                                      <br>
                                                      <div>
                                                          <a class="text-decoration-none font-500 red-link" href="#">{{ $prod->product_service_name }}</a>
                                                      </div>
                                                      <br>


                                                      <a @if(!Auth::check()) href="{{url('login')}}" @else data-toggle="modal" data-target="#contactFormPDP" @endif class="d-inline-block red-btn"  class="btns">SEND</a>
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
                                                                                      <label class="custom-file-label" for="customFile"><span class="fa fa-upload"></span></label>
                                                                                      <small class="text-danger" id="image_error"></small>
                                                                                  </div>
                                                                              </div>
                                                                          </div>

                                                                          <div align="left">
                                                                              <div class="mb-0 form-group">
                                                                                  <div class="custom-control custom-checkbox">
                                                                                      <input type="checkbox" class="custom-control-input" name="sample_with_specification_sheet" id="sample_with_specification_sheet">
                                                                                      <label class="text-left text-white font-weight-100 custom-control-label" for="sample_with_specification_sheet">Sample with specification sheet</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="mb-0 form-group">
                                                                                  <div class="custom-control custom-checkbox">
                                                                                      <input type="checkbox" class="custom-control-input" name="latest_price_quotation" id="latest_price_quotation">
                                                                                      <label class="text-left text-white font-weight-100 custom-control-label" for="latest_price_quotation">Latest Price Quotation</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="mb-0 form-group">
                                                                                  <div class="custom-control custom-checkbox">
                                                                                      <input type="checkbox" class="custom-control-input" name="compliance_certification_required" id="compliance_certification_required">
                                                                                      <label class="text-left text-white font-weight-100 custom-control-label" for="compliance_certification_required">Compliance certification required</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="mb-0 form-group">
                                                                                  <div class="custom-control custom-checkbox">
                                                                                      <input type="checkbox" class="custom-control-input" name="preferred_payment_terms" id="preferred_payment_terms">
                                                                                      <label class="text-left text-white font-weight-100 custom-control-label" for="preferred_payment_terms">Preferred payment terms</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="mb-0 form-group">
                                                                                  <div class="custom-control custom-checkbox">
                                                                                      <input type="checkbox" class="custom-control-input" name="production_capacity" id="production_capacity">
                                                                                      <label class="text-left text-white font-weight-100 custom-control-label" for="production_capacity">Production Capacity</label>
                                                                                  </div>
                                                                              </div>
                                                                              <div class="mb-0 form-group">
                                                                                  <div class="custom-control custom-checkbox">
                                                                                      <input type="checkbox" class="custom-control-input" name="qcis" id="qcis">
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
                                              </td>
                                          </tr>

                                          <tr>
                                              <td bgcolor="#fff">

                                                  {{--                                                        {{ $prod->min_order_quantity }}--}}
                                                  <p class="price font-500"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ number_format($prod->unit_price_from) }} - {{ number_format($prod->unit_price_to) }}   @else {{ number_format($prod->target_price_from) }} - {{ number_format($prod->target_price_to) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                              </td>
                                          </tr>
                                          <tr>

                                              <td bgcolor="#fff">
                                                  <p class="mb-0">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td bgcolor="#fff">
                                                  <div class="d-flex justify-content-between text-uppercase place-day">
                                                      <span class="place">{{ $prod->city }}, {{ $prod->country }}</span>
                                                      <span>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span>
                                                  </div>
                                              </td>
                                          </tr>

                                          </tbody>
                                      </table>

                                  </td>
                              @endforeach
                          @else
                              <td width="170" class="product-info-container" valign="top" data-productleadvalue="20175873">
                                  <table class="table table-borderless mb-0" width="100%" cellspacing="2" cellpadding="0" class="mb-0 table">
                                      <tbody>
                                      <tr>
                                          <td width="100" height="241" bgcolor="#fff" align="center"><p>No Product Found To Compare...</p></td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </td>
                          @endif

                      </tr>
                      {{--                                <tr>--}}
                      {{--                                <td colspan="6" valign="middle" bgcolor="#f7f8fa">--}}
                      {{--                                    <table class="table table-borderless" width="100%" border="0" cellspacing="0" cellpadding="0"--}}
                      {{--                                           class="CompareSendInquiry">--}}
                      {{--                                        <tbody>--}}
                      {{--                                        <tr>--}}
                      {{--                                            <td width="300"><h4 class="product-info-headings text-left">Collective Inquiry</h4></td>--}}
                      {{--                                            <td width="444"  class="pt-2 pb-2">--}}
                      {{--                                                <div class="d-inline-block custom-control custom-checkbox">--}}
                      {{--                                                    <input type="checkbox" value="selectAll" class="custom-control-input"--}}
                      {{--                                                           id="selectAll">--}}
                      {{--                                                    <label class="custom-control-label" for="selectAll">Select All</label>--}}
                      {{--                                                </div>--}}
                      {{--                                                <a class="ml-3 pl-2 pr-2 pt-1 pb-1 red-btn"><small>Send Inquiry</small></a>--}}
                      {{--                                            </td>--}}
                      {{--                                            <td width="275">&nbsp;</td>--}}
                      {{--                                            <td width="278">&nbsp;</td>--}}
                      {{--                                        </tr>--}}
                      {{--                                        </tbody>--}}
                      {{--                                    </table>--}}
                      {{--                                </td>--}}
                      {{--                            </tr>--}}
                      </tbody>
                  </table>
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
        $(document).delegate('#cross', 'click', function(e) {
            e.preventDefault();

            var reference_no=$(this).attr("reference_no");
            var token='{{csrf_token()}}';

            $.ajax({
                type:'DELETE',
                url: '{{ url('/compare-product-deleted-ajax') }}' + '/' + reference_no,
                data:{reference_no:reference_no,_token:token},
                cache: false,
                success: function(response) {
                    console.log(response);


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
