<div class="mt-2 d-flex justify-content-between align-items-start">
    <span class="main-heading">{{ucfirst($convo->product->product_service_name)}} Ref# {{$convo->product->reference_no}}</span>
    <div class="d-flex align-items-start">
        <div class="mr-4 info-content-inquiry">
            <a class="d-flex text-decoration-none text-reset" href="{{ route('productDetail',['category'=>get_category_slug($convo->product->category_id),'subcategory'=>get_sub_category_slug($convo->product->subcategory_id),'prod_slug'=>$convo->product->slug]) }}">
                <div class="mr-3 product-inquiry-content">
                    <p class="mb-0 font-500">{{ucfirst($convo->product->product_service_name)}}</p>
                    <p class="mb-0 font-500 overflow-text-dots-subject price"><span>@if($convo->product->suitable_currencies == "Other") {{ $convo->product->other_suitable_currency }} @else {{ $convo->product->suitable_currencies }} @endif @if(!empty($convo->product->unit_price_from)){{ moneyFormat($convo->product->unit_price_from) }} - {{ moneyFormat($convo->product->unit_price_to) }}   @else {{ moneyFormat($convo->product->target_price_from) }} - {{ moneyFormat($convo->product->target_price_to) }} @endif</span> Per
                        @if($convo->product->unit_price_unit =="Other") {{$convo->product->other_unit_price_unit}} @else  {{$convo->product->unit_price_unit}} @endif  @if($convo->product->target_price_unit =="Other") {{$convo->product->other_target_price_unit}} @else {{$convo->product->target_price_unit}} @endif</p>
                    <p class="mb-0 reference-number">Ref# <span>{{$convo->product->reference_no}}</span></p>
                </div>
                    @foreach($convo->product->product_image as $j => $image)
                        @if($loop->first)
                <img alt="40x40" src="{{$image->image}}" data-holder-rendered="true" class="rounded-circle" width="40" height="40">
                        @endif
                    @endforeach
            </a>
        </div>
        <a href="" class="btn red-btn float-right">Back</a>
    </div>
</div>
<ul class="mb-2 nav nav-tabs inquiry-nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" id="inboxMail-tab" data-toggle="tab" href="#inboxMail" role="tab"
           aria-controls="home" aria-selected="true">INBOX</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="sentMail-tab" data-toggle="tab" href="#sentMail" role="tab"
           aria-controls="profile" aria-selected="false">SENT</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="trashMail-tab" data-toggle="tab" href="#trashMail" role="tab"
           aria-controls="contact" aria-selected="false">TRASH</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade" id="inboxMail" role="tabpanel"
         aria-labelledby="inboxMail-tab"></div>
    <div class="tab-pane fade" id="sentMail" role="tabpanel" aria-labelledby="sentMail-tab"></div>
    <div class="tab-pane fade" id="trashMail" role="tabpanel" aria-labelledby="trashMail-tab"></div>
</div>
<div class="mail-reply-box-outer">
    <input type="hidden" class="convo-data" data-convo={{encrypt($convo->id)}}>
    @foreach ($convo->messages as $list)
    <div class="p-2 mail-reply-box @if($list->created_by == \Auth::id()) msg-sender @endif">
        <div class="d-flex justify-content-between">
            @if($list->created_by == \Auth::id())

            <div>
                <p class="mb-0 font-500 user">{{in_array($convo->product->company->id,array_unique(\Arr::pluck(\Auth::user()->company_profiles,'id')))? $convo->product->company->company_name : get_name(\Auth::user())}}</p>
                <p class="recipient">To - <span class="to-recipient"></span>{{
                    \Auth::id() == $convo->created_by ? $convo->product->company->company_name : get_name($convo->created_by_user)}}</p>
            </div>
            @else
            <div>
                <p class="mb-0 font-500 user">{{\Auth::id() == $convo->created_by?  $convo->product->company->company_name : get_name($convo->created_by_user)}}</p>
                <p class="recipient">To - <span class="to-recipient"></span>{{
                    \Auth::id() != $convo->created_by ? $convo->product->company->company_name : get_name($convo->created_by_user)}}</p>
            </div>
            @endif

            <div class="d-flex">
                <div class="d-flex flex-column">
                    <span class="day-date-time">{{$list->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</span>
                    <span>{{$convo->product->city}} , {{$convo->product->country}}</span>
                    @if($list->file_path)
                    <a href="{{url($list->file_path)}}" download="download">
                    <span class="d-inline fa fa-paperclip attached-icon"></span>
                    </a>
                    @endif
                </div>
                <span class="ml-2 fa fa-reply reply-msg"></span>
            </div>

            {{-- <div>
                <span class="day-date-time"></span>
                <span class="ml-2 fa fa-reply reply-msg"></span>
            </div> --}}
        </div>
        <p class="mb-0 description">{!! $list->message !!}</p>
        <div class="position-relative reply-input-field">
            <textarea class="mt-3 form-control send-box"></textarea>
            {{-- <button class="position-absolute send-icon"><span class="fa fa-paper-plane"></span></button> --}}
            <div class="h-100 position-absolute d-flex align-items-center top-0 sent-attach-btn-send-icon">
                <div class="input-group-prepend"><div class="input-group-text blue-btn p-0"><span id="upload_button" class="p-0" data-original-title="" title=""><label class="m-0"><input type="file" id="file" class="d-none upload-file"> <span class="fa fa-paperclip text-white p-2"></span></label></span></div></div>
                <button class="ml-2 send-icon send-icon-messages"><span class="fa fa-paper-plane"></span></button>
                <button type='submit' disabled='' class='btn-pro btn red-btn d-none ml-2 align-items-center  justify-content-center'><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span></button>
            </div>
        </div>
    </div>
    @endforeach
    {{-- <div class="p-4 mail-reply-box">
        <div class="d-flex justify-content-between">
            <div>
                <p class="mb-0 font-500 user">Test </p>
                <p class="recipient">To - <span class="to-recipient"></span>XXXXXXXXXX</p>
            </div>
            <div>
                <span class="day-date-time">Mar 31 6:52:57 PM</span>
                <span class="ml-2 fa fa-reply reply-msg"></span>
            </div>
        </div>
        <p class="mb-0 description">Ok good. Thanks for information</p>
        <div class="position-relative reply-input-field">
            <textarea class="mt-3 form-control send-box"></textarea>
            <button class="position-absolute send-icon"><span class="fa fa-paper-plane"></span></button>
        </div>
    </div>
    <div class="p-4 mail-reply-box">
        <div class="d-flex justify-content-between">
            <div>
                <p class="mb-0 font-500 user">Test</p>
                <p class="recipient">To - <span class="to-recipient"></span>XXXXXXXXXX</p>
            </div>
            <div>
                <span class="day-date-time">Mar 31 6:52:57 PM</span>
                <span class="ml-2 fa fa-reply reply-msg"></span>
            </div>
        </div>
        <p class="mb-0 description">Ok good. Thanks for information</p>
        <div class="position-relative reply-input-field">
            <textarea class="mt-3 form-control send-box"></textarea>
            <button class="position-absolute send-icon"><span class="fa fa-paper-plane"></span></button>
        </div>
    </div> --}}
</div>
