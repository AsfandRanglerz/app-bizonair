@extends('front_site.master_layout')

@section('content')
    <body>
    <style>
        .suppliers-products .products-slider {
            height: 245px!important;
        }

        .suppliers-products .products-slider .listing {
            height: 100%;
        }

        .suppliers-products .products-slider img {
            height: 100%;
            object-fit: cover;
        }

        .suppliers-products .lSSlideOuter .lSPager.lSGallery img {
            height: 75px;
            width: 100%;
            object-fit: cover;
        }

        .suppliers-products .lSSlideOuter .lSPager.lSGallery li {
            opacity: 0.5;
            border: 1px solid #bababa75;
            transition: .5s;
        }

        .suppliers-products .lSSlideOuter .lSPager.lSGallery li.active,
        .suppliers-products .lSSlideOuter .lSPager.lSGallery li:hover {
            border: 1px solid #bababa75;
            border-radius: 0;
            opacity: 1;
        }

        .suppliers-products .lSAction > a {
            filter: brightness(0.5);
        }

        .product-info-container {
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            padding: 15px;
        }
        .product-info {
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 0%), 0 6px 20px 0 rgb(0 0 0 / 18%);
            border-radius: 5px;
        }
    </style>
    <main id="maincontent" class="product-details suppliers-products">
        @include('front_site.common.user-suppliers-banner')
        <div class="mt-4 mb-4 container-lg product-info-container">

            @if(count($products) > 0)
                @foreach($products as $i => $prod)
            <div class="ml-0 mr-0 pt-3 pb-3 row product-info">
                <div class="col-md-4">
                    <ul class="products-slider">
                        @foreach($prod->product_image as $j => $image)

                        <li class="listing" data-thumb="{{$ASSETS}}/{{$image->image}}" data-src="{{$ASSETS}}/{{$image->image}}">
                            <img class="w-100" src="{{$ASSETS}}/{{$image->image}}" class="img-fluid">
                        </li>

                        @endforeach
                    </ul>
                </div>
                <div class="col-md-8">
                    <a href="{{ route('productDetail',$prod->slug) }}">
                    <h5 class="mb-4 font-weight-bold heading">{{strtoupper($prod->product_service_name)}}</h5>
                    </a>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <p class="mb-0 overflow-text-dots-subject">{{$prod->subject}}</p>
                            </div>

                            <div>
                                <p class="mb-0">@if($prod->product_availability == "Both") In-Stock/Made to order @else {{$prod->product_availability}} @endif</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <p class="price font-500 overflow-text-dots-subject"><span>@if($prod->suitable_currencies == "Other") {{ $prod->other_suitable_currency }} @else {{ $prod->suitable_currencies }} @endif @if(!empty($prod->unit_price_from)){{ $prod->unit_price_from }} - {{ $prod->unit_price_to }}   @else {{ $prod->target_price_from }} - {{ $prod->target_price_to }} @endif</span> Per @if($prod->unit_price_unit =="Other") {{$prod->other_unit_price_unit}} @else  {{$prod->unit_price_unit}} @endif  @if($prod->target_price_unit =="Other") {{$prod->other_target_price_unit}} @else {{$prod->target_price_unit}} @endif</p>
                            </div>
                            <div>
                                <p class="my-1 text-uppercase place-day">{{ get_product_city($prod->company_id) }}, {{$prod->origin}} <span class="ml-3">{{\Carbon\Carbon::parse($prod->creation_date)->diffForHumans()}}</span></p>
                            </div>
                        </div>
                    </div>

                    <button class="mt-5 pull-right red-btn" @if(Auth::check()) data-toggle="modal" data-target="#contactFormPDP" @else class="pre-login" @endif>REQUEST FOR QUOTE</button>
                    <!-- Modal -->
                    <div class="modal fade" id="contactFormPDP" tabindex="-1" role="dialog" aria-labelledby="contactForm" aria-hidden="true">
                        <div class="modal-dialog contact-form" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="modal-title">Send Inquiry To Supplier</span>
                                    <button  class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">

                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="contactName" placeholder="Contact Name" required="required">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="companyName" placeholder="Company Name" required="required">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="number" class="form-control" id="contactNumber" placeholder="Contact Number" required="required">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="email" class="form-control" id="emailId" placeholder="E-mail" required="required">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <select name="country" class="form-control" id="countries" required="required">
                                                    <option value="" selected="">Country</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="city" placeholder="City" required="required">
                                            </div>
                                        </div>

                                        <div id="totalCharLeft">1000 characters remaining</div>
                                        <textarea id="describeRequirement" class="mb-4 textarea-box form-control" placeholder="Describe Your Requirement..." maxlength="1000"></textarea>

                                        <div class="form-row">
                                            <div class="form-group ticks-checkbox col-md-12 mt-0 mb-0">
                                                <ul data-toggle="buttons" class="mb-0">
                                                    <li class="btn">
                                                        <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Sample with specification sheet
                                                    </li>
                                                    <li class="btn">
                                                        <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Latest Price Quotation
                                                    </li>
                                                    <li class="btn">
                                                        <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Compliance certification required
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="form-group ticks-checkbox col-md-12 mt-0 mb-0">
                                                <ul data-toggle="buttons" class="mb-0">
                                                    <li class="btn">
                                                        <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Preferred payment terms
                                                    </li>
                                                    <li class="btn">
                                                        <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Production Capacity
                                                    </li>
                                                    <li class="btn">
                                                        <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Production Capacity
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group ticks-checkbox mt-3 mb-3">
                                            <ul data-toggle="buttons" class="mb-0">
                                                <li class="w-100 btn d-flex">
                                                    <input class="input fa fa-square-o" type="checkbox" id="termsCheckbox">
                                                    <div>Please refer our <a href="#" class="text-link">Privacy Policy</a> and <a href="#" class="text-link">Terms & Conditions</a> before submitting your information</div>
                                                </li>
                                            </ul>
                                        </div>

                                        <input type="submit" class="btn submit-btn" value="Send Inquiry Now" disabled>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                </div>
            </div>
                @endforeach
            @else
                <h5 class="font-weight-bold heading">No Product Found</h5>
            @endif

        </div>

    </main>
    </body>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).on('click','.pre-login',function(){
            window.location.href = "{{ route('log-in-pre')}}";
        });
    </script>
@endpush
