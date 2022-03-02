@extends('front_site.master_layout')
@section('content')
    <body class="dashboard">
    <style>
        .iti.iti--allow-dropdown {
            width: 100%;
        }
        .my-account-avatar {
            width: 135px!important;
            height: 135px!important;
        }
    </style>
    <main id="maincontent" class="page-main">
        <div class="d-flex edit-company-profile" id="dashboardWrapper">
            <!-- Sidebar -->
        <!-- Sidebar -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper" >
                <div class="px-2 py-1">
                    <div id="companyTab1">
                        <ul class="nav nav-tabs" id="myCompanyLinks" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="linkProfile" data-toggle="tab" href="#tabProfile"
                                   role="tab" aria-controls="tabProfile" aria-selected="true">PROFILE</a>
                            </li>
                            {{--                            <li class="nav-item">--}}
                            {{--                                <a class="nav-link" id="linkLocation" data-toggle="tab" href="#tabLocation" role="tab"--}}
                            {{--                                   aria-controls="tabLocation" aria-selected="false">ADDITIONAL INFO</a>--}}
                            {{--                            </li>--}}
                        </ul>
                        <div class="tab-content" id="myCompanyTab">
                            <div class="px-0 py-3 tab-pane fade show active" id="tabProfile" role="tabpanel"
                                 aria-labelledby="linkProfile">
                                <div class="row">
                                    <div class="col-md-8 order-md-1 order-2">
                                        <div class="edit-company-section">
                                            <h6 class="heading">Personal Information<span
                                                    class="fa fa-edit edit-btn profile-edit-btn"></span></h6>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Name</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Email</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $user->email }}</span>
                                                </div>
                                            </div>
                                            @if($user->is_owner)
                                                <div class="row text">
                                                    <div class="col-sm-6 col-6">
                                                        <span class="font-500">Member Type</span>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
											<span>
												@for( $i=0; $i < count($user->types) ; $i++ )
                                                    @if( $i == count($user->types)-1 )
                                                        {{ $user->types[$i]->title }}
                                                    @else
                                                        {{ $user->types[$i]->title }},
                                                    @endif
                                                @endfor
											</span>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Designation</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->designation) {{ $user->designation }} @else - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Gender</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->gender) {{ $user->gender }} @else - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Mobile Number</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>{{ $user->registration_phone_no }}</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Address</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                            <span>@if($user->street_address) {{ $user->street_address }}
                                                ,@endif {{ $user->city }}, {{ $user->state }}, {{ $user->country }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4 order-md-2 order-1 my-md-0 text-md-left text-center">
                                        {{--<img class="object-cover rounded-circle header-profile-pic" src="{{ get_user_image(Auth::user()) }}" width="135" height="135">--}}
<!--                                        <div class="d-flex justify-content-center align-items-center avatar-wrapper rounded-circle my-account-avatar">-->
                                        <div class="avatar-wrapper rounded-circle my-account-avatar">
                                            {{--<img class="profile-pic" id="uploaded_image" src="{{ get_user_image(Auth::user()) }}"/>--}}
                                            <div class="position-absolute spinner-border text-danger loader-spinner d-none" role="status" style="z-index: 1">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <img class="w-100 h-100 object-cover rounded-circle header-profile-pic" id="uploaded_image1" src="{{ get_user_image(Auth::user()) }}">
                                            <div class="upload-button rounded-circle">
                                                <span class="fa fa-plus"></span>
                                            </div>
                                            <input class="file-upload" name="avatar" id="avatar1" type="file" accept="image/*"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <hr>
                                </div>
                                <div class="edit-location-section">
                                    <h6 class="heading">Additional Information<span
                                            class="fa fa-edit edit-btn profile-edit-btn"></span></h6>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Company / Institute</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                     <span>@if($user->company_name) {{ $user->company_name }} @else
                                                             - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Interested Categories</span>
                                                </div>
                                                <?php $userinterest = \App\UserInterest::where('user_id',auth()->id())->pluck('category_id');
                                                $userint = \App\Category::whereIn('id',$userinterest)->pluck('name')->toArray();?>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($userinterest) {{ implode(', ',$userint) }} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Whatsapp Number</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->whatsapp_number && $user->whatsapp_number != '+92') {{ $user->whatsapp_number }} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Whatsapp Number</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->whatsapp_number && $user->whatsapp_number != '+92') {{ $user->whatsapp_number }} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Telephone Number</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->telephone && $user->telephone != '+92') {{ $user->telephone }} @else
                                                            - @endif</span>
                                                </div>
                                            </div>
{{--                                            <div class="row text">--}}
{{--                                                <div class="col-sm-6 col-6">--}}
{{--                                                    <span class="font-500">Fax</span>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-6 col-6">--}}
{{--                                                    <span>@if($user->fax && $user->fax != '+92') {{ $user->fax }} @else--}}
{{--                                                            - @endif</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Post Code</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>@if($user->postcode) {{ $user->postcode }} @else - @endif</span>
                                                </div>
                                            </div>
                                            <div class="row text">
                                                <div class="col-sm-6 col-6">
                                                    <span class="font-500">Website Address</span>
                                                </div>
                                                <div class="col-sm-6 col-6">
                                                    <span>
                                                        @if($user->website)
                                                            <a href="{{ $user->website }}">{{ $user->website }}</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <hr>
                                </div>
                                <div class="edit-location-section">
                                    <h6 class="heading">Parent Company Name</h6>
                                    <div class="row text">
                                        <div class="col-sm-6 col-6">
                                            <?php $comp = \App\CompanyProfile::where('user_id',auth()->id())->first();?>
                                            <span>@if($comp) {{getUserFirstCompany()}} @else No Parent Company Created as yet @endif </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            <div class="p-3 tab-pane fade" id="tabLocation" role="tabpanel"--}}
                            {{--                                 aria-labelledby="linkLocation">--}}


                            {{--                                <div class="my-1">--}}
                            {{--                                    <hr>--}}
                            {{--                                </div>--}}

                            {{--                            </div>--}}
                        </div>
                    </div>
                    <div id="companyTab2">
                        <div id='alert-success-update-account' class="alert alert-success py-2" style="display: none;">
                        </div>
                        <div id='alert-error-update-account' class="alert alert-danger py-2" style="display: none;">
                        </div>
                        <ul class="nav nav-tabs" id="aboutLinks" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="linkReg" data-toggle="tab" href="#tabReg" role="tab"
                                   aria-controls="tabReg" aria-selected="true">ACCOUNT DETAILS</a>
                            </li>
                            <li class="nav-item ml-auto">
                                <button class="red-btn close-form" href="#add-cancil" data-toggle="modal">CLOSE</button>
                            </li>
                            <li class="nav-item ml-1">
                                <button type="submit" class="red-btn" form="updateAccount">Update</button>
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
                        <form id="updateAccount" name="updateAccount" method="post"
                              action="{{ route('update-my-account') }}">
                            @csrf
                            @method('put')
                            <div class="tab-content" id="myCompanyTab">
                                <div class="px-0 py-1 tab-pane fade show active" id="tabReg" role="tabpanel"
                                     aria-labelledby="tabReg">
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="email" id="email" class="form-control" name="email"
                                                   value="{{ old('email', $user->email) }}" placeholder="Email (Mandatory) - example@gmail.com (Mandatory)">
                                            <small class="text-danger" id="email_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <select id="designation" name='designation' class="form-control single-select-dropdown">
                                                <option value=""></option>
                                                <option disabled>Select Designation (Optional)</option>
                                                <option value="Director"
                                                        @if($user->designation == "Director") selected @endif >Director
                                                </option>
                                                <option value="CEO" @if($user->designation == "CEO") selected @endif >
                                                    CEO
                                                </option>
                                                <option value="General Manager"
                                                        @if($user->designation == "General Manager") selected @endif >
                                                    General Manager
                                                </option>
                                                <option value="Owner"
                                                        @if(is_null($user->designation)) selected @elseif($user->designation == "Owner") selected @endif >Owner
                                                </option>
                                                <option value="Entrepreneur"
                                                        @if($user->designation == "Entrepreneur") selected @endif >
                                                    Entrepreneur
                                                </option>
                                                <option value="Marketing"
                                                        @if($user->designation == "Marketing") selected @endif >
                                                    Marketing
                                                </option>
                                                <option value="Sales"
                                                        @if($user->designation == "Sales") selected @endif >Sales
                                                </option>
                                                <option value="Purchasing"
                                                        @if($user->designation == "Purchasing") selected @endif >
                                                    Purchasing
                                                </option>
                                                <option value="Technical & Engineering"
                                                        @if($user->designation == "Technical & Engineering") selected @endif >
                                                    Technical & Engineering
                                                </option>
                                                <option value="Administration"
                                                        @if($user->designation == "Administration") selected @endif >
                                                    Administration
                                                </option>
                                                <option value="Others" id="otherUser"
                                                        @if($user->designation == "Other") selected @endif >Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="text" class="form-control"
                                                   value="{{ old('first_name', $user->first_name) }}"
                                                   placeholder="First Name (Mandatory)" name="first_name" id="first_name">
                                            <small class="text-danger" id="first_name_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="text" name="last_name" class="form-control"
                                                   value="{{ old('last_name', $user->last_name) }}"
                                                   placeholder="Last Name (Mandatory)" id="last_name">
                                            <small class="text-danger" id="last_name_error"></small>
                                        </div>
                                    </div>
                                    @if($user->is_owner)
                                        <div class="form-row user-type-section">
                                            {{--                                            <h6 class="w-100 pl-0">User Type <span class="required">(Mandatory)</span></h6>--}}
                                            <div class="form-group mb-1 user-type col-xl-9 col-lg-12">
                                                <label for="last_name" class="font-500">User Type <span
                                                        class="required">(Mandatory)</span></label>
                                                @foreach (\App\UType::limit(3)->get() as $type)
                                                    @if($user->types->find($type->id))
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input" id="{{$type->id}}" value="{{$type->id}}" data-id="{{$type->id}}" name="user_type[]" checked>
                                                            <label class="custom-control-label" for="{{$type->id}}">{{$type->title}}</label>
                                                        </div>
                                                    @else
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input type="checkbox" class="custom-control-input" id="{{$type->id}}" value="{{$type->id}}" data-id="{{$type->id}}" name="user_type[]">
                                                            <label class="custom-control-label" for="{{$type->id}}">{{$type->title}}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <small class="text-danger" id="user_type_error"></small>
                                            </div>
                                        </div>
                                    @endif
                                    <label class="font-500">Gender <span class="required">(Mandatory)</span></label>
                                    <div class="my-1">
                                        <div class="d-flex">
                                            <div class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                <input type="radio" class="custom-control-input" name="gender" id="male"
                                                       value="Male" @if(is_null($user->gender)) checked @elseif($user->gender == "Male") checked @endif>
                                                <label class="custom-control-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline custom-control custom-radio d-sm-inline">
                                                <input type="radio" class="custom-control-input" name="gender" id="female"
                                                       value="Female" @if($user->gender == "Female") checked @endif>
                                                <label class="custom-control-label" for="female">Female</label>
                                            </div>
                                        </div>
                                        <small class="text-danger" id="gender_error"></small>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1 d-flex flex-column-reverse">
                                            <select name="country" id="country_id" class="form-control single-select-dropdown"
                                                    required="required">
                                                <option value=""></option>
                                                <option disabled>Select Country/Region (Mandatory)</option>
                                                @foreach($countries as $country)
                                                        <option value="{{ $country->name->common }}" {{($user->country == $country->name->common)?'selected':''}}>{{ $country->name->common }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger" id="country_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1 d-flex flex-column-reverse">
                                            <select name="state" id="state" required
                                                    class="form-control single-select-dropdown">
                                                <option value=""></option>
                                                <option disabled>State/Province (Mandatory)</option>
                                                <option value="{{$user->state}}" selected>{{$user->state}}</option>
                                            </select>
                                            <small class="text-danger" id="state_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1 d-flex flex-column-reverse">
                                            <select name="city" id="city" required class="form-control single-select-dropdown">
                                                <option value=""></option>
                                                <option disabled>City (Mandatory)</option>
                                                <option value="{{$user->city}}" selected>{{$user->city}}</option>
                                            </select>
                                            <small class="text-danger" id="city_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="text" id="Cty" class="form-control" name="street_address"
                                                   value="{{ old('street_address', $user->street_address) }}"
                                                   placeholder="Street Address (Optional)">
                                            <small class="text-danger" id="street_address_error"></small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" placeholder="Input Business Company Name OR Institute Name for Students"
                                                   value="{{$user->company_name}}" name="company_name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select name="category[]" class="form-control select2-multiple" id="category" multiple>
                                                <option value=""></option>
                                                <option disabled>Categories (Optional)</option>
                                                <?php $userinterest = \App\UserInterest::where('user_id',auth()->id())->pluck('category_id')->toArray();?>
                                                <option value="5" @if(in_array("5",$userinterest)) selected @endif>Fibers & Materials</option>
                                                <option value="6" @if(in_array("6",$userinterest)) selected @endif>
                                                    Machinery & Parts
                                                </option>
                                                <option value="7" @if(in_array("7",$userinterest)) selected @endif>
                                                    PPE & Institutional
                                                </option>
                                                <option value="8" @if(in_array("8",$userinterest)) selected @endif>Dyes & Chemicals
                                                </option>
                                                <option value="9" @if(in_array("9",$userinterest)) selected @endif>
                                                    Garments & Accessories
                                                </option>
                                                <option value="10" @if(in_array("10",$userinterest)) selected @endif>
                                                    Unstitched & Leftovers
                                                </option>
                                                <option value="11" @if(in_array("11",$userinterest)) selected @endif>HR & Admin
                                                </option>
                                                <option value="12" @if(in_array("12",$userinterest)) selected @endif>
                                                    Accounts & IT
                                                </option>
                                                <option value="13" @if(in_array("13",$userinterest)) selected @endif>
                                                    Erection & Commissioning
                                                </option>
                                                <option value="14" @if(in_array("14",$userinterest)) selected @endif>
                                                    PD & Sourcing
                                                </option>
                                                <option value="15" @if(in_array("15",$userinterest)) selected @endif>
                                                    Operations & Reporting
                                                </option>
                                                <option value="16" @if(in_array("16",$userinterest)) selected @endif>
                                                    Quality & Consultation
                                                </option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="tel" required name="mobileNumber"
                                                   class="form-control inteltel is-valid"
                                                   id="mobileNumber"
                                                   value="{{ old('mobile', $user->registration_phone_no) }}" placeholder="Mobile - 03xxxxxxxxx/3xxxxxxxxx">
                                            <span class="text-danger hide row pl-3 tel-error-msg">Please enter valid mobile number</span>
                                            <input type="hidden" name="mobile_country_code">
                                            <small class="text-danger d-block" id="mobileNumber_error"></small>
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="text" id="postcode" class="form-control" name="postcode"
                                                   value="{{ old('postcode', $user->postcode) }}"
                                                   placeholder="Post Code (Optional)">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="url" id="url" class="form-control" name="url"
                                                   value="{{ old('url', $user->website) }}"
                                                   placeholder="Website (Optional) - Example: https://www.bizonair.com">
                                        </div>
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="tel" id="whatsappNumber" class="form-control inteltel is-valid"
                                                   name="whatsapp"
                                                   value="{{ old('whatsapp', $user->whatsapp_number) }}"
                                                   placeholder="Whatsapp (Optional) - 03xxxxxxxxx/3xxxxxxxxx">
                                            <span class="text-danger hide row pl-3 tel-error-msg">Please enter valid mobile number</span>
                                            <input type="hidden" name="whatsapp_country_code">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-1">
                                            <input type="tel" id="mobileNumber3"
                                                   class="form-control mobileNum inteltel is-valid"
                                                   name="telephone"
                                                   value="{{ old('telephone', $user->telephone) }}"
                                                   placeholder="Telephone (Optional) - 03xxxxxxxxx/3xxxxxxxxx">
                                            <span class="text-danger hide row pl-3 tel-error-msg">Please enter valid mobile number</span>
                                            <input type="hidden" name="telephone_country_code">
                                        </div>
                                    </div>
<!--                                    <div class="d-flex justify-content-between mt-1">
                                        <button type="submit" class="red-btn">Update</button>
                                    </div>-->
                                    <div class="my-1">
                                        <hr>
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
    <script>
        $(document).ready(function () {
            /*single select dropdown*/
            $('#category').select2({
                closeOnSelect: true,
                placeholder: "I am interested in Categories (Optional)"
            });

            $('select[name=designation]').select2({
                closeOnSelect: true,
                placeholder: "Select Designation (Optional)"
            });

            $('#country_id').select2({
                closeOnSelect: true,
                placeholder: "Select Country/Region (Mandatory)"
            });

            $('#state').select2({
                closeOnSelect: true,
                placeholder: "State/Province (Mandatory)"
            });

            $('#city').select2({
                closeOnSelect: true,
                placeholder: "city (Mandatory)"
            });
            /*single select dropdown*/

            var validator = $("form[name='updateAccount']").validate({
                onfocusout: function (element) {
                    var $element = $(element);
                    if ($element.prop('required')) {
                        this.element(element)
                    } else if ($element.val() != '') {
                        this.element($element)
                    }
                },
                onkeyup: function (element) {
                    var $element = $(element);
                    $element.valid();
                },
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    country: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    whatsapp: {
                        phoneNumberFormat: true
                    },
                    mobileNumber: {
                        phoneNumberFormat: true
                    },
                },
                messages: {
                    first_name: "Please enter your firstname",
                    last_name: "Please enter your lastname",
                    email: "Please enter a valid email address",
                    country: "Please select country",
                    city: "Please select city",
                    state: "Please select state",
                    gender: "Please select gender",
                },
                errorClass: 'is-invalid error',
                validClass: 'is-valid',
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    if (elem.hasClass('form-check-input')) {
                        var element2 = elem.closest('.form-group').find('.form-check-inline:last');
                        error.insertAfter(element2);
                    }
                    else if (elem.attr('name') == 'gender') {
                        element2 = $('#gender_error');
                        error.insertAfter(element2);
                    }
                    else if (elem.hasClass('inteltel')) {
                        var element2 = elem.closest('.iti');
                        error.insertAfter(element2);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $('#updateAccount').find('input').focusout(function () {
                $("form[name='updateAccount']").valid();
            });

            $("#updateAccount").ajaxForm({
                dataType: 'JSON',
                beforeSerialize: function ($form, options) {
                    $('input[name=mobile_country_code]').val($("#mobileNumber").intlTelInput('getSelectedCountryData').dialCode);
                    $('input[name=whatsapp_country_code]').val($("#whatsappNumber").intlTelInput('getSelectedCountryData').dialCode);
                    $('input[name=telephone_country_code]').val($(".mobileNum").intlTelInput('getSelectedCountryData').dialCode);
                },
                beforeSubmit: function (arr, $form) {
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
                },
                success: function (response, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-update-account').hide();
                    $('#alert-error-update-account').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    if (response.feedback == "updated") {
                        // $('html, body').animate({scrollTop: 0}, 'slow');
                        toastr.success("Account updated successfully");
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 2000);
                    } else if (response.feedback == "validation_error") {
                        $form.find('button[type=submit]').prop('disabled', false);
                        $('html, body').animate({scrollTop: ($('#' + Object.keys(response.errors)[0]).offset().top)}, 'slow');
                        $('#' + Object.keys(response.errors)[0]).focus();
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    }

                },
                error: function (jqXHR, exception) {
                    $("#loader").hide();
                    $('button[type=submit]').prop('disabled', false);
                    $('#alert-success-update-account').hide();
                    $('#alert-error-update-account').hide();
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
                    $('#alert-error-update-account').show().html(msg);
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#country_id').on('change', function() {
                var country_id = this.value;
                $("#state").html('');
                $.ajax({
                    url:"{{url('/get-state-list')}}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType : 'json',
                    success: function(result){
                        $('#state').html('<option value="">Select State</option>');
                        $.each(result.states,function(key,value){
                            $("#state").append('<option value="'+value+'">'+value+'</option>');
                        });
                        $('#city').html('<option value="">Select City</option>');
                        $.each(result.cities,function(key,value){
                            $("#city").append('<option value="'+value+'">'+value+'</option>');
                        });
                    }
                });
            });

            $(document).on('change', '#avatar1', function () {
                var name = document.getElementById("avatar1").files[0].name;
                var form_data = new FormData();
                var ext = name.split('.').pop().toLowerCase();
                var $this = $(this);
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("avatar1").files[0]);

                form_data.append("avatar", document.getElementById('avatar1').files[0]);
                $.ajax({
                    url: "{{route('upload-user-avatar')}}",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#uploaded_image1').html("<label class='text-success'>Image Uploading...</label>");
                        $this.siblings('.loader-spinner').removeClass('d-none');
                        $this.siblings('.upload-button').css('background', 'rgb(0 0 0 / 65%)');
                    },
                    success: function (data) {
                        $this.siblings('.loader-spinner').addClass('d-none');
                        $this.siblings('.upload-button').css('background', 'unset');
                        $('#uploaded_image1').html(data);
                    }
                });
            });
            {{--$('#state').on('change', function() {--}}
            {{--    var state_id = this.value;--}}
            {{--    $("#city").html('');--}}
            {{--    $.ajax({--}}
            {{--        url:"{{url('/get-city-list')}}",--}}
            {{--        type: "POST",--}}
            {{--        data: {--}}
            {{--            state_id: state_id,--}}
            {{--            _token: '{{csrf_token()}}'--}}
            {{--        },--}}
            {{--        dataType : 'json',--}}
            {{--        success: function(result){--}}
            {{--            $('#city').html('<option value="">Select City</option>');--}}
            {{--            $.each(result.cities,function(key,value){--}}
            {{--                $("#city").append('<option value="'+value.name+'">'+value.name+'</option>');--}}
            {{--            });--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
        });
    </script>
@endpush
