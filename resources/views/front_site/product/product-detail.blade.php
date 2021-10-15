@extends('front_site.master_layout')

@section('content')


<body class="product-main product-details">
  <main id="maincontent" class="page-main">

    <div class="main-container">
      <div class="container-fluid px-2 py-2">

         @include('front_site.common.garments-nav')

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('business-products/fibers-and-materials') }}">Textile Business</a></li>
                <li class="breadcrumb-item"><a href="{{ url('business-products/'.$category->slug) }}">{{ucfirst($category->name)}}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('business-products/'.$category->slug.'/'.$sub_category->slug.'/regular-suppliers') }}">{{ucfirst($sub_category->name)}}</a></li>
            </ol>
        </nav>

        <div class="mini-content-container">
          <div class="row mx-0 mb-md-3 mb-2 box-shadow top-banner-content">
            <div class="col-lg-9 col-md-12">
              <div class="row">
                <div class="px-1 col-lg-6 col-md-6 suppliers-buyers">
                  <ul id="left-thumb-slider">
                     @foreach(ProductHelper::getImages($product->id) as $image)
                    <li data-thumb="{{$ASSETS}}/{{$image->image}}" class="position-relative suppliers-buyers">
                      <!-- {{asset($image->image)}} -->
                    <img  src="{{$ASSETS}}/{{$image->image}}" class="w-100 h-100 object-contain" style="border: 1px solid #BABABA">
                      <div class="position-absolute heart-icon-div">
                          <a class="text-decoration-none text-reset" href="#add-fav-{{$product->reference_no}}" data-toggle="modal">
                           <span class="text-decoration-none add-to-fav">
                                    <span class="@if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$product->reference_no])->exists()) check-heart fa fa-heart @else check-heart fa fa-heart-o @endif"></span>
                           </span>
                          </a>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                </div>
                  <div id="add-fav-{{$product->reference_no}}" class="change-password-modal modal fade">
                      <div class="modal-dialog modal-dialog-centered modal-login">
                          <div class="modal-content">
                              <div class="modal-header">
                                  @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$product->reference_no])->exists())
                                      <span class="modal-title">REMOVE FROM FAVOURITE</span>
                                  @else
                                      <span class="modal-title">ADD TO FAVOURITE</span>
                                  @endif
                                  <a class="close red-btn" data-dismiss="modal" aria-hidden="true">&times;</a>
                              </div>
                              <div class="modal-body pt-3">
                                  @if(\DB::table('favourites')->where(['user_id'=>auth()->id(),'reference_no'=>$product->reference_no])->exists())
                                      <p style="color: white">Are you sure your product will be removed from the favourite</p>
                                  @else
                                      <p style="color: white">A notification will be sent to supplier/buyer to contact you back</p>
                                  @endif
                                  <div class="form-group mt-4 mb-0">
                                      <button @if(Auth::check()) class="red-btn add-to-favourite" data-dismiss="modal" prod_id="{{$product->id}}" product_service_name="{{$product->product_service_name}}" product_service_types="{{$product->product_service_types}}" reference_no="{{$product->reference_no}}"  @else class="red-btn" data-dismiss="modal" data-toggle="modal" data-target="#login-form" @endif type="submit">Yes</button>
                                      <button class="red-btn" data-dismiss="modal" aria-hidden="true">No</button>

                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                <div class="px-1 d-flex flex-column justify-content-sm-between col-lg-6 col-md-6 mt-md-0 mt-1 contact-product-info">
                  <span class="product-title heading">{{$product->product_service_name}}</span>
                    <p><span class="font-500" style="color: #000">Reference No: </span>{{$product->reference_no}}</p>
                    <p style="margin-bottom: 4px"><span class="font-500" style="color: #000">Regular Business Lead: </span> {{$product->product_service_types}}</p>
                    <p class="product-details">{{$product->details}}</p>
                  <div class="d-flex justify-content-sm-start justify-content-center btns-block">
                      <a href="#" class="p-0 btns"  @if(!Auth::check()) data-toggle="modal" data-target="#login-form" @endif data-toggle="modal" data-target="#contactFormPDP"><span class="red-btn d-inline-block py-1 px-2" data-placement="bottom" title="Send an Inquiry to company on Bizonair portal" data-toggle="tooltip">MESSAGE</span></a>
                      <a href="#productInfoSection"  class="p-0 btns product-info-btn"><span class="red-btn d-inline-block py-1 px-2">PRODUCT INFO</span></a>
                      <a href="{{route('contact-us-suppliers',$product->company_id)}}" class="p-0 btns"  @if(!Auth::check()) data-toggle="modal" data-target="#login-form" @endif><span class="red-btn d-inline-block py-1 px-2" data-placement="bottom" title="Send an Email to company" data-toggle="tooltip">CONTACT</span></a>
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
                                          <input type="hidden" class="form-control" value="{{$product->id}}" name="prodId">
                                          <input type="hidden" class="form-control" value="Lead" name="prodType">
                                          <input type="hidden" class="form-control" value="{{$product->product_service_types}}" name="serviceTypes">
                                          <input type="hidden" class="form-control" value="{{$product->reference_no}}" name="referenceNo">
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
                                                  <select name="city" id="city" required class="form-control">
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
                                          <button type="submit" class="btn submit-btn" id="inquiry_create_btn" disabled>Send Inquiry Now</button>
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
                    <p class="my-1"><span class="font-500" style="color: #000">Note :</span> By clicking favourite, a notification will be sent to the Supplier/Buyer</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-12 mt-lg-0 mt-md-3 mt-0 px-0">
                @if(auth()->user())
                    <div class="supplier-info">
                        <div class="position-relative">

                            <div class="d-flex membersince">Member <span class="number">since</span><span class="years">{{get_product_created_at($product->company_id)}}</span></div>
                            <div class="position-absolute top-0 right-0 membericon">
                                <a href="http://localhost/bizonair-database/404">
                                    <img alt="Premium Member" src="{{$ASSETS}}/assets/front_site/images/leads-membership.png"   title="We are working on this feature and will enable this soon" data-toggle="tooltip" data-placement="bottom" data-toggle="tooltip" data-placement="bottom" style="width: 30px;height: 30px">
                                </a>
                            </div>
                        </div>
                        <small class="overflow-text-dots-one-line"><span class="font-500">Supplier Name: </span><span> <a href="{{route('about-us-suppliers',$product->company_id)}}" class="text-reset"> {{get_product_company($product->company_id)}}</a></span></small>
                        <small class="d-block grey-text font-500">{{get_product_city($product->company_id)}}, {{get_product_country($product->company_id)}}</small>
                        <small class="d-flex mb-1 grey-text number-content">
                            <span class="font-500">Contact:</span>
                            <span class="d-inline-block mx-1 show">***********</span>
                            <span class="d-none mx-1 hidden">{{ $product->phone??''}}</span>
                            <span class="cursor-pointer blue-color font-500 hide-show-number" style="border-bottom: 1px dashed">Show</span>
                        </small>
                        <p class="add-connect"><span class="fa fa-address-book" aria-hidden="true"></span><a class="text-decoration-none text-reset" title="We are working on this feature and will enable this soon" data-toggle="tooltip" data-placement="bottom">Add To My Connection</a></p>
                        <div id="add-connection" class="change-password-modal modal fade">
                            <div class="modal-dialog modal-dialog-centered modal-login">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span class="modal-title">ADD TO MY CONNECTION</span>
                                        <a class="close red-btn" data-dismiss="modal" aria-hidden="true">&times;</a>
                                    </div>
                                    <div class="modal-body pt-3">
                                        <p style="color: white">we are working on this feature and we will enable this soon..</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="supplier-info">
                        <div class="login-info">
                            <span class="fa fa-exclamation"></span>
                            <div class="login-info-inner">
                                <p><a href="" data-toggle="modal" data-target="#login-form" class="font-500 register-text">Log in</a> To View More Information.
                                <span class="font-500" style="color: #000">Not a member? </span><a href="{{route('email-confirmation')}}" target="_blank" class="font-500 register-text">Register Now!</a></p>
                            </div>
                        </div>
                    </div>

                @endif
            </div>
          </div>

          <div class="row m-0">
            <div class="px-0 col-xl-12 col-lg-12 col-md-12">

              <div class="switch-tabs" id="productInfoSection">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#productInfo">PROD INFO</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tradeInfo">PROD SPECIFICATIONS</a>
                  </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="productInfo" class="tab-pane product-tab active">
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Lead Type : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">@if($product->product_service_types == 'Service') Service Provider @else {{ $product->product_service_types }} @endif</p>
                          </div>
                      </div>
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Main Category : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ $product->category->name }}</p>
                          </div>
                      </div>
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Sub-Category : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ $product->subcategory->name }}</p>
                          </div>
                      </div>
                      @if($product->childsubcategory)
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Product Type : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ $product->childsubcategory->name }}</p>
                          </div>
                      </div>
                      @endif
                      @if(!empty($product->add_sub_sub_category))
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Other Product Type : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ $product->add_sub_sub_category }}</p>
                          </div>
                      </div>
                      @endif
                      @if(!empty($product->add_sub_sub_category))
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Reference Number : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ $product->reference_no }}</p>
                          </div>
                      </div>
                      @endif
                      @if(!empty($product->add_sub_sub_category))
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Subject : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ $product->subject }}</p>
                          </div>
                      </div>
                      @endif
                      @if(!empty($product->add_sub_sub_category))
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Product Name : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ $product->product_service_name }}</p>
                          </div>
                      </div>
                      @endif
                      @if(!empty($product->add_sub_sub_category))
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Keyword For Search : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ $product->keywords }}</p>
                          </div>
                      </div>
                      @endif
                      @if(!empty($product->add_sub_sub_category))
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Product Availability : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">@if($product->product_availability =='Both') In-Stock/Made to order @else {{$product->product_availability ?: ''}}@endif</p>
                          </div>
                      </div>
                      @endif
                      @if(!empty($product->add_sub_sub_category))
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Manufacturer Name : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{$manu->company_name ?: ''}}</p>
                          </div>
                      </div>
                      @endif
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Origin : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ $product->origin }}</p>
                          </div>
                      </div>
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Additional Info : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ $product->details }}</p>
                          </div>
                      </div>

                    <span class="heading">ADDITIONAL PRODUCT INFO</span>
                      @if(!empty($product->fiber_product_info->fiber_type))
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Fibre Type : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->fiber_product_info->fiber_type == 'Other') {{$product->fiber_product_info->other_fiber_type ?: ''}} @else  {{$product->fiber_product_info->fiber_type ?: ''}} @endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Fibre Size : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->fiber_product_info->size ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Fibre Strength : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->fiber_product_info->strength ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>End Use : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->fiber_product_info->end_use ?: ''}}</p>
                              </div>
                          </div>
                      @endif
                      @if(!empty($product->fabric_product_info->fabric_types))
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Fabric Type : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->fabric_product_info->fabric_types =='Other') {{$product->fabric_product_info->other_fabric_type ?: ''}} @else {{$product->fabric_product_info->fabric_types ?: ''}} @endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Knitting Type : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->fabric_product_info->knitting_type =='Other') {{$product->fabric_product_info->other_knitting_type ?: ''}} @else {{$product->fabric_product_info->knitting_type ?: ''}} @endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Fabric Construction : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->fabric_product_info->fabric_construction ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>GSM/Thickness : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->fabric_product_info->gsm_thickness ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Fabric Composition : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->fabric_product_info->fabric_composition ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Width Range : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->fabric_product_info->width_from ?: ''}} To {{$product->fabric_product_info->width_to ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Manufacturing Technique : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->fabric_product_info->manufacturing_technique =='Other') {{$product->fabric_product_info->other_manufacturing_technique ?: ''}} @else {{$product->fabric_product_info->manufacturing_technique ?: ''}} @endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Yarn Type : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->fabric_product_info->yarn_type =='Other') {{$product->fabric_product_info->other_yarn_type ?: ''}} @else {{$product->fabric_product_info->yarn_type ?: ''}} @endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Features : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->fabric_product_info->features =='Other') {{$product->fabric_product_info->other_feature ?: ''}} @else {{$product->fabric_product_info->features ?: ''}} @endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>End Use/Application : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->fabric_product_info->uses =='Other') {{$product->fabric_product_info->other_use ?: ''}} @else {{$product->fabric_product_info->uses ?: ''}} @endif</p>
                              </div>
                          </div>
                      @endif
                      @if(!empty($product->yarn_product_info->count))
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Yarn Count : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->yarn_product_info->count ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Yarn Count Unit : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->yarn_product_info->count_unit =='Other') {{$product->yarn_product_info->other_count_unit ?: ''}} @else {{$product->yarn_product_info->count_unit ?: ''}} @endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Yarn Attribute : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->yarn_product_info->attribute=='Other') {{$product->yarn_product_info->other_attribute ?: ''}} @else{{$product->yarn_product_info->attribute ?: ''}}@endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Technology : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->yarn_product_info->technology=='Other') {{$product->yarn_product_info->other_technology ?: ''}} @else{{$product->yarn_product_info->technology ?: ''}}@endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Yarn Grade : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->yarn_product_info->grade ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>TPI : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->yarn_product_info->tpi ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Tenacity  : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->yarn_product_info->tenacity ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Count Type : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->yarn_product_info->count_type=='Other') {{$product->yarn_product_info->other_count_type ?: ''}} @else{{$product->yarn_product_info->count_type ?: ''}}@endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Yarn Speciality : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->yarn_product_info->yarn_specialty=='Other') {{$product->yarn_product_info->other_speciality ?: ''}} @else {{$product->yarn_product_info->yarn_specialty ?: ''}}@endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>End Use/Application : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->yarn_product_info->end_use=='Other') {{$product->yarn_product_info->other_end_use ?: ''}} @else {{$product->yarn_product_info->end_use ?: ''}}@endif</p>
                              </div>
                          </div>
                      @endif
                      @if(!empty($product->machinery_product_info->product_type))
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Machinery Type : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->machinery_product_info->product_type ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Condition  : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->machinery_product_info->machinery_condition ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>After Sales Service : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->machinery_product_info->after_sales_service=='Yes') {{$product->machinery_product_info->service_type ?: ''}} @else{{$product->machinery_product_info->after_sales_service ?: ''}}@endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Warranty  : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->machinery_product_info->warranty=='Yes') {{$product->machinery_product_info->warranty_period ?: ''}} @else{{$product->machinery_product_info->warranty ?: ''}}@endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Product Certification : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->machinery_product_info->certification =='Yes'){{$product->machinery_product_info->certification_details ?: ''}} @else {{$product->machinery_product_info->certification ?: ''}}@endif</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Additional Trade notes : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->machinery_product_info->additional_trade_notes ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Company Certification  : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->machinery_product_info->product_related_certifications ?: ''}}</p>
                              </div>
                          </div>
                      @endif
                      @if(!empty($product->institutional_product_info->material))
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Material Type : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->institutional_product_info->material ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Composition/Construction : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->institutional_product_info->composition ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Size/Age Group : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->institutional_product_info->size_age ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Color  : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->institutional_product_info->color ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Gender : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->institutional_product_info->gender ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Thickness/GSM/Width : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->institutional_product_info->thickness ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Brand  : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->institutional_product_info->brand ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Design/Style : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->institutional_product_info->design ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Season : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->institutional_product_info->season ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>End Use/Application : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->institutional_product_info->end_use ?: ''}}</p>
                              </div>
                          </div>
                      @endif
                      @if(!empty($product->chemicals_product_infos))
                      @foreach ($product->chemicals_product_infos as $key => $object)
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Manufacturer Company {{$key+1}}: </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$object->manufacturer_company_name ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Origin  : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$object->origin ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Chemicals listed : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$object->chemicals_listed ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Additional Information  : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$object->company_additional_info ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Supply type : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$object->supply_type ?: ''}}</p>
                              </div>
                          </div>
                      @endforeach
                      @endif
                      @if(!empty($product->garments_product_info->material))
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Material Type : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->garments_product_info->material ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Composition/Construction : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->garments_product_info->composition ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Size/Age Group : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->garments_product_info->size_age ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Color  : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->garments_product_info->color ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Gender : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->garments_product_info->gender ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Thickness/GSM/Width : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->garments_product_info->thickness ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Brand  : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->garments_product_info->brand ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Design/Style : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->garments_product_info->design ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Season : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->garments_product_info->season ?: ''}}</p>
                              </div>
                          </div>
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>End Use/Application : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->garments_product_info->end_use ?: ''}}</p>
                              </div>
                          </div>
                      @endif

                      <span class="heading">TRADE INFO</span>
                      @if($product->dealing_as)
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Dealing Product As : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{$product->dealing_as ?: ''}}</p>
                          </div>
                      </div>
                      @endif
                      @if($product->focused_selling_region)
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Target Selling Region : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{ $product->focused_selling_region }}</p>
                              </div>
                          </div>
                      @endif
                      @if($product->focused_selling_countries)
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Target Selling Country : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{ str_replace(',', ', ', $product->focused_selling_countries) }}</p>
                              </div>
                          </div>
                      @endif
                      @if($product->production_capacity)
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Production Capacity : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{ $product->production_capacity }}</p>
                              </div>
                          </div>
                      @endif
                      @if($product->min_order_quantity)
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Min Order Quantity : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{ $product->min_order_quantity }}</p>
                              </div>
                          </div>
                      @endif
                      @if($product->is_sampling)
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Sampling : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->is_sampling) Yes @elseif(!$product->is_sampling) No @endif</p>
                              </div>
                          </div>
                      @endif
                      @if($product->is_sampling)
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Sampling Cost : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{ $product->sampling_type }}</p>
                              </div>
                          </div>
                      @endif
                      @if($product->sampling_type == 'Paid')
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Sampling Price : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{ $product->paid_sampling_price }}</p>
                              </div>
                          </div>
                      @endif

                    <span class="heading">Payment & Delivery Info</span>
                      @if($product->product_service_types == "Buy")
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Target Price Range : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->suitable_currencies){{ str_replace(',', ', ', $product->suitable_currencies) }}@endif {{ $product->target_price_from }} - {{ $product->target_price_to }} Per {{ ($product->target_price_unit != 'Other') ? $product->target_price_unit : $product->other_target_price_unit }}</p>
                              </div>
                          </div>
                      @endif
                      @if($product->product_service_types == "Sell")
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Unit Price Range : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">@if($product->suitable_currencies){{ str_replace(',', ', ', $product->suitable_currencies) }}@endif {{ $product->unit_price_from }} - {{ $product->unit_price_to }} Per {{ ($product->unit_price_unit != 'Other') ? $product->unit_price_unit : $product->other_unit_price_unit }}</p>
                              </div>
                          </div>
                      @endif
                      @if($product->product_service_types == "Service")
                        <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Service Charges Range : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">@if($product->suitable_currencies){{ str_replace(',', ', ', $product->suitable_currencies) }}@endif{{ $product->unit_price_from }} - {{ $product->unit_price_to }} Per {{ ($product->unit_price_unit != 'Other') ? $product->unit_price_unit : $product->other_unit_price_unit }}</p>
                          </div>
                        </div>
                        <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Service Duration : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ str_replace(',', ', ', $product->service_durations) }}</p>
                          </div>
                        </div>
                        @if(in_array("Other", explode(",", $product->service_durations)))
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Other Service Duration : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{ $product->other_service_duration }}</p>
                              </div>
                          </div>
                        @endif
                      @else
                          @if($product->delivery)
                              <div class="row text mx-0">
                                  <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                      <span><b>Delivery : </b></span>
                                  </div>
                                  <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                      <p class="mb-0">{{ $product->delivery }}</p>
                                  </div>
                              </div>
                          @endif
                          @if($product->delivery_time)
                              <div class="row text mx-0">
                                  <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                      <span><b>Lead Time :</b></span>
                                  </div>
                                  <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                      <p class="mb-0">{{ $product->delivery_time }}</p>
                                  </div>
                              </div>
                          @endif
                      @endif
                      @if(in_array("Other", explode(",", $product->suitable_currencies)))
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Suitable Currency : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{ $product->other_suitable_currency }}</p>
                              </div>
                          </div>
                      @else
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Suitable Currency : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{$product->suitable_currencies }}</p>
                              </div>
                          </div>
                      @endif
                      <div class="row text mx-0">
                          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                              <span><b>Payment Terms : </b></span>
                          </div>
                          <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                              <p class="mb-0">{{ str_replace(',', ', ', $product->payment_terms) }}</p>
                          </div>
                      </div>
                      @if(in_array("Other", explode(",", $product->payment_terms)))
                          <div class="row text mx-0">
                              <div class="col-xl-3 col-lg-4 col-sm-6 col-6 pl-0 pr-1">
                                  <span><b>Other Payment Terms : </b></span>
                              </div>
                              <div class="col-xl-9 col-lg-8 col-sm-6 col-6 pl-1 pr-0">
                                  <p class="mb-0">{{ $product->other_payment_term }}</p>
                              </div>
                          </div>
                      @endif
                    </div>
                  <div id="tradeInfo" class="tab-pane product-tab fade">

                      <div class="product-img-spec-container">
                          <h6 class="mt-3 px-2 heading pro-spec-heading">Product Specifications</h6>
                          <div class="product-images-gallery">
                              <ul class="row mx-0 my-2 product-gallery">
                                  @foreach(ProductHelper::getSheets($product->id) as $file)
                                      <?php $pathinfo = pathinfo($file->sheet);
                                      $supported_ext = array('docx', 'xlsx', 'pdf');
                                      $src_file_name = $file->sheet;
                                      $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                      @if($ext=="docx")
                                          <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center"
                                              data-src="{{$ASSETS}}/{{$file->sheet}}"
                                              data-pinterest-text="Pin it"
                                              data-tweet-text="share on twitter">
                                              <img class="img-responsive product-img"
                                                   src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png"
                                                   style="filter: brightness(0.5)">
                                              <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                              <button
                                                  class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                          </li>
                                      @elseif($ext=="xlsx")
                                          <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center"
                                              data-src="{{$ASSETS}}/{{$file->sheet}}"
                                              data-pinterest-text="Pin it"
                                              data-tweet-text="share on twitter">
                                              <img class="img-responsive product-img"
                                                   src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png"
                                                   style="filter: brightness(0.5)">
                                              <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                <button
                                                  class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                          </li>
                                      @elseif($ext=="pdf")
                                          <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center"
                                              data-src="{{$ASSETS}}/{{$file->sheet}}"
                                              data-pinterest-text="Pin it"
                                              data-tweet-text="share on twitter">
                                              <img class="img-responsive product-img"
                                                   src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png"
                                                   style="filter: brightness(0.5)">
                                              <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                             <button
                                                  class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                          </li>
                                      @else
                                          <li class="px-1 my-1 col-lg-2 col-md-3 col-6">
                                              <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                              <div class="include-in-gallery"
                                                   data-src="{{$ASSETS}}/{{$file->sheet}}"
                                                   data-pinterest-text="Pin it"
                                                   data-tweet-text="share on twitter">
                                                  <a href="">
                                                      <img class="img-responsive product-img" src="{{$ASSETS}}/{{$file->sheet}}">
                                                      <div class="demo-gallery-poster">
                                                          <img src="https://sachinchoolur.github.io/lightGallery/static/img/zoom.png">
                                                      </div>
                                                  </a>
                                              </div>
                                          </li>
                                      @endif
                                  @endforeach
                              </ul>
                          </div>
                      </div>

                  </div>
                </div>
              </div>

            </div>
{{--            <div class="col-xl-3 col-lg-4 col-md-4 mt-sm-0 mt-3">--}}
{{--              <img src="{{$ASSET}}/front_site/images/ideate-develop.png" class="w-100 h-100">--}}
{{--            </div>--}}
          </div>

          <span class="heading">Other Selling Deals from this Supplier</span>
            <div class="row products-deals-slider">
                @if(count($osdts) > 5)
                    @foreach($osdts as $i => $prod)
                        <div class="content-column">
                            <div class="content-column-inner">
                                <a href="{{ route('productDetail',$prod->slug) }}">
                                @foreach($prod->product_image as $j => $image)
                                    @if(!empty($image))
                                        <img src="{{$ASSETS}}/{{$image->image}}" class="w-100 h-100 certified-suppliers-img">
                                        @if($j==0)
                                            @break
                                        @endif
                                    @else
                                        <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                                    @endif
                                @endforeach
                                </a>
                                <div class="product-info">
                                    <div class="product-info-inner">
                                        <span class="heading overflow-text-dots-one-line">{{$prod->product_service_name}}</span>
                                        <span class="overflow-text-dots-one-line">Price :@if(!empty($prod->unit_price_from)){{ $prod->unit_price_from }} {{$prod->suitable_currencies}}  @else {{ $prod->target_price_from }} {{$prod->suitable_currencies}} @endif  Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @else
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

          <span class="heading">Similar Selling Deals from Other Suppliers</span>
          <div class="row products-deals-slider">
              @if(count($ssdos) > 5)
                  @foreach($ssdos as $i => $prod)
              <div class="content-column">
              <div class="content-column-inner">
                  <a href="{{ route('productDetail',$prod->slug) }}">
                  @foreach($prod->product_image as $j => $image)
                      @if(!empty($image))
                          <img src="{{$ASSETS}}/{{$image->image}}" class="w-100 h-100 certified-suppliers-img">
                          @if($j==0)
                              @break
                          @endif
                      @else
                          <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                      @endif
                  @endforeach
                  </a>
                <div class="product-info">
                  <div class="product-info-inner">
                    <span class="heading overflow-text-dots-one-line">{{$prod->product_service_name}}</span>
                    <span class="overflow-text-dots-one-line">Price :@if(!empty($prod->unit_price_from)){{ $prod->unit_price_from }} {{$prod->suitable_currencies}}  @else {{ $prod->target_price_from }} {{$prod->suitable_currencies}} @endif  Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</span>
                  </div>
                </div>
              </div>
            </div>
                  @endforeach
              @else
                  <div class="content-column">
                      <div class="content-column-inner">
                          <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                          <div class="product-info">
                              <div class="product-info-inner">
                                  <span class="heading overflow-text-dots-one-line">Product Title</span>
                                  <span class="overflow-text-dots-one-line">Price</span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="content-column">
                      <div class="content-column-inner">
                          <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                          <div class="product-info">
                              <div class="product-info-inner">
                                  <span class="heading overflow-text-dots-one-line">Product Title</span>
                                  <span class="overflow-text-dots-one-line">Price</span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="content-column">
                      <div class="content-column-inner">
                          <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                          <div class="product-info">
                              <div class="product-info-inner">
                                  <span class="heading overflow-text-dots-one-line">Product Title</span>
                                  <span class="overflow-text-dots-one-line">Price</span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="content-column">
                      <div class="content-column-inner">
                          <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                          <div class="product-info">
                              <div class="product-info-inner">
                                  <span class="heading overflow-text-dots-one-line">Product Title</span>
                                  <span class="overflow-text-dots-one-line">Price</span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="content-column">
                      <div class="content-column-inner">
                          <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                          <div class="product-info">
                              <div class="product-info-inner">
                                  <span class="heading overflow-text-dots-one-line">Product Title</span>
                                  <span class="overflow-text-dots-one-line">Price</span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="content-column">
                      <div class="content-column-inner">
                          <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                          <div class="product-info">
                              <div class="product-info-inner">
                                  <span class="heading overflow-text-dots-one-line">Product Title</span>
                                  <span class="overflow-text-dots-one-line">Price</span>
                              </div>
                          </div>
                      </div>
                  </div>
              @endif
          </div>

          <span class="heading">Similar Deals from Country</span>
            <div class="row products-deals-slider">
                @if(count($sdfc) > 5)
                    @foreach($sdfc as $i => $prod)
                        <div class="content-column">
                            <div class="content-column-inner">
                                <a href="{{ route('productDetail',$prod->slug) }}">
                                    @foreach($prod->product_image as $j => $image)
                                        @if(!empty($image))
                                            <img src="{{$ASSETS}}/{{$image->image}}" class="w-100 h-100 certified-suppliers-img">
                                            @if($j==0)
                                                @break
                                            @endif
                                        @else
                                            <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                                        @endif
                                    @endforeach
                                </a>
                                <div class="product-info">
                                    <div class="product-info-inner">
                                        <span class="heading overflow-text-dots-one-line">{{$prod->product_service_name}}</span>
                                        <span class="overflow-text-dots-one-line">Price :@if(!empty($prod->unit_price_from)){{ $prod->unit_price_from }} {{$prod->suitable_currencies}}  @else {{ $prod->target_price_from }} {{$prod->suitable_currencies}} @endif  Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-column">
                        <div class="content-column-inner">
                            <img src="{{$ASSET}}/front_site/images/dri-fit-graphic.jpg" class="w-100 h-100 certified-suppliers-img">
                            <div class="product-info">
                                <div class="product-info-inner">
                                    <span class="heading overflow-text-dots-one-line">Product Title</span>
                                    <span class="overflow-text-dots-one-line">Price</span>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
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
            /*for downloading files*/
            $('.get-file').on('click', function () {
                var GetFile = $(this).parent('li').attr('data-src');
                console.log(GetFile);
                $.ajax({
                    url: GetFile,
                    method: 'GET',
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (data) {
                        var a = document.createElement('a');
                        var url = window.URL.createObjectURL(data);
                        a.href = url;
                        a.download = GetFile;
                        document.body.append(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    }
                });
            });
            /*for downloading files*/

            $('#country').on('change', function() {
                var country_id = this.value;
                $("#city").html('');
                $.ajax({
                    url:"{{url('/get-state-list')}}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType : 'json',
                    success: function(result){
                        $('#city').html('<option value="" selected disabled>Select City</option>');
                        $.each(result.cities,function(key,value){
                            $("#city").append('<option value="'+value+'">'+value+'</option>');
                        });
                    }
                });
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

                        let heart_btn = $(thisVariable).closest('.change-password-modal').siblings('.suppliers-buyers').find('.check-heart');
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
    </script>

@endpush
