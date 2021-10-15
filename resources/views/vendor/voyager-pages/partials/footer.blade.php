<footer class="footer">
    <img src="{{$ASSET}}/front_site/images/whatsapp-icon.png">
    <img src="{{$ASSET}}/front_site/images/chat-box.png">
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
                        <img src="{{$STORAGEASSET}}/{{(setting('site.logo'))}}" class="w-100">
                        {{--                        <p>Smart Solution for Global Textile Business</p>--}}
                        <p></p>
                    </a>
                    <div>

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
                    <li class="heading">Textile Business</li>
                    <li><a href="#">Textile Material</a></li>
                    <li><a href="#">Textile Machinery</a></li>
                    <li><a href="#">Textile Parts</a></li>
                    <li><a href="#">Fashion Accessories</a></li>
                    <li><a href="#">Stock Lot & Waste</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li class="heading">Textile Services</li>
                    <li><a href="#">Human Resource</a></li>
                    <li><a href="#">Erection & Commisioning</a></li>
                    <li><a href="#">Contractual Jobs</a></li>
                    <li><a href="#">Quality Assurance</a></li>
                    <li><a href="#">Product Development</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li class="heading">About</li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
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
{{-- <script src="{{asset('public/js/app.js')}}"></script> --}}
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<!-- <script src="{{$ASSET}}/front_site/plugins/form/malsap.form.min.js"></script> -->
    <script src="https://malsup.github.io/min/jquery.form.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.js"></script>
    <script src="{{$ASSET}}/front_site/js/bootstrap-4.5.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js"></script>
    <script src="{{$ASSET}}/front_site/js/slick.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/light-slider/js/lightslider.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/multiple-select/js/bootstrap-multiselect.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/multi-selectable-tree/jquery.tree-multiselect.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/select2/js/select-picker.min.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/select2/js/select2.min.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/multi-image-selector/jquery.imageuploader.js"></script>
    <script src="{{$ASSET}}/front_site/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{$ASSET}}/front_site/js/dropzone.js"></script>
    {{-- <script src='{{$ASSET}}/plugin/calendar/moment.min.js'></script>` --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    @stack('chart')
    <script src="{{$ASSET}}/front_site/js/main.js"></script>

    <script>


        $(document).ready(function () {
            var options_login = {
                dataType: 'Json',
                success: function (data) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-login').hide();
                    $('#alert-error-login').hide();
                    response = data;
                    if (response.feedback == 'false') {
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    } else if (response.feedback == 'invalid') {
                        $('#alert-error-login').html(response.msg);
                        $('#alert-error-login').show();

                    } else {

                        $('#alert-error-login').hide();
                        $('#alert-success-login').html(response.msg);
                        $('#alert-success-login').show();
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 1000);

                    }
                },
                error: function (jqXHR, exception) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-login').hide();
                    $('#alert-error-login').hide();
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
                },

            };

            $('#loginForm').ajaxForm(options_login);

        });
    </script>

    @stack('js')
</footer>

</body>
</html>
