@extends('front_site.master_layout')

@section('content')
    <body class="dashboard">
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->

        <!-- Sidebar -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper">

                <div id='alert-success-create-product' class="alert alert-success py-2" style="display: none;"></div>
                <div id='alert-error-create-product' class="alert alert-danger py-2" style="display: none;"></div>
                <div class="px-2">
                    <div id="companyTab1">
                        <ul class="nav nav-tabs mb-2" id="aboutLinks" role="tablist">
                            <li class="product-tab-btn nav-item">
                                <a class="nav-link active product-service-info" id="linkReg" data-toggle="tab"
                                   href="#tabReg" role="tab"
                                   aria-controls="tabReg" aria-selected="true">Prod Info</a>
                            </li>
                            <li class="product-tab-btn nav-item trade-info">
                                <a class="nav-link" id="linkCom" data-toggle="tab" href="#tabCom" role="tab"
                                   aria-controls="tabCom" aria-selected="false">Trade Info</a>
                            </li>
                            <li class="product-tab-btn nav-item">
                                <a class="nav-link payment-delivery-info" id="linkInfo" data-toggle="tab"
                                   href="#tabInfo" role="tab"
                                   aria-controls="tabInfo" aria-selected="false">Payment</a>
                            </li>
                        </ul>
                        <form id="createProduct" name="createProduct" method="post"
                              action="{{ route('products.store') }}" enctype="multipart/form-data"
                              class="needs-validation" novalidate>
                            @csrf
                            <div class="tab-content" id="myCompanyTab">
                                <div class="px-0 tab-pane fade show active" id="tabReg" role="tabpanel"
                                     aria-labelledby="tabReg">
                                    <div class="form-row">
                                        <div class="form-group col-md-12 mb-1">
                                            <label class="font-500">Post Your Lead As
                                                <span class="required"> *</span>
                                            </label>
                                            <div class="clearfix d-inline">
                                                <a href="#" class="pull-right text-decoration-none red-link font-500 help-txt">Help<span class="ml-1 fa fa-question-circle" aria-hidden="true"></span></a>
                                            </div>
                                            <div class="mt-1 d-flex flex-row">
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
                                                           class="custom-control-input product-buy-sell"
                                                           value="Buy" id="productBuy"
                                                           name="product_service_types[]" onclick="ClearFields();">
                                                    <label class="custom-control-label" for="productBuy">Buyer</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
                                                           class="custom-control-input product-buy-sell"
                                                           value="Sell" id="productSell"
                                                           name="product_service_types[]" onclick="ClearFields();">
                                                    <label class="custom-control-label" for="productSell">Seller</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                    <input type="radio" required
                                                           class="custom-control-input product-buy-sell"
                                                           value="Service" id="productService"
                                                           name="product_service_types[]" onclick="ClearFields();">
                                                    <label class="custom-control-label"
                                                           for="productService">Service Provider</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 mb-1">
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
                                        <div class="form-group col-lg-6 mb-1">
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
                                        <div class="form-group col-lg-6 mb-1 d-flex flex-column subCat-Sec">
                                            <select class="form-control single-select-dropdown sel-pro-type" id="sub_sub_category" name="sub_sub_category"
                                                    required>
                                                <option value="" selected disabled> ---- Select Product Type ---
                                                </option>
                                            </select>

                                            <small class="text-danger" id="sub_sub_category_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 mb-1 add-sub-sub-cat">
                                            <input type="text" name="add_sub_sub_category" class="form-control" placeholder="Add Product Type"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 mb-1 clearfix">
                                            <input type="text" id="subject" maxlength = "80"class="form-control" name="subject"
                                                   placeholder="Subject - It will appear as title" required>
                                            <small class="text-danger" id="subject_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 mb-3 clearfix product-name">
                                            <input type="text" id="product_service_name" maxlength = "50" class="form-control"
                                                   name="product_service_name" placeholder="Product Name - Product Name" required>
                                            <small class="text-danger" id="product_service_name_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 mb-1 product-availability">
                                            <label class="font-500">Product Availability</label>
                                            <div class="d-flex">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio"
                                                           class="custom-control-input product-availability"
                                                           value="Made to order" name="product_availability" id="proImport" required>
                                                    <label class="custom-control-label" for="proImport">Made to
                                                        Order</label>
                                                </div>
                                                <div class="custom-control custom-radio ml-2">
                                                    <input type="radio"
                                                           class="custom-control-input product-availability"
                                                           value="In-Stock" name="product_availability" id="proInStock" required>
                                                    <label class="custom-control-label"
                                                           for="proInStock">In-Stock</label>
                                                </div>
                                                <div class="custom-control custom-radio ml-2">
                                                    <input type="radio"
                                                           class="custom-control-input product-availability"
                                                           value="Both" name="product_availability" id="proBoth" required>
                                                    <label class="custom-control-label"
                                                           for="proBoth">Both</label>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="product_availability_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 mb-0">
                                            <div class="form-row">
                                                <div class="form-group col-md-4 mb-1">
                                                    <input type="text" id="keyword1" name="keyword1"
                                                           class="form-control" placeholder="Additional Keyword (Optional) - Keyword 1">
                                                </div>
                                                <div class="form-group col-md-4 mb-1">
                                                    <input type="text" id="keyword2" name="keyword2"
                                                           class="form-control" placeholder="Additional Keyword (Optional) - Keyword 2">
                                                </div>
                                                <div class="form-group col-md-4 mb-1">
                                                    <input type="text" id="keyword3" name="keyword3"
                                                           class="form-control" placeholder="Additional Keyword (Optional) - Keyword 3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 mb-1">
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
                                        <div class="form-group col-lg-6 mb-1">
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
                                        <div class="form-group col-lg-6 mb-1">
                                            <input type="text" id="manufacturer_name"
                                                   value="{{$userCompany->company_name}}" name="manufacturer_name"
                                                   class="form-control manufacturer-name optional-field"
                                                   placeholder="Manufacturer Name (optional) - Manufacture spelling must be correct to be visible in the search.">
                                        </div>
                                        <div class="form-group col-lg-6 mb-1">
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

                                    <div class="additional-product-info fibre-info" style="display: none">
                                        <span class="d-block heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mt-1 mb-0">
                                                <label class="d-block font-500">Fibre Type <span
                                                        class="required"> *</span></label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="dyed-greige-Other custom-control-input radio-btn"
                                                           id="purposeDyed" value="Dyed" name="purpose"
                                                           required>
                                                    <label class="custom-control-label"
                                                           for="purposeDyed">Dyed</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="dyed-greige-Other custom-control-input radio-btn"
                                                           value="Greige"
                                                           id="purposeGreige" name="purpose" required>
                                                    <label class="custom-control-label"
                                                           for="purposeGreige">Greige</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="dyed-greige-Other custom-control-input radio-btn"
                                                           value="Other"
                                                           id="purposeOther" name="purpose" required>
                                                    <label class="custom-control-label"
                                                           for="purposeOther">Other</label>
                                                </div>
                                                <small class="text-danger" id="purpose_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 mb-1 other-div">
                                                <input type="text" name="other_purpose" class="form-control" placeholder="Other Fibre Type"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <input type="text" id="size" class="form-control"
                                                       name="size" placeholder="Fibre Size/Length - e.g. 1-2 cm,2-3 cm,3-4 cm,4+ cm, Other"
                                                       required>
                                                <small class="text-danger" id="size_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <input type="text" id="strength" class="form-control optional-field"
                                                       name="strength" placeholder="Tensile Strength (Optional) - e.g. Tenacity, Breaking, Extension, Work Of Rupture, Other">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <input type="text" id="end_app" class="form-control optional-field"
                                                       name="end_app" placeholder="End Use Application (Optional) - e.g. Open End, Ring, Non-Woven, Other">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info Yarn-info" style="display: none;">
                                        <span class="d-block my-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <input name="yarn_count" class="form-control" placeholder="Yarn Count - i.e 20 Ne,80 Ne, 50 Dtex, 150 Danier, Other" required>
                                                <small class="text-danger" id="yarn_count_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <select id="yarn_count_unit" name="yarn_count_unit" placeholder="Yarn Count Unit" class="form-control single-select-dropdown" required>
                                                    <option value selected disabled>Select Yarn Count Unit</option>
                                                    <option value="Ne">Ne</option>
                                                    <option value="Nm">Nm</option>
                                                    <option value="Lea">Lea</option>
                                                    <option value="YSW">YSW</option>
                                                    <option value="NeK">NeK</option>
                                                    <option value="Denier">Denier</option>
                                                    <option value="Tex">Tex</option>
                                                    <option value="Mtex">Mtex</option>
                                                    <option value="Dtex">Dtex</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <small class="text-danger" id="yarn_count_unit_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <input type="text" name="other_yarn_count_unit" placeholder="Other Count Unit" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="font-500">Yarn Attribute<span
                                                        class="required"> *</span></label>
                                                <select id="yarn_attribute" name="yarn_attribute"
                                                        class="form-control single-select-dropdown"
                                                        required>
                                                    <option value="" selected disabled></option>
                                                    <option value="Greige">Greige</option>
                                                    <option value="RFD">RFD</option>
                                                    <option value="Dyed">Dyed</option>
                                                    <option value="Semi Dull">Semi Dull</option>
                                                    <option value="Full Dull">Full Dull</option>
                                                    <option value="Optical White">Optical White</option>
                                                    <option value="Bright">Bright</option>
                                                    <option value="Dope Dyed">Dope Dyed</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <small class="text-danger" id="yarn_attribute_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <input type="text" name="other_yarn_attribute" placeholder="Other Yarn Attribute" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <select id="yarn_technology" name="yarn_technology"
                                                        class="form-control single-select-dropdown"
                                                        required>
                                                    <option value="" selected disabled></option>
                                                    <option value="Ring">Ring</option>
                                                    <option value="Rotor">Rotor</option>
                                                    <option value="Jet/MJS">Jet/MJS</option>
                                                    <option value="Vortex/MVS">Vortex/MVS</option>
                                                    <option value="Open End">Open End</option>
                                                    <option value="Siro">Siro</option>
                                                    <option value="Dry Spinning">Dry Spinning</option>
                                                    <option value="Wet Spinning">Wet Spinning</option>
                                                    <option value="Melt">Melt</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <small class="text-danger" id="yarn_technology_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <input type="text" name="other_yarn_technology" placeholder="Other Technology" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <input name="yarn_grade" class="form-control" placeholder="Yarn Grade - i.e A-Grade, B-Grade, Other"
                                                       required>
                                                <small class="text-danger" id="yarn_grade_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <input type="text" id="tpi" name="tpi" class="form-control optional-field" placeholder="TPI (Optional) (Twist Per Inch) i.e Mention TPI">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <input type="text" id="tenacity" name="tenacity" class="form-control optional-field" placeholder="Tenacity (Optional) - i.e Mention Yarn Tenacity">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="d-block font-500" for="count_type">Count Type <span
                                                        class="required"> *</span></label>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               id="countSingle" value="Single" name="count_type"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="countSingle">Single</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               id="countDouble" value="Double" name="count_type"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="countDouble">Double</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline count_typeTexturised">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               id="countTriple" value="Triple" name="count_type"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="countTriple">Triple</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-radio custom-control-inline count_typeTexturised">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               id="countQuadruple" value="Quadruple"
                                                               name="count_type"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="countQuadruple">Quadruple</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-radio custom-control-inline count_typeTexturised">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               id="countOther" value="Other" name="count_type"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="countOther">Other</label>
                                                    </div>
                                                <small class="text-danger" id="count_type_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <input type="text" name="other_count_type" class="form-control" placeholder="Other Count Type"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="d-block font-500">Yarn Speciality <span
                                                        class="required"> *</span></label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="yarnRegular" value="Regular"
                                                           name="yarn_specialty"
                                                           required>
                                                    <label class="custom-control-label"
                                                           for="yarnRegular">Regular</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline yarn_specialtyTexturised">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="yarnBCI"
                                                           name="yarn_specialty" value="BCI" required>
                                                    <label class="custom-control-label"
                                                           for="yarnBCI">BCI</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline yarn_specialtyTexturised">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="yarnOrganic" value="Organic"
                                                           name="yarn_specialty"
                                                           required>
                                                    <label class="custom-control-label"
                                                           for="yarnOrganic">Organic</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline yarn_specialtyTexturised">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="yarnCotton"
                                                           value="Imported cotton" name="yarn_specialty"
                                                           required>
                                                    <label class="custom-control-label" for="yarnCotton">Imported
                                                        cotton</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline yarn_specialtyTexturised">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="yarnOther"
                                                           name="yarn_specialty" value="Other" required>
                                                    <label class="custom-control-label"
                                                           for="yarnOther">Other</label>
                                                </div>
                                                <small class="text-danger" id="yarn_specialty_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <label class="font-500">Other Yarn Speciality <span class="required"> *</span></label>
                                                <input type="text" name="other_yarn_speciality" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="d-block font-500">End Use/Application <span
                                                        class="required"> *</span></label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="usageWrap"
                                                           name="usage_type" value="Warp" required>
                                                    <label class="custom-control-label"
                                                           for="usageWrap">Warp</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="usageWeft"
                                                           name="usage_type" value="Weft" required>
                                                    <label class="custom-control-label"
                                                           for="usageWeft">Weft</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="usageKnitting"
                                                           name="usage_type" value="Knitting" required>
                                                    <label class="custom-control-label"
                                                           for="usageKnitting">Knitting</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="usageHandKnitting"
                                                           name="usage_type" value="Hand Knitting" required>
                                                    <label class="custom-control-label"
                                                           for="usageHandKnitting">Hand Knitting</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="usageWeaving"
                                                           name="usage_type" value="Weaving" required>
                                                    <label class="custom-control-label"
                                                           for="usageWeaving">Weaving</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="usageBraiding"
                                                           name="usage_type" value="Braiding" required>
                                                    <label class="custom-control-label"
                                                           for="usageBraiding">Braiding</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="usageCordage"
                                                           name="usage_type" value="Cordage" required>
                                                    <label class="custom-control-label"
                                                           for="usageCordage">Cordage</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="usageSewing"
                                                           name="usage_type" value="Sewing" required>
                                                    <label class="custom-control-label"
                                                           for="usageSewing">Sewing</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="usageCarpet"
                                                           name="usage_type" value="Carpet" required>
                                                    <label class="custom-control-label"
                                                           for="usageCarpet">Carpet</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="usageOther"
                                                           name="usage_type" value="Other" required>
                                                    <label class="custom-control-label"
                                                           for="usageOther">Other</label>
                                                </div>
                                                <small class="text-danger" id="usage_type_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <label class="font-500">Other End Use/Application <span class="required"> *</span></label>
                                                <input type="text" name="other_usage_type" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info knitted-fabric-info" style="display: none;">
                                        <span class="d-block my-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 fabric-type">
                                                <label class="font-500">Fabric Type <span
                                                        class="required">*</span></label>
                                                <select id="knitted_fabric_types" name="knitted_fabric_types"
                                                        class="form-control single-select-dropdown" required>
                                                    <option value selected disabled>Select Fabric Type</option>
                                                    <option value="Greige">Greige</option>
                                                    <option value="Dyed">Dyed</option>
                                                    <option value="Yarn Dyed">Yarn Dyed</option>
                                                    <option value="Melange">Melange</option>
                                                    <option value="Printed">Printed</option>
                                                    <option value="Embroidered">Embroidered</option>
                                                    <option value="Other" id="other_fabric"
                                                            class="other-check">Other</option>
                                                </select>
                                                <small class="text-danger" id="knitted_fabric_types_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <label class="font-500">Other Fabric Type <span class="required"> *</span></label>
                                                <input type="text" name="other_knitted_fabric_type" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 weave-type">
                                                <label class="font-500">Knitting Type <span
                                                        class="required">*</span></label>
                                                <select name="knitted_knitting_types"
                                                        class="form-control single-select-dropdown" required>
                                                    <option value selected disabled>Select Knitting Type</option>
                                                    <option value="Warp">Warp</option>
                                                    <option value="Weft">Weft</option>
                                                    <option value="Circular">Circular</option>
                                                    <option value="Single Jersey">Single Jersey</option>
                                                    <option value="Double Jersey">Double Jersey</option>
                                                    <option value="Other" class="other-check">Other</option>
                                                </select>
                                                <small class="text-danger" id="weave_types_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <label class="font-500">Other Knitting Type <span class="required"> *</span></label>
                                                <input type="text" name="other_knitted_knitting_type" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="knitted_fabric_construction" class="font-500">Fabric Construction <span class="required"> *</span></label>
                                                <input type="text" id="knitted_fabric_construction" class="form-control"
                                                       name="knitted_fabric_construction" placeholder="e.g. 80*80/100*80, Other" required>
                                                <small class="text-danger" id="knitted_fabric_construction_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="knitted_gsm_thickness" class="font-500">GSM/Thickness <span class="required"> *</span></label>
                                                <input type="text" id="knitted_gsm_thickness" class="form-control"
                                                       name="knitted_gsm_thickness" placeholder="e.g. 75 GSM,150 GSM, Other"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="knitted_fabric_composition" class="font-500">Fabric Composition<small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="knitted_fabric_composition" class="form-control optional-field"
                                                       name="knitted_fabric_composition" placeholder="e.g. 60% Cotton, 40% Polyester, Other">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="knitted_width" class="font-500">Width Range <span
                                                        class="required">*</span></label>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <input type="text" id="knitted_width_from" class="form-control"
                                                               name="knitted_width_from" placeholder="e.g. 75 Inches"
                                                               required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" id="knitted_width_to" class="form-control"
                                                               name="knitted_width_to" placeholder="e.g. 105 Inches"
                                                               required>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="knitted_width_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="d-block font-500">Manufacturing Technique<span class="required"> *</span></label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedHandLoom" name="knitted_manufact" value="Hand Loom"
                                                           required>
                                                    <label class="custom-control-label" for="knittedHandLoom">Hand
                                                        Loom</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedAutoLoom" name="knitted_manufact" value="Auto Loom"
                                                           required>
                                                    <label class="custom-control-label" for="knittedAutoLoom">Auto
                                                        Loom</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedAirJet" name="knitted_manufact" value="Air Jet" required>
                                                    <label class="custom-control-label" for="knittedAirJet">Air Jet</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedWeavingRapier" name="knitted_manufact" value="Rapier" required>
                                                    <label class="custom-control-label"
                                                           for="knittedWeavingRapier">Rapier</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedWaterJet" name="knitted_manufact" value="Water Jet" required>
                                                    <label class="custom-control-label" for="knittedWaterJet">Water Jet</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedCircularKnit" name="knitted_manufact" value="Circular Knit" required>
                                                    <label class="custom-control-label" for="knittedCircularKnit">Circular Knit</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedBounded" name="knitted_manufact" value="Bounded" required>
                                                    <label class="custom-control-label" for="knittedBounded"> Bounded</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedOther" name="knitted_manufact" value="Other" required>
                                                    <label class="custom-control-label"
                                                           for="knittedOther">Other</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           id="knittedAny" name="knitted_manufact" value="Any" required>
                                                    <label class="custom-control-label"
                                                           for="knittedAny">Any</label>
                                                </div>
                                                <small class="text-danger" id="knitted_manufact_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <label class="font-500">Other Manufacturing Technique <span class="required"> *</span></label>
                                                <input type="text" id="other_knitted_manufact" name="other_knitted_manufact"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group weaving-checkbox col-lg-6 mb-0">
                                                <label class="font-500">Yarn Type<span class="required"> *</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Carded" id="knittedCarded" name="knitted_yarn"
                                                               required>
                                                        <label class="custom-control-label" for="knittedCarded">Carded
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Combed" id="knittedCombed" name="knitted_yarn"
                                                               required>
                                                        <label class="custom-control-label" for="knittedCombed">Combed</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Both"
                                                               id="knittedBoth" name="knitted_yarn" required>
                                                        <label class="custom-control-label" for="knittedBoth">Both</label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Other"
                                                               id="knittedWeavingOther" name="knitted_yarn" required>
                                                        <label class="custom-control-label"
                                                               for="knittedWeavingOther">Other</label>
                                                    </div>

                                                </div>
                                                <small class="text-danger" id="knitted_yarn_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <label class="font-500">Other Yarn Type <span class="required"> *</span></label>
                                                <input type="text" id="other_knitted_yarn_type" name="other_knitted_yarn_type"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="font-500">Features <span class="required"> *</span></label>
                                                <div class="">
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check" name="knitted_features[]"
                                                               id="knittedFeaturesAntiStatic" value="Anti Static" required>
                                                        <label class="custom-control-label" for="knittedFeaturesAntiStatic">Anti
                                                            Static</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input Use-check" name="knitted_features[]"
                                                               id="knittedFeaturesAntiUV" value="Anti UV" required>
                                                        <label class="custom-control-label" for="knittedFeaturesAntiUV">Anti
                                                            UV</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check" name="knitted_features[]"
                                                               id="knittedFeaturesFlameRetardent" value="Flame Retardent" required>
                                                        <label class="custom-control-label"
                                                               for="knittedFeaturesFlameRetardent">Flame Retardent</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check" name="knitted_features[]"
                                                               id="knittedFeaturesWaterProof" value="Water Proof" required>
                                                        <label class="custom-control-label" for="knittedFeaturesWaterProof">Water
                                                            Proof</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check" name="knitted_features[]"
                                                               id="knittedFeaturesTearResistnat" value="Tear Resistant" required>
                                                        <label class="custom-control-label" for="knittedFeaturesTearResistnat">Tear
                                                            Resistant</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check" name="knitted_features[]"
                                                               id="knittedFeaturesResistant" value="Shrink Resistant" required>
                                                        <label class="custom-control-label" for="knittedFeaturesResistant">Shrink
                                                            Resistant</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check" name="knitted_features[]"
                                                               id="knittedFeaturesRinkle" value="Rinkle Free" required>
                                                        <label class="custom-control-label" for="knittedFeaturesRinkle">Rinkle
                                                            Free</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input knitted-feature-use-check-other" name="knitted_features[]"
                                                               id="knittedFeaturesOther" value="Other" required>
                                                        <label class="custom-control-label"
                                                               for="knittedFeaturesOther">Other</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check" name="knitted_features[]"
                                                               id="knittedFeaturesNone" value="None" required>
                                                        <label class="custom-control-label"
                                                               for="knittedFeaturesNone">None</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="knitted_features_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 add-knitted-features-field other-div">
                                                <label class="font-500">Other Features <span
                                                        class="required">*</span></label>
                                                <input name="other_knitted_features" id="knittedFeaturesOther" type="text"
                                                       class="form-control" required>
                                                <small class="text-danger" id="knittedFeaturesOther_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="d-block font-500">End Use/Application <span class="required"> *</span></label>
                                                <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check" name="knitted_use[]"
                                                           id="knittedUseGarment" value="Garment" required>
                                                    <label class="custom-control-label"
                                                           for="knittedUseGarment">Garments</label>
                                                </div>
                                                <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check" name="knitted_use[]"
                                                           id="knittedUseDress" value="Dress" required>
                                                    <label class="custom-control-label" for="knittedUseDress">Dress</label>
                                                </div>
                                                <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check" name="knitted_use[]"
                                                           id="knittedUseLining" value="Lining" required>
                                                    <label class="custom-control-label"
                                                           for="knittedUseLining">Lining</label>
                                                </div>
                                                <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check" name="knitted_use[]"
                                                           id="knittedUseSports" value="Sports wear" required>
                                                    <label class="custom-control-label" for="knittedUseSports">Sports
                                                        wear</label>
                                                </div>

                                                <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check" name="knitted_use[]"
                                                           id="knittedUseGarments" value="Under garments" required>
                                                    <label class="custom-control-label" for="knittedUseGarments">Under
                                                        Garments</label>
                                                </div>
                                                <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check" name="knitted_use[]"
                                                           id="knittedUseTextile" value="Home Textiles" required>
                                                    <label class="custom-control-label"
                                                           for="knittedUseTextile">Home Textiles</label>
                                                </div>

                                                <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check" name="knitted_use[]"
                                                           id="knittedUseShoesBags" value="Shoes & Bags" required>
                                                    <label class="custom-control-label" for="knittedUseShoesBags">Shoes & Bags</label>
                                                </div>
                                                <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check" name="knitted_use[]"
                                                           id="knittedUseAccessories" value="Accessories" required>
                                                    <label class="custom-control-label"
                                                           for="knittedUseAccessories">Accessories</label>
                                                </div>
                                                <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox"
                                                           class="custom-control-input knitted-use-check-other" name="knitted_use[]"
                                                           id="knittedUseOther" value="Other" required>
                                                    <label class="custom-control-label" for="knittedUseOther">Other</label>
                                                </div>
                                                <small class="text-danger" id="knitted_use_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 add-knitted-Use-field">
                                                <label class="font-500">Other End Use Application <span
                                                        class="required">*</span></label>
                                                <input name="other_knitted_use" id="otherKnittedUse" type="text" class="form-control"
                                                       required>
                                                <small class="text-danger" id="otherKnittedUse_error"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info fabric-info" style="display: none;">
                                        <span class="d-block my-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 fabric-type">
                                                <select id="woven_fabric_types" name="woven_fabric_types" class="form-control single-select-dropdown" required>
                                                    <option value="" selected disabled></option>
                                                    <option value="Greige">Greige</option>
                                                    <option value="Dyed">Dyed</option>
                                                    <option value="Yarn Dyed">Yarn Dyed</option>
                                                    <option value="Melange">Melange</option>
                                                    <option value="Printed">Printed</option>
                                                    <option value="Embroidered">Embroidered</option>
                                                    <option value="Other" id="other_woven_fabric" class="other-check">Other</option>
                                                </select>
                                                <small class="text-danger" id="woven_fabric_types_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <input type="text" name="other_woven_fabric_type" placeholder="Other Woven Fabric Type" class="form-control">
                                                <small class="text-danger" id="other_woven_fabric_type_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 weave-type">
                                                <select id="woven_weave_types" name="woven_weave_types" class="form-control single-select-dropdown" required>
                                                    <option value="" selected disabled></option>
                                                    <option value="Plain">Plain</option>
                                                    <option value="Twill">Twill</option>
                                                    <option value="Satin">Satin</option>
                                                    <option value="Dobby">Dobby</option>
                                                    <option value="Jacquard">Jacquard</option>
                                                    <option value="Herringbone">Herringbone</option>
                                                    <option value="Rib">Rib</option>
                                                    <option value="Slub">Slub</option>
                                                    <option value="Stripe">Stripe</option>
                                                    <option value="Interlock">Interlock</option>
                                                    <option value="Rip Stop">Rip Stop</option>
                                                    <option value="Other" id="other_woven_weave" class="other-check">Other</option>
                                                </select>
                                                <small class="text-danger" id="woven_weave_types_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div">
                                                <input type="text" name="other_woven_weave_type" class="form-control" placeholder="Other Woven Weave Type">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <input type="text" id="woven_fabric_construction" class="form-control"
                                                       name="woven_fabric_construction" placeholder="Fabric Construction - e.g. 80*80/100*80, Other"
                                                       required>
                                                <small class="text-danger" id="woven_fabric_construction_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <input type="text" id="woven_gsm_thickness" class="form-control"
                                                       name="woven_gsm_thickness" placeholder="GSM/Thickness - e.g. 75 GSM,150 GSM, Other"
                                                       required>
                                                <small class="text-danger" id="woven_gsm_thickness"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <input type="text" id="woven_fabric_composition" class="form-control optional-field"
                                                       name="woven_fabric_composition" placeholder="Fabric Composition (Optional) - e.g. 60% Cotton, 40% Polyester, Other">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-1">
                                                        <input type="text" id="woven_width_from" class="form-control"
                                                               name="woven_width_from" placeholder="Width Range From - e.g. 75 Inches"
                                                               required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" id="woven_width_to" class="form-control"
                                                               name="woven_width_to" placeholder="Width Range To - e.g. 105 Inches"
                                                               required>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="woven_width_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group weaving-checkbox col-lg-6 mb-0">
                                                <label class="font-500">Manufacturing Technique<span class="required"> *</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Auto Loom" id="wovenAutoLoom" name="woven_manufact"
                                                               required>
                                                        <label class="custom-control-label" for="wovenAutoLoom">Auto
                                                            Loom</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Shuttleless Loom" id="wovenShuttlelessLoom" name="woven_manufact"
                                                               required>
                                                        <label class="custom-control-label" for="wovenShuttlelessLoom">Shuttleless Loom</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Air Jet"
                                                               id="wovenAirJet" name="woven_manufact" required>
                                                        <label class="custom-control-label" for="wovenAirJet">Air Jet</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Rapier"
                                                               id="wovenWeavingRapier" name="woven_manufact" required>
                                                        <label class="custom-control-label"
                                                               for="wovenWeavingRapier">Rapier</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Water Jet"
                                                               id="wovenWaterJet" name="woven_manufact" required>
                                                        <label class="custom-control-label" for="wovenWaterJet">Water Jet</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Circular Knit"
                                                               id="wovenCircularKnit" name="woven_manufact" required>
                                                        <label class="custom-control-label" for="wovenCircularKnit">Circular Knit</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Bounded"
                                                               id="wovenBounded" name="woven_manufact" required>
                                                        <label class="custom-control-label" for="wovenBounded"> Bounded</label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Other"
                                                               id="wovenOther" name="woven_manufact" required>
                                                        <label class="custom-control-label"
                                                               for="wovenOther">Other</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Any"
                                                               id="wovenAny" name="woven_manufact" required>
                                                        <label class="custom-control-label"
                                                               for="wovenAny">Any</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="woven_manufact_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div" id="addWovenOtherWeaving">
                                                <input type="text" id="other_woven_manufact" name="other_woven_manufact" placeholder="Other Manufacturing Technique"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group weaving-checkbox col-lg-6 mb-0">
                                                <label class="font-500">Yarn Type<span class="required"> *</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Carded" id="wovenCarded" name="woven_yarn"
                                                               required>
                                                        <label class="custom-control-label" for="wovenCarded">Carded
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Combed" id="wovenCombed" name="woven_yarn"
                                                               required>
                                                        <label class="custom-control-label" for="wovenCombed">Combed</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Both"
                                                               id="wovenBoth" name="woven_yarn" required>
                                                        <label class="custom-control-label" for="wovenBoth">Both</label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Other"
                                                               id="wovenYarnOther" name="woven_yarn" required>
                                                        <label class="custom-control-label"
                                                               for="wovenYarnOther">Other</label>
                                                    </div>

                                                </div>
                                                <small class="text-danger" id="woven_yarn_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div" id="otherWovenWeaving">
                                                <input type="text" id="other_woven_yarn" name="other_woven_yarn" placeholder="Other Yarn Type"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="font-500">Features <span class="required"> *</span></label>
                                                <div class="">
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="wovenFeaturesAntiStatic" value="Anti Static"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label" for="wovenFeaturesAntiStatic">Anti
                                                            Static</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="wovenFeaturesAntiUV" value="Anti UV"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label" for="wovenFeaturesAntiUV">Anti
                                                            UV</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="wovenFeaturesFlameRetardent" value="Flame Retardent"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="wovenFeaturesFlameRetardent">Flame Retardent</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="wovenFeaturesWaterProof" value="Water Proof"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label" for="wovenFeaturesWaterProof">Water
                                                            Proof</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="wovenFeaturesTearResistnat" value="Tear Resistant"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label" for="wovenFeaturesTearResistnat">Tear
                                                            Resistant</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="wovenFeaturesResistant" value="Shrink Resistant"
                                                               name="woven_features[]" required>
                                                        <label class="custom-control-label" for="wovenFeaturesResistant">Shrink
                                                            Resistant</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="wovenFeaturesRinkle" value="Rinkle Free" name="woven_features[]"
                                                               required>
                                                        <label class="custom-control-label" for="wovenFeaturesRinkle">Rinkle
                                                            Free</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check-other"
                                                               id="wovenFeaturesOther" value="Other" name="woven_features[]"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="wovenFeaturesOther">Other</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input features-check-none" value="None"
                                                               id="woven_featuresNone" name="woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="woven_featuresNone">None</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="woven_features_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 add-features-field">
                                                <input id="other_woven_features" name="other_woven_features" type="text" placeholder="Other Features"
                                                       class="form-control" required>
                                                <small class="text-danger" id="other_woven_features_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="d-block font-500">End Use/Application <span class="required"> *</span></label>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseGarment" value="Garment" name="woven_use[]" required>
                                                    <label class="custom-control-label"
                                                           for="wovenUseGarment">Garments</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseDress" value="Dress" name="woven_use[]" required>
                                                    <label class="custom-control-label" for="wovenUseDress">Dress</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseLining" value="Lining" name="woven_use[]" required>
                                                    <label class="custom-control-label"
                                                           for="wovenUseLining">Lining</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseSports" value="Sports wear" name="woven_use[]"
                                                           required>
                                                    <label class="custom-control-label" for="wovenUseSports">Sports
                                                        wear</label>
                                                </div>

                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseGarments" value="Under garments" name="woven_use[]"
                                                           required>
                                                    <label class="custom-control-label" for="wovenUseGarments">Under
                                                        Garments</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseHomeTextile" value="Home Textiles" name="woven_use[]" required>
                                                    <label class="custom-control-label"
                                                           for="wovenUseHomeTextile">Home Textiles</label>
                                                </div>

                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseShoesBags" value="Shoes & Bags" name="woven_use[]" required>
                                                    <label class="custom-control-label" for="wovenUseShoesBags">Shoes & Bags</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input Use-check"
                                                           id="wovenUseAccessories" value="Accessories" name="woven_use[]" required>
                                                    <label class="custom-control-label"
                                                           for="wovenUseAccessories">Accessories</label>
                                                </div>
                                                <div
                                                    class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox"
                                                           class="custom-control-input Use-check-other"
                                                           id="wovenUseOther" value="Other" name="woven_use[]" required>
                                                    <label class="custom-control-label" for="wovenUseOther">Other</label>
                                                </div>
                                                <small class="text-danger" id="woven_use_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 add-Use-field">
                                                <input id="other_woven_use" name="other_woven_use" type="text" class="form-control" placeholder="Other End Use/Application"
                                                       required>
                                                <small class="text-danger" id="other_woven_use_error"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info non-woven-fabric-info" style="display: none;">
                                        <span class="d-block my-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 fabric-type">
                                                <label class="font-500">Fabric Type <span
                                                        class="required">*</span></label>
                                                <select id="non_woven_fabric_types" name="non_woven_fabric_types"
                                                        class="form-control single-select-dropdown" required>
                                                    <option value selected disabled>Select Fabric Type</option>
                                                    <option value="Greige">Greige</option>
                                                    <option value="Dyed">Dyed</option>
                                                    <option value="Yarn Dyed">Yarn Dyed</option>
                                                    <option value="Melange">Melange</option>
                                                    <option value="Printed">Printed</option>
                                                    <option value="Embroidered">Embroidered</option>
                                                    <option value="Other" id="other_non_wovenfabric"
                                                            class="other-check">Other</option>
                                                </select>
                                                <small class="text-danger" id="non_woven_fabric_types_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div add-fabric-type">
                                                <label class="font-500">Other Fabric Type <span class="required"> *</span></label>
                                                <input type="text" name="other_non_woven_fabric_type" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 weave-type">
                                                <label class="font-500">Non Woven Type <span
                                                        class="required">*</span></label>
                                                <select id="non_woven_types" name="non_woven_types"
                                                        class="form-control single-select-dropdown" required>
                                                    <option value selected disabled>Select Woven Type</option>
                                                    <option value="Spun Lace">Spun Lace</option>
                                                    <option value="Composite">Composite</option>
                                                    <option value="PP Needle Felt">PP Needle Felt</option>
                                                    <option value="PP Spun Bonded">PP Spun Bonded</option>
                                                    <option value="PP Non Woven">PP Non Woven</option>
                                                    <option value="Chemical Bounded">Chemical Bounded</option>
                                                    <option value="Other" id="other_fabric"
                                                            class="other-check">Other</option>
                                                </select>
                                                <small class="text-danger" id="non_woven_types_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div add-fabric-type">
                                                <label class="font-500">Other Type <span class="required"> *</span></label>
                                                <input type="text" name="other_non_woven_type" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="non_woven_fabric_construction" class="font-500">Fabric Construction <span class="required"> *</span></label>
                                                <input type="text" id="non_woven_fabric_construction" class="form-control"
                                                       name="non_woven_fabric_construction" placeholder="e.g. 80*80/100*80, Other"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="non_woven_gsm_thickness" class="font-500">GSM/Thickness <span class="required"> *</span></label>
                                                <input type="text" id="non_woven_gsm_thickness" class="form-control"
                                                       name="non_woven_gsm_thickness" placeholder="e.g. 75 GSM,150 GSM, Other"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="non_woven_fabric_composition" class="font-500">Fabric Composition<small class="font-500"> (Optional)</small></label>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <input type="text" id="non_woven_fabric_composition" class="form-control optional-field"
                                                               name="non_woven_fabric_composition" placeholder="e.g. 60% Cotton, 40% Polyester, Other">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="non_woven_width" class="font-500">Width Range <span
                                                        class="required">*</span></label>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <input type="text" id="non_woven_width_from" class="form-control"
                                                               name="non_woven_width_from" placeholder="e.g. 75 Inches"
                                                               required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" id="non_woven_width_to" class="form-control"
                                                               name="non_woven_width_to" placeholder="e.g. 105 Inches"
                                                               required>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="non_woven_width_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group weaving-checkbox col-lg-6 mb-0">
                                                <label class="d-block font-500">Manufacturing Technique<span class="required"> *</span></label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           value="Hand Loom" id="non_wovenHandLoom" name="non_woven_manufact"
                                                           required>
                                                    <label class="custom-control-label" for="non_wovenHandLoom">Hand
                                                        Loom</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn"
                                                           value="Auto Loom" id="non_wovenAutoLoom" name="non_woven_manufact"
                                                           required>
                                                    <label class="custom-control-label" for="non_wovenAutoLoom">Auto
                                                        Loom</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn" value="Air Jet"
                                                           id="non_wovenAirJet" name="non_woven_manufact" required>
                                                    <label class="custom-control-label" for="non_wovenAirJet">Air Jet</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn" value="Rapier"
                                                           id="non_wovenRapier" name="non_woven_manufact" required>
                                                    <label class="custom-control-label"
                                                           for="non_wovenRapier">Rapier</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn" value="Water Jet"
                                                           id="non_wovenWaterJet" name="non_woven_manufact" required>
                                                    <label class="custom-control-label" for="non_wovenWaterJet">Water Jet</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn" value="Circular Knit"
                                                           id="non_wovenCircularKnit" name="non_woven_manufact" required>
                                                    <label class="custom-control-label" for="non_wovenCircularKnit">Circular Knit</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn" value="Bounded"
                                                           id="non_wovenBounded" name="non_woven_manufact" required>
                                                    <label class="custom-control-label" for="non_wovenBounded"> Bounded</label>
                                                </div>

                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn" value="Other"
                                                           id="non_wovenOther" name="non_woven_manufact" required>
                                                    <label class="custom-control-label"
                                                           for="non_wovenOther">Other</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input radio-btn" value="Any"
                                                           id="non_wovenAny" name="non_woven_manufact" required>
                                                    <label class="custom-control-label"
                                                           for="non_wovenAny">Any</label>
                                                </div>
                                                <small class="text-danger" id="non_woven_manufact_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div" id="addNonWovenOtherWeaving">
                                                <label class="font-500">Other Manufacturing Technique <span class="required"> *</span></label>
                                                <input type="text" id="other_non_woven_manufact" name="other_non_woven_manufact"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group weaving-checkbox col-lg-6 mb-0">
                                                <label class="font-500">Yarn Type<span class="required"> *</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Carded" id="non_wovenCarded" name="non_woven_yarn"
                                                               required>
                                                        <label class="custom-control-label" for="non_wovenCarded">Carded
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn"
                                                               value="Combed" id="non_wovenCombed" name="non_woven_yarn"
                                                               required>
                                                        <label class="custom-control-label" for="non_wovenCombed">Combed</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Both"
                                                               id="non_wovenBoth" name="non_woven_yarn" required>
                                                        <label class="custom-control-label" for="non_wovenBoth">Both</label>
                                                    </div>

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input radio-btn" value="Other"
                                                               id="non_wovenYarnOther" name="non_woven_yarn" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenYarnOther">Other</label>
                                                    </div>

                                                </div>
                                                <small class="text-danger" id="non_woven_yarn_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 other-div" id="addOtherNonWovenWeaving">
                                                <label class="font-500">Other Yarn Type <span class="required"> *</span></label>
                                                <input type="text" id="other_non_woven_yarn" name="other_non_woven_yarn"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="font-500">Features <span class="required"> *</span></label>
                                                <div class="">
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="non_wovenFeaturesAntiStatic" value="Anti Static"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label" for="non_wovenFeaturesAntiStatic">Anti
                                                            Static</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="non_wovenFeaturesAntiUV" value="Anti UV"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label" for="non_wovenFeaturesAntiUV">Anti
                                                            UV</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="non_wovenFeaturesFlameRetardent" value="Flame Retardent"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesFlameRetardent">Flame Retardent</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="non_wovenFeaturesWaterProof" value="Water Proof"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label" for="non_wovenFeaturesWaterProof">Water
                                                            Proof</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="non_wovenFeaturesTearResistnat" value="Tear Resistant"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label" for="non_wovenFeaturesTearResistnat">Tear
                                                            Resistant</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="non_wovenFeaturesResistant" value="Shrink Resistant"
                                                               name="non_woven_features[]" required>
                                                        <label class="custom-control-label" for="non_wovenFeaturesResistant">Shrink
                                                            Resistant</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input features-check"
                                                               id="non_wovenFeaturesRinkle" value="Rinkle Free" name="non_woven_features[]"
                                                               required>
                                                        <label class="custom-control-label" for="non_wovenFeaturesRinkle">Rinkle
                                                            Free</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input non-woven-features-check-other"
                                                               id="non_wovenFeaturesOther" value="Other" name="non_woven_features[]"
                                                               required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesOther">Other</label>
                                                    </div>
                                                    <div class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input features-check-none" value="None"
                                                               id="non_wovenFeaturesNone" name="non_woven_features[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenFeaturesNone">None</label>
                                                    </div>

                                                    <small class="text-danger" id="non_woven_features_error"></small>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6 add-nonwoven-features-field">
                                                <label class="font-500">Other Features <span
                                                        class="required">*</span></label>
                                                <input id="other_non_woven_features" name="other_non_woven_features" type="text"
                                                       class="form-control" required>
                                                <small class="text-danger" id="other_non_woven_features_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="font-500">End Use/Application <span class="required"> *</span></label>
                                                <div class="">
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               id="non_wovenUseGarment" value="Garment" name="non_woven_use[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenUseGarment">Garments</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               id="non_wovenUseDress" value="Dress" name="non_woven_use[]" required>
                                                        <label class="custom-control-label" for="non_wovenUseDress">Dress</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               id="non_wovenUseLining" value="Lining" name="non_woven_use[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenUseLining">Lining</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               id="non_wovenUseSports" value="Sports wear" name="non_woven_use[]"
                                                               required>
                                                        <label class="custom-control-label" for="non_wovenUseSports">Sports
                                                            wear</label>
                                                    </div>

                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               id="non_wovenUseUnderGarments" value="Under garments" name="non_woven_use[]"
                                                               required>
                                                        <label class="custom-control-label" for="non_wovenUseUnderGarments">Under
                                                            Garments</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               id="non_wovenUseHomeTextile" value="Home Textiles" name="non_woven_use[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenUseHomeTextile">Home Textiles</label>
                                                    </div>

                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               id="non_wovenUseShoesBags" value="Shoes & Bags" name="non_woven_use[]" required>
                                                        <label class="custom-control-label" for="non_wovenUseShoesBags">Shoes & Bags</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input Use-check"
                                                               id="non_wovenUseAccessories" value="Accessories" name="non_woven_use[]" required>
                                                        <label class="custom-control-label"
                                                               for="non_wovenUseAccessories">Accessories</label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               class="custom-control-input End-check-other"
                                                               id="non_wovenUseOther" value="Other" name="non_woven_use[]" required>
                                                        <label class="custom-control-label" for="non_wovenUseOther">Other</label>
                                                    </div>
                                                    <small class="text-danger" id="non_woven_use_error"></small>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6 add-End-field">
                                                <label class="font-500">Other End Use/Application <span
                                                        class="required">*</span></label>
                                                <input id="other_non_woven_use" name="other_non_woven_use" type="text" class="form-control"
                                                       required>
                                                <small class="text-danger" id="other_non_woven_use_error"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="additional-product-info machinery-info" style="display: none;">
                                        <span class="d-block my-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="font-500">Product Type <span
                                                        class="required">*</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input"
                                                               id="productStandard" value="Standard" name="product_type"
                                                               required>
                                                        <label class="custom-control-label" for="productStandard">Standard</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input"
                                                               value="Customized" id="productCustomized"
                                                               name="product_type" required>
                                                        <label class="custom-control-label" for="productCustomized">Customized</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="product_type_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label class="font-500">Condition <span
                                                        class="required">*</span></label>
                                                <div class="">
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="New"
                                                               id="conditionNew" name="machinery_condition" required>
                                                        <label class="custom-control-label"
                                                               for="conditionNew">New</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline w-unset">
                                                        <input type="radio" class="custom-control-input" value="Used"
                                                               id="conditionUsed" name="machinery_condition" required>
                                                        <label class="custom-control-label"
                                                               for="conditionUsed">Used</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input w-unset"
                                                               value="Both New & Used" id="conditionBoth"
                                                               name="machinery_condition" required>
                                                        <label class="custom-control-label"
                                                               for="conditionBoth">Both</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="machinery_condition_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
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
                                                               value="Not Applicable for this product" id="productNa"
                                                               name="after_sales_service" required>
                                                        <label class="custom-control-label" for="productNa">Not
                                                            Applicable for this product</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="after_sales_service_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 type-of-service">
                                                <label for="service_type" class="font-500">Type of Service <span
                                                        class="required">*</span></label>
                                                <input type="text" id="service_type" class="form-control"
                                                       name="service_type" placeholder="Type of Service" required>
                                                <small class="text-danger" id="service_type_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
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
                                                               value="Not Applicable for this product" id="warrantyNa"
                                                               name="warranty">
                                                        <label class="custom-control-label" for="warrantyNa">Not
                                                            Applicable for this product</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="warranty_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 warranty-services">
                                                <label for="warranty_period" class="font-500">Warranty Period <span
                                                        class="required">*</span></label>
                                                <input type="text" id="warranty_period" class="form-control"
                                                       name="warranty_period" placeholder="Warranty Period" required>
                                                <small class="text-danger" id="warranty_period_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
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
                                                        <input type="radio" value="Not Applicable for this product"
                                                               class="custom-control-input" id="certifyNa"
                                                               name="certification">
                                                        <label class="custom-control-label" for="certifyNa">Not
                                                            Applicable for this product</label>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="certification_error"></small>
                                            </div>
                                            <div class="form-group col-lg-6 certify-services">
                                                <label for="certification_details" class="font-500">Certification
                                                    Details <span class="required"> *</span></label>
                                                <input type="text" id="certification_details" class="form-control"
                                                       name="certification_details" placeholder="Certification Details"
                                                       required>
                                                <small class="text-danger" id="certification_details_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="additional_trade_notes" class="font-500">Additional Trade
                                                    notes <small class="font-500"> (Optional)</small></label>
                                                <input type="text" class="form-control optional-field"
                                                       id="additional_trade_notes" name="additional_trade_notes"
                                                       placeholder="Additional Trade notes (Optional)">
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="product_related_certifications" class="font-500">Company Certification <small
                                                        class="font-500"> (Optional)</small></label>
                                                <input type="text" id="product_related_certifications"
                                                       class="form-control optional-field"
                                                       name="product_related_certifications"
                                                       placeholder="Company Certification">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info ppe-institutional-info" style="display: none;">
                                        <span class="d-block my-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="material" class="font-500">Material Type <span class="required"> *</span></label>
                                                <input type="text" id="material" class="form-control" name="material" placeholder="i.e Cotton, Polyester, Nylon, Blend, Other" required>
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="composition" class="font-500">Composition/Construction <span class="required"> *</span></label>
                                                <input type="text" id="composition" class="form-control" name="composition" placeholder="e.g. 60% Cotton, 40% Polyester, 80*80/100*80, 2 ply, Other" required>
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="size_age_group" class="font-500">Size/Age Group <span class="required"> *</span></label>
                                                <input type="text" id="size_age_group" class="form-control" name="size_age_group" placeholder="e.g. i.e XS-S-M-L-XL, 5-10 Years, King Size, Queen Size, Other" required>
                                            </div>

                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="colour" class="font-500">Color <span class="required"> *</span></label>
                                                <input type="text" id="colour" class="form-control" name="colour" placeholder="e.g. Blue, Black, Grey, Green, Red, Multi, Other" required>
                                            </div>

                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="gender" class="font-500">Gender <small class="font-500"> (Optional)</small></label>

                                                <input type="text" id="gender" class="form-control optional-field" name="gender" placeholder="e.g. Man, Women, Boy, Girl, Other">
                                            </div>

                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="thickness" class="font-500">Thickness/GSM/Width <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="thickness" class="form-control optional-field" name="thickness" placeholder="e.g. 75 GSM, 150 GSM, 3 mm, 10 mm, 45 Inches, 70 Inches, Other">
                                            </div>

                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="brand" class="font-500">Brand <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="brand" class="form-control optional-field" name="brand" placeholder="e.g. Levi's, Mustang, Blend, Servise, Other">
                                            </div>

                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="design" class="font-500">Design/Style <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="design" class="form-control optional-field" name="design" placeholder="e.g. Front Open, Front Zipper, 5 Pocket Trouser, 3 Ply, Other">
                                            </div>

                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="season" class="font-500">Season <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="season" class="form-control optional-field" name="season" placeholder="e.g. Summer, Winter, Festive, Other">
                                            </div>

                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="use_end" class="font-500">End Use/Application <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="use_end" class="form-control optional-field" name="use_end" placeholder="e.g. Safety, Protection, Flame Retardent, Water Proof, Other">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="additional-product-info chemical-info" style="display: none;">
                                        <span class="d-block my-1 heading">Additional Product Info</span>
                                        <div class="chemical-info-inner">
                                            <input type="hidden" id="company_counter" name="company_counter"
                                                   value="1">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <h5 class="chemical-info-heading">Product Info 1</h5>
                                                </div>
                                                <div class="form-group col-lg-6 mb-1">
                                                    <label class="font-500">Manufacturer Company Name <small
                                                            class="font-500"> (Optional)</small></label>
                                                    <input type="text" id="manufacturer_company_name1"
                                                           name="manufacturer_company_name1" class="form-control"
                                                           placeholder="Company Name">
                                                </div>
                                                <div class="form-group col-lg-6 mb-1">
                                                    <label class="font-500">Product Origin <small
                                                            class="font-500"> (Optional)</small></label>
                                                    <select class="form-control" id="origin1" name="origin1">
                                                        <option value="" selected disabled> ---- Select Origin ---</option>
                                                        @foreach(\App\Country::all() as $country)
                                                            <option
                                                                @if($user->my_office->creator->country_id == $country->id) selected
                                                                @endif value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-6 mb-1">
                                                    <label class="font-500">Chemicals Listed <span
                                                            class="required">*</span></label>
                                                    <input type="text" id="chemicals_listed1"
                                                           name="chemicals_listed1"
                                                           class="form-control" placeholder="Chemicals Listed"
                                                           required>
                                                    <small class="text-danger" id="chemicals_listed1_error"></small>
                                                </div>
                                                <div class="form-group col-lg-6 additonial-info">
                                                    <label class="font-500">Additional Information <small
                                                            class="font-500"> (Optional)</small></label>
                                                    <input type="text" id="company_additional_info1"
                                                           name="company_additional_info1" class="form-control"
                                                           placeholder="Additional Info">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label class="font-500">Supply Type <span class="required"> *</span></label>
                                                    <div class="">
                                                        <div
                                                            class="custom-control custom-radio manufacturer-supply-type custom-control-inline">
                                                            <input type="radio" class="custom-control-input"
                                                                   id="inStock1" value="In Stock"
                                                                   name="supply_type1"
                                                                   required>
                                                            <label class="custom-control-label" for="inStock1">In
                                                                Stock</label>
                                                        </div>
                                                        <div
                                                            class="custom-control custom-radio manufacturer-supply-type custom-control-inline">
                                                            <input type="radio" class="custom-control-input"
                                                                   id="makeOrder1" value="Made to Order"
                                                                   name="supply_type1" required>
                                                            <label class="custom-control-label" for="makeOrder1">Made
                                                                to
                                                                Order</label>
                                                        </div>
                                                        <div
                                                            class="custom-control custom-radio manufacturer-supply-type custom-control-inline">
                                                            <input type="radio" class="custom-control-input"
                                                                   id="both1"
                                                                   value="Both" name="supply_type1" required>
                                                            <label class="custom-control-label"
                                                                   for="both1">Both</label>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger" id="supply_type1_error"></small>
                                                </div>
                                                <div class="my-1">
                                                    <hr class="horizontal-line">
                                                </div>
                                            </div>
                                        </div>
                                        <button  class="red-btn add-btn">Add +</button>
                                    </div>
                                    <div class="additional-product-info garments-info" style="display: none;">
                                        <span class="d-block my-1 heading">Product Specifications</span>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="material_type" class="font-500">Material Type <span class="required"> *</span></label>
                                                <input type="text" id="material_type" class="form-control" name="material_type" placeholder="e.g. Cotton, Polyester, Sheep Leather, Metal, Other" required>
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="construction" class="font-500">Composition/Construction <span class="required"> *</span></label>
                                                <input type="text" id="construction" class="form-control" name="construction" placeholder="e.g. 60% Cotton, 40% Polyester, 80*80/100*80, Bronze, Other" required>
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="size_age" class="font-500">Size/Age Group <span class="required"> *</span></label>
                                                <input type="text" id="size_age" class="form-control" name="size_age" placeholder="e.g. XS-S-M-L-XL, 1-2 Years, 5-10 Years, Other" required>
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="color" class="font-500">Color <span class="required"> *</span></label>
                                                <input type="text" id="color" class="form-control" name="color" placeholder="e.g. Blue, Black, Grey, Green, Red, Multi, Other" required>
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="garments_gender" class="font-500">Gender <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="garments_gender" class="form-control optional-field" name="garments_gender" placeholder="e.g. Man, Women, Boy, Girl, Other">
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="thick_gsm_width" class="font-500">Thickness/GSM/Width <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="thick_gsm_width" class="form-control optional-field" name="thickness_gsm_width" placeholder="e.g. 75 GSM, 150 GSM, 3 mm, 10 mm, 45 Inches, 70 Inches, Other">
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="garments_brand" class="font-500">Brand <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="garments_brand" class="form-control optional-field" name="garments_brand" placeholder="e.g. Levi's, Mustang, Blend, Servise, Other">
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="design_style" class="font-500">Design/Style <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="design_style" class="form-control optional-field"
                                                       name="design_style" placeholder="e.g. Round Neck, Sleeveless, Fit, Baggy, Other">
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="garments_season" class="font-500">Season <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="garments_season" class="form-control optional-field" name="garments_season" placeholder="e.g. Summer, Winter, Festive, Other">
                                            </div>
                                            <div class="form-group col-lg-6 mb-1">
                                                <label for="end_use_app" class="font-500">End Use/Application <small class="font-500"> (Optional)</small></label>
                                                <input type="text" id="end_use_app" class="form-control optional-field"
                                                       name="end_use_app" placeholder="e.g. Casual, Formal, Sports, Industrial, Other">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="additional-product-info leftover-info"></div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12 mb-0 clearfix">
                                            <textarea id="details" rows="5" class="form-control addi_info" maxlength = "1200" name="details"
                                                      placeholder="Additional Info (Optional) - Add product details"></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-1" align="right">
                                        <button  class="red-btn next-btn" id="nextBtn1">NEXT</button>
                                    </div>
                                    <div class="my-1">
                                        <hr class="horizontal-line">
                                    </div>
                                </div>

                                <div class="pt-2 tab-pane fade trade-info-tab" id="tabCom" role="tabpanel"
                                     aria-labelledby="tabCom">
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 trade-info-container mb-1">
                                            <input type="text" id="focused_selling_region" class="form-control"
                                                   name="focused_selling_region"
                                                   placeholder="Target Selling Region (Optional) - City, Province, State...">
                                        </div>
                                        <div class="form-group col-lg-6 trade-info-container mb-1">
                                            <input type="text" id="production_capacity" class="form-control"
                                                   name="production_capacity" placeholder="Production Capacity (Optional) - Mention Production Capacity Per Day, Per Month">
                                        </div>
                                        {{--                                        <div class="form-group col-md-3 trade-info-container">--}}
                                        {{--											<label for="production_capacity" class="font-500">Capacity Unit (Optional)</label>--}}
                                        {{--											<select class="form-control" name="capacity_unit">--}}
                                        {{--                                                <option>1</option>--}}
                                        {{--                                                <option>2</option>--}}
                                        {{--                                            </select>--}}
                                        {{--										</div>--}}
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 trade-info-container mb-1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" id="min_order_quantity" class="form-control"
                                                           name="min_order_quantity"
                                                           placeholder="Min Order Quantity (Optional)">
                                                </div>
                                                {{--                                                <div class="col-md-3">--}}
                                                {{--                                                    <select class="form-control" name="min_order_quantity_unit">--}}
                                                {{--                                                        <option value="Pieces">Pieces</option>--}}
                                                {{--                                                        <option value="Lot">Lot</option>--}}
                                                {{--                                                    </select>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 trade-info-container mb-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="font-500 d-block">Sampling <small
                                                            class="font-500"> (Optional)</small></label>
                                                    <div
                                                        class=" custom-control custom-radio custom-control-inline form-check-inline">
                                                        <input type="radio" class="custom-control-input" value="1"
                                                               id="proYes" name="is_sampling">
                                                        <label class="custom-control-label" for="proYes">Yes</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-radio ml-3 custom-control-inline form-check-inline">
                                                        <input type="radio" class="custom-control-input" value="0"
                                                               id="proNo" name="is_sampling">
                                                        <label class="custom-control-label" for="proNo">No</label>
                                                    </div>
                                                    <div class="paid-or-free">
                                                        <div
                                                            class="custom-control custom-radio custom-control-inline form-check-inline">
                                                            <input type="radio" class="custom-control-input"
                                                                   value="Paid"
                                                                   id="proPaid" name="sampling_type">
                                                            <label class="custom-control-label"
                                                                   for="proPaid">Paid</label>
                                                        </div>
                                                        <div
                                                            class="custom-control custom-radio ml-3 custom-control-inline form-check-inline">
                                                            <input type="radio" class="custom-control-input"
                                                                   value="Free"
                                                                   id="proFree" name="sampling_type">
                                                            <label class="custom-control-label"
                                                                   for="proFree">Free</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mx-0 form-row d-none trade-info-container position-relative"
                                                         id="paidField">
                                                        <div class="form-group mb-0">
                                                            <input type="text" id="paidSample"
                                                                   name="paid_sampling_price"
                                                                   class="form-control" placeholder="Add Price">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 trade-info-container mb-1">
                                            <select id="dealing_as" name="dealing_as[]"
                                                    class="select2-multiple select-suitable-type form-control required-control"
                                                    multiple="multiple" required>
                                                <option value="" class="d-none" disabled></option>
                                                <option value="Manufacturer">Manufacturer</option>
                                                <option value="Sole Agent">Sole Agent</option>
                                                <option value="Stockist">Stockist</option>
                                                <option value="Supplier">Supplier</option>
                                                <option value="Marketing Manager">Marketing Manager</option>
                                                <option value="Other" class="other-check">Other</option>
                                            </select>
                                            <small class="text-danger" id="dealing_as_error"></small>
                                        </div>
                                        <div class="form-group col-lg-6 other-div add-Certifications mb-1">
                                            <input type="text" id="other_dealing_as" maxlength = "50" name="other_dealing_as" placeholder="Add Other Details"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 trade-info-container mb-1">
                                            <select name="focused_selling_countries[]"
                                                    class="select2-multiple select-target-country form-control required-control"
                                                    multiple="multiple" id="focused_selling_countries" required>
                                                @foreach(\DB::table('countriyes')->get() as $country)
                                                    <option
                                                        value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="focused_selling_countries_error"></small>
                                        </div>
                                    </div>
                                    <div class="mt-1" align="right">
                                        <button  class="red-btn next-btn" id="nextBtn2">NEXT</button>
                                    </div>
                                    <div class="my-1">
                                        <hr class="horizontal-line">
                                    </div>
                                </div>
                                <div class="pt-2 tab-pane fade payment-info-tab" id="tabInfo" role="tabpanel"
                                     aria-labelledby="tabInfo">
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 unit_price_range">

                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <label for="unit_price_from" class="font-500 unit_price_range_label">Price Range <span class="required">*</span>
                                                    </label>
                                                    <label for="unit_price_from" class="font-500 service_charges_range_label">Service Charges <span class="required">*</span>
                                                    </label>
                                                    <input type="number" id="unit_price_from" class="form-control" name="unit_price_from" placeholder="e.g. 1000" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="unit_price_to" class="font-500 unit_price_range_label"></label>
                                                    <label for="unit_price_to" class="font-500 service_charges_range_label">Charges Range <span class="required">*</span>
                                                    </label>
                                                    <input type="number" id="unit_price_to" class="form-control"
                                                           name="unit_price_to" placeholder="e.g. 2000" required>
                                                </div>
                                                <div class="col-md-4 hide-for-service" style="display: none;">
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
                                                <div class="col-md-4 service-unit">
                                                    <label class="font-500 service_charges_range_unit_label">Per Unit <span
                                                            class="required">*</span></label>
                                                    <input type="text" name="other_unit_price_unitt" class="form-control" required>
                                                    <small class="text-danger" id="other_unit_price_unitt_error"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 other-div add-unit_price_unit">
                                            <label class="font-500">Other Price Unit <span class="required">*</span></label>
                                            <input type="text" name="other_unit_price_unit" class="form-control" required>
                                        </div>
                                        <div class="form-group col-lg-6 mb-0 target_price_range">
                                            <div class="form-row">
                                                <div class="col-md-4 mb-1">
                                                    <input type="number" id="target_price_from" class="form-control"
                                                           name="target_price_from" placeholder="Target Price Range - e.g. 1000" required>
                                                </div>
                                                <div class="col-md-4 mb-1">
                                                    <input type="number" id="target_price_to" class="form-control"
                                                           name="target_price_to" placeholder="Target Price - e.g. 200" required>
                                                </div>
                                                <div class="col-md-4 mb-1">
                                                    <select class="form-control other-option-included" id="target_price_unit" name="target_price_unit" required>
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
                                        <div class="form-group col-lg-6 mb-1 other-div add-target_price_unit">
                                            <input type="text" name="other_target_price_unit" placeholder="Other Price Unit" class="form-control" required>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 mb-1">
                                            <select class="form-control single-select-dropdown"
                                                    id="suitable_currencies" name="suitable_currencies" required>
                                                <option value="" selected disabled>Select Suitable Currency</option>
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
                                        <div class="form-group col-lg-6 other-div add-suitable-currency">
                                            <label class="font-500">Add Your Suitable Currency <span class="required"> *</span></label>
                                            <input type="text" name="other_suitable_currency" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 mb-1 product_lead_time">
                                            <input type="text" id="lead_time" class="form-control"
                                                   name="delivery_time"
                                                   placeholder="Lead Time (Optional) - Mention Suitable Lead Time">
                                        </div>
                                        <div class="mb-0 form-group col-lg-6 product_delivery">
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
                                        <div class="form-group col-lg-6 services-container">
                                            <label class="label d-block">Service Duration <span
                                                    class="required">*</span></label>
                                            <select id="service_durations" name="service_durations[]"
                                                    class="select2-multiple form-control" multiple="multiple">
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
                                        <div class="form-group col-lg-6 add-services-duration other-div">
                                            <label class="font-500">Add Your Service Duration <span
                                                    class="required">*</span></label>
                                            <input id="other_service_duration" name="other_service_duration"
                                                   type="text"
                                                   class="form-control">
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 mb-1">
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
                                        <div class="form-group col-lg-6 mb-0 other-div add-payment-terms">
                                            <input type="text" id="other_payment_term" name="other_payment_term" placeholder="Add Your Payment Terms"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="mt-1" align="right">
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
        $('#createProduct').submit(function () {
            initial_form_state = $('#createProduct').serialize();
        });
        $(window).bind('beforeunload', function (e) {
            var form_state = $('#createProduct').serialize();
            if (initial_form_state != form_state) {
                return 'Are you sure you want to leave?';
            }
        });
        $(document).ready(function () {
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
            $('select[name="yarn_technology"]').select2({
                placeholder: "Select Yarn Technology"
            });

            $('select[name="yarn_attribute"]').select2({
                placeholder: "Select Yarn Attribute"
            });

            $('.sel-pro-type').select2({
                placeholder: "---- Select Product Type ---"
            });

            $('select[name="suitable_currencies"]').select2({
                placeholder: "Select Suitable Currency"
            });

            $('select[name="woven_fabric_types"]').select2({
                placeholder: "Select Fabric Type"
            });

            $('select[name="woven_weave_types"]').select2({
                placeholder: "Select Weave Type"
            });
            /*for select single place holders*/

            /*for select multiple place holders*/
            $('.select-suitable-type').select2({
                placeholder: "Select Dealing Product As"
            });

            $('.select-target-country').select2({
                placeholder: "Select Target Country"
            });

            $('.select-suitable-currency').select2({
                placeholder: "Select Suitable Currency"
            });

            $('.select-suitable-payment').select2({
                placeholder: "Select Payment Terms"
            });
            /*for select multiple place holders*/

            var validator = $("form[name='createProduct']").validate({
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
                    } else if (elem.hasClass('single-select-dropdown')) {
                        element = elem.closest('.form-group').find('.select2-container--default');
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $('.next-btn').click(function () {
                if ($("form[name='createProduct']").valid() && myImagesDropzone.getQueuedFiles().length >= 1) {
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
                    alert("Enter the missing data");
                    validator.focusInvalid();
                }
            });

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
                        // $('html, body').animate({scrollTop: 0}, 'slow');
                        // $("#alert-success-create-product").show().html("New product added successfully.");
                        $(window).off('beforeunload');
                        $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                        mySheetsDropzone.productId = response.product_id;
                        mySheetsDropzone.processQueue();
                        myImagesDropzone.productId = response.product_id;
                        myImagesDropzone.processQueue();
                        setTimeout(() => {
                            $("#loader").hide();
                            toastr.success("New product added successfully.");
                            window.location.href = response.url;
                        }, 30000);
                    } else if (response.feedback == "validation_error") {
                        toastr.error("Please enter the required fields.");
                        $form.find('button[type=submit]').prop('disabled', false);
                        // $('html, body').animate({scrollTop:($('#'+Object.keys(response.errors)[0]).offset().top)}, 'slow');

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
                    // $('#alert-error-create-product').html(msg);
                    // $('#alert-error-create-product').show();
                    toastr.error(msg);
                },
            };
            $('#createProduct').ajaxForm(options);
            Dropzone.autoDiscover = false;
            $(".dropzone").sortable({
                change: function (event, ui) {
                    ui.placeholder.css({visibility: 'visible', border: '2px dashed #673ab75e' });
                }
            });
            var mySheetsDropzone = new Dropzone("div.images-files-drop", {
                productId: '',
                url: "{{url('upload-product-sheets')}}",
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
                        formData.append('productId', thisDropzone.productId);
                        formData.append("_token", "{{ csrf_token() }}");
                    });

                    console.log('init');
                    this.on("maxfilesexceeded", function(file){
                        alert("You cannot upload more than 15 images or files!");
                        this.removeFile(file);
                    });

                    // this.on("queuecomplete", function (file) {
                    //     toastr.success("New product added successfully.");
                    //     window.location.href = response.url;
                    // });

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
                productId: '',
                url: "{{url('upload-product-images')}}",
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
                        formData.append('productId', thisDropzone.productId);
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
                    url: '{{ route("get-sub-categories") }}',
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

            // $('#fabric_types').on('change' , function (){
            //
            //     if(jQuery.inArray("Other", $(this).val()) !== -1){
            //         $('#other_fabric_option').removeClass('d-none');
            //     }else{
            //         $('#other_fabric_option').addClass('d-none');
            //     }
            // });
            //
            // $('#materials').on('change' , function (){
            //
            //     if(jQuery.inArray("Other", $(this).val()) !== -1){
            //         $('#add_material').removeClass('d-none');
            //     }else{
            //         $('#add_material').addClass('d-none');
            //     }
            // });
            //
            // $('#fabric_sub_categories').on('change' , function (){
            //
            //     if(jQuery.inArray("Other", $(this).val()) !== -1){
            //         $('#addSubCat').removeClass('d-none');
            //     }else{
            //         $('#addSubCat').addClass('d-none');
            //     }
            // });
            //
            // $('#styles').on('change' , function (){
            //
            //     if(jQuery.inArray("Other", $(this).val()) !== -1){
            //         $('#oter_style').removeClass('d-none');
            //     }else{
            //         $('#oter_style').addClass('d-none');
            //     }
            // });


        });
    </script>
@endpush
