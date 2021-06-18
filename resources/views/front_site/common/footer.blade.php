<footer class="footer">
{{--    <img src="{{$ASSET}}/front_site/images/whatsapp-icon.png" class="footer-support-icons" id="footer-support-whatsapp-icon">--}}
    <a href="mailto:info@bizonair.com" class="mail-to-biz">
        <img src="{{$ASSET}}/front_site/images/chat-box.png" class="h-100 footer-support-icons" id="footer-support-chat-icon" />
    </a>
    <div id="whatsAppContact"></div>

    <div class="scrolling-btns">
        <button id="bottomScroll" class="button-down rounded-circle"><span class="fa fa-angle-down"
                                                                           aria-hidden="true"></span></button>
        <button id="topScroll" class="button-down rounded-circle"><span class="fa fa-angle-up"
                                                                        aria-hidden="true"></span></button>
    </div>
    <div class="footer-second-sec">
        <div class="footer-second-sec-inner">
            <div>
                <div>
                    <a href="{{route('home')}}">
                        <img src="{{$STORAGEASSET}}/{{(setting('site.logo'))}}" class="footer-logo-img">
                    </a>
                    <div>
                        <p>“Smart Solution For Global Textile Business”</p>
                        <div class="social-icons d-flex justify-content-between">
                            <a href="{{setting('site.facebook_link')}}" target="_blank"><span class="fa fa-facebook"
                                                                                              aria-hidden="true"></span></a>
                            <a href="{{setting('site.twitter_link')}}" target="_blank"><span class="fa fa-twitter"
                                                                                             aria-hidden="true"></span></a>
                            <a href="{{setting('site.instagram_link')}}" target="_blank"><span class="fa fa-instagram"
                                                                                               aria-hidden="true"></span></a>
                            <a href="{{setting('site.youtube_link')}}" target="_blank"><span class="fa fa-youtube-play"
                                                                                             aria-hidden="true"></span></a>
                            <a href="{{setting('site.linkedin_link')}}" target="_blank"><span
                                    class="fa fa-linkedin-square" aria-hidden="true"></span></a>
                            <a href="{{setting('site.pinterest_link')}}" target="_blank"><span
                                    class="fa fa-pinterest-square" aria-hidden="true"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <ul>
                    <li class="heading"><a href="{{ url('business-products/fibers-and-materials') }}">Textile Business</a></li>
                    @foreach(getCategories('Business') as  $cat)
                    <li><a href="{{ route('business-products',$cat->slug) }}">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <ul>
                    <li class="heading"><a href="{{ url('services/hr-and-admin') }}">Textile Services</a></li>
                    @foreach(getCategories('Services') as  $cat)
                    <li><a href="{{ route('service-products',$cat->slug) }}">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <ul>
                    <li class="heading">About</li>
                    <li><a href="{{route('about-us')}}">About Us</a></li>
                    <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                    <li><a href="{{route('terms-of-use')}}">Terms & Conditions</a></li>
                    <li><a href="{{route('faq')}}">FAQs</a></li>
                    <li><a href="{{route('contact-us')}}">Contact Us</a></li>
{{--                    <li><a href="{{route('suppliers-about-us')}}">Suppliers About Us</a></li>--}}
                </ul>
            </div>
        </div>
        <div class="footer-right-img">
            <img src="{{$ASSET}}/front_site/images/group-91.png">
        </div>
    </div>
    <div id="vaily">

    </div>
    <div class="footer-third-sec">
        <div>© Copyright <span id="current-year"></span>, Bizonair. All rights reserved</div>
        <div>Powered by: <a href="https://ranglerz.com" target="_blank">Ranglerz</a></div>
    </div>
    <script src="{{$ASSET}}/front_site/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
{{-- <script src="{{asset('public/js/app.js')}}"></script> --}}
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
    <script src="{{$ASSET}}/front_site/js/modernizr.js"></script>
<!-- <script src="{{$ASSET}}/front_site/plugins/form/malsap.form.min.js"></script> -->
    <script src="{{$ASSET}}/front_site/js/jquery.form.min.js"></script>
    <!-- Popper JS -->
    <script src="{{$ASSET}}/front_site/js/popper.js"></script>
    <script src="{{$ASSET}}/front_site/js/bootstrap-4.5.0.min.js"></script>
    <script src="{{$ASSET}}/front_site/js/bootstrap-slider.min.js"></script>
    <script src="{{$ASSET}}/front_site/js/slick.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/light-slider/js/lightslider.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/DataTables/datatables.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/build/js/intlTelInput-jquery.min.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/multiple-select/js/bootstrap-multiselect.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/multi-selectable-tree/jquery.tree-multiselect.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/select2/js/select-picker.min.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/select2/js/select2.min.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/light-gallery/js/lightgallery-all.min.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/password-preview/js/jquery.prevue.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/multi-image-selector/jquery.imageuploader.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
    <script src="{{$ASSET}}/front_site/js/dropzone.js"></script>
{{--    <script src="{{$ASSET}}/front_site/js/gtag.js"></script>--}}
    {{-- <script src='{{$ASSET}}/plugin/calendar/moment.min.js'></script>` --}}
    <script src="{{$ASSET}}/front_site/js/share.js"></script>
    <script src="{{$ASSET}}/front_site/js/sweetalert.min.js"></script>
    <script src="{{$ASSET}}/front_site/js/range-selector.js"></script>
    <script src="{{$ASSET}}/front_site/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
    <script src="{{$ASSET}}/front_site/js/toastr.min.js"></script>

    @stack('chart')
    <script src="{{$ASSET}}/front_site/js/main.js"></script>

    <script>


        $(document).ready(function () {
            /*hide load more button when no more hidden products exist*/
            setTimeout(() => {
                /*for hidden boxes*/
                if ($(".product-box:hidden").length == 0) {
                    $('.load-more').hide();
                }
                /*for hidden boxes*/
            }, 10);
            /*hide load more button when no more hidden products exist*/

            var options_login = {
                dataType: 'Json',
                success: function (data) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-login').hide();
                    $('#alert-error-login').hide();
                    $('.empty-div').show();
                    response = data;
                    if (response.feedback == 'false') {
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    } else if (response.feedback == 'invalid') {
                        $('#alert-error-login').html(response.msg);
                        $('#alert-error-login').show();
                        $('.empty-div').hide();

                    } else {

                        $('#alert-error-login').hide();
                        $('#alert-success-login').html(response.msg);
                        $('#alert-success-login').show();
                        $('.empty-div').hide();
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 1000);

                    }
                },
                error: function (jqXHR, exception) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-login').hide();
                    $('#alert-error-login').hide();
                    $('.empty-div').show();
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
                    $('#alert-error-login').html(msg);
                    $('#alert-error-login').show();
                    $('.empty-div').hide();
                },

            };

            $('#loginForm').ajaxForm(options_login);

        });
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "0",
            "hideDuration": "0",
            "timeOut": "0",
            "extendedTimeOut": "0",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    @stack('js')
</footer>
