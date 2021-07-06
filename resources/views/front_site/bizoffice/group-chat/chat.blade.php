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
        <!-- Sidebar -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper" >
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
                        <chat-messages :messages="messages" :auth_id="{{ auth()->id() }}" :show_chat="show_chat"
                                       :baseUrl="baseUrl" :company_id='{{session()->get("company_id")}}'></chat-messages>
{{--                        <chat-form--}}
{{--                            v-on:messagesent="addMessage" :user="{{ \Auth::user() }}" :show_chat="show_chat"--}}
{{--                            :company_id='{{session()->get("company_id")}}'--}}
{{--                        ></chat-form>--}}

{{--                        //unhide this above line--}}
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
