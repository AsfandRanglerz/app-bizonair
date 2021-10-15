@extends('front_site.master_layout')

@section('content')
    <body>
    <main id="maincontent" class="product-details suppliers-products">
        @include('front_site.common.user-suppliers-banner')
        <div class="my-1 p-1 container-lg product-info-container">

            @if(count($products) > 0)
                @foreach($products as $i => $prod)
                    <div class="product-info">
                        <div class="ml-0 mr-0 py-2 row">
                            <div class="col-md-6 px-2">
                                <ul class="products-slider">
                                    @foreach($prod->product_image as $j => $image)

                                        <li class="listing" data-thumb="{{$ASSETS}}/{{$image->image}}" data-src="{{$ASSETS}}/{{$image->image}}">
                                            <a href="{{ route('productDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                                <img class="w-100 border-grey" src="{{$ASSETS}}/{{$image->image}}" class="img-fluid">
                                            </a>
                                        </li>

                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6 px-2">
                                <div class="p-2 rounded-8px border-grey">
                                     <div>
                                        <a class="text-reset" href="{{ route('productDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                        <h5 class="font-weight-bold heading one-line-character-text">{{strtoupper($prod->product_service_name)}}</h5>
                                        </a>
                                         <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                                         <p class="mb-0">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                                         <p class="price font-500 overflow-text-dots-subject one-line-character-text"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ moneyFormat($prod->unit_price_from) }} - {{ moneyFormat($prod->unit_price_to) }}   @else {{ moneyFormat($prod->target_price_from) }} - {{ moneyFormat($prod->target_price_to) }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                                         <p class="mt-1 mb-0 text-uppercase place-day">{{ $prod->city }}, {{ $prod->country }} <span class="pull-right">{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span></p>
                                         <button class="mt-2 mb-md-0 mb-1 p-0 red-btn" @if(!Auth::check()) data-toggle="modal" data-target="#login-form" @endif data-toggle="modal" data-target="#contactFormPDP"><span class="d-inline-block py-1 px-2" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Send an Inquiry to company on Bizonair portal">MESSAGE</span></button>
                                     </div>
                                </div>
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
                        </div>
                    </div>
                @endforeach
            @else
                <h5 class="font-weight-bold heading">No Product Found</h5>
            @endif
            <div align="center">
                <a href="#" class="load-more red-btn">Load More<span class="ml-2 fa fa-spinner" aria-hidden="true"></span></a>
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
