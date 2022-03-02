@extends('front_site.master_layout')

@section('metadata')
<meta name="csrf-token" content="{{ csrf_token() }}">
@auth
<meta name="user-id" content="{{ \Auth::user()->id }}">
<meta name="base-url" content="{{ env('APP_URL') }}">
<meta name="app-url" content="{{ env('APP_URL') }}">
@endauth
<link rel="stylesheet" type="text/css" href="{{$ASSET}}/front_site/plugins/light-gallery/css/lightgallery.min.css">
@endsection
@section('content')

<body class="dashboard">
    <style>
        .fa-envelope:before {
            content: "\f0e0";
            font-family: 'Font Awesome 5 Free';
        }

        .chat-action-btns {
            display: none;
        }

        .product-inquiry-content {
            font-size: 13px;
        }

        .reference-number {
            color: gray;
            font-weight: 500;
        }

        .reply-input-field {
            display: none;
        }

        .tab-pane {
            overflow-y: auto;
            max-height: 415px;
            min-height: 415px;
        }

        .small-cell {
            width: 1px;
            white-space: nowrap;
        }

        .mails-inbox-icons:hover {
            color: #FFF;
            background: #700011;
        }

        .zero-inquires {
            color: #700011;
        }

        .fav,
        .add-to-pin {
            color: #2E90E5;
            cursor: pointer;
        }

        .trash-bin {
            color: #700011;
            cursor: pointer;
        }

        .mail-reply-box-outer {
            box-shadow: 0 0 10px rgb(0 0 0 / 15%);
        }

        .mail-reply-boxes {
            background: #FFF;
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
        }


        .mail-reply-boxes:hover {
            border-left: 3px solid #A52C3E;
        }

        .fa.fa-paperclip {
            color: #FFF;
        }

        .send-icon {
            right: 15px;
            top: 0;
            height: 100%;
            background: none;
            border: none;
            color: #12253d;
            transition: .3s ease;
        }

        .send-icon:focus {
            outline: none;
        }

    </style>
    <main id="maincontent" class="page-main group-chat">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->
        @include('front_site.common.dashboard-toggle')
            <!-- Sidebar -->
            <!-- Page Content -->
            <div id="page-content-wrapper" >


                <div class="mb-2 mx-2" id="dynamic-body">
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
                    <div align="right" class="mb-2">
                        <form id="filter-bizdeal-onetime-inquiry" method="POST" action="{{route('filter-bizLead-onetime-inquiry')}}">
                        @csrf
                        <input type="hidden" id="date_filter_form" name="from" value="inbox">
                            <div class="mr-1 position-relative d-inline-block">
                            <input type="text" autocomplete="off" name="datePicker" placeholder="by Date"
                                class="date-reference-number" id="byDate">
                            <span class="position-absolute fa fa-calendar"
                                style="right: 6px;top: 8px;font-size: 10px;color: gray"></span>
                        </div>
                        <input type="text" class="date-reference-number" name="ref_no" placeholder="By Refno">
                        <button class="btn fa fa-search red-btn single-chat-box-search"></button>
                        </form>
                    </div>
                    <div class="tab-content inquiry-tab-content">

                        <div class="tab-pane fade show active" id="inboxMail" role="tabpanel"
                            aria-labelledby="inboxMail-tab">



                    <div class="mails-inbox">
                        <div class="py-2 px-2 mails-inbox-header">
                            <input type="hidden" name="from" value="inbox">
                            <div class="d-inline-block custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input selectAll" id="selectAll1">
                                <label class="custom-control-label" for="selectAll1"></label>
                            </div>
                            <span class="mx-2 fa fa-refresh mails-inbox-icons" data-action="refresh"></span>
                            {{-- <span class="mx-2 fa fa-trash mails-inbox-icons"></span> --}}
                            <span class="mx-2 fa fa-star-o mails-inbox-icons" data-action="un-star"></span>
                            <span class="mx-2 fa fa-star mails-inbox-icons" data-action="star"></span>
                            <span class="mx-2 fal fa-envelope mails-inbox-icons" data-action="read"></span>
                            <span class="mx-2 fas fa-envelope mails-inbox-icons" data-action="un-read"></span>
                            {{-- <span class="mx-2 far fa-flag mails-inbox-icons"></span> --}}
                            <span class="mx-2 fas fa-flag mails-inbox-icons" data-action="pin"></span>
                        </div>
                        <div class="chat-action-btns">
                            <div class="py-2 px-2 d-flex chat-action-btns-inner" style="border-bottom: 2px dashed #A52C3E">
                                <button class="inquiry-btn read" data-from="inbox">Read</button>
                                <button class="inquiry-btn un-read" data-from="inbox">Un-Read</button>
                                <button class="inquiry-btn star" data-from="inbox">Star</button>
                                <button class="inquiry-btn un-star" data-from="inbox">Un-Star</button>
                                <button class="inquiry-btn add-pin"  data-from="inbox">Flag</button>
                                <button class="inquiry-btn remove-pin"  data-from="inbox">Un-Flag</button>
                                <button class="inquiry-btn delete"  data-from="inbox">Delete</button>
                            </div>
                        </div>
                        <div class="dynamic-filters-body">
                            @if(count($listing) > 0)
                        @foreach ($listing as $key => $list)
                        @if(check_deleted_by_me($list, 'lead'))
                        <div class="content-box-email mail-reply-box">
                            <input type="hidden" class="main-convo" data-main-convo="{{encrypt($list->id)}}">
                            <div class="py-2 px-2 d-flex justify-content-between">
                                <div class="d-flex w-60">
                                    <div class="d-inline-block custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                            id="customControlAutosizing1{{$key}}" data-main-convo="{{encrypt($list->id)}}">
                                        <label class="custom-control-label"
                                            for="customControlAutosizing1{{$key}}"></label>
                                    </div>
                                    <p class="mb-0 px-2"><span
                                            class="fa @if(check_in_my_fav($list, 'lead'))fa-star-o @else fa-star @endif fav add-fav"></span>
                                    </p>
                                    <p class="mb-0 px-2"><span class=" @if(check_in_my_pin($list, 'lead'))far @else fas @endif fa-flag add-to-pin"></span></p>
                                    <p class="mb-0 ml-2 click-inbox overflow-text-dots-one-line h-1-5-rm @if( $list->latestMessageNotMine && check_in_my_read($list,$list->latestMessageNotMine->id, 'lead')  ) font-weight-bold @endif"
                                        data-click-id="{{$list->id}}">

                                        <span>@if(isset($list->product)) {{$list->product->product_service_name ?:''}} @endif</span> - <span
                                            class="refer">Ref# @if(isset($list->product)) {{$list->product->reference_no ?:''}} @endif</span> -
                                        <span>{{mb_strimwidth((strip_tags($list->latestMessage->message)), 0, 50, "...")}}</span>
                                    </p>
                                </div>
                                <div class="d-flex">
                                    <p class="mb-0 click-inbox @if( $list->latestMessageNotMine && check_in_my_read($list,$list->latestMessageNotMine->id, 'lead')  )  font-weight-bold @endif"
                                       data-click-id="{{$list->id}}">
                                        <span>{{date('d-F-Y', strtotime($list->latestMessage->created_at))}}</span>
                                    </p>
                                    <p class="mb-0 px-2"><span class="fa fa-trash trash-bin"></span></p>
                                    <p class="mb-0"><span class="ml-2 fa fa-reply reply-msg"></span></p>
                                </div>
                            </div>
                            <div class="mx-3 position-relative reply-input-field">
                                <textarea class="form-control send-box"></textarea>
                                <div
                                    class="position-absolute d-flex align-items-center top-0 sent-attach-btn-send-icon">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text blue-btn p-0"><span id="upload_button" class="p-0"
                                                data-original-title="" title=""><label class="m-0"><input type="file"
                                                        id="file" class="d-none upload-file"> <span
                                                        class="fa fa-paperclip text-white p-2"></span></label></span>
                                        </div>
                                    </div>
                                    <button class="ml-2 send-icon send-icon-convo"><span
                                            class="fa fa-paper-plane"></span></button>
                                            <button type="submit" disabled="" class="btn-pro btn red-btn d-none ml-2 align-items-center  justify-content-center"><span class="spinner-border spinner-border-sm mr-1" ml-2="" role="status" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach


                    @else
                    <p class="py-3 text-center font-500 zero-inquires">Sorry, no inquiries found!</p>
                    @endif
                </div>
                </div>
                        </div>

                <div class="tab-pane fade" id="sentMail" role="tabpanel" aria-labelledby="sentMail-tab">
                    <div class="mails-inbox">
                        <div class="py-2 px-2 mails-inbox-header">
                            <div class="d-inline-block custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input selectAll" id="selectAll2">
                                <label class="custom-control-label" for="selectAll2"></label>
                            </div>
                            <span class="mx-2 fa fa-refresh mails-inbox-icons"></span>
                            <span class="mx-2 fa fa-trash mails-inbox-icons"></span>
                            <span class="mx-2 fa fa-star-o mails-inbox-icons"></span>
                            <span class="mx-2 fa fa-star mails-inbox-icons"></span>
                            <span class="mx-2 fal fa-envelope mails-inbox-icons"></span>
                            <span class="mx-2 fas fa-envelope mails-inbox-icons"></span>
                            <span class="mx-2 fas fa-flag mails-inbox-icons"></span>
                        </div>
                        <div class="chat-action-btns">
                            <div class="py-2 px-2 d-flex chat-action-btns-inner" style="border-bottom: 2px dashed #A52C3E">
                                <button class="inquiry-btn read" deta-from="sent">Read</button>
                                <button class="inquiry-btn un-read" deta-from="sent">Un-Read</button>
                                <button class="inquiry-btn star" deta-from="sent">Star</button>
                                <button class="inquiry-btn un-star" deta-from="sent">Un-Star</button>
                                <button class="inquiry-btn add-pin"  data-from="inbox">Flag</button>
                                <button class="inquiry-btn remove-pin"  data-from="inbox">Un-Flag</button>
                                <button class="inquiry-btn delete" deta-from="sent">Delete</button>
                            </div>
                        </div>

                        <div class="dynamic-filters-body">
                        @if(count($sent_messages) > 0)

                    @foreach ($sent_messages as $key => $list)
                    <div class="content-box-email mail-reply-box">
                        <input type="hidden" class="main-convo" data-main-convo="{{encrypt($list->id)}}">
                        <div class="py-2 px-2 d-flex justify-content-between">
                            <div class="d-flex w-60">
                                <div class="d-inline-block custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"
                                        id="customControlAutosizing2{{$key}}" data-main-convo="{{encrypt($list->id)}}">
                                    <label class="custom-control-label" for="customControlAutosizing2{{$key}}"></label>
                                </div>
                                <p class="mb-0 px-2"><span
                                        class="fa @if($list->is_favorite == 0)fa-star @else fa-star-o @endif fav add-fav"></span>
                                </p>
                                <p class="mb-0 ml-2 click overflow-text-dots-one-line h-1-5-rm" data-click-id="{{$list->id}}">
                                    <span>@if(isset($list->product)) {{$list->product->product_service_name ?:''}} @endif</span> - <span
                                        class="refer">Ref# @if(isset($list->product)) {{$list->product->reference_no ?:''}} @endif</span> -
                                    <span>{{mb_strimwidth((strip_tags($list->my_latest_message->message)), 0, 50, "...")}}</span>
                                </p>
                            </div>
                            <div class="d-flex">
                                <p class="mb-0 click" data-click-id="{{$list->id}}">
                                    <span>{{date('M d h:i:s A', strtotime($list->my_latest_message->created_at))}}</span>
                                </p>
                                <p class="mb-0 px-2"><span class="fa fa-trash trash-bin"></span></p>
                                <p class="mb-0"><span class="ml-2 fa fa-reply reply-msg"></span></p>
                            </div>
                        </div>
                        <div class="mx-3 position-relative reply-input-field">
                            <textarea class="form-control send-box"></textarea>
                            <div class="position-absolute d-flex align-items-center top-0 sent-attach-btn-send-icon">
                                <div class="input-group-prepend">
                                    <div class="input-group-text blue-btn p-0"><span id="upload_button" class="p-0"
                                            data-original-title="" title=""><label class="m-0"><input type="file"
                                                    id="file" class="d-none upload-file"> <span
                                                    class="fa fa-paperclip text-white p-2"></span></label></span></div>
                                </div>
                                <button class="ml-2 send-icon send-icon-convo"><span
                                        class="fa fa-paper-plane"></span></button>
                            </div>
                        </div>
                    </div>
                    @endforeach


                @else
                <p class="py-3 text-center font-500 zero-inquires">Sorry, no inquiries found!</p>
                @endif
            </div>
            </div>
                </div>

            <div class="tab-pane fade" id="trashMail" role="tabpanel" aria-labelledby="trashMail-tab">
                <div class="mails-inbox">
                <div class="py-2 px-2 mails-inbox-header">
                    <span class="mx-2 fa fa-refresh mails-inbox-icons"></span>
                    <span class="mx-2 fa fa-star-o mails-inbox-icons"></span>
                    <span class="mx-2 fa fa-star mails-inbox-icons"></span>
                    <span class="mx-2 fal fa-envelope mails-inbox-icons"></span>
                    <span class="mx-2 fas fa-envelope mails-inbox-icons"></span>
                </div>
                <div class="dynamic-filters-body">
                @if(count($deleted_messages) > 0)

                @foreach ($deleted_messages as $list)

                <div class="content-box-email mail-reply-box">
                    <input type="hidden" class="main-convo" data-main-convo="{{encrypt($list->id)}}">
                    <div class="py-2 px-2 d-flex justify-content-between">
                        <div class="d-flex w-60">
                            <p class="mb-0 px-2"><span
                                    class="fa @if($list->is_favorite == 0)fa-star-o @else fa-star @endif fav add-fav"></span>
                            </p>
                            <p class="mb-0 ml-2 click overflow-text-dots-one-line h-1-5-rm @if($list->latestMessage->is_read == 0 && $list->latestMessage->created_by != \Auth::id() ) font-weight-bold @endif"
                                data-click-id="{{$list->id}}"><span>@if(isset($list->product)) {{$list->product->product_service_name ?:''}} @endif</span> -
                                <span class="refer">Ref# @if(isset($list->product)) {{$list->product->reference_no ?:''}} @endif</span> -
                                <span>{{mb_strimwidth((strip_tags($list->latestMessage->message)), 0, 50, "...")}}</span>
                            </p>
                            <p class="mb-0 click @if($list->latestMessage->is_read == 0  && $list->latestMessage->created_by != \Auth::id()) font-weight-bold @endif"
                                data-click-id="{{$list->id}}">
                                <span>{{date('d-F-Y', strtotime($list->latestMessage->created_at))}}</span></p>
                        </div>


                            <p class="mb-0"><span class="ml-2 fa fa-reply reply-msg"></span></p>

                    </div>
                    <div class="mx-3 position-relative reply-input-field">
                        <textarea class="form-control send-box"></textarea>
                        <div class="position-absolute d-flex align-items-center top-0 sent-attach-btn-send-icon">
                            <div class="input-group-prepend">
                                <div class="input-group-text blue-btn p-0"><span id="upload_button" class="p-0"
                                        data-original-title="" title=""><label class="m-0"><input type="file" id="file"
                                                class="d-none upload-file"> <span
                                                class="fa fa-paperclip text-white p-2"></span></label></span></div>
                            </div>
                            <button class="ml-2 send-icon send-icon-convo"><span
                                    class="fa fa-paper-plane"></span></button>
                        </div>
                    </div>
                </div>
                @endforeach


                @else
                <p class="py-3 text-center font-500 zero-inquires">Sorry, no inquiries found!</p>
                @endif
            </div>
            </div>
            </div>
        </div>













        </div>
        </div>
        </div>
    </main>
    {{-- <script src="{{asset('public/js/app.js')}}"></script> --}}
    @push('js')
    <script>
        $('#byDate').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
})





/// addd to pined multiple ajax

$(document).on('click', '.add-pin', function(){
    let from = $(this).attr('data-from');
    var fav = [];
    let div = $(this);
    $.each($(this).parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
        if($(this).is(':checked') )
        fav.push($(this).attr('data-main-convo'));
    });


    $.post("{{route('pin-bizLead-inquiry-convo-multiple')}}", {
        _token: '{{csrf_token()}}',
        conversation_id: fav,
        json: 'yes'
    }, function (data) {
        // document.getElementById("ajax-preloader").style.display = "none";

        $("#ajax-preloader").hide();

        response = $.parseJSON(data);
        if (response.feedback == 'encrypt_issue') {
            toastr.error(response.msg, 'Error');
        } else if (response.feedback == 'true') {
            toastr.success(response.msg, 'Success').fadeOut(2000);
            // console.log(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'));
            $.each(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
                if($(this).is(':checked'))
                $(this).closest('.mail-reply-box').find('.fa-flag').removeClass('far').addClass('fas');

            });

        } else {
            toastr.error('Some other issues', 'Error');
        }
    });


})


//// remove from pined multiple ajax

$(document).on('click', '.remove-pin', function(){
    let from = $(this).attr('data-from');
    var fav = [];
    let div = $(this);
    $.each($(this).parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
        if($(this).is(':checked') )
        fav.push($(this).attr('data-main-convo'));
    });


    $.post("{{route('un-pin-bizLead-inquiry-convo-multiple')}}", {
        _token: '{{csrf_token()}}',
        conversation_id: fav,
        json: 'yes'
    }, function (data) {
        // document.getElementById("ajax-preloader").style.display = "none";

        $("#ajax-preloader").hide();

        response = $.parseJSON(data);
        if (response.feedback == 'encrypt_issue') {
            toastr.error(response.msg, 'Error');
        } else if (response.feedback == 'true') {
            toastr.success(response.msg, 'Success').fadeOut(2000);
            // console.log(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'));
            $.each(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
                if($(this).is(':checked'))
                $(this).closest('.mail-reply-box').find('.fa-flag').removeClass('fas').addClass('far');

            });
        } else {
            toastr.error('Some other issues', 'Error');
        }
    });

})




/// addd to favorite multiple ajax

$(document).on('click', '.star', function(){
    let from = $(this).attr('data-from');
    var fav = [];
    let div = $(this);
    $.each($(this).parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
        if($(this).is(':checked') )
        fav.push($(this).attr('data-main-convo'));
    });


    $.post("{{route('favorite-bizLead-inquiry-convo-multiple')}}", {
        _token: '{{csrf_token()}}',
        conversation_id: fav,
        json: 'yes'
    }, function (data) {
        // document.getElementById("ajax-preloader").style.display = "none";

        $("#ajax-preloader").hide();

        response = $.parseJSON(data);
        if (response.feedback == 'encrypt_issue') {
            toastr.error(response.msg, 'Error');
        } else if (response.feedback == 'true') {
            toastr.success(response.msg, 'Success').fadeOut(2000);
            // console.log(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'));
            $.each(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
                if($(this).is(':checked'))
                $(this).closest('.mail-reply-box').find('.add-fav').removeClass('fa-star-o').addClass('fa-star');

            });

        } else {
            toastr.error('Some other issues', 'Error');
        }
    });


})


//// remove from favorite multiple ajax

$(document).on('click', '.un-star', function(){
    let from = $(this).attr('data-from');
    var fav = [];
    let div = $(this);
    $.each($(this).parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
        if($(this).is(':checked') )
        fav.push($(this).attr('data-main-convo'));
    });


    $.post("{{route('un-favorite-bizLead-inquiry-convo-multiple')}}", {
        _token: '{{csrf_token()}}',
        conversation_id: fav,
        json: 'yes'
    }, function (data) {
        // document.getElementById("ajax-preloader").style.display = "none";

        $("#ajax-preloader").hide();

        response = $.parseJSON(data);
        if (response.feedback == 'encrypt_issue') {
            toastr.error(response.msg, 'Error');
        } else if (response.feedback == 'true') {
            toastr.success(response.msg, 'Success').fadeOut(2000);
            // console.log(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'));
            $.each(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
                if($(this).is(':checked'))
                $(this).closest('.mail-reply-box').find('.add-fav').removeClass('fa-star').addClass('fa-star-o');

            });
        } else {
            toastr.error('Some other issues', 'Error');
        }
    });

})


//// add to delete ajax

    $(document).on('click', '.delete', function(){
    let from = $(this).attr('data-from');
    var fav = [];
    let div = $(this);
    $.each($(this).parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
        if($(this).is(':checked') )
        fav.push($(this).attr('data-main-convo'));
    });


    $.post("{{route('delete-bizLead-inquiry-convo-multiple')}}", {
        _token: '{{csrf_token()}}',
        conversation_id: fav,
        json: 'yes'
    }, function (data) {
        // document.getElementById("ajax-preloader").style.display = "none";

        $("#ajax-preloader").hide();

        response = $.parseJSON(data);
        if (response.feedback == 'encrypt_issue') {
            toastr.error(response.msg, 'Error');
        } else if (response.feedback == 'true') {
            toastr.success(response.msg, 'Success').fadeOut(2000);
            // console.log(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'));
            $.each(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
                if($(this).is(':checked'))
                $(this).closest('.mail-reply-box').remove();

            });
        } else {
            toastr.error('Some other issues', 'Error');
        }
    });


})



/// mark as un-read ajax

$(document).on('click', '.un-read', function(){
    let from = $(this).attr('data-from');
    var fav = [];
    let div = $(this);
    $.each($(this).parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
        if($(this).is(':checked') )
        fav.push($(this).attr('data-main-convo'));
    });


    $.post("{{route('unread-bizLead-inquiry-convo-multiple')}}", {
        _token: '{{csrf_token()}}',
        conversation_id: fav,
        json: 'yes'
    }, function (data) {
        // document.getElementById("ajax-preloader").style.display = "none";

        $("#ajax-preloader").hide();

        response = $.parseJSON(data);
        if (response.feedback == 'encrypt_issue') {
            toastr.error(response.msg, 'Error');
        } else if (response.feedback == 'true') {
            toastr.success(response.msg, 'Success').fadeOut(2000);

            $.each(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
                if($(this).is(':checked') )
                $(this).parent().siblings('.click').addClass('font-weight-bold');
            });
        } else {
            toastr.error('Some other issues', 'Error');
        }
    });


})



/// mark as read ajax

$(document).on('click', '.read', function(){
    let from = $(this).attr('data-from');
    var fav = [];
    let div = $(this);
    $.each($(this).parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
        if($(this).is(':checked') )
        fav.push($(this).attr('data-main-convo'));
    });


    $.post("{{route('read-bizLead-inquiry-convo-multiple')}}", {
        _token: '{{csrf_token()}}',
        conversation_id: fav,
        json: 'yes'
    }, function (data) {
        // document.getElementById("ajax-preloader").style.display = "none";

        $("#ajax-preloader").hide();

        response = $.parseJSON(data);
        if (response.feedback == 'encrypt_issue') {
            toastr.error(response.msg, 'Error');
        } else if (response.feedback == 'true') {
            toastr.success(response.msg, 'Success').fadeOut(2000);

            $.each(div.parents('.mails-inbox').find('.mail-reply-box').find('.custom-control-input'), function(){
                if($(this).is(':checked') )
                $(this).parent().siblings('.click').removeClass('font-weight-bold');
            });
        } else {
            toastr.error('Some other issues', 'Error');
        }
    });


})




/// get tab-vise messagess ajax

$(document).on('click', '.click-inbox', function(){
            let id = $(this).data('click-id');
            $.post("{{route('get-bizLead-inquiry-messages-inbox')}}", {
                _token: '{{csrf_token()}}',
                conversation_id: id,
                json: 'yes'
            }, function (data) {
                // document.getElementById("ajax-preloader").style.display = "none";

                $("#ajax-preloader").hide();

                response = $.parseJSON(data);
                if (response.feedback == 'encrypt_issue') {
                    toastr.error(response.msg, 'Error');
                } else if (response.feedback == 'true') {
                    // toastr.success(response.msg, 'Success');
                    $('#dynamic-body').html(response.data);
                    $(document).on('click', '.send-icon-messages', function () {
                    // console.log('ff');
                    var $this = $(this);
                    var valInputField = $(this).parent().siblings('textarea').val();
                    var valInputfile = $(this).parent().find('.upload-file')[0].files;
                    // console.log(valInputField);

                    let convo_id = $('.convo-data').attr('data-convo');




                    var fd = new FormData();
                    fd.append('message',valInputField );
                    fd.append('conversation_id',convo_id);
                    fd.append('created_by',"{{\Auth::id()}}");
                    fd.append('_token','{{csrf_token()}}');
                    fd.append('json','yes');
                    fd.append('file', valInputfile[0]);


                    $('.send-icon-messages').addClass('d-none');
                    $('.btn-pro').removeClass('d-none').addClass('d-flex');

                    $.ajax({
                        type: "post",
                        url: "{{route('reply-bizLead-inquiry-convo')}}",
                        processData: false,
                        contentType: false,
                        data: fd,
                        dataType: "json",
                        success: function (response) {
                            $('.btn-pro').removeClass('d-flex').addClass('d-none');
                            $('.send-icon-messages').removeClass('d-none');
                            $("#ajax-preloader").hide();

                            // response = $.parseJSON(data);
                            if (response.feedback == 'encrypt_issue') {
                                toastr.error(response.msg, 'Error');
                            } else if (response.feedback == 'true') {
                                toastr.success(response.msg, 'Success').fadeOut(2000);
                                $this.closest('.reply-input-field').remove();
                                var mailReplyBox = "<div class='p-4 mail-reply-box msg-sender'>" +
                                    "<div class='d-flex justify-content-between'>" +
                                        "<div>" +
                                            "<p class='mb-0 font-500 user'>" +
                                                response.sent_from +
                                            "</p>" +
                                            "<p class='recipient'>"
                                                + "To -" + "<span class='to-recipient'>" + "</span>" + response.sent_to +
                                            "</p>" +
                                        "</div>" +
                                        "<div class='d-flex'>" +
                                            "<div class='d-flex flex-column'>" +
                                                "<span class='day-date-time'>" +
                                                    response.message_created_at +
                                                "</span>" +
                                                   response.message_file_path +
                                            "</div>" +
                                            "<span class='ml-2 fa fa-reply reply-msg'>" +
                                            "</span>" +
                                        "</div>" +
                                    "</div>" +
                                    "<p class='mb-0 description'>" +
                                        valInputField +
                                    "</p>" +
                                    "<div class='position-relative reply-input-field'>" +
                                        "<textarea class='mt-3 form-control send-box'></textarea>" +
                                        "<div class='h-100 position-absolute d-flex align-items-center top-0 sent-attach-btn-send-icon'>" +
                                            "<div class='input-group-prepend'>" +
                                                "<div class='input-group-text blue-btn p-0'>" +
                                                    "<span id='upload_button' class='p-0' data-original-title='' title=''><label class='m-0'><input type='file' id='file' class='d-none upload-file'> <span class='fa fa-paperclip text-white p-2'></span></label></span>" +
                                                "</div>" +
                                            "</div>" +
                                            "<button class='ml-2 send-icon send-icon-messages'><span class='fa fa-paper-plane'></span></button><button type='submit' disabled='' class='btn-pro btn red-btn d-none ml-2 align-items-center  justify-content-center'><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span></button>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>";

                    $('.mail-reply-box-outer').prepend(mailReplyBox);

                                // setTimeout(() => {
                                //     window.location.reload();
                                // }, 100);
                            } else {
                                toastr.error('Some other issues', 'Error');
                            }
                        }
                    });

                    $(document).on('click','.reply-msg',function () {
                    // $( ".reply-msg" ).bind( "click", function() {
                        $(this).parents('.mail-reply-box').children('.reply-input-field').fadeIn(500);
                    });

                    $(this).siblings('input').val("");
                });

                $(document).on('click','.reply-msg',function () {
                    $(this).parents('.mail-reply-box').children('.reply-input-field').fadeIn(500);
                });





                } else {
                    toastr.error('Some other issues', 'Error');
                }
            });
        });

$(document).on('click', '.click', function(){
            let id = $(this).data('click-id');
            $.post("{{route('get-bizLead-inquiry-messages')}}", {
                _token: '{{csrf_token()}}',
                conversation_id: id,
                json: 'yes'
            }, function (data) {
                // document.getElementById("ajax-preloader").style.display = "none";

                $("#ajax-preloader").hide();

                response = $.parseJSON(data);
                if (response.feedback == 'encrypt_issue') {
                    toastr.error(response.msg, 'Error');
                } else if (response.feedback == 'true') {
                    // toastr.success(response.msg, 'Success');
                    $('#dynamic-body').html(response.data);
                    $(document).on('click', '.send-icon-messages', function () {
                    // console.log('ff');
                    var $this = $(this);
                    var valInputField = $(this).parent().siblings('textarea').val();
                    var valInputfile = $(this).parent().find('.upload-file')[0].files;
                    // console.log(valInputField);

                    let convo_id = $('.convo-data').attr('data-convo');




                    var fd = new FormData();
                    fd.append('message',valInputField );
                    fd.append('conversation_id',convo_id);
                    fd.append('created_by',"{{\Auth::id()}}");
                    fd.append('_token','{{csrf_token()}}');
                    fd.append('json','yes');
                    fd.append('file', valInputfile[0]);


                    $('.send-icon-messages').addClass('d-none');
                    $('.btn-pro').removeClass('d-none').addClass('d-flex');

                    $.ajax({
                        type: "post",
                        url: "{{route('reply-bizLead-inquiry-convo')}}",
                        processData: false,
                        contentType: false,
                        data: fd,
                        dataType: "json",
                        success: function (response) {
                            $('.btn-pro').removeClass('d-flex').addClass('d-none');
                            $('.send-icon-messages').removeClass('d-none');
                            $("#ajax-preloader").hide();

                            // response = $.parseJSON(data);
                            if (response.feedback == 'encrypt_issue') {
                                toastr.error(response.msg, 'Error');
                            } else if (response.feedback == 'true') {
                                toastr.success(response.msg, 'Success').fadeOut(2000);
                                $this.closest('.reply-input-field').remove();
                                var mailReplyBox = "<div class='p-4 mail-reply-box msg-sender'>" +
                                    "<div class='d-flex justify-content-between'>" +
                                        "<div>" +
                                            "<p class='mb-0 font-500 user'>" +
                                                response.sent_from +
                                            "</p>" +
                                            "<p class='recipient'>"
                                                + "To -" + "<span class='to-recipient'>" + "</span>" + response.sent_to +
                                            "</p>" +
                                        "</div>" +
                                        "<div class='d-flex'>" +
                                            "<div class='d-flex flex-column'>" +
                                                "<span class='day-date-time'>" +
                                                    response.message_created_at +
                                                "</span>" +
                                                   response.message_file_path +
                                            "</div>" +
                                            "<span class='ml-2 fa fa-reply reply-msg'>" +
                                            "</span>" +
                                        "</div>" +
                                    "</div>" +
                                    "<p class='mb-0 description'>" +
                                        valInputField +
                                    "</p>" +
                                    "<div class='position-relative reply-input-field'>" +
                                        "<textarea class='mt-3 form-control send-box'></textarea>" +
                                        "<div class='h-100 position-absolute d-flex align-items-center top-0 sent-attach-btn-send-icon'>" +
                                            "<div class='input-group-prepend'>" +
                                                "<div class='input-group-text blue-btn p-0'>" +
                                                    "<span id='upload_button' class='p-0' data-original-title='' title=''><label class='m-0'><input type='file' id='file' class='d-none upload-file'> <span class='fa fa-paperclip text-white p-2'></span></label></span>" +
                                                "</div>" +
                                            "</div>" +
                                            "<button class='ml-2 send-icon send-icon-messages'><span class='fa fa-paper-plane'></span></button><button type='submit' disabled='' class='btn-pro btn red-btn d-none ml-2 align-items-center  justify-content-center'><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span></button>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>";

                    $('.mail-reply-box-outer').prepend(mailReplyBox);

                                // setTimeout(() => {
                                //     window.location.reload();
                                // }, 100);
                            } else {
                                toastr.error('Some other issues', 'Error');
                            }
                        }
                    });

                    $(document).on('click','.reply-msg',function () {
                    // $( ".reply-msg" ).bind( "click", function() {
                        $(this).parents('.mail-reply-box').children('.reply-input-field').fadeIn(500);
                    });

                    $(this).siblings('input').val("");
                });

                $(document).on('click','.reply-msg',function () {
                    $(this).parents('.mail-reply-box').children('.reply-input-field').fadeIn(500);
                });





                } else {
                    toastr.error('Some other issues', 'Error');
                }
            });
        });

        $(function(){
            $(document).on('click','.mails-inbox-header .selectAll', function () {
                if ($(this).is(":checked")) {
                    $(this).parents('.mails-inbox-header').siblings('.mail-reply-box').find('.custom-control-input').prop('checked', true);
                    $('.chat-action-btns').show();
                } else {
                    $(this).parents('.mails-inbox-header').siblings('.mail-reply-box').find('.custom-control-input').prop('checked', false);
                    $('.chat-action-btns').hide();
                }
            });

            $(document).on('click','.mail-reply-box .custom-control-input',function () {
                if ($(this).is(":checked")) {
                    $('.chat-action-btns').show();
                } else {
                    $('.chat-action-btns').hide();
                }
            });

            // $('.add-fav').click(function () {
            $(document).on('click','.add-fav',function () {
                $(this).toggleClass('fa-star-o fa-star');
            });

            // $('.reply-msg').click(function () {
            $(document).on('click','.reply-msg',function () {
                $(this).parents('.mail-reply-box').children('.reply-input-field').fadeIn(500);
            });
        });




       ///// send message to a converation

                    $(document).on('click', '.send-icon-convo', function () {
                    // console.log('ff');
                    var valInputField = $(this).parent().siblings('textarea').val();
                    var valInputfile = $(this).parent().find('.upload-file')[0].files;
                    let convo_id = $(this).parents('.mail-reply-box').find('.main-convo').attr('data-main-convo');
                    // console.log(valInputField);
                    var fd = new FormData();
                    fd.append('message',valInputField );
                    fd.append('conversation_id',convo_id);
                    fd.append('created_by',"{{\Auth::id()}}");
                    fd.append('_token','{{csrf_token()}}');
                    fd.append('json','yes');
                    fd.append('file', valInputfile[0]);


                    $('.send-icon-convo').addClass('d-none');
                    $('.btn-pro').removeClass('d-none').addClass('d-flex');

                    $.ajax({
                        type: "post",
                        url: "{{route('reply-bizLead-inquiry-convo')}}",
                        processData: false,
                        contentType: false,
                        data: fd,
                        dataType: "json",

                        success: function (response) {
                            $('.btn-pro').removeClass('d-flex').addClass('d-none');
                            $('.send-icon-convo').removeClass('d-none');
                            $("#ajax-preloader").hide();

                            // response = $.parseJSON(data);
                            if (response.feedback == 'encrypt_issue') {
                                toastr.error(response.msg, 'Error');
                            } else if (response.feedback == 'true') {
                                toastr.success(response.msg, 'Success');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 100);
                            } else {
                                toastr.error('Some other issues', 'Error');
                            }
                        }
                    });




                    var mailReplyBox = "<div class='p-4 mail-reply-box msg-sender'>" +
                                    "<div class='d-flex justify-content-between'>" +
                                        "<div>" +
                                            "<p class='mb-0 font-500 user'>" +
                                                "{{get_name(\Auth::user())}}" +
                                            "</p>" +
                                            "<p class='recipient'>"
                                                + "To -" + "<span class='to-recipient'>" + "</span>" + "XXXXXXXXXX" +
                                            "</p>" +
                                        "</div>" +
                                        "<div class='d-flex'>" +
                                            "<div class='d-flex flex-column'>" +
                                                "<span class='day-date-time'>" +
                                                    "Mar 31 6:52:57 PM" +
                                                "</span>" +
                                                "<span class='d-inline fa fa-paperclip attached-icon'></span>" +
                                            "</div>" +
                                            "<span class='ml-2 fa fa-reply reply-msg'>" +
                                            "</span>" +
                                        "</div>" +
                                    "</div>" +
                                    "<p class='mb-0 description'>" +
                                        valInputField +
                                    "</p>" +
                                    "<div class='position-relative reply-input-field'>" +
                                        "<textarea class='mt-3 form-control send-box'></textarea>" +
                                        "<div class='h-100 position-absolute d-flex align-items-center top-0 sent-attach-btn-send-icon'>" +
                                            "<div class='input-group-prepend'>" +
                                                "<div class='input-group-text blue-btn p-0'>" +
                                                    "<span id='upload_button' class='p-0' data-original-title='' title=''><label class='m-0'><input type='file' id='file' class='d-none upload-file'> <span class='fa fa-paperclip text-white p-2'></span></label></span>" +
                                                "</div>" +
                                            "</div>" +
                                            "<button class='ml-2 send-icon-messages'><span class='fa fa-paper-plane'></span></button><button type='submit' disabled='' class='btn-pro btn red-btn d-none ml-2 align-items-center  justify-content-center'><span class='spinner-border spinner-border-sm mr-1' role='status' aria-hidden='true'></span></button>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>";

                    $('.mail-reply-box-outer').prepend(mailReplyBox);
                    $( ".reply-msg" ).bind( "click", function() {
                        $(this).parents('.mail-reply-box').children('.reply-input-field').fadeToggle(500);
                    });

                    $(this).siblings('input').val("");
                });


/// delete a single conversation ajax

                $(document).on('click', '.trash-bin', function () {
                    // console.log('ff');

                    // console.log(valInputField);
                    let div = $(this);
                    let convo_id = $(this).parents('.mail-reply-box').find('.main-convo').attr('data-main-convo');
                    // console.log(convo_id);
                    $.post("{{route('delete-bizLead-inquiry-convo')}}", {
                        _token: '{{csrf_token()}}',
                        conversation_id: convo_id,
                        json: 'yes'
                    }, function (data) {
                        // document.getElementById("ajax-preloader").style.display = "none";

                        $("#ajax-preloader").hide();

                        response = $.parseJSON(data);
                        if (response.feedback == 'encrypt_issue') {
                            toastr.error(response.msg, 'Error');
                        } else if (response.feedback == 'true') {
                            toastr.success(response.msg, 'Success');
                            setTimeout(() => {
                                div.parents('.mail-reply-box').remove();
                            }, 100);
                        } else {
                            toastr.error('Some other issues', 'Error');
                        }
                    });
                });

// add/remove to and from the favorite single conversation

                $(document).on('click', '.fav', function () {
                    // console.log('ff');

                    // console.log(valInputField);
                    let div = $(this);
                    let convo_id = $(this).parents('.mail-reply-box').find('.main-convo').attr('data-main-convo');
                    // console.log(convo_id);
                    $.post("{{route('favorite-bizLead-inquiry-convo')}}", {
                        _token: '{{csrf_token()}}',
                        conversation_id: convo_id,
                        json: 'yes'
                    }, function (data) {
                        // document.getElementById("ajax-preloader").style.display = "none";

                        $("#ajax-preloader").hide();

                        response = $.parseJSON(data);
                        if (response.feedback == 'encrypt_issue') {
                            toastr.error(response.msg, 'Error');
                        } else if (response.feedback == 'true') {
                            toastr.success(response.msg, 'Success').fadeOut(2000);

                        } else {
                            toastr.error('Some other issues', 'Error');
                        }
                    });
                });

/// Add/remove to pin inquiries
                $(document).on('click', '.add-to-pin', function () {
                    $(this).toggleClass('far fas');
                    let div = $(this);
                    let convo_id = $(this).parents('.mail-reply-box').find('.main-convo').attr('data-main-convo');
                    // console.log(convo_id);
                    $.post("{{route('pin-bizLead-inquiry-convo')}}", {
                        _token: '{{csrf_token()}}',
                        conversation_id: convo_id,
                        json: 'yes'
                    }, function (data) {
                        // document.getElementById("ajax-preloader").style.display = "none";

                        $("#ajax-preloader").hide();

                        response = $.parseJSON(data);
                        if (response.feedback == 'encrypt_issue') {
                            toastr.error(response.msg, 'Error');
                        } else if (response.feedback == 'true') {
                            toastr.success(response.msg, 'Success').fadeOut(2000);

                        } else {
                            toastr.error('Some other issues', 'Error');
                        }
                    });
                });



//// to get the listing  according to the filter action button ajax

                $(document).on('click', '.mails-inbox-icons', function () {
                    // console.log('ff');

                    $("#loader").show();
                    let div = $(this);
                    let from = $(this).parent().children('input[name="from"]').val();
                    let filter= $(this).attr('data-action');
                    console.log(`han ji ${from} and ${filter}`);
                    $.post("{{route('get-filter-inqueries-bizLead')}}", {
                        _token: '{{csrf_token()}}',
                        filter: filter,
                        from: from,
                        json: 'yes'
                    }, function (data) {
                        // document.getElementById("ajax-preloader").style.display = "none";

                        $("#loader").hide();

                        response = $.parseJSON(data);
                        if (response.feedback == 'encrypt_issue') {
                            toastr.error(response.msg, 'Error');
                        } else if (response.feedback == 'true') {
                            $('#'+response.body_id).html(response.data);
                        } else {
                            toastr.error('Some other issues', 'Error');
                        }
                    });
                });



// get fresh messages for for the inbox
                $(document).on('click', '#inboxMail-tab', function () {
                    // console.log('ff');
                    $('#date_filter_form').val("inbox");
                    $("#loader").show();
                    $.post("{{route('get-inbox-refresh-bizLead')}}", {
                        _token: '{{csrf_token()}}',
                        user_id: "{{encrypt(\Auth::id())}}",
                        json: 'yes'
                    }, function (data) {
                        // document.getElementById("ajax-preloader").style.display = "none";

                        $("#loader").hide();

                        response = $.parseJSON(data);
                        if (response.feedback == 'encrypt_issue') {
                            toastr.error(response.msg, 'Error');
                        } else if (response.feedback == 'true') {
                            // toastr.success(response.msg, 'Success');
                            $('#inboxMail').html(response.data);
                            $('.mail-reply-box-outer').remove();
                        } else {
                            toastr.error('Some other issues', 'Error');
                        }
                    });
                });
/// get fresh messages for the sentmail
                $(document).on('click', '#sentMail-tab', function () {
                    // console.log('ff');
                    $('#date_filter_form').val("sent-box");
                    $("#loader").show();
                    $.post("{{route('get-sent-box-refresh-bizLead')}}", {
                        _token: '{{csrf_token()}}',
                        user_id: "{{encrypt(\Auth::id())}}",
                        json: 'yes'
                    }, function (data) {
                        // document.getElementById("ajax-preloader").style.display = "none";

                        $("#loader").hide();

                        response = $.parseJSON(data);
                        if (response.feedback == 'encrypt_issue') {
                            toastr.error(response.msg, 'Error');
                        } else if (response.feedback == 'true') {
                            // toastr.success(response.msg, 'Success');
                            $('#sentMail').html(response.data);
                            //added by dilawar
                            $('.align-items-start').remove();
                            //added by dilawar
                            $('.mail-reply-box-outer').remove();
                        } else {
                            toastr.error('Some other issues', 'Error');
                        }
                    });
                });
/// get fresh messages for trach tab
                $(document).on('click', '#trashMail-tab', function () {
                    $('#date_filter_form').val("delete-box");
                    $("#loader").show();
                    $.post("{{route('get-delete-refresh-bizLead')}}", {
                        _token: '{{csrf_token()}}',
                        user_id: "{{encrypt(\Auth::id())}}",
                        json: 'yes'
                    }, function (data) {
                        // document.getElementById("ajax-preloader").style.display = "none";

                        $("#loader").hide();

                        response = $.parseJSON(data);
                        if (response.feedback == 'encrypt_issue') {
                            toastr.error(response.msg, 'Error');
                        } else if (response.feedback == 'true') {
                            // toastr.success(response.msg, 'Success');
                            $('#trashMail').html(response.data);
                            //added by dilawar
                            $('.align-items-start').remove();
                            //added by dilawar
                            $('.mail-reply-box-outer').remove();
                        } else {
                            toastr.error('Some other issues', 'Error');
                        }
                    });
                });

$(function(){

                var options = {
        dataType : 'json',
        beforeSubmit: function(){
            $("#loader").show();
        },
        success: function(response){
			$("#loader").hide();
            if (response.feedback == 'encrypt_issue') {
                toastr.error(response.msg, 'Error');
            } else if (response.feedback == 'true') {
                // toastr.success(response.msg, 'Success');
                // $('#trashMail').html(response.data);
                $('#'+response.body_id).html(response.data);
            } else {
                toastr.error('Some other issues', 'Error');
            }
        }
    };
        $('#filter-bizdeal-onetime-inquiry').ajaxForm(options);
    });
    </script>
    @endpush
</body>
@endsection
