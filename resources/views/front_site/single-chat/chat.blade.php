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
    <main id="maincontent" class="page-main group-chat">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->
        @include('front_site.common.dashboard-sidebar')
        <!-- Sidebar -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                @include('front_site.common.dashboard-toggle')
                <div class="chatbox-holder" id="app">
                    <div class="chatbox group-chat">
                        <div class="chatbox-top">
                            <div class="chat-group-name">
                                <span class="status away"></span>
                                {{ucfirst(company_name(session()->get('company_id'))??'')}} Chat Group
                            </div>
                            <div class="chatbox-icons">
                                <label for="chkSettings" class="m-0"><i class="fa fa-gear"></i></label><input
                                    type="checkbox" id="chkSettings"/>
                                <div class="settings-popup">
                                    <ul class="m-0">
                                        <li><a href="{{route('view-members')}}">Group members</a></li>
                                        <li><a href="#">Leave group</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-lg-3 p-0 users-left-panel">
                                <div class="d-block nav nav-pills users-left-panel-inner" role="tablist" aria-orientation="vertical">
                                    <a class="d-flex nav-link active" id="chatboardTab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                        <div class="position-relative">
                                            <span class="position-absolute right-0 d-lg-none status status-online"></span>
                                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" class="rounded-circle chat-profile-img">
                                        </div>
                                        <div class="ml-3 d-lg-block d-none">
                                            <span class="name">Hamza</span>
                                            <p class="mb-0 status-span"><span class="status status-online"></span>online</p>
                                        </div>
                                    </a>
                                    <a class="d-flex nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                        <div class="position-relative">
                                            <span class="position-absolute right-0 d-lg-none status status-offline"></span>
                                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_03.jpg" alt="avatar" class="rounded-circle chat-profile-img">
                                        </div>
                                        <div class="ml-3 d-lg-block d-none">
                                            <span class="name">Waseem</span>
                                            <p class="mb-0 status-span"><span class="status status-offline"></span>offline</p>
                                        </div>
                                    </a>
                                    <a class="d-flex nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                        <div class="position-relative">
                                            <span class="position-absolute right-0 d-lg-none status status-offline"></span>
                                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_07.jpg" alt="avatar" class="rounded-circle chat-profile-img">
                                        </div>
                                        <div class="ml-3 d-lg-block d-none">
                                            <span class="name">Dilawar</span>
                                            <p class="mb-0 status-span"><span class="status status-offline"></span>offline</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-9 p-0 users-chatboard">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active users-chatboard-content" id="v-pills-home" role="tabpanel" aria-labelledby="chatboardTab">...</div>
                                    <div class="tab-pane fade users-chatboard-content" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                                    <div class="tab-pane fade users-chatboard-content" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <chat-messages :messages="messages" :auth_id="{{ auth()->id() }}" :show_chat="show_chat"
                                                       :baseUrl="baseUrl" :company_id='{{session()->get("company_id")}}'></chat-messages>
                                    </div>
                                </div>
                                <chat-form
                                    v-on:messagesent="addMessage" :user="{{ \Auth::user() }}" :show_chat="show_chat"
                                    :company_id='{{session()->get("company_id")}}'
                                ></chat-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{asset('public/js/app.js')}}"></script>
    @push('js')
        <script src="{{$ASSET}}/front_site/plugins/light-gallery/js/lightgallery.min.js"></script>
        <script>
            $('.chatbox-holder').bind('DOMSubtreeModified', function () {
                $('.chatbox-holder').lightGallery({
                    thumbnail: true,
                    selector: '.message-box-link',
                    loop: false,
                });
                $('.chatbox-holder').data('lightGallery').destroy(true);
                $('.chatbox-holder').lightGallery({
                    thumbnail: true,
                    selector: '.message-box-link',
                    loop: false,
                });
                $('.msg-attachment').off('click');
                $('.msg-attachment').click(function () {
                    window.location.href = "{{route('company-chat-file-download')}}?id=" + $(this).data('msgid');
                });
            });
            $(document).ready(function () {
                $('.footer-support-icons').hide();
                var closebtn = $('<span/>', {
                    type: "button",
                    text: 'x',
                    id: 'close-file-preview',
                });
                closebtn.attr("class", "close");
                $('#upload_button').popover({
                    trigger: 'manual',
                    html: true,
                    title: 'Preview ' + $(closebtn)[0].outerHTML,
                    content: "There's no image",
                    placement: 'top'
                });
                $(document).on('click', '#close-file-preview', function () {
                    $('#upload_button').popover('hide');
                    $('.upload-file').val(null);
                    $('.clearChatInput').click();
                    $('#upload_button').attr('data-content', '');
                });

                $(".upload-file").change(function (a) {
                    var file = this.files[0];
                    var img = $('<img/>', {
                        id: 'chat-file-preview',
                    });
                    var imgurl = 'public/assets/front_site/images';
                    var src = URL.createObjectURL(a.target.files[0]);
                    f = a.target.files[0].type;
                    f = f.replace(/.*[\/\\]/, '');
                    var Mysrc = imgurl + '/file_icons/fileicon.ico';
                    if (f == 'jpeg' || f == 'jpg' || f == 'png' || f == 'gif' || f == 'jfif') {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            Mysrc = e.target.result
                            img.attr('src', Mysrc);
                            $("#upload_button").attr("data-content", $(img)[0].outerHTML).popover("show");
                        }
                        reader.readAsDataURL(file);
                        // Mysrc = src;
                    } else if (f == 'vnd.openxmlformats-officedocument.wordprocessingml.document') {
                        var Mysrc = imgurl + '/file_icons/wordicon.png';
                    } else if (f == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                        var Mysrc = imgurl + '/file_icons/excelicon.png';
                    } else if (f == 'vnd.openxmlformats-officedocument.presentationml.presentation') {
                        var Mysrc = imgurl + '/file_icons/ppicon.png';
                    } else if (f == 'x-zip-compressed') {
                        var Mysrc = imgurl + '/file_icons/zipicon.png';
                    } else if (f == 'pdf') {
                        var Mysrc = imgurl + '/file_icons/pdficon.png';
                    }
                    img.attr('src', Mysrc);
                    $("#upload_button").attr("data-content", $(img)[0].outerHTML).popover("show");
                });
                $('.message-send').click(function () {
                    $('#upload_button').attr('data-content', '');
                    $('#upload_button').popover('hide');
                });
                $('.chat-input').keyup(function (e) {
                    if (e.which == 13) {
                        $('#upload_button').popover('hide');
                        $('#upload_button').attr('data-content', '');
                    }
                });
            });
        </script>
    @endpush
    </body>
@endsection
