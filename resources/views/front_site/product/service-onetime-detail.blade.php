@extends('front_site.master_layout')

@section('content')


<body class="product-main product-details">
  <main id="maincontent" class="page-main">

    @include('front_site.common.product-banner')

    <div class="main-container">
       <div class="container-fluid px-2">

           @include('front_site.common.garments-nav-service')

           <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                   <li class="breadcrumb-item"><a href="{{ url('services/hr-and-admin') }}">Textile Services</a></li>
                   <li class="breadcrumb-item"><a href="{{ url('services/'.$category->slug) }}">{{ucfirst($category->name)}}</a></li>
                   <li class="breadcrumb-item active" aria-current="page"><a href="{{Request::url()}}">{{ucfirst($sub_category->name)}}</a></li>
               </ol>
           </nav>

           <div class="mini-content-container">
               <div class="row m-0 mb-5 box-shadow top-banner-content">
                   <div class="col-xl-9 col-lg-12">
                       <div class="row">
                           <div class="col-lg-6 col-md-6 suppliers-buyers">
                               <ul id="left-thumb-slider">
                                   <?php $img = \DB::table('buysell_images')->where('buy_sell_id',$product->id)->get();?>
                                   @foreach($img as $image)
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
                                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
                           <div class="col-lg-6 col-md-6 mt-sm-0 mt-3 contact-product-info">
                               <div class="mb-3 d-flex justify-content-between">
                                   <span class="heading">{{$product->product_service_name}}</span>
                               </div>
                               <p><span class="font-500" style="color: #000">Reference No: </span>{{$product->reference_no}}</p>
                               <p style="margin-bottom: 15px"><span class="font-500" style="color: #000">One-Time Deals: </span> @if($product->product_service_types =='Service') Service Seeker @endif</p>
                               {{--                            <p><span class="font-500" style="color: #000">Product Detail: </span>{{$product->details}}</p>--}}
                               <div class="btns-block">
                                   <a href="#" class="p-0 btns" type="button" @if(!Auth::check()) data-toggle="modal" data-target="#login-form" @endif data-toggle="modal" data-target="#contactFormPDP"><span class="d-inline-block py-1 px-2" data-placement="bottom" title="Send an Inquiry to company on Bizonair portal" data-toggle="tooltip">SEND A MESSAGE</span></a>

                                   <!-- Modal -->
                                   <div class="modal fade" id="contactFormPDP" tabindex="-1" role="dialog" aria-labelledby="contactForm" aria-hidden="true">
                                       <div class="modal-dialog contact-form" role="document">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                                   <span class="modal-title">Send Inquiry</span>
                                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
                                                       <input type="hidden" class="form-control" value="{{$product->id}}" name="buysellId">
                                                       <input type="hidden" class="form-control" value="Deal" name="prodType">
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
                                                        <span class="spinner-border spinner-border-sm mr-1"
                                                              role="status" aria-hidden="true"></span>Send Inquiry Now
                                                       </button>

                                                   </form>

                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <!-- Modal -->

                                   <a href="#productInfoSection" type="button" class="p-0 btns product-info-btn"><span class="d-inline-block py-1 px-2">PRODUCT INFO</span></a>
                               </div>
                               <br>
                               <p><span class="font-500" style="color: #000">Note :</span> By clicking favourite, a notification will be sent to the Supplier/Buyer</p>
                           </div>
                       </div>
                   </div>
                   <div class="col-xl-3 col-lg-12 mt-xl-0 mt-3 p-0">
                       <div class="text-right mb-4">
                           <a href="{{ route('buy-sell.create') }}" class="red-btn py-1 px-2 text-uppercase">Post Your Service Deal</a>
                       </div>
                       @if(auth()->user())
                           <div class="supplier-info">
                               <div class="position-relative">
                                   <div class="mb-2 d-flex membersince">Member <span class="number">since</span><span class="years">{{get_buysell_created_at($product->user_id)}}</span></div>
                                   <div class="position-absolute top-0 right-0 membericon">
                                       <a href="http://localhost/bizonair-database/404">
                                           <img alt="Premium Member" src="{{$ASSETS}}/assets/front_site/images/deals-membership.png"   title="We are working on this feature and will enable this soon" data-toggle="tooltip" data-placement="bottom" data-toggle="tooltip" data-placement="bottom" style="height: 30px;width: 30px;">
                                       </a>
                                   </div>
                               </div>
                               <p class="overflow-text-dots-one-line">Name: <span class="font-500" style="color: #000"> {{get_buysell_user_name($product->user_id)}}</span></p>
                               <small class="d-block font-500 grey-text">{{ get_buysell_city($product->user_id) }}, {{get_buysell_country($product->user_id)}} </small>
                               <small class="d-flex mb-2 grey-text number-content">
                                   <span class="font-500">Contact:</span>
                                   <span class="d-inline-block mx-1 show">***********</span>
                                   <span class="d-none mx-1 hidden">{{ get_buysell_contact_no($product->user_id) }}</span>
                                   <span class="cursor-pointer blue-color font-500 hide-show-number" style="border-bottom: 1px dashed">Show</span>
                               </small>
                               <small class="d-block mb-2 grey-text"></small>
                               <p class="add-connect"><span class="fa fa-address-book" aria-hidden="true"></span><a class="text-decoration-none text-reset" title="We are working on this feature and will enable this soon" data-toggle="tooltip" data-placement="bottom">Add To My Connection</a></p>
                               <div id="add-connection" class="change-password-modal modal fade">
                                   <div class="modal-dialog modal-dialog-centered modal-login">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <span class="modal-title">ADD TO MY CONNECTION</span>
                                               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
                                       <p><a href="" data-toggle="modal" data-target="#login-form" class="font-500 register-text">Log in</a> To View More Information.</p>
                                       <p><span class="font-500" style="color: #000">Not a member? </span><a href="{{route('email-confirmation')}}" target="_blank" class="font-500 register-text">Register Now!</a></p>
                                   </div>
                               </div>
                           </div>

                       @endif
                   </div>
               </div>

               <div class="row">
                   <div class="col-xl-9 col-lg-8 col-md-8">

                       <div class="switch-tabs" id="productInfoSection">
                           <!-- Nav tabs -->
                           <ul class="nav nav-tabs">
                               <li class="nav-item">
                                   <a class="nav-link active" data-toggle="tab" href="#productInfo">PRODUCT INFO</a>
                               </li>
                               <li class="nav-item">
                                   <a class="nav-link" data-toggle="tab" href="#tradeInfo">SPECIFICATION SHEETS</a>
                               </li>
                           </ul>

                           <!-- Tab panes -->
                           <div class="tab-content">
                               <div id="productInfo" class="tab-pane product-tab active">
                                   <div class="row text">
                                       <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                           <span><b>Main Category : </b></span>
                                       </div>
                                       <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                           <p class="mb-sm-0">{{ get_cat_name($product->category_id) }}</p>
                                       </div>
                                   </div>
                                   <div class="row text">
                                       <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                           <span><b>Service Type : </b></span>
                                       </div>
                                       <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                           <p class="mb-sm-0">{{ get_subcat_name($product->subcategory_id) }}</p>
                                       </div>
                                   </div>

                                   <div class="row text">
                                       <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                           <span><b>Subject : </b></span>
                                       </div>
                                       <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                           <p class="mb-sm-0">{{ $product->subject }}</p>
                                       </div>
                                   </div>

                                   <div class="row text">
                                       <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                           <span><b>Ad Expiry Days : </b></span>
                                       </div>
                                       <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                           <p class="mb-sm-0">{{ $product->expiry_data }} Days</p>
                                       </div>
                                   </div>
                                   @if($product->keywords != "")
                                       <div class="row text">
                                           <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                               <span><b>Additional Keyword :</b></span>
                                           </div>
                                           <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                               <p class="mb-0">{{rtrim($product->keywords,',') }}</p>
                                           </div>
                                       </div>
                                   @endif
                                   <div class="row text">
                                       <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                           <span><b>Additional Info : </b></span>
                                       </div>
                                       <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                           @if ($product->details)
                                               <p class="mb-0">{{ $product->details }}</p>
                                           @else
                                               <p class="mb-0">-</p>
                                           @endif
                                       </div>
                                   </div>

                                   <span class="heading">PAYMENT DETAILS</span>

                                   @if($product->product_service_types == "Service")
                                       <div class="row text">
                                           <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                               <span><b>Service Charges : </b></span>
                                           </div>
                                           <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                               <p class="mb-sm-0">
                                                   @if(in_array("Other", explode(",", $product->suitable_currencies))) {{ $product->other_suitable_currency }}
                                                   @else {{$product->suitable_currencies }} @endif
                                                   {{ moneyFormat($product->unit_price_from) }} Per {{ $product->unit_price_unit }}
                                               </p>
                                           </div>
                                       </div>
                                       <div class="row text">
                                           <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                               <span><b>Service Duration : </b></span>
                                           </div>
                                           <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                               <p class="mb-sm-0">
                                                   {{ str_replace(',', ', ', $product->service_durations) }}
                                               </p>
                                           </div>
                                       </div>
                                       @if(in_array("Other", explode(",", $product->service_durations)))
                                           <div class="row text">
                                               <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                                   <span><b>Other Service Duration : </b></span>
                                               </div>
                                               <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                                   <p class="mb-sm-0">
                                                       {{ $product->other_service_duration }}
                                                   </p>
                                               </div>
                                           </div>
                                       @endif
                                   @else
                                       @if($product->delivery)
                                           <div class="row text">
                                               <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                                   <span><b>Delivery : </b></span>
                                               </div>
                                               <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                                   <p class="mb-sm-0">
                                                       {{ $product->delivery }}
                                                   </p>
                                               </div>
                                           </div>
                                       @endif
                                       @if($product->delivery_time)
                                           <div class="row text">
                                               <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                                   <span><b>Lead Time : </b></span>
                                               </div>
                                               <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                                   <p class="mb-sm-0">
                                                       {{ $product->delivery_time }}
                                                   </p>
                                               </div>
                                           </div>
                                       @endif
                                   @endif

                                   @if(in_array("Other", explode(",", $product->suitable_currencies)))
                                       <div class="row text">
                                           <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                               <span><b>Suitable Currency : </b></span>
                                           </div>
                                           <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                               <p class="mb-sm-0">
                                                   {{ $product->other_suitable_currency }}
                                               </p>
                                           </div>
                                       </div>
                                   @else
                                       <div class="row text">
                                           <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                               <span><b>Suitable Currency : </b></span>
                                           </div>
                                           <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                               <p class="mb-sm-0">
                                                   {{$product->suitable_currencies }}
                                               </p>
                                           </div>
                                       </div>
                                   @endif

                                   @if(in_array("Other", explode(",", $product->payment_terms)))
                                       <div class="row text">
                                           <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                               <span><b>Payment Terms : </b></span>
                                           </div>
                                           <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                               <p class="mb-sm-0">
                                                   {{ $product->other_payment_term }}
                                               </p>
                                           </div>
                                       </div>
                                   @else
                                       <div class="row text">
                                           <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                               <span><b>Payment Terms : </b></span>
                                           </div>
                                           <div class="col-xl-9 col-lg-8 col-sm-6 col-6">
                                               <p class="mb-sm-0">
                                                   {{ str_replace(',', ', ', $product->payment_terms) }}
                                               </p>
                                           </div>
                                       </div>
                                   @endif
                               </div>

                               <div id="tradeInfo" class="tab-pane product-tab fade">

                                   <div class="product-img-spec-container">
                                       <div class="product-images-gallery">
                                           <ul class="row mx-0 my-2 product-gallery">
                                               @foreach(\App\Helpers\BuysellHelper::getSheets($product->id) as $file)
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
{{--                   <div class="col-xl-3 col-lg-4 col-md-4 mt-sm-0 mt-3">--}}
{{--                       @foreach($ads as $ad)--}}
{{--                           <img src="{{ url('storage/app/public/'.$ad->image) }}" class="w-100 h-100 right-side-img">--}}
{{--                       @endforeach--}}
{{--                   </div>--}}
               </div>

               <span class="heading">Other Selling Deals from this Supplier</span>
               <div class="row products-deals-slider">
                   @if(count($osdts) > 5)
                       @foreach($osdts as $i => $prod)
                           <div class="content-column">
                               <div class="content-column-inner">
                                   <a href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                       <div class="suppliers-buyers" style="height: 65%;">
                                           <?php $img = \DB::table('buysell_images')->where('buy_sell_id',$prod->id)->get();?>
                                           @foreach($img as $j => $image)
                                               @if(!empty($image))
                                                   <img src="{{$ASSETS}}/{{$image->image}}" class="w-100 h-100 certified-suppliers-img border-grey">
                                                   @if($j==0)
                                                       @break
                                                   @endif
                                               @else
                                                   <img src="{{$ASSET}}/front_site/images/noimage.png" width="50" height="50" class="position-absolute certified-logo">
                                               @endif
                                               @if($prod->is_featured ==1)
                                                   <span class="position-absolute left-0 Featured-txt">Featured</span>
                                               @endif
                                           @endforeach
                                       </div>
                                   </a>
                                   <a class="text-decoration-none text-reset" href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                       <div class="product-info">
                                           <p class="heading overflow-text-dots-one-line">{{$prod->product_service_name}}</p>
                                           <p class="mb-0 overflow-text-dots-one-line">{{$prod->subject}}</p>
                                           <p class="mb-0 overflow-text-dots-one-line">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                           <p class="price font-500 overflow-text-dots-one-line"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ moneyFormat($prod->unit_price_from) }} - {{ moneyFormat($prod->unit_price_to) }}  @else {{ moneyFormat($prod->target_price_from) }} - {{ moneyFormat($prod->target_price_to) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                           <div class="d-flex justify-content-between mt-2 mb-0 text-uppercase place-day">
                                                <span class="place">{{ $prod->city }}, {{ $prod->country }}</span>
                                                <span>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span>
                                           </div>
                                       </div>
                                   </a>
                               </div>

                           </div>
                       @endforeach
                   @else
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
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
                                   <a href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                       <div class="suppliers-buyers" style="height: 65%;">
                                           <?php $img = \DB::table('buysell_images')->where('buy_sell_id',$prod->id)->get();?>
                                           @foreach($img as $j => $image)
                                               @if(!empty($image))
                                                   <img src="{{$ASSETS}}/{{$image->image}}" class="w-100 h-100 certified-suppliers-img border-grey">
                                                   @if($j==0)
                                                       @break
                                                   @endif
                                               @else
                                                   <img src="{{$ASSET}}/front_site/images/noimage.png" width="50" height="50" class="position-absolute certified-logo">
                                               @endif
                                           @endforeach
                                       </div>
                                   </a>
                                   <a class="text-decoration-none text-reset" href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                       <div class="product-info">
                                           <p class="heading overflow-text-dots-one-line">{{$prod->product_service_name}}</p>
                                           <p class="mb-0 overflow-text-dots-one-line">{{$prod->subject}}</p>
                                           <p class="mb-0 overflow-text-dots-one-line">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                           <p class="price font-500 overflow-text-dots-one-line"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ moneyFormat($prod->unit_price_from) }} - {{ moneyFormat($prod->unit_price_to) }}  @else {{ moneyFormat($prod->target_price_from) }} - {{ moneyFormat($prod->target_price_to) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                           <div class="d-flex justify-content-between mt-2 mb-0 text-uppercase place-day">
                                                <span class="place">{{ $prod->city }}, {{ $prod->country }}</span>
                                                <span>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                           </div>
                       @endforeach
                   @else
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
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
                                   <a href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                       <div class="suppliers-buyers" style="height: 65%;">
                                           <?php $img = \DB::table('buysell_images')->where('buy_sell_id',$prod->id)->get();?>
                                           @foreach($img as $j => $image)
                                               @if(!empty($image))
                                                   <img src="{{$ASSETS}}/{{$image->image}}" class="w-100 h-100 certified-suppliers-img border-grey">
                                                   @if($j==0)
                                                       @break
                                                   @endif
                                               @else
                                                   <img src="{{$ASSET}}/front_site/images/noimage.png" width="50" height="50" class="position-absolute certified-logo">
                                               @endif
                                               @if($prod->is_featured ==1)
                                                   <span class="position-absolute left-0 Featured-txt">Featured</span>
                                               @endif
                                           @endforeach
                                       </div>
                                   </a>
                                   <a class="text-decoration-none text-reset" href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                       <div class="product-info">
                                           <p class="heading overflow-text-dots-one-line">{{$prod->product_service_name}}</p>
                                           <p class="mb-0 overflow-text-dots-one-line">{{$prod->subject}}</p>
                                           <p class="mb-0 overflow-text-dots-one-line">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                           <p class="price font-500 overflow-text-dots-one-line"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ moneyFormat($prod->unit_price_from) }} - {{ moneyFormat($prod->unit_price_to) }}  @else {{ moneyFormat($prod->target_price_from) }} - {{ moneyFormat($prod->target_price_to) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                           <div class="d-flex justify-content-between mt-2 mb-0 text-uppercase place-day">
                                                <span class="place">{{ $prod->city }}, {{ $prod->country }}</span>
                                                <span>{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                           </div>
                       @endforeach
                   @else
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="content-column">
                           <div class="content-column-inner">
                               <img src="{{$ASSET}}/front_site/images/noimage.png" class="w-100 h-100 certified-suppliers-img">
                               <div class="product-info">
                                   <div class="product-info-inner">
                                       <span class="heading">Not Available</span>
                                       <span>Price</span>
                                   </div>
                               </div>
                           </div>
                       </div>

                   @endif
               </div>

               {{--                <h3 class="text-center home-heading">Textile Partners</h3>--}}
               {{--                <div class="pl-4 pr-4 container-fluid logo-slider">--}}
               {{--                    <div class="slider slider-nav w-100">--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/4-box.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/act.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100"></a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/adm.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/alkaram.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100"></a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/apparel-textile-logo.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/archroma.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100"></a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/azgard.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/cotton-web.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100"></a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/cresent.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/feroze.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/gadoon.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100"></a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/gohar.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/interlop.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/kohinoor.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100"></a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/mtm.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/naveena.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/nishat.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100"></a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/rajby.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/sapphire.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/sarena.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100"></a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/sgs.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/sockoye.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/style-textile.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/y-txt.jpeg"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100"></a>--}}
               {{--                        <a href="#" class="logo-container"><img--}}
               {{--                                src="{{$ASSET}}/front_site/images/our-clients-logos/zsk.png"--}}
               {{--                                alt="100x100" data-holder-rendered="true"--}}
               {{--                                class="w-100 h-100">--}}
               {{--                        </a>--}}
               {{--                    </div>--}}
               {{--                </div>--}}
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
