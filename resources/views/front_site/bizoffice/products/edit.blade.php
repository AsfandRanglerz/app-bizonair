@extends('front_site.master_layout')

@section('content')
    <style>
        @media (min-width: 992px) {
            .product-img-sheet .col-md-2 {
                -ms-flex: 0 0 20%;
                flex: 0 0 20%;
                max-width: 20%;
            }
        }
    </style>
    <body>
    <main id="maincontent" class="page-main">
        <div class="d-flex edit-company-profile" id="dashboardWrapper">
            <!-- Sidebar -->

        <!-- Sidebar -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper" >

                <div class="mx-2 my-2">
                    <div id="companyTab1">
                        <div class="tab-content" id="myCompanyTab">
                            <div class="px-0 py-1 tab-pane fade show active" id="tabProfile" role="tabpanel"
                                 aria-labelledby="linkProfile">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="edit-about-us-section">
                                            <h6 class="heading">
                                                @if(in_array("Buy", explode(",", $product->product_service_types)) || in_array("Sell", explode(",", $product->product_service_types)))
                                                    Product Info
                                                @else
                                                    Service Info
                                                @endif
                                                <span
                                                    class="fa fa-edit edit-btn about-edit-btn"></span></h6>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Lead Type</span>
                                                </div>
                                                @if($product->product_service_types == 'Service')
                                                    <div class="col-sm-6 col-6">
                                                        <span>Service Provider</span>
                                                    </div>
                                                @else
                                                    <div class="col-sm-6 col-6">
                                                        <span>{{ $product->product_service_types }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Main Category</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $product->category->name }}</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Sub-Category</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $product->subcategory->name }}</span>
                                                </div>
                                            </div>
                                            @if($product->add_sub_sub_category!=null)
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Product Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        {{--                                                <span>{{ ($product->childsubcategory_id == 'Others') ? $product->childsubcategory_id : $product->childsubcategory->name }}</span> --}}
                                                        <span>{{ $product->add_sub_sub_category }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                @if(in_array("Buy", explode(",", $product->product_service_types)) || in_array("Sell", explode(",", $product->product_service_types)))
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Product Type</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                            @if (strpos($product->childsubcategory->name, 'Other'))
                                                                <span>{{ substr($product->childsubcategory->name,6) }}</span>
                                                            @else
                                                                <span>{{ $product->childsubcategory->name }}</span>
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
                                                    <span>{{ $product->reference_no }}</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Subject</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $product->subject }}</span>
                                                </div>
                                            </div>
                                            @if($product->product_service_types == "Sell" || $product->product_service_types == "Buy")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Product Name</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <span>{{ $product->product_service_name }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($product->product_service_types == "Service")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Product & Service Name</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <span>{{ $product->product_service_name }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Keyword For Search</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if(strlen($product->keywords)>3)
                                                            {{ $product->keywords }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            @if(!in_array("Service", explode(",", $product->product_service_types)))
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Product Availability</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <span>
                                                        @if($product->product_availability!=null)
                                                                {{ $product->product_availability }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                @if(in_array("Buy", explode(",", $product->product_service_types)))
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Preferred Manufacturer Name</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <span>
                                                        @if($product->product_manufacturer!=null)
                                                                {{ $product->product_manufacturer->manufacturer_name }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                @else
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Manufacturer Name</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                        <span>
                                                        @if($product->product_manufacturer!=null)
                                                                {{ $product->product_manufacturer->manufacturer_name }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Product Origin</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <span>
                                                        @if($product->origin!=null)
                                                                {{ $product->origin }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($product->details!=null)
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Additional Info</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->details!=null)
                                                           {!! $product->details  !!}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="my-2 col-sm-12 col-12">
                                        <div class="product-img-spec-container mb-1">
                                            <h6 class="my-2 px-2 heading pro-img-heading">Product Images</h6>
                                            <div class="product-images-gallery">
                                                <ul class="row mx-0 mb-2 product-gallery edit-comp-prof-imgs">
                                                    @foreach(ProductHelper::getImages($product->id) as $image)
                                                        <li class="position-relative d-inline-block my-1">
                                                            <input type="hidden" name='img_id' value="{{encrypt($image->id)}}">
                                                            <span class="position-absolute border-0 specification-bin specs fa fa-trash" img_id="{{$image->id}}" aria-hidden="true" style="z-index: 1;right: -8px"></span>
                                                            <div class=" include-in-gallery"
                                                                 data-src="{$image->image}}"
                                                                 data-pinterest-text="Pin it"
                                                                 data-tweet-text="share on twitter ">
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
                                            <h6 class="my-2 px-2 heading pro-spec-heading">Product Specifications</h6>
                                            <div class="product-images-gallery">
                                                <ul class="row mx-0 mb-2 product-gallery edit-comp-prof-imgs">
                                                    @foreach(ProductHelper::getSheets($product->id) as $file)
                                                        <?php $pathinfo = pathinfo($file->sheet);
                                                        $supported_ext = array('docx', 'xlsx', 'pdf');
                                                        $src_file_name = $file->sheet;
                                                        $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                                        @if($ext=="docx")
                                                            <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center"
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
                                                            <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center"
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
                                                            <li class="px-1 my-1 col-lg-2 col-md-3 col-6 d-flex justify-content-center align-items-center"
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
                                                                <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$file->id}}" aria-hidden="true" style="z-index: 1;right: -8px"></span>

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
                                @if($product->variation != null)
                                    <div class="edit-company-section">
                                        <h6 class="heading">Additional Product Info<span
                                                class="fa fa-edit edit-btn com-edit-btn"></span></h6>
                                        @if($product->variation == "Machinery & Parts")
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Product Type</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->machinery_product_info->product_type!=null)
                                                            {{ $product->machinery_product_info->product_type }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Condition</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->machinery_product_info->machinery_condition!=null)
                                                        {{ $product->machinery_product_info->machinery_condition }}
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
                                                @if($product->machinery_product_info->after_sales_service!=null)
                                                        {{ $product->machinery_product_info->after_sales_service }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            @if($product->machinery_product_info->after_sales_service=="Yes")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Type of Service</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->machinery_product_info->service_type!=null)
                                                            {{ $product->machinery_product_info->service_type }}
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
                                                @if($product->machinery_product_info->warranty!=null)
                                                        {{ $product->machinery_product_info->warranty }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            @if($product->machinery_product_info->warranty=="Yes")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Warranty Period</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->machinery_product_info->warranty_period!=null)
                                                            {{ $product->machinery_product_info->warranty_period }}
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
                                                @if($product->machinery_product_info->certification!=null)
                                                        {{ $product->machinery_product_info->certification }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            @if($product->machinery_product_info->certification=="Yes")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Certification Details</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->machinery_product_info->certification_details!=null)
                                                            {{ $product->machinery_product_info->certification_details }}
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
                                                @if($product->machinery_product_info->additional_trade_notes!=null)
                                                        {{ $product->machinery_product_info->additional_trade_notes }}
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
                                                @if($product->machinery_product_info->product_related_certifications!=null)
                                                        {{ $product->machinery_product_info->product_related_certifications }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                        @elseif($product->variation == "PPE & Institutional")
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Material Type</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->institutional_product_info->material!=null)
                                                        {{ $product->institutional_product_info->material }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Composition/Construction</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->institutional_product_info->composition!=null)
                                                        {{ $product->institutional_product_info->composition }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Size/Age Group</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->institutional_product_info->size_age!=null)
                                                        {{ $product->institutional_product_info->size_age }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Color</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->institutional_product_info->color!=null)
                                                        {{ $product->institutional_product_info->color }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Gender</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->institutional_product_info->gender!=null)
                                                        {{ $product->institutional_product_info->gender }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Thickness/GSM/Width</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->institutional_product_info->thickness!=null)
                                                        {{ $product->institutional_product_info->thickness }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Brand</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->institutional_product_info->brand!=null)
                                                        {{ $product->institutional_product_info->brand }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Design/Style </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->institutional_product_info->design!=null)
                                                        {{ $product->institutional_product_info->design }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Season </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->institutional_product_info->season!=null)
                                                        {{ $product->institutional_product_info->season }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">End Use/Application</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->institutional_product_info->end_use!=null)
                                                        {{ $product->institutional_product_info->end_use }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                        @elseif($product->variation == "Garments & Accessories")
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Material Type</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->garments_product_info->material!=null)
                                                        {{ $product->garments_product_info->material }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Composition/Construction</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->garments_product_info->composition!=null)
                                                        {{ $product->garments_product_info->composition }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Size/Age Group</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->garments_product_info->size_age!=null)
                                                        {{ $product->garments_product_info->size_age }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Color</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->garments_product_info->color!=null)
                                                        {{ $product->garments_product_info->color }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Gender</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->garments_product_info->gender!=null)
                                                        {{ $product->garments_product_info->gender }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Thickness/GSM/Width</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->garments_product_info->thickness!=null)
                                                        {{ $product->garments_product_info->thickness }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Brand</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->garments_product_info->brand!=null)
                                                        {{ $product->garments_product_info->brand }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Design/Style </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->garments_product_info->design!=null)
                                                        {{ $product->garments_product_info->design }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Season </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->garments_product_info->season!=null)
                                                        {{ $product->garments_product_info->season }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">End Use/Application</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->garments_product_info->end_use!=null)
                                                        {{ $product->garments_product_info->end_use }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                        @elseif($product->variation == "Knitted Fabric" || $product->variation == "Woven Fabric" || $product->variation == "Nonwoven Fabric" )

                                            @if($product->fabric_product_info->fabric_types =="Other")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Fabric Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->fabric_product_info->other_fabric_type!=null)
                                                            {{ $product->fabric_product_info->other_fabric_type }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Fabric Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->fabric_product_info->fabric_types!=null)
                                                        {{ $product->fabric_product_info->fabric_types }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($product->fabric_product_info->knitting_type !=null)
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Knitting Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                        @if($product->fabric_product_info->knitting_type =="Other")
                                                            {{ $product->fabric_product_info->other_knitting_type }}
                                                        @else
                                                            {{ $product->fabric_product_info->knitting_type }}
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($product->fabric_product_info->weave_types !=null)
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Weave Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                        @if($product->fabric_product_info->weave_types =="Other")
                                                            {{ $product->fabric_product_info->other_weave_type }}
                                                        @else
                                                            {{ $product->fabric_product_info->weave_types }}
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($product->fabric_product_info->non_woven_types !=null)
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Non Woven Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                          @if($product->fabric_product_info->non_woven_types =="Other")
                                                            {{ $product->fabric_product_info->other_non_woven_type }}
                                                        @else
                                                            {{ $product->fabric_product_info->non_woven_types }}
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Fabric Construction</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->fabric_product_info->fabric_construction!=null)
                                                        {{ $product->fabric_product_info->fabric_construction }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">GSM/Thickness</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->fabric_product_info->gsm_thickness!=null)
                                                        {{ $product->fabric_product_info->gsm_thickness }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                                @if($product->fabric_product_info->fabric_composition!=null)
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Fabric Composition</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->fabric_product_info->fabric_composition!=null)
                                                        {{ $product->fabric_product_info->fabric_composition }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                                @endif
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Width</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->fabric_product_info->width_from!=null)
                                                        {{ $product->fabric_product_info->width_from }}
                                                    @else
                                                        -
                                                    @endif
                                                to
                                                @if($product->fabric_product_info->width_to!=null)
                                                        {{ $product->fabric_product_info->width_to }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>

                                            @if($product->fabric_product_info->manufacturing_technique =="Other")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Manufacturing Technique</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->fabric_product_info->other_manufacturing_technique!=null)
                                                            {{ $product->fabric_product_info->other_manufacturing_technique }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Manufacturing Technique</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                        <span>
                                                        @if($product->fabric_product_info->manufacturing_technique!=null)
                                                            {{ $product->fabric_product_info->manufacturing_technique }}
                                                        @else
                                                            -
                                                        @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                            @endif

                                            @if($product->fabric_product_info->yarn_type =="Other")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Yarn type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->fabric_product_info->other_yarn_type!=null)
                                                            {{ $product->fabric_product_info->other_yarn_type }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Yarn Type</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                        <span>
                                                        @if($product->fabric_product_info->yarn_type!=null)
                                                                {{ $product->fabric_product_info->yarn_type }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                            @endif

                                            @if(in_array("Other", explode(",", $product->fabric_product_info->features)))
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Feature</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->fabric_product_info->other_feature!=null)
                                                            {{ $product->fabric_product_info->other_feature }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">Features</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                        <span>
                                                        @if($product->fabric_product_info->features!=null)
                                                                {{ str_replace(",", ", ", $product->fabric_product_info->features) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                            @endif

                                            @if(in_array("Other", explode(",", $product->fabric_product_info->uses)))
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">End Use/Application</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->fabric_product_info->other_use!=null)
                                                            {{ $product->fabric_product_info->other_use }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                    <div class="row text">
                                                        <div class="col-sm-6 col-6">
                                                            <span class="font-500">End Use/Application</span>
                                                        </div>
                                                        <div class="col-sm-6 col-6">
                                                        <span>
                                                        @if($product->fabric_product_info->uses!=null)
                                                                {{ str_replace(",", ", ", $product->fabric_product_info->uses) }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                            @endif
                                        @elseif($product->variation == "Natural Yarn" || $product->variation == "Synthetic Yarn" || $product->variation == "Blended Yarn" || $product->variation == "Speciality Yarn")
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Count</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->yarn_product_info->count!=null)
                                                        {{ $product->yarn_product_info->count }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Count Unit</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->yarn_product_info->count_unit!=null)
                                                        {{ $product->yarn_product_info->count_unit }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            @if($product->yarn_product_info->count_unit =="Other")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Count Unit</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->yarn_product_info->other_count_unit!=null)
                                                            {{ $product->yarn_product_info->other_count_unit }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Count Unit</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->yarn_product_info->count_unit!=null)
                                                        {{ $product->yarn_product_info->count_unit }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($product->yarn_product_info->attribute =="Other")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Yarn Attribute</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->yarn_product_info->other_attribute!=null)
                                                            {{ $product->yarn_product_info->other_attribute }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Yarn Attribute</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->yarn_product_info->attribute!=null)
                                                        {{ $product->yarn_product_info->attribute }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($product->yarn_product_info->technology =="Other")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Technology</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->yarn_product_info->other_technology!=null)
                                                            {{ $product->yarn_product_info->other_technology }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Technology</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->yarn_product_info->technology!=null)
                                                            {{ $product->yarn_product_info->technology }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Yarn Grade</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->yarn_product_info->grade!=null)
                                                        {{ $product->yarn_product_info->grade }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">TPI </span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->yarn_product_info->tpi!=null)
                                                        {{ $product->yarn_product_info->tpi }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Tenacity</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->yarn_product_info->tenacity!=null)
                                                        {{ $product->yarn_product_info->tenacity }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>

                                            @if($product->yarn_product_info->count_type =="Other")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Count type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->yarn_product_info->other_count_type!=null)
                                                            {{ $product->yarn_product_info->other_count_type }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Count Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->yarn_product_info->count_type!=null)
                                                            {{ $product->yarn_product_info->count_type }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($product->yarn_product_info->yarn_specialty =="Other")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Yarn Speciality</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->yarn_product_info->other_speciality!=null)
                                                            {{ $product->yarn_product_info->other_speciality }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Yarn Speciality</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->yarn_product_info->yarn_specialty!=null)
                                                            {{ $product->yarn_product_info->yarn_specialty }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($product->yarn_product_info->end_use =="Other")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">End Use/Application</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->yarn_product_info->other_end_use!=null)
                                                            {{ $product->yarn_product_info->other_end_use }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">End Use/Application</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->yarn_product_info->end_use!=null)
                                                            {{ $product->yarn_product_info->end_use }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @endif
                                        @elseif($product->variation == "Natural Fibre" || $product->variation == "Manmade Fibre")

                                            @if($product->fiber_product_info->fiber_type =="Other")
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Fibre Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->fiber_product_info->other_fiber_type!=null)
                                                            {{ $product->fiber_product_info->other_fiber_type }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Fibre Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->fiber_product_info->fiber_type!=null)
                                                            {{ $product->fiber_product_info->fiber_type }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Fibre Size/Length</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->fiber_product_info->size!=null)
                                                        {{ $product->fiber_product_info->size }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Tensile Strength</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->fiber_product_info->strength!=null)
                                                        {{ $product->fiber_product_info->strength }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">End Use Application</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->fiber_product_info->end_use!=null)
                                                        {{ $product->fiber_product_info->end_use }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>

                                        @else
                                            @foreach($product->chemicals_product_infos as $key => $chemical)
                                                <h6 class="heading mt-1">Product Info {{ $key + 1 }}</h6>
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Manufacturer Company Name</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($chemical->manufacturer_company_name!=null)
                                                            {{ $chemical->manufacturer_company_name }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Product Origin</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($chemical->origin!=null)
                                                            {{ $chemical->origin }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Chemicals Listed</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($chemical->chemicals_listed!=null)
                                                            {{ $chemical->chemicals_listed }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Supply Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($chemical->supply_type!=null)
                                                            {{ $chemical->supply_type }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                                @if($chemical->company_additional_info!=null)
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Additional Information</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($chemical->company_additional_info!=null)
                                                            {{ $chemical->company_additional_info }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="my-2">
                                        <hr class="horizontal-line">
                                    </div>
                                @endif
                                @if(in_array("Sell", explode(",", $product->product_service_types)))
                                    <div class="edit-company-section">
                                        <h6 class="heading">Trade Info<span
                                                class="fa fa-edit edit-btn extra-edit-btn"></span></h6>
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Dealing Product As</span>
                                            </div>
                                            @if(!empty($product->other_dealing_as))
                                            <div class="col-sm-6 col-6">
                                                <span>{{ $product->other_dealing_as }}</span>
                                            </div>
                                            @else
                                            <div class="col-sm-6 col-6">
                                                <span>{{ str_replace(',', ', ', $product->dealing_as) }}</span>
                                            </div>
                                            @endif
                                        </div>
                                        {{--                                        <div class="row text">--}}
                                        {{--                                            <div class="col-sm-6 col-6">--}}
                                        {{--                                                <span>Also dealing product as</span>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="col-sm-6 col-6">--}}
                                        {{--                                                <span>{{ $product->other_dealing_as }}</span>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        @if($product->focused_selling_region !=null)
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Target Selling Region</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->focused_selling_region)
                                                        {{ $product->focused_selling_region }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if(in_array("Sell", explode(",", $product->product_service_types)))
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Target Selling Country</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ str_replace(',', ', ', $product->focused_selling_countries) }}</span>
                                                </div>
                                            </div>
                                            @if($product->production_capacity !=null)
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Production Capacity</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->production_capacity)
                                                        {{ $product->production_capacity }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            @endif
                                            @if($product->min_order_quantity!=null)
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Min Order Quantity</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->min_order_quantity)
                                                        {{ $product->min_order_quantity }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Sampling</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->is_sampling)
                                                        Yes
                                                    @elseif(!$product->is_sampling)
                                                        No
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                                </div>
                                            </div>
                                            @if($product->is_sampling)
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Sampling Cost</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->sampling_type)
                                                            {{ $product->sampling_type }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($product->sampling_type == 'Paid')
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Sampling Price</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                    <span>
                                                    @if($product->paid_sampling_price)
                                                            {{ $product->paid_sampling_price }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="my-2">
                                        <hr class="horizontal-line">
                                    </div>
                                @endif
                                <div class="edit-company-section">
                                    <h6 class="heading">Payment & Delivery<span
                                            class="fa fa-edit edit-btn edit-payment"></span></h6>
                                    @if($product->product_service_types == "Buy")
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Target Price Range</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->target_price_from!=null)
                                                        @if(in_array("Other", explode(",", $product->suitable_currencies))) {{ $product->other_suitable_currency }}
                                                        @else {{$product->suitable_currencies }} @endif

                                                        {{ $product->target_price_from }} - {{ $product->target_price_to }} Per {{ ($product->target_price_unit != 'Other') ? $product->target_price_unit : $product->other_target_price_unit }}
                                                    @else
                                                        -
                                                    @endif
                                                    {{--													to--}}
                                                    {{--													@if($product->target_price_to!=null)--}}
                                                    {{--                                                            {{ $product->target_price_to }} {{ ($product->target_price_unit != 'Other') ? $product->target_price_unit : $product->other_target_price_unit }}--}}
                                                    {{--                                                        @else--}}
                                                    {{--                                                            ---}}
                                                    {{--                                                        @endif--}}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    @if($product->product_service_types == "Sell")
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Unit Price Range</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->unit_price_from!=null)
                                                        @if(in_array("Other", explode(",", $product->suitable_currencies))) {{ $product->other_suitable_currency }}
                                                        @else {{$product->suitable_currencies }} @endif
                                                            {{ $product->unit_price_from }} - {{ $product->unit_price_to }} Per {{ ($product->unit_price_unit != 'Other') ? $product->unit_price_unit : $product->other_unit_price_unit }}
                                                    @else
                                                        -
                                                    @endif

                                                    {{--													@if($product->unit_price_to!=null)--}}
                                                    {{--                                                            {{ $product->unit_price_to }} {{ ($product->unit_price_unit != 'Other') ? $product->unit_price_unit : $product->other_unit_price_unit }}--}}
                                                    {{--                                                        @else--}}
                                                    {{--                                                            ---}}
                                                    {{--                                                        @endif--}}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                    @if($product->product_service_types == "Service")
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500"> Service Charges Range</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->unit_price_from!=null)
                                                        @if(in_array("Other", explode(",", $product->suitable_currencies))) {{ $product->other_suitable_currency }}
                                                        @else {{$product->suitable_currencies }} @endif
                                                            {{ $product->unit_price_from }} - {{ $product->unit_price_to }} Per {{ ($product->unit_price_unit != 'Other') ? $product->unit_price_unit : $product->other_unit_price_unit }}
                                                    @else
                                                        -
                                                    @endif
                                                    {{--													to--}}
                                                    {{--													@if($product->unit_price_to!=null)--}}
                                                    {{--                                                            {{ $product->unit_price_to }} {{ ($product->unit_price_unit != 'Other') ? $product->unit_price_unit : $product->other_unit_price_unit }}--}}
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
                                                {{ str_replace(',', ', ', $product->service_durations) }}
                                                </span>
                                            </div>
                                        </div>
                                        @if(in_array("Other", explode(",", $product->service_durations)))
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Other Service Duration</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                <span>
                                                {{ $product->other_service_duration }}
                                                </span>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Delivery (Optional)</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->delivery)
                                                        {{ $product->delivery }}
                                                    @else
                                                        Not Included
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        @if($product->delivery_time!=null)
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Lead Time</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                            <span>
                                            @if($product->delivery_time)
                                                    {{ $product->delivery_time }}
                                                @else
                                                    -
                                                @endif
                                            </span>
                                            </div>
                                        </div>
                                            @endif
                                    @endif
                                    @if(in_array("Other", explode(",", $product->suitable_currencies)))
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Suitable Currency</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>
                                                @if($product->other_suitable_currency)
                                                        {{ $product->other_suitable_currency }}
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
                                            @if($product->suitable_currencies)
                                                    {{$product->suitable_currencies }}
                                                @else
                                                    -
                                                @endif
                                            </span>
                                            </div>
                                        </div>
                                    @endif

                                    @if(in_array("Other", explode(",", $product->payment_terms)))
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Payment Term</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                            <span>
                                            @if($product->other_payment_term)
                                                    {{ $product->other_payment_term }}
                                                @else
                                                    -
                                                @endif
                                            </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Payment Terms</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                        <span>
                                        @if($product->payment_terms)
                                                {{ str_replace(',', ', ', $product->payment_terms) }}
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
                            </div>
                        </div>
                    </div>
                    <div id="companyTab2" style="display: none">
                        <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                             role="alert"></div>
                        <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                             role="alert"></div>
                        <ul class="nav nav-tabs" id="aboutLinks" role="tablist">
                            <li class="product-tab-btn nav-item">
                                <a class="nav-link active product-service-info" id="linkReg" data-toggle="tab"
                                   href="#tabReg" role="tab"
                                   aria-controls="tabReg" aria-selected="true">
                                    @if(in_array("Buy", explode(",", $product->product_service_types)) || in_array("Sell", explode(",", $product->product_service_types)))
                                        Product Info
                                    @else
                                        Service Info
                                    @endif
                                </a>
                            </li>
                            <li class="product-tab-btn nav-item trade-info"
                                @if(!in_array("Sell", explode(",", $product->product_service_types))) style="display: none;" @endif>
                                <a class="nav-link" id="linkCom" data-toggle="tab" href="#tabCom" role="tab"
                                   aria-controls="tabCom" aria-selected="false">Trade Info</a>
                            </li>
                            <li class="product-tab-btn nav-item">
                                <a class="nav-link payment-delivery-info" id="linkInfo" data-toggle="tab"
                                   href="#tabInfo" role="tab"
                                   aria-controls="tabInfo"
                                   aria-selected="false">@if(in_array("Buy", explode(",", $product->product_service_types)) || in_array("Sell", explode(",", $product->product_service_types)))
                                        Payment Info
                                    @else
                                        Payment Info
                                    @endif</a>
                            </li>
                            <li class="w-unset d-sm-flex d-inline-block justify-content-end ml-auto nav-item">
                                <button type="submit" class="red-btn updt-btn">UPDATE</button>
                            </li>
                            <li class="w-unset ml-2 d-sm-flex d-inline-block justify-content-end nav-item">
                                <button class="red-btn close-form" href="#add-cancil" data-toggle="modal">CLOSE</button>
                            </li>
                            <div id="add-cancil" class="change-password-modal modal fade">
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
                        <form id="updateProduct" name="updateProduct" method="post" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('put')
                            <div class="tab-content" id="myCompanyTab">
                                <div class="py-2 tab-pane fade show active" id="tabReg" role="tabpanel"
                                     aria-labelledby="tabReg">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="font-500">Post Your Lead As
                                                <span class="required"> (Mandatory)</span>
                                            </label>
                                            <div class="d-flex flex-row">
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
                                                           @if(in_array("Buy", explode(",", $product->product_service_types))) checked="true"
                                                           @endif
                                                           class="custom-control-input product-buy-sell"
                                                           value="Buy" id="productBuy"
                                                           name="product_service_types[]">
                                                    <label class="custom-control-label" for="productBuy">Buyer</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
                                                           @if(in_array("Sell", explode(",", $product->product_service_types))) checked="true"
                                                           @endif
                                                           class="custom-control-input product-buy-sell"
                                                           value="Sell" id="productSell"
                                                           name="product_service_types[]">
                                                    <label class="custom-control-label" for="productSell">Seller</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
                                                           @if(in_array("Service", explode(",", $product->product_service_types))) checked="true"
                                                           @endif
                                                           class="custom-control-input product-buy-sell"
                                                           value="Service" id="productService"
                                                           name="product_service_types[]">
                                                    <label class="custom-control-label"
                                                           for="productService">Service Provider</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label for="category" class="d-none font-500">Main Category
                                                <span class="required"> (Mandatory)</span>
                                            </label>
                                            <div class="position-relative">
                                                <select class="form-control product-categories" id="category"
                                                        name="category" required val="{{ $product->category_id }}">
                                                    <option disabled selected>Please select category (Mandatory)</option>
                                                    @foreach(\App\Category::all() as $category)
                                                        <option value="{{ $category->id }}" cat-val="{{ $category->name }}"
                                                                @if(in_array("Service", explode(",", $product->product_service_types)) && $category->type == 'Business') class="d-none"
                                                                @endif
                                                                @if(!in_array("Service", explode(",", $product->product_service_types)) && $category->type == 'Services') class="d-none"
                                                                @endif
                                                                @if($product->category_id == $category->id) selected @endif
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
                                                <span class="required"> (Mandatory)</span>
                                            </label>
                                            <div class="position-relative">
                                                <select class="form-control product-subcategories" id="sub_category"
                                                        name="sub_category" required val="{{ $product->subcategory_id }}">
                                                    @foreach(\App\Subcategory::where('category_id', \App\Category::where('id', $product->category_id)->first()->id)->get() as $sub_category)
                                                        <option value="{{ $sub_category->id }}"
                                                                cat-val="{{ $sub_category->name }}"
                                                                @if($product->subcategory_id == $sub_category->id) selected @endif >{{ $sub_category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="d-none position-absolute spinner-border text-danger loading-icon">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="sub_category_error"></small>
                                        </div>
                                    </div>
                                    @if(!in_array("Service", explode(",", $product->product_service_types)))
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 d-flex flex-column subCat-Sec">
                                                <label for="sub_sub_category" class="d-none font-500">Product Type<span
                                                        class="required"> (Mandatory)</span></label>
                                                <select class="form-control single-select-dropdown"
                                                        id="sub_sub_category"
                                                        name="sub_sub_category"
                                                        required val="{{ $product->childsubcategory_id }}">
                                                    @foreach (\App\Childsubcategory::where('subcategory_id', \App\Subcategory::where('id', $product->subcategory_id)->first()->id)->get() as $sub_sub_category)
                                                        <option value="{{ $sub_sub_category->id }}"
                                                                cat-val="{{ $sub_sub_category->name }}"
                                                                @if($product->childsubcategory_id == $sub_sub_category->id) selected @endif >{{ $sub_sub_category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-danger" id="sub_sub_category_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 add-sub-sub-cat">
                                                <label class="font-500">Add Sub-Sub-Category <span
                                                        class="required">*</span></label>
                                                <input type="text" name="add_sub_sub_category"
                                                       value="{{ $product->add_sub_sub_category }}" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 clearfix">
                                            <label for="subject" class="d-none font-500">Subject
                                                <span class="required"> (Mandatory)</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" id="subject" class="form-control" name="subject"
                                                       placeholder="It will appear as title" maxlength = "80"value="{{ $product->subject }}"
                                                       required>
                                                <div class="input-group-append counter-span">
                                                    <span class="text-danger font-500"><span class="counter-total-digits">0</span>/80</span>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="subject_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 clearfix product-name">
                                            <label for="product_service_name" class="d-none font-500">Product Name
                                                <span class="required"> (Mandatory)</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" id="product_service_name"
                                                       value="{{ $product->product_service_name }}" maxlength = "50" class="form-control"
                                                       name="product_service_name" placeholder="Product Name" required>
                                                <div class="input-group-append counter-span">
                                                    <span class="text-danger font-500"><span class="counter-total-digits">0</span>/50</span>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="product_service_name_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        @if(!in_array("Service", explode(",", $product->product_service_types)))
                                            <div class="form-group col-lg-6 product-availability">
                                                <label class="font-500">Product Availability <small class="font-500">
                                                        (Optional)</small></label>
                                                <div class="d-flex">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio"
                                                               class="custom-control-input product-availability"
                                                               value="Made to order" id="proImport"
                                                               name="product_availability"
                                                               @if($product->product_availability == "Made to order") checked="true" @endif>
                                                        <label class="custom-control-label" for="proImport">Made to
                                                            Order</label>
                                                    </div>
                                                    <div class="custom-control custom-radio ml-3">
                                                        <input type="radio"
                                                               @if($product->product_availability == "In-Stock") checked="true"
                                                               @endif
                                                               class="custom-control-input product-availability"
                                                               value="In-Stock" name="product_availability"
                                                               id="proInStock">
                                                        <label class="custom-control-label"
                                                               for="proInStock">In-Stock</label>
                                                    </div>
                                                    <div class="custom-control custom-radio ml-3">
                                                        <input type="radio"
                                                               @if($product->product_availability == "Both") checked="true"
                                                               @endif
                                                               class="custom-control-input product-availability"
                                                               value="Both" name="product_availability" id="proBoth"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="proBoth">Both</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
                                                           value="{{ $product->keyword1 }}"
                                                           class="form-control" placeholder="Additional Keyword For Search (Optional) - Keyword 1">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" id="keyword2" name="keyword2"
                                                           value="{{ $product->keyword2 }}"
                                                           class="form-control" placeholder="Additional Keyword For Search (Optional) - Keyword 2">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" id="keyword3" name="keyword3"
                                                           value="{{ $product->keyword3 }}"
                                                           class="form-control" placeholder="Additional Keyword For Search (Optional) - Keyword 3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label class="font-500">Specification Sheets<br><small class="font-500">(Optional | JPG, PNG, Word, Excel & PDF files only | Upto 10MB)</small></label>
                                            <div class="dropzone dz-clickable">
                                                <div class="my-0 dz-default dz-message" data-dz-message="">
                                                    <div class="mx-0 row product-img-sheet">
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image16"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet16"
                                                                       id="sheet16" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet16_url" type="hidden" value=""
                                                                       id="sheet16_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image17"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet17"
                                                                       id="sheet17" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet17_url" type="hidden" value=""
                                                                       id="sheet17_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image18"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet18"
                                                                       id="sheet18" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet18_url" type="hidden" value=""
                                                                       id="sheet18_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image19"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet19"
                                                                       id="sheet19" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet19_url" type="hidden" value=""
                                                                       id="sheet19_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image20"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet20"
                                                                       id="sheet20" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet20_url" type="hidden" value=""
                                                                       id="sheet20_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image21"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet21"
                                                                       id="sheet21" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet21_url" type="hidden" value=""
                                                                       id="sheet21_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image22"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet22"
                                                                       id="sheet22" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet22_url" type="hidden" value=""
                                                                       id="sheet22_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image23"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet23"
                                                                       id="sheet23" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet23_url" type="hidden" value=""
                                                                       id="sheet23_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image24"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet24"
                                                                       id="sheet24" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet24_url" type="hidden" value=""
                                                                       id="sheet24_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image25"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet25"
                                                                       id="sheet25" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet25_url" type="hidden" value=""
                                                                       id="sheet25_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image26"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet26"
                                                                       id="sheet26" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet26_url" type="hidden" value=""
                                                                       id="sheet26_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image27"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet27"
                                                                       id="sheet27" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet27_url" type="hidden" value=""
                                                                       id="sheet27_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image28"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet28"
                                                                       id="sheet28" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet28_url" type="hidden" value=""
                                                                       id="sheet28_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image29"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet29"
                                                                       id="sheet29" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet29_url" type="hidden" value=""
                                                                       id="sheet29_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image30"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="sheet30"
                                                                       id="sheet30" type="file"
                                                                       accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                                                <input name="sheet30_url" type="hidden" value=""
                                                                       id="sheet30_url"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="product_images" class="font-500">Product Images <span class="required"> (Mandatory)</span><small class="font-500">(Note: First image will be displayed as Ad Cover Photo)</small>
                                                <br><small class="font-500">(Atleast one product image | Upto 10MB)</small></label>
                                            <div class="dropzone dz-clickable">
                                                <div class="my-0 dz-default dz-message" data-dz-message="">
                                                    <div class="mx-0 row product-img-sheet">
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image1"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar1"
                                                                       id="avatar1" type="file" accept="image/*"/>
                                                                <input name="avatar1_url" type="hidden" value=""
                                                                       id="avatar1_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image2"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar2"
                                                                       id="avatar2" type="file" accept="image/*"/>
                                                                <input name="avatar2_url" type="hidden" value=""
                                                                       id="avatar2_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image3"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar3"
                                                                       id="avatar3" type="file" accept="image/*"/>
                                                                <input name="avatar3_url" type="hidden" value=""
                                                                       id="avatar3_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image4"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar4"
                                                                       id="avatar4" type="file" accept="image/*"/>
                                                                <input name="avatar4_url" type="hidden" value=""
                                                                       id="avatar4_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image5"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar5"
                                                                       id="avatar5" type="file" accept="image/*"/>
                                                                <input name="avatar5_url" type="hidden" value=""
                                                                       id="avatar5_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image6"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar6"
                                                                       id="avatar6" type="file" accept="image/*"/>
                                                                <input name="avatar6_url" type="hidden" value=""
                                                                       id="avatar6_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image7"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar7"
                                                                       id="avatar7" type="file" accept="image/*"/>
                                                                <input name="avatar7_url" type="hidden" value=""
                                                                       id="avatar7_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image8"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar8"
                                                                       id="avatar8" type="file" accept="image/*"/>
                                                                <input name="avatar8_url" type="hidden" value=""
                                                                       id="avatar8_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image9"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar9"
                                                                       id="avatar9" type="file" accept="image/*"/>
                                                                <input name="avatar9_url" type="hidden" value=""
                                                                       id="avatar9_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image10"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar10"
                                                                       id="avatar10" type="file" accept="image/*"/>
                                                                <input name="avatar10_url" type="hidden" value=""
                                                                       id="avatar10_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image11"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar11"
                                                                       id="avatar11" type="file" accept="image/*"/>
                                                                <input name="avatar11_url" type="hidden" value=""
                                                                       id="avatar11_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image12"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar12"
                                                                       id="avatar12" type="file" accept="image/*"/>
                                                                <input name="avatar12_url" type="hidden" value=""
                                                                       id="avatar12_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image13"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar13"
                                                                       id="avatar13" type="file" accept="image/*"/>
                                                                <input name="avatar13_url" type="hidden" value=""
                                                                       id="avatar13_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image14"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar14"
                                                                       id="avatar14" type="file" accept="image/*"/>
                                                                <input name="avatar14_url" type="hidden" value=""
                                                                       id="avatar14_url"/>
                                                            </div>
                                                        </div>
                                                        <div class="my-1 px-1 col-md-2 col-3">
                                                            <div class="w-100 avatar-wrapper">
                                                                <img class="product-pic" id="uploaded_image15"
                                                                     src="{{$ASSET}}/front_site/images/preview.svg"/>
                                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                                <div class="product-upload-button">
                                                                    <span class="fa fa-plus"></span>
                                                                    <div
                                                                        class="spinner-border text-danger loader-spinner d-none"
                                                                        role="status">
                                                                        <span class="sr-only">Loading...</span>
                                                                    </div>
                                                                </div>
                                                                <input class="product-file-upload" name="avatar15"
                                                                       id="avatar15" type="file" accept="image/*"/>
                                                                <input name="avatar15_url" type="hidden" value=""
                                                                       id="avatar15_url"/>
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
                                                <h6 class="my-2 px-2 heading pro-spec-heading">Specification Sheets</h6>
                                                <div class="product-images-gallery">
                                                    <ul class="mx-0 mb-2 product-gallery edit-comp-prof-imgs">
                                                        @foreach(ProductHelper::getSheets($product->id) as $file)
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
                                                                    <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$file->id}}" aria-hidden="true" style="z-index: 1;right: -8px"></span>

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
                                                        @foreach(ProductHelper::getImages($product->id) as $image)
                                                            <li class="position-relative d-inline-block my-1">
                                                                <input type="hidden" name='img_id' value="{{encrypt($image->id)}}">
                                                                <span class="position-absolute border-0 specification-bin specs fa fa-trash" img_id="{{$image->id}}" aria-hidden="true" style="z-index: 1;right: -8px"></span>
                                                                <div class=" include-in-gallery"
                                                                     data-src="{{$image->image}}"
                                                                     data-pinterest-text="Pin it"
                                                                     data-tweet-text="share on twitter ">
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
                                    <div class="form-row">
                                        <div class="form-group col-lg-6"
                                             @if(in_array("Service", explode(",", $product->product_service_types))) style="display: none;" @endif>
                                            <label for="manufacturer_name" class="d-none font-500 manufacturer_name">Manufacturer
                                                Name <span
                                                    class="required">*</span></label>
                                            <input type="text" id="manufacturer_name"
                                                   @if($product->product_manufacturer) value="{{ $product->product_manufacturer->manufacturer_name }}"
                                                   @endif name="manufacturer_name"
                                                   class="form-control manufacturer-name optional-field"
                                                   placeholder="Manufacture spelling must be correct to be visible in the search."
                                                   required>
                                            <small class="text-danger" id="manufacturer_name_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6"
                                             @if(in_array("Service", explode(",", $product->product_service_types))) style="display: none;" @endif>
                                            <label for="origin" class="d-none font-500">Product Origin <span class="required"> (Mandatory)</span></label>
                                            <select class="form-control origin" id="origin" name="origin" required>
                                                <option value=""></option>
                                                <option disabled>Product Origin (Mandatory)</option>
                                                <option value="Any"
                                                        @if($product->origin == 'Any') selected @endif >Any</option>
                                                @foreach(\DB::table('countries')->get() as $country)
                                                    <option value="{{ $country->country_name }}"
                                                            @if($product->origin == $country->country_name) selected @endif >{{ $country->country_name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="origin_error"></small>
                                        </div>
                                    </div>
                                    <div class="additional-product-info fibre-info" style="display: none">
                                        <span class="d-block mb-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-block font-500">Fibre Type <span
                                                        class="required">*</span></label>
                                                <div class="d-flex">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio"
                                                               class="dyed-greige-Other custom-control-input radio-btn"
                                                               @if($product->fiber_product_info && $product->fiber_product_info->fiber_type =="Dyed") checked="true"
                                                               @endif
                                                               id="purposeDyed" value="Dyed" name="purpose"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="purposeDyed">Dyed</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio"
                                                               class="dyed-greige-Other custom-control-input radio-btn"
                                                               @if($product->fiber_product_info && $product->fiber_product_info->fiber_type =="Greige") checked="true"
                                                               @endif
                                                               value="Greige"
                                                               id="purposeGreige" name="purpose" required>
                                                        <label class="custom-control-label"
                                                               for="purposeGreige">Greige</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio"
                                                               class="dyed-greige-Other custom-control-input radio-btn"
                                                               @if($product->fiber_product_info && $product->fiber_product_info->fiber_type =="Other") checked="true"
                                                               @endif
                                                               value="Other"
                                                               id="purposeOther" name="purpose" required>
                                                        <label class="custom-control-label"
                                                               for="purposeOther">Other</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="purpose_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div" {{ ($product->fiber_product_info && $product->fiber_product_info->fiber_type=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Fibre Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Other Fibre Type (Mandatory)" name="other_purpose" class="form-control"
                                                       @if($product->fiber_product_info && $product->fiber_product_info->fiber_type =="Other") required
                                                       value="{{ $product->fiber_product_info->other_fiber_type }}"
                                                    @endif>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="size" class="d-none font-500">Fibre Size/Length <span
                                                        class="required">*</span></label>
                                                <input type="text" id="size" class="form-control"
                                                       @if($product->fiber_product_info && $product->fiber_product_info->size) value="{{ $product->fiber_product_info->size }}"
                                                       @endif
                                                       name="size" placeholder="Fibre Size/Length (Mandatory) - e.g. 1-2 cm,2-3 cm,3-4 cm,4+ cm, Other"
                                                       required>
                                                <small class="text-danger" id="size_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="strength" class="d-none font-500">Tensile Strength <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="strength" class="form-control optional-field"
                                                       @if($product->fiber_product_info && $product->fiber_product_info->strength) value="{{ $product->fiber_product_info->strength }}"
                                                       @endif
                                                       name="strength"
                                                       placeholder="Tensile Strength (Optional) - e.g. Tenacity, Breaking, Extension, Work Of Rupture, Other">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="end_app" class="d-none font-500">End Use Application <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="end_app" class="form-control optional-field"
                                                       @if($product->fiber_product_info && $product->fiber_product_info->end_use) value="{{ $product->fiber_product_info->end_use }}"
                                                       @endif
                                                       name="end_app"
                                                       placeholder="End Use Application (Optional) - e.g. Open End, Ring, Non-Woven, Other">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info machinery-info">
                                        <span class="d-block mb-1 heading">Additional Product Info</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-500">Product Type <span
                                                        class="required">*</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input"
                                                               id="productStandard" value="Standard" name="product_type"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->product_type == "Standard") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label" for="productStandard">Standard</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input"
                                                               value="Customized" id="productCustomized"
                                                               name="product_type"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->product_type == "Customized") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label" for="productCustomized">Customized</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="product_type_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-500">Condition <span
                                                        class="required">*</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="New"
                                                               id="conditionNew" name="machinery_condition"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->machinery_condition == "New") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label"
                                                               for="conditionNew">New</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="Used"
                                                               id="conditionUsed" name="machinery_condition"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->machinery_condition == "Used") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label"
                                                               for="conditionUsed">Used</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input"
                                                               value="Both New & Used" id="conditionBoth"
                                                               name="machinery_condition"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->machinery_condition == "Both New & Used") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label"
                                                               for="conditionBoth">Both</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="after_sales_service_error"></small>
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
                                                               @if($product->machinery_product_info && $product->machinery_product_info->after_sales_service == "Yes") checked="true"
                                                               @endif  required>
                                                        <label class="custom-control-label" for="productYes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="No"
                                                               id="productNo" name="after_sales_service"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->after_sales_service == "No") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label" for="productNo">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input"
                                                               value="Not Applicable for this product" id="productNa"
                                                               name="after_sales_service"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->after_sales_service == "Not Applicable for this product") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label" for="productNa">Not
                                                            Applicable for this product</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="after_sales_service_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 type-of-service">
                                                <label for="service_type" class="d-none font-500">Type of Service <span
                                                        class="required">*</span></label>
                                                <input type="text" id="service_type" class="form-control"
                                                       name="service_type" placeholder="Type of Service (Mandatory)"
                                                       @if($product->machinery_product_info && $product->machinery_product_info->service_type) value="{{ $product->machinery_product_info->service_type }}"
                                                       @endif required>
                                                <small class="text-danger" id="service_type_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-500">Warranty <span
                                                        class="required"> (Mandatory)</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="Yes"
                                                               id="warrantyYes" name="warranty"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->warranty == "Yes") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label"
                                                               for="warrantyYes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="No"
                                                               id="warrantyNo" name="warranty"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->warranty == "No") checked="true"
                                                            @endif >
                                                        <label class="custom-control-label" for="warrantyNo">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input"
                                                               value="Not Applicable for this product" id="warrantyNa"
                                                               name="warranty"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->warranty == "Not Applicable for this product") checked="true"
                                                            @endif >
                                                        <label class="custom-control-label" for="warrantyNa">Not
                                                            Applicable for this product</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="warranty_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 warranty-services">
                                                <label for="warranty_period" class="d-none font-500">Warranty Period <span
                                                        class="required">*</span></label>
                                                <input type="text" id="warranty_period" class="form-control"
                                                       name="warranty_period" placeholder="Warranty Period (Mandatory)"
                                                       @if($product->machinery_product_info && $product->machinery_product_info->warranty_period) value="{{ $product->machinery_product_info->warranty_period }}"
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
                                                               @if($product->machinery_product_info && $product->machinery_product_info->certification == "Yes") checked="true"
                                                               @endif required>
                                                        <label class="custom-control-label" for="certifyYes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" value="No" class="custom-control-input"
                                                               id="certifyNo" name="certification"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->certification == "No") checked="true"
                                                            @endif >
                                                        <label class="custom-control-label" for="certifyNo">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" value="Not Applicable for this product"
                                                               class="custom-control-input" id="certifyNa"
                                                               name="certification"
                                                               @if($product->machinery_product_info && $product->machinery_product_info->certification == "Not Applicable for this product") checked="true"
                                                            @endif >
                                                        <label class="custom-control-label" for="certifyNa">Not
                                                            Applicable for this product</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="certification_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 certify-services">
                                                <label for="certification_details" class="d-none font-500">Certification
                                                    Details <span class="required"> (Mandatory)</span></label>
                                                <input type="text" id="certification_details" class="form-control"
                                                       name="certification_details" placeholder="Certification Details (Mandatory)"
                                                       @if($product->machinery_product_info && $product->machinery_product_info->certification_details) value="{{ $product->machinery_product_info->certification_details }}"
                                                       @endif required>
                                                <small class="text-danger" id="certification_details_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="additional_trade_notes" class="d-none font-500">Additional Trade
                                                    notes <small class="font-500"> (Optional)</small></label>
                                                <input type="text" class="form-control optional-field"
                                                       id="additional_trade_notes" name="additional_trade_notes"
                                                       placeholder="Additional Trade notes (Optional)"
                                                       @if($product->machinery_product_info && $product->machinery_product_info->additional_trade_notes) value="{{ $product->machinery_product_info->additional_trade_notes }}"
                                                    @endif >
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="product_related_certifications" class="d-none font-500">Company
                                                    Certifications <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="product_related_certifications"
                                                       @if($product->machinery_product_info && $product->machinery_product_info->product_related_certifications) value="{{ $product->machinery_product_info->product_related_certifications }}"
                                                       @endif class="form-control optional-field"
                                                       name="product_related_certifications"
                                                       placeholder="Company Certification (Optional)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info fabric-info" style="display: none;">
                                        <span class="d-block mb-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 fabric-type">
                                                <label class="d-none font-500">Fabric Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <select id="woven_fabric_types" name="woven_fabric_types"
                                                        class="form-control single-select-dropdown" required>
                                                    <option value=""></option>
                                                    <option disabled>Select Fabric Type (Mandatory)</option>
                                                    <option value="Greige" @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Greige') selected @endif>Greige</option>
                                                    <option value="Dyed" @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Dyed') selected @endif>Dyed</option>
                                                    <option value="Yarn Dyed" @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Yarn Dyed') selected @endif>Yarn Dyed</option>
                                                    <option value="Melange" @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Melange') selected @endif>Melange</option>
                                                    <option value="Printed" @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Printed') selected @endif>Printed</option>
                                                    <option value="Embroidered" @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Embroidered') selected @endif>Embroidered</option>
                                                    <option value="Other" id="other_woven_fabric" @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Other') selected @endif class="other-check">Other</option>
                                                </select>
                                                <small class="text-danger" id="woven_fabric_types_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div" {{ ($product->fabric_product_info && $product->fabric_product_info->fabric_types== "Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Woven Fabric Type <span class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Other Woven Fabric Type (Mandatory)" name="other_woven_fabric_type" @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =="Other") value="{{ $product->fabric_product_info->other_fabric_type }}" required @endif class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 weave-type">
                                                <label class="d-none font-500">Weave Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <select id="woven_weave_types" name="woven_weave_types"
                                                        class="form-control single-select-dropdown" required>
                                                    <option value=""></option>
                                                    <option disabled>Select Weave Type (Mandatory)</option>
                                                    <option value="Plain" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Plain') selected @endif>Plain</option>
                                                    <option value="Twill" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Twill') selected @endif>Twill</option>
                                                    <option value="Satin" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Satin') selected @endif>Satin</option>
                                                    <option value="Dobby" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Dobby') selected @endif>Dobby</option>
                                                    <option value="Jacquard" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Jacquard') selected @endif>Jacquard</option>
                                                    <option value="Herringbone" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Herringbone') selected @endif>Herringbone</option>
                                                    <option value="Rib" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Rib') selected @endif>Rib</option>
                                                    <option value="Slub" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Slub') selected @endif>Slub</option>
                                                    <option value="Stripe" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Stripe') selected @endif>Stripe</option>
                                                    <option value="Interlock" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Interlock') selected @endif>Interlock</option>
                                                    <option value="Rip Stop" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Rip Stop') selected @endif>Rip Stop</option>
                                                    <option value="Other" id="other_woven_weave" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =='Other') selected @endif class="other-check">Other</option>
                                                </select>
                                                <small class="text-danger" id="woven_weave_types_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div" {{ ($product->fabric_product_info && $product->fabric_product_info->weave_types=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Woven Weave Type <span class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Other Woven Weave Type (Mandatory)" name="other_woven_weave_type" @if($product->fabric_product_info && $product->fabric_product_info->weave_types =="Other") value="{{ $product->fabric_product_info->other_weave_type }}" required @endif class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="woven_fabric_construction" class="d-none font-500">Fabric
                                                    Construction <span class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Fabric Construction (Mandatory) - e.g. 80*80/100*80, Other" id="woven_fabric_construction" class="form-control" @if($product->fabric_product_info && $product->fabric_product_info->fabric_construction) value="{{ $product->fabric_product_info->fabric_construction }}" @endif name="woven_fabric_construction" placeholder="e.g. 80*80/100*80, Other" required>
                                                <small class="text-danger" id="woven_fabric_construction_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="woven_gsm_thickness" class="d-none font-500">GSM/Thickness <span class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="GSM/Thickness (Mandatory) - e.g. 75 GSM,150 GSM, Other" id="woven_gsm_thickness" @if($product->fabric_product_info && $product->fabric_product_info->gsm_thickness) value="{{ $product->fabric_product_info->gsm_thickness }}" @endif class="form-control" name="woven_gsm_thickness" placeholder="e.g. 75 GSM,150 GSM, Other" required>
                                                <small class="text-danger" id="woven_gsm_thickness"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="woven_fabric_composition" class="d-none font-500">Fabric Composition<small class="font-500"> (Optional)</small></label>
                                                <input type="text" placeholder="Fabric Composition (Optional) - e.g. 60% Cotton, 40% Polyester, Other" id="woven_fabric_composition" @if($product->fabric_product_info && $product->fabric_product_info->fabric_composition) value="{{ $product->fabric_product_info->fabric_composition }}" @endif class="form-control optional-field" name="woven_fabric_composition" placeholder="e.g. 60% Cotton, 40% Polyester, Other">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="mb-0 form-group col-lg-6">
                                                <label for="woven_width" class="d-none font-500">Width Range <span
                                                        class="required">*</span></label>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" placeholder="Woven Width Range From (Mandatory) - e.g. 75 Inches" id="woven_width_from" @if($product->fabric_product_info && $product->fabric_product_info->width_from) value="{{ $product->fabric_product_info->width_from }}" @endif class="form-control" name="woven_width_from" placeholder="e.g. 75 Inches" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" placeholder="Woven Width Range To (Mandatory) - e.g. 105 Inches" id="woven_width_to" @if($product->fabric_product_info && $product->fabric_product_info->width_to) value="{{ $product->fabric_product_info->width_to }}" @endif class="form-control" name="woven_width_to" placeholder="e.g. 105 Inches" required>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="woven_width_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group weaving-checkbox col-lg-6">
                                                <label class="font-500">Manufacturing Technique<span class="required"> (Mandatory)</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Auto Loom" id="wovenAutoLoom" name="woven_manufact" @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Auto Loom") checked="true" @endif required>
                                                        <label class="custom-control-label" for="wovenAutoLoom">Auto Loom</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Shuttleless Loom" id="wovenShuttlelessLoom" name="woven_manufact" @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Shuttleless Loom") checked="true" @endif required>
                                                        <label class="custom-control-label" for="wovenShuttlelessLoom">Shuttleless Loom</label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Air Jet" @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Air Jet") checked="true" @endif id="wovenAirJet" name="woven_manufact" required>
                                                        <label class="custom-control-label" for="wovenAirJet">Air Jet</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Rapier" @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Rapier") checked="true" @endif id="wovenWeavingRapier" name="woven_manufact" required>
                                                        <label class="custom-control-label" for="wovenWeavingRapier">Rapier</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Water Jet"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Water Jet") checked="true"
                                                               @endif
                                                               id="wovenWaterJet" name="woven_manufact" required>
                                                        <label class="custom-control-label" for="wovenWaterJet">Water
                                                            Jet</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Circular Knit"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Circular Knit") checked="true"
                                                               @endif
                                                               id="wovenCircularKnit" name="woven_manufact" required>
                                                        <label class="custom-control-label" for="wovenCircularKnit">Circular
                                                            Knit</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Bounded"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Bounded") checked="true"
                                                               @endif
                                                               id="wovenBounded" name="woven_manufact" required>
                                                        <label class="custom-control-label" for="wovenBounded">
                                                            Bounded</label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Other"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Other") checked="true"
                                                               @endif
                                                               id="wovenOther" name="woven_manufact" required>
                                                        <label class="custom-control-label"
                                                               for="wovenOther">Other</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Any"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Any") checked="true"
                                                               @endif
                                                               id="wovenAny" name="woven_manufact" required>
                                                        <label class="custom-control-label"
                                                               for="wovenAny">Any</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="woven_manufact_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div"
                                                 id="addWovenOtherWeaving" {{ ($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Manufacturing Technique<span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Other Manufacturing Technique (Mandatory)" id="other_woven_manufact" name="other_woven_manufact"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Other") required
                                                       value="{{ $product->fabric_product_info->other_manufacturing_technique }}"
                                                       @endif
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group weaving-checkbox col-lg-6">
                                                <label class="font-500">Yarn Type<span
                                                        class="required"> (Mandatory)</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Carded") checked="true"
                                                               @endif
                                                               value="Carded" id="wovenCarded" name="woven_yarn"
                                                               required>
                                                        <label class="custom-control-label" for="wovenCarded">Carded
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Combed") checked="true"
                                                               @endif
                                                               value="Combed" id="wovenCombed" name="woven_yarn"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="wovenCombed">Combed</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Both"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Both") checked="true"
                                                               @endif id="wovenBoth" name="woven_yarn" required>
                                                        <label class="custom-control-label" for="wovenBoth">Both</label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Other"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Other") checked="true"
                                                               @endif id="wovenYarnOther" name="woven_yarn" required>
                                                        <label class="custom-control-label"
                                                               for="wovenYarnOther">Other</label>
                                                    </div>

                                                </div>
                                                <small class="text-danger" id="woven_yarn_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div"
                                                 id="otherWovenWeaving" {{ ($product->fabric_product_info && $product->fabric_product_info->yarn_type=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Yarn Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Other Yarn Type (Mandatory)" id="other_woven_yarn" name="other_woven_yarn"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Other") required
                                                       value="{{ $product->fabric_product_info->other_yarn_type }}"
                                                       @endif
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-500">Features <span
                                                        class="required"> (Mandatory)</span></label>
                                                <div class="">
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Anti Static", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="wovenFeaturesAntiStatic" value="Anti Static"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="wovenFeaturesAntiStatic">Anti
                                                            Static</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Anti UV", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="wovenFeaturesAntiUV" value="Anti UV"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label" for="wovenFeaturesAntiUV">Anti
                                                            UV</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Flame Retardent", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="wovenFeaturesFlameRetardent" value="Flame Retardent"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="wovenFeaturesFlameRetardent">Flame Retardent</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Water Proof", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="wovenFeaturesWaterProof" value="Water Proof"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="wovenFeaturesWaterProof">Water
                                                            Proof</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Tear Resistant", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="wovenFeaturesTearResistnat" value="Tear Resistant"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="wovenFeaturesTearResistnat">Tear
                                                            Resistant</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Shrink Resistant", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="wovenFeaturesResistant" value="Shrink Resistant"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="wovenFeaturesResistant">Shrink
                                                            Resistant</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Rinkle Free", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="wovenFeaturesRinkle" value="Rinkle Free"
                                                               name="woven_features[]"
                                                               required>
                                                        <label class="custom-control-label" for="wovenFeaturesRinkle">Rinkle
                                                            Free</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check-other"
                                                               @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="wovenFeaturesOther" value="Other"
                                                               name="woven_features[]"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="wovenFeaturesOther">Other</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check-none"
                                                               value="None"
                                                               @if($product->fabric_product_info && in_array("None", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif id="woven_featuresNone" name="woven_features[]"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="woven_featuresNone">None</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="woven_features_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 add-features-field" {{ ($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->features))) ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Features <span
                                                        class="required">*</span></label>
                                                <input id="other_woven_features" name="other_woven_features" placeholder="Other Features (Mandatory)"
                                                       @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->features)))
                                                       value="{{ $product->fabric_product_info->other_feature }}"
                                                       @endif type="text"
                                                       class="form-control" required>
                                                <small class="text-danger" id="other_woven_features_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-block font-500">End Use/Application <span
                                                        class="required"> (Mandatory)</span></label>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseGarment" value="Garment"
                                                           @if($product->fabric_product_info && in_array("Garment", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="woven_use[]" required>
                                                    <label class="custom-control-label"
                                                           for="wovenUseGarment">Garments</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseDress" value="Dress"
                                                           @if($product->fabric_product_info && in_array("Dress", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="woven_use[]" required>
                                                    <label class="custom-control-label"
                                                           for="wovenUseDress">Dress</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseLining" value="Lining"
                                                           @if($product->fabric_product_info && in_array("Lining", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="woven_use[]" required>
                                                    <label class="custom-control-label"
                                                           for="wovenUseLining">Lining</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseSports" value="Sports wear"
                                                           @if($product->fabric_product_info && in_array("Sports wear", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="woven_use[]"
                                                           required>
                                                    <label class="custom-control-label" for="wovenUseSports">Sports
                                                        wear</label>
                                                </div>

                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseGarments" value="Under garments"
                                                           @if($product->fabric_product_info && in_array("Under garments", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="woven_use[]"
                                                           required>
                                                    <label class="custom-control-label" for="wovenUseGarments">Under
                                                        Garments</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseHomeTextile" value="Home Textiles"
                                                           @if($product->fabric_product_info && in_array("Home Textiles", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="woven_use[]" required>
                                                    <label class="custom-control-label"
                                                           for="wovenUseHomeTextile">Home Textiles</label>
                                                </div>

                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseShoesBags" value="Shoes & Bags"
                                                           @if($product->fabric_product_info && in_array("Shoes & Bags", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="woven_use[]" required>
                                                    <label class="custom-control-label" for="wovenUseShoesBags">Shoes &
                                                        Bags</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseAccessories" value="Accessories"
                                                           @if($product->fabric_product_info && in_array("Accessories", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="woven_use[]" required>
                                                    <label class="custom-control-label"
                                                           for="wovenUseAccessories">Accessories</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox"
                                                           class="custom-control-input Use-check-other"
                                                           id="wovenUseOther" value="Other"
                                                           @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="woven_use[]" required>
                                                    <label class="custom-control-label"
                                                           for="wovenUseOther">Other</label>
                                                </div>
                                                <small class="text-danger" id="woven_use_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 add-Use-field" {{ ($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->uses))) ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other End Use/Application <span
                                                        class="required">*</span></label>
                                                <input id="other_woven_use" placeholder="Other End Use/Application (Mandatory)" name="other_woven_use"
                                                       @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->uses)))
                                                       value="{{ $product->fabric_product_info->other_use }}"
                                                       @endif type="text" class="form-control"
                                                       required>
                                                <small class="text-danger" id="other_woven_use_error"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info knitted-fabric-info" style="display: none;">
                                        <span class="d-block mb-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 fabric-type">
                                                <label class="d-none font-500">Fabric Type <span
                                                        class="required">*</span></label>
                                                <select id="knitted_fabric_types" name="knitted_fabric_types"
                                                        class="form-control single-select-dropdown" required>
                                                    <option value=""></option>
                                                    <option disabled>Select Fabric Type (Mandatory)</option>
                                                    <option value="Greige"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Greige') selected @endif>
                                                        Greige
                                                    </option>
                                                    <option value="Dyed"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Dyed') selected @endif>
                                                        Dyed
                                                    </option>
                                                    <option value="Yarn Dyed"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Yarn Dyed') selected @endif>
                                                        Yarn Dyed
                                                    </option>
                                                    <option value="Melange"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Melange') selected @endif>
                                                        Melange
                                                    </option>
                                                    <option value="Printed"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Printed') selected @endif>
                                                        Printed
                                                    </option>
                                                    <option value="Embroidered"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Embroidered') selected @endif>
                                                        Embroidered
                                                    </option>
                                                    <option value="Other"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Other') selected
                                                            @endif id="other_fabric"
                                                            class="other-check">Other
                                                    </option>
                                                </select>
                                                <small class="text-danger" id="knitted_fabric_types_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div" {{ ($product->fabric_product_info &&  $product->fabric_product_info->fabric_types=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Fabric Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Other Fabric Type (Mandatory)" name="other_knitted_fabric_type"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =="Other") value="{{ $product->fabric_product_info->other_fabric_type }}"
                                                       required
                                                       @endif class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 weave-type">
                                                <label class="d-none font-500">Knitting Type <span
                                                        class="required">*</span></label>
                                                <select name="knitted_knitting_types"
                                                        class="form-control single-select-dropdown" required>
                                                    <option value=""></option>
                                                    <option disabled>Select Knitting Type (Mandatory)</option>
                                                    <option value="Warp"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->knitting_type =='Warp') selected @endif>
                                                        Warp
                                                    </option>
                                                    <option value="Weft"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->knitting_type =='Weft') selected @endif>
                                                        Weft
                                                    </option>
                                                    <option value="Circular"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->knitting_type =='Circular') selected @endif>
                                                        Circular
                                                    </option>
                                                    <option value="Single Jersey"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->knitting_type =='Single Jersey') selected @endif>
                                                        Single Jersey
                                                    </option>
                                                    <option value="Double Jersey"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->knitting_type =='Double Jersey') selected @endif>
                                                        Double Jersey
                                                    </option>
                                                    <option value="Other"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->knitting_type =='Other') selected
                                                            @endif class="other-check">Other
                                                    </option>
                                                </select>
                                                <small class="text-danger" id="weave_types_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div" {{ ($product->fabric_product_info && $product->fabric_product_info->knitting_type=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Knitting Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Other Knitting Type (Mandatory)" name="other_knitted_knitting_type"
                                                       class="form-control"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->knitting_type =="Other") value="{{ $product->fabric_product_info->other_knitting_type }}"
                                                       required
                                                    @endif>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="knitted_fabric_construction" class="d-none font-500">Fabric
                                                    Construction <span class="required"> (Mandatory)</span></label>
                                                <input type="text" id="knitted_fabric_construction" class="form-control"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->fabric_construction) value="{{ $product->fabric_product_info->fabric_construction }}"
                                                       @endif
                                                       name="knitted_fabric_construction"
                                                       placeholder="Fabric Construction (Mandatory) - e.g. 80*80/100*80, Other">
                                                <small class="text-danger"
                                                       id="knitted_fabric_construction_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="knitted_gsm_thickness" class="d-none font-500">GSM/Thickness <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" id="knitted_gsm_thickness"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->gsm_thickness) value="{{ $product->fabric_product_info->gsm_thickness }}"
                                                       @endif class="form-control"
                                                       name="knitted_gsm_thickness"
                                                       placeholder="GSM/Thickness (Mandatory) - e.g. 75 GSM,150 GSM, Other"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="knitted_fabric_composition" class="d-none font-500">Fabric
                                                    Composition<small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="knitted_fabric_composition"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->fabric_composition) value="{{ $product->fabric_product_info->fabric_composition }}"
                                                       @endif class="form-control optional-field"
                                                       name="knitted_fabric_composition"
                                                       placeholder="Fabric Composition (Optional) - e.g. 60% Cotton, 40% Polyester, Other">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="mb-0 form-group col-lg-6">
                                                <label for="knitted_width" class="d-none font-500">Width Range <span
                                                        class="required">*</span></label>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" id="knitted_width_from" class="form-control"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->width_from) value="{{ $product->fabric_product_info->width_from }}"
                                                               @endif
                                                               name="knitted_width_from" placeholder="Knitted Width Range From (Mandatory) - e.g. 75 Inches"
                                                               required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" id="knitted_width_to" class="form-control"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->width_to) value="{{ $product->fabric_product_info->width_to }}"
                                                               @endif
                                                               name="knitted_width_to" placeholder="Knitted Width Range From (Mandatory) - e.g. 105 Inches"
                                                               required>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="knitted_width_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-block font-500">Manufacturing Technique<span
                                                        class="required"> (Mandatory)</span></label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedHandLoom" name="knitted_manufact"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Hand Loom") checked="true"
                                                           @endif value="Hand Loom"
                                                           required>
                                                    <label class="custom-control-label" for="knittedHandLoom">Hand
                                                        Loom</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedAutoLoom" name="knitted_manufact"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Auto Loom") checked="true"
                                                           @endif value="Auto Loom"
                                                           required>
                                                    <label class="custom-control-label" for="knittedAutoLoom">Auto
                                                        Loom</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedAirJet" name="knitted_manufact"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Air Jet") checked="true"
                                                           @endif value="Air Jet" required>
                                                    <label class="custom-control-label" for="knittedAirJet">Air
                                                        Jet</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedWeavingRapier" name="knitted_manufact"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Rapier") checked="true"
                                                           @endif value="Rapier" required>
                                                    <label class="custom-control-label"
                                                           for="knittedWeavingRapier">Rapier</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedWaterJet" name="knitted_manufact"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Water Jet") checked="true"
                                                           @endif value="Water Jet" required>
                                                    <label class="custom-control-label" for="knittedWaterJet">Water
                                                        Jet</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedCircularKnit" name="knitted_manufact"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Circular Knit") checked="true"
                                                           @endif value="Circular Knit" required>
                                                    <label class="custom-control-label" for="knittedCircularKnit">Circular
                                                        Knit</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedBounded" name="knitted_manufact"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Bounded") checked="true"
                                                           @endif value="Bounded" required>
                                                    <label class="custom-control-label" for="knittedBounded">
                                                        Bounded</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedOther" name="knitted_manufact"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Other") checked="true"
                                                           @endif value="Other" required>
                                                    <label class="custom-control-label"
                                                           for="knittedOther">Other</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedAny" name="knitted_manufact"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Any") checked="true"
                                                           @endif value="Any" required>
                                                    <label class="custom-control-label"
                                                           for="knittedAny">Any</label>
                                                </div>
                                                <small class="text-danger" id="knitted_manufact_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div" {{ ($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Manufacturing Technique <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" id="other_knitted_manufact"
                                                       @if($product->fabric_product_info && $product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Other") required
                                                       value="{{ $product->fabric_product_info->other_manufacturing_technique }}"
                                                       @endif name="other_knitted_manufact"
                                                       class="form-control" placeholder="Other Manufacturing Technique (Mandatory)">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group weaving-checkbox col-lg-6">
                                                <label class="font-500">Yarn Type<span
                                                        class="required"> (Mandatory)</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Carded") checked="true"
                                                               @endif value="Carded" id="knittedCarded"
                                                               name="knitted_yarn"
                                                               required>
                                                        <label class="custom-control-label" for="knittedCarded">Carded
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Combed") checked="true"
                                                               @endif value="Combed" id="knittedCombed"
                                                               name="knitted_yarn"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="knittedCombed">Combed</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Both") checked="true"
                                                               @endif value="Both"
                                                               id="knittedBoth" name="knitted_yarn" required>
                                                        <label class="custom-control-label"
                                                               for="knittedBoth">Both</label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Other") checked="true"
                                                               @endif value="Other"
                                                               id="knittedWeavingOther" name="knitted_yarn" required>
                                                        <label class="custom-control-label"
                                                               for="knittedWeavingOther">Other</label>
                                                    </div>

                                                </div>
                                                <small class="text-danger" id="knitted_yarn_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div" {{ ($product->fabric_product_info && $product->fabric_product_info->yarn_type=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Yarn Type <span class="required"> (Mandatory)</span></label>
                                                <input type="text" id="other_knitted_yarn_type"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Other") required
                                                       value="{{ $product->fabric_product_info->other_yarn_type }}"
                                                       @endif name="other_knitted_yarn_type"
                                                       class="form-control" placeholder="Other Yarn Type (Mandatory)">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-500">Features <span
                                                        class="required"> (Mandatory)</span></label>
                                                <div class="">
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Anti Static", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif name="knitted_features[]"
                                                               id="knittedFeaturesAntiStatic" value="Anti Static"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="knittedFeaturesAntiStatic">Anti
                                                            Static</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Anti UV", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif name="knitted_features[]"
                                                               id="knittedFeaturesAntiUV" value="Anti UV" required>
                                                        <label class="custom-control-label" for="knittedFeaturesAntiUV">Anti
                                                            UV</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Flame Retardent", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif name="knitted_features[]"
                                                               id="knittedFeaturesFlameRetardent"
                                                               value="Flame Retardent" required>
                                                        <label class="custom-control-label"
                                                               for="knittedFeaturesFlameRetardent">Flame
                                                            Retardent</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Water Proof", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif name="knitted_features[]"
                                                               id="knittedFeaturesWaterProof" value="Water Proof"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="knittedFeaturesWaterProof">Water
                                                            Proof</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Tear Resistant", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif name="knitted_features[]"
                                                               id="knittedFeaturesTearResistnat" value="Tear Resistant"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="knittedFeaturesTearResistnat">Tear
                                                            Resistant</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Shrink Resistant", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif name="knitted_features[]"
                                                               id="knittedFeaturesResistant" value="Shrink Resistant"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="knittedFeaturesResistant">Shrink
                                                            Resistant</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Rinkle Free", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif name="knitted_features[]"
                                                               id="knittedFeaturesRinkle" value="Rinkle Free" required>
                                                        <label class="custom-control-label" for="knittedFeaturesRinkle">Rinkle
                                                            Free</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input knitted-feature-use-check-other"
                                                               @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif name="knitted_features[]"
                                                               id="knittedFeaturesOther" value="Other" required>
                                                        <label class="custom-control-label"
                                                               for="knittedFeaturesOther">Other</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("None", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif name="knitted_features[]"
                                                               id="knittedFeaturesNone" value="None" required>
                                                        <label class="custom-control-label"
                                                               for="knittedFeaturesNone">None</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="knitted_features_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 add-knitted-features-field other-div" {{ ($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->features))) ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Features <span
                                                        class="required">*</span></label>
                                                <input name="other_knitted_features" id="knittedFeaturesOther"
                                                       type="text" placeholder="Other Features (Mandatory)"
                                                       class="form-control"
                                                       @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->features)))
                                                       value="{{ $product->fabric_product_info->other_feature }}"
                                                       @endif required>
                                                <small class="text-danger" id="knittedFeaturesOther_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-none font-500">End Use/Application <span
                                                        class="required"> (Mandatory)</span></label>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           @if($product->fabric_product_info && in_array("Garment", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="knitted_use[]"
                                                           id="knittedUseGarment" value="Garment" required>
                                                    <label class="custom-control-label"
                                                           for="knittedUseGarment">Garments</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           @if($product->fabric_product_info && in_array("Dress", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="knitted_use[]"
                                                           id="knittedUseDress" value="Dress" required>
                                                    <label class="custom-control-label"
                                                           for="knittedUseDress">Dress</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           @if($product->fabric_product_info && in_array("Lining", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="knitted_use[]"
                                                           id="knittedUseLining" value="Lining" required>
                                                    <label class="custom-control-label"
                                                           for="knittedUseLining">Lining</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           @if($product->fabric_product_info && in_array("Sports wear", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="knitted_use[]"
                                                           id="knittedUseSports" value="Sports wear" required>
                                                    <label class="custom-control-label" for="knittedUseSports">Sports
                                                        wear</label>
                                                </div>

                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           @if($product->fabric_product_info && in_array("Under garments", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="knitted_use[]"
                                                           id="knittedUseGarments" value="Under garments" required>
                                                    <label class="custom-control-label" for="knittedUseGarments">Under
                                                        Garments</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           @if($product->fabric_product_info && in_array("Home Textiles", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="knitted_use[]"
                                                           id="knittedUseTextile" value="Home Textiles" required>
                                                    <label class="custom-control-label"
                                                           for="knittedUseTextile">Home Textiles</label>
                                                </div>

                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           @if($product->fabric_product_info && in_array("Shoes & Bags", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="knitted_use[]"
                                                           id="knittedUseShoesBags" value="Shoes & Bags" required>
                                                    <label class="custom-control-label" for="knittedUseShoesBags">Shoes
                                                        & Bags</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           @if($product->fabric_product_info && in_array("Accessories", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="knitted_use[]"
                                                           id="knittedUseAccessories" value="Accessories" required>
                                                    <label class="custom-control-label"
                                                           for="knittedUseAccessories">Accessories</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox"
                                                           class="custom-control-input knitted-use-check-other"
                                                           @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                           @endif name="knitted_use[]"
                                                           id="knittedUseOther" value="Other" required>
                                                    <label class="custom-control-label"
                                                           for="knittedUseOther">Other</label>
                                                </div>
                                                <small class="text-danger" id="knitted_use_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 add-knitted-Use-field" {{ ($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->uses))) ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other End Use Application <span
                                                        class="required">*</span></label>
                                                <input name="other_knitted_use" id="otherKnittedUse" type="text"
                                                       class="form-control" placeholder="Other End Use Application (Mandatory)"
                                                       @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->uses)))
                                                       value="{{ $product->fabric_product_info->other_use }}"
                                                       @endif
                                                       required>
                                                <small class="text-danger" id="otherKnittedUse_error"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info non-woven-fabric-info" style="display: none;">
                                        <span class="d-block mb-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 fabric-type">
                                                <label class="d-none font-500">Fabric Type <span
                                                        class="required">*</span></label>
                                                <select id="non_woven_fabric_types" name="non_woven_fabric_types"
                                                        class="form-control single-select-dropdown" required>
                                                    <option value=""></option>
                                                    <option disabled>Select Fabric Type (Mandatory)</option>
                                                    <option value="Greige"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Greige') selected @endif>
                                                        Greige
                                                    </option>
                                                    <option value="Dyed"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Dyed') selected @endif>
                                                        Dyed
                                                    </option>
                                                    <option value="Yarn Dyed"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Yarn Dyed') selected @endif>
                                                        Yarn Dyed
                                                    </option>
                                                    <option value="Melange"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Melange') selected @endif>
                                                        Melange
                                                    </option>
                                                    <option value="Printed"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Printed') selected @endif>
                                                        Printed
                                                    </option>
                                                    <option value="Embroidered"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Embroidered') selected @endif>
                                                        Embroidered
                                                    </option>
                                                    <option value="Other" id="other_non_wovenfabric"
                                                            class="other-check"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =='Other') selected @endif>
                                                        Other
                                                    </option>
                                                </select>
                                                <small class="text-danger" id="non_woven_fabric_types_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div add-fabric-type" {{ ($product->fabric_product_info && $product->fabric_product_info->fabric_types=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Fabric Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" name="other_non_woven_fabric_type"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->fabric_types =="Other") value="{{ $product->fabric_product_info->other_fabric_type }}"
                                                       required
                                                       @endif class="form-control" placeholder="Other Fabric Type (Mandatory)">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 weave-type">
                                                <label class="d-none font-500">Non Woven Type <span
                                                        class="required">*</span></label>
                                                <select id="non_woven_types" name="non_woven_types"
                                                        class="form-control single-select-dropdown" required>
                                                    <option value=""></option>
                                                    <option disabled>Select Non Woven Type (Mandatory)</option>
                                                    <option value="Spun Lace"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->non_woven_types =='Spun Lace') selected @endif>
                                                        Spun Lace
                                                    </option>
                                                    <option value="Composite"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->non_woven_types =='Composite') selected @endif>
                                                        Composite
                                                    </option>
                                                    <option value="PP Needle Felt"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->non_woven_types =='PP Needle Felt') selected @endif>
                                                        PP Needle Felt
                                                    </option>
                                                    <option value="PP Spun Bonded"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->non_woven_types =='PP Spun Bonded') selected @endif>
                                                        PP Spun Bonded
                                                    </option>
                                                    <option value="PP Non Woven"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->non_woven_types =='PP Non Woven') selected @endif>
                                                        PP Non Woven
                                                    </option>
                                                    <option value="Chemical Bounded"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->non_woven_types =='Chemical Bounded') selected @endif>
                                                        Chemical Bounded
                                                    </option>
                                                    <option value="Other"
                                                            @if($product->fabric_product_info && $product->fabric_product_info->non_woven_types =='Other') selected
                                                            @endif id="other_fabric"
                                                            class="other-check">Other
                                                    </option>
                                                </select>
                                                <small class="text-danger" id="non_woven_types_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div add-fabric-type" {{ ($product->fabric_product_info && $product->fabric_product_info->non_woven_types=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" name="other_non_woven_type"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->non_woven_types =="Other") value="{{ $product->fabric_product_info->other_non_woven_type }}"
                                                       required
                                                       @endif class="form-control" placeholder="Other Type (Mandatory)">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="non_woven_fabric_construction" class="d-none font-500">Fabric
                                                    Construction <span class="required"> (Mandatory)</span></label>
                                                <input type="text" id="non_woven_fabric_construction"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->fabric_construction) value="{{ $product->fabric_product_info->fabric_construction }}"
                                                       @endif class="form-control"
                                                       name="non_woven_fabric_construction"
                                                       placeholder="Fabric Construction (Mandatory) - e.g. 80*80/100*80, Other"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="non_woven_gsm_thickness" class="d-none font-500">GSM/Thickness
                                                    <span class="required"> (Mandatory)</span></label>
                                                <input type="text" id="non_woven_gsm_thickness"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->gsm_thickness) value="{{ $product->fabric_product_info->gsm_thickness }}"
                                                       @endif class="form-control"
                                                       name="non_woven_gsm_thickness"
                                                       placeholder="GSM/Thickness (Mandatory) - e.g. 75 GSM,150 GSM, Other"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="non_woven_fabric_composition" class="d-none font-500">Fabric
                                                    Composition<small class="font-500"> (Optional)</small></label>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <input type="text" id="non_woven_fabric_composition"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->fabric_composition) value="{{ $product->fabric_product_info->fabric_composition }}"
                                                               @endif class="form-control optional-field"
                                                               name="non_woven_fabric_composition"
                                                               placeholder="Fabric Composition (Optional) - e.g. 60% Cotton, 40% Polyester, Other">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="mb-0 form-group col-lg-6">
                                                <label for="non_woven_width" class="d-none font-500">Width Range <span
                                                        class="required">*</span></label>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" id="non_woven_width_from"
                                                               class="form-control"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->width_from) value="{{ $product->fabric_product_info->width_from }}"
                                                               @endif
                                                               name="non_woven_width_from" placeholder="Non Woven Width Range From (Mandatory) - e.g. 75 Inches"
                                                               required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" id="non_woven_width_to" class="form-control"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->width_to) value="{{ $product->fabric_product_info->width_to }}"
                                                               @endif
                                                               name="non_woven_width_to" placeholder="Non Woven Width Range To (Mandatory) - e.g. 105 Inches"
                                                               required>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="non_woven_width_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group weaving-checkbox col-lg-6">
                                                <label class="d-block font-500">Manufacturing Technique<span
                                                        class="required"> (Mandatory)</span></label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           value="Hand Loom" id="non_wovenHandLoom"
                                                           name="non_woven_manufact"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Hand Loom") checked="true"
                                                           @endif
                                                           required>
                                                    <label class="custom-control-label" for="non_wovenHandLoom">Hand
                                                        Loom</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           value="Auto Loom" id="non_wovenAutoLoom"
                                                           name="non_woven_manufact"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Auto Loom") checked="true"
                                                           @endif
                                                           required>
                                                    <label class="custom-control-label" for="non_wovenAutoLoom">Auto
                                                        Loom</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           value="Air Jet"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Air Jet") checked="true"
                                                           @endif
                                                           id="non_wovenAirJet" name="non_woven_manufact" required>
                                                    <label class="custom-control-label" for="non_wovenAirJet">Air
                                                        Jet</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Rapier") checked="true"
                                                           @endif value="Rapier"
                                                           id="non_wovenRapier" name="non_woven_manufact" required>
                                                    <label class="custom-control-label"
                                                           for="non_wovenRapier">Rapier</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Water Jet") checked="true"
                                                           @endif value="Water Jet"
                                                           id="non_wovenWaterJet" name="non_woven_manufact" required>
                                                    <label class="custom-control-label" for="non_wovenWaterJet">Water
                                                        Jet</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           value="Circular Knit"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Circular Knit") checked="true"
                                                           @endif
                                                           id="non_wovenCircularKnit" name="non_woven_manufact"
                                                           required>
                                                    <label class="custom-control-label" for="non_wovenCircularKnit">Circular
                                                        Knit</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           value="Bounded"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Bounded") checked="true"
                                                           @endif
                                                           id="non_wovenBounded" name="non_woven_manufact" required>
                                                    <label class="custom-control-label" for="non_wovenBounded">
                                                        Bounded</label>
                                                </div>

                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           value="Other"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Other") checked="true"
                                                           @endif
                                                           id="non_wovenOther" name="non_woven_manufact" required>
                                                    <label class="custom-control-label"
                                                           for="non_wovenOther">Other</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           value="Any"
                                                           @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Any") checked="true"
                                                           @endif
                                                           id="non_wovenAny" name="non_woven_manufact" required>
                                                    <label class="custom-control-label"
                                                           for="non_wovenAny">Any</label>
                                                </div>
                                                <small class="text-danger" id="non_woven_manufact_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div"
                                                 id="addNonWovenOtherWeaving" {{ ($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Manufacturing Technique <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" id="other_non_woven_manufact"
                                                       name="other_non_woven_manufact"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->manufacturing_technique =="Other") required
                                                       value="{{ $product->fabric_product_info->other_manufacturing_technique }}"
                                                       @endif
                                                       class="form-control" placeholder="Other Manufacturing Technique (Mandatory)">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group weaving-checkbox col-lg-6">
                                                <label class="font-500">Yarn Type<span
                                                        class="required"> (Mandatory)</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Carded") checked="true"
                                                               @endif value="Carded" id="non_wovenCarded"
                                                               name="non_woven_yarn"
                                                               required>
                                                        <label class="custom-control-label" for="non_wovenCarded">Carded
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Combed") checked="true"
                                                               @endif value="Combed" id="non_wovenCombed"
                                                               name="non_woven_yarn"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenCombed">Combed</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Both") checked="true"
                                                               @endif value="Both"
                                                               id="non_wovenBoth" name="non_woven_yarn" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenBoth">Both</label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Other") checked="true"
                                                               @endif value="Other"
                                                               id="non_wovenYarnOther" name="non_woven_yarn" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenYarnOther">Other</label>
                                                    </div>

                                                </div>
                                                <small class="text-danger" id="non_woven_yarn_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div"
                                                 id="addOtherNonWovenWeaving" {{ ($product->fabric_product_info && $product->fabric_product_info->yarn_type=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Yarn Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" id="other_non_woven_yarn"
                                                       @if($product->fabric_product_info && $product->fabric_product_info->yarn_type =="Other") required
                                                       value="{{ $product->fabric_product_info->other_yarn_type }}"
                                                       @endif name="other_non_woven_yarn"
                                                       class="form-control" placeholder="Other Yarn Type (Mandatory)">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-500">Features <span
                                                        class="required"> (Mandatory)</span></label>
                                                <div class="">
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Anti Static", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="non_wovenFeaturesAntiStatic" value="Anti Static"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesAntiStatic">Anti
                                                            Static</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Anti UV", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="non_wovenFeaturesAntiUV" value="Anti UV"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesAntiUV">Anti
                                                            UV</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Flame Retardent", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="non_wovenFeaturesFlameRetardent"
                                                               value="Flame Retardent"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesFlameRetardent">Flame
                                                            Retardent</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Water Proof", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="non_wovenFeaturesWaterProof" value="Water Proof"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesWaterProof">Water
                                                            Proof</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Tear Resistant", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="non_wovenFeaturesTearResistnat"
                                                               value="Tear Resistant"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesTearResistnat">Tear
                                                            Resistant</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Shrink Resistant", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="non_wovenFeaturesResistant" value="Shrink Resistant"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesResistant">Shrink
                                                            Resistant</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               @if($product->fabric_product_info && in_array("Rinkle Free", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="non_wovenFeaturesRinkle" value="Rinkle Free"
                                                               name="non_woven_features[]"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesRinkle">Rinkle
                                                            Free</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input non-woven-features-check-other"
                                                               @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="non_wovenFeaturesOther" value="Other"
                                                               name="non_woven_features[]"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesOther">Other</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check-none"
                                                               value="None"
                                                               @if($product->fabric_product_info && in_array("None", explode(",", $product->fabric_product_info->features))) checked="true"
                                                               @endif
                                                               id="non_wovenFeaturesNone" name="non_woven_features[]"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesNone">None</label>
                                                    </div>

                                                    <small class="text-danger" id="non_woven_features_error"></small>
                                                </div>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 add-nonwoven-features-field" {{ ($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->features))) ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Features <span
                                                        class="required">*</span></label>
                                                <input id="other_non_woven_features" placeholder="Other Features (Mandatory)" name="other_non_woven_features"
                                                       type="text"
                                                       class="form-control"
                                                       @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->features)))
                                                       value="{{ $product->fabric_product_info->other_feature }}"
                                                       @endif required>
                                                <small class="text-danger" id="other_non_woven_features_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="font-500">End Use/Application <span
                                                        class="required"> (Mandatory)</span></label>
                                                <div class="">
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Garment", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                               @endif
                                                               id="non_wovenUseGarment" value="Garment"
                                                               name="non_woven_use[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenUseGarment">Garments</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Dress", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                               @endif
                                                               id="non_wovenUseDress" value="Dress"
                                                               name="non_woven_use[]" required>
                                                        <label class="custom-control-label" for="non_wovenUseDress">Dress</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Lining", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                               @endif
                                                               id="non_wovenUseLining" value="Lining"
                                                               name="non_woven_use[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenUseLining">Lining</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Sports wear", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                               @endif
                                                               id="non_wovenUseSports" value="Sports wear"
                                                               name="non_woven_use[]"
                                                               required>
                                                        <label class="custom-control-label" for="non_wovenUseSports">Sports
                                                            wear</label>
                                                    </div>

                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Under garments", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                               @endif
                                                               id="non_wovenUseUnderGarments" value="Under garments"
                                                               name="non_woven_use[]"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenUseUnderGarments">Under
                                                            Garments</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Home Textiles", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                               @endif
                                                               id="non_wovenUseHomeTextile" value="Home Textiles"
                                                               name="non_woven_use[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenUseHomeTextile">Home Textiles</label>
                                                    </div>

                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Shoes & Bags", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                               @endif
                                                               id="non_wovenUseShoesBags" value="Shoes & Bags"
                                                               name="non_woven_use[]" required>
                                                        <label class="custom-control-label" for="non_wovenUseShoesBags">Shoes
                                                            & Bags</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               @if($product->fabric_product_info && in_array("Accessories", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                               @endif
                                                               id="non_wovenUseAccessories" value="Accessories"
                                                               name="non_woven_use[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenUseAccessories">Accessories</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input End-check-other"
                                                               @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->uses))) checked="true"
                                                               @endif
                                                               id="non_wovenUseOther" value="Other"
                                                               name="non_woven_use[]" required>
                                                        <label class="custom-control-label" for="non_wovenUseOther">Other</label>
                                                    </div>
                                                    <small class="text-danger" id="non_woven_use_error"></small>
                                                </div>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 add-End-field" {{ ($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->uses))) ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other End Use/Application <span
                                                        class="required">*</span></label>
                                                <input id="other_non_woven_use" placeholder="Other End Use/Application (Mandatory)" name="other_non_woven_use"
                                                       @if($product->fabric_product_info && in_array("Other", explode(",", $product->fabric_product_info->uses)))
                                                       value="{{ $product->fabric_product_info->other_use }}"
                                                       @endif type="text" class="form-control"
                                                       required>
                                                <small class="text-danger" id="other_non_woven_use_error"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info Yarn-info" style="display: none;">
                                        <span class="d-block mb-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-none font-500">Yarn Count <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input name="yarn_count" class="form-control"
                                                       @if($product->yarn_product_info && $product->yarn_product_info->count) value="{{ $product->yarn_product_info->count }}"
                                                       @endif placeholder="Yarn Count (Mandatory) - i.e 20 Ne,80 Ne, 50 Dtex, 150 Danier, Other"
                                                       required>
                                                <small class="text-danger" id="yarn_count_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-none font-500">Yarn Count Unit<span class="required"> (Mandatory)</span></label>
                                                <select id="yarn_count_unit" name="yarn_count_unit" class="form-control single-select-dropdown" required>
                                                    <option value=""></option>
                                                    <option disabled>Select Yarn Count Unit (Mandatory)</option>
                                                    <option value="Ne" @if($product->yarn_product_info && $product->yarn_product_info->count_unit =='Ne') selected @endif>
                                                        Ne
                                                    </option>
                                                    <option value="Nm" @if($product->yarn_product_info && $product->yarn_product_info->count_unit =='Nm') selected @endif>
                                                        Nm
                                                    </option>
                                                    <option value="Lea" @if($product->yarn_product_info && $product->yarn_product_info->count_unit =='Lea') selected @endif>
                                                        Lea
                                                    </option>
                                                    <option value="YSW" @if($product->yarn_product_info && $product->yarn_product_info->count_unit =='YSW') selected @endif>
                                                        YSW
                                                    </option>
                                                    <option value="NeK" @if($product->yarn_product_info && $product->yarn_product_info->count_unit =='NeK') selected @endif>
                                                        NeK
                                                    </option>
                                                    <option value="Denier" @if($product->yarn_product_info && $product->yarn_product_info->count_unit =='Denier') selected @endif>
                                                        Denier
                                                    </option>
                                                    <option value="Tex" @if($product->yarn_product_info && $product->yarn_product_info->count_unit =='Tex') selected @endif>
                                                        Tex
                                                    </option>
                                                    <option value="Mtex" @if($product->yarn_product_info && $product->yarn_product_info->count_unit =='Mtex') selected @endif>
                                                        Mtex
                                                    </option>
                                                    <option value="Dtex" @if($product->yarn_product_info && $product->yarn_product_info->count_unit =='Dtex') selected @endif>
                                                        Dtex
                                                    </option>
                                                    <option value="Other" class="other-check" @if($product->yarn_product_info && $product->yarn_product_info->count_unit =='Other') selected @endif>
                                                        Other
                                                    </option>
                                                </select>
                                                <small class="text-danger" id="yarn_count_unit_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div" {{ ($product->yarn_product_info &&  $product->yarn_product_info->count_unit=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Count Unit <span class="required"> (Mandatory)</span></label>
                                                <input type="text" name="other_yarn_count_unit" placeholder="Other Count Unit (Mandatory)" @if($product->yarn_product_info && $product->yarn_product_info->count_unit =="Other") value="{{ $product->yarn_product_info->other_count_unit }}" required @endif class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-none font-500">Yarn Attribute<span
                                                        class="required">*</span></label>
                                                <select id="yarn_attribute" name="yarn_attribute"
                                                        class="form-control single-select-dropdown"
                                                        required>
                                                    <option value=""></option>
                                                    <option disabled>Select Yarn Attribute (Mandatory)</option>
                                                    <option value="Greige"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->attribute == 'Greige') selected @endif>
                                                        Greige
                                                    </option>
                                                    <option value="RFD"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->attribute == 'RFD') selected @endif>
                                                        RFD
                                                    </option>
                                                    <option value="Dyed"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->attribute == 'Dyed') selected @endif>
                                                        Dyed
                                                    </option>
                                                    <option value="Semi Dull"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->attribute == 'Semi Dull') selected @endif>
                                                        Semi Dull
                                                    </option>
                                                    <option value="Full Dull"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->attribute == 'Full Dull') selected @endif>
                                                        Full Dull
                                                    </option>
                                                    <option value="Optical White"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->attribute == 'Optical White') selected @endif>
                                                        Optical White
                                                    </option>
                                                    <option value="Bright"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->attribute == 'Bright') selected @endif>
                                                        Bright
                                                    </option>
                                                    <option value="Dope Dyed"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->attribute == 'Dope Dyed') selected @endif>
                                                        Dope Dyed
                                                    </option>
                                                    <option value="Other" class="other-check"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->attribute == 'Other') selected @endif>
                                                        Other
                                                    </option>
                                                </select>
                                                <small class="text-danger" id="yarn_attribute_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div" {{ ($product->yarn_product_info &&  $product->yarn_product_info->attribute=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Yarn Attribute <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" name="other_yarn_attribute"
                                                       @if($product->yarn_product_info && $product->yarn_product_info->attribute =="Other") value="{{ $product->yarn_product_info->other_attribute }}"
                                                       required @endif class="form-control" placeholder="Other Yarn Attribute (Mandatory)">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-none font-500">Technology<span
                                                        class="required">*</span></label>
                                                <select id="yarn_technology" name="yarn_technology"
                                                        class="form-control single-select-dropdown"
                                                        required>
                                                    <option value=""></option>
                                                    <option disabled>Select Yarn Technology (Mandatory)</option>
                                                    <option value="Ring"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->technology =='Ring') selected @endif>
                                                        Ring
                                                    </option>
                                                    <option value="Rotor"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->technology =='Rotor') selected @endif>
                                                        Rotor
                                                    </option>
                                                    <option value="Jet/MJS"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->technology =='Jet/MJS') selected @endif>
                                                        Jet/MJS
                                                    </option>
                                                    <option value="Vortex/MVS"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->technology =='Vortex/MVS') selected @endif>
                                                        Vortex/MVS
                                                    </option>
                                                    <option value="Open End"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->technology =='Open End') selected @endif>
                                                        Open End
                                                    </option>
                                                    <option value="Siro"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->technology =='Siro') selected @endif>
                                                        Siro
                                                    </option>
                                                    <option value="Dry Spinning"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->technology =='Dry Spinning') selected @endif>
                                                        Dry Spinning
                                                    </option>
                                                    <option value="Wet Spinning"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->technology =='Wet Spinning') selected @endif>
                                                        Wet Spinning
                                                    </option>
                                                    <option value="Melt"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->technology =='Melt') selected @endif>
                                                        Melt
                                                    </option>
                                                    <option value="Other" class="other-check"
                                                            @if($product->yarn_product_info && $product->yarn_product_info->technology =='Other') selected @endif>
                                                        Other
                                                    </option>
                                                </select>
                                                <small class="text-danger" id="yarn_technology_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div" {{ ($product->yarn_product_info &&  $product->yarn_product_info->technology=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Technology <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Other Technology (Mandatory)" name="other_yarn_technology" class="form-control"
                                                       @if($product->yarn_product_info && $product->yarn_product_info->technology =="Other") value="{{ $product->yarn_product_info->other_technology }}"
                                                       required
                                                    @endif>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-none font-500">Yarn Grade <span
                                                        class="required">*</span></label>
                                                <input name="yarn_grade" class="form-control"
                                                       @if($product->yarn_product_info && $product->yarn_product_info->grade) value="{{ $product->yarn_product_info->grade }}"
                                                       @endif placeholder="Yarn Grade (Mandatory) - i.e A-Grade, B-Grade, Other"
                                                       required>
                                                <small class="text-danger" id="yarn_grade_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="tpi" class="d-none font-500">TPI <small class="font-500">
                                                        (Optional)</small></label>
                                                <input type="text" id="tpi" name="tpi"
                                                       class="form-control optional-field"
                                                       @if($product->yarn_product_info && $product->yarn_product_info->tpi) value="{{ $product->yarn_product_info->tpi }}"
                                                       @endif placeholder="TPI (Optional) - TPI (Twist Per Inch) i.e Mention TPI">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="tenacity" class="d-none font-500">Tenacity <small class="font-500">
                                                        (Optional)</small></label>
                                                <input type="text" id="tenacity" name="tenacity"
                                                       class="form-control optional-field"
                                                       @if($product->yarn_product_info && $product->yarn_product_info->tenacity) value="{{ $product->yarn_product_info->tenacity }}"
                                                       @endif placeholder="Tenacity (Optional) - i.e Mention Yarn Tenacity"
                                                >
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-block font-500" for="count_type">Count Type <span
                                                        class="required">*</span></label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->count_type =="Single") checked="true"
                                                           @endif
                                                           id="countSingle" value="Single" name="count_type"
                                                           required>
                                                    <label class="custom-control-label"
                                                           for="countSingle">Single</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->count_type =="Double") checked="true"
                                                           @endif
                                                           id="countDouble" value="Double" name="count_type"
                                                           required>
                                                    <label class="custom-control-label"
                                                           for="countDouble">Double</label>
                                                </div>
                                                <div
                                                    class="custom-control custom-radio custom-control-inline count_typeTexturised">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->count_type =="Triple") checked="true"
                                                           @endif
                                                           id="countTriple" value="Triple" name="count_type"
                                                           required>
                                                    <label class="custom-control-label"
                                                           for="countTriple">Triple</label>
                                                </div>
                                                <div
                                                    class="custom-control custom-radio custom-control-inline count_typeTexturised">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->count_type =="Quadruple") checked="true"
                                                           @endif
                                                           id="countQuadruple" value="Quadruple"
                                                           name="count_type"
                                                           required>
                                                    <label class="custom-control-label"
                                                           for="countQuadruple">Quadruple</label>
                                                </div>
                                                <div
                                                    class="custom-control custom-radio custom-control-inline count_typeTexturised">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->count_type =="Other") checked="true"
                                                           @endif
                                                           id="countOther" value="Other" name="count_type"
                                                           required>
                                                    <label class="custom-control-label"
                                                           for="countOther">Other</label>
                                                </div>
                                                <small class="text-danger" id="count_type_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div" {{ ($product->yarn_product_info && $product->yarn_product_info->count_type=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Count Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Other Count Type (Mandatory)" name="other_count_type" class="form-control"
                                                       @if($product->yarn_product_info && $product->yarn_product_info->count_type =="Other") required
                                                       value="{{ $product->yarn_product_info->other_count_type }}"
                                                    @endif>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-block font-500">Yarn Speciality <span
                                                        class="required">*</span></label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->yarn_specialty =="Regular") checked="true"
                                                           @endif
                                                           id="yarnRegular" value="Regular"
                                                           name="yarn_specialty"
                                                           required>
                                                    <label class="custom-control-label"
                                                           for="yarnRegular">Regular</label>
                                                </div>
                                                <div
                                                    class="custom-control custom-radio custom-control-inline yarn_specialtyTexturised">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->yarn_specialty =="BCI") checked="true"
                                                           @endif
                                                           id="yarnBCI"
                                                           name="yarn_specialty" value="BCI" required>
                                                    <label class="custom-control-label"
                                                           for="yarnBCI">BCI</label>
                                                </div>
                                                <div
                                                    class="custom-control custom-radio custom-control-inline yarn_specialtyTexturised">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->yarn_specialty =="Organic") checked="true"
                                                           @endif
                                                           id="yarnOrganic" value="Organic"
                                                           name="yarn_specialty"
                                                           required>
                                                    <label class="custom-control-label"
                                                           for="yarnOrganic">Organic</label>
                                                </div>
                                                <div
                                                    class="custom-control custom-radio custom-control-inline yarn_specialtyTexturised">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->yarn_specialty =="Imported cotton") checked="true"
                                                           @endif
                                                           id="yarnCotton"
                                                           value="Imported cotton" name="yarn_specialty"
                                                           required>
                                                    <label class="custom-control-label" for="yarnCotton">Imported
                                                        cotton</label>
                                                </div>
                                                <div
                                                    class="custom-control custom-radio custom-control-inline yarn_specialtyTexturised">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->yarn_specialty =="Other") checked="true"
                                                           @endif
                                                           id="yarnOther"
                                                           name="yarn_specialty" value="Other" required>
                                                    <label class="custom-control-label"
                                                           for="yarnOther">Other</label>
                                                </div>
                                                <small class="text-danger" id="yarn_specialty_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div" {{ ($product->yarn_product_info && $product->yarn_product_info->yarn_specialty=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other Yarn Speciality <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Other Yarn Speciality (Mandatory)" name="other_yarn_speciality" class="form-control"
                                                       @if($product->yarn_product_info && $product->yarn_product_info->yarn_specialty =="Other") required
                                                       value="{{ $product->yarn_product_info->other_speciality }}"
                                                    @endif>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label class="d-block font-500">End Use/Application <span
                                                        class="required">*</span></label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->end_use =="Warp") checked="true"
                                                           @endif
                                                           id="usageWrap"
                                                           name="usage_type" value="Warp" required>
                                                    <label class="custom-control-label"
                                                           for="usageWrap">Warp</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->end_use =="Weft") checked="true"
                                                           @endif
                                                           id="usageWeft"
                                                           name="usage_type" value="Weft" required>
                                                    <label class="custom-control-label"
                                                           for="usageWeft">Weft</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->end_use =="Knitting") checked="true"
                                                           @endif
                                                           id="usageKnitting"
                                                           name="usage_type" value="Knitting" required>
                                                    <label class="custom-control-label"
                                                           for="usageKnitting">Knitting</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->end_use =="Hand Knitting") checked="true"
                                                           @endif
                                                           id="usageHandKnitting"
                                                           name="usage_type" value="Hand Knitting" required>
                                                    <label class="custom-control-label"
                                                           for="usageHandKnitting">Hand Knitting</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->end_use =="Weaving") checked="true"
                                                           @endif
                                                           id="usageWeaving"
                                                           name="usage_type" value="Weaving" required>
                                                    <label class="custom-control-label"
                                                           for="usageWeaving">Weaving</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->end_use =="Braiding") checked="true"
                                                           @endif
                                                           id="usageBraiding"
                                                           name="usage_type" value="Braiding" required>
                                                    <label class="custom-control-label"
                                                           for="usageBraiding">Braiding</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->end_use =="Cordage") checked="true"
                                                           @endif
                                                           id="usageCordage"
                                                           name="usage_type" value="Cordage" required>
                                                    <label class="custom-control-label"
                                                           for="usageCordage">Cordage</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->end_use =="Sewing") checked="true"
                                                           @endif
                                                           id="usageSewing"
                                                           name="usage_type" value="Sewing" required>
                                                    <label class="custom-control-label"
                                                           for="usageSewing">Sewing</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->end_use =="Carpet") checked="true"
                                                           @endif
                                                           id="usageCarpet"
                                                           name="usage_type" value="Carpet" required>
                                                    <label class="custom-control-label"
                                                           for="usageCarpet">Carpet</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           @if($product->yarn_product_info && $product->yarn_product_info->end_use =="Other") checked="true"
                                                           @endif
                                                           id="usageOther"
                                                           name="usage_type" value="Other" required>
                                                    <label class="custom-control-label"
                                                           for="usageOther">Other</label>
                                                </div>
                                                <small class="text-danger" id="usage_type_error"></small>
                                            </div>
                                            <div
                                                class="form-group col-lg-6 other-div" {{ ($product->yarn_product_info && $product->yarn_product_info->end_use=="Other") ? 'style=display:block;' : '' }}>
                                                <label class="d-none font-500">Other End Use/Application <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" placeholder="Other End Use/Application (Mandatory)" name="other_usage_type" class="form-control"
                                                       @if($product->yarn_product_info && $product->yarn_product_info->end_use =="Other") required
                                                       value="{{ $product->yarn_product_info->other_end_use }}"
                                                    @endif>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info ppe-institutional-info" style="display: none;">
                                        <span class="d-block mb-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="material" class="d-none font-500">Material Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" id="material" class="form-control"
                                                       @if($product->institutional_product_info && $product->institutional_product_info->material) value="{{ $product->institutional_product_info->material }}"
                                                       @endif name="material"
                                                       placeholder="Material Type (Mandatory) - i.e Cotton, Polyester, Nylon, Blend, Other"
                                                       required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="composition" class="d-none font-500">Composition/Construction <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" id="composition" class="form-control"
                                                       @if($product->institutional_product_info && $product->institutional_product_info->composition) value="{{ $product->institutional_product_info->composition }}"
                                                       @endif name="composition"
                                                       placeholder="Composition/Construction (Mandatory) - e.g. 60% Cotton, 40% Polyester, 80*80/100*80, 2 ply, Other"
                                                       required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="size_age_group" class="d-none font-500">Size/Age Group <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" id="size_age_group" class="form-control"
                                                       @if($product->institutional_product_info && $product->institutional_product_info->size_age) value="{{ $product->institutional_product_info->size_age }}"
                                                       @endif name="size_age_group"
                                                       placeholder="Size/Age Group (Mandatory) - e.g. i.e XS-S-M-L-XL, 5-10 Years, King Size, Queen Size, Other"
                                                       required>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="colour" class="d-none font-500">Color <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" id="colour" class="form-control"
                                                       @if($product->institutional_product_info && $product->institutional_product_info->color) value="{{ $product->institutional_product_info->color }}"
                                                       @endif name="colour"
                                                       placeholder="Color (Mandatory) - e.g. Blue, Black, Grey, Green, Red, Multi, Other"
                                                       required>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="gender" class="d-none font-500">Gender <small class="font-500">
                                                        (Optional)</small></label>

                                                <input type="text" id="gender" class="form-control"
                                                       @if($product->institutional_product_info && $product->institutional_product_info->gender) value="{{ $product->institutional_product_info->gender }}"
                                                       @endif name="gender"
                                                       placeholder="Gender (Optional) - e.g. Man, Women, Boy, Girl, Other">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="thickness" class="d-none font-500">Thickness/GSM/Width <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="thickness" class="form-control"
                                                       @if($product->institutional_product_info && $product->institutional_product_info->thickness) value="{{ $product->institutional_product_info->thickness }}"
                                                       @endif name="thickness"
                                                       placeholder="Thickness/GSM/Width (Optional) - e.g. 75 GSM, 150 GSM, 3 mm, 10 mm, 45 Inches, 70 Inches, Other">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="brand" class="d-none font-500">Brand <small class="font-500">
                                                        (Optional)</small></label>
                                                <input type="text" id="brand" class="form-control"
                                                       @if($product->institutional_product_info && $product->institutional_product_info->brand) value="{{ $product->institutional_product_info->brand }}"
                                                       @endif name="brand"
                                                       placeholder="Brand (Optional) - e.g. Levi's, Mustang, Blend, Servise, Other">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="design" class="d-none font-500">Design/Style <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="design" class="form-control"
                                                       @if($product->institutional_product_info && $product->institutional_product_info->design) value="{{ $product->institutional_product_info->design }}"
                                                       @endif name="design"
                                                       placeholder="Design/Style (Optional) - e.g. Front Open, Front Zipper, 5 Pocket Trouser, 3 Ply, Other">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="season" class="d-none font-500">Season <small class="font-500">
                                                        (Optional)</small></label>
                                                <input type="text" id="season" class="form-control"
                                                       @if($product->institutional_product_info && $product->institutional_product_info->season) value="{{ $product->institutional_product_info->season }}"
                                                       @endif name="season"
                                                       placeholder="Season (Optional) - e.g. Summer, Winter, Festive, Other">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="use_end" class="d-none font-500">End Use/Application <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="use_end" class="form-control"
                                                       @if($product->institutional_product_info && $product->institutional_product_info->end_use) value="{{ $product->institutional_product_info->end_use }}"
                                                       @endif name="use_end"
                                                       placeholder="End Use/Application (Optional) - e.g. Safety, Protection, Flame Retardent, Water Proof, Other">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info garments-info" style="display: none;">
                                        <span class="d-block mb-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="material_type" class="d-none font-500">Material Type <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" id="material_type" class="form-control"
                                                       @if($product->garments_product_info && $product->garments_product_info->material) value="{{ $product->garments_product_info->material }}"
                                                       @endif name="material_type"
                                                       placeholder="Material Type (Mandatory) - e.g. Cotton, Polyester, Sheep Leather, Metal, Other"
                                                       required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="construction" class="d-none font-500">Composition/Construction
                                                    <span class="required"> (Mandatory)</span></label>
                                                <input type="text" id="construction" class="form-control"
                                                       @if($product->garments_product_info && $product->garments_product_info->composition) value="{{ $product->garments_product_info->composition }}"
                                                       @endif name="construction"
                                                       placeholder="Composition/Construction (Mandatory) - e.g. 60% Cotton, 40% Polyester, 80*80/100*80, Bronze, Other"
                                                       required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="size_age" class="d-none font-500">Size/Age Group <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" id="size_age" class="form-control"
                                                       @if($product->garments_product_info && $product->garments_product_info->size_age) value="{{ $product->garments_product_info->size_age }}"
                                                       @endif name="size_age"
                                                       placeholder="Size/Age Group (Mandatory) - e.g. XS-S-M-L-XL, 1-2 Years, 5-10 Years, Other"
                                                       required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="color" class="d-none font-500">Color <span
                                                        class="required"> (Mandatory)</span></label>
                                                <input type="text" id="color" class="form-control"
                                                       @if($product->garments_product_info && $product->garments_product_info->color) value="{{ $product->garments_product_info->color }}"
                                                       @endif name="color"
                                                       placeholder="Color (Mandatory) - e.g. Blue, Black, Grey, Green, Red, Multi, Other"
                                                       required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="garments_gender" class="d-none font-500">Gender <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="garments_gender" class="form-control"
                                                       @if($product->garments_product_info && $product->garments_product_info->gender) value="{{ $product->garments_product_info->gender }}"
                                                       @endif name="garments_gender"
                                                       placeholder="Gender (Optional) - e.g. Man, Women, Boy, Girl, Other">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="thick_gsm_width" class="d-none font-500">Thickness/GSM/Width <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="thick_gsm_width" class="form-control"
                                                       @if($product->garments_product_info && $product->garments_product_info->thickness) value="{{ $product->garments_product_info->thickness }}"
                                                       @endif name="thickness_gsm_width"
                                                       placeholder="e.g. 75 GSM, 150 GSM, 3 mm, 10 mm, 45 Inches, 70 Inches, Other">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="garments_brand" class="d-none font-500">Brand <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="garments_brand" class="form-control"
                                                       @if($product->garments_product_info && $product->garments_product_info->brand) value="{{ $product->garments_product_info->brand }}"
                                                       @endif name="garments_brand"
                                                       placeholder="e.g. Levi's, Mustang, Blend, Servise, Other">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="design_style" class="d-none font-500">Design/Style <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="design_style" class="form-control"
                                                       @if($product->garments_product_info && $product->garments_product_info->design) value="{{ $product->garments_product_info->design }}"
                                                       @endif
                                                       name="design_style"
                                                       placeholder="e.g. Round Neck, Sleeveless, Fit, Baggy, Other">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="garments_season" class="d-none font-500">Season <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="garments_season" class="form-control"
                                                       @if($product->garments_product_info && $product->garments_product_info->season) value="{{ $product->garments_product_info->season }}"
                                                       @endif name="garments_season"
                                                       placeholder="e.g. Summer, Winter, Festive, Other">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="end_use_app" class="d-none font-500">End Use/Application <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="end_use_app" class="form-control"
                                                       @if($product->garments_product_info && $product->garments_product_info->end_use) value="{{ $product->garments_product_info->end_use }}"
                                                       @endif
                                                       name="end_use_app"
                                                       placeholder="e.g. Casual, Formal, Sports, Industrial, Other">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="additional-product-info chemical-info">
                                        <span class="d-block mb-1 heading">Additional Product Info</span>
                                        <div class="chemical-info-inner">
                                            @if(count($product->chemicals_product_infos) > 0)
                                                <input type="hidden" id="company_counter" name="company_counter"
                                                       value="{{ count($product->chemicals_product_infos) }}">
                                                @php $i = 0; @endphp
                                                @foreach($product->chemicals_product_infos as $chemical)
                                                    @php $i++; @endphp
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <h5 class="chemical-info-heading">Product Info {{ $i }}</h5>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label class="font-500">Manufacturer Company Name <span
                                                                    class="required">*</span></label>
                                                            <input type="text" id="manufacturer_company_name{{ $i }}"
                                                                   name="manufacturer_company_name{{ $i }}"
                                                                   class="form-control"
                                                                   placeholder="Company Name"
                                                                   value="{{ $chemical->manufacturer_company_name }}"
                                                                   required>
                                                            <small class="text-danger"
                                                                   id="manufacturer_company_name{{ $i }}_error"></small>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label class="font-500">Origin <span
                                                                    class="required">*</span></label>
                                                            <select class="form-control" id="origin{{ $i }}"
                                                                    name="origin{{ $i }}">
                                                                <option value="" selected disabled> ---- Select Origin
                                                                    ---
                                                                </option>
                                                                @foreach(\App\Country::all() as $country)
                                                                    <option value="{{ $country->country_name }}"
                                                                            @if($chemical->origin == $country->country_name) selected @endif >{{ $country->country_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <small class="text-danger"
                                                                   id="origin{{ $i }}_error"></small>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <label class="font-500">Chemicals listed <span
                                                                    class="required">*</span></label>
                                                            <input type="text" id="chemicals_listed{{ $i }}"
                                                                   name="chemicals_listed{{ $i }}"
                                                                   class="form-control" placeholder="Chemicals Listed"
                                                                   required value="{{ $chemical->chemicals_listed }}">
                                                            <small class="text-danger"
                                                                   id="chemicals_listed{{ $i }}_error"></small>
                                                        </div>
                                                        <div class="form-group col-lg-6 additonial-info">
                                                            <label class="font-500">Additional Information <small
                                                                    class="font-500"> (Optional)</small></label>
                                                            <input type="text" id="company_additional_info{{ $i }}"
                                                                   name="company_additional_info{{ $i }}"
                                                                   class="form-control"
                                                                   placeholder="Additional Info"
                                                                   value="{{ $chemical->company_additional_info }}">
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label class="font-500">Supply type <span
                                                                    class="required">*</span></label>
                                                            <div class="">
                                                                <div
                                                                    class="custom-control custom-radio manufacturer-supply-type custom-control-inline">
                                                                    <input type="radio" class="custom-control-input"
                                                                           id="inStock{{ $i }}" value="In Stock"
                                                                           name="supply_type{{ $i }}"
                                                                           @if($chemical->supply_type == "In Stock") checked="true"
                                                                           @endif required>
                                                                    <label class="custom-control-label"
                                                                           for="inStock{{ $i }}">In
                                                                        Stock</label>
                                                                </div>
                                                                <div
                                                                    class="custom-control custom-radio manufacturer-supply-type custom-control-inline">
                                                                    <input type="radio" class="custom-control-input"
                                                                           id="makeOrder{{ $i }}" value="Made to Order"
                                                                           name="supply_type{{ $i }}"
                                                                           @if($chemical->supply_type == "Made to Order") checked="true"
                                                                           @endif required>
                                                                    <label class="custom-control-label"
                                                                           for="makeOrder{{ $i }}">Made to Order</label>
                                                                </div>
                                                                <div
                                                                    class="custom-control custom-radio manufacturer-supply-type custom-control-inline">
                                                                    <input type="radio" class="custom-control-input"
                                                                           id="both{{ $i }}"
                                                                           value="Both" name="supply_type{{ $i }}"
                                                                           @if($chemical->supply_type == "Both") checked="true"
                                                                           @endif required>
                                                                    <label class="custom-control-label"
                                                                           for="both{{ $i }}">Both</label>
                                                                </div>
                                                            </div>
                                                            <small class="text-danger"
                                                                   id="supply_type{{ $i }}_error"></small>
                                                        </div>
                                                        <div class="mt-4 mb-4">
                                                            <hr class="horizontal-line">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <input type="hidden" id="company_counter" name="company_counter"
                                                       value="1">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <h5 class="chemical-info-heading">Product Info 1</h5>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="d-none font-500">Manufacturer Company Name <span
                                                                class="required">*</span></label>
                                                        <input type="text" id="manufacturer_company_name1"
                                                               name="manufacturer_company_name1" class="form-control"
                                                               placeholder="Manufacturer Company Name (Mandatory) - Company Name" required>
                                                        <small class="text-danger"
                                                               id="manufacturer_company_name1_error"></small>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="d-none font-500">Origin <span
                                                                class="required">*</span></label>
                                                        <select class="form-control" id="origin1" name="origin1">
                                                            <option value=""></option>
                                                            <option disabled>Product Origin (Mandatory)</option>
                                                            @foreach(\App\Country::all() as $country)
                                                                <option
                                                                    @if($user->my_office->creator->country_id == $country->id) selected
                                                                    @endif value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <small class="text-danger" id="origin1_error"></small>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="d-none font-500">Chemicals listed <span
                                                                class="required">*</span></label>
                                                        <input type="text" id="chemicals_listed1"
                                                               name="chemicals_listed1"
                                                               class="form-control" placeholder="Chemicals Listed (Mandatory)"
                                                               required>
                                                        <small class="text-danger" id="chemicals_listed1_error"></small>
                                                    </div>
                                                    <div class="form-group col-lg-6 additonial-info">
                                                        <label class="d-none font-500">Additional Information <small
                                                                class="font-500"> (Optional)</small></label>
                                                        <input type="text" id="company_additional_info1"
                                                               name="company_additional_info1" class="form-control"
                                                               placeholder="Additional Info (Optional)">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label class="font-500">Supply type <span
                                                                class="required">*</span></label>
                                                        <div class="d-flex">
                                                            <div
                                                                class="w-unset custom-control custom-radio manufacturer-supply-type custom-control-inline">
                                                                <input type="radio" class="custom-control-input"
                                                                       id="inStock1" value="In Stock"
                                                                       name="supply_type1"
                                                                       required>
                                                                <label class="custom-control-label" for="inStock1">In
                                                                    Stock</label>
                                                            </div>
                                                            <div
                                                                class="w-unset custom-control custom-radio manufacturer-supply-type custom-control-inline">
                                                                <input type="radio" class="custom-control-input"
                                                                       id="makeOrder1" value="Made to Order"
                                                                       name="supply_type1" required>
                                                                <label class="custom-control-label" for="makeOrder1">Made
                                                                    to
                                                                    Order</label>
                                                            </div>
                                                            <div
                                                                class="w-unset custom-control custom-radio manufacturer-supply-type custom-control-inline">
                                                                <input type="radio" class="custom-control-input"
                                                                       id="both1"
                                                                       value="Both" name="supply_type1" required>
                                                                <label class="custom-control-label"
                                                                       for="both1">Both</label>
                                                            </div>
                                                        </div>
                                                        <small class="text-danger" id="supply_type1_error"></small>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <button  class="red-btn add-btn">Add +</button>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <label for="editor1" class="font-500">Additional Info <small class="font-500">
                                                        (Optional)</small></label>
                                                <span class="d-block font-500">(Limit = 1200 Characters)</span>
                                            </div>
                                            <textarea id="editor1" rows="5" maxlength = "1200" class="form-control" name="details"
                                                      placeholder="Add product details">{!! $product->details !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="mt-3" align="right">
                                        <a class="text-white red-btn next-btn" id="nextBtn1">NEXT</a>
                                    </div>
                                    <div class="mt-4 mb-4">
                                        <hr class="horizontal-line">
                                    </div>
                                </div>
                                <div class="py-2 tab-pane fade trade-info-tab" id="tabCom" role="tabpanel"
                                     aria-labelledby="tabCom">
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 trade-info-container">
                                            <label for="focused_selling_region" class="d-none font-500">Target Selling
                                                Region
                                                <small class="font-500"> (Optional)</small></label>
                                            <input type="text" id="focused_selling_region" class="form-control"
                                                   @if($product->focused_selling_region) value="{{ $product->focused_selling_region }}"
                                                   @endif name="focused_selling_region"
                                                   placeholder="Target Selling Region (Optional) - City, Province, State...">
                                        </div>
                                        <div class="form-group col-lg-6 trade-info-container">
                                            <label for="production_capacity" class="d-none font-500">Production Capacity
                                                <small
                                                    class="font-500"> (Optional)</small></label>
                                            <input
                                                @if($product->production_capacity) value="{{ $product->production_capacity }}"
                                                @endif type="text" id="production_capacity" class="form-control"
                                                name="production_capacity"
                                                placeholder="Production Capacity (Optional) - Mention Production Capacity Per Day, Per Month">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 trade-info-container">
                                            <label for="min_order_quantity" class="d-none font-500">Min Order Quantity
                                                (MOQ)
                                                <small class="font-500"> (Optional)</small></label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" id="min_order_quantity" class="form-control"
                                                           @if($product->min_order_quantity) value="{{ $product->min_order_quantity }}"
                                                           @endif name="min_order_quantity"
                                                           placeholder="Min Order Quantity (MOQ) (Optional)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 trade-info-container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="font-500 d-block">Sampling <small
                                                            class="font-500"> (Optional)</small></label>
                                                    <div
                                                        class=" custom-control custom-radio custom-control-inline form-check-inline">
                                                        <input type="radio" class="custom-control-input" value="1"
                                                               id="proYes" name="is_sampling"
                                                               @if($product->is_sampling) checked="true" @endif>
                                                        <label class="custom-control-label" for="proYes">Yes</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-radio ml-3 custom-control-inline form-check-inline">
                                                        <input type="radio" class="custom-control-input" value="0"
                                                               id="proNo" name="is_sampling"
                                                               @if(!$product->is_sampling) checked="true" @endif>
                                                        <label class="custom-control-label" for="proNo">No</label>
                                                    </div>
                                                    <div class="paid-or-free"
                                                         @if($product->is_sampling) style="display: block;" @endif>
                                                        <div
                                                            class="custom-control custom-radio custom-control-inline form-check-inline">
                                                            <input type="radio" class="custom-control-input"
                                                                   value="Paid"
                                                                   @if($product->sampling_type == "Paid") checked="true"
                                                                   @endif
                                                                   id="proPaid" name="sampling_type">
                                                            <label class="custom-control-label"
                                                                   for="proPaid">Paid</label>
                                                        </div>
                                                        <div
                                                            class="custom-control custom-radio ml-3 custom-control-inline form-check-inline">
                                                            <input type="radio" class="custom-control-input"
                                                                   value="Free"
                                                                   @if($product->sampling_type == "Free") checked="true"
                                                                   @endif
                                                                   id="proFree" name="sampling_type">
                                                            <label class="custom-control-label"
                                                                   for="proFree">Free</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-row  @if($product->sampling_type == "Paid") d-block @else d-none  @endif trade-info-container position-relative"
                                                        id="paidField">
                                                        <div class="mt-1 col-12">
                                                            <label class="d-none font-500 pt-3">Add Price <small
                                                                    class="font-500"> (Optional)</small></label>
                                                            <input type="text" id="paidSample" placeholder="Add Price (Optional)"
                                                                   name="paid_sampling_price" class="form-control"
                                                                   @if($product->sampling_type == "Paid")
                                                                   @endif
                                                                   value="{{ $product->paid_sampling_price }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 trade-info-container">
                                            <label for="dealing_as" class="d-none label">Dealing Product As <span
                                                    class="required">*</span></label>
                                            <select id="dealing_as" name="dealing_as[]"
                                                    class="select2-multiple select-suitable-type form-control" multiple="multiple" required>
                                                <option value=""></option>
                                                <option disabled>Dealing Product As (Mandatory)</option>
                                                <option value="Manufacturer"
                                                        @if(in_array("Manufacturer", explode(",", $product->dealing_as))) selected @endif >
                                                    Manufacturer
                                                </option>
                                                <option value="Sole Agent"
                                                        @if(in_array("Sole Agent", explode(",", $product->dealing_as))) selected @endif >
                                                    Sole Agent
                                                </option>
                                                <option value="Stockist"
                                                        @if(in_array("Stockist", explode(",", $product->dealing_as))) selected @endif >
                                                    Stockiest
                                                </option>
                                                <option value="Supplier"
                                                        @if(in_array("Supplier", explode(",", $product->dealing_as))) selected @endif >
                                                    Supplier
                                                </option>
                                                <option value="Marketing Manager"
                                                        @if(in_array("Marketing Manager", explode(",", $product->dealing_as))) selected @endif >
                                                    Marketing Manager
                                                </option>
                                                <option value="Other" class="other-check"
                                                        @if(in_array("Other", explode(",", $product->dealing_as))) selected @endif >
                                                    Other
                                                </option>
                                            </select>
                                            <small class="text-danger" id="dealing_as_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 other-div">
                                            <label class="d-none font-500">Add Other Details</label>
                                            <input type="text" id="other_dealing_as"
                                                   @if($product->other_dealing_as) maxlength = "50" value="{{ $product->other_dealing_as }}"
                                                   @endif name="other_dealing_as" class="form-control" placeholder="Add Other Details (Mandatory)">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 trade-info-container">
                                            <label class="d-none font-500">Target Selling Country <span
                                                    class="required">*</span></label>
                                            <select name="focused_selling_countries[]"
                                                    class="select2-multiple select-target-country form-control required-control"
                                                    multiple="multiple" id="focused_selling_countries" required>
                                                <option value=""></option>
                                                <option disabled>Target Selling Country (Mandatory)</option>
                                                @foreach(\DB::table('countriyes')->get() as $country)
                                                    <option value="{{ $country->country_name }}"
                                                            @if(in_array($country->country_name, explode(",", $product->focused_selling_countries))) selected @endif >{{ $country->country_name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="focused_selling_countries_error"></small>
                                        </div>
                                    </div>
                                    <div class="mt-3" align="right">
                                        <a class="text-white red-btn next-btn" id="nextBtn2">NEXT</a>
                                    </div>
                                    <div class="mt-4 mb-4">
                                        <hr class="horizontal-line">
                                    </div>
                                </div>
                                <div class="py-2 tab-pane fade payment-info-tab" id="tabInfo" role="tabpanel"
                                     aria-labelledby="tabInfo">
                                    <div class="form-row">
                                        <div class="mb-0 form-group col-lg-6 unit_price_range"
                                             @if(in_array("Sell", explode(",", $product->product_service_types)) || in_array("Service", explode(",", $product->product_service_types))) style="display: block;" @endif>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="unit_price_from" class="font-500 unit_price_range_label"
                                                           @if(in_array("Sell", explode(",", $product->product_service_types))) style="display: block;"
                                                           @else style="display: none;" @endif>Unit Price Range<span
                                                            class="required">*</span></label>
                                                    <label for="unit_price_from"
                                                           class="font-500 service_charges_range_label"
                                                           @if(in_array("Service", explode(",", $product->product_service_types))) style="display: block;"
                                                           @else style="display: none;" @endif>Service Charges
                                                        <span class="required">(Mandatory)</span></label>
                                                    <input type="number" id="unit_price_from" class="form-control"
                                                           name="unit_price_from"
                                                           @if($product->unit_price_from) value="{{ $product->unit_price_from }}"
                                                           @endif placeholder="Service Charges (Mandatory) - e.g. 1000-2000" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="unit_price_to" class="font-500 unit_price_range_label"></label>
                                                    @if(in_array("Service", explode(",", $product->product_service_types)))
                                                        <label for="unit_price_to" class="d-none font-500">Charges Range <span class="required">(Mandatory)</span></label>
                                                    @endif
                                                    <input type="number" id="unit_price_to" class="form-control"
                                                           name="unit_price_to"
                                                           @if($product->unit_price_to) value="{{ $product->unit_price_to }}"
                                                           @endif placeholder="Charges Range (Mandatory) - e.g. 200" required>
                                                </div>
                                                @if(in_array("Sell", explode(",", $product->product_service_types)))
                                                    <div class="form-group col-md-4">
                                                        <label for="unit_price_unit" class="d-none font-500 unit_price_range_label">Per Unit <span
                                                                class="required">*</span></label>
                                                        <select class="form-control other-option-included" id="unit_price_unit" name="unit_price_unit" required>
                                                            <option value=""></option>
                                                            <option disabled>Per Unit (Mandatory)</option>
                                                            <option value="20' Container"
                                                                    @if($product->unit_price_unit == "20' Container") selected @endif>
                                                                20' Container
                                                            </option>
                                                            <option value="40' Container"
                                                                    @if($product->unit_price_unit == "40' Container") selected @endif>
                                                                40' Container
                                                            </option>
                                                            <option value="Bale"
                                                                    @if($product->unit_price_unit == 'Bale') selected @endif>
                                                                Bale
                                                            </option>
                                                            <option value="Barel"
                                                                    @if($product->unit_price_unit == 'Barel') selected @endif>
                                                                Barel
                                                            </option>
                                                            <option value="Box"
                                                                    @if($product->unit_price_unit == 'Box') selected @endif>
                                                                Box
                                                            </option>
                                                            <option value="Bag"
                                                                    @if($product->unit_price_unit == 'Bag') selected @endif>
                                                                Bag
                                                            </option>
                                                            <option value="Carton"
                                                                    @if($product->unit_price_unit == 'Carton') selected @endif>
                                                                Carton
                                                            </option>
                                                            <option value="Cone"
                                                                    @if($product->unit_price_unit == 'Cone') selected @endif>
                                                                Cone
                                                            </option>
                                                            <option value="Dozen"
                                                                    @if($product->unit_price_unit == 'Dozen') selected @endif>
                                                                Dozen
                                                            </option>
                                                            <option value="Gallon"
                                                                    @if($product->unit_price_unit == 'Gallon') selected @endif>
                                                                Gallon
                                                            </option>
                                                            <option value="Gram"
                                                                    @if($product->unit_price_unit == 'Gram') selected @endif>
                                                                Gram
                                                            </option>
                                                            <option value="Gross"
                                                                    @if($product->unit_price_unit == 'Gross') selected @endif>
                                                                Gross
                                                            </option>
                                                            <option value="Kg"
                                                                    @if($product->unit_price_unit == 'Kg') selected @endif>
                                                                Kg
                                                            </option>
                                                            <option value="Lb"
                                                                    @if($product->unit_price_unit == 'Lb') selected @endif>
                                                                Lb
                                                            </option>
                                                            <option value="Liter"
                                                                    @if($product->unit_price_unit == 'Liter') selected @endif>
                                                                Liter
                                                            </option>
                                                            <option value="Meter"
                                                                    @if($product->unit_price_unit == 'Meter') selected @endif>
                                                                Meter
                                                            </option>
                                                            <option value="MT"
                                                                    @if($product->unit_price_unit == 'MT') selected @endif>
                                                                MT
                                                            </option>
                                                            <option value="Pack"
                                                                    @if($product->unit_price_unit == 'Pack') selected @endif>
                                                                Pack
                                                            </option>
                                                            <option value="Pair"
                                                                    @if($product->unit_price_unit == 'Pair') selected @endif>
                                                                Pair
                                                            </option>
                                                            <option value="Pallet"
                                                                    @if($product->unit_price_unit == 'Pallet') selected @endif>
                                                                Pallet
                                                            </option>
                                                            <option value="Piece"
                                                                    @if($product->unit_price_unit == 'Piece') selected @endif>
                                                                Piece
                                                            </option>
                                                            <option value="Pound"
                                                                    @if($product->unit_price_unit == 'Pound') selected @endif>
                                                                Pound
                                                            </option>
                                                            <option value="Roll"
                                                                    @if($product->unit_price_unit == 'Roll') selected @endif>
                                                                Roll
                                                            </option>
                                                            <option value="Set"
                                                                    @if($product->unit_price_unit == 'Set') selected @endif>
                                                                Set
                                                            </option>
                                                            <option value="Sheet"
                                                                    @if($product->unit_price_unit == 'Sheet') selected @endif>
                                                                Sheet
                                                            </option>
                                                            <option value="Spool"
                                                                    @if($product->unit_price_unit == 'Spool') selected @endif>
                                                                Spool
                                                            </option>
                                                            <option value="Square Feet"
                                                                    @if($product->unit_price_unit == 'Square Feet') selected @endif>
                                                                Square Feet
                                                            </option>
                                                            <option value="Square Meter"
                                                                    @if($product->unit_price_unit == 'Square Meter') selected @endif>
                                                                Square Meter
                                                            </option>
                                                            <option value="Ton"
                                                                    @if($product->unit_price_unit == 'Ton') selected @endif>
                                                                Ton
                                                            </option>
                                                            <option value="Yard"
                                                                    @if($product->unit_price_unit == 'Yard') selected @endif>
                                                                Yard
                                                            </option>
                                                            <option value="Other"
                                                                    @if($product->unit_price_unit == 'Other') selected
                                                                    @endif class="other-check">Other
                                                            </option>

                                                        </select>
                                                    </div>
                                                @endif
                                                @if(in_array("Service", explode(",", $product->product_service_types)))
                                                    <div class="form-group col-md-4 service-unit">
                                                        <label class="font-500">Per Unit <span class="required">(Mandatory)</span></label>
                                                        <input type="text" name="other_unit_price_unitt" value="@if($product->other_unit_price_unit){{$product->other_unit_price_unit}}@endif" class="form-control" required>
                                                        <small class="text-danger" id="other_unit_price_unit_error"></small>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        @if(!in_array("Service", explode(",", $product->product_service_types)))
                                            <div class="form-group col-lg-6 other-div add-unit_price_unit"
                                                 @if($product->unit_price_unit == 'Other') style="display: block;"
                                                @endif>
                                                <label class="font-500">Other Price Unit <span class="required">(Mandatory)</span></label>
                                                <input type="text" name="other_unit_price_unit" value="{{ $product->other_unit_price_unit }}" class="form-control" required>
                                            </div>
                                        @endif
                                        <div class="form-group col-lg-6 target_price_range"
                                             @if(in_array("Buy", explode(",", $product->product_service_types))) style="display: block;" @endif>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="target_price_from" class="d-none font-500">Target Price Range<span
                                                            class="required">*</span></label>
                                                    <input type="number" id="target_price_from"
                                                           @if($product->target_price_from) value="{{ $product->target_price_from }}"
                                                           @endif class="form-control"
                                                           name="target_price_from" placeholder="Target Price From (Mandatory) - e.g. 1000" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="target_price_to" class="d-none font-500"></label>
                                                    <input type="number" id="target_price_to" class="form-control"
                                                           name="target_price_to"
                                                           @if($product->target_price_to) value="{{ $product->target_price_to }}"
                                                           @endif placeholder="Target Price To (Mandatory) - e.g. 200" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="target_price_unit" class="d-none font-500">Per Unit <span
                                                            class="required">*</span></label>
                                                    <select class="form-control other-option-included"
                                                            id="target_price_unit"
                                                            name="target_price_unit" required>
                                                        <option value=""></option>
                                                        <option disabled>Per Unit (Mandatory)</option>
                                                        <option value="20' Container"
                                                                @if($product->target_price_unit == "20' Container") selected @endif>
                                                            20' Container
                                                        </option>
                                                        <option value="40' Container"
                                                                @if($product->target_price_unit == "40' Container") selected @endif>
                                                            40' Container
                                                        </option>
                                                        <option value="Bale"
                                                                @if($product->target_price_unit == 'Bale') selected @endif>
                                                            Bale
                                                        </option>
                                                        <option value="Barel"
                                                                @if($product->target_price_unit == 'Barel') selected @endif>
                                                            Barel
                                                        </option>
                                                        <option value="Box"
                                                                @if($product->target_price_unit == 'Box') selected @endif>
                                                            Box
                                                        </option>
                                                        <option value="Bag"
                                                                @if($product->target_price_unit == 'Bag') selected @endif>
                                                            Bag
                                                        </option>
                                                        <option value="Carton"
                                                                @if($product->target_price_unit == 'Carton') selected @endif>
                                                            Carton
                                                        </option>
                                                        <option value="Cone"
                                                                @if($product->target_price_unit == 'Cone') selected @endif>
                                                            Cone
                                                        </option>
                                                        <option value="Dozen"
                                                                @if($product->target_price_unit == 'Dozen') selected @endif>
                                                            Dozen
                                                        </option>
                                                        <option value="Gallon"
                                                                @if($product->target_price_unit == 'Gallon') selected @endif>
                                                            Gallon
                                                        </option>
                                                        <option value="Gram"
                                                                @if($product->target_price_unit == 'Gram') selected @endif>
                                                            Gram
                                                        </option>
                                                        <option value="Gross"
                                                                @if($product->target_price_unit == 'Gross') selected @endif>
                                                            Gross
                                                        </option>
                                                        <option value="Kg"
                                                                @if($product->target_price_unit == 'Kg') selected @endif>
                                                            Kg
                                                        </option>
                                                        <option value="Lb"
                                                                @if($product->target_price_unit == 'Lb') selected @endif>
                                                            Lb
                                                        </option>
                                                        <option value="Liter"
                                                                @if($product->target_price_unit == 'Liter') selected @endif>
                                                            Liter
                                                        </option>
                                                        <option value="Meter"
                                                                @if($product->target_price_unit == 'Meter') selected @endif>
                                                            Meter
                                                        </option>
                                                        <option value="MT"
                                                                @if($product->target_price_unit == 'MT') selected @endif>
                                                            MT
                                                        </option>
                                                        <option value="Pack"
                                                                @if($product->target_price_unit == 'Pack') selected @endif>
                                                            Pack
                                                        </option>
                                                        <option value="Pair"
                                                                @if($product->target_price_unit == 'Pair') selected @endif>
                                                            Pair
                                                        </option>
                                                        <option value="Pallet"
                                                                @if($product->target_price_unit == 'Pallet') selected @endif>
                                                            Pallet
                                                        </option>
                                                        <option value="Pieces"
                                                                @if($product->target_price_unit == 'Pieces') selected @endif>
                                                            Pieces
                                                        </option>
                                                        <option value="Pound"
                                                                @if($product->target_price_unit == 'Pound') selected @endif>
                                                            Pound
                                                        </option>
                                                        <option value="Roll"
                                                                @if($product->target_price_unit == 'Roll') selected @endif>
                                                            Roll
                                                        </option>
                                                        <option value="Set"
                                                                @if($product->target_price_unit == 'Set') selected @endif>
                                                            Set
                                                        </option>
                                                        <option value="Sheet"
                                                                @if($product->target_price_unit == 'Sheet') selected @endif>
                                                            Sheet
                                                        </option>
                                                        <option value="Spool"
                                                                @if($product->target_price_unit == 'Spool') selected @endif>
                                                            Spool
                                                        </option>
                                                        <option value="Square Feet"
                                                                @if($product->target_price_unit == 'Square Feet') selected @endif>
                                                            Square Feet
                                                        </option>
                                                        <option value="Square Meter"
                                                                @if($product->target_price_unit == 'Square Meter') selected @endif>
                                                            Square Meter
                                                        </option>
                                                        <option value="Ton"
                                                                @if($product->target_price_unit == 'Ton') selected @endif>
                                                            Ton
                                                        </option>
                                                        <option value="Yard"
                                                                @if($product->target_price_unit == 'Yard') selected @endif>
                                                            Yard
                                                        </option>
                                                        <option value="Other"
                                                                @if($product->target_price_unit == 'Other') selected
                                                                @endif class="other-check">Other
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 other-div add-target_price_unit"
                                             @if($product->target_price_unit == 'Other') style="display: block;"
                                            @endif>
                                            <label class="d-none font-500">Other Price Unit <span
                                                    class="required">*</span></label>
                                            <input type="text" name="other_target_price_unit"
                                                   value="{{ $product->other_target_price_unit }}"
                                                   class="form-control" placeholder="Other Price Unit (Mandatory)" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label class="d-none font-500">Suitable Currency <span
                                                    class="required">*</span></label>
                                            <select class="form-control single-select-dropdown"
                                                    id="suitable_currencies" name="suitable_currencies" required>
                                                <option value=""></option>
                                                <option disabled>Suitable Currency (Mandatory)</option>
                                                <option value="PKR" @if($product->suitable_currencies == "PKR") selected @endif>
                                                    PKR
                                                </option>
                                                <option value="USD" @if($product->suitable_currencies == "USD") selected @endif>
                                                    USD
                                                </option>
                                                <option value="Euro" @if($product->suitable_currencies == "Euro") selected @endif>
                                                    Euro
                                                </option>
                                                <option value="Yuan" @if($product->suitable_currencies == "Yuan") selected @endif>
                                                    Yuan
                                                </option>
                                                <option value="Swiss Franc" @if($product->suitable_currencies == "Swiss Franc") selected @endif>
                                                    Swiss Franc
                                                </option>
                                                <option value="JPY" @if($product->suitable_currencies == "JPY") selected @endif>
                                                    JPY
                                                </option>
                                                <option value="Other" class="other-check" @if($product->suitable_currencies == "Other") selected @endif>
                                                    Other
                                                </option>
                                            </select>
                                            <small class="text-danger" id="suitable_currencies_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 other-div add-suitable-currency"
                                             @if($product->suitable_currencies == "Other") style="display: block;" @endif>
                                            <label class="d-none font-500">Add Your Suitable Currency <span
                                                    class="required"> (Mandatory)</span></label>
                                            <input type="text"
                                                   @if($product->other_suitable_currency) value="{{ $product->other_suitable_currency }}"
                                                   required
                                                   @endif name="other_suitable_currency" class="form-control" placeholder="Add Your Suitable Currency (Mandatory)">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 product_lead_time">
                                            <label for="delivery_time" class="d-none font-500">Lead Time <small
                                                    class="font-500"> (Optional)</small></label>
                                            <input type="text" id="lead_time" class="form-control"
                                                   name="delivery_time"
                                                   @if($product->delivery_time) value="{{ $product->delivery_time }}"
                                                   @endif
                                                   placeholder="Lead Time (Optional) - Mention Suitable Lead Time">
                                        </div>
                                        <div class="form-group col-lg-6 product_delivery">
                                            <label class="font-500">Delivery</label>
                                            <div class="d-flex">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input"
                                                           value="Included"
                                                           @if($product->delivery == 'Included') checked
                                                           @endif id="delivery_included" name="delivery">
                                                    <label class="custom-control-label"
                                                           for="delivery_included">Included</label>
                                                </div>
                                                <div class="custom-control custom-radio ml-3">
                                                    <input type="radio" class="custom-control-input"
                                                           value="Not Included"
                                                           @if($product->delivery == 'Not Included') checked
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
                                                    class="select2-multiple form-control" multiple="multiple">
                                                <option value=""></option>
                                                <option disabled>Service Duration (Mandatory)</option>
                                                <option value="One Time" @if(in_array("One Time", explode(",", $product->service_durations))) selected @endif >One Time</option>
                                                <option value="On Call" @if(in_array("On Call", explode(",", $product->service_durations))) selected @endif >On Call</option>
                                                <option value="Regular" @if(in_array("Regular", explode(",", $product->service_durations))) selected @endif >Regular</option>
                                                <option value="Daily" @if(in_array("Daily", explode(",", $product->service_durations))) selected @endif >Daily</option>
                                                <option value="Weekly" @if(in_array("Weekly", explode(",", $product->service_durations))) selected @endif >Weekly</option>
                                                <option value="After 15 Days" @if(in_array("After 15 Days", explode(",", $product->service_durations))) selected @endif >After 15 Days</option>
                                                <option value="Monthly" @if(in_array("Monthly", explode(",", $product->service_durations))) selected @endif >Monthly</option>
                                                <option value="Annually" @if(in_array("Annually", explode(",", $product->service_durations))) selected @endif >Annually</option>
                                                <option value="Other" class="other-check" @if(in_array("Other", explode(",", $product->service_durations))) selected @endif >Other</option>
                                            </select>
                                            <small class="text-danger" id="service_durations_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 add-services-duration other-div"
                                             @if(in_array("Other", explode(",", $product->service_durations))) style="display: block;" @endif>
                                            <label class="d-none font-500">Add Your Service Duration <span class="required">(Mandatory)</span></label>
                                            <input id="other_service_duration" placeholder="Add Your Service Duration (Mandatory)" name="other_service_duration" type="text" @if($product->other_service_duration) value="{{ $product->other_service_duration }}" required @endif class="form-control">
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label for="payment_terms" class="d-none font-500">Payment
                                                Terms
                                                <span class="required"> (Mandatory)</span></label>
                                            <select class="single-select-dropdown select-suitable-payment other-option-included form-control payment-terms"
                                                    id="payment_terms" name="payment_terms" required>
                                                <option value=""></option>
                                                <option disabled>Select Payment Terms (Mandatory)</option>
                                                <option value="L/C" @if($product->payment_terms == "L/C") selected @endif>
                                                    L/C
                                                </option>
                                                <option value="D/A" @if($product->payment_terms == "D/A") selected @endif>
                                                    D/A
                                                </option>
                                                <option value="D/P" @if($product->payment_terms == "D/P") selected @endif>
                                                    D/P
                                                </option>
                                                <option value="T/T" @if($product->payment_terms == "T/T") selected @endif>
                                                    T/T
                                                </option>
                                                <option value="CFR" @if($product->payment_terms == "CFR") selected @endif>
                                                    CFR
                                                </option>
                                                <option value="CIF" @if($product->payment_terms == "CIF") selected @endif>
                                                    CIF
                                                </option>
                                                <option value="CIP" @if($product->payment_terms == "CIP") selected @endif>
                                                    CIP
                                                </option>
                                                <option value="CPT" @if($product->payment_terms == "CPT") selected @endif>
                                                    CPT
                                                </option>
                                                <option value="FOB" @if($product->payment_terms == "FOB") selected @endif>
                                                    FOB
                                                </option>
                                                <option value="Ex-Works" @if($product->payment_terms == "Ex-Works") selected @endif>
                                                    Ex-Works
                                                </option>
                                                <option value="Western Union" @if($product->payment_terms == "Western Union") selected @endif>
                                                    Western
                                                    Union
                                                </option>
                                                <option value="PayPal" @if($product->payment_terms == "PayPal") selected @endif>
                                                    PayPal
                                                </option>
                                                <option value="Other" @if($product->payment_terms == "Other") selected @endif class="other-check">Other
                                                </option>
                                            </select>
                                            <small class="text-danger" id="payment_terms_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 other-div add-payment-terms" @if($product->payment_terms == "Other") style="display: block;" @endif>
                                            <label class="d-none font-500">Add Your Payment Terms <span
                                                    class="required"> (Mandatory)</span></label>
                                            <input
                                                @if($product->other_payment_term) value="{{ $product->other_payment_term }}"
                                                required
                                                @endif type="text" id="other_payment_term" name="other_payment_term"
                                                class="form-control" placeholder="Add Your Payment Terms (Mandatory)">
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
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.1.24.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
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
            $( ".updt-btn" ).click(function() {
               $( "#updateProduct" ).trigger('submit');
             });

             $('.product-edit-btn').click(function () {
                $('#companyTab1').hide();
                $('#companyTab2').show();

            });
            if(window.location.href.includes('companyTab2'))
            {
                $('#companyTab1').hide();
                $('#companyTab2').show();
                $('.close-form').hide();
            }

            $( ".updt-btn" ).click(function() {
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
            $("#woven_weave_types").select2({
                placeholder: "Select Weave Type (Mandatory)"
            });

            $("#non_woven_types").select2({
                placeholder: "Select Woven Type (Mandatory)"
            });

            $("#non_woven_fabric_types").select2({
                placeholder: "Select Fabric Type (Mandatory)"
            });

            $("#knitted_fabric_types").select2({
                placeholder: "Select Fabric Type (Mandatory)"
            });

            $("#woven_fabric_types").select2({
                placeholder: "Select Fabric Type (Mandatory)"
            });

            $("select[name=knitted_knitting_types]").select2({
                placeholder: "Select Knitting Type (Mandatory)"
            });

            $("#yarn_technology").select2({
                placeholder: "Select Yarn Technology (Mandatory)"
            });

            $("#yarn_attribute").select2({
                placeholder: "Select Yarn Attribute (Mandatory)"
            });

            $("#yarn_count_unit").select2({
                placeholder: "Select Yarn Count Unit (Mandatory)"
            });

            /*$("#category").select2({
                placeholder: "Main Category (Mandatory)"
            });*/

            $("#sub_category").select2({
                placeholder: "Sub-Category (Mandatory)"
            });

            $("#sub_sub_category").select2({
                placeholder: "Product Type (Mandatory)"
            });

            $("#origin, #origin1").select2({
                placeholder: "Product Origin (Mandatory)"
            });

            $('select[name=suitable_currencies]').select2({
                placeholder: "Select Suitable Currency (Mandatory)"
            });

            $("#payment_terms").select2({
                placeholder: "Payment Terms (Mandatory)"
            });

            $("#target_price_unit").select2({
                placeholder: "Per Unit (Mandatory)"
            });

            $("#unit_price_unit").select2({
                placeholder: "Per Unit (Mandatory)"
            });
            /*for select single place holders*/

            /*for select multiple place holders*/
            $('#service_durations').select2({
                placeholder: "Service Duration (Mandatory)"
            });

            $('.select-suitable-type').select2({
                placeholder: "Select Dealing As (Mandatory)"
            });

            $('.select-target-country').select2({
                placeholder: "Select Target Country (Mandatory)"
            });

            $('.select-suitable-currency').select2({
                placeholder: "Select Suitable Currency"
            });
            /*for select multiple place holders*/

            var validator = $("form[name='updateProduct']").validate({
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
                    'product_service_types[]': {required: true, minlength: 1},
                    'category':{required: true,},
                    'sub_category':{required: true,},
                    'sub_sub_category':{required: true,},
                    'subject':{required: true,},
                    'product_service_name':{required: true,},

                    'size':{required: true,},
                    'yarn_count':{required: true,},
                    'yarn_count_unit':{required: true,},
                    'other_yarn_count_unit':{required: true,},
                    'yarn_attribute':{required: true,},
                    'yarn_technology':{required: true,},
                    'yarn_grade':{required: true,},

                    'knitted_fabric_types':{required: true,},
                    'other_knitted_fabric_type':{required: true,},
                    'knitted_knitting_types':{required: true,},
                    'other_knitted_knitting_type':{required: true,},
                    'knitted_fabric_construction':{required: true,},
                    'knitted_gsm_thickness':{required: true,},
                    'knitted_width_from':{required: true,},
                    'knitted_width_to':{required: true,},
                    'knitted_manufact':{required: true,},
                    'knitted_yarn':{required: true,},
                    'other_knitted_manufact':{required: true,},
                    'other_knitted_yarn_type':{required: true,},
                    'knitted_features[]':{required: true,},
                    'other_knitted_features':{required: true,},
                    'knitted_use[]':{required: true,},
                    'other_knitted_use':{required: true,},

                    'woven_fabric_types':{required: true,},
                    'other_woven_fabric_type':{required: true,},
                    'woven_weave_types':{required: true,},
                    'other_woven_weave_type':{required: true,},
                    'woven_fabric_construction':{required: true,},
                    'woven_gsm_thickness':{required: true,},
                    'woven_width_from':{required: true,},
                    'woven_width_to':{required: true,},
                    'woven_manufact':{required: true,},
                    'other_woven_manufact':{required: true,},
                    'woven_yarn':{required: true,},
                    'other_woven_yarn':{required: true,},
                    'woven_features[]':{required: true,},
                    'other_woven_features':{required: true,},
                    'woven_use[]':{required: true,},
                    'other_woven_use':{required: true,},

                    'non_woven_fabric_types':{required: true,},
                    'other_non_woven_fabric_type':{required: true,},
                    'non_woven_types':{required: true,},
                    'other_non_woven_type':{required: true,},
                    'non_woven_fabric_construction':{required: true,},
                    'non_woven_gsm_thickness':{required: true,},
                    'non_woven_width_from':{required: true,},
                    'non_woven_width_to':{required: true,},
                    'non_woven_manufact':{required: true,},
                    'other_non_woven_manufact':{required: true,},
                    'non_woven_yarn':{required: true,},
                    'other_non_woven_yarn':{required: true,},
                    'non_woven_features[]':{required: true,},
                    'other_non_woven_features':{required: true,},
                    'non_woven_use[]':{required: true,},
                    'other_non_woven_use':{required: true,},

                    'product_type':{required: true,},
                    'machinery_condition':{required: true,},
                    'after_sales_service':{required: true,},
                    'service_type':{required: true,},
                    'warranty':{required: true,},
                    'warranty_period':{required: true,},
                    'certification':{required: true,},
                    'certification_details':{required: true,},

                    'material':{required: true,},
                    'composition':{required: true,},
                    'size_age_group':{required: true,},
                    'colour':{required: true,},

                    'chemicals_listed1':{required: true,},
                    'supply_type1':{required: true,},

                    'material_type':{required: true,},
                    'construction':{required: true,},
                    'size_age':{required: true,},
                    'color':{required: true,},

                    'product_availability':{required: true,},
                    'dealing_as[]':{
                        required: true,
                    },
                    'focused_selling_countries[]':{
                        required: true,
                    },
                    'unit_price_from':{
                        required: true,
                    },
                    'unit_price_to':{
                        required: true,
                    },
                    'unit_price_unit':{
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
                    'product_availability': {
                        required: "Product availability is required"
                    },

                    'size': {required: "Fibre size/length is required"},

                    'yarn_count': {required: "Yarn count  is required"},
                    'yarn_count_unit': {required: "Yarn count unit  is required"},
                    'other_yarn_count_unit': {required: "Yarn count  is required"},
                    'yarn_attribute': {required: "Yarn attribute  is required"},
                    'yarn_technology': {required: "Yarn technology  is required"},
                    'yarn_grade': {required: "Yarn grade  is required"},

                    'knitted_fabric_types': {required: "Fabric type  is required"},
                    'other_knitted_fabric_type': {required: "Other fabric type  is required"},
                    'knitted_knitting_types': {required: "Knitting type  is required"},
                    'other_knitted_knitting_type': {required: "Other knitting type is required"},
                    'knitted_fabric_construction': {required: "Fabric construction  is required"},
                    'knitted_gsm_thickness': {required: "GSM/thickness  is required"},
                    'knitted_width_from': {required: "Width range from is required"},
                    'knitted_width_to': {required: "Width range to is required"},
                    'knitted_manufact': {required: "Manufacturing technique  is required"},
                    'other_knitted_manufact': {required: "Other manufacturing technique is required"},
                    'knitted_yarn': {required: "Yarn type  is required"},
                    'other_knitted_yarn_type': {required: "Other yarn type  is required"},
                    'knitted_features[]': {required: "Features  is required"},
                    'other_knitted_features': {required: "Other features  is required"},
                    'knitted_use[]': {required: "End use/application  is required"},
                    'other_knitted_use': {required: "Other use/application  is required"},

                    'woven_fabric_types': {required: "Fabric type  is required"},
                    'other_woven_fabric_type': {required: "Other fabric type  is required"},
                    'woven_weave_types': {required: "Weave type  is required"},
                    'other_woven_weave_type': {required: "Other weave type  is required"},
                    'woven_fabric_construction': {required: "Fabric construction  is required"},
                    'woven_gsm_thickness': {required: "GSM/thickness  is required"},
                    'woven_width_from': {required: "Width range from is required"},
                    'woven_width_to': {required: "Width range to is required"},
                    'woven_manufact': {required: "Manufacturing technique  is required"},
                    'other_woven_manufact': {required: "Other manufacturing technique is required"},
                    'woven_yarn': {required: "Yarn type  is required"},
                    'other_woven_yarn': {required: "Other yarn type  is required"},
                    'woven_features[]': {required: "Features  is required"},
                    'other_woven_features': {required: "Other features  is required"},
                    'woven_use[]': {required: "End use/application  is required"},
                    'other_woven_use': {required: "Other use/application  is required"},

                    'non_woven_fabric_types': {required: "Fabric type  is required"},
                    'other_non_woven_fabric_type': {required: "Other fabric type  is required"},
                    'non_woven_types': {required: "Non woven type  is required"},
                    'other_non_woven_type': {required: "Other non woven type  is required  is required"},
                    'non_woven_fabric_construction': {required: "Fabric construction  is required"},
                    'non_woven_gsm_thickness': {required: "GSM/thickness  is required"},
                    'non_woven_width_from': {required: "Width range from is required"},
                    'non_woven_width_to': {required: "Width range to is required"},
                    'non_woven_manufact': {required: "Manufacturing technique  is required"},
                    'other_non_woven_manufact': {required: "Other manufacturing technique is required"},
                    'non_woven_yarn': {required: "Yarn type  is required"},
                    'other_non_woven_yarn': {required: "Other yarn type  is required"},
                    'non_woven_features[]': {required: "Features  is required"},
                    'other_non_woven_features': {required: "Other features  is required"},
                    'non_woven_use[]': {required: "End use/application  is required"},
                    'other_non_woven_use': {required: "Other use/application  is required"},

                    'product_type':{required: "Product type  is required"},
                    'machinery_condition':{required: "Machinery condition   is required"},
                    'after_sales_service':{required: "After sales service  is required"},
                    'service_type':{required: "Type of service  is required"},
                    'warranty':{required: "Warranty   is required"},
                    'warranty_period':{required: "Warranty period  is required"},
                    'certification':{required: "Product certification  is required"},
                    'certification_details':{required: "Certification details  is required"},


                    'material':{required: "Material type  is required"},
                    'composition':{required: "Composition/construction  is required"},
                    'size_age_group':{required: "Size/age group  is required"},
                    'colour':{required: "Color  is required"},

                    'chemicals_listed1':{required: "Chemicals listed  is required"},
                    'supply_type1':{required: "Supply type  is required"},

                    'material_type':{required: "Material type  is required"},
                    'construction':{required: "Composition/construction  is required"},
                    'size_age':{required: "Size/age group  is required"},
                    'color':{required: "Color  is required"},


                    'dealing_as[]': {
                        required: "Dealing product is required"
                    },
                    'focused_selling_countries[]': {
                        required: "Target selling countries required"
                    },
                    'unit_price_from': {
                        required: "Range from required"
                    },
                    'unit_price_to': {
                        required: "Range to required"
                    },
                    'unit_price_unit': {
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
                if ($("form[name='updateProduct']").valid()) {
                    $('.tab-pane.fade.show.active').removeClass('active show');
                    if ($(this).attr('id') == 'nextBtn1') {
                        $(".product-tab-btn").children(".nav-link").removeClass('active');
                        var sellProductcheck = $('#productSell').prop('checked');
                        var serviceProductcheck = $('#productService').prop('checked');
                        if (sellProductcheck) {
                            $(".product-tab-btn:first").next().children(".nav-link").addClass('active');
                            $('.trade-info-tab').addClass('active show');
                        } else {
                            $(".product-tab-btn:nth-child(2)").next().children(".nav-link").addClass('active');
                            $('.payment-info-tab').addClass('active show');
                        }
                    } else if ($(this).attr('id') == 'nextBtn2') {
                        $(".product-tab-btn").children(".nav-link").removeClass('active');
                        $(".product-tab-btn:nth-child(2)").next().children(".nav-link").addClass('active');
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
                    $("#loader").addClass('d-flex justify-content-center align-items-center');
                    $("#loader").css({'background-color': 'rgb(255, 255, 255, 0.5)', 'background-image':'none'}).show();
                    $('.progress-bar-ajax').parent().removeClass('d-none');
                    $form.find('button[type=submit]').prop('disabled', true);

                    var timerId = 0;
                    var ctr=0;
                    var max=10;

                    var progressBarPercent = $(".progress-bar-ajax").width() / $(".progress").width() * 100;
                    var progressBarPercentRoundOff = Math.ceil(progressBarPercent);

                    if(progressBarPercentRoundOff <= 70) {
                        timerId = setInterval(function () {
                            // interval function
                            ctr++;
                            $('.progress-bar-ajax').attr("style","width:" + ctr*max + "%");
                            $('.progress-bar-ajax').text(ctr*max + "%");
                            // max reached?
                            if (ctr=='7'){
                                clearInterval(timerId);
                            }

                        }, 500);
                    }
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-create-product').hide();
                    $('#alert-error-create-product').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;

                    if (response.feedback == "updated") {
// $('html, body').animate({scrollTop: 0}, 'slow');
// $("#alert-success-create-product").show().html("New product added successfully.");
                        $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                        $("#loader").hide();

                        var timerId = 0;
                        var ctr=0;
                        var max=10;
                        var progressBarPercent = $(".progress-bar-ajax").width() / $(".progress").width() * 100;
                        var progressBarPercentRoundOff = Math.ceil(progressBarPercent);

                        if(ctr < 10) {
                            timerId = setInterval(function () {
                                // interval function
                                ctr++;

                                // max reached?
                                if (ctr==max){
                                    // var progressBarPercent = $(".progress-bar-ajax").width() / $(".progress").width() * 100;
                                    // var progressBarPercentRoundOff = Math.ceil(progressBarPercent);
                                    $(".progress-bar-ajax").width(70  + 30 + "%");
                                    $('.progress-bar-ajax').text(70  + 30 + "%");

                                    clearInterval(timerId);
                                    toastr.success("Product updated successfully.");
                                    $(window).off('beforeunload');
                                    window.location.href = response.url;
                                }
                            }, 500);
                        }
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
            $('#updateProduct').ajaxForm(options);

            $("#nextBtn2").on("click", function () {
                if (focused_selling_countries.value.length == 0)
                {
                    alert("Enter the missing data");
                    return false;
                }
                if (dealing_as.value.length == 0)
                {
                    alert("Enter the missing data");
                    return false;
                }
            });

            $("#category").on("change", function () {
                // $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                var $this = $(this);
                $this.siblings(".loading-icon").removeClass("d-none");
                // $('#keyword1').val($('#category option:selected').attr('cat-val'));
                // $('#keyword1').valid();
                $.ajax({
                    url: '{{ route("get-sub-categories") }}',
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
                    url: '{{ route("get-sub-categories") }}',
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

                }

            });


            $('#proFree').on('click', function () {
// alert($('#proPaid').val());
                if ($('#proFree').prop("checked")) {
                    $('#paidField').addClass('d-none');
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
                $('#updateProduct').submit(function () {
                    initial_form_state = $('#updateProduct').serialize();
                });
                $(window).bind('beforeunload', function (e) {
                    var form_state = $('#updateProduct').serialize();
                    if (initial_form_state != form_state) {
                        return 'Are you sure you want to leave?';
                    }
                });
            }, 5000);


            $(document).on('change', '#sheet16', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet16").files[0].name;
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
                    var output = document.getElementById('uploaded_image16');
                    output.src = reader.result;
                };

                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet16').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet16')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet16').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet16_url').val(url);
                        var name = $('input[name="sheet16_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image16').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image16').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image16').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }
                    });
                }

            });
            $(document).on('change', '#sheet17', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet17").files[0].name;
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
                    var output = document.getElementById('uploaded_image17');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet17').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet17')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet117').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet17_url').val(url);
                        var name = $('input[name="sheet17_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image17').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image17').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image17').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#sheet18', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet18").files[0].name;
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
                    var output = document.getElementById('uploaded_image18');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet18').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet18')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet18').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet18_url').val(url);
                        var name = $('input[name="sheet18_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image18').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image18').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image18').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#sheet19', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet19").files[0].name;
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
                    var output = document.getElementById('uploaded_image19');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet19').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet19')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet18').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet19_url').val(url);
                        var name = $('input[name="sheet19_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image19').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image19').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image19').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#sheet20', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet20").files[0].name;
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
                    var output = document.getElementById('uploaded_image20');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet20').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet20')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet20').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet20_url').val(url);
                        var name = $('input[name="sheet20_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image20').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image20').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image20').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#sheet21', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet21").files[0].name;
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
                    var output = document.getElementById('uploaded_image21');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet21').files[0]);


                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet21')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet21').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet21_url').val(url);
                        var name = $('input[name="sheet21_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image21').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image21').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image21').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#sheet22', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet22").files[0].name;
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
                    var output = document.getElementById('uploaded_image22');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet22').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet22')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet22').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet22_url').val(url);
                        var name = $('input[name="sheet22_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image22').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image22').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image22').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#sheet23', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet23").files[0].name;
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
                    var output = document.getElementById('uploaded_image23');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet23').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet23')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet23').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet23_url').val(url);
                        var name = $('input[name="sheet23_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image23').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image23').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image23').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#sheet24', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet24").files[0].name;
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
                    var output = document.getElementById('uploaded_image24');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet24').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet24')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet24').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet24_url').val(url);
                        var name = $('input[name="sheet24_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image24').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image24').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image24').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#sheet25', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet25").files[0].name;
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
                    var output = document.getElementById('uploaded_image25');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet25').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet25')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet25').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet25_url').val(url);
                        var name = $('input[name="sheet25_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image25').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image25').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image25').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#sheet26', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet26").files[0].name;
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
                    var output = document.getElementById('uploaded_image26');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet26').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet26')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet26').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet26_url').val(url);
                        var name = $('input[name="sheet26_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image26').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image26').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image26').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#sheet27', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet27").files[0].name;
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
                    var output = document.getElementById('uploaded_image27');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet27').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet27')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet27').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet27_url').val(url);
                        var name = $('input[name="sheet27_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image27').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image27').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image27').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#sheet28', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet28").files[0].name;
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
                    var output = document.getElementById('uploaded_image28');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet28').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet28')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet28').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet28_url').val(url);
                        var name = $('input[name="sheet28_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image28').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image28').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image28').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }

            });
            $(document).on('change', '#sheet29', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet29").files[0].name;
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
                    var output = document.getElementById('uploaded_image29');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet29').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet29')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet29').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet29_url').val(url);
                        var name = $('input[name="sheet29_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image29').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image29').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image29').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });
            $(document).on('change', '#sheet30', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("sheet30").files[0].name;
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
                    var output = document.getElementById('uploaded_image30');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("sheet", document.getElementById('sheet30').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#sheet30')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#sheet30').val(null);

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#sheet30_url').val(url);
                        var name = $('input[name="sheet30_url"]').val()
                        var ext = name.split('.').pop().toLowerCase();

                        if (ext == "pdf") {
                            $('#uploaded_image30').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $('#uploaded_image30').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $('#uploaded_image30').attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }


                    });
                }
            });

            $(document).on('change', '#avatar1', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar1").files[0].name;
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
                    var output = document.getElementById('uploaded_image1');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar1').files[0]);


                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar1')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {

                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar1_url').val(url);


                    });
                }

            });
            $(document).on('change', '#avatar2', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar2").files[0].name;
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
                    var output = document.getElementById('uploaded_image2');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar2').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar2')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar2').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar2_url').val(url);


                    });
                }

            });
            $(document).on('change', '#avatar3', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar3").files[0].name;
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
                    var output = document.getElementById('uploaded_image3');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar3').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar3')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar3').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar3_url').val(url);


                    });
                }
            });
            $(document).on('change', '#avatar4', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar4").files[0].name;
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
                    var output = document.getElementById('uploaded_image4');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar4').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar4')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar4').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar4_url').val(url);


                    });
                }
            });
            $(document).on('change', '#avatar5', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar5").files[0].name;
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
                    var output = document.getElementById('uploaded_image5');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar5').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar5')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar5').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar5_url').val(url);


                    });
                }

            });
            $(document).on('change', '#avatar6', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar6").files[0].name;
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
                    var output = document.getElementById('uploaded_image6');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar6').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar6')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar6').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar6_url').val(url);


                    });
                }

            });
            $(document).on('change', '#avatar7', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar7").files[0].name;
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
                    var output = document.getElementById('uploaded_image7');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar7').files[0]);


                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar7')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar7').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar7_url').val(url);


                    });
                }
            });
            $(document).on('change', '#avatar8', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar8").files[0].name;
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
                    var output = document.getElementById('uploaded_image8');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar8').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar8')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar8').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar8_url').val(url);


                    });
                }
            });
            $(document).on('change', '#avatar9', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar9").files[0].name;
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
                    var output = document.getElementById('uploaded_image9');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar9').files[0]);


                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar9')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar9').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar9_url').val(url);


                    });
                }

            });
            $(document).on('change', '#avatar10', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar10").files[0].name;
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
                    var output = document.getElementById('uploaded_image10');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar10').files[0]);


                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar10')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar10').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar10_url').val(url);


                    });
                }

            });
            $(document).on('change', '#avatar11', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar11").files[0].name;
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
                    var output = document.getElementById('uploaded_image11');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar11').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar11')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar11').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar11_url').val(url);

                    });
                }
            });
            $(document).on('change', '#avatar12', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar12").files[0].name;
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
                    var output = document.getElementById('uploaded_image12');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar12').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar12')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar12').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar12_url').val(url);


                    });
                }
            });
            $(document).on('change', '#avatar13', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar13").files[0].name;
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
                    var output = document.getElementById('uploaded_image13');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar13').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar13')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar13').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar13_url').val(url);


                    });
                }
            });
            $(document).on('change', '#avatar14', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar14").files[0].name;
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
                    var output = document.getElementById('uploaded_image14');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar14').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar14')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar14').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar14_url').val(url);


                    });
                }

            });
            $(document).on('change', '#avatar15', function (event) {
                var $this = $(this);
                $this.siblings('.product-upload-button').find('.loader-spinner').removeClass('d-none');
                $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000075');
                var name = document.getElementById("avatar15").files[0].name;
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
                    var output = document.getElementById('uploaded_image15');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token', token);
                form_data.append("avatar", document.getElementById('avatar15').files[0]);

                var bucket = new AWS.S3({params: {Bucket: 'bizonairfiles'}});
                var uploadFiles = $('#avatar15')[0];
                var upFile = uploadFiles.files[0];
                if (upFile) {
                    let filename = Date.now() + '.' + upFile.name.split('.').pop();
                    var uploadParams = {Key: filename, ContentType: upFile.type, Body: upFile};

                    bucket.upload(uploadParams).on('httpUploadProgress', function (evt) {
                    }).send(function (err, data) {
                        $('#avatar15').val(null);
                        $this.siblings('.product-upload-button').find('.loader-spinner').addClass('d-none');
                        $this.siblings('.product-upload-button').find('.loader-spinner').parent('.product-upload-button').css('background', '#00000015');
                        let url = data.Location;
                        $('#avatar15_url').val(url);


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
                        $.post("{{ route('remove-product-image') }}", {
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
                        $.post("{{ route('remove-product-sheet') }}", {
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
