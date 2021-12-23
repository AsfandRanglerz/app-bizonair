@extends('front_site.master_layout')

@push('css')
    <style>
        .del-photo {
            position: absolute;
            right: -3px;
            top: 3px;
            font-size: 18px;
            color: #a52c3e;
            cursor: pointer;
        }

        .del-photo:hover {
            color: #9f0a0a;
        }
    </style>
@endpush

@section('content')

    <body class="dashboard">
    <main id="maincontent" class="page-main">
        <div class="d-flex edit-company-profile" id="dashboardWrapper">
            <!-- Sidebar -->
        <!-- Sidebar -->

            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
                <div id="page-content-wrapper">

                    <div class="px-2">
                        <div id="companyTab1">
                            <ul class="nav nav-tabs" id="myCompanyLinks" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="linkProfile" data-toggle="tab" href="#tabProfile"
                                       role="tab" aria-controls="tabProfile" aria-selected="true">PROFILE</a>
                                </li>
                                {{--							<li class="nav-item">--}}
                                {{--								<a class="nav-link" id="linkLocation" data-toggle="tab" href="#tabLocation" role="tab" aria-controls="tabLocation" aria-selected="false">ADDITIONAL INFO</a>--}}
                                {{--							</li>--}}
                            </ul>
                            <?php $usercomp = \App\UserCompany::where('user_id',auth()->id())->where('company_id',session()->get('company_id'))->first(); ?>
                            <div class="tab-content" id="myCompanyTab">
                                <div class="py-2 tab-pane fade show active" id="tabProfile" role="tabpanel"
                                     aria-labelledby="linkProfile">
                                    <div class="col-sm-12 px-0 mb-2 text-center">
                                        <img src="{{ $company->logo }}" class="border-grey company-profile-logo">
                                    </div>

                                    <div class="edit-about-us-section">

                                        <h6 class="heading">About<span @if($usercomp->is_admin==1)
                                                                       class="fa fa-edit edit-btn about-edit-btn" @endif></span></h6>
                                        <p class="text">{!! $company->company_introduction !!}</p>
                                    </div>

                                    <hr>

                                    <div class="col-sm-12 px-0">
                                        <div class="my-2 product-img-spec-container">
                                            <h6 class="my-2 px-2 heading pro-img-heading">Company Images And Sheets</h6>
                                            <div class="product-images-gallery">
                                                <ul class="mx-0 mb-2 product-gallery edit-comp-prof-imgs">
                                                    @foreach (\App\CompanyImage::where('company_id', $company->id)->get() as $image)
                                                        <?php $pathinfo = pathinfo($image->image);
                                                        $supported_ext = array('docx', 'xlsx', 'pdf');
                                                        $src_file_name = $image->image;
                                                        $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                                        @if($ext=="docx")
                                                            <li class="position-relative d-inline-block px-1 my-1 d-flex justify-content-center align-items-center"
                                                                data-src="{{$image->image}}"
                                                                data-pinterest-text="Pin it"
                                                                data-tweet-text="share on twitter">
                                                                <img class="img-responsive product-img"
                                                                     src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png"
                                                                     style="filter: brightness(0.5)">
                                                                <input type="hidden" name='sheet_id' value="{{encrypt($image->id)}}">
                                                                <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$image->id}}"></span>
                                                            </li>
                                                        @elseif($ext=="xlsx")
                                                            <li class="position-relative d-inline-block px-1 my-1 d-flex justify-content-center align-items-center"
                                                                data-src="{{$image->image}}"
                                                                data-pinterest-text="Pin it"
                                                                data-tweet-text="share on twitter">
                                                                <img class="img-responsive product-img"
                                                                     src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png"
                                                                     style="filter: brightness(0.5)">
                                                                <input type="hidden" name='sheet_id' value="{{encrypt($image->id)}}">
                                                                <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$image->id}}"></span>
                                                            </li>
                                                        @elseif($ext=="pdf")
                                                            <li class="position-relative d-inline-block px-1 my-1 d-flex justify-content-center align-items-center"
                                                                data-src="{{$image->image}}"
                                                                data-pinterest-text="Pin it"
                                                                data-tweet-text="share on twitter">
                                                                <img class="img-responsive product-img"
                                                                     src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png"
                                                                     style="filter: brightness(0.5)">
                                                                <input type="hidden" name='sheet_id' value="{{encrypt($image->id)}}">
                                                                <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$image->id}}"></span>
                                                            </li>
                                                        @else
                                                            <li class="position-relative d-inline-block px-1 my-1">
                                                                <input type="hidden" name='sheet_id' value="{{encrypt($image->id)}}">
                                                                <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$image->id}}" aria-hidden="true" style="z-index: 1;right: -8px"></span>

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
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edit-company-section">
                                        <h6 class="heading">Business Information<span @if($usercomp->is_admin==1)
                                                                                      class="fa fa-edit edit-btn com-edit-btn" @endif></span></h6>
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Name</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>{{ $company->company_name }}</span>
                                            </div>
                                        </div>
                                    <!-- <div class="row mb-1 text">
										<div class="col-sm-6 col-6">
											<span class="font-500">Designation</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>@if($user->designation) {{ $user->designation}} @else - @endif</span>
										</div>
									</div> -->
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Business Type</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>{{ $company->business_type}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Nature of Business</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->business_nature) {{ $company->business_nature}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Export Market</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->export_market) {{ $company->export_market}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Year of Establishment</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->year_established) {{ $company->year_established}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">No of Employees</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->no_of_employees) {{ $company->no_of_employees}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Certification</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->certifications) {{ $company->certifications}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Annual Turnover(In USD Million)</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->annual_turnover) {{ $company->annual_turnover}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <!-- <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">IE Code</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>-</span>
                                            </div>
                                        </div> -->
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Licence No/ Reg No</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->registeration_no) {{ $company->registeration_no}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="edit-location-section">

                                            <hr>

                                            <h6 class="heading">Additional Information<span @if($usercomp->is_admin==1)
                                                                                            class="fa fa-edit edit-btn com-edit-btn" @endif></span></h6>
                                            <div class="row mb-1 text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Business Owner</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($company->business_owner) {{ $company->business_owner}} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row mb-1 text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Alternate Contact Number</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($company->alternate_contact) {{ $company->alternate_contact}} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row mb-1 text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Alternate Email</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($company->alternate_email) {{ $company->alternate_email}} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row mb-1 text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Alternate Office Address</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($company->alternate_address) {{ $company->alternate_address}} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                        <!-- <div class="row mb-1 text">
										<div class="col-sm-6 col-6">
											<span class="font-500">State</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->state}}</span>
										</div>
									</div>
									<div class="row mb-1 text">
										<div class="col-sm-6 col-6">
											<span class="font-500">Country</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->country}}</span>
										</div>
									</div>
									<div class="row mb-1 text">
										<div class="col-sm-6 col-6">
											<span class="font-500">Mobile</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->phone_no}}</span>
										</div>
									</div>
									<div class="row mb-1 text">
										<div class="col-sm-6 col-6">
											<span class="font-500">Email</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->email}}</span>
										</div>
									</div> -->
                                        </div>
                                    </div>

                                    <hr>

                                </div>
                                <div class="py-2 tab-pane fade" id="tabLocation" role="tabpanel"
                                     aria-labelledby="linkLocation">
                                    <div class="edit-location-section">
                                        <h6 class="heading">Additional Information<span
                                                class="fa fa-edit edit-btn extra-edit-btn"></span></h6>
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Business Owner</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->business_owner) {{ $company->business_owner}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Alternate Contact Number</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->alternate_contact) +{{ $company->alternate_contact}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Alternate Email</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->alternate_email) {{ $company->alternate_email}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1 text">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Alternate Office Address</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->alternate_address) {{ $company->alternate_address}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                    <!-- <div class="row mb-1 text">
										<div class="col-sm-6 col-6">
											<span class="font-500">State</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->state}}</span>
										</div>
									</div>
									<div class="row mb-1 text">
										<div class="col-sm-6 col-6">
											<span class="font-500">Country</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->country}}</span>
										</div>
									</div>
									<div class="row mb-1 text">
										<div class="col-sm-6 col-6">
											<span class="font-500">Mobile</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->phone_no}}</span>
										</div>
									</div>
									<div class="row mb-1 text">
										<div class="col-sm-6 col-6">
											<span class="font-500">Email</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->email}}</span>
										</div>
									</div> -->
                                    </div>

                                    <hr>

                                </div>
                            </div>
                        </div>
                        <div id="companyTab2">
                            <div id='alert-success-update-company' class="alert alert-success py-2"
                                 style="display: none;">
                            </div>
                            <div id='alert-error-update-company' class="alert alert-danger py-2" style="display: none;">
                            </div>
                            <ul class="nav nav-tabs" id="aboutLinks" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="linkCom" data-toggle="tab" href="#tabCom" role="tab"
                                       aria-controls="tabCom" aria-selected="false">COMPANY DETAILS</a>
                                </li>
                                <li class="w-unset d-sm-flex d-inline-block justify-content-end ml-auto nav-item">
                                    <button type="submit" class="red-btn updt-btn" form="updateCompany">UPDATE</button>
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
                            <form id="updateCompany" method="post" name="companyForm"
                                  action="{{ route('update-company-profile') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" id="company_id" class="form-control" name="company_id" value="{{ $company->id }}">
                                <div class="tab-content company-profile" id="myCompanyTab">
                                    <div class="py-2 tab-pane fade show active" id="tabCom" role="tabpanel"
                                         aria-labelledby="tabCom">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="company" class="d-none font-500">Company Name <span
                                                        class="required">*</span></label>
                                                <input type="text" id="company" class="form-control" name="company_name"
                                                       value="{{$company->company_name}}"
                                                       placeholder="Company Name (Mandatory) - My Textile">
                                                <small class="text-danger" id="company_error"></small>
                                            </div>
                                        <!-- <div class="form-group col-md-6">
				                        <label for="industry" class="label">Industry <span class="required">(Mandatory)</span></label>

				                        <select class="form-control choose-services  selectpicker" name="industry[]" multiple>
				                            @foreach (\App\Category::all() as $item)
                                            <option value="{{$item->id}}" @if($company->industry->where('id', $item->id)->first() != null) selected @endif>{{$item->name}}</option>
				                            @endforeach
                                            </select>
                                            <small class="text-danger" id="industry_error"></small>
                                        </div> -->
                                            <div class="form-group col-md-6">
                                                <label for="industry" class="d-none label">Business Category <span
                                                        class="required">*</span></label>
                                                <select class="form-control select2-multiple1" id="industry"
                                                        name="industry[]"
                                                        multiple="multiple">
                                                    <option value=""></option>
                                                    <option disabled>Business Category (Mandatory)</option>
                                                    @foreach (\App\Category::all() as $item)
                                                        <option value="{{$item->id}}"
                                                                @if($company->industry->where('id', $item->id)->first() != null) selected @endif >{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <small class="text-danger" id="industry_error"></small>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 business-select">
                                                <label class="d-none label">Business Type <span
                                                        class="required">*</span></label>
                                                <select class="form-control select2-multiple2" name="business_type[]"
                                                        multiple="multiple">
                                                    <option value=""></option>
                                                    <option disabled>Business Type (Mandatory)</option>
                                                    <?php $business_types = explode(",", $company->business_type); ?>
                                                    <option value="Manufacturer"
                                                            @if(in_array('Manufacturer', $business_types)) selected @endif >
                                                        Manufacturer
                                                    </option>
                                                    <option value="Trading Company"
                                                            @if(in_array('Trading Company', $business_types)) selected @endif >
                                                        Trading Company
                                                    </option>
                                                    <option value="Supplier Data"
                                                            @if(in_array('Supplier Data', $business_types)) selected @endif >
                                                        Supplier Data
                                                    </option>
                                                    <option value="Agent"
                                                            @if(in_array('Agent', $business_types)) selected @endif >
                                                        Agent
                                                    </option>
                                                    <option value="Others" id="others"
                                                            @if(in_array('Others', $business_types)) selected @endif >
                                                        Others
                                                    </option>
                                                </select>
                                                <input type="text" class="form-control mt-3" id="othersField"
                                                       name="other_business_type"
                                                       value="{{ old('other_business_type', $company->other_business_type) }}"
                                                       placeholder="Other Busniess Type"
                                                       @if($company->other_business_type) style="display: block;" @endif >
                                                <small class="text-danger" id="business_type_error"></small>
                                            </div>
                                            <div class="form-group col-md-6 other-div"
                                                 @if(in_array('Others', $business_types)) style="display: block;" @endif>
                                                <h6 class="d-none w-100 p-0">Add Business Type <span class="required">(Mandatory)</span>
                                                </h6>
                                                <input type="text" name="other_business_type"
                                                       placeholder="Add Business Type (Mandatory) - Input Other Business Type"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="natBusiness" class="d-none label">Nature of Business <small
                                                        class="font-500">(Optional)</small></label>
                                                <select class="form-control select2-multiple5" id="natBusiness" name="business_nature">
                                                    <option value=""></option>
                                                    <option disabled>Nature of Business (Optional)</option>
                                                    <option value=""
                                                            @if($company->business_nature == null) selected @endif >
                                                        ---- Select Nature of Business ---
                                                    </option>
                                                    <option value="Proprietorship"
                                                            @if($company->business_nature == "Proprietorship") selected @endif >
                                                        Proprietorship
                                                    </option>
                                                    <option value="Limited Company"
                                                            @if($company->business_nature == "Limited Company") selected @endif >
                                                        Limited Company
                                                    </option>
                                                    <option value="Private Limited Company"
                                                            @if($company->business_nature == "Private Limited Company") selected @endif >
                                                        Private Limited Company
                                                    </option>
                                                    <option value="Public Limited Company"
                                                            @if($company->business_nature == "Public Limited Company") selected @endif >
                                                        Public Limited Company
                                                    </option>
                                                    <option value="Partnership"
                                                            @if($company->business_nature == "Partnership") selected @endif >
                                                        Partnership
                                                    </option>
                                                    <option value="Others (Co-operative)"
                                                            @if($company->business_nature == "Others (Co-operative)") selected @endif >
                                                        Others (Co-operative)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="busReg" class="d-none label">Business License No. / Registration
                                                    No. <small class="font-500">(Optional)</small></label>
                                                <input type="text" id="busReg" class="form-control"
                                                       name="license_reg_no"
                                                       value="{{ old('license_reg_no', $company->registeration_no) }}"
                                                       placeholder="Business License No. / Registration No. (Optional) - Input Registration Number (if any)">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="year_established" class="d-none label">Year Established <small
                                                        class="font-500">(Optional)</small></label>
                                                <input type="number" class="form-control" id="year_established"
                                                       name="year_established"
                                                       onKeyPress="if(this.value.length==4) return false;"
                                                       value="{{ old('year_established', $company->year_established) }}"
                                                       placeholder="Year Established (Optional) - Input the Year Company was Established">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="no_of_employees" class="d-none label">Number of Employees <small
                                                        class="font-500">(Optional)</small></label>
                                                {{--                                                <input type="number" class="form-control" id="no_of_employees"--}}
                                                {{--                                                       name="no_of_employees"--}}
                                                {{--                                                       value=""--}}
                                                {{--                                                       placeholder="Number of employees">--}}
                                                <select class="form-control select2-multiple6" name="no_of_employees"
                                                        id="no_of_employees">
                                                    <option value=""></option>
                                                    <option disabled>Number of Employees (Optional)</option>
                                                    <option
                                                        value="0-10" {{ (old('no_of_employees', $company->no_of_employees) == '0-10') ? 'selected' : '' }}>
                                                        0-10
                                                    </option>
                                                    <option
                                                        value="Fewer than 50" {{ (old('no_of_employees', $company->no_of_employees) == 'Fewer than 50') ? 'selected' : '' }}>
                                                        Fewer than 50
                                                    </option>
                                                    <option
                                                        value="Fewer than 100" {{ (old('no_of_employees', $company->no_of_employees) == 'Fewer than 100') ? 'selected' : '' }}>
                                                        Fewer than 100
                                                    </option>
                                                    <option
                                                        value="More than 200" {{ (old('no_of_employees', $company->no_of_employees) == 'More than 200') ? 'selected' : '' }}>
                                                        More than 200
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="annual_turnover" class="d-none label">Annual Turnover <small
                                                        class="font-500">(Optional)</small></label>
                                                <input type="text" class="form-control" id="annual_turnover"
                                                       name="annual_turnover" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"
                                                       data-type="currency"
                                                       value="{{ old('annual_turnover', $company->annual_turnover) }}"
                                                       placeholder="Annual Turnover (Optional) - Input total turnover in Dollars i.e. $1,000,000">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="exMarket" class="d-none label">Export Market <small
                                                        class="font-500">(Optional)</small></label>
                                                <select class="form-control select2-multiple3" id="exMarket"
                                                        name="export_market[]" multiple>
                                                    <option value=""></option>
                                                    <option disabled>Export Market (Optional)</option>
                                                    <?php $export_markets = explode(",", $company->export_market); ?>
                                                    <option value=""
                                                            @if($company->export_market === null) selected @endif> ----
                                                        Select Export Market ---
                                                    </option>
                                                    <option value="Worldwide"
                                                            @if(in_array('Worldwide', $export_markets)) selected @endif >
                                                        Worldwide
                                                    </option>
                                                    <option value="Africa"
                                                            @if(in_array('Africa', $export_markets)) selected @endif >
                                                        Africa
                                                    </option>
                                                    <option value="Central Asia"
                                                            @if(in_array('Central Asia', $export_markets)) selected @endif >
                                                        Central Asia
                                                    </option>
                                                    <option value="Eastern Asia"
                                                            @if(in_array('Eastern Asia', $export_markets)) selected @endif >
                                                        Eastern Asia
                                                    </option>
                                                    <option value="Eastern Europe"
                                                            @if(in_array('Eastern Europe', $export_markets)) selected @endif >
                                                        Eastern Europe
                                                    </option>
                                                    <option value="Mid East"
                                                            @if(in_array('Mid East', $export_markets)) selected @endif >
                                                        Mid East
                                                    </option>
                                                    <option value="North America"
                                                            @if(in_array('North America', $export_markets)) selected @endif >
                                                        North America
                                                    </option>
                                                    <option value="Northern Europe"
                                                            @if(in_array('Northern Europe', $export_markets)) selected @endif >
                                                        Northern Europe
                                                    </option>
                                                    <option value="Oceania"
                                                            @if(in_array('Oceania', $export_markets)) selected @endif >
                                                        Oceania
                                                    </option>
                                                    <option value="South America"
                                                            @if(in_array('South America', $export_markets)) selected @endif >
                                                        South America
                                                    </option>
                                                    <option value="South Asia"
                                                            @if(in_array('South Asia', $export_markets)) selected @endif >
                                                        South Asia
                                                    </option>
                                                    <option value="Southeast Asia"
                                                            @if(in_array('Southeast Asia', $export_markets)) selected @endif >
                                                        Southeast Asia
                                                    </option>
                                                    <option value="Southern Europe"
                                                            @if(in_array('Southern Europe', $export_markets)) selected @endif >
                                                        Southern Europe
                                                    </option>
                                                    <option value="Western Europe"
                                                            @if(in_array('Western Europe', $export_markets)) selected @endif >
                                                        Western Europe
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="d-none label">Certifications <small class="font-500">(Optional)</small></label>
                                                <select class="form-control select2-multiple4" name="certifications[]"
                                                        multiple="multiple">
                                                    <option value=""></option>
                                                    <option disabled>Certifications (Optional)</option>
                                                    <?php $certifications = explode(",", $company->certifications); ?>
                                                    <option value="BCI"
                                                            @if(in_array('BCI', $certifications)) selected @endif >BCI
                                                    </option>
                                                    <option value="Bluesign"
                                                            @if(in_array('Bluesign', $certifications)) selected @endif >
                                                        Bluesign
                                                    </option>
                                                    <option value="BSCI"
                                                            @if(in_array('BSCI', $certifications)) selected @endif >BSCI
                                                    </option>
                                                    <option value="Cradle to Cradle"
                                                            @if(in_array('Cradle to Cradle', $certifications)) selected @endif >
                                                        Cradle to Cradle
                                                    </option>
                                                    <option value="D&B"
                                                            @if(in_array('D&B', $certifications)) selected @endif >D&B
                                                    </option>
                                                    <option value="Ecocert"
                                                            @if(in_array('Ecocert', $certifications)) selected @endif >
                                                        Ecocert
                                                    </option>
                                                    <option value="Fair Trade"
                                                            @if(in_array('Fair Trade', $certifications)) selected @endif >
                                                        Fair Trade
                                                    </option>
                                                    <option value="GOTS"
                                                            @if(in_array('GOTS', $certifications)) selected @endif >GOTS
                                                    </option>
                                                    <option value="Global Recycle Standard"
                                                            @if(in_array('Global Recycle Standard', $certifications)) selected @endif >
                                                        Global Recycle Standard
                                                    </option>
                                                    <option value="ISO"
                                                            @if(in_array('ISO', $certifications)) selected @endif >ISO
                                                    </option>
                                                    <option value="OEKO-TEX"
                                                            @if(in_array('OEKO-TEX', $certifications)) selected @endif >
                                                        OEKO-TEX
                                                    </option>
                                                    <option value="OHSAS"
                                                            @if(in_array('OHSAS', $certifications)) selected @endif >
                                                        OHSAS
                                                    </option>
                                                    <option value="REACH"
                                                            @if(in_array('REACH', $certifications)) selected @endif >
                                                        REACH
                                                    </option>
                                                    <option value="Sedex"
                                                            @if(in_array('Sedex', $certifications)) selected @endif >
                                                        Sedex
                                                    </option>
                                                    <option value="SA 8000"
                                                            @if(in_array('SA 8000', $certifications)) selected @endif >
                                                        SA 8000
                                                    </option>
                                                    <option value="WRAP"
                                                            @if(in_array('WRAP', $certifications)) selected @endif >WRAP
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class="d-block mb-2 heading">LOGO Image <small class="font-500">(Optional | JPG or PNG file only | Upto
                                                            10MB (Dimension: 93 x 93 Pixels) | Square image recommended)</small></span>
                                            <div class="avatar-wrapper">
                                                <img class="product-pic" id="buploaded_image31" src="{{$company->logo}}"/>
                                                <span class="position-absolute del-btn fa fa-trash"></span>
                                                <div class="product-upload-button">
                                                    <span class="fa fa-plus"></span>
                                                </div>
                                                <input class="product-file-upload" name="bavatar31" id="bavatar31" type="file" accept="image/*"/>
                                                <input name="bavatar31_url" type="hidden" value="" id="bavatar31_url" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class="d-block mb-2 heading">Company Images <small class="font-500">(Optional | JPG, PNG &amp; PDF files only | Upto 10MB)</small></span>
                                            <div class="dropzone dz-clickable">
                                                <div class="my-0 dz-default dz-message" data-dz-message="">
                                                    <div class="row mx-0 product-img-sheet">
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
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
                                                                       accept="image/*, .pdf"/>
                                                                <input name="sheet30_url" type="hidden" value=""
                                                                       id="sheet30_url"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        <div class="row">--}}
                                        {{--                                            @foreach (\App\CompanyImage::where('company_id', $company->id)->get() as $image)--}}
                                        {{--                                                <div id="{{ $image->id }}" class="col-md-3">--}}
                                        {{--                                                    <img src="{{ $image->image }}"--}}
                                        {{--                                                        class="w-100">--}}
                                        {{--                                                    <span class="fa fa-trash mr-2 del-photo" onclick="deleteImage({{ $image->id }})"></span>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                        </div>--}}
                                        <div class="form-row">
                                            <div class="col-md-12 mb-2">
                                                <div class="product-img-spec-container">
                                                    <h6 class="my-2 px-2 heading pro-spec-heading">Company Images And Sheets</h6>
                                                    <div class="product-images-gallery">
                                                        <ul class="mx-0 mb-2 product-gallery edit-comp-prof-imgs">
                                                            @foreach (\App\CompanyImage::where('company_id', $company->id)->get() as $image)
                                                                <?php $pathinfo = pathinfo($image->image);
                                                                $supported_ext = array('docx', 'xlsx', 'pdf');
                                                                $src_file_name = $image->image;
                                                                $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); ?>

                                                                @if($ext=="docx")
                                                                    <li class="position-relative d-inline-block px-1 my-1 d-flex justify-content-center align-items-center"
                                                                        data-src="{{$image->image}}"
                                                                        data-pinterest-text="Pin it"
                                                                        data-tweet-text="share on twitter">
                                                                        <img class="img-responsive product-img"
                                                                             src="{{$ASSETS}}/assets/front_site/images/file_icons/wordicon.png"
                                                                             style="filter: brightness(0.5)">
                                                                        <input type="hidden" name='sheet_id' value="{{encrypt($image->id)}}">
                                                                        <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$image->id}}"></span>
                                                                    </li>
                                                                @elseif($ext=="xlsx")
                                                                    <li class="position-relative d-inline-block px-1 my-1 d-flex justify-content-center align-items-center"
                                                                        data-src="{{$image->image}}"
                                                                        data-pinterest-text="Pin it"
                                                                        data-tweet-text="share on twitter">
                                                                        <img class="img-responsive product-img"
                                                                             src="{{$ASSETS}}/assets/front_site/images/file_icons/excelicon.png"
                                                                             style="filter: brightness(0.5)">
                                                                        <input type="hidden" name='sheet_id' value="{{encrypt($image->id)}}">
                                                                        <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$image->id}}"></span>
                                                                    </li>
                                                                @elseif($ext=="pdf")
                                                                    <li class="position-relative d-inline-block px-1 my-1 d-flex justify-content-center align-items-center"
                                                                        data-src="{{$image->image}}"
                                                                        data-pinterest-text="Pin it"
                                                                        data-tweet-text="share on twitter">
                                                                        <img class="img-responsive product-img"
                                                                             src="{{$ASSETS}}/assets/front_site/images/file_icons/pdficon.png"
                                                                             style="filter: brightness(0.5)">
                                                                        <input type="hidden" name='sheet_id' value="{{encrypt($image->id)}}">
                                                                        <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$image->id}}"></span>
                                                                    </li>
                                                                @else
                                                                    <li class="position-relative d-inline-block px-1 my-1">
                                                                        <input type="hidden" name='sheet_id' value="{{encrypt($image->id)}}">
                                                                        <span class="position-absolute border-0 specification-bin cross-sheet fa fa-trash cross-sheet" sheet_id="{{$image->id}}" aria-hidden="true" style="z-index: 1;right: -8px"></span>

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
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-12 mb-2 d-flex flex-column-reverse">
                                                <div class="d-flex flex-wrap justify-content-between order-1">
                                                    <label for="prDes" class="font-500 label">Company Introduction <span class="required">(Mandatory)</span></label>
                                                    {{--                                                <input type="text" id="prDes" class="form-control "--}}
                                                    {{--                                                       name="company_introduction"--}}
                                                    {{--                                                       value=""--}}
                                                    {{--                                                       placeholder="Company Introduction">--}}
                                                    <span class="d-block font-500">(Limit = 5000 Characters)</span>
                                                </div>
                                                <textarea class="form-control" name="company_introduction"
                                                          maxlength="5000"
                                                          placeholder="Company Introduction (Mandatory) - Introduce in 5000 characters"
                                                          id="editor1"
                                                          rows="5" required>{!! $company->company_introduction  !!} </textarea>
                                                <small class="text-danger" id="company_introduction_error"></small>
<!--                                                <span class="text-danger"><span id="company_introduction_count">0</span>/1200</span>-->
                                            </div>
                                        </div>
                                        <!-- <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="ieCode" class="font-500">IE Code</label>
                                                <input type="text" id="ieCode" class="form-control" name="IE Code" placeholder="IE Code">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="busReg" class="font-500">Business License No. / Registration No.</label>
                                                <input type="text" id="busReg" class="form-control" name="Business License No. / Registration No." placeholder="Business License No. / Registration No.">
                                            </div>
                                        </div> -->
                                        <!-- <div class="form-row">
                                            <div class="d-flex col-12 mb-2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="nA" name="radio-stacked" required>
                                                    <label class="custom-control-label" for="nA">N/A</label>
                                                </div>

                                                <div class="custom-control custom-radio ml-3">
                                                    <input type="radio" class="custom-control-input" id="csApplied" name="radio-stacked" required>
                                                    <label class="custom-control-label" for="csApplied">Applied</label>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="form-row">
                                            <label for="prDes" class="font-500">Profile / Brief Description</label>
                                            <input type="text" id="prDes" class="form-control" name="Profile / Brief Description" placeholder="Profile / Brief Description">
                                        </div> -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="business_owner" class="d-none label">Business Owner <small
                                                        class="font-500">(Optional)</small></label>
                                                <input type="text" class="form-control" id="business_owner"
                                                       name="business_owner"
                                                       value="{{ old('business_owner', $company->business_owner) }}"
                                                       placeholder="Business Owner (Optional) - Input Business Owner Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="alternate_contact" class="d-none label">Alternate Contact Number
                                                    <small class="font-500">(Optional)</small></label>
                                                <input type="tel" class="form-control mobileNum"
                                                       id="alternate_contact"
                                                       name="alternate_contact"
                                                       value="{{ old('alternate_contact', $company->alternate_contact) }}"
                                                       placeholder="Alternate Contact Number (Optional) - 03xxxxxxxxx/3xxxxxxxxx">
                                                <input type="hidden" name="alternate_contact_country_code">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="alternate_email" class="d-none label">Alternate Email <small
                                                        class="font-500">(Optional)</small></label>
                                                <input type="email" class="form-control" id="alternate_email"
                                                       name="alternate_email"
                                                       value="{{ old('alternate_email', $company->alternate_email) }}"
                                                       placeholder="Alternate Email (Optional) - Input alternate Email Address">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="alternate_address" class="d-none label">Alternate Office Address
                                                    <small class="font-500">(Optional)</small></label>
                                                <input type="text" class="form-control" id="alternate_address"
                                                       name="alternate_address"
                                                       value="{{ old('alternate_address', $company->alternate_address) }}"
                                                       placeholder="Alternate Office Address (Optional) - Input Current Office Address">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-1">
                                            <button type="submit" class="red-btn">Update</button>
                                        </div>

                                        <hr>

                                    </div>
                                    {{--                                    <div class="py-2 tab-pane fade" id="tabInfo" role="tabpanel"--}}
                                    {{--                                         aria-labelledby="tabInfo">--}}
                                    {{--                                        --}}
                                    {{--                                        <button type="submit" class="red-btn">Save</button>--}}
                                    {{--                                        <div class="my-2">--}}
                                    {{--                                            <hr>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
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
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
        $(document).on("change", 'select[name="business_type[]"]', function () {
            var other_div = $(this).closest('.form-group').siblings('.other-div');
            if ($(this).val().includes('Others')) {
                other_div.show();
                other_div.find('input[name=other_business_type]').prop('required', true);
            } else {
                other_div.hide();
                other_div.find('input[name=other_business_type]').prop('required', false);
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
                placeholder: "Choose Business Category (Mandatory)",
            });
            $('.select2-multiple2').select2({
                closeOnSelect: true,
                placeholder: "Choose Business Type (Mandatory)",
            });
            $('.select2-multiple3').select2({
                closeOnSelect: true,
                placeholder: "Choose the Export Market (Optional)",
            });
            $('.select2-multiple4').select2({
                closeOnSelect: true,
                placeholder: "Certifications (Optional) - Input Certifications (If any)",
            });
            $('.select2-multiple5').select2({
                closeOnSelect: true,
                placeholder: "Select Nature of Business (Optional)",
            });
            $('.select2-multiple6').select2({
                closeOnSelect: true,
                placeholder: "Number of Employees (Optional)",
            });

            var validator = $("form[name='companyForm']").validate({
                ignore: [],
                onfocusout: function (element) {
                    var $element = $(element);
                    if ($element.hasClass('select2-search__field')) {
                        var $element2 = $element.closest('.form-group').find('select');
                        if ($element2.prop('required')) {
                            this.element($element2)
                        } else if ($element2.val() != '') {
                            this.element($element2)
                        }
                    } else {
                        if ($element.prop('required')) {
                            this.element(element)
                        } else if ($element.val() != '') {
                            this.element($element)
                        }
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
                        elem.closest('.form-group').find('.select2-container').addClass(errorClass);
                    } else {
                        elem.addClass(errorClass);
                    }
                },
                unhighlight: function (element, errorClass, validClass) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        elem.closest('.form-group').find('.select2-container').removeClass(errorClass);
                    } else {
                        elem.removeClass(errorClass);
                        elem.addClass(validClass);
                    }
                },
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    if (elem.hasClass("select2-hidden-accessible")) {
                        element = elem.closest('.form-group').find('.select2-container');
                        error.insertAfter(element);
                    } else if (elem.attr('id') == 'alternate_contact') {
                        element = elem.closest('.form-group').find('.iti--allow-dropdown');
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $('.select2-multiple').on("change", function (e) {
                $("form[name='companyForm']").valid()
            });

            var options = {
                dataType: 'JSON',
                beforeSerialize: function ($form, options) {
                    $('input[name=alternate_contact_country_code]').val($("#alternate_contact").intlTelInput('getSelectedCountryData').dialCode);
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
                    $('#alert-success-update-company').hide();
                    $('#alert-error-update-company').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;

                    if (response.feedback == "updated") {
                        // $('html, body').animate({scrollTop: 0}, 'slow');
                        // $("#alert-success-update-company").show().html("Company successfully updated.");
                        toastr.success("Company profile updated successfully.");
                        window.location.href = response.url;
                    } else if (response.feedback == "validation_error") {
                        $form.find('button[type=submit]').prop('disabled', false);
                        $('html, body').animate({scrollTop: ($('#' + Object.keys(response.errors)[0]).offset().top)}, 'slow');
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    }
                },
                error: function (jqXHR, exception) {
                    $("#loader").hide();
                    $('button[type=submit]').prop('disabled', false);
                    $('#alert-success-update-company').hide();
                    $('#alert-error-update-company').hide();
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
                    $('#alert-error-update-company').html(msg);
                    $('#alert-error-update-company').show();
                },

            };
            $('#updateCompany').ajaxForm(options);

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
            /*$(document).on('change', '#sheet16', function (event) {
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

            });*/
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
                            $.post("{{ route('imageRemove') }}", {
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
        });
    </script>
@endpush
