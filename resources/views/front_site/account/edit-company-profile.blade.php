@extends('front_site.master_layout')

@push('css')
    <style>
        .del-photo {
            position: absolute;
            right: 10px;
            top: 5px;
            font-size: 18px;
            color: red;
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
                <div id="page-content-wrapper" style="background: #d9eefe8c">

                    <div class="px-2 py-1">
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
                                <div class="px-0 py-3 tab-pane fade show active" id="tabProfile" role="tabpanel"
                                     aria-labelledby="linkProfile">
                                    <div class="edit-about-us-section">

                                        <h6 class="heading">About<span @if($usercomp->is_admin==1)
                                                class="fa fa-edit edit-btn about-edit-btn" @endif></span></h6>
                                        <p class="text">{{ $company->company_introduction }}</p>
                                    </div>
                                    <div class="mt-4 mb-4">
                                        <hr>
                                    </div>
                                    <div class="edit-company-section">
                                        <h6 class="heading">Business Information<span @if($usercomp->is_admin==1)
                                                class="fa fa-edit edit-btn com-edit-btn" @endif></span></h6>
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Name</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>{{ $company->company_name }}</span>
                                            </div>
                                        </div>
                                    <!-- <div class="row text mb-2">
										<div class="col-sm-6 col-6">
											<span class="font-500">Designation</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>@if($user->designation) {{ $user->designation}} @else - @endif</span>
										</div>
									</div> -->
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Business Type</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>{{ $company->business_type}}</span>
                                            </div>
                                        </div>
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Nature of Business</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->business_nature) {{ $company->business_nature}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Export Market</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->export_market) {{ $company->export_market}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Year of Establishment</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->year_established) {{ $company->year_established}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">No of Employees</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->no_of_employees) {{ $company->no_of_employees}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Certification</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->certifications) {{ $company->certifications}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Annual Turnover(In USD Million)</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->annual_turnover) {{ $company->annual_turnover}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <!-- <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">IE Code</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>-</span>
                                            </div>
                                        </div> -->
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Licence No/ Reg No</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->registeration_no) {{ $company->registeration_no}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="edit-location-section">
                                            <div class="mt-4 mb-4">
                                                <hr>
                                            </div>
                                            <h6 class="heading">Additional Information<span @if($usercomp->is_admin==1)
                                                    class="fa fa-edit edit-btn com-edit-btn" @endif></span></h6>
                                            <div class="row text mb-2">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Business Owner</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($company->business_owner) {{ $company->business_owner}} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text mb-2">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Alternate Contact Number</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($company->alternate_contact) {{ $company->alternate_contact}} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text mb-2">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Alternate Email</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($company->alternate_email) {{ $company->alternate_email}} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text mb-2">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Alternate Office Address</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($company->alternate_address) {{ $company->alternate_address}} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                        <!-- <div class="row text mb-2">
										<div class="col-sm-6 col-6">
											<span class="font-500">State</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->state}}</span>
										</div>
									</div>
									<div class="row text mb-2">
										<div class="col-sm-6 col-6">
											<span class="font-500">Country</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->country}}</span>
										</div>
									</div>
									<div class="row text mb-2">
										<div class="col-sm-6 col-6">
											<span class="font-500">Mobile</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->phone_no}}</span>
										</div>
									</div>
									<div class="row text mb-2">
										<div class="col-sm-6 col-6">
											<span class="font-500">Email</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->email}}</span>
										</div>
									</div> -->
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-4">
                                        <hr>
                                    </div>
                                </div>
                                <div class="px-0 py-1 tab-pane fade" id="tabLocation" role="tabpanel"
                                     aria-labelledby="linkLocation">
                                    <div class="edit-location-section">
                                        <h6 class="heading">Additional Information<span
                                                class="fa fa-edit edit-btn extra-edit-btn"></span></h6>
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Business Owner</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->business_owner) {{ $company->business_owner}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Alternate Contact Number</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->alternate_contact) {{ $company->alternate_contact}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Alternate Email</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->alternate_email) {{ $company->alternate_email}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                        <div class="row text mb-2">
                                            <div class="col-sm-6 col-6">
                                                <span class="font-500">Alternate Office Address</span>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <span>@if($company->alternate_address) {{ $company->alternate_address}} @else
                                                        - @endif</span>
                                            </div>
                                        </div>
                                    <!-- <div class="row text mb-2">
										<div class="col-sm-6 col-6">
											<span class="font-500">State</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->state}}</span>
										</div>
									</div>
									<div class="row text mb-2">
										<div class="col-sm-6 col-6">
											<span class="font-500">Country</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->country}}</span>
										</div>
									</div>
									<div class="row text mb-2">
										<div class="col-sm-6 col-6">
											<span class="font-500">Mobile</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->phone_no}}</span>
										</div>
									</div>
									<div class="row text mb-2">
										<div class="col-sm-6 col-6">
											<span class="font-500">Email</span>
										</div>
										<div class="col-sm-6 col-6">
											<span>{{ $user->email}}</span>
										</div>
									</div> -->
                                    </div>
                                    <div class="mt-4 mb-4">
                                        <hr>
                                    </div>
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
                                <li class="nav-item ml-auto">
                                    <button class="red-btn close-form">Close</button>
                                </li>
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link" id="linkInfo" data-toggle="tab" href="#tabInfo" role="tab"--}}
                                {{--                                       aria-controls="tabInfo" aria-selected="false">ADDITIONAL INFO</a>--}}
                                {{--                                </li>--}}
                            </ul>
                            <form id="updateCompany" method="post" name="companyForm"
                                  action="{{ route('update-company-profile') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input type="hidden" id="company_id" class="form-control" name="company_id" value="{{ $company->id }}">
                                <div class="tab-content company-profile" id="myCompanyTab">
                                        <div class="px-0 py-1 tab-pane fade show active" id="tabCom" role="tabpanel"
                                             aria-labelledby="tabCom">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="company" class="font-500">Company Name <span
                                                        class="required">*</span></label>
                                                <input type="text" id="company" class="form-control" name="company_name"
                                                       value="{{$company->company_name}}"
                                                       placeholder="Company Name">
                                                <small class="text-danger" id="company_error"></small>
                                            </div>
                                        <!-- <div class="form-group col-md-6">
				                        <label for="industry" class="label">Industry <span class="required">*</span></label>

				                        <select class="form-control choose-services  selectpicker" name="industry[]" multiple>
				                            @foreach (\App\Category::all() as $item)
                                            <option value="{{$item->id}}" @if($company->industry->where('id', $item->id)->first() != null) selected @endif>{{$item->name}}</option>
				                            @endforeach
                                            </select>
                                            <small class="text-danger" id="industry_error"></small>
                                        </div> -->
                                            <div class="form-group col-md-6">
                                                <label for="industry" class="label d-block">Business Category <span
                                                        class="required">*</span></label>
                                                <select class="form-control select2-multiple1" id="industry"
                                                        name="industry[]"
                                                        multiple="multiple">
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
                                                <label class="label d-block">Business Type <span
                                                        class="required">*</span></label>
                                                <select class="form-control select2-multiple2" name="business_type[]"
                                                        multiple="multiple">
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
                                                <h6 class="w-100 p-0">Add Business Type <span class="required">*</span>
                                                </h6>
                                                <input type="text" name="other_business_type"
                                                       placeholder="Input Other Business Type"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="natBusiness" class="font-500">Nature of Business <small
                                                        class="font-500">(Optional)</small></label>
                                                <select class="form-control" id="natBusiness" name="business_nature">
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
                                                <label for="busReg" class="font-500">Business License No. / Registration
                                                    No. <small class="font-500">(Optional)</small></label>
                                                <input type="text" id="busReg" class="form-control"
                                                       name="license_reg_no"
                                                       value="{{ old('license_reg_no', $company->registeration_no) }}"
                                                       placeholder="Input Registration Number (if any)">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="year_established" class="label">Year Established <small
                                                        class="font-500">(Optional)</small></label>
                                                <input type="number" class="form-control" id="year_established"
                                                       name="year_established"
                                                       onKeyPress="if(this.value.length==4) return false;"
                                                       value="{{ old('year_established', $company->year_established) }}"
                                                       placeholder="Input the Year Company was Established">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="no_of_employees" class="label">Number of Employees <small
                                                        class="font-500">(Optional)</small></label>
                                                {{--                                                <input type="number" class="form-control" id="no_of_employees"--}}
                                                {{--                                                       name="no_of_employees"--}}
                                                {{--                                                       value=""--}}
                                                {{--                                                       placeholder="Number of employees">--}}
                                                <select class="form-control" name="no_of_employees"
                                                        id="no_of_employees">
                                                    <option value="">Input total number of Employees</option>
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
                                                <label for="annual_turnover" class="label">Annual Turnover <small
                                                        class="font-500">(Optional)</small></label>
                                                <input type="text" class="form-control" id="annual_turnover"
                                                       name="annual_turnover" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"
                                                       data-type="currency"
                                                       value="{{ old('annual_turnover', $company->annual_turnover) }}"
                                                       placeholder="Input total turnover in Dollars i.e. $1,000,000">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="exMarket" class="font-500">Export Market <small
                                                        class="font-500">(Optional)</small></label>
                                                <select class="form-control select2-multiple3" id="exMarket"
                                                        name="export_market[]" multiple>
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
                                                <label class="label d-block">Certifications <small class="font-500">(Optional)</small></label>
                                                <select class="form-control select2-multiple4" name="certifications[]"
                                                        multiple="multiple">
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
                                            <span class="d-block heading">LOGO Image <small
                                                    class="font-500">(Optional)</small></span>
                                            <div class="avatar-wrapper">
                                                <img class="profile-pic"
                                                     src="{{ asset('public/assets/front_site/images/company-images/'.$company->logo) }}"/>
                                                <div class="upload-button">
                                                    <span class="fa fa-plus"></span>
                                                </div>
                                                <input class="file-upload" type="file" name="logo_image"
                                                       accept="image/*"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <span class="d-block heading">Company Images <small class="font-500">(Optional)</small></span>
                                            <div class="dropzone dz-clickable" id="myDrop">
                                                <div class="dz-default dz-message"
                                                     data-dz-message="">
				                            <span class="fileinput-button">
				                                <span class="fa fa-upload pr-2"></span>
				                                Drop files here to upload
				                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @foreach (\App\CompanyImage::where('company_id', $company->id)->get() as $image)
                                                <div id="{{ $image->id }}" class="col-md-3">
                                                    <img
                                                        src="{{ asset('public/assets/front_site/images/company-images/'.$image->image) }}"
                                                        class="w-100">
                                                    <span class="fa fa-trash mr-2 del-photo"
                                                          onclick="deleteImage({{ $image->id }})"></span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-2">
                                                <label for="prDes" class="font-500">Company Introduction <small
                                                        class="font-500">(Optional)</small></label>
                                                {{--                                                <input type="text" id="prDes" class="form-control "--}}
                                                {{--                                                       name="company_introduction"--}}
                                                {{--                                                       value=""--}}
                                                {{--                                                       placeholder="Company Introduction">--}}
                                                <small class="text-danger" id="company_introduction_error"></small>
                                                <textarea class="form-control" name="company_introduction"
                                                          maxlength="1200"
                                                          placeholder="Introduce your company in 1200 characters"
                                                          id="company_introduction"
                                                          rows="5">{{ old('company_introduction', $company->company_introduction) }}</textarea>
                                                <small class="text-danger" id="company_introduction_error"></small>
                                                <span class="text-danger"><span id="company_introduction_count">0</span>/300</span>
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
                                            <div class="form-group mb-3 col-md-6">
                                                <label for="business_owner" class="font-500">Business Owner <small
                                                        class="font-500">(Optional)</small></label>
                                                <input type="text" class="form-control" id="business_owner"
                                                       name="business_owner"
                                                       value="{{ old('business_owner', $company->business_owner) }}"
                                                       placeholder="Input Business Owner Name">
                                            </div>
                                            <div class="form-group mb-3 col-md-6">
                                                <label for="alternate_contact" class="font-500">Alternate Contact Number
                                                    <small class="font-500">(Optional)</small></label>
                                                <input type="text" class="form-control mobileNum is-valid"
                                                       id="alternate_contact"
                                                       name="alternate_contact"
                                                       value="{{ old('alternate_contact', $company->alternate_contact) }}"
                                                       placeholder="03xxxxxxxxx/3xxxxxxxxx">
                                                <input type="hidden" name="alternate_contact_country_code">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group mb-3 col-md-6">
                                                <label for="alternate_email" class="font-500">Alternate Email <small
                                                        class="font-500">(Optional)</small></label>
                                                <input type="email" class="form-control" id="alternate_email"
                                                       name="alternate_email"
                                                       value="{{ old('alternate_email', $company->alternate_email) }}"
                                                       placeholder="Input alternate Email Address">
                                            </div>
                                            <div class="form-group mb-3 col-md-6">
                                                <label for="alternate_address" class="font-500">Alternate Office Address
                                                    <small class="font-500">(Optional)</small></label>
                                                <input type="text" class="form-control" id="alternate_address"
                                                       name="alternate_address"
                                                       value="{{ old('alternate_address', $company->alternate_address) }}"
                                                       placeholder="Input Current Office Address">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-3">
                                            <button type="submit" class="red-btn">Update</button>
                                        </div>
                                        <div class="mt-4 mb-4">
                                            <hr>
                                        </div>
                                    </div>
                                    {{--                                    <div class="p-3 tab-pane fade" id="tabInfo" role="tabpanel"--}}
                                    {{--                                         aria-labelledby="tabInfo">--}}
                                    {{--                                        --}}
                                    {{--                                        <button type="submit" class="red-btn">Save</button>--}}
                                    {{--                                        <div class="mt-4 mb-4">--}}
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
    <script type="text/javascript">
        function deleteImage(id) {
            $.ajax({
                url: "{{ asset('imageRemove') }}/" + id,
                type: "GET",
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response, statusText, xhr, $form) {
                    if (response.msg) {
                        $('#' + id).remove();
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }

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

        Dropzone.autoDiscover = false;
        $(document).ready(function () {
            $('#company_introduction_count').text($("#company_introduction").val().length);
            $("#company_introduction").on('keyup', function () {
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
                closeOnSelect: false,
                placeholder: "Choose Business Category",
            });
            $('.select2-multiple2').select2({
                closeOnSelect: false,
                placeholder: "Choose Business Category",
            });
            $('.select2-multiple3').select2({
                closeOnSelect: false,
                placeholder: "Choose the Export Market",
            });
            $('.select2-multiple4').select2({
                closeOnSelect: false,
                placeholder: "Input Certifications (If any)",
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
                    alternate_contact: {
                        phoneNumberFormat: true
                    }
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

            var myDropzone = new Dropzone("div#myDrop", {
                companyId: '',
                url: "{{route('company-images')}}",
                addRemoveLinks: true,
                dictRemoveFile: '<span class="fa fa-trash delete"></span>',
                autoProcessQueue: false,
                parallelUploads: 5,
                maxFiles: 15,
                acceptedFiles: 'image/*',
                paramName: "file",
                init: function () {
                    let thisDropzone = this;
                    this.on('sending', function (file, xhr, formData) {
                        formData.append('companyId', thisDropzone.companyId);
                    });

                    console.log('init');
                    this.on("maxfilesexceeded", function(file){
                        alert("You cannot upload more than 15 images!");
                        this.removeFile(file);
                    });
                }
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
                        myDropzone.companyId = response.company_id;
                        myDropzone.processQueue();
                        toastr.success("Company profile updated successfully.");
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 2000);
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
        });
    </script>
@endpush
