@extends('front_site.master_layout')

@section('content')

    <body class="dashboard">
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper">

                <div class="  d-container py-2">
                    <div class="company-profile">
                        <div class="container">
                            <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                                 role="alert">
                            </div>
                            <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                                 role="alert">
                            </div>
                            <span class="d-block text-center heading main-heading font-24">Company Profile</span>
                            <form id="companyForm" name="companyForm" autocomplete="off" action="{{route('company-profile-create')}}"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="office_code" value="{{ rand(2000, 1900000) }}">
                                <span class="d-block heading font-18 basic-info">Basic Info</span>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="companyName" class="label">Company Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="companyName" name="company_name" placeholder="My Textile" required>
                                        <small class="text-danger" id="company_name_error"></small>
                                    </div>
                                <!-- <div class="form-group col-md-6">
                                    <label for="companyName" class="label">Industry <span class="required">*</span></label>

                                    <select class="form-control choose-services  selectpicker " multiple name="industry[]">
                                        <option disabled="">--Services--</option>
                                        @foreach (\App\Category::all() as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger" id="industry_error"></small>
                                </div> -->
                                    <div class="form-group col-md-6">
                                        <label for="industry" class="label d-block">Business Category <span
                                                class="required">*</span></label>
                                        <select class="form-control select2-multiple1" required id="industry" name="industry[]"
                                                multiple>
                                            @foreach (\App\Category::all() as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="industry_error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 business-select">
                                        <label class="label d-block">Business Type <span class="required">*</span></label>
                                        <select class="form-control select2-multiple2" required name="business_type[]"
                                                multiple="multiple">
                                            <option value="Manufacturer">Manufacturer</option>
                                            <option value="Trading Company">Trading Company</option>
                                            <option value="Supplier">Supplier</option>
                                            <option value="Agent">Agent</option>
                                            <option value="Other" id="others">Other</option>
                                        </select>
                                        <small class="text-danger" id="business_type_error"></small>
                                    </div>
                                    <div class="form-group col-md-6 other-div">
                                        <h6 class="w-100 p-0">Add Business Type <span class="required">*</span></h6>
                                        <input type="text" name="other_business_type" placeholder="Input Other Business Type"
                                               class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label d-block">Nature of Business <small
                                                class="font-500">(Optional)</small></label>
                                        <select class="form-control" name="business_nature">
                                            <option value="" selected disabled>Select Nature of Business</option>
                                            <option value="Proprietorship">Proprietorship</option>
                                            <option value="Limited">Limited</option>
                                            <option value="Company">Company</option>
                                            <option value="Private Limited Company">Private Limited Company</option>
                                            <option value="Public Limited Company">Public Limited Company</option>
                                            <option value="Partnership">Partnership</option>
                                            <option value="Co-operative">Co-operative</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <small class="text-danger" id="business_nature_error"></small>
                                    </div>
                                    <div class="form-group col-md-6 other-nature-div" style="display: none;">
                                        <h6 class="w-100 p-0">Add Nature of Business <span class="required">*</span></h6>
                                        <input type="text" name="other_business_nature" placeholder="Input Other Nature of Business"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="registeration_no" class="label">Business License Number/Registration Number <small
                                                class="font-500">(Optional)</small></label>
                                        <input type="text" class="form-control" id="registeration_no" name="registeration_no"
                                               placeholder="Input Registration Number (if any)">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="year_established" class="label">Year Established <small class="font-500">(Optional)</small></label>
                                        <input type="text" class="form-control" id="year_established" name="year_established"
                                               placeholder="Input the Year Company was Established">
                                        <small class="text-danger" id="year_established_error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="no_of_employees" class="label">Number of Employees <small class="font-500">(Optional)</small></label>
                                        {{--                            <input type="number" class="form-control" name="no_of_employees" id="no_of_employees"--}}
                                        {{--                                   placeholder="Input total number of Employees">--}}
                                        <select class="form-control" name="no_of_employees" id="no_of_employees">
                                            <option value="" selected disabled>Input total number of Employees</option>
                                            <option value="0-10">0-10</option>
                                            <option value="Fewer than 50">Fewer than 50</option>
                                            <option value="Fewer than 100">Fewer than 100</option>
                                            <option value="More than 200">More than 200</option>
                                        </select>
                                        <small class="text-danger" id="no_of_employees_error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label">Annual Turnover <small class="font-500">(Optional)</small></label>
                                        <input type="text" class="form-control"
                                               name="annual_turnover"
                                               id="annual_turnover"
                                               pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"
                                               data-type="currency" placeholder="Input total turnover in Dollars i.e. $1,000,000">
                                        <small class="text-danger" id="annual_turnover_error"></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="label d-block">Export Market <small
                                                class="font-500">(Optional)</small></label>
                                        <select class="form-control select2-multiple3" name="export_market[]"
                                                multiple="multiple">
                                            <option value="Africa">Africa</option>
                                            <option value="Central Asia">Central Asia</option>
                                            <option value="Eastern Asia">Eastern Asia</option>
                                            <option value="Eastern Europe">Eastern Europe</option>
                                            <option value="Mid East">Mid East</option>
                                            <option value="North America">North America</option>
                                            <option value="Northern Europe">Northern Europe</option>
                                            <option value="Oceania">Oceania</option>
                                            <option value="South America">South America</option>
                                            <option value="South Asia">South Asia</option>
                                            <option value="Southeast Asia">Southeast Asia</option>
                                            <option value="Southeast Europe">Southeast Europe</option>
                                            <option value="Western Europe">Western Europe</option>
                                            <option value="Worldwide">Worldwide</option>
                                        </select>
                                        <small class="text-danger" id="export_market_error"></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label d-block">Certifications <small
                                                class="font-500">(Optional)</small></label>
                                        <select class="form-control select2-multiple4" name="certifications[]"
                                                multiple="multiple">
                                            <option value="BCI">BCI</option>
                                            <option value="Bluesign">Bluesign</option>
                                            <option value="BSCI">BSCI</option>
                                            <option value="Cradle to Cradle">Cradle to Cradle</option>
                                            <option value="D&B">D&B</option>
                                            <option value="Ecocert">Ecocert</option>
                                            <option value="Fair Trade">Fair Trade</option>
                                            <option value="GOTS">GOTS</option>
                                            <option value="Global Recycle Standard">Global Recycle Standard</option>
                                            <option value="ISO">ISO</option>
                                            <option value="OEKO-TEX">OEKO-TEX</option>
                                            <option value="OHSAS">OHSAS</option>
                                            <option value="REACH">REACH</option>
                                            <option value="Sedex">Sedex</option>
                                            <option value="SA 8000">SA 8000</option>
                                            <option value="WRAP">WRAP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="d-block mb-3 heading">LOGO Image <small class="font-500">(Optional | JPG or PNG file only | Upto
                                                            10MB (Dimension: 65 x 65 Pixels) | Square image recommended)</small></span>
                                    <div class="avatar-wrapper">
                                        <img class="product-pic" id="buploaded_image31" src="{{$ASSET}}/front_site/images/preview.svg"/>
                                        <span class="position-absolute del-btn fa fa-trash"></span>
                                        <div class="product-upload-button">
                                            <span class="fa fa-plus"></span>
                                        </div>
                                        <input class="product-file-upload" name="bavatar31" id="bavatar31" type="file" accept="image/*"/>
                                        <input name="bavatar31_url" type="hidden" value="" id="bavatar31_url" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="d-block mb-3 heading">Company Images <small
                                            class="font-500">(Optional | JPG, PNG & PDF files only | Upto 10MB)</small></span>
                                    <div class="dropzone dz-clickable">
                                        <div class="my-0 dz-default dz-message" data-dz-message="">
                                            <div class="row product-img-sheet">
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet16_url" type="hidden" value=""
                                                               id="sheet16_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet17_url" type="hidden" value=""
                                                               id="sheet17_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet18_url" type="hidden" value=""
                                                               id="sheet18_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet19_url" type="hidden" value=""
                                                               id="sheet19_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet20_url" type="hidden" value=""
                                                               id="sheet20_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet21_url" type="hidden" value=""
                                                               id="sheet21_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet22_url" type="hidden" value=""
                                                               id="sheet22_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet23_url" type="hidden" value=""
                                                               id="sheet23_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet24_url" type="hidden" value=""
                                                               id="sheet24_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet25_url" type="hidden" value=""
                                                               id="sheet25_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet26_url" type="hidden" value=""
                                                               id="sheet26_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet27_url" type="hidden" value=""
                                                               id="sheet27_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet28_url" type="hidden" value=""
                                                               id="sheet28_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet29_url" type="hidden" value=""
                                                               id="sheet29_url"/>
                                                    </div>
                                                </div>
                                                <div class="my-1 px-1 col-md-2 col-4">
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
                                                               accept="image/*, .pdf"/>
                                                        <input name="sheet30_url" type="hidden" value=""
                                                               id="sheet30_url"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="label">Company Introduction <span class="required">*</span></label>
                                    <textarea class="form-control" name="company_introduction" maxlength="5000"
                                              placeholder="Introduce your company in 5000 characters"
                                              id="editor1"
                                              rows="5" required></textarea>
                                    <small class="text-danger" id="company_introduction_error"></small>
                                    {{--<span class="text-danger"><span id="company_introduction_count">0</span>/3000</span>--}}
                                </div>
                                <span class="d-block heading font-18 additional-info">Additional Business Info</span>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="label" for="business_owner">Business Owner <small
                                                class="font-500">(Optional)</small></label>
                                        <input type="text" class="form-control" placeholder="Input Business Owner Name"
                                               name="business_owner" id="business_owner">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="alternate_contact" class="label">Alternate Contact Number <small
                                                class="font-500">(Optional)</small></label>
                                        <input type="number" class="form-control mobileNum inteltel"
                                               name="alternate_contact"
                                               id="alternate_contact" placeholder="03xxxxxxxxx/3xxxxxxxxx">
                                        <input type="hidden" name="alternate_contact_country_code">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="label" for="alternate_email">Alternate Email <small
                                                class="font-500">(Optional)</small></label>
                                        <input type="email" class="form-control" name="alternate_email"
                                               id="alternate_email"
                                               placeholder="Input alternate Email Address">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label" for="alternate_address">Alternate Office Address <small
                                                class="font-500">(Optional)</small></label>
                                        <input type="text" class="form-control" name="alternate_address"
                                               id="alternate_address"
                                               placeholder="Input Current Office Address">
                                    </div>
                                </div>
                                <button type="submit" class="red-btn">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
        $(document).on("change", 'select[name="business_type[]"]', function () {
            var other_div = $(this).closest('.form-group').siblings('.other-div');
            if ($(this).val().includes('Other')) {
                other_div.show();
                other_div.find('input[name=other_business_type]').prop('required', true);
            } else {
                other_div.hide();
                other_div.find('input[name=other_business_type]').prop('required', false);
            }
        });
        $(document).on("change", 'select[name=business_nature]', function () {
            var other_div = $(this).closest('.form-group').siblings('.other-nature-div');
            if ($(this).val() == 'Other') {
                other_div.show();
                other_div.find('input[name=other_business_nature]').prop('required', true);
            } else {
                other_div.hide();
                other_div.find('input[name=other_business_nature]').prop('required', false);
            }
        });
        $(document).ready(function () {
            /*scroll to error div*/
            $(document).on('click', 'button[type="submit"]', function () {
                setTimeout(() => {
                    var navbarHeight = $('.navbar').innerHeight();
                    $('html,body').animate({
                            scrollTop: $('.error:not(:empty)').eq(0).closest('.form-group').offset().top - (navbarHeight)},
                        'slow');
                }, 500);
            });
            /*scroll to error div*/

            ClassicEditor
                .create(document.querySelector('#editor1'))
                .catch(error => {
                    console.error(error);
                });
            $("#editor1").on('keyup', function () {
                $('#company_introduction_count').text($(this).val().length);
            });
            $('#year_established').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                endDate: '+0d',
                autoclose: true
            });
            $('.select2-multiple1').select2({
                closeOnSelect: true,
                placeholder: "Choose Business Category",
            });
            $('.select2-multiple2').select2({
                closeOnSelect: true,
                placeholder: "Choose Business Type",
            });
            $('.select2-multiple3').select2({
                closeOnSelect: true,
                placeholder: "Choose the Export Market",
            });
            $('.select2-multiple4').select2({
                closeOnSelect: true,
                placeholder: "Input Certifications (If any)",
            });
            $('.select2-multiple1, .select2-multiple2, .select2-multiple3, .select2-multiple4').on('select2:select', function (e) {
                $(this).siblings('.select2').find('.select2-selection__choice').siblings('.select2-search--inline').css({'width': 'min-content', 'float': 'right'});
            });

            $('.select2-multiple1, .select2-multiple2, .select2-multiple3, .select2-multiple4').on('select2:unselect', function (e) {
                $(this).siblings('.select2').find('.select2-selection__rendered').children('.select2-search--inline').css({'width': '100%', 'float': 'left'});
            });
            var validator = $("form[name='companyForm']").validate({
                ignore: [],
                onfocusout: function (element) {
                    var $element = $(element);
                    if ($element.hasClass('select2-search__field')) {
                        $element2 = $element.closest('.form-group').find('select');
                        if (!$element2.prop('required') && $element2.val() == '') {
                            $element.removeClass('is-valid');
                        } else {
                            this.element($element2)
                        }
                    } else if (!$element.prop('required') && ($element.val() == '' || $element.val() == null)) {
                        $element.removeClass('is-valid');
                    } else {
                        this.element(element)
                    }
                },
                onkeyup: function (element) {
                    var $element = $(element);
                    if ($element.hasClass('select2-search__field')) {
                        $element.closest('.form-group').find('select').valid();
                    } else {
                        $element.valid();
                    }
                },
                rules: {
                    company_name: "required",
                    industry: "required",
                    business_type: "required",
                    // alternate_contact: {
                    //     phoneNumberFormat: true
                    // }
                },
                messages: {
                    company_name: "Please enter your company name",
                    industry: "Please select your company",
                    business_type: "Please select your business type",
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                highlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        elem.closest('.form-group').find('input').addClass(errorClass);
                        elem.closest('.form-group').find('input').removeClass(validClass);
                        elem.closest('.form-group').find('span.select2-selection').addClass(errorClass);
                        elem.closest('.form-group').find('span.select2-selection').removeClass(validClass);
                    } else {
                        elem.addClass(errorClass);
                    }
                },
                unhighlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        elem.closest('.form-group').find('input').addClass(validClass);
                        elem.closest('.form-group').find('input').removeClass(errorClass);
                        elem.closest('.form-group').find('span.select2-selection').removeClass(errorClass);
                        elem.closest('.form-group').find('span.select2-selection').addClass(validClass);
                    } else {
                        elem.removeClass(errorClass);
                        elem.addClass(validClass);
                    }
                },
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        var element2 = elem.closest('.form-group').find('.select2-container');
                        error.insertAfter(element2);
                    } else if (elem.hasClass('inteltel')) {
                        var element2 = elem.closest('.iti');
                        error.insertAfter(element2);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $('.select2-multiple').on("change", function (e) {
                $("form[name='companyForm']").valid()
            });
            var options = {
                dataType: 'Json',
                beforeSerialize: function ($form, options) {
                    $('input[name=alternate_contact_country_code]').val($(".mobileNum").intlTelInput('getSelectedCountryData').dialCode);
                },
                beforeSubmit: function (arr, $form) {
                    if ($("form[name='companyForm']").valid() && !$("#alternate_contact").hasClass("is-invalid")) {
                        $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                        $form.find('button[type=submit]').prop('disabled', true);
                        return true;
                    } else {
                        return false;
                    }
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;

                    if (response.feedback === "false") {
                        $form.find('button[type=submit]').prop('disabled', false);
                        // $('html, body').animate({scrollTop: ($('#' + Object.keys(response.errors)[0]).offset().top)}, 'slow');
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    } else if (response.feedback === "other_error") {
                        $form.find('button[type=submit]').prop('disabled', false);
                        $('html, body').animate({scrollTop: 0}, 'slow');
                        $('#' + response.id).html(response.custom_msg);
                    } else if (response.feedback === 'other') {
                        $form.find('button[type=submit]').prop('disabled', false);
                        $('html, body').animate({scrollTop: 0}, 'slow');
                        $('#alert-error').html(response.custom_msg);
                        $('#alert-error').show();
                    } else {
                        $('#alert-error').hide();
                        $('#accoutn_btn').attr('disabled');
                        // $('#alert-success').html(response.msg);
                        // $('#alert-success').show();
                        toastr.success(response.msg);
                        window.location.href = response.url;

                    }
                },
                error: function (jqXHR, exception) {
                    $("#loader").hide();
                    $('button[type=submit]').prop('disabled', false);
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#accoutn_btn').removeClass('d-none');
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
                    $('#alert-error').html(msg);
                    $('#alert-error').show();
                },

            };
            $('#companyForm').ajaxForm(options);

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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet16_url').val('');
                            $('#uploaded_image16').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet16_url').val('');
                            $('#uploaded_image16').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet17_url').val('');
                            $('#uploaded_image17').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet17_url').val('');
                            $('#uploaded_image17').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet18_url').val('');
                            $('#uploaded_image18').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet18_url').val('');
                            $('#uploaded_image18').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet19_url').val('');
                            $('#uploaded_image19').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet19_url').val('');
                            $('#uploaded_image19').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet20_url').val('');
                            $('#uploaded_image20').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet20_url').val('');
                            $('#uploaded_image20').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet21_url').val('');
                            $('#uploaded_image21').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet21_url').val('');
                            $('#uploaded_image21').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet22_url').val('');
                            $('#uploaded_image22').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet22_url').val('');
                            $('#uploaded_image22').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet23_url').val('');
                            $('#uploaded_image23').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet23_url').val('');
                            $('#uploaded_image23').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet24_url').val('');
                            $('#uploaded_image24').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet24_url').val('');
                            $('#uploaded_image24').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet25_url').val('');
                            $('#uploaded_image25').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet25_url').val('');
                            $('#uploaded_image25').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet26_url').val('');
                            $('#uploaded_image26').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet26_url').val('');
                            $('#uploaded_image26').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet27_url').val('');
                            $('#uploaded_image27').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet27_url').val('');
                            $('#uploaded_image27').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet28_url').val('');
                            $('#uploaded_image28').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet28_url').val('');
                            $('#uploaded_image28').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet29_url').val('');
                            $('#uploaded_image29').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet29_url').val('');
                            $('#uploaded_image29').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
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
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet30_url').val('');
                            $('#uploaded_image30').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        } else if (ext.indexOf("xlsx") != -1) {
                            alert('JPG, PNG & PDF files accepted only!');
                            $('#sheet30_url').val('');
                            $('#uploaded_image30').attr("src", "{{$ASSET}}/front_site/images/preview.svg");
                        }


                    });
                }
            });

            $(document).on('change', '#bavatar31', function (event) {
                var name = document.getElementById("bavatar31").files[0].name;
                var form_data = new FormData();
                var token='{{csrf_token()}}';

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
                // if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg','jfif','heic']) == -1) {
                //     alert("Invalid Image File");
                // }
                var reader = new FileReader();
                reader.onload = function(){
                    var output = document.getElementById('buploaded_image31');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                form_data.append('_token',token);
                form_data.append("avatar", document.getElementById('bavatar31').files[0]);
                $.ajax({
                    url: "{{route('company-images')}}",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#buploaded_image31').html("<label class='text-success'>Image Uploading...</label>");
                    },
                    success: function (data) {
                        $('#bavatar31_url').val(data.url);
                    }
                });
            });
        });
    </script>
@endpush
