@extends('front_site.master_layout')

@section('content')

    <body>
    <main id="maincontent" class="page-main">
        <div class="d-flex edit-company-profile" id="dashboardWrapper">
            <!-- Sidebar -->
        <!-- Sidebar -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper" >

                <div class="px-2 py-2">
                    <div id="companyTab1">
                        <div class="tab-content" id="myCompanyTab">
                            <div class="px-0 py-1 tab-pane fade show active" id="tabProfile" role="tabpanel"
                                 aria-labelledby="linkProfile">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="edit-about-us-section">
                                                <h6 class="heading">
                                                    @if(in_array("Buy", explode(",", $buysell->product_service_types)) || in_array("Sell", explode(",", $buysell->product_service_types)))
                                                        Product Info
                                                    @else
                                                        Service Info
                                                    @endif
                                                    <span class="fa fa-edit edit-btn about-edit-btn"></span></h6>
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Deal Type</span>
                                                    </div>
                                                    @if($buysell->product_service_types == 'Service')
                                                        <div class="col-sm-6 col-6">
                                                            <span>Service Provider</span>
                                                        </div>
                                                    @else
                                                        <div class="col-sm-6 col-6">
                                                            <span>{{ $buysell->product_service_types }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Main Category</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <span>{{ $buysell->category->name }}</span>
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Sub-Category</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <span>{{ $buysell->subcategory->name }}</span>
                                                    </div>
                                                </div>
                                                @if($buysell->add_sub_sub_category!=null)
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Product Type</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                            {{--                                                <span>{{ ($buysell->childsubcategory_id == 'Others') ? $buysell->childsubcategory_id : $buysell->childsubcategory->name }}</span> --}}
                                                            <span>{{ $buysell->add_sub_sub_category }}</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    @if(in_array("Buy", explode(",", $buysell->product_service_types)) || in_array("Sell", explode(",", $buysell->product_service_types)))
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Product Type</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                            @if (strpos($buysell->childsubcategory->name, 'Other'))
                                                                <span>{{ substr($buysell->childsubcategory->name,6) }}</span>
                                                            @else
                                                                <span>{{ $buysell->childsubcategory->name }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endif
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Reference Number</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <span>{{ $buysell->reference_no }}</span>
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Subject</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <span>{{ $buysell->subject }}</span>
                                                    </div>
                                                </div>
                                                @if($buysell->product_service_types == "Sell" || $buysell->product_service_types == "Buy")
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Product Name</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                            <span>{{ $buysell->product_service_name }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($buysell->product_service_types == "Service")
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Product & Service Name</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                            <span>{{ $buysell->product_service_name }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Keyword For Search</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <span>
                                                           @if(!empty($buysell->keyword1 && $buysell->keyword2 && $buysell->keyword3))
                                                                {{ $buysell->keyword1.' , '.$buysell->keyword2.' , '.$buysell->keyword3 }}
                                                            @elseif(!empty($buysell->keyword1 && $buysell->keyword2))
                                                                {{ $buysell->keyword1.' , '.$buysell->keyword2 }}
                                                            @elseif(!empty($buysell->keyword1))
                                                                {{ $buysell->keyword1 }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                @if(!in_array("Service", explode(",", $buysell->product_service_types)))
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span>Available Quantity</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                        <span>
                                                            @if($buysell->product_availability!=null)
                                                                {{ $buysell->product_availability }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Unit</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                        <span>
                                                            @if($buysell->available_unit!=null)
                                                                {{ $buysell->available_unit }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                    @if($buysell->available_unit=='Other')
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Other Unit</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                        <span>
                                                            @if($buysell->other_available_unit!=null)
                                                                {{ $buysell->other_available_unit }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Ad Expiry Days</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                        <span>
                                                            @if($buysell->expiry_data!=null)
                                                                {{ $buysell->expiry_data }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
{{--                                                    <div class="row text">--}}
{{--                                                        <div class="col-sm-6 col-6">--}}
{{--                                                            <span class="font-500">Price</span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-sm-6 col-6">--}}
{{--                                                        <span>--}}
{{--                                                            @if($buysell->price!=null)--}}
{{--                                                                {{ $buysell->price }}--}}
{{--                                                            @else--}}
{{--                                                                ---}}
{{--                                                            @endif--}}
{{--                                                        </span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Manufacturer Name</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                        <span class="font-500">
                                                                {{ \Auth::user()->name }}
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Product Origin</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                        <span>
                                                            @if($buysell->origin!=null)
                                                                {{ $buysell->origin }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Additional Info</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <span>
                                                            @if($buysell->details!=null)
                                                                {!! $buysell->details  !!}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-2 col-sm-12 col-12">
                                            <div class="product-img-spec-container mb-1">
                                                <h6 class="my-2 px-2 heading pro-img-heading">Product Images</h6>
                                                <div class="product-images-gallery">
                                                        <ul class="row mx-0 mb-2 product-gallery edit-comp-prof-imgs">
                                                            @foreach(App\Helpers\BuysellHelper::getImages($buysell->id) as $image)
                                                                <li class="position-relative d-inline-block my-1">
                                                                    <input type="hidden" name='img_id' value="{{encrypt($image->id)}}">
                                                                    <span class="position-absolute border-0 specification-bin specs fa fa-trash" img_id="{{$image->id}}" aria-hidden="true"></span>
                                                                    <div class="include-in-gallery"
                                                                         data-src="{{$image->image}}"
                                                                         data-pinterest-text="Pin it"
                                                                         data-tweet-text="share on twitter">
                                                                        <a href="">
                                                                            <img class="img-responsive product-img" src="{{$image->image}}">
                                                                            <div class="demo-gallery-poster">
                                                                                <span class="fa fa-eye text-white"></span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                            </div>
                                            <div class="product-img-spec-container">
                                                <h6 class="my-1 px-2 heading pro-spec-heading">Product Specifications</h6>
                                                <div class="product-images-gallery">
                                                        <ul class="row mx-0 mb-2 product-gallery edit-comp-prof-imgs">
                                                            @foreach(App\Helpers\BuysellHelper::getSheets($buysell->id) as $file)
                                                                <?php $pathinfo = pathinfo($file->sheet);
                                                                $supported_ext = array('docx', 'xlsx', 'pdf');
                                                                $src_file_name = $file->sheet;
                                                                $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                                                    @if($ext=="docx")
                                                                        <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                                            data-src="{{$file->sheet}}"
                                                                            data-pinterest-text="Pin it"
                                                                            data-tweet-text="share on twitter">
                                                                            <img class="img-responsive product-img"
                                                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png"
                                                                                 style="filter: brightness(0.5)">
                                                                            <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                                            <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$file->id}}"></span>
                                                                            <button
                                                                                class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                                        </li>
                                                                    @elseif($ext=="xlsx")
                                                                        <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                                            data-src="{{$file->sheet}}"
                                                                            data-pinterest-text="Pin it"
                                                                            data-tweet-text="share on twitter">
                                                                            <img class="img-responsive product-img"
                                                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png"
                                                                                 style="filter: brightness(0.5)">
                                                                            <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                                            <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$file->id}}"></span>
                                                                            <button
                                                                                class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                                        </li>
                                                                    @elseif($ext=="pdf")
                                                                        <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                                            data-src="{{$file->sheet}}"
                                                                            data-pinterest-text="Pin it"
                                                                            data-tweet-text="share on twitter">
                                                                            <img class="img-responsive product-img"
                                                                                 src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png"
                                                                                 style="filter: brightness(0.5)">
                                                                            <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                                            <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$file->id}}"></span>
                                                                            <button
                                                                                class="position-absolute border-0 rounded-circle fa fa-download get-file"></button>
                                                                        </li>
                                                                @else
                                                                     <li class="position-relative d-inline-block my-1">
                                                                        <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                                        <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$file->id}}" aria-hidden="true"></span>
                                                                       <div class="include-in-gallery"
                                                                            data-src="{{$file->sheet}}"
                                                                            data-pinterest-text="Pin it"
                                                                            data-tweet-text="share on twitter">
                                                                        <a href="">
                                                                            <img class="img-responsive product-img" src="{{$file->sheet}}">
                                                                            <div class="demo-gallery-poster">
                                                                                <span class="fa fa-eye text-white"></span>
                                                                            </div>
                                                                        </a>
                                                                       </div>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                            </div>
                                            <div class="alert alert-success mt-2 mb-2 text-center" id='alert-success'
                                                 style="display:none;"
                                                 role="alert">
                                            </div>
                                            <div class="alert alert-danger g mt-2 mb-2 text-center" id='alert-error'
                                                 style="display:none;"
                                                 role="alert">
                                            </div>
                                            <div class="alert alert-success mt-2 mb-2 text-center" id='alert-success-login'
                                                 style="display: none"
                                                 role="alert"></div>
                                        </div>
                                    </div>
                                <div class="my-2">
                                    <hr class="horizontal-line">
                                </div>
                                @if($buysell->variation != null)
                                    <div class="edit-company-section">
                                        <h6 class="heading">Additional Product Info<span
                                                class="fa fa-edit edit-btn com-edit-btn"></span></h6>
                                        @if($buysell->variation == "Machinery & Parts")
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Brand Name</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
												<span>
													@if($buysell->machineryBuySellInfo->brand_name!=null)
                                                        {{ $buysell->machineryBuySellInfo->brand_name }}
                                                    @else
                                                        -
                                                    @endif
												</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Model Number</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
												<span>
													@if($buysell->machineryBuySellInfo->model_no!=null)
                                                        {{ $buysell->machineryBuySellInfo->model_no }}
                                                    @else
                                                        -
                                                    @endif
												</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Manufacturing Year</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
												<span>
													@if($buysell->machineryBuySellInfo->year_manufacture!=null)
                                                        {{ $buysell->machineryBuySellInfo->year_manufacture }}
                                                    @else
                                                        -
                                                    @endif
												</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">After Sales Service</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
												<span>
													@if($buysell->machineryBuySellInfo->after_sales_service!=null)
                                                        {{ $buysell->machineryBuySellInfo->after_sales_service }}
                                                    @else
                                                        -
                                                    @endif
												</span>
                                                </div>
                                            </div>
                                            @if($buysell->machineryBuySellInfo->after_sales_service=="Yes")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Type of Service</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
												<span>
													@if($buysell->machineryBuySellInfo->service_type!=null)
                                                        {{ $buysell->machineryBuySellInfo->service_type }}
                                                    @else
                                                        -
                                                    @endif
												</span>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Warranty</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
												<span>
													@if($buysell->machineryBuySellInfo->warranty!=null)
                                                        {{ $buysell->machineryBuySellInfo->warranty }}
                                                    @else
                                                        -
                                                    @endif
												</span>
                                                </div>
                                            </div>
                                            @if($buysell->machineryBuySellInfo->warranty=="Yes")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Warranty Period</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
												<span>
													@if($buysell->machineryBuySellInfo->warranty_period!=null)
                                                        {{ $buysell->machineryBuySellInfo->warranty_period }}
                                                    @else
                                                        -
                                                    @endif
												</span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Certification</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
												<span>
													@if($buysell->machineryBuySellInfo->certification!=null)
                                                        {{ $buysell->machineryBuySellInfo->certification }}
                                                    @else
                                                        -
                                                    @endif
												</span>
                                                </div>
                                            </div>
                                            @if($buysell->machineryBuySellInfo->certification=="Yes")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Certification Details</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
												<span>
													@if($buysell->machineryBuySellInfo->certification_details!=null)
                                                        {{ $buysell->machineryBuySellInfo->certification_details }}
                                                    @else
                                                        -
                                                    @endif
												</span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Additional Trade Notes</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
												<span>
													@if($buysell->machineryBuySellInfo->additional_trade_notes!=null)
                                                        {{ $buysell->machineryBuySellInfo->additional_trade_notes }}
                                                    @else
                                                        -
                                                    @endif
												</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Product Related Certifications</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
												<span>
													@if($buysell->machineryBuySellInfo->product_related_certifications!=null)
                                                        {{ $buysell->machineryBuySellInfo->product_related_certifications }}
                                                    @else
                                                        -
                                                    @endif
												</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="my-2">
                                        <hr class="horizontal-line">
                                    </div>
                                @endif


                                <div class="edit-company-section">
                                    <h6 class="heading">Payment Info<span
                                            class="fa fa-edit edit-btn edit-payment"></span></h6>
                                    @if($buysell->product_service_types == "Buy")
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Target Price</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                    <span>
                                                        @if($buysell->target_price_from!=null)
                                                            @if(in_array("Other", explode(",", $buysell->suitable_currencies))) {{ $buysell->other_suitable_currency }}
                                                            @else {{$buysell->suitable_currencies }} @endif

                                                            {{ $buysell->target_price_from }} Per {{ ($buysell->target_price_unit != 'Other') ? $buysell->target_price_unit : $buysell->other_target_price_unit }}
                                                        @else
                                                            -
                                                        @endif
                                                        {{--													to--}}
                                                        {{--													@if($buysell->target_price_to!=null)--}}
                                                        {{--                                                            {{ $buysell->target_price_to }} {{ ($buysell->target_price_unit != 'Other') ? $buysell->target_price_unit : $buysell->other_target_price_unit }}--}}
                                                        {{--                                                        @else--}}
                                                        {{--                                                            ---}}
                                                        {{--                                                        @endif--}}
                                                    </span>
                                            </div>
                                        </div>
                                    @endif
                                    @if($buysell->product_service_types == "Sell")
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Unit Price</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                    <span>
                                                        @if($buysell->unit_price_from!=null)
                                                            @if(in_array("Other", explode(",", $buysell->suitable_currencies))) {{ $buysell->other_suitable_currency }}
                                                            @else {{$buysell->suitable_currencies }} @endif
                                                           {{ $buysell->unit_price_from }} Per {{ ($buysell->unit_price_unit != 'Other') ? $buysell->unit_price_unit : $buysell->other_unit_price_unit }}
                                                        @else
                                                            -
                                                        @endif
                                                        {{--													to--}}
                                                        {{--													@if($buysell->unit_price_to!=null)--}}
                                                        {{--                                                            {{ $buysell->unit_price_to }} {{ ($buysell->unit_price_unit != 'Other') ? $buysell->unit_price_unit : $buysell->other_unit_price_unit }}--}}
                                                        {{--                                                        @else--}}
                                                        {{--                                                            ---}}
                                                        {{--                                                        @endif--}}
                                                    </span>
                                            </div>
                                        </div>
                                    @endif
                                    @if($buysell->product_service_types == "Service")
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500"> Service Charges</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                    <span>
                                                        @if($buysell->unit_price_from!=null)
                                                            @if(in_array("Other", explode(",", $buysell->suitable_currencies))) {{ $buysell->other_suitable_currency }}
                                                            @else {{$buysell->suitable_currencies }} @endif
                                                             {{ $buysell->unit_price_from }} Per {{ ($buysell->unit_price_unit != 'Other') ? $buysell->unit_price_unit : $buysell->other_unit_price_unit }}
                                                        @else
                                                            -
                                                        @endif
                                                        {{--													to--}}
                                                        {{--													@if($buysell->unit_price_to!=null)--}}
                                                        {{--                                                            {{ $buysell->unit_price_to }} {{ ($buysell->unit_price_unit != 'Other') ? $buysell->unit_price_unit : $buysell->other_unit_price_unit }}--}}
                                                        {{--                                                        @else--}}
                                                        {{--                                                            ---}}
                                                        {{--                                                        @endif--}}
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Service Duration</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                    <span>
                                                        {{ str_replace(',', ', ', $buysell->service_durations) }}
                                                    </span>
                                            </div>
                                        </div>
                                        @if(in_array("Other", explode(",", $buysell->service_durations)))
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Other Service Duration</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                        <span>
                                                            {{ $buysell->other_service_duration }}
                                                        </span>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Delivery</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
											<span>
												@if($buysell->delivery)
                                                    {{ $buysell->delivery }}
                                                @else
                                                    -
                                                @endif
											</span>
                                            </div>
                                        </div>
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Lead Time</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
											<span>
												@if($buysell->delivery_time)
                                                    {{ $buysell->delivery_time }}
                                                @else
                                                    -
                                                @endif
											</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if(in_array("Other", explode(",", $buysell->suitable_currencies)))
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Suitable Currency</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
											<span>
												@if($buysell->other_suitable_currency)
                                                    {{ $buysell->other_suitable_currency }}
                                                @else
                                                    -
                                                @endif
											</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Suitable Currency</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
											<span>
												@if($buysell->suitable_currencies)
                                                    {{ $buysell->suitable_currencies }}
                                                @else
                                                    -
                                                @endif
											</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row text">
                                        <div class="col-sm-6 col-6">
                                            <span class="font-500">Payment Terms</span>
                                        </div>
                                        <div class="col-sm-6 col-6">
											<span>
                                                @if(in_array("Other", explode(",", $buysell->payment_terms)))
                                                    {{ $buysell->other_payment_term }}
                                                @else
                                                    {{ str_replace(',', ', ', $buysell->payment_terms) }}
                                                @endif
											</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <hr class="horizontal-line">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="companyTab2">
                        <div class="alert alert-success m-0 mb-2 text-center" id='alert-success'
                             style="display:none;"
                             role="alert"></div>
                        <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error'
                             style="display:none;"
                             role="alert"></div>
                        <ul class="nav nav-tabs" id="aboutLinks" role="tablist">
                            <li class="product-tab-btn nav-item">
                                <a class="nav-link active product-service-info" id="linkReg" data-toggle="tab"
                                   href="#tabReg" role="tab"
                                   aria-controls="tabReg" aria-selected="true">
                                    @if(in_array("Buy", explode(",", $buysell->product_service_types)) || in_array("Sell", explode(",", $buysell->product_service_types)))
                                        Product Info
                                    @else
                                        Product Info
                                    @endif
                                </a>
                            </li>
                            {{--                                <li class="product-tab-btn nav-item trade-info"--}}
                            {{--                                    @if(!in_array("Sell", explode(",", $buysell->product_service_types))) style="display: none;" @endif>--}}
                            {{--                                    <a class="nav-link" id="linkCom" data-toggle="tab" href="#tabCom" role="tab"--}}
                            {{--                                       aria-controls="tabCom" aria-selected="false">Trade Info</a>--}}
                            {{--                                </li>--}}
                            <li class="product-tab-btn nav-item">
                                <a class="nav-link payment-delivery-info" id="linkInfo" data-toggle="tab"
                                   href="#tabInfo" role="tab"
                                   aria-controls="tabInfo"
                                   aria-selected="false">@if(in_array("Buy", explode(",", $buysell->product_service_types)) || in_array("Sell", explode(",", $buysell->product_service_types)))
                                        Payment Info
                                    @else
                                        Payment Info
                                    @endif</a>
                            </li>
                            <li class="w-unset my-sm-0 d-sm-flex d-inline-block justify-content-end ml-auto nav-item">
                                <button type="submit" class="red-btn updt-button" form="updateBuysell">UPDATE</button>
                            </li>
                            <li class="w-unset my-sm-0 ml-2 d-sm-flex d-inline-block justify-content-end nav-item">
                                <button class="text-uppercase red-btn close-form" href="#ad-cancil" data-toggle="modal">CLOSE</button>
                            </li>
                            <div id="ad-cancil" class="change-password-modal modal fade">
                                <div class="modal-dialog modal-dialog-centered modal-login">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="modal-title">Close Form</span>
                                            <button  class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body pt-3">
                                            <p style="color: white">The changes will not be saved – Do you want to continue?</p>
                                            <div class="form-group mt-4 mb-0">
                                                <button class="red-btn add-cancil-form" type="submit">Proceed</button>
                                                <button class="red-btn" data-dismiss="modal" aria-hidden="true">Cancel</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                        <form id="updateBuysell" name="updateBuysell" method="post"
                              action="{{ route('buy-sell.update', $buysell->id) }}"
                              enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('put')
                            <div class="tab-content" id="myCompanyTab">
                                <div class="py-2 tab-pane fade show active" id="tabReg" role="tabpanel"
                                     aria-labelledby="tabReg">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="font-500">Update Your Deal As
                                                <span class="required"> *</span>
                                            </label>
                                            <div class="d-flex flex-row">
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
                                                           @if(in_array("Buy", explode(",", $buysell->product_service_types))) checked="true"
                                                           @endif
                                                           class="custom-control-input product-buy-sell"
                                                           value="Buy" id="productBuy"
                                                           name="product_service_types[]">
                                                    <label class="custom-control-label"
                                                           for="productBuy">Buyer</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
                                                           @if(in_array("Sell", explode(",", $buysell->product_service_types))) checked="true"
                                                           @endif
                                                           class="custom-control-input product-buy-sell"
                                                           value="Sell" id="productSell"
                                                           name="product_service_types[]">
                                                    <label class="custom-control-label"
                                                           for="productSell">Seller</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
                                                           @if(in_array("Service", explode(",", $buysell->product_service_types))) checked="true"
                                                           @endif
                                                           class="custom-control-input product-buy-sell"
                                                           value="Service" id="productService"
                                                           name="product_service_types[]">
                                                    <label class="custom-control-label"
                                                           for="productService">Service Seeker</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label for="category" class="d-none font-500">Main Category
                                                <span class="required"> *</span>
                                            </label>
                                            <div class="position-relative">
                                                <select class="form-control product-categories" id="category"
                                                        name="category" required val="{{ $buysell->category_id }}">
                                                    <option value="Main Category *" disabled> Main Category *</option>
                                                    @foreach(\App\Category::all() as $category)
                                                        <option value="{{ $category->id }}"
                                                                cat-val="{{ $category->name }}"
                                                                @if(in_array("Service", explode(",", $buysell->product_service_types)) && $category->type == 'Business') class="d-none"
                                                                @endif
                                                                @if(!in_array("Service", explode(",", $buysell->product_service_types)) && $category->type == 'Services') class="d-none"
                                                                @endif
                                                                @if($buysell->category_id == $category->id) selected
                                                                @endif
                                                                cat-type="{{ $category->type }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="d-none position-absolute spinner-border text-danger loading-icon">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="category_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="sub_category" class="d-none font-500">Sub-Category
                                                <span class="required"> *</span>
                                            </label>
                                            <div class="position-relative">
                                                <select class="form-control product-subcategories" id="sub_category"
                                                        name="sub_category" required
                                                        val="{{ $buysell->subcategory_id }}">
                                                    <option value="Sub-Category *" disabled>Sub-Category *</option>
                                                    @foreach(\App\Subcategory::where('category_id', \App\Category::where('id', $buysell->category_id)->first()->id)->get() as $sub_category)
                                                        <option value="{{ $sub_category->id }}"
                                                                cat-val="{{ $sub_category->name }}"
                                                                @if($buysell->subcategory_id == $sub_category->id) selected @endif >{{ $sub_category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="d-none position-absolute spinner-border text-danger loading-icon">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="sub_category_error"></small>
                                        </div>
                                    </div>
                                    @if(!in_array("Service", explode(",", $buysell->product_service_types)))
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 d-flex flex-column subCat-Sec">
                                                <label for="sub_sub_category" class="d-none font-500">Product Type<span class="required"> *</span></label>
                                                <select class="form-control single-select-dropdown" id="sub_sub_category" name="sub_sub_category" required val="{{ $buysell->childsubcategory_id }}">
                                                    <option value="Product Type *" disabled>Product Type *</option>
                                                    @foreach (\App\Childsubcategory::where('subcategory_id', \App\Subcategory::where('id', $buysell->subcategory_id)->first()->id)->get() as $sub_sub_category)
                                                        <option value="{{ $sub_sub_category->id }}" cat-val="{{ $sub_sub_category->name }}"
                                                                @if($buysell->childsubcategory_id == $sub_sub_category->id) selected @endif >{{ $sub_sub_category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-danger" id="sub_sub_category_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 add-sub-sub-cat">
                                                <label class="font-500">Add Sub-Sub-Category <span class="required">*</span></label>
                                                <input type="text" name="add_sub_sub_category" value="{{ $buysell->add_sub_sub_category }}" class="form-control" required>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 clearfix">
                                            <label for="subject" class="d-none font-500">Subject
                                                <span class="required"> *</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" id="subject" class="h-auto form-control" maxlength = "80" name="subject"
                                                       placeholder="It will appear as title"
                                                       value="{{ $buysell->subject }}"
                                                       required>
                                                <div class="input-group-append counter-span">
                                                    <span class="text-danger font-500"><span class="counter-total-digits">0</span>/80</span>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="subject_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 clearfix product-name">
                                            <label for="product_service_name" class="d-none font-500">Product Name
                                                <span class="required"> *</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" id="product_service_name"
                                                   value="{{ $buysell->product_service_name }}" maxlength = "50" class="h-auto form-control"
                                                   name="product_service_name" placeholder="Product Name" required>
                                                <div class="input-group-append counter-span">
                                                    <span class="text-danger font-500"><span class="counter-total-digits">0</span>/50</span>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="product_service_name_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-3">
                                            <label class="d-none font-500">Ad Expiry Days <span
                                                    class="required"> *</span></label>
                                            <select name="expiry_date" id="expiry_date" class="form-control add-date" required>
                                                <option value="10" @if($buysell->expiry_data == "10") selected @endif>10 Days</option>
                                                <option value="20" @if($buysell->expiry_data == "20") selected @endif>20 Days</option>
                                                <option value="30" @if($buysell->expiry_data == "30") selected @endif>30 Days</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label class="d-none font-500">Ad Expiry Date</label>
                                            <input type="text" name="date_expire" id="date_expire" value="@if($buysell->date_expire){{date('d-m-Y',strtotime($buysell->date_expire))}}@endif" class="form-control append-inp" readonly/>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="d-none font-500">
                                                Additional Keyword
                                                <span class="fa fa-question-circle" data-toggle="tooltip"
                                                      data-placement="right"
                                                      title="Please select appropriate words with exact spellings for better search of your product"
                                                      aria-hidden="true"></span>
                                                <small class="font-500"> (Optional)</small>
                                            </label>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <input type="text" id="keyword1" name="keyword1"
                                                           value="{{ $buysell->keyword1 }}"
                                                           class="form-control" placeholder="Additional Keyword For Search (Optional) - Keyword 1">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" id="keyword2" name="keyword2"
                                                           value="{{ $buysell->keyword2 }}"
                                                           class="form-control" placeholder="Additional Keyword For Search (Optional) - Keyword 2">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" id="keyword3" name="keyword3"
                                                           value="{{ $buysell->keyword3 }}"
                                                           class="form-control" placeholder="Additional Keyword For Search (Optional) - Keyword 3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label class="font-500">Specification Sheets<br><small class="font-500">(Optional
                                                    | JPG, PNG, Word, Excel & PDF files only | Upto
                                                    10MB)</small></label>
                                            <div class="dropzone dz-clickable">
                                                <div class="my-0 dz-default dz-message" data-dz-message="">
                                                    <div class="mx-0 row product-img-sheet">
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image16" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet16" id="bsheet16" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet16_url" type="hidden" value="" id="bsheet16_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image17" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet17" id="bsheet17" type="file" accept="image/*"/>
                                                                <input name="bsheet17_url" type="hidden" value="" id="bsheet17_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image18" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet18" id="bsheet18" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet18_url" type="hidden" value="" id="bsheet18_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image19" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet19" id="bsheet19" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet19_url" type="hidden" value="" id="bsheet19_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image20" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet20" id="bsheet20" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet20_url" type="hidden" value="" id="bsheet20_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image21" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet21" id="bsheet21" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet21_url" type="hidden" value="" id="bsheet21_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image22" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet22" id="bsheet22" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet22_url" type="hidden" value="" id="bsheet22_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image23" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet23" id="bsheet23" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet23_url" type="hidden" value="" id="bsheet23_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image24" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet24" id="bsheet24" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet24_url" type="hidden" value="" id="bsheet24_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image25" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet25" id="bsheet25" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet25_url" type="hidden" value="" id="bsheet25_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image26" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet26" id="bsheet26" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet26_url" type="hidden" value="" id="bsheet26_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image27" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet27" id="bsheet27" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet27_url" type="hidden" value="" id="bsheet27_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image28" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet28" id="bsheet28" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet28_url" type="hidden" value="" id="bsheet28_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image29" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet29" id="bsheet29" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet29_url" type="hidden" value="" id="bsheet29_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image30" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bsheet30" id="bsheet30" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bsheet30_url" type="hidden" value="" id="bsheet30_url" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="product_images" class="font-500">Product Images <span
                                                    class="required"> *</span>
                                                <small class="font-500">(Note: First image will be displayed as Ad Cover Photo)</small>
                                                <br><small class="font-500">(Atleast one product image | Upto
                                                    10MB)</small></label>
                                            <div class="dropzone dz-clickable">
                                                <div class="my-0 dz-default dz-message" data-dz-message="">
                                                    <div class="mx-0 row product-img-sheet">
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image1" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar1" id="bavatar1" type="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="bavatar1_url" type="hidden" value="" id="bavatar1_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image2" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar2" id="bavatar2" type="file" accept="image/*"/>
                                                                <input name="bavatar2_url" type="hidden" value="" id="bavatar2_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image3" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar3" id="bavatar3" type="file" accept="image/*"/>
                                                                <input name="bavatar3_url" type="hidden" value="" id="bavatar3_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image4" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar4" id="bavatar4" type="file" accept="image/*"/>
                                                                <input name="bavatar4_url" type="hidden" value="" id="bavatar4_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image5" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar5" id="bavatar5" type="file" accept="image/*"/>
                                                                <input name="bavatar5_url" type="hidden" value="" id="bavatar5_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image6" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar6" id="bavatar6" type="file" accept="image/*"/>
                                                                <input name="bavatar6_url" type="hidden" value="" id="bavatar6_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image7" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar7" id="bavatar7" type="file" accept="image/*"/>
                                                                <input name="bavatar7_url" type="hidden" value="" id="bavatar7_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image8" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar8" id="bavatar8" type="file" accept="image/*"/>
                                                                <input name="bavatar8_url" type="hidden" value="" id="bavatar8_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image9" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar9" id="bavatar9" type="file" accept="image/*"/>
                                                                <input name="bavatar9_url" type="hidden" value="" id="bavatar9_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image10" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar10" id="bavatar10" type="file" accept="image/*"/>
                                                                <input name="bavatar10_url" type="hidden" value="" id="bavatar10_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image11" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar11" id="bavatar11" type="file" accept="image/*"/>
                                                                <input name="bavatar11_url" type="hidden" value="" id="bavatar11_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image12" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar12" id="bavatar12" type="file" accept="image/*"/>
                                                                <input name="bavatar12_url" type="hidden" value="" id="bavatar12_url" />
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image13" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar13" id="bavatar13" type="file" accept="image/*"/>
                                                                <input name="bavatar13_url" type="hidden" value="" id="bavatar13_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image14" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar14" id="bavatar14" type="file" accept="image/*"/>
                                                                <input name="bavatar14_url" type="hidden" value="" id="bavatar14_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="buploaded_image15" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div class="spinner-border text-danger loader-spinner d-none"
                                                                         role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="bavatar15" id="bavatar15" type="file" accept="image/*"/>
                                                                <input name="bavatar15_url" type="hidden" value="" id="bavatar15_url" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <div class="product-img-spec-container">
                                                <h6 class="my-1 px-2 heading pro-spec-heading">Specification Sheets</h6>
                                                <div class="product-images-gallery">
                                                    <ul class="mx-0 mb-2 product-gallery edit-comp-prof-imgs">
                                                        @foreach(App\Helpers\BuysellHelper::getSheets($buysell->id) as $file)
                                                            <?php $pathinfo = pathinfo($file->sheet);
                                                            $supported_ext = array('docx', 'xlsx', 'pdf');
                                                            $src_file_name = $file->sheet;
                                                            $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                                            @if($ext=="docx")
                                                                <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                                    data-src="{{$file->sheet}}"
                                                                    data-pinterest-text="Pin it"
                                                                    data-tweet-text="share on twitter">
                                                                    <img class="img-responsive product-img"
                                                                         src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png"
                                                                         style="filter: brightness(0.5)">
                                                                    <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                                    <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$file->id}}"></span>

                                                                </li>
                                                            @elseif($ext=="xlsx")
                                                                <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                                    data-src="{{$file->sheet}}"
                                                                    data-pinterest-text="Pin it"
                                                                    data-tweet-text="share on twitter">
                                                                    <img class="img-responsive product-img"
                                                                         src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png"
                                                                         style="filter: brightness(0.5)">
                                                                    <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                                    <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$file->id}}"></span>

                                                                </li>
                                                            @elseif($ext=="pdf")
                                                                <li class="position-relative d-inline-block my-1 d-flex justify-content-center align-items-center"
                                                                    data-src="{{$file->sheet}}"
                                                                    data-pinterest-text="Pin it"
                                                                    data-tweet-text="share on twitter">
                                                                    <img class="img-responsive product-img"
                                                                         src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png"
                                                                         style="filter: brightness(0.5)">
                                                                    <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                                    <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$file->id}}"></span>

                                                                </li>
                                                            @else
                                                                <li class="position-relative d-inline-block my-1">
                                                                    <input type="hidden" name='sheet_id' value="{{encrypt($file->id)}}">
                                                                    <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$file->id}}" aria-hidden="true"></span>
                                                                    <div class="include-in-gallery"
                                                                         data-src="{{$file->sheet}}"
                                                                         data-pinterest-text="Pin it"
                                                                         data-tweet-text="share on twitter">
                                                                        <a href="">
                                                                            <img class="img-responsive product-img" src="{{$file->sheet}}">
                                                                            <div class="demo-gallery-poster">
                                                                                <span class="fa fa-eye text-white"></span>
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

                                        <div class="form-group col-lg-6">
                                            <div class="product-img-spec-container">
                                                <h6 class="my-2 px-2 heading pro-img-heading">Product Images</h6>
                                                <div class="product-images-gallery">
                                                    <ul class="mx-0 mb-2 product-gallery edit-comp-prof-imgs">
                                                        @foreach(App\Helpers\BuysellHelper::getImages($buysell->id) as $image)
                                                            <li class="position-relative d-inline-block my-1">
                                                                <input type="hidden" name='img_id' value="{{encrypt($image->id)}}">
                                                                <span class="position-absolute border-0 specification-bin specs fa fa-trash" img_id="{{$image->id}}" aria-hidden="true"></span>
                                                                <div class="include-in-gallery"
                                                                     data-src="{{$image->image}}"
                                                                     data-pinterest-text="Pin it"
                                                                     data-tweet-text="share on twitter">
                                                                    <a href="">
                                                                        <img class="img-responsive product-img" src="{{$image->image}}">
                                                                        <div class="demo-gallery-poster">
                                                                            <span class="fa fa-eye text-white"></span>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-success mt-2 mb-2 text-center" id='alert-success'
                                             style="display:none;"
                                             role="alert">
                                        </div>
                                    </div>
                                    @if(in_array("Buy", explode(",", $buysell->product_service_types)) || in_array("Sell", explode(",", $buysell->product_service_types)))
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 product-available">
                                                <label class="d-none font-500 avail-quantity">Available Quantity <span
                                                        class="required"> *</span></label>
                                                <input type="number" min="0" id="product_availability"
                                                       value="{{ $buysell->product_availability }}" class="form-control"
                                                       name="product_availability" placeholder="Available Quantity * - e.g 50, 100" required>
                                                <small class="text-danger" id="product_availability_error"></small>
                                            </div>
                                            {{--                                        <div class="form-group col-lg-6">--}}
                                            {{--                                            <label class="font-500">Price <span class="required"> *</span></label>--}}
                                            {{--                                            <input type="text" class="form-control" id="price"--}}
                                            {{--                                                   value="{{ $buysell->price }}" name="price" placeholder="Price"--}}
                                            {{--                                                   required>--}}
                                            {{--                                        </div>--}}
                                            <div class="form-group col-lg-6 product-available">
                                                <label for="available_unit" class="d-none font-500">Unit <span class="required"> *</span></label>
                                                <select class="form-control other-option-included" id="available_unit" name="available_unit">
                                                    <option value="Unit *" disabled>Unit *</option>
                                                    <option value="20' Container"
                                                            @if($buysell->available_unit == "20' Container") selected @endif>
                                                        20' Container
                                                    </option>
                                                    <option value="40' Container"
                                                            @if($buysell->available_unit == "40' Container") selected @endif>
                                                        40' Container
                                                    </option>
                                                    <option value="Bale"
                                                            @if($buysell->available_unit == 'Bale') selected @endif>
                                                        Bale
                                                    </option>
                                                    <option value="Barel"
                                                            @if($buysell->available_unit == 'Barel') selected @endif>
                                                        Barel
                                                    </option>
                                                    <option value="Box"
                                                            @if($buysell->available_unit == 'Box') selected @endif>
                                                        Box
                                                    </option>
                                                    <option value="Bag"
                                                            @if($buysell->available_unit == 'Bag') selected @endif>
                                                        Bag
                                                    </option>
                                                    <option value="Carton"
                                                            @if($buysell->available_unit == 'Carton') selected @endif>
                                                        Carton
                                                    </option>
                                                    <option value="Cone"
                                                            @if($buysell->available_unit == 'Cone') selected @endif>
                                                        Cone
                                                    </option>
                                                    <option value="Dozen"
                                                            @if($buysell->available_unit == 'Dozen') selected @endif>
                                                        Dozen
                                                    </option>
                                                    <option value="Gallon"
                                                            @if($buysell->available_unit == 'Gallon') selected @endif>
                                                        Gallon
                                                    </option>
                                                    <option value="Gram"
                                                            @if($buysell->available_unit == 'Gram') selected @endif>
                                                        Gram
                                                    </option>
                                                    <option value="Gross"
                                                            @if($buysell->available_unit == 'Gross') selected @endif>
                                                        Gross
                                                    </option>
                                                    <option value="Kg"
                                                            @if($buysell->available_unit == 'Kg') selected @endif>
                                                        Kg
                                                    </option>
                                                    <option value="Lb"
                                                            @if($buysell->available_unit == 'Lb') selected @endif>
                                                        Lb
                                                    </option>
                                                    <option value="Liter"
                                                            @if($buysell->available_unit == 'Liter') selected @endif>
                                                        Liter
                                                    </option>
                                                    <option value="Meter"
                                                            @if($buysell->available_unit == 'Meter') selected @endif>
                                                        Meter
                                                    </option>
                                                    <option value="MT"
                                                            @if($buysell->available_unit == 'MT') selected @endif>
                                                        MT
                                                    </option>
                                                    <option value="Pack"
                                                            @if($buysell->available_unit == 'Pack') selected @endif>
                                                        Pack
                                                    </option>
                                                    <option value="Pair"
                                                            @if($buysell->available_unit == 'Pair') selected @endif>
                                                        Pair
                                                    </option>
                                                    <option value="Pallet"
                                                            @if($buysell->available_unit == 'Pallet') selected @endif>
                                                        Pallet
                                                    </option>
                                                    <option value="Piece"
                                                            @if($buysell->available_unit == 'Piece') selected @endif>
                                                        Piece
                                                    </option>
                                                    <option value="Pound"
                                                            @if($buysell->available_unit == 'Pound') selected @endif>
                                                        Pounds
                                                    </option>
                                                    <option value="Roll"
                                                            @if($buysell->available_unit == 'Roll') selected @endif>
                                                        Roll
                                                    </option>
                                                    <option value="Set"
                                                            @if($buysell->available_unit == 'Set') selected @endif>
                                                        Set
                                                    </option>
                                                    <option value="Sheet"
                                                            @if($buysell->available_unit == 'Sheet') selected @endif>
                                                        Sheet
                                                    </option>
                                                    <option value="Spool"
                                                            @if($buysell->available_unit == 'Spool') selected @endif>
                                                        Spool
                                                    </option>
                                                    <option value="Square Feet"
                                                            @if($buysell->available_unit == 'Square Feet') selected @endif>
                                                        Square Feet
                                                    </option>
                                                    <option value="Square Meter"
                                                            @if($buysell->available_unit == 'Square Meter') selected @endif>
                                                        Square Meter
                                                    </option>
                                                    <option value="Ton"
                                                            @if($buysell->available_unit == 'Ton') selected @endif>
                                                        Ton
                                                    </option>
                                                    <option value="Yard"
                                                            @if($buysell->available_unit == 'Yard') selected @endif>
                                                        Yard
                                                    </option>
                                                    <option value="Other"
                                                            @if($buysell->available_unit == 'Other') selected
                                                            @endif class="other-check">Other
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6 other-div" @if($buysell->available_unit == 'Other') style="display: block;"
                                                @endif>
                                                <label class="d-none font-500">Other Unit <span
                                                        class="required">*</span></label>
                                                <input type="text" name="other_available_unit" placeholder="Other Unit *" value="{{ $buysell->other_available_unit }}" class="form-control">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-row">
                                        <div class="form-group col-lg-6"
                                             @if(in_array("Service", explode(",", $buysell->product_service_types))) style="display: none;" @endif>
                                            <label for="manufacturer_name" class="d-none font-500 manufacturer_name">Manufacturer Name <span
                                                    class="required">*</span></label>
                                            <input type="text" id="manufacturer_name"
                                                   value="{{ \Auth::user()->name }}"
                                                   name="manufacturer_name"
                                                   class="form-control manufacturer-name optional-field"
                                                   placeholder="Manufacturer Name (Optional) - Manufacture spelling must be correct to be visible in the search."
                                                   required>
                                            <small class="text-danger" id="manufacturer_name_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6"
                                             @if(in_array("Service", explode(",", $buysell->product_service_types))) style="display: none;" @endif>
                                            <label for="origin" class="d-none font-500">Product Origin <span
                                                    class="required"> *</span></label>
                                            <select class="form-control origin" id="origin" name="origin" required>
                                                <option value="Product Origin *" disabled>Product Origin *</option>
                                                <option value="Any"
                                                        @if($buysell->origin == 'Any') selected @endif >Any</option>
                                                @foreach(\DB::table('countries')->get() as $country)
                                                    <option value="{{ $country->country_name }}"
                                                            @if($buysell->origin == $country->country_name) selected @endif >{{ $country->country_name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="origin_error"></small>
                                        </div>
                                    </div>
                                    <div class="additional-product-info machinery-info">
                                        <span class="d-block mb-1 heading">Products Specification</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-none font-500">Brand Name
                                                    <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="brand_name"
                                                       @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->brand_name) value="{{ $buysell->machineryBuySellInfo->brand_name }}"
                                                       @endif class="form-control optional-field"
                                                       name="brand_name"
                                                       placeholder="Brand Name (Optional)">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="d-none font-500">Model Number
                                                    <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="model_number"
                                                       @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->model_no) value="{{ $buysell->machineryBuySellInfo->model_no }}"
                                                       @endif class="form-control optional-field"
                                                       name="model_number"
                                                       placeholder="Model Number (Optional)">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="d-none font-500">Year of Manufacturing
                                                    <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="year_manufacturing"
                                                       @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->year_manufacture) value="{{ $buysell->machineryBuySellInfo->year_manufacture }}"
                                                       @endif class="form-control optional-field"
                                                       name="year_manufacturing"
                                                       placeholder="Year of Manufacturing (Optional)">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-500">After Sales Service <span
                                                        class="required">*</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="Yes"
                                                               id="productYes" name="after_sales_service"
                                                               @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->after_sales_service == "Yes") checked="true"
                                                               @endif  required>
                                                        <label class="custom-control-label" for="productYes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="No"
                                                               id="productNo" name="after_sales_service"
                                                               @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->after_sales_service == "No") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label" for="productNo">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input"
                                                               value="Not Applicable" id="productNa"
                                                               name="after_sales_service"
                                                               @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->after_sales_service == "Not Applicable") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label" for="productNa">Not
                                                            Applicable</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="after_sales_service_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 type-of-service other-div" {{ ($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->after_sales_service== "Yes") ? 'style=display:block;' : '' }}>
                                                <label for="service_type" class="font-500">Type of Service <span
                                                        class="required">*</span></label>
                                                <input type="text" id="service_type" class="form-control"
                                                       name="service_type" placeholder="Type of Service"
                                                       @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->service_type) value="{{ $buysell->machineryBuySellInfo->service_type }}"
                                                       @endif required>
                                                <small class="text-danger" id="service_type_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-500">Warranty <span
                                                        class="required"> *</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="Yes"
                                                               id="warrantyYes" name="warranty"
                                                               @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->warranty == "Yes") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label"
                                                               for="warrantyYes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="No"
                                                               id="warrantyNo" name="warranty"
                                                               @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->warranty == "No") checked="true"
                                                            @endif >
                                                        <label class="custom-control-label" for="warrantyNo">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input"
                                                               value="Not Applicable" id="warrantyNa"
                                                               name="warranty"
                                                               @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->warranty == "Not Applicable") checked="true"
                                                            @endif >
                                                        <label class="custom-control-label" for="warrantyNa">Not
                                                            Applicable</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="warranty_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 warranty-services other-div" {{ ($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->warranty== "Yes") ? 'style=display:block;' : '' }}>
                                                <label for="warranty_period" class="font-500">Warranty Period <span
                                                        class="required">*</span></label>
                                                <input type="text" id="warranty_period" class="form-control"
                                                       name="warranty_period" placeholder="Warranty Period"
                                                       @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->warranty_period) value="{{ $buysell->machineryBuySellInfo->warranty_period }}"
                                                       @endif  required>
                                                <small class="text-danger" id="warranty_period_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-500">Product Certification <span
                                                        class="required">*</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="Yes"
                                                               id="certifyYes" name="certification"
                                                               @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->certification == "Yes") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label" for="certifyYes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" value="No" class="custom-control-input"
                                                               id="certifyNo" name="certification"
                                                               @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->certification == "No") checked="true"
                                                            @endif >
                                                        <label class="custom-control-label" for="certifyNo">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" value="Not Applicable"
                                                               class="custom-control-input" id="certifyNa"
                                                               name="certification"
                                                               @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->certification == "Not Applicable") checked="true"
                                                            @endif >
                                                        <label class="custom-control-label" for="certifyNa">Not
                                                            Applicable</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="certification_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 certify-services other-div" {{ ($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->certification== "Yes") ? 'style=display:block;' : '' }}>
                                                <label for="certification_details" class="font-500">Certification
                                                    Details <span class="required"> *</span></label>
                                                <input type="text" id="certification_details" class="form-control"
                                                       name="certification_details" placeholder="Certification Details"
                                                       @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->certification_details) value="{{ $buysell->machineryBuySellInfo->certification_details }}"
                                                       @endif required>
                                                <small class="text-danger" id="certification_details_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            {{--                                            <div class="form-group col-lg-6">--}}
                                            {{--                                                <label for="additional_trade_notes" class="font-500">Additional Trade--}}
                                            {{--                                                    notes <small class="font-500"> (Optional)</small></label>--}}
                                            {{--                                                <input type="text" class="form-control optional-field"--}}
                                            {{--                                                       id="additional_trade_notes" name="additional_trade_notes"--}}
                                            {{--                                                       placeholder="Additional Trade notes"--}}
                                            {{--                                                       @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->additional_trade_notes) value="{{ $buysell->machineryBuySellInfo->additional_trade_notes }}"--}}
                                            {{--                                                    @endif >--}}
                                            {{--                                            </div>--}}
                                            <div class="form-group col-lg-6">
                                                <label for="product_related_certifications" class="d-none font-500">Company
                                                    Certifications <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="product_related_certifications"
                                                       @if($buysell->machineryBuySellInfo && $buysell->machineryBuySellInfo->product_related_certifications) value="{{ $buysell->machineryBuySellInfo->product_related_certifications }}"
                                                       @endif class="form-control optional-field"
                                                       name="product_related_certifications"
                                                       placeholder="Company Certifications (Optional) - Product Related certifications">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="editor1" class="d-none font-500">Additional Info <small class="font-500">
                                                    (Optional)</small></label>
                                            <span class="d-block font-500">(Limit = 1200 Characters)</span>
                                            <textarea id="editor1" rows="5" maxlength = "1200" class="form-control" name="details"
                                                      placeholder="Additional Info (Optional)">{!! $buysell->details !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="mt-3" align="right">
                                        <a class="text-white red-btn next-btn" id="nextBtn1">NEXT</a>
                                    </div>
                                    <div class="mt-4 mb-4">
                                        <hr class="horizontal-line">
                                    </div>
                                </div>
                                <div class="py-2 tab-pane fade payment-info-tab" id="tabInfo" role="tabpanel"
                                     aria-labelledby="tabInfo">
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 unit_price_range"
                                             @if(in_array("Sell", explode(",", $buysell->product_service_types)) || in_array("Service", explode(",", $buysell->product_service_types))) style="display: block;" @endif>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="unit_price_from" class="d-none font-500 unit_price_range_label"
                                                           @if(in_array("Sell", explode(",", $buysell->product_service_types))) style="display: block;"
                                                           @else style="display: none;" @endif>Unit Price <span
                                                            class="required">*</span></label>
                                                    <label for="unit_price_from"
                                                           class="d-none font-500 service_charges_range_label"
                                                           @if(in_array("Service", explode(",", $buysell->product_service_types))) style="display: block;"
                                                           @else style="display: none;" @endif>Service Charges <span
                                                            class="required">*</span></label>
                                                    <input type="number" min="0" id="unit_price_from" class="form-control"
                                                           name="unit_price_from"
                                                           @if($buysell->unit_price_from) value="{{ $buysell->unit_price_from }}"
                                                           @endif placeholder="e.g. 1000" required>
                                                </div>
                                                @if(in_array("Sell", explode(",", $buysell->product_service_types)))
                                                    <div class="col-md-6">
                                                        <label for="unit_price_unit" class="font-500 unit_price_range_label">Per Unit <span
                                                                class="required">*</span></label>
                                                        <select class="form-control other-option-included"
                                                                id="unit_price_unit"
                                                                name="unit_price_unit" required>
                                                            <option value="20' Container"
                                                                    @if($buysell->unit_price_unit == "20' Container") selected @endif>
                                                                20' Container
                                                            </option>
                                                            <option value="40' Container"
                                                                    @if($buysell->unit_price_unit == "40' Container") selected @endif>
                                                                40' Container
                                                            </option>
                                                            <option value="Bale"
                                                                    @if($buysell->unit_price_unit == 'Bale') selected @endif>
                                                                Bale
                                                            </option>
                                                            <option value="Barel"
                                                                    @if($buysell->unit_price_unit == 'Barel') selected @endif>
                                                                Barel
                                                            </option>
                                                            <option value="Box"
                                                                    @if($buysell->unit_price_unit == 'Box') selected @endif>
                                                                Box
                                                            </option>
                                                            <option value="Bag"
                                                                    @if($buysell->unit_price_unit == 'Bag') selected @endif>
                                                                Bag
                                                            </option>
                                                            <option value="Carton"
                                                                    @if($buysell->unit_price_unit == 'Carton') selected @endif>
                                                                Carton
                                                            </option>
                                                            <option value="Cone"
                                                                    @if($buysell->unit_price_unit == 'Cone') selected @endif>
                                                                Cone
                                                            </option>
                                                            <option value="Dozen"
                                                                    @if($buysell->unit_price_unit == 'Dozen') selected @endif>
                                                                Dozen
                                                            </option>
                                                            <option value="Gallon"
                                                                    @if($buysell->unit_price_unit == 'Gallon') selected @endif>
                                                                Gallon
                                                            </option>
                                                            <option value="Gram"
                                                                    @if($buysell->unit_price_unit == 'Gram') selected @endif>
                                                                Gram
                                                            </option>
                                                            <option value="Gross"
                                                                    @if($buysell->unit_price_unit == 'Gross') selected @endif>
                                                                Gross
                                                            </option>
                                                            <option value="Kg"
                                                                    @if($buysell->unit_price_unit == 'Kg') selected @endif>
                                                                Kg
                                                            </option>
                                                            <option value="Lb"
                                                                    @if($buysell->unit_price_unit == 'Lb') selected @endif>
                                                                Lb
                                                            </option>
                                                            <option value="Liter"
                                                                    @if($buysell->unit_price_unit == 'Liter') selected @endif>
                                                                Liter
                                                            </option>
                                                            <option value="Meter"
                                                                    @if($buysell->unit_price_unit == 'Meter') selected @endif>
                                                                Meter
                                                            </option>
                                                            <option value="MT"
                                                                    @if($buysell->unit_price_unit == 'MT') selected @endif>
                                                                MT
                                                            </option>
                                                            <option value="Pack"
                                                                    @if($buysell->unit_price_unit == 'Pack') selected @endif>
                                                                Pack
                                                            </option>
                                                            <option value="Pair"
                                                                    @if($buysell->unit_price_unit == 'Pair') selected @endif>
                                                                Pair
                                                            </option>
                                                            <option value="Pallet"
                                                                    @if($buysell->unit_price_unit == 'Pallet') selected @endif>
                                                                Pallet
                                                            </option>
                                                            <option value="Piece"
                                                                    @if($buysell->unit_price_unit == 'Piece') selected @endif>
                                                                Piece
                                                            </option>
                                                            <option value="Pound"
                                                                    @if($buysell->unit_price_unit == 'Pound') selected @endif>
                                                                Pound
                                                            </option>
                                                            <option value="Roll"
                                                                    @if($buysell->unit_price_unit == 'Roll') selected @endif>
                                                                Roll
                                                            </option>
                                                            <option value="Set"
                                                                    @if($buysell->unit_price_unit == 'Set') selected @endif>
                                                                Set
                                                            </option>
                                                            <option value="Sheet"
                                                                    @if($buysell->unit_price_unit == 'Sheet') selected @endif>
                                                                Sheet
                                                            </option>
                                                            <option value="Spool"
                                                                    @if($buysell->unit_price_unit == 'Spool') selected @endif>
                                                                Spool
                                                            </option>
                                                            <option value="Square Feet"
                                                                    @if($buysell->unit_price_unit == 'Square Feet') selected @endif>
                                                                Square Feet
                                                            </option>
                                                            <option value="Square Meter"
                                                                    @if($buysell->unit_price_unit == 'Square Meter') selected @endif>
                                                                Square Meter
                                                            </option>
                                                            <option value="Ton"
                                                                    @if($buysell->unit_price_unit == 'Ton') selected @endif>
                                                                Ton
                                                            </option>
                                                            <option value="Yard"
                                                                    @if($buysell->unit_price_unit == 'Yard') selected @endif>
                                                                Yard
                                                            </option>
                                                            <option value="Other"
                                                                    @if($buysell->unit_price_unit == 'Other') selected
                                                                    @endif class="other-check">Other
                                                            </option>

                                                        </select>
                                                    </div>
                                                @endif
                                                @if(in_array("Service", explode(",", $buysell->product_service_types)))
                                                    <div class="col-md-6 service-unit">
                                                        <label for="price_unit" class="font-500">Per Unit <span class="required">*</span></label>
                                                        <input type="text" name="price_unit" id="price_unit" placeholder="Per Unit" value="@if($buysell->unit_price_unit){{$buysell->unit_price_unit}}@endif" class="form-control" required>
                                                        <small class="text-danger" id="price_unit_error"></small>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        @if(!in_array("Service", explode(",", $buysell->product_service_types)))
                                            <div class="form-group col-lg-6 other-div add-unit_price_unit"
                                                 @if($buysell->unit_price_unit == 'Other') style="display: block;"
                                                @endif>
                                                <label class="font-500">Other Price Unit <span
                                                        class="required">*</span></label>
                                                <input type="text" name="other_unit_price_unit"
                                                       value="{{ $buysell->other_unit_price_unit }}"
                                                       class="form-control" placeholder="Other Price Unit" required>
                                            </div>
                                        @endif
                                        <div class="form-group col-lg-6 target_price_range"
                                             @if(in_array("Buy", explode(",", $buysell->product_service_types))) style="display: block;" @endif>
                                            <div class="form-row">
                                                <div class="col-md-6 form-group">
                                                    <label for="target_price_from" class="d-none font-500">Target Price <span
                                                            class="required">*</span></label>
                                                    <input type="number" min="0" id="target_price_from"
                                                           @if($buysell->target_price_from) value="{{ $buysell->target_price_from }}"
                                                           @endif class="form-control"
                                                           name="target_price_from" placeholder="Target Price * - e.g. 1000" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="target_price_unit" class="d-none font-500">Per Unit <span
                                                            class="required">*</span></label>
                                                    <select class="form-control other-option-included"
                                                            id="target_price_unit"
                                                            name="target_price_unit" required>
                                                        <option value="Per Unit *" disabled>Per Unit *</option>
                                                        <option value="20' Container"
                                                                @if($buysell->target_price_unit == "20' Container") selected @endif>
                                                            20' Container
                                                        </option>
                                                        <option value="40' Container"
                                                                @if($buysell->target_price_unit == "40' Container") selected @endif>
                                                            40' Container
                                                        </option>
                                                        <option value="Bale"
                                                                @if($buysell->target_price_unit == 'Bale') selected @endif>
                                                            Bale
                                                        </option>
                                                        <option value="Barel"
                                                                @if($buysell->target_price_unit == 'Barel') selected @endif>
                                                            Barel
                                                        </option>
                                                        <option value="Box"
                                                                @if($buysell->target_price_unit == 'Box') selected @endif>
                                                            Box
                                                        </option>
                                                        <option value="Bag"
                                                                @if($buysell->target_price_unit == 'Bag') selected @endif>
                                                            Bag
                                                        </option>
                                                        <option value="Carton"
                                                                @if($buysell->target_price_unit == 'Carton') selected @endif>
                                                            Carton
                                                        </option>
                                                        <option value="Cone"
                                                                @if($buysell->target_price_unit == 'Cone') selected @endif>
                                                            Cone
                                                        </option>
                                                        <option value="Dozen"
                                                                @if($buysell->target_price_unit == 'Dozen') selected @endif>
                                                            Dozen
                                                        </option>
                                                        <option value="Gallon"
                                                                @if($buysell->target_price_unit == 'Gallon') selected @endif>
                                                            Gallon
                                                        </option>
                                                        <option value="Gram"
                                                                @if($buysell->target_price_unit == 'Gram') selected @endif>
                                                            Gram
                                                        </option>
                                                        <option value="Gross"
                                                                @if($buysell->target_price_unit == 'Gross') selected @endif>
                                                            Gross
                                                        </option>
                                                        <option value="Kg"
                                                                @if($buysell->target_price_unit == 'Kg') selected @endif>
                                                            Kg
                                                        </option>
                                                        <option value="Lb"
                                                                @if($buysell->target_price_unit == 'Lb') selected @endif>
                                                            Lb
                                                        </option>
                                                        <option value="Liter"
                                                                @if($buysell->target_price_unit == 'Liter') selected @endif>
                                                            Liter
                                                        </option>
                                                        <option value="Meter"
                                                                @if($buysell->target_price_unit == 'Meter') selected @endif>
                                                            Meter
                                                        </option>
                                                        <option value="MT"
                                                                @if($buysell->target_price_unit == 'MT') selected @endif>
                                                            MT
                                                        </option>
                                                        <option value="Pack"
                                                                @if($buysell->target_price_unit == 'Pack') selected @endif>
                                                            Pack
                                                        </option>
                                                        <option value="Pair"
                                                                @if($buysell->target_price_unit == 'Pair') selected @endif>
                                                            Pair
                                                        </option>
                                                        <option value="Pallet"
                                                                @if($buysell->target_price_unit == 'Pallet') selected @endif>
                                                            Pallet
                                                        </option>
                                                        <option value="Piece"
                                                                @if($buysell->target_price_unit == 'Piece') selected @endif>
                                                            Piece
                                                        </option>
                                                        <option value="Pound"
                                                                @if($buysell->target_price_unit == 'Pound') selected @endif>
                                                            Pound
                                                        </option>
                                                        <option value="Roll"
                                                                @if($buysell->target_price_unit == 'Roll') selected @endif>
                                                            Roll
                                                        </option>
                                                        <option value="Set"
                                                                @if($buysell->target_price_unit == 'Set') selected @endif>
                                                            Set
                                                        </option>
                                                        <option value="Sheet"
                                                                @if($buysell->target_price_unit == 'Sheet') selected @endif>
                                                            Sheet
                                                        </option>
                                                        <option value="Spool"
                                                                @if($buysell->target_price_unit == 'Spool') selected @endif>
                                                            Spool
                                                        </option>
                                                        <option value="Square Feet"
                                                                @if($buysell->target_price_unit == 'Square Feet') selected @endif>
                                                            Square Feet
                                                        </option>
                                                        <option value="Square Meter"
                                                                @if($buysell->target_price_unit == 'Square Meter') selected @endif>
                                                            Square Meter
                                                        </option>
                                                        <option value="Ton"
                                                                @if($buysell->target_price_unit == 'Ton') selected @endif>
                                                            Ton
                                                        </option>
                                                        <option value="Yard"
                                                                @if($buysell->target_price_unit == 'Yard') selected @endif>
                                                            Yard
                                                        </option>
                                                        <option value="Other"
                                                                @if($buysell->target_price_unit == 'Other') selected
                                                                @endif class="other-check">Other
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 other-div add-target_price_unit"
                                             @if($buysell->target_price_unit == 'Other') style="display: block;"
                                            @endif>
                                            <label class="d-none font-500">Add Your Price Unit <span
                                                    class="required">*</span></label>
                                            <input type="text" name="other_target_price_unit"
                                                   value="{{ $buysell->other_target_price_unit }}"
                                                   class="form-control" placeholder="Add Your Price Unit *" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label class="d-none font-500">Suitable Currency <span
                                                    class="required">*</span></label>
                                            <select class="form-control single-select-dropdown"
                                                    id="suitable_currencies" name="suitable_currencies" required>
                                                <option value="Suitable Currency *" disabled>Suitable Currency *</option>
                                                <option value="PKR" @if($buysell->suitable_currencies == "PKR") selected @endif>
                                                    PKR
                                                </option>
                                                <option value="USD" @if($buysell->suitable_currencies == "USD") selected @endif>
                                                    USD
                                                </option>
                                                <option value="Euro" @if($buysell->suitable_currencies == "Euro") selected @endif>
                                                    Euro
                                                </option>
                                                <option value="Yuan" @if($buysell->suitable_currencies == "Yuan") selected @endif>
                                                    Yuan
                                                </option>
                                                <option value="Swiss Franc" @if($buysell->suitable_currencies == "Swiss Franc") selected @endif>
                                                    Swiss Franc
                                                </option>
                                                <option value="JPY" @if($buysell->suitable_currencies == "JPY") selected @endif>
                                                    JPY
                                                </option>
                                                <option value="Other" class="other-check" @if($buysell->suitable_currencies == "Other") selected @endif>
                                                    Other
                                                </option>
                                            </select>
                                            <small class="text-danger" id="suitable_currencies_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 other-div add-suitable-currency"
                                             @if($buysell->suitable_currencies == "Other") style="display: block;" @endif>
                                            <label class="d-none font-500">Add Your Suitable Currency <span
                                                    class="required">*</span></label>
                                            <input type="text"
                                                   @if($buysell->other_suitable_currency) value="{{ $buysell->other_suitable_currency }}"
                                                   required
                                                   @endif name="other_suitable_currency" class="form-control"  placeholder="Add Your Suitable Currency *">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 product_lead_time">
                                            <label for="delivery_time" class="d-none font-500">Lead Time <small
                                                    class="font-500">(Optional)</small></label>
                                            <input type="text" id="lead_time" class="form-control"
                                                   name="delivery_time"
                                                   @if($buysell->delivery_time) value="{{ $buysell->delivery_time }}"
                                                   @endif
                                                   placeholder="Lead Time (Optional) - Suitable Lead Time">
                                        </div>
                                        <div class="form-group col-lg-6 product_delivery">
                                            <label class="font-500">Delivery</label>
                                            <div class="d-flex">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input"
                                                           value="Included"
                                                           @if($buysell->delivery == 'Included') checked
                                                           @endif id="delivery_included" name="delivery">
                                                    <label class="custom-control-label"
                                                           for="delivery_included">Included</label>
                                                </div>
                                                <div class="custom-control custom-radio ml-3">
                                                    <input type="radio" class="custom-control-input"
                                                           value="Not Included"
                                                           @if($buysell->delivery == 'Not Included') checked
                                                           @endif name="delivery"
                                                           id="delivery_notincluded">
                                                    <label class="custom-control-label"
                                                           for="delivery_notincluded">Not Included</label>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="delivery_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 services-container">
                                            <label class="d-none label">Service Duration <span
                                                    class="required">*</span></label>
                                            <select id="service_durations" name="service_durations[]"
                                                    class="select2-multiple form-control select-service-duration" multiple="multiple">
                                                <option value="Suitable Currency *" disabled>Service Duration *</option>
                                                <option value="One Time"
                                                        @if(in_array("One Time", explode(",", $buysell->service_durations))) selected @endif >
                                                    One Time
                                                </option>
                                                <option value="On Call"
                                                        @if(in_array("On Call", explode(",", $buysell->service_durations))) selected @endif >
                                                    On Call
                                                </option>
                                                <option value="Regular"
                                                        @if(in_array("Regular", explode(",", $buysell->service_durations))) selected @endif >
                                                    Regular
                                                </option>
                                                <option value="Daily"
                                                        @if(in_array("Daily", explode(",", $buysell->service_durations))) selected @endif >
                                                    Daily
                                                </option>
                                                <option value="Weekly"
                                                        @if(in_array("Weekly", explode(",", $buysell->service_durations))) selected @endif >
                                                    Weekly
                                                </option>
                                                <option value="After 15 Days"
                                                        @if(in_array("After 15 Days", explode(",", $buysell->service_durations))) selected @endif >
                                                    After 15 Days
                                                </option>
                                                <option value="Monthly"
                                                        @if(in_array("Monthly", explode(",", $buysell->service_durations))) selected @endif >
                                                    Monthly
                                                </option>
                                                <option value="Annually"
                                                        @if(in_array("Annually", explode(",", $buysell->service_durations))) selected @endif >
                                                    Annually
                                                </option>
                                                <option value="Other" class="other-check" @if(in_array("Other", explode(",", $buysell->service_durations))) selected @endif >Other</option>
                                            </select>
                                            <small class="text-danger" id="service_durations_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 add-services-duration other-div"
                                             @if(in_array("Other", explode(",", $buysell->service_durations))) style="display: block;" @endif>
                                            <label class="d-none font-500">Add Your Service Duration <span
                                                    class="required">*</span></label>
                                            <input id="other_service_duration" name="other_service_duration"
                                                   type="text"
                                                   @if($buysell->other_service_duration) value="{{ $buysell->other_service_duration }}"
                                                   required
                                                   @endif
                                                   class="form-control" placeholder="Add Your Service Duration *">
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label for="payment_terms" class="d-none font-500">Payment
                                                Terms
                                                <span class="required"> *</span></label>
                                            <select class="single-select-dropdown select-suitable-payment other-option-included form-control payment-terms"
                                                    id="payment_terms" name="payment_terms" required>
                                                <option value="Payment Terms *" selected disabled>Payment Terms *</option>
                                                <option value="L/C" @if($buysell->payment_terms == "L/C") selected @endif>
                                                    L/C
                                                </option>
                                                <option value="D/A" @if($buysell->payment_terms == "D/A") selected @endif>
                                                    D/A
                                                </option>
                                                <option value="D/P" @if($buysell->payment_terms == "D/P") selected @endif>
                                                    D/P
                                                </option>
                                                <option value="T/T" @if($buysell->payment_terms == "T/T") selected @endif>
                                                    T/T
                                                </option>
                                                <option value="CFR" @if($buysell->payment_terms == "CFR") selected @endif>
                                                    CFR
                                                </option>
                                                <option value="CIF" @if($buysell->payment_terms == "CIF") selected @endif>
                                                    CIF
                                                </option>
                                                <option value="CIP" @if($buysell->payment_terms == "CIP") selected @endif>
                                                    CIP
                                                </option>
                                                <option value="CPT" @if($buysell->payment_terms == "CPT") selected @endif>
                                                    CPT
                                                </option>
                                                <option value="FOB" @if($buysell->payment_terms == "FOB") selected @endif>
                                                    FOB
                                                </option>
                                                <option value="Ex-Works" @if($buysell->payment_terms == "Ex-Works") selected @endif>
                                                    Ex-Works
                                                </option>
                                                <option value="Western Union" @if($buysell->payment_terms == "Western Union") selected @endif>
                                                    Western
                                                    Union
                                                </option>
                                                <option value="PayPal" @if($buysell->payment_terms == "PayPal") selected @endif>
                                                    PayPal
                                                </option>
                                                <option value="Other" @if($buysell->payment_terms == "Other") selected @endif class="other-check">Other
                                                </option>
                                            </select>
                                            <small class="text-danger" id="payment_terms_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 other-div add-payment-terms"
                                             @if($buysell->payment_terms =='Other') style="display: block;" @endif>
                                            <label class="d-none font-500">Add Your Payment Terms <span
                                                    class="required">*</span></label>
                                            <input
                                                @if($buysell->other_payment_term) value="{{ $buysell->other_payment_term }}"
                                                required @endif type="text" id="other_payment_term"
                                                name="other_payment_term" class="form-control" placeholder="Add Your Payment Terms *">
                                        </div>
                                    </div>
                                    <div class="mt-3" align="right">
                                        <button type="submit" class="red-btn">UPDATE</button>
                                    </div>
                                    <div class="mt-4 mb-4">
                                        <hr class="horizontal-line">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </main>
    </body>

@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.1.24.min.js"></script>
    <script type="text/javascript">
        AWS.config.update({
            accessKeyId: 'AKIAT72REQKCOJOWLXVC',
            secretAccessKey: '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'
        });
        AWS.config.region = 'ap-south-1';
        ClassicEditor
            .create( document.querySelector( '#editor1' ) )
            .catch( error => {
                console.error( error );
            } );
        $(document).ready(function () {
            /*for add expiry days*/
            $( ".add-date" ).change(function() {
                var add_day = $(this).find(":checked").val();
                var input = $( ".append-inp" );
                // date addition
                var current_date = new Date();
                current_date.setDate(current_date.getDate() + parseInt(add_day))
                var new_date = current_date;
                input.val(("0" + new_date.getDate()).slice(-2)+'-'+("0"+(new_date.getMonth()+1)).slice(-2)+'-'+new_date.getFullYear());
            });
            /*for add expiry days*/
            /*
            $( ".updt-button" ).click(function() {
                $( "#updateBuysell" ).submit();
            });
            */
            $( ".updt-button" ).click(function() {
                var serviceProduct = $('#productService').prop('checked');
                if(serviceProduct==false) {
                    $('.services-container').hide();
                }
                else {
                    $('.services-container').show();
                }
            });
            /*for general select multiple*/
            $('.select2-multiple').select2({
                closeOnSelect: false,
                placeholder: "Select a state"
            });

            $('.select2-multiple').on('select2:select', function (e) {
                $(this).siblings('.select2').find('.select2-selection__choice').siblings('.select2-search--inline').css({'width': 'min-content', 'float': 'right'});
            });

            $('.select2-multiple').on('select2:unselect', function (e) {
                $(this).siblings('.select2').find('.select2-selection__rendered').children('.select2-search--inline').css({'width': '100%', 'float': 'left'});
            });
            /*for general select multiple*/

            /*for select single place holders*/
            $("#target_price_unit").select2({
                placeholder: "Per Unit *"
            });

            $("#unit_price_unit").select2({
                placeholder: "Per Unit *"
            });

            $("#origin").select2({
                placeholder: "Product Origin *"
            });

            $("#available_unit").select2({
                placeholder: "Unit *"
            });

            $("#expiry_date").select2({
                placeholder: "An Expiry Days *"
            });

            // $("#category").select2({
            //     placeholder: "Main Category *"
            // });

            $("#sub_category").select2({
                placeholder: "Sub-Category *"
            });

            $("#sub_sub_category").select2({
                placeholder: "Product Type *"
            });

            $('select[name=suitable_currencies]').select2({
                placeholder: "Select Suitable Currency *"
            });
            /*for select single place holders*/

            /*for select multiple place holders*/
            $('.select-suitable-payment').select2({
                placeholder: "Select Payment Terms *"
            });

            $('.select-suitable-type').select2({
                placeholder: "Select Dealing As"
            });

            $('.select-target-country').select2({
                placeholder: "Select Target Country"
            });

            $('.select-suitable-currency').select2({
                placeholder: "Select Suitable Currency"
            });

            $('.select-service-duration').select2({
                placeholder: "Select Service Duration *"
            });
            /*for select multiple place holders*/

            var validator = $("form[name='updateBuysell']").validate({
                onfocusout: function (element) {
                    var $element = $(element);
                    // console.log($element);
                    if ($element.hasClass('select2-search__field')) {
                        var $element2 = $element.closest('.form-group').find('.select2-multiple');
                        if ($element2.prop('required')) {
                            this.element($element2)
                        } else if ($element2.val() != '') {
                            this.element($element2)
                        } else {
                            $element2.removeClass('is-valid');
                        }
                    } else {
                        if ($element.prop('required')) {
                            this.element(element)
                        } else if ($element.val() != '') {
                            this.element($element)
                        } else {
                            $element.removeClass('is-valid');
                        }
                    }
                },
                rules: {
                    'product_service_types[]': {
                        required: true,
                        minlength: 1
                    },
                    'category':{
                        required: true,
                    },
                    'sub_category':{
                        required: true,
                    },
                    'sub_sub_category':{
                        required: true,
                    },
                    'subject':{
                        required: true,
                    },
                    'product_service_name':{
                        required: true,
                    },
                    'expiry_date':{
                        required: true,
                    },
                    'product_availability':{
                        required: true,
                    },
                    'available_unit':{
                        required: true,
                    },
                    'dealing_as[]':{
                        required: true,
                    },
                    'focused_selling_countries[]':{
                        required: true,
                    },
                    'unit_price_from':{
                        required: true,
                    },
                    'unit_price_unit':{
                        required: true,
                    },
                    'price_unit':{
                        required: true,
                    },
                    'suitable_currencies':{
                        required: true,
                    },
                    'payment_terms[]':{
                        required: true,
                    },
                    onkeyup: function (element) {
                        var $element = $(element);
                        $element.valid();
                    },
                },
                messages: {
                    'product_service_types[]': {
                        required: "Select Atleast One"
                    },
                    'category': {
                        required: "Main category is required"
                    },
                    'sub_category': {
                        required: "Sub category is required"
                    },
                    'sub_sub_category': {
                        required: "Product type is required"
                    },
                    'subject': {
                        required: "Subject is required"
                    },
                    'product_service_name': {
                        required: "Product name is required"
                    },
                    'expiry_date': {
                        required: "Expiry day is required"
                    },
                    'product_availability': {
                        required: "Available quantity is required"
                    },
                    'available_unit': {
                        required: "Unit is required"
                    },
                    'dealing_as[]': {
                        required: "Dealing product is required"
                    },
                    'focused_selling_countries[]': {
                        required: "Target selling countries required"
                    },
                    'unit_price_from': {
                        required: "Range from required"
                    },
                    'unit_price_unit': {
                        required: "Range unit required"
                    },
                    'price_unit': {
                        required: "Range unit required"
                    },
                    'suitable_currencies': {
                        required: "Suitable Currency is required"
                    },
                    'payment_terms[]': {
                        required: "Payment Term is required"
                    },
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                highlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.attr('type') == 'checkbox' || elem.attr('type') == 'radio') {
                        elem.closest('.form-group').find('input').addClass(errorClass);
                        elem.closest('.form-group').find('input').removeClass(validClass);
                    } else if (elem.hasClass('select2-multiple')) {
                        elem.closest('.form-group').find('input').addClass(errorClass);
                        elem.closest('.form-group').find('input').removeClass(validClass);
                        elem.closest('.form-group').find('span.select2-selection').addClass(errorClass);
                        elem.closest('.form-group').find('span.select2-selection').removeClass(validClass);
                    } else {
                        elem.addClass(errorClass);
                        elem.removeClass(validClass);
                    }
                },
                unhighlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.attr('type') == 'checkbox' || elem.attr('type') == 'radio') {
                        elem.closest('.form-group').find('input').removeClass(errorClass);
                        elem.closest('.form-group').find('input').addClass(validClass);
                    } else if (elem.hasClass('select2-multiple')) {
                        elem.closest('.form-group').find('input').addClass(validClass);
                        elem.closest('.form-group').find('input').removeClass(errorClass);
                        elem.closest('.form-group').find('span.select2-selection').removeClass(errorClass);
                        elem.closest('.form-group').find('span.select2-selection').addClass(validClass);
                    } else {
                        elem.removeClass(errorClass);
                        elem.addClass(validClass);
                    }
                    if (elem.siblings('small.text-danger')) {
                        elem.siblings('small.text-danger').html('');
                    } else if (elem.closest('.form-group').find('small.text-danger')) {
                        elem.closest('.form-group').find('small.text-danger').html('');
                    } else if (elem.closest('.form-group').closest('.form-group').find('small.text-danger')) {
                        elem.closest('.form-group').closest('.form-group').find('small.text-danger').html('');
                    }
                },
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    if (elem.attr('type') == 'checkbox') {
                        element = elem.closest('.form-group').find('.custom-checkbox:last');
                        error.insertAfter(element);
                    } else if (elem.attr('type') == 'radio') {
                        element = elem.closest('.form-group').find('.d-flex');
                        error.insertAfter(element);
                    } else if (elem.hasClass('select2-multiple')) {
                        element = elem.closest('.form-group').find('.select2-container--default');
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $('.next-btn').click(function () {
                if ($("form[name='updateBuysell']").valid()) {
                    $('.tab-pane.fade.show.active').removeClass('active show');
                    if ($(this).attr('id') == 'nextBtn1') {
                        $(".product-tab-btn").children(".nav-link").removeClass('active');
                        var sellProductcheck = $('#productSell').prop('checked');
                        var serviceProductcheck = $('#productService').prop('checked');
                        if (sellProductcheck) {
                            $(".product-tab-btn:first").next().children(".nav-link").addClass('active');
                            // $('.trade-info-tab').addClass('active show');
                            $('.payment-info-tab').addClass('active show');
                        } else {
                            $(".product-tab-btn:nth-child(2)").children(".nav-link").addClass('active');
                            $('.payment-info-tab').addClass('active show');
                        }
                    } else if ($(this).attr('id') == 'nextBtn2') {
                        $(".product-tab-btn").children(".nav-link").removeClass('active');
                        $(".product-tab-btn:nth-child(2)").children(".nav-link").addClass('active');
                        $('.payment-info-tab').addClass('active show');
                    }
                    $('html, body').animate({scrollTop: ($($("#page-content-wrapper")).offset().top - 50)}, 'slow');
                } else {
                    validator.focusInvalid();
                }
            });
            var options = {
                dataType: 'JSON',
                beforeSubmit: function (arr, $form) {
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-create-product').hide();
                    $('#alert-error-create-product').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;

                    if (response.feedback == "updated") {
                        $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                        // $('html, body').animate({scrollTop: 0}, 'slow');
                        // $("#alert-success-create-product").show().html("New product added successfully.");
                        $(window).off('beforeunload');

                        $("#loader").hide();
                        toastr.success("Buy sell updated successfully.");
                        window.location.href = response.url;
                    } else if (response.feedback == "validation_error") {
                        toastr.error("Please enter the required fields.");
                        $form.find('button[type=submit]').prop('disabled', false);
                        // $('html, body').animate({scrollTop:($('#'+Object.keys(response.errors)[0]).offset().top)}, 'slow');

                        $.each(response.errors, function (key, value) {
                            if (key == "keyword1" || key == "keyword2" || key == "keyword3") {
                                $('#keyword_error').html(value[0]);
                                $(":input[name=" + key + "]").addClass('is-invalid');
                            } else if (key == "width_from" || key == "width_to") {
                                $('#width_error').html(value[0]);
                                $(":input[name=" + key + "]").addClass('is-invalid');
                            } else if (key == "weight_from" || key == "weight_to") {
                                $('#weight_error').html(value[0]);
                                $(":input[name=" + key + "]").addClass('is-invalid');
                            } else {
                                $('#' + key + '_error').html(value[0]);
                                $(":input[name=" + key + "]").addClass('is-invalid');
                            }
                        });
                        $('.tab-pane').removeClass('active show');
                        $('#' + Object.keys(response.errors)[0] + '_error').closest('.tab-pane').addClass('active show');
                        $(".product-tab-btn").children(".nav-link").removeClass('active');
                        // console.log($('#' + Object.keys(response.errors)[0] + '_error').attr('class'));
                        var tbid = $('#' + Object.keys(response.errors)[0] + '_error').closest('.tab-pane').attr('id');
                        $('a[href="#' + tbid + '"]:first').addClass('active');
                    }
                },
                error: function (jqXHR, exception) {
                    $("#loader").hide();
                    $('button[type=submit]').prop('disabled', false);
                    $('#alert-success-create-product').hide();
                    $('#alert-error-create-product').hide();
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
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    // $('#alert-error-create-product').html(msg);
                    // $('#alert-error-create-product').show();
                    toastr.error(msg);
                },
            };
            $('#updateBuysell').ajaxForm(options);

            $('.edit-payment').click(function () {
                $('#companyTab1').hide();
                $('#companyTab2').show();
                $('#aboutLinks .nav-item:nth-child(1) .nav-link, #aboutLinks .nav-item:nth-child(2) .nav-link').removeClass('active');
                $('#aboutLinks .nav-item:nth-child(2) .nav-link').addClass('active');
                $('#myCompanyTab .tab-pane.fade:nth-child(1), #myCompanyTab .tab-pane.fade:nth-child(2)').removeClass('active show');
                $('#myCompanyTab .tab-pane.fade:nth-child(2)').addClass('active show');
            });

            $("#category").on("change", function () {
                // $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                var $this = $(this);
                $this.siblings(".loading-icon").removeClass("d-none");
                // $('#keyword1').val($('#category option:selected').attr('cat-val'));
                // $('#keyword1').valid();
                $.ajax({
                    url: '{{ route("get-subcategories") }}',
                    type: 'get',
                    datType: 'JSON',
                    data: {category: $(this).val(), category_type: 'sub'},
                    success: function (response, statusText, xhr, $form) {
                        response = $.parseJSON(response);
                        if (response.feedback == 'success') {
                            $('#sub_category').html(response.output);
                            $('#sub_sub_category')
                                .html('<option value="" selected disabled> ---- Select Sub-Sub-Category --- </option><option disabled class="text-danger">Please select sub-category first</option>');
                            $('#sub_category').find('option[value="' + $('#sub_category').attr('val') + '"]').prop('selected', 'true').trigger('change');
                        }
                        // $("#loader").hide();
                        $this.siblings(".loading-icon").addClass("d-none");
                    }
                });
            });
            $("#sub_category").on("change", function () {
                // $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                var $this = $(this);
                $this.siblings(".loading-icon").removeClass("d-none");
                // $('#keyword2').val($('#category option:selected').attr('cat-val'));
                // $('#keyword2').valid();
                $.ajax({
                    url: '{{ route("get-subcategories") }}',
                    type: 'get',
                    datType: 'JSON',
                    data: {sub_category: $(this).val(), category_type: 'subsub'},
                    success: function (response, statusText, xhr, $form) {
                        response = $.parseJSON(response);
                        if (response.feedback == 'success') {
                            $('#sub_sub_category').html(response.output);
                            $('#sub_sub_category').find('option[value="' + $('#sub_sub_category').attr('val') + '"]').prop('selected', 'true').trigger('change');
                        }
                        // $("#loader").hide();
                        $this.siblings(".loading-icon").addClass("d-none");
                    }
                });
            });

            $('#proPaid').on('click', function () {
                // alert($('#proPaid').val());
                if ($('#proPaid').prop("checked")) {
                    $('#paidField').removeClass('d-none');
                    $('#paidSample').prop('required', true);
                }

            });

            $('#proFree').on('click', function () {
                // alert($('#proPaid').val());
                if ($('#proFree').prop("checked")) {
                    $('#paidField').addClass('d-none');
                    $('#paidSample').prop('required', false);
                }
            });

            $('.weaving-checkbox .custom-control-input').on('click', function () {
                // console.log($('input[name=weaving]:checked').val());
                if ($('input[name=weaving]:checked').val() == 'Other') {
                    $('#addOtherWeaving').removeClass('d-none');
                    $('#add_weaving').prop('required', true);
                } else {
                    $('#addOtherWeaving').addClass('d-none');
                    $('#add_weaving').prop('required', false);
                }
            });

            $('.product-categories').find('option[value="' + $('.product-categories').attr('val') + '"]').prop('selected', 'true').trigger('change');

            setTimeout(function () {
                var initial_form_state = $('#myform').serialize();
                $('#updateBuysell').submit(function () {
                    initial_form_state = $('#updateBuysell').serialize();
                });
                $(window).bind('beforeunload', function (e) {
                    var form_state = $('#updateBuysell').serialize();
                    if (initial_form_state != form_state) {
                        return 'Are you sure you want to leave?';
                    }
                });
            }, 5000);

            $(document).on('change', '#bsheet16', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet16").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image16');
                    output.src = reader.result;
                };

                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet16').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet16')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet16').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet16_url').val(url);
                        var name = $('input[name="bsheet16_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image16').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image16').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image16').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }
                    });
                }

            });
            $(document).on('change', '#bsheet17', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet17").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image17');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet17').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet17')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet117').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet17_url').val(url);
                        var name = $('input[name="bsheet17_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image17').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image17').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image17').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#bsheet18', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet18").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image18');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet18').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet18')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet18').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet18_url').val(url);
                        var name = $('input[name="bsheet18_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image18').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image18').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image18').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#bsheet19', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet19").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image19');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet19').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet19')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet18').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet19_url').val(url);
                        var name = $('input[name="bsheet19_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image19').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image19').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image19').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#bsheet20', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet20").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image20');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet20').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet20')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet20').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet20_url').val(url);
                        var name = $('input[name="bsheet20_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image20').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image20').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image20').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#bsheet21', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet21").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image21');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet21').files[0]);


                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet21')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet21').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet21_url').val(url);
                        var name = $('input[name="bsheet21_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image21').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image21').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image21').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#bsheet22', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet22").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image22');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet22').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet22')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet22').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet22_url').val(url);
                        var name = $('input[name="bsheet22_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image22').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image22').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image22').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#bsheet23', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet23").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image23');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet23').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet23')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet23').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet23_url').val(url);
                        var name = $('input[name="bsheet23_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image23').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image23').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image23').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#bsheet24', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet24").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image24');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet24').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet24')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet24').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet24_url').val(url);
                        var name = $('input[name="bsheet24_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image24').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image24').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image24').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#bsheet25', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet25").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image25');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet25').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet25')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet25').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet25_url').val(url);
                        var name = $('input[name="bsheet25_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image25').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image25').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image25').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#bsheet26', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet26").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image26');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet26').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet26')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet26').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet26_url').val(url);
                        var name = $('input[name="bsheet26_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image26').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image26').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image26').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#bsheet27', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet27").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image27');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet27').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet27')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet27').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet27_url').val(url);
                        var name = $('input[name="bsheet27_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image27').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image27').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image27').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#bsheet28', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet28").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image28');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet28').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet28')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet28').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet28_url').val(url);
                        var name = $('input[name="bsheet28_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image28').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image28').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image28').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#bsheet29', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet29").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image29');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet29').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet29')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet29').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet29_url').val(url);
                        var name = $('input[name="bsheet29_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image29').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image29').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image29').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#bsheet30', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bsheet30").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image30');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('bsheet30').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bsheet30')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bsheet30').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bsheet30_url').val(url);
                        var name = $('input[name="bsheet30_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#buploaded_image30').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#buploaded_image30').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#buploaded_image30').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });

            $(document).on('change', '#bavatar1', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar1").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image1');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar1').files[0]);


                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar1')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar1_url').val(url);


                    });
                }

            });
            $(document).on('change', '#bavatar2', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar2").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image2');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar2').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar2')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar2').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar2_url').val(url);


                    });
                }

            });
            $(document).on('change', '#bavatar3', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar3").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image3');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar3').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar3')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar3').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar3_url').val(url);


                    });
                }
            });
            $(document).on('change', '#bavatar4', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar4").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image4');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar4').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar4')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar4').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar4_url').val(url);


                    });
                }
            });
            $(document).on('change', '#bavatar5', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar5").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image5');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar5').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar5')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar5').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar5_url').val(url);


                    });
                }

            });
            $(document).on('change', '#bavatar6', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar6").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image6');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar6').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar6')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar6').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar6_url').val(url);


                    });
                }

            });
            $(document).on('change', '#bavatar7', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar7").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image7');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar7').files[0]);


                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar7')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar7').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar7_url').val(url);


                    });
                }
            });
            $(document).on('change', '#bavatar8', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar8").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image8');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar8').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar8')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar8').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar8_url').val(url);


                    });
                }
            });
            $(document).on('change', '#bavatar9', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar9").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image9');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar9').files[0]);


                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar9')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar9').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar9_url').val(url);


                    });
                }

            });
            $(document).on('change', '#bavatar10', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar10").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image10');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar10').files[0]);


                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar10')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar10').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar10_url').val(url);


                    });
                }

            });
            $(document).on('change', '#bavatar11', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar11").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image11');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar11').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar11')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar11').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar11_url').val(url);

                    });
                }
            });
            $(document).on('change', '#bavatar12', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar12").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image12');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar12').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar12')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar12').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar12_url').val(url);


                    });
                }
            });
            $(document).on('change', '#bavatar13', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar13").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image13');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar13').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar13')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar13').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar13_url').val(url);


                    });
                }
            });
            $(document).on('change', '#bavatar14', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar14").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image14');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar14').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar14')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar14').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar14_url').val(url);


                    });
                }

            });
            $(document).on('change', '#bavatar15', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("bavatar15").files[0].name;
                var form_data = new FormData();
                var token = '{{csrf_token()}}';

                var MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                var fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE) {
                    alert("File must not exceed 10 MB!");
                    $this.val(null);
                    $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                    $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', 'unset');
                } else {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = $this.closest('.product-pic');
                        output.src = reader.result;
                    };
                }

                var ext = name.split('.').pop().toLowerCase();
                /*  if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'heic']) == -1) {
             alert("Invalid Image File");
         } */
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('buploaded_image15');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('bavatar15').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#bavatar15')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#bavatar15').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#bavatar15_url').val(url);


                    });
                }
            });
        });

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

        $('.include-in-gallery').click(function() {
            /*hidding expandable light gallery feature*/
            if($('.swal-overlay--show-modal').length!=1) {
                $('.swal-overlay').siblings('.lg-backdrop').css('visibility', 'visible');
                $('.swal-overlay').siblings('.lg-outer').css('visibility', 'visible');
                $('.swal-overlay').siblings('.lg-outer').find('.lg-image').css({'transform': 'scale3d(1, 1, 1)','visibility': 'visible'});
            }
            /*hidding expandable light gallery feature*/
        });

        $(document).delegate('.specs', 'click', function (e) {
            /*hidding expandable light gallery feature*/
            if($('.swal-overlay--show-modal').length!=1) {
                $('.swal-overlay').siblings('.lg-backdrop').css('visibility', 'hidden');
                $('.swal-overlay').siblings('.lg-outer').css('visibility', 'hidden');
                $('.swal-overlay').siblings('.lg-outer').find('.lg-image').css({'transform': 'scale3d(0, 0, 0)','visibility': 'visible'});
            }
            /*hidding expandable light gallery feature*/

            var trashIcon = $(this);

            var img_id = $(this).attr("img_id");
            img_id = $(this).siblings('input').val();
            swal({
                title: "Are you sure?",
// text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#ajax-preloader").show();
                        $.post("{{ route('remove-buysell-image') }}", {
                            _token: '{{ csrf_token() }}',
                            img_id: img_id,
                            json: 'yes'
                        }, function (data) {
// document.getElementById("wait").style.display = "none";
                            $("#ajax-preloader").hide();
                            response = $.parseJSON(data);
                            if (response.feedback == 'encrypt_issue') {
                                toastr.error(response.msg, 'Error');
                                $('#alert-error').html(response.msg)
                                $('#alert-error').show().fadeOut(2500);
                            } else if (response.feedback == 'true') {
// toastr.success(response.msg, 'Success');
                                $('#alert-success').html(response.msg)
                                $('#alert-success').show().fadeOut(2500);
                                $(trashIcon).closest('li').remove();
                            } else {
// toastr.error('Something went Wrong', 'Error');
                                $('#alert-error').html(response.msg)
                                $('#alert-error').show().fadeOut(2500);
                            }
                        });
                    }
                });

        });
        $(document).delegate('.cross-sheet', 'click', function (e) {
            /*hidding expandable light gallery feature*/
            if($('.swal-overlay--show-modal').length!=1) {
                $('.swal-overlay').siblings('.lg-backdrop').css('visibility', 'hidden');
                $('.swal-overlay').siblings('.lg-outer').css('visibility', 'hidden');
                $('.swal-overlay').siblings('.lg-outer').find('.lg-image').css({'transform': 'scale3d(0, 0, 0)','visibility': 'visible'});
            }
            /*hidding expandable light gallery feature*/

            var trashIcon = $(this);

            var sheet_id = $(this).attr("sheet_id");
            sheet_id = $(this).siblings('input').val();
            swal({
                title: "Are you sure?",
// text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#ajax-preloader").show();
                        $.post("{{ route('remove-buysell-sheet') }}", {
                            _token: '{{ csrf_token() }}',
                            sheet_id: sheet_id,
                            json: 'yes'
                        }, function (data) {
// document.getElementById("wait").style.display = "none";
                            $("#ajax-preloader").hide();
                            response = $.parseJSON(data);
                            if (response.feedback == 'encrypt_issue') {
                                toastr.error(response.msg, 'Error');
                                $('#alert-error').html('response.msg')
                                $('#alert-error').show().fadeOut(2500);
                            } else if (response.feedback == 'true') {
// toastr.success(response.msg, 'Success');
                                $('#alert-success').html(response.msg)
                                $('#alert-success').show().fadeOut(2500);
                                $(trashIcon).closest('li').remove();
                            } else {
// toastr.error('Something went Wrong', 'Error');
                                $('#alert-error').html('Something went Wrong')
                                $('#alert-error').show().fadeOut(2500);
                            }
                        });
                    }
                });
        });
    </script>
@endpush
