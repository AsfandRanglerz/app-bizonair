@extends('front_site.master_layout')

@section('content')
    <body class="dashboard">
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->
        <!-- Sidebar -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper" >

                <div id='alert-success-create-product' class="alert alert-success py-2" style="display: none;"></div>
                <div id='alert-error-create-product' class="alert alert-danger py-2" style="display: none;"></div>
                <div class="px-2 py-2">
                    <div id="companyTab1">
                        <ul class="nav nav-tabs" id="aboutLinks" role="tablist">
                            <li class="product-tab-btn nav-item">
                                <a class="nav-link active product-service-info" id="linkReg" data-toggle="tab"
                                   href="#tabReg" role="tab"
                                   aria-controls="tabReg" aria-selected="true">Product Info</a>
                            </li>
{{--                            <li class="product-tab-btn nav-item trade-info">--}}
{{--                                <a class="nav-link" id="linkCom" data-toggle="tab" href="#tabCom" role="tab"--}}
{{--                                   aria-controls="tabCom" aria-selected="false">Trade Info</a>--}}
{{--                            </li>--}}
                            <li class="product-tab-btn nav-item">
                                <a class="nav-link payment-delivery-info" id="linkInfo" data-toggle="tab"
                                   href="#tabInfo" role="tab"
                                   aria-controls="tabInfo" aria-selected="false">Payment Info</a>
                            </li>
                        </ul>
                        <form id="createBuysell" name="createBuysell" method="post"
                              action="{{ route('buy-sell.store') }}" enctype="multipart/form-data"
                              class="needs-validation" novalidate>
                            @csrf
                            <div class="tab-content" id="myCompanyTab">
                                <div class="px-0 py-2 tab-pane fade show active" id="tabReg" role="tabpanel"
                                     aria-labelledby="tabReg">
                                    <div class="form-row">
                                        <div class="form-group col-md-12 mb-0">
                                            <label class="font-500">Post Your Deal As
                                                <span class="required"> *</span>
                                            </label>
                                            <a href="#" class="pull-right text-decoration-none red-link font-500 help-txt">Help<span class="ml-1 fa fa-question-circle" aria-hidden="true"></span></a>
                                            <div class="mb-2 d-flex flex-row">
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
                                                           class="custom-control-input product-buy-sell"
                                                           value="Buy" id="productBuy"
                                                           name="product_service_types[]">
                                                    <label class="custom-control-label" for="productBuy">Buyer</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
                                                           class="custom-control-input product-buy-sell"
                                                           value="Sell" id="productSell"
                                                           name="product_service_types[]">
                                                    <label class="custom-control-label" for="productSell">Seller</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
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
                                        <div class="form-group col-md-6 mb-1">
                                            <select class="form-control product-categories" id="category"
                                                    name="category" required>
                                                <option value="" selected disabled> ---- Select Main Category ---</option>
                                                @foreach(\App\Category::all() as $category)
                                                    <option value="{{ $category->id }}" cat-val="{{ $category->name }}"
                                                            class="d-none"
                                                            cat-type="{{ $category->type }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="category_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <select class="form-control product-subcategories" id="sub_category"
                                                    name="sub_category" required>
                                                <option value="" selected disabled> ---- Select Sub-Category ---
                                                </option>
                                                <option disabled class="text-danger">Please select category first
                                                </option>
                                            </select>
                                            <small class="text-danger" id="sub_category_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 d-flex flex-column subCat-Sec mb-0">
                                            <select class="form-control single-select-dropdown" id="sub_sub_category" name="sub_sub_category"
                                                    required>
                                                <option value="" selected disabled></option>
                                                <option value="one">option 1</option>
                                                <option value="two">option 2</option>
                                                <optgroup label="Group Options">
                                                    <option>Nested option 1</option>
                                                    <option>Nested option 2</option>
                                                </optgroup>
                                            </select>

                                            <small class="text-danger" id="sub_sub_category_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 add-sub-sub-cat">
                                            <label class="font-500">Add Product Type <span class="required"> *</span></label>
                                            <input type="text" name="add_sub_sub_category" class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0 clearfix">
                                            <span class="text-danger pull-right font-500"><span class="counter-total-digits">0</span>/80</span>
                                            <input type="text" id="subject" class="form-control" maxlength = "80"name="subject"
                                                   placeholder="Subject - It will appear as title" required>
                                            <small class="text-danger" id="subject_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1 clearfix product-name">
                                            <span class="text-danger pull-right font-500"><span class="counter-total-digits">0</span>/50</span>
                                            <input type="text" id="product_service_name" class="form-control" maxlength = "50"
                                                   name="product_service_name" placeholder="Product Name" required>
                                            <small class="text-danger" id="product_service_name_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-3 mb-1">
                                            <select name="expiry_date" id="expiry_date" class="form-control add-date" required>
                                                <option value="" selected disabled>--- Ad Expiry Days ---</option>
                                                <option value="10">10 Days</option>
                                                <option value="20">20 Days</option>
                                                <option value="30">30 Days</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 mb-1">
                                            <input type="text" name="date_expire" id="date_expire" placeholder="Ad Expiry Date" class="form-control append-inp" readonly/>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <div class="form-row">
                                                <div class="form-group col-md-4 mb-1">
                                                    <input type="text" id="keyword1" name="keyword1"
                                                           class="form-control" placeholder="Additional Keyword For Search (Optional) - Keyword 1">
                                                </div>
                                                <div class="form-group col-md-4 mb-1">
                                                    <input type="text" id="keyword2" name="keyword2"
                                                           class="form-control" placeholder="Additional Keyword For Search (Optional) - Keyword 2">
                                                </div>
                                                <div class="form-group col-md-4 mb-1">
                                                    <input type="text" id="keyword3" name="keyword3"
                                                           class="form-control" placeholder="Additional Keyword For Search (Optional) - Keyword 3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <label class="font-500">Specification Sheets<br><small class="font-500">(Optional
                                                    | JPG, PNG, Word, Excel & PDF files only | Upto 10MB)</small></label>
                                            <div class="dropzone dz-clickable images-files-drop">
                                                <div class="dz-default dz-message"
                                                     data-dz-message="">
													<span class="fileinput-button">
													<span class="fa fa-upload pr-2"></span>
													Drop Images and Files here
												</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <label for="product_images" class="font-500">Product Images <span class="required"> *</span><small class="font-500">            (Note: First image will be displayed as Ad Cover Photo)</small><br><small class="font-500">(JPG & PNG  files only | Atleast one product image | Upto
                                                    10MB)</small></label>
                                            <div class="dropzone dz-clickable images-drop">
                                                <div class="dz-default dz-message"
                                                     data-dz-message="">
													<span class="fileinput-button">
                                                        <span class="fa fa-upload pr-2"></span>
                                                        Drop Images here
												    </span>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="file_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1 product-available">
                                            <input type="number" min="0" id="product_availability" class="form-control"
                                                   name="product_availability" placeholder="Available Quantity - e.g 50,100" required>
                                            <small class="text-danger" id="product_availability_error"></small>
                                        </div>
{{--                                        <div class="form-group col-md-6">--}}
{{--                                            <label class="font-500">Price <span class="required"> *</span></label>--}}
{{--                                            <input type="text" class="form-control" id="price" name="price" placeholder="Price" required>--}}
{{--                                        </div>--}}
                                        <div class="form-group col-md-6 mb-1 product-available">
                                            <select class="form-control other-option-included" id="available_unit" name="available_unit" required>
                                                <option value="" selected disabled>-- Select Suitable Unit --</option>
                                                <option value="20' Container">20' Container</option>
                                                <option value="40' Container">40' Container</option>
                                                <option value="Bale">Bale</option>
                                                <option value="Barel">Barel</option>
                                                <option value="Box">Box</option>
                                                <option value="Bag">Bag</option>
                                                <option value="Carton">Carton</option>
                                                <option value="Cone">Cone</option>
                                                <option value="Dozen">Dozen</option>
                                                <option value="Gallon">Gallon</option>
                                                <option value="Gram">Gram</option>
                                                <option value="Gross">Gross</option>
                                                <option value="Kg">Kg</option>
                                                <option value="Lb">Lb</option>
                                                <option value="Liter">Liter</option>
                                                <option value="Meter">Meter</option>
                                                <option value="MT">MT</option>
                                                <option value="Pack">Pack</option>
                                                <option value="Pair">Pair</option>
                                                <option value="Pallet">Pallet</option>
                                                <option value="Piece">Piece</option>
                                                <option value="Pound">Pound</option>
                                                <option value="Roll">Roll</option>
                                                <option value="Set">Set</option>
                                                <option value="Sheet">Sheet</option>
                                                <option value="Spool">Spool</option>
                                                <option value="Square Feet">Square Feet</option>
                                                <option value="Square Meter">Square Meter</option>
                                                <option value="Ton">Ton</option>
                                                <option value="Yard">Yard</option>
                                                <option value="Other" class="other-check">Other</option>
                                            </select>
                                            <small class="text-danger" id="available_unit_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 other-div">
                                            <label class="font-500">Other Unit <span
                                                    class="required">*</span></label>
                                            <input type="text" name="other_available_unit" class="form-control">
                                        </div>
                                    </div>



                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="text" id="manufacturer_name"
                                                   value="{{$user->name}}" name="manufacturer_name"
                                                   class="form-control manufacturer-name optional-field"
                                                   placeholder="Manufacturer Name - Manufacture spelling must be correct to be visible in the search.">
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <select class="form-control origin" id="origin" name="origin" required>
                                                <option value="" selected disabled> ---- Select Product Origin ---</option>
                                                <option value="Any">Any</option>
                                                @foreach(\DB::table('countriyes')->get() as $country)
                                                    <option
                                                        @if($user->country_id == $country->id) selected
                                                        @endif value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="origin_error"></small>
                                        </div>
                                    </div>

                                    <div class="additional-product-info machinery-info" style="display: none;">
                                        <span class="d-block mb-3 heading">Products Specification</span>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 mb-1">
                                                <label class="font-500">Brand Name
                                                    <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="brand_name" class="form-control optional-field"
                                                       name="brand_name"
                                                       placeholder="Brand Name">
                                            </div>
                                            <div class="form-group col-md-6 mb-1">
                                                <label class="font-500">Model Number
                                                    <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="model_number" class="form-control optional-field"
                                                       name="model_number"
                                                       placeholder="Model Number">
                                            </div>
                                            <div class="form-group col-md-6 mb-1">
                                                <label class="font-500">Year of Manufacturing
                                                    <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="year_manufacturing" class="form-control optional-field"
                                                       name="year_manufacturing"
                                                       placeholder="Year of Manufacturing">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 mb-0">
                                                <label class="font-500">After Sales Service <span
                                                        class="required">*</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="Yes"
                                                               id="productYes" name="after_sales_service" required>
                                                        <label class="custom-control-label" for="productYes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="No"
                                                               id="productNo" name="after_sales_service" required>
                                                        <label class="custom-control-label" for="productNo">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input"
                                                               value="Not Applicable" id="productNa"
                                                               name="after_sales_service" required>
                                                        <label class="custom-control-label" for="productNa">Not
                                                            Applicable</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="after_sales_service_error"></small>
                                            </div>
                                            <div class="form-group col-md-6 mb-1 type-of-service">
                                                <label for="service_type" class="font-500 d-none">Type of Service <span
                                                        class="required">*</span></label>
                                                <input type="text" id="service_type" class="form-control"
                                                       name="service_type" placeholder="Type of Service" required>
                                                <small class="text-danger" id="service_type_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 mb-0">
                                                <label class="font-500">Warranty <span class="required"> *</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="Yes"
                                                               id="warrantyYes" name="warranty" required>
                                                        <label class="custom-control-label"
                                                               for="warrantyYes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="No"
                                                               id="warrantyNo" name="warranty">
                                                        <label class="custom-control-label" for="warrantyNo">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input"
                                                               value="Not Applicable" id="warrantyNa"
                                                               name="warranty">
                                                        <label class="custom-control-label" for="warrantyNa">Not
                                                            Applicable</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="warranty_error"></small>
                                            </div>
                                            <div class="form-group col-md-6 mb-1 warranty-services">
                                                <label for="warranty_period" class="font-500 d-none">Warranty Period <span
                                                        class="required">*</span></label>
                                                <input type="text" id="warranty_period" class="form-control"
                                                       name="warranty_period" placeholder="Warranty Period" required>
                                                <small class="text-danger" id="warranty_period_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 mb-0">
                                                <label class="font-500">Product Certification <span
                                                        class="required">*</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="Yes"
                                                               id="certifyYes" name="certification" required>
                                                        <label class="custom-control-label" for="certifyYes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" value="No" class="custom-control-input"
                                                               id="certifyNo" name="certification">
                                                        <label class="custom-control-label" for="certifyNo">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" value="Not Applicable"
                                                               class="custom-control-input" id="certifyNa"
                                                               name="certification">
                                                        <label class="custom-control-label" for="certifyNa">Not
                                                            Applicable</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="certification_error"></small>
                                            </div>
                                            <div class="form-group col-md-6 certify-services">
                                                <label for="certification_details" class="font-500 d-none">Certification
                                                    Details <span class="required"> *</span></label>
                                                <input type="text" id="certification_details" class="form-control"
                                                       name="certification_details" placeholder="Certification Details"
                                                       required>
                                                <small class="text-danger" id="certification_details_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
{{--                                            <div class="form-group col-md-6">--}}
{{--                                                <label for="additional_trade_notes" class="font-500">Additional Trade--}}
{{--                                                    notes <small class="font-500"> (Optional)</small></label>--}}
{{--                                                <input type="text" class="form-control optional-field"--}}
{{--                                                       id="additional_trade_notes" name="additional_trade_notes"--}}
{{--                                                       placeholder="Additional Trade notes">--}}
{{--                                            </div>--}}
                                            <div class="form-group col-md-6 mb-1">
                                                <label for="product_related_certifications" class="font-500">Company Certification <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="product_related_certifications"
                                                       class="form-control optional-field"
                                                       name="product_related_certifications"
                                                       placeholder="Company Certification">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12 clearfix">
                                            <span class="pull-right font-500 text-danger"><span class="counter-total-digits">0</span>/1200</span>
                                            <textarea id="details" rows="5" maxlength = "1200" class="form-control addi_info" name="details"
                                                      placeholder="Additional Info (Optional) - Add product details"></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-3" align="right">
                                        <button type="button" class="red-btn next-btn" id="nextBtn1">NEXT</button>
                                    </div>
                                    <div class="my-1">
                                        <hr class="horizontal-line">
                                    </div>
                                </div>

{{--                                <div class="p-3 tab-pane fade trade-info-tab" id="tabCom" role="tabpanel"--}}
{{--                                     aria-labelledby="tabCom">--}}
{{--                                    <div class="form-row">--}}
{{--                                        <div class="form-group col-md-6 trade-info-container">--}}
{{--                                            <label for="focused_selling_region" class="font-500">Target Selling--}}
{{--                                                Region--}}
{{--                                                <small class="font-500"> (Optional)</small></label>--}}
{{--                                            <input type="text" id="focused_selling_region" class="form-control"--}}
{{--                                                   name="focused_selling_region"--}}
{{--                                                   placeholder="City, Province, State...">--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-6 trade-info-container">--}}
{{--                                            <label for="production_capacity" class="font-500">Production Capacity--}}
{{--                                                <small--}}
{{--                                                    class="font-500">(Optional)</small></label>--}}
{{--                                            <input type="text" id="production_capacity" class="form-control"--}}
{{--                                                   name="production_capacity" placeholder="Mention Production Capacity Per Day, Per Month">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-row">--}}
{{--                                        <div class="form-group col-md-6 trade-info-container">--}}
{{--                                            <label for="min_order_quantity" class="font-500">Min Order Quantity--}}
{{--                                                (MOQ)--}}
{{--                                                <small class="font-500"> (Optional)</small></label>--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-12">--}}
{{--                                                    <input type="text" id="min_order_quantity" class="form-control"--}}
{{--                                                           name="min_order_quantity"--}}
{{--                                                           placeholder="Min Order Quantity (MOQ)">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-6 trade-info-container">--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <label class="font-500 d-block">Sampling <small--}}
{{--                                                            class="font-500">(Optional)</small></label>--}}
{{--                                                    <div--}}
{{--                                                        class=" custom-control custom-radio custom-control-inline form-check-inline">--}}
{{--                                                        <input type="radio" class="custom-control-input" value="1"--}}
{{--                                                               id="proYes" name="is_sampling">--}}
{{--                                                        <label class="custom-control-label" for="proYes">Yes</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div--}}
{{--                                                        class="custom-control custom-radio ml-3 custom-control-inline form-check-inline">--}}
{{--                                                        <input type="radio" class="custom-control-input" value="0"--}}
{{--                                                               id="proNo" name="is_sampling">--}}
{{--                                                        <label class="custom-control-label" for="proNo">No</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="paid-or-free">--}}
{{--                                                        <div--}}
{{--                                                            class="custom-control custom-radio custom-control-inline form-check-inline">--}}
{{--                                                            <input type="radio" class="custom-control-input"--}}
{{--                                                                   value="Paid"--}}
{{--                                                                   id="proPaid" name="sampling_type">--}}
{{--                                                            <label class="custom-control-label"--}}
{{--                                                                   for="proPaid">Paid</label>--}}
{{--                                                        </div>--}}
{{--                                                        <div--}}
{{--                                                            class="custom-control custom-radio ml-3 custom-control-inline form-check-inline">--}}
{{--                                                            <input type="radio" class="custom-control-input"--}}
{{--                                                                   value="Free"--}}
{{--                                                                   id="proFree" name="sampling_type">--}}
{{--                                                            <label class="custom-control-label"--}}
{{--                                                                   for="proFree">Free</label>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <div class="form-row d-none trade-info-container position-relative"--}}
{{--                                                         id="paidField">--}}
{{--                                                        <div class="form-group ">--}}
{{--                                                            <label class="font-500 pt-3">Add Price <span--}}
{{--                                                                    class="required">*</span></label>--}}
{{--                                                            <input type="text" id="paidSample"--}}
{{--                                                                   name="paid_sampling_price"--}}
{{--                                                                   class="form-control">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-row">--}}
{{--                                        <div class="form-group col-md-6 trade-info-container">--}}
{{--                                            <label for="dealing_as" class="label d-block">Dealing Product As <span--}}
{{--                                                    class="required">*</span></label>--}}
{{--                                            <select id="dealing_as" name="dealing_as[]"--}}
{{--                                                    class="select2-multiple form-control required-control"--}}
{{--                                                    multiple="multiple" required>--}}
{{--                                                <option value="" class="d-none" disabled></option>--}}
{{--                                                <option value="Manufacturer">Manufacturer</option>--}}
{{--                                                <option value="Sole Agent">Sole Agent</option>--}}
{{--                                                <option value="Stockist">Stockist</option>--}}
{{--                                                <option value="Supplier">Supplier</option>--}}
{{--                                                <option value="Marketing Manager">Marketing Manager</option>--}}
{{--                                                <option value="Other" class="other-check">Other</option>--}}
{{--                                            </select>--}}
{{--                                            <small class="text-danger" id="dealing_as_error"></small>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-6 other-div add-Certifications">--}}
{{--                                            <label class="font-500">Add Other Details <span--}}
{{--                                                    class="required">*</span></label>--}}
{{--                                            <input type="text" id="other_dealing_as" name="other_dealing_as"--}}
{{--                                                   class="form-control" required>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-row">--}}
{{--                                        <div class="form-group col-md-6 trade-info-container">--}}
{{--                                            <label class="font-500">Target Selling Country <span--}}
{{--                                                    class="required">*</span></label>--}}
{{--                                            <select name="focused_selling_countries[]"--}}
{{--                                                    class="select2-multiple form-control required-control"--}}
{{--                                                    multiple="multiple" id="focused_selling_countries" required>--}}
{{--                                                @foreach(\App\Country::all() as $country)--}}
{{--                                                    <option--}}
{{--                                                        value="{{ $country->country_name }}">{{ $country->country_name }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <small class="text-danger" id="focused_selling_countries_error"></small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="mt-3" align="right">--}}
{{--                                        <button type="button" class="red-btn next-btn" id="nextBtn2">NEXT</button>--}}
{{--                                    </div>--}}
{{--                                    <div class="my-1">--}}
{{--                                        <hr class="horizontal-line">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="px-0 py-2 tab-pane fade payment-info-tab" id="tabInfo" role="tabpanel"
                                     aria-labelledby="tabInfo">
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1 unit_price_range">

                                            <div class="form-row">
                                                <div class="col-md-6 mb-1">
{{--                                                    <label for="unit_price_from" class="font-500 unit_price_range_label">Unit Price <span--}}
{{--                                                            class="required">*</span></label>--}}
{{--                                                    <label for="unit_price_from" class="font-500 service_charges_range_label">Service--}}
{{--                                                        Charges <span--}}
{{--                                                            class="required">*</span></label>--}}
                                                    <input type="number" min="0" class="form-control unit_price_range_label"
                                                           name="unit_price_from" placeholder="Unit Price - e.g. 1000" required>
                                                    <input type="number" min="0" class="form-control service_charges_range_label"
                                                           name="unit_price_from" placeholder="Service Charges - e.g. 1000" required>
                                                </div>
                                                <div class="col-md-6 hide-for-service" style="display: none;">
                                                    <label for="unit_price_unit" class="font-500 unit_price_range_label d-none">Per Unit <span
                                                            class="required">*</span></label>
                                                    <select class="form-control other-option-included" id="unit_price_unit" name="unit_price_unit" required>
                                                        <option value="" selected disabled>-- Select Suitable Per Unit --</option>
                                                        <option value="20' Container">20' Container</option>
                                                        <option value="40' Container">40' Container</option>
                                                        <option value="Bale">Bale</option>
                                                        <option value="Barel">Barel</option>
                                                        <option value="Box">Box</option>
                                                        <option value="Bag">Bag</option>
                                                        <option value="Carton">Carton</option>
                                                        <option value="Cone">Cone</option>
                                                        <option value="Dozen">Dozen</option>
                                                        <option value="Gallon">Gallon</option>
                                                        <option value="Gram">Gram</option>
                                                        <option value="Gross">Gross</option>
                                                        <option value="Kg">Kg</option>
                                                        <option value="Lb">Lb</option>
                                                        <option value="Liter">Liter</option>
                                                        <option value="Meter">Meter</option>
                                                        <option value="MT">MT</option>
                                                        <option value="Pack">Pack</option>
                                                        <option value="Pair">Pair</option>
                                                        <option value="Pallet">Pallet</option>
                                                        <option value="Piece">Piece</option>
                                                        <option value="Pound">Pound</option>
                                                        <option value="Roll">Roll</option>
                                                        <option value="Set">Set</option>
                                                        <option value="Sheet">Sheet</option>
                                                        <option value="Spool">Spool</option>
                                                        <option value="Square Feet">Square Feet</option>
                                                        <option value="Square Meter">Square Meter</option>
                                                        <option value="Ton">Ton</option>
                                                        <option value="Yard">Yard</option>
                                                        <option value="Other" class="other-check">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 service-unit">
                                                    <label class="font-500 service_charges_range_unit_label d-none">Per Unit <span
                                                            class="required">*</span></label>
                                                    <input type="text" name="unit_price_unit" class="form-control" placeholder="Per Unit" required>
                                                    <small class="text-danger" id="unit_price_unit_error"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 other-div add-unit_price_unit">
                                            <label class="font-500">Other Price Unit <span
                                                    class="required">*</span></label>
                                            <input type="text" name="other_unit_price_unit" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-6 mb-0 target_price_range">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-1">
{{--                                                    <label for="target_price_from" class="font-500">Target Price <span--}}
{{--                                                            class="required">*</span></label>--}}
                                                    <input type="number" min="0" id="target_price_from" class="form-control"
                                                           name="target_price_from" placeholder="Target Price - e.g. 1000" required>
                                                </div>
                                                {{--                                                <div class="col-md-6">--}}
                                                {{--                                                    <input type="number" id="target_price_to" class="form-control"--}}
                                                {{--                                                           name="target_price_to" placeholder="e.g. 200">--}}
                                                {{--                                                </div>--}}
                                                <div class="col-md-6 mb-1">
                                                    <label for="target_price_unit" class="font-500 d-none">Per Unit <span
                                                            class="required">*</span></label>
                                                    <select class="form-control"
                                                            id="target_price_unit"
                                                            name="target_price_unit" required>
                                                        <option value="" selected disabled>-- Select Suitable Per Unit --</option>
                                                        <option value="20' Container">20' Container</option>
                                                        <option value="40' Container">40' Container</option>
                                                        <option value="Bale">Bale</option>
                                                        <option value="Barel">Barel</option>
                                                        <option value="Box">Box</option>
                                                        <option value="Bag">Bag</option>
                                                        <option value="Carton">Carton</option>
                                                        <option value="Cone">Cone</option>
                                                        <option value="Dozen">Dozen</option>
                                                        <option value="Gallon">Gallon</option>
                                                        <option value="Gram">Gram</option>
                                                        <option value="Gross">Gross</option>
                                                        <option value="Kg">Kg</option>
                                                        <option value="Lb">Lb</option>
                                                        <option value="Liter">Liter</option>
                                                        <option value="Meter">Meter</option>
                                                        <option value="MT">MT</option>
                                                        <option value="Pack">Pack</option>
                                                        <option value="Pair">Pair</option>
                                                        <option value="Pallet">Pallet</option>
                                                        <option value="Piece">Piece</option>
                                                        <option value="Pound">Pound</option>
                                                        <option value="Roll">Roll</option>
                                                        <option value="Set">Set</option>
                                                        <option value="Sheet">Sheet</option>
                                                        <option value="Spool">Spool</option>
                                                        <option value="Square Feet">Square Feet</option>
                                                        <option value="Square Meter">Square Meter</option>
                                                        <option value="Ton">Ton</option>
                                                        <option value="Yard">Yard</option>
                                                        <option value="Other" class="other-check">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 other-div add-target_price_unit">
                                            <label class="font-500">Other Price Unit <span
                                                    class="required">*</span></label>
                                            <input type="text" name="other_target_price_unit" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <label class="font-500 d-none">Suitable Currency <span
                                                    class="required">*</span></label>
                                            <select class="form-control single-select-dropdown"
                                                    id="suitable_currencies" name="suitable_currencies" required>
                                                <option value="" selected disabled></option>
                                                <option value="PKR">PKR</option>
                                                <option value="USD">USD</option>
                                                <option value="Euro">Euro</option>
                                                <option value="Yuan">Yuan</option>
                                                <option value="Swiss Franc">Swiss Franc</option>
                                                <option value="JPY">JPY</option>
                                                <option value="Other" class="other-check">Other</option>
                                            </select>
                                            <small class="text-danger" id="suitable_currencies_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 other-div add-suitable-currency">
                                            <label class="font-500">Add Your Suitable Currency <span
                                                    class="required">*</span></label>
                                            <input type="text" name="other_suitable_currency" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1 product_lead_time">
                                            <input type="text" id="lead_time" class="form-control"
                                                   name="delivery_time"
                                                   placeholder="Lead Time (Optional) - Mention Suitable Lead Time">
                                        </div>
                                        <div class="form-group col-md-6 mb-0 product_delivery">
                                            <label class="font-500">Delivery <small
                                                    class="font-500"> (Optional)</small></label>
                                            <div class="d-flex">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input"
                                                           value="Included" id="delivery_included" name="delivery">
                                                    <label class="custom-control-label"
                                                           for="delivery_included">Included</label>
                                                </div>
                                                <div class="custom-control custom-radio ml-3">
                                                    <input type="radio" class="custom-control-input"
                                                           value="Not Included" name="delivery"
                                                           id="delivery_notincluded">
                                                    <label class="custom-control-label"
                                                           for="delivery_notincluded">Not Included</label>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="delivery_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1 services-container">
                                            <label class="label d-none">Service Duration <span
                                                    class="required">*</span></label>
                                            <select id="service_durations" name="service_durations[]"
                                                    class="select2-multiple form-control select-service-duration" multiple="multiple">
                                                <option value="" class="d-none" disabled></option>
                                                <option value="One Time">One Time</option>
                                                <option value="On Call">On Call</option>
                                                <option value="Regular">Regular</option>
                                                <option value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option>
                                                <option value="After 15 Days">After 15 Days</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Annually">Annually</option>
                                                <option value="Other" class="other-check">Other</option>
                                            </select>
                                            <small class="text-danger" id="service_durations_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1 add-services-duration other-div">
                                            <label class="font-500 d-none">Add Your Service Duration <span
                                                    class="required">*</span></label>
                                            <input id="other_service_duration" name="other_service_duration"
                                                   type="text" placeholder="Add Your Service Duration"
                                                   class="form-control">
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <select class="select2-multiple select-suitable-payment form-control payment-terms"
                                                    id="payment_terms" name="payment_terms[]" multiple="multiple"
                                                    required>
                                                <option value="" class="d-none" disabled></option>
                                                <option value="L/C">L/C</option>
                                                <option value="D/A">D/A</option>
                                                <option value="D/P">D/P</option>
                                                <option value="T/T">T/T</option>
                                                <option value="CFR">CFR</option>
                                                <option value="CIF">CIF</option>
                                                <option value="CIP">CIP</option>
                                                <option value="CPT">CPT</option>
                                                <option value="FOB">FOB</option>
                                                <option value="Ex-Works">Ex-Works</option>
                                                <option value="Western Union">Western Union</option>
                                                <option value="PayPal">PayPal</option>
                                                <option value="Other" class="other-check">Other</option>
                                            </select>
                                            <small class="text-danger" id="payment_terms_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 other-div add-payment-terms">
                                            <label class="font-500 d-none">Add Your Payment Terms <span
                                                    class="required">*</span></label>
                                            <input type="text" id="other_payment_term" name="other_payment_term"
                                                   class="form-control" placeholder="Add Your Payment Terms">
                                        </div>
                                    </div>
                                    <div class="mt-3" align="right">
                                        <button type="submit" class="red-btn" disabled>SAVE</button>
                                    </div>
                                    <div class="my-1">
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
    <script type="text/javascript">
        var initial_form_state = $('#myform').serialize();

        $('#createBuysell').submit(function () {
            initial_form_state = $('#createBuysell').serialize();
        });
        $(window).bind('beforeunload', function (e) {
            var form_state = $('#createBuysell').serialize();
            if (initial_form_state != form_state) {
                return 'Are you sure you want to leave?';
            }
        });
        $(document).ready(function () {
            /*for select single place holders*/
            $('select[name="sub_sub_category"]').select2({
                placeholder: "---- Select Product Type ---"
            });

            $('select[name="suitable_currencies"]').select2({
                placeholder: "---- Select Suitable Currency ---"
            });
            /*for select single place holders*/

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

            /*for select multiple place holders*/
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
                placeholder: "Select Service Duration"
            });

            $('.select-suitable-payment').select2({
                placeholder: "Select Payment Terms"
            });
            /*for select multiple place holders*/

            var validator = $("form[name='createBuysell']").validate({
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
                    } else if (elem.hasClass('single-select-dropdown')) {
                        element = elem.closest('.form-group').find('.select2-container--default');
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $('.next-btn').click(function () {
                if ($("form[name='createBuysell']").valid() && myImagesDropzone.getQueuedFiles().length >= 1) {
                    $('.tab-pane.fade.show.active').removeClass('active show');
                    if ($(this).attr('id') == 'nextBtn1') {
                        $(".product-tab-btn").children(".nav-link").removeClass('active');
                        var sellProductcheck = $('#productSell').prop('checked');
                        var serviceProductcheck = $('#productBuy').prop('checked');
                        if (sellProductcheck) {
                            $(".product-tab-btn:first").next().children(".nav-link").addClass('active');
                            // $('.trade-info-tab').addClass('active show');
                            $('.payment-info-tab').addClass('active show');
                        }
                        else if(serviceProductcheck){
                            $(".product-tab-btn:first").next().children(".nav-link").addClass('active');
                            // $('.trade-info-tab').addClass('active show');
                            $('.payment-info-tab').addClass('active show');
                        }
                        else {
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
                    alert("Enter the missing data");
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

                    if (response.feedback == "created") {

                        $(window).off('beforeunload');
                        $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                        mySheetsDropzone.buysellId = response.buysell_id;
                        mySheetsDropzone.processQueue();
                        myImagesDropzone.buysellId = response.buysell_id;
                        myImagesDropzone.processQueue();
                        setTimeout(() => {
                            $("#loader").hide();
                            toastr.success("New product added successfully.");
                             window.location.href = response.url;
                        }, 30000);
                    } else if (response.feedback == "validation_error") {
                        toastr.error("Please enter the required fields.");
                        $form.find('button[type=submit]').prop('disabled', false);

                        $.each(response.errors, function (key, value) {
                            if (key == "width_from" || key == "width_to") {
                                $('#width_error').html(value[0]);
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
                    toastr.error(msg);
                },
            };
            $('#createBuysell').ajaxForm(options);
            Dropzone.autoDiscover = false;
            $(".dropzone").sortable({
                change: function (event, ui) {
                    ui.placeholder.css({visibility: 'visible', border: '2px dashed #673ab75e' });
                }
            });
            var mySheetsDropzone = new Dropzone("div.images-files-drop", {
                buysellId: '',
                url: "{{url('upload-buysell-sheets')}}",
                addRemoveLinks: true,
                dictRemoveFile: '<span class="delete fa fa-trash"></span>',
                autoProcessQueue: false,
                parallelUploads: 15,
                maxThumbnailFilesize: 15,
                maxFilesize: 15,
                maxFiles: 15,
                acceptedFiles: 'image/jpeg,image/png,application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                paramName: "file",
                init: function () {
                    let thisDropzone = this;
                    this.on('sending', function (file, xhr, formData) {
                        formData.append('buysellId', thisDropzone.buysellId);
                        formData.append("_token", "{{ csrf_token() }}");
                    });

                    console.log('init');
                    this.on("maxfilesexceeded", function(file){
                        alert("You cannot upload more than 15 images or files!");
                        this.removeFile(file);
                    });

                    this.on("addedfile", function (data) {
                        console.log(data);

                        var ext = data.name.split('.').pop();

                        if (ext == "pdf") {
                            $(data.previewElement).find(".dz-image img").attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png");
                        } else if (ext.indexOf("doc") != -1) {
                            $(data.previewElement).find(".dz-image img").attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png");
                        } else if (ext.indexOf("xlsx") != -1) {
                            $(data.previewElement).find(".dz-image img").attr("src", "{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png");
                        }
                    });
                }
            });
            var myImagesDropzone = new Dropzone("div.images-drop", {
                buysellId: '',
                url: "{{url('upload-buysell-images')}}",
                addRemoveLinks: true,
                dictRemoveFile: '<span class="delete fa fa-trash"></span>',
                autoProcessQueue: false,
                parallelUploads: 15,
                maxThumbnailFilesize: 15,
                maxFilesize: 15,
                maxFiles: 15,
                acceptedFiles: 'image/jpeg,image/png',
                paramName: "file",
                init: function () {
                    let thisDropzone = this;
                    this.on('sending', function (file, xhr, formData) {
                        formData.append('buysellId', thisDropzone.buysellId);
                        formData.append("_token", "{{ csrf_token() }}");
                    });

                    console.log('init');
                    this.on("maxfilesexceeded", function(file){
                        alert("You cannot upload more than 15 images!");
                        this.removeFile(file);
                    });

                    var submitButton = document.querySelector("#nextBtn1");
                    submitButton.addEventListener("click", function () {
                        if (thisDropzone.getQueuedFiles().length >= 1) {
                            // thisDropzone.processQueue();
                        }
                        else {
                            alert("Atleast Select One Product Image!");
                        }
                    });
                }
            });

            $("#category").on("change", function () {
                $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
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
                        }
                        $("#loader").hide();
                    }
                });
            });
            $("#sub_category").on("change", function () {
                $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                // $('#keyword2').val($('#sub_category option:selected').attr('cat-val'));
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
                        }
                        $("#loader").hide();
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


        });
    </script>
@endpush
