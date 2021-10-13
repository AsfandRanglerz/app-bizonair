//starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                var buyProduct = $('#productBuy').prop('checked');
                var sellProduct = $('#productSell').prop('checked');
                var serviceProduct = $('#productService').prop('checked');

                var prevent = false;
                if (!(buyProduct === true && sellProduct === false && serviceProduct === false)) {
                    $.each($(".multiselectButton[required]"), function () {
                        if ($(this).val() == "") {
                            prevent = true;
                            $(this).parent().siblings("small.field-error-msg").remove();
                            $(this).parent().after("<small class='field-error-msg text-danger'>Please select atleast one " + $(this).parent().siblings("label").text().toLowerCase() + "</small>");
                        } else {
                            $(this).parent().siblings("small.field-error-msg").remove();
                        }
                    });
                    event.preventDefault();
                    if (prevent) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$(".job-description-below").scroll(function () {
    if ($(this).scrollTop() + $(this).height() == $(this).height()) {
        $(".job-description-upper").css('box-shadow', 'none');
    } else {
        $(".job-description-upper").css('box-shadow', '0 4px 8px 0 rgb(0 0 0 / 0%), 0 6px 20px 0 rgb(0 0 0 / 18%)');
    }
});

$(document).ready(function () {
    /*inquiry checkboxes*/
    $(document).on('click', '#selectAll1', function() {
        if($(this).prop('checked')==true) {
            $(this).parents('.mails-inbox-header').siblings('.dynamic-filters-body').find('.custom-control-input').prop('checked', true);
        }
        else {
            $(this).parents('.mails-inbox-header').siblings('.dynamic-filters-body').find('.custom-control-input').prop('checked', false);
        }
    });

    $(document).on('click', '.mail-reply-box .custom-control-input', function() {
        let totalCheckBoxes = $('.mail-reply-box .custom-control-input').length;
        let tickCheckBoxes = $('.mail-reply-box .custom-control-input:checked').length;
        if(totalCheckBoxes != tickCheckBoxes) {
            $('#selectAll1').prop('checked', false);
        }
        else {
            $('#selectAll1').prop('checked', true);
        }
    });
    /*inquiry checkboxes*/

    $('button[type="submit"]').click(function (){
        /*errors will be shown at bottom of select2 tags*/
        $('.select2').parent('.form-group').css({'display': 'flex', 'flex-direction': 'column'});
        /*errors will be shown at bottom of select2 tags*/
    });

    /*details comparison page js*/
    $('.details-comparison #selectAll').click(function () {
        if ($(this).is(":checked")) {
            $('.select-supplier').prop('checked', true);
        } else {
            $('.select-supplier').prop('checked', false);
        }
    });

    $('.details-comparison .cross-icon').click(function () {
        $(this).closest('.product-info-container').remove();
        if ($('.product-info-container').length == 0) {
            $('.name-product-heading').css('width', '100%');
        }
    });
    /*details comparison page js*/
    /*suppliers and buyers pages js*/
    $(".add-product-to-compare").change(function () {
        var idSelector = $(this).attr('id');
        if ($(this).is(":checked")) {
            var productTitle = "<p class='text-center text-white pt-3 font-500 product-title'>" + $(this).parents('.product-img-container').siblings('.product-details').children('.title').text() + "</p>";
            var crossIcon = "<span class='fa fa-times cross-icon' aria-hidden='true'></span>";
            var contentCompare = "<div class='w-100 text-right position-absolute content-compare'>" + crossIcon + productTitle + "</div>";

            $(".compare-container").append($(this).parent().siblings('.product-img-container').find('.product-img').clone().wrapAll("<div class='d-inline-block position-relative compare-div'></div>").after(contentCompare).parent().addClass(idSelector));

            $(".cross-icon").click(function () {
                $(this).parent(".content-compare").parent(".compare-div").remove();
                if ($(this).parent(".content-compare").parent(".compare-div").hasClass(idSelector)) {
// alert(idSelector);
                    $("#" + idSelector).prop('checked', false);
                }
                if ($('.compare-div').length == 0) {
                    $('.compare-cancel-btns').hide();
                }
            });

            $('.compare-cancel-btns').show();
        } else {
            $(".compare-container ." + idSelector).remove();
            if ($('.compare-div').length == 0) {
                $('.compare-cancel-btns').hide();
            }
        }
    });
    /*suppliers and buyers pages js*/

    /*faq tab sections onclick scroll to top*/
    $(".faqs .card-header").on('click', function(event) {
        setTimeout(() => {
            var navbarHeight = $('.navbar').innerHeight();
            $('html, body').animate({
                scrollTop: $(this).closest('.card-header').offset().top - (navbarHeight)
            }, 1000);
        }, 500);
    });
    /*faq tab sections onclick scroll to top*/

    /*copy url*/
    $(document).on("click", "#shareLinkbtn", function (e) {
        $("body").append('<input id="copyURL" type="text" value="" />');
        $("#copyURL").val(window.location.href).select();
        document.execCommand("copy");
        $("#copyURL").remove();
        toastr.success("Url Copied!").fadeOut(2000);
    });
    /*copy url*/

    /*Modal inquiry form check: "Please agree to the Terms of Services and Privacy Policy"*/
    $(document).on('click', '#termsCheckbox', function(){
        if($(this).is(":checked") == false){
            $('.submit-btn').prop("disabled", true);
        }
        else if($(this).is(":checked") == true){
            $('.submit-btn').prop("disabled", false);
        }
    });
    /*Modal inquiry form check: "Please agree to the Terms of Services and Privacy Policy"*/

    /*contact us form check: "I Agree to the Terms of Services and Privacy Policy"*/
    $(document).on('click', '#terms', function(){
        if($(this).is(":checked") == false){
            $('input[type="submit"]').prop("disabled", true);
            $('.submit-btn').prop("disabled", true);
        }
        else if($(this).is(":checked") == true){
            $('.submit-btn').prop("disabled", false);
        }
    });
    /*contact us form check: "I Agree to the Terms of Services and Privacy Policy"*/

    /*image and file delete, on click delete button*/
    $(document).on('click', '.del-btn', function() {
        var imgFile = $('.product-pic');
        var filePath = $('.product-file-upload').siblings('input[type="hidden"]');
        $(this).siblings(imgFile).attr('src', 'https://www.bizonair.com/public/assets/front_site/images/preview.svg');
        $(this).siblings(filePath).val('');
        $(this).siblings('.product-upload-button').css('background', 'unset');
    });
    /*image and file delete, on click delete button*/

    /*banner search keyword*/
    $('#searchKeyword').focus(function() {
        var search_term = $('#searchKeyword').val();
        $('.search_results_links').removeHighlight().highlight(" " + search_term);
    });
    /*banner search keyword*/

    /*wow animation*/
    wow = new WOW(
        {
            boxClass:     'wow',      // default
            animateClass: 'animated', // default
            offset:       0,          // default
            mobile:       true,       // default
            live:         true        // default
        }
    )
    wow.init();
    /*wow animation*/

    /*company images gallery*/
    $('.company-images-gallery').lightGallery({
        thumbnail:true,
        zoom: true,
        fullScreen: true,
        counter: true,
        clone: true,
        autoplayControls: false,
        download: false,
        share: false
    });
    /*company images gallery*/

    if($( ".banner-search" ).length == 1) {
        /*search hide for banner search pages*/
        $('.search-dropdown .dropdown-menu').hide();
        $('.search-dropdown').addClass('hide');
        /*search hide for banner search pages*/
    }

    $(".nav-search-btn").click(function () {
        /*animate search*/
        var searchAnimate = $(".category-search");
        searchAnimate.animate({width: '50%'}, "slow");
        searchAnimate.animate({width: '100%'}, "slow");
        /*animate search*/

        if($( ".banner-search" ).length == 1) {
            /*scroll to top and change search box shadow*/
            $('html, body').animate({scrollTop: 0}, 'slow');
            $('.category-search > form').css('box-shadow', '0 10px 16px 0 #580a16 ,0 6px 20px 0 #580a16');
            /*scroll to top and change search box shadow*/
        }
    });

    /*search category keywords*/
    $('#searchKeyword').focus(function () {
        if($('.search-suggestions .links li').length!=0) {
            $('.search-suggestions').fadeIn(500);
        }
    });

    $('#searchKeyword').blur(function () {
        $('.search-suggestions').fadeOut(500);
    });
    /*search category keywords*/

    /*main js for single-select-dropdown functionality*/
    $('.single-select-dropdown').change(function () {
        if ($(this).val()!='') {
            $(this).siblings('.is-invalid.error').hide();
            $(this).siblings('.select2').find('.select2-selection--single').addClass('is-valid');
            $(this).siblings('.select2').find('.select2-selection--single').removeClass('is-invalid');
        }
        if ($(this).val() == 'Other') {
            $(this).closest(".form-group").next(".form-group.other-div").first().show().find('input').prop('required', true);
        }
        else {
            $(this).closest(".form-group").next(".form-group.other-div").first().hide().find('input').prop('required', false);
        }
    });

    $('.next-btn').click(function () {
        setTimeout(() => {
            /*add classes is-invalid and error for single select (select2)*/
            $('.is-invalid.error').siblings('.select2-container--default').find('.select2-selection--single').addClass('is-invalid');
            /*add classes is-invalid and error for single select (select2)*/
        }, 10);
    });
    /*main js for single-select-dropdown functionality*/

    /*header mybiz buttons*/
    $("#bizOffice").hover(function () {
        $(this).find("img").css("filter", "brightness(0) invert(1)");
    }, function () {
        $(this).find("img").css("filter", "none");
    });
    $("#bizDeals").hover(function () {
        $(this).find("img").css("filter", "brightness(0.3)");
    }, function () {
        $(this).find("img").css("filter", "none");
    });
    /*header mybiz buttons*/

    /*garments navbar categories dropdown hover effect*/
    $("#garmentsNav .nav-item").hover(function() {
        $(this).addClass("show");
        $(this).find(".dropdown-menu").addClass("show");
        $('.product-main #maincontent .main-container .navbar #garmentsNav .navbar-nav .nav-item:first-child').css('border-bottom-left-radius', '0');
        $('.product-main #maincontent .main-container .navbar #garmentsNav .navbar-nav .nav-item:last-child').css('border-bottom-right-radius', '0');
    }, function () {
        $(this).removeClass("show");
        $(this).find(".dropdown-menu").removeClass("show");
        $('.product-main #maincontent .main-container .navbar #garmentsNav .navbar-nav .nav-item:first-child').css('border-bottom-left-radius', '10px');
        $('.product-main #maincontent .main-container .navbar #garmentsNav .navbar-nav .nav-item:last-child').css('border-bottom-right-radius', '10px');
    });
    /*garments navbar categories dropdown hover effect*/

    /*categories links tabs*/
    $(".categories-section .nav-link").hover(function(e) {
        e.preventDefault();
        $('.right-side-sub-cat-view').show();
        $('.right-side-sub-cat-view .tab-pane').removeClass('active');
        tabContentSelector = $(this).attr('href');
        $(this).tab('show');
        $(tabContentSelector).addClass('active');
    });

    $(document).on('mouseover', function(){
        if($(".categories-links-tabs:hover").length == 0  || $(".all-categories:hover").length==1){
            $('.categories-section .nav-link').removeClass('active');
            $('.right-side-sub-cat-view').hide();
        }
    });
    /*categories links tabs*/

    /*garments navbar tabs hover effect*/
    $(".garment-dropdown-block .nav-link").hover(function(e) {
        e.preventDefault();
        $('.tab-pane').removeClass('active');
        tabContentSelector = $(this).attr('href');
        $(this).tab('show');
        $(tabContentSelector).addClass('active');
    });
    /*garments navbar tabs hover effect*/

    /*dashboard group chat*/
    $(document).mouseup(function(e){
        var container = $(".chat-dots-dropdown", this);

        // If the target of the click isn't the container
        if(!container.is(e.target) && container.has(e.target).length === 0){
            container.hide();
        }
    });

    $(document).on('click', '.chat-dots', function() {
        $('.chat-dots-dropdown').hide();
        $(this).siblings('.chat-dots-dropdown').show();
    });

    $(document).on('click', '.chat-dots-dropdown .quote-message', function () {
        $(this).closest('.chat-dots-dropdown').hide();
        $('.chat-input').focus();
        var quoteMessage = '" '+ $(this).closest('.message-box').find('.message-box-text').text() + ' "';
        var quoteMessageLength = $(this).closest('.message-box').find('.message-box-text').text().length;
        var quoteImg = $(this).closest('.message-box').find('.message-box-link').attr('data-src');
        var quoteImgLength = $(this).closest('.message-box').find('.message-box-link').length;
        if($(this).trigger('clicked')) {
            if(quoteMessage != "" && quoteMessage != " " && quoteImgLength == 0) {
                $('.quote-box').removeClass('d-none').addClass('d-flex');
                $('.quote-box .reply-txt').text(quoteMessage).show();
                $('.reply-img-box').hide();
                if($(window).width() <= 575) {
                    $('.chat-messages').css('height', 'calc(100vh - 261px)');
                }
                else if($(window).width() <= 991) {
                    $('.chat-messages').css('height', 'calc(100vh - 263px)');
                }
                else {
                    $('.chat-messages').css('height', 'calc(100vh - 251px)');
                }
            }
            else if(quoteMessageLength == 0 && quoteImgLength != 0) {
                $('.quote-box').removeClass('d-none').addClass('d-flex');
                $('.quote-box .reply-txt').hide();
                $('.reply-img-box').show();
                $('.quote-box .reply-img-box .reply-img').attr('src', quoteImg);
                if($(window).width() <= 575) {
                    $('.chat-messages').css('height', 'calc(100vh - 340px)');
                }
                else if($(window).width() <= 991) {
                    $('.chat-messages').css('height', 'calc(100vh - 363px)');
                }
                else {
                    $('.chat-messages').css('height', 'calc(100vh - 376px)');
                }
            }
            else {
                $('.quote-box').removeClass('d-none').addClass('d-flex');
                $('.quote-box .reply-txt').text(quoteMessage).show();
                $('.reply-img-box').show();
                $('.quote-box .reply-img-box .reply-img').attr('src', quoteImg);
                if($(window).width() <= 575) {
                    $('.chat-messages').css('height', 'calc(100vh - 364px)');
                }
                else if($(window).width() <= 991) {
                    $('.chat-messages').css('height', 'calc(100vh - 387px)');
                }
                else {
                    $('.chat-messages').css('height', 'calc(100vh - 400px)');
                }
            }
        }

        $('.quote-box .cross-icon').bind('click', function() {
            $(this).closest('.quote-box').removeClass('d-flex').addClass('d-none');
            $(this).closest('.quote-box').children('.reply-txt').text('');
            $('.quote-box .reply-img-box .reply-img').attr('src', quoteImg);
            $('.chat-messages').css('height', 'calc(100vh - 193px)');
        });
    });

    $(document).on('click', '.message-send', function() {
        $('.quote-box').removeClass('d-flex').addClass('d-none');
        $('.quote-box .reply-txt').text('');
        $('.chat-messages').css('height', 'calc(100vh - 193px)');
    });

    $('input.chat-input').keyup(function(event) {
        if (event.which === 13) {
            $('.message-send').trigger('click');
        }
    });
    /*dashboard group chat*/

    /*dashboard*/
    $("#dashboardWrapper #menu-toggle").click(function (e) {
        e.preventDefault();
        $("#dashboardWrapper").toggleClass("toggled");
    });

    var delay = 500;
    $("#dashboardSidebar .progress-bar").each(function (i) {
        $(this).delay(delay * i).animate({width: $(this).attr('aria-valuenow') + '%'}, delay);

        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: delay,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now) + '%');
            }
        });
    });
    /*dashboard*/

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    /*digits counter*/
    $("textarea[name='details'], input[name='subject'], input[name='product_service_name']").on('focusout', function () {
        setTimeout(() => {
            if($(this).hasClass('is-valid')) {
                $(this).siblings('.counter-span').css('border-color', '#28a745');
            }
            else {
                $(this).siblings('.counter-span').css('border-color', '#dc3545');
            }
        }, 10);
    });


    $("textarea[name='details'], input[name='subject'], input[name='product_service_name']").on('keyup', function () {
        $(this).siblings('span').find('.counter-total-digits').text($(this).val().length);
        $(this).siblings('.counter-span').find('.counter-total-digits').text($(this).val().length);
    });

    $("textarea[name='details'], input[name='subject'], input[name='product_service_name']").each(function() {
        $(this).siblings('span').find('.counter-total-digits').text($(this).val().length);
        $(this).siblings('.counter-span').find('.counter-total-digits').text($(this).val().length);
    });
    /*digits counter*/

    /*onclick hide-show number*/
    $(".hide-show-number").click(function(){
        $(this).text($(this).text() == 'Hide' ? 'Show' : 'Hide');
        $(this).siblings('.hidden').toggleClass('d-inline-block d-none');
        $(this).siblings('.show').toggleClass('d-none d-inline-block');
    });
    /*onclick hide-show number*/

    /*textarea box words length*/
    var text_max = 1000;
    $('#totalCharLeft').html(text_max + ' characters remaining');

    $('textarea[name="description"]').keyup(function () {
        var text_length = $(this).val().length;
        var text_remaining = text_max - text_length;

        $('#totalCharLeft').html(text_remaining + ' characters remaining');
    });
    /*textarea box words length*/

    /*mobile header view*/
    var mobHeader = $('.tab-mob-header').innerHeight()
    var mobHeaderCeil = Math.ceil(mobHeader);
    $('body').css('padding-top', mobHeaderCeil);
    /*mobile header view*/

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    // Add the following code if you want the name of the file appear on select

    /*digits counter*/
    $("textarea[name='details'], input[name='subject'], input[name='product_service_name']").on('keyup', function () {
        $(this).siblings('span').find('.counter-total-digits').text($(this).val().length);
    });

    $("textarea[name='details'], input[name='subject'], input[name='product_service_name']").each(function() {
        $(this).siblings('span').find('.counter-total-digits').text($(this).val().length);
    });
    /*digits counter*/

    /*onclick hide-show number*/
    $(".hide-show-number").click(function(){
        $(this).text($(this).text() == 'Hide' ? 'Show' : 'Hide');
        $(this).siblings('.hidden').toggleClass('d-inline-block d-none');
        $(this).siblings('.show').toggleClass('d-none d-inline-block');
    });
    /*onclick hide-show number*/

    setTimeout(() => {
        /*category name changed on basis of selected category*/
        let catName = $('#garmentsNav .nav-underline-pg span').text();
        $('#catNameSec').text(catName);
        /*category name changed on basis of selected category*/
    }, 10);

    /*sub categories block open on clicking category down arrow*/
    $(document).on('click', '.sub-cat-arrow-block', function() {
        $('.sub-cat-box').slideDown(500);
        $('body').css('overflow', 'hidden');
    });

    $(document).on('click', '.sub-cat-box .heading', function() {
        $('.sub-cat-box').slideUp(500);
        $('body').css('overflow', 'auto');
    });
    /*sub categories block open on clicking category down arrow*/

    /*empty-p-tags removed*/
    $('p:empty').remove();
    /*empty-p-tags removed*/

    /*premium suppliers and categories sliders*/
    $('.categories-slider').slick({
        autoplay: true,
        dots: false,
        arrows: false,
        autoplaySpeed: 3000,
        centerMode: false,
        slidesToShow: 4,
        slidesToScroll: 4
    });

    $('.premium-suppliers').slick({
        autoplay: true,
        dots: false,
        arrows: false,
        autoplaySpeed: 3000,
        centerMode: false,
        slidesToShow: 4,
        slidesToScroll: 4
    });
    /*premium suppliers and categories sliders*/

    $(".pro-categories-tab-links .red-btn").on('click', function () {
        $(this).children('img').addClass("img-hover");
    });

    /*header open nav, close nav for tablets and mobile view*/
    $('.open-nav').click(function() {
        $('.biz-nav').width('335px');
        $('body').addClass('nav-open');
        if($(window).width()<=576) {
            $('.biz-nav').width('255px');
        }
    });
    $(document).on("click", function(event){
        if(!$(event.target).closest('.open-nav, .biz-nav').length){
            $('.biz-nav').width(0);
            $('body').removeClass('nav-open');
        }
    });
    $('.close-nav').click(function() {
        $('body').removeClass('nav-open');
        $('.biz-nav').width(0);
    });

    $('.biz-nav .side-nav .categories li').on('click', function () {

        var $this = $(this);

        $this.toggleClass('opend').siblings().removeClass('opend');

        if ($this.hasClass('opend')) {
            $this.find('.side-nav-dropdown').slideToggle('fast');
            $this.siblings().find('.side-nav-dropdown').slideUp('fast');
            $this.tooltip('disable');
        } else {
            $this.find('.side-nav-dropdown').slideUp('fast');
            $this.tooltip('enable');
        }
    });

    $('.biz-nav .side-nav .close-aside').on('click', function () {
        $('#' + $(this).data('close')).addClass('show-side-nav');
        contents.removeClass('margin');
    });

    /*dashboard sidebar height - header height*/
    var header = $('.login-cross-btns').height();
    // var headerVal = Math.ceil(header);
    // $('.biz-nav-content').css( { height: `calc(100vh - ${headerVal}px)` } );
    /*dashboard sidebar height - header height*/
    /*header open nav, close nav for tablets and mobile view*/

    /*for companies sidebar*/
    var CompaniesHeadingHeight = $('.top-companies').siblings('.main-heading').height() + 8;
    var companiesCeilHeight = Math.ceil(CompaniesHeadingHeight);
    $('.top-companies').css( { height: `calc(100% - ${companiesCeilHeight}px)` } );
    /*for companies sidebar*/

    /*Add smooth scrolling to all links*/
    $(".product-info-btn").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;
            var navbarHeight = $('.navbar').innerHeight();
            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top - (navbarHeight)
            }, 1000);
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
        } // End if
    });
    /*Add smooth scrolling to all links*/

    /*whatsapp modal*/
    $('#whatsAppContact').floatingWhatsApp({
        phone: '+923213222254', //WhatsApp Business phone number International format-
        //Get it with Toky at https://toky.co/en/features/whatsapp.
        headerTitle: 'Chat with Bizonair Team on WhatsApp!', //Popup Title
        popupMessage: 'Hello, how can we help you?', //Popup Message
        showPopup: true, //Enables popup display
        buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" />', //Button Image
        //headerColor: 'crimson', //Custom header color
        //backgroundColor: 'crimson', //Custom background button color
        position: "right"
    });

    /*sending icon hide*/
    $('.floating-wpp-btn-send').hide();
    /*sending icon hide*/

    $('.floating-wpp-head').click(function() {
        $('.floating-wpp-input-message textarea').val('');
    });

    $(document).on("click", function(event){
        if(!$(event.target).closest('.floating-wpp-popup').length){
            $('.floating-wpp-popup').removeClass('active');
        }
        else if (!$('.floating-wpp-head').trigger('clicked')) {
            $('.floating-wpp-popup').addClass('active');
        }
    });
    /*whatsapp modal*/

    /*down arrow button, click show more tab links*/
    $("#journalTab .pro-categories-tab-links").slice(0, 6).show();
    $('.down-arrow-show').on('click', function() {
        $(this).find('span').toggleClass('fa-angle-down fa-angle-up');
        $("#journalTab .pro-categories-tab-links:hidden").addClass('hiddenTabLinks').slice(0, 3).slideDown(500);
        if($(this).children('.fa').hasClass('fa-angle-down')) {
            $("#journalTab .pro-categories-tab-links.hiddenTabLinks").slideUp(500);
        }
    });
    /*down arrow button, click show more tab links*/

    /*load more content on clicking load more button*/
    setTimeout(() => {
        if($(".product-box").hasClass('textile-box')) {
            $(".product-box").slice(0, 8).show();
        }
        else {
            $(".product-box").slice(0, 10).show();
        }

        $('#gcw_siteFAGlYeDQz').hide();
    }, 10);

    var loadMore = $('.load-more').innerHeight();
    $(".load-more").on('click', function (e) {
        e.preventDefault();
        if ($(".product-box").hasClass('textile-box')) {
            $(".product-box:hidden").slice(0, 8).slideDown();
        }
        else {
            $(".product-box:hidden").slice(0, 10).slideDown();
        }
        if($(".product-box:hidden").length==0) {
            $('.load-more').fadeOut(500);
            $('.load-more').after('<p class="no-more-text">There are no more items to load!</p>');
            toastr.success("No More Items to Load").fadeOut(8000);
        }
    });
    /*load more content on clicking load more button*/

    /*tooltip for biz buttons*/
    $('.biz-btn-tooltip').tooltip({
        html: true
    });
    /*tooltip for biz buttons*/

    /*product images gallery thumbnails*/
    $('.product-gallery').lightGallery({
        selector: '.include-in-gallery',
        thumbnail:true,
        zoom: false,
        share: false,
        fullScreen: false
    });
    /*product images gallery thumbnails*/

    /*page main padding bottom only when footer exist*/
    if($('.footer').is(':visible')) {
        $('.page-main, #maincontent').css('padding-bottom', '15.9rem');
    }
    /*page main padding bottom only when footer exist*/

    /*body background, when dashboardSidebar exist*/
    if($('.single-select-dropdown, .select2-multiple').is(':visible')) {
        $('body').css('background', '#d9eefe8c');
    }
    /*body background, when dashboardSidebar exist*/

    /*preview password*/
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    /*preview password*/

    /*heart checkbox wishlist*/
    // $(".add-to-fav").click(function(e) {
    //     e.preventDefault();
    //     $(this).children('.check-heart').toggleClass("fa-heart fa-heart-o");
    // });
    /*heart checkbox wishlist*/

    /*textile calculation right side content height equal to left side bar*/
    var calcSidebar = $('.calc-sidebar').innerHeight();
    var scrollFloatToInt = Math.ceil(calcSidebar);
    $('.calc-content').innerHeight(scrollFloatToInt);
    /*textile calculation right side content height equal to left side bar*/

    /*article details left side content height equal to articles right side bar*/
    var articleSidebar = $('.articles-sidebar').innerHeight();
    var scrollFloatToInt = Math.ceil(articleSidebar);
    $('.article-details-outer').innerHeight(scrollFloatToInt);
    /*article details left side content height equal to articles right side bar*/

    /*ads info*/
    $('.info-icon').hover(function() {
        var adWidth = $(this).parent().width();
        var adWidthRoundOff = Math.ceil(adWidth);
        var adHeight = $(this).parent().height();
        var adHeightRoundOff = Math.ceil(adHeight);
        $(this).siblings('.img-info').show().append("W : " + adWidthRoundOff + " x " + "L : " + adHeightRoundOff);
    }, function(){
        $('.img-info').hide().empty();
    });
    /*ads info*/

    /*dashboard sidebar height - header height*/
    var header = $('.header').height();
    var headerVal = Math.ceil(header);
    $('#dashboardSidebar').css( { height: `calc(100% - ${headerVal}px)` } );
    /*dashboard sidebar height - header height*/

    /*footer hide for dasboard*/
    if($("div").is("#dashboardSidebar")) {
        $('.footer').hide();
    }
    /*footer hide for dasboard*/

    /*dashboard top bottom button scrolling functionality*/
    $('#dashboardSidebar').each(function(){
        if ($(this)[0].scrollHeight <= $(this).height()) {
            $('.bottom-arrow, .top-arrow').hide();
        }
    });

    /*onclick dashboard links or dropdown icons, if scroll not exist*/
    $('.side-nav .categories li').click(function () {
        setTimeout( () => {
            if ($('#dashboardSidebar')[0].scrollHeight <= $('#dashboardSidebar').height()) {
                $('.bottom-arrow, .top-arrow').fadeOut(500);
            } else {
                $('.bottom-arrow').fadeIn(500);
            }
        }, 200);
    });
    /*onclick dashboard links or dropdown icons, if scroll not exist*/

    $('.bottom-arrow').click(function() {
        $(this).hide();
        $('.top-arrow').show();
        $("#dashboardSidebar").scrollTop($("#dashboardSidebar")[0].scrollHeight);
    });

    $('.top-arrow').click(function () {
        $('#dashboardSidebar').animate({scrollTop:0}, 'slow');
        $(this).hide();
        $('.bottom-arrow').show();
    });

    $('#dashboardSidebar').on('scroll', function() {
        var scrollDiv = $('#dashboardSidebar').scrollTop();
        var scrollFloatToInt = Math.ceil(scrollDiv);
        if(scrollFloatToInt + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            $('.bottom-arrow').hide();
            $('.top-arrow').show();
        }
        else {
            $('.bottom-arrow').show();
            $('.top-arrow').hide();
        }
    });
    /*dashboard top bottom button scrolling functionality*/

    /*datatable search*/
    $('.datatableSearch').DataTable({
        pageLength: 10,
        "oLanguage": {
            "sSearch": "Filter:"
        },
        "fnDrawCallback": function( oSettings ) {
            $(function() {
                // if ($('.table-mt tr').length < 10) {
                // $('.dataTables_paginate').hide();
                // }
                if($('.paginate_button').length == 3) {
                    $('.dataTables_paginate').hide();
                }
                else {
                    $('.dataTables_paginate').show();
                }
            });
        }
    });
    /*datatable search*/

    /*single-select-dropdown*/
    $(".single-select-dropdown").select2();
    /*single-select-dropdown*/

    /*fibers-and-materials text exist or not*/
    // $(".nav-link").each(function () {
    //     var fibMaterial = window.location.href.indexOf("fibers-and-materials");
    //     var navfibLink = $(this).attr("href").indexOf("fibers-and-materials");
    //     if(fibMaterial > -1 == true && navfibLink > -1) {
    //         $(this).addClass("nav-underline-pg");
    //         $(this).parent().addClass('active');
    //         $(this).children('img').addClass("img-hover");
    //     }
    // });
    /*fibers-and-materials text exist or not*/

    /*nav link active onclick*/
    $(".nav-link").each(function () {
        var currentUrl = window.location.href.split('/');
        var currentUrlBase = currentUrl[4];

        var activeUrl = $(this).attr("href").split('/');
        var activeUrlBase = activeUrl[4];

        if (currentUrlBase == activeUrlBase && currentUrlBase!=undefined && activeUrlBase!=undefined) {
            $(this).addClass("nav-underline-pg");
            $(this).parent().addClass('active');
            $(this).children('img').addClass("img-hover");
        }
    });

    $(".nav-link").each(function () {
        // Current page url
        var currentUrl = window.location.href.split('/');

        var currentValue = currentUrl.pop();
        // currentValue = currentUrl.pop()+'/'+currentValue;

        // Active sidebar item url
        var activeUrl = $(this).attr("href").split('/');
        var activeValue = activeUrl.pop();
        // activeValue = activeUrl.pop()+'/'+activeValue;

        if (currentValue == activeValue) {
            $(this).addClass("nav-underline-pg");
        }
    });
    /*nav link active onclick*/

    /*on the basis of subcategory, garments nav and header nav links get active*/
    $(".menu-link").each(function () {
        var currentUrl = window.location.href.split('/').slice(-3).shift();
        var currentCatUrl = window.location.href.split('/').pop();
        var currentSubCat = $(this).attr('href').split('/').pop();
        if(currentUrl == currentSubCat) {
            $("#garmentsNav .nav-link").each(function() {
                var currentSubCat = $(this).attr('href').split('/').pop();
                if(currentUrl == currentSubCat) {
                    $(this).parent().addClass('active');
                    $(this).children('img').addClass("img-hover");
                }
            });
            $(this).parents('.nav-item').children('.nav-link').addClass("nav-underline-pg");
        }
        else if(currentCatUrl == currentSubCat) {
            $(this).parents('.nav-item').children('.nav-link').addClass("nav-underline-pg");
        }
    });
    /*on the basis of subcategory, garments nav and header nav links get active*/

    /*garments navbar*/
    $("#garmentsNav .nav-link").each(function () {
        // Current page url
        var currentUrl = window.location.href.split('/');

        var currentValue = currentUrl.pop();
        // currentValue = currentUrl.pop()+'/'+currentValue;

        // Active sidebar item url
        var activeUrl = $(this).attr("href").split('/');
        var activeValue = activeUrl.pop();
        // activeValue = activeUrl.pop()+'/'+activeValue;

        if (currentValue == activeValue) {
            $(this).parent().addClass("active");
            $(this).children('img').addClass("img-hover");
        }
    });
    /*garments navbar*/

    if($( ".banner-search" ).length == 1) {
        /*search hide for banner search pages*/
        $('.search-dropdown .dropdown-menu').hide();
        $('.search-dropdown').addClass('hide');
        /*search hide for banner search pages*/
    }

    $(".nav-search-btn").click(function () {
        /*animate search*/
        var searchAnimate = $(".category-search");
        searchAnimate.animate({width: '50%'}, "slow");
        searchAnimate.animate({width: '100%'}, "slow");
        /*animate search*/

        if($( ".banner-search" ).length == 1) {
            /*scroll to top and change search box shadow*/
            $('html, body').animate({scrollTop: 0}, 'slow');
            $('.category-search > form').css('box-shadow', '0 10px 16px 0 #580a16 ,0 6px 20px 0 #580a16');
            /*scroll to top and change search box shadow*/
        }
        // var navbarHeight = $('.navbar').height();
        // if ($(window).width() <= 991) {
        //     $('html,body').animate({
        //             scrollTop: $(".banner-search").offset().top - (navbarHeight + 30)
        //         },
        //         'slow');
        // } else {
        //     $('html,body').animate({
        //             scrollTop: $(".banner-search").offset().top - (navbarHeight + 9)
        //         },
        //         'slow');
        // }
    });

    $('.preview-password').prevue();

    $('.suppliers-products .products-slider').lightSlider({
        auto: true,
        Speed: 300,
        gallery: true,
        item: 1,
        loop: true,
        thumbItem: 3,
        slideMargin: 0,
        enableDrag: false,
        currentPagerPosition: 'left',
        onSliderLoad: function (el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        },
        responsive: [
            {
                breakpoint: 769,
                settings: {
                    thumbItem: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    thumbItem: 3
                }
            }
        ]
    });
    /*details comparison page js*/
    $('.details-comparison #selectAll').click(function () {
        if ($(this).is(":checked")) {
            $('.select-supplier').prop('checked', true);
        } else {
            $('.select-supplier').prop('checked', false);
        }
    });

    $('.details-comparison .cross-icon').click(function () {
        $(this).closest('.product-info-container').remove();
        if ($('.product-info-container').length == 0) {
            $('.name-product-heading').css('width', '100%');
        }
    });
    /*details comparison page js*/
    /*suppliers and buyers pages js*/
    $(".add-product-to-compare").change(function () {
        var idSelector = $(this).attr('id');
        if ($(this).is(":checked")) {
            var productTitle = "<p class='text-center text-white pt-3 font-500 product-title'>" + $(this).parents('.product-img-container').siblings('.product-details').children('.title').text() + "</p>";
            var crossIcon = "<span class='fa fa-times cross-icon' aria-hidden='true'></span>";
            var contentCompare = "<div class='w-100 text-right position-absolute content-compare'>" + crossIcon + productTitle + "</div>";

            $(".compare-container").append($(this).parent().siblings('.product-img-container').children('img').clone().wrapAll("<div class='d-inline-block position-relative compare-div'></div>").after(contentCompare).parent().addClass(idSelector));

            $(".cross-icon").click(function () {
                $(this).parent(".content-compare").parent(".compare-div").remove();
                if ($(this).parent(".content-compare").parent(".compare-div").hasClass(idSelector)) {
// alert(idSelector);
                    $("#" + idSelector).prop('checked', false);
                }
                if ($('.compare-div').length == 0) {
                    $('.compare-cancel-btns').hide();
                }
            });

            $('.compare-cancel-btns').show();
        } else {
            $(".compare-container ." + idSelector).remove();
            if ($('.compare-div').length == 0) {
                $('.compare-cancel-btns').hide();
            }
        }
    });
    /*suppliers and buyers pages js*/
    $('#sub_sub_category').change(function () {
        if ($('#sub_sub_category option:selected').attr('cat-val') == 'Other Natural Fibre' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Synthetic Fibre' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Natural Yarn' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Synthetic Yarn' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Blended Yarn' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Speciality Yarn' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Knitted Fabric' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Woven Fabric' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Nonwoven Fabric' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Synthetic Fibre' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Weaving Machinery' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Spinning Machinery' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Knitting Machinery' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Dyeing Machine' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Printing Machinery' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Finishing Machinery' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Sewing & Garments Machinery' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Laundry Machinery' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Loundry Machinery' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Embroidery Machinery' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Leather & Footwear Machinery' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Testing & Inspection Machine' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Accessories & Equipments Machine' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Electrical Parts' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Mechanical Parts' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other PPEs' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other High Performance Textiles' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Technical Textiles' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Home Textiles' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Hotel Textiles' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Hospital Textiles' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Towels & Mats' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Work Wears' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Sports Wear' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Gym & Exercise Wears' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Automotive Textiles' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Dyes' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Dyes Intermediates' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Pigments' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Prepatory Chemicals' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Processing Chemicals' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Finishing Chemicals' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other General Chemicals' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Lubricants' || $('#sub_sub_category option:selected').attr('cat-val') == "Other Men's Wear" || $('#sub_sub_category option:selected').attr('cat-val') == "Other Women's Wear" || $('#sub_sub_category option:selected').attr('cat-val') == "Other Kid's Wear" || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Accessories' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Trims' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Packaging' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Leather' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Accessories & Equipments' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Footwear' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Bags' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Ladies Unstitched' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Mens Unstitched' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Leftovers' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Stocklots' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other Textile Waste' || $('#sub_sub_category option:selected').attr('cat-val') == 'Other General Waste') {
            $('.add-sub-sub-cat').show();
        } else {
            $('.add-sub-sub-cat').hide();
        }
    });

    /*top bottom indicators*/
    setInterval(function () {
        $("#bottomScroll").toggleClass('button-up button-down');
        $("#topScroll").toggleClass('button-up button-down');
    }, 1000);
    /*top bottom indicators*/

    /*header mybiz buttons*/
    $("#bizOffice").hover(function () {
        $(this).find("img").css("filter", "brightness(0) invert(1)");
    }, function () {
        $(this).find("img").css("filter", "none");
    });
    $("#bizDeals").hover(function () {
        $(this).find("img").css("filter", "brightness(0.3)");
    }, function () {
        $(this).find("img").css("filter", "none");
    });

    // $("#bizOffice").on({
    // 	hover: function() {
    // 		$(this).find("img").css("filter", "brightness(0) invert(1)");
    // 	}, function() {
    // 		$(this).find("img").css("filter", "none");
    // 	},
    // 	focus: function() {
    // 		$(this).find("img").css("filter", "brightness(0) invert(1)");
    // 	}, function() {
    // 		$(this).find("img").css("filter", "none");
    // 	}
    // });
    /*header mybiz buttons*/

    /*job portal*/
    $(".short-job-description").click(function () {
        if ($(window).width() <= 767) {
            $(".job-description-mobile").fadeIn("fast");
        } else {
            $(".description-form-desktop").fadeToggle("fast");
        }
    });

    $(".cross-btn").click(function () {
        $(".description-form-desktop").fadeOut("fast");
        $(".job-description-mobile").fadeOut("fast");
    });

    $(".filters-btn").click(function () {
        $(".filter-container").slideToggle(500);
    });
    /*job portal*/

    /*text editor*/
    // if ($('*').hasClass("ck-editor")) {
    //     tinymce.init({
    //         selector: '.ck-editor',
    //         // if($("div").hasClass("add-job-portal")) {
    //         //     tinymce.init({
    //         //         selector:'#descriptionEditor, #EligibilityEditor',
    //         menubar: false,
    //         statusbar: false,
    //         plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
    //         toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
    //         skin: 'bootstrap',
    //         toolbar_drawer: 'floating',
    //         min_height: 200,
    //         autoresize_bottom_margin: 16,
    //         setup: (editor) => {
    //             editor.on('init', () => {
    //                 editor.getContainer().style.transition = "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
    //             });
    //             editor.on('focus', () => {
    //                 editor.getContainer().style.boxShadow = "0 4px 10px 0 rgb(227 4 4 / 13%), 0 4px 20px 0 rgb(227 4 4 / 13%)",
    //                     editor.getContainer().style.borderColor = "#A52C3E"
    //             });
    //             editor.on('blur', () => {
    //                 editor.getContainer().style.boxShadow = '',
    //                     editor.getContainer().style.borderColor = ''
    //             });
    //         }
    //     });
    // }
    /*text editor*/
    $(document).on("change", '.select2-multiple', function () {
        if ($(this).siblings("span").find("li[title='Other']").length) {
            $(this).closest(".form-group").next(".form-group.other-div").first().show().find('input').prop('required', true);
        } else {
            $(this).closest(".form-group").next(".form-group.other-div").first().hide().find('input').prop('required', false);
        }
    });

    /*main js for single-select-dropdown functionality*/
    $('.single-select-dropdown').change(function () {
        if ($(this).val()!='') {
            $(this).siblings('.is-invalid.error').hide();
            $(this).siblings('.select2').find('.select2-selection--single').addClass('is-valid');
            $(this).siblings('.select2').find('.select2-selection--single').removeClass('is-invalid');
        }
        else if ($(this).val() == 'Other') {
            $(this).closest(".form-group").next(".form-group.other-div").first().show().find('input').prop('required', true);
        }
        else {
            $(this).closest(".form-group").next(".form-group.other-div").first().hide().find('input').prop('required', false);
        }
    });

    $('.next-btn').click(function () {
        setTimeout(() => {
            /*add classes is-invalid and error for single select (select2)*/
            $('.is-invalid.error').siblings('.select2-container--default').find('.select2-selection--single').addClass('is-invalid');
            /*add classes is-invalid and error for single select (select2)*/
        }, 10);
    });
    /*main js for single-select-dropdown functionality*/

    /*radio-btn for other-div to show and hide*/
    $('.radio-btn').click(function () {
        if ($(this).val() == 'Other') {
            $(this).closest(".form-group").next(".form-group.other-div").first().show().find('input').prop('required', true);
        } else {
            $(this).closest(".form-group").next(".form-group.other-div").first().hide().find('input').prop('required', false);
        }
    });
    /*radio-btn for other-div to show and hide*/

    $(document).on("change", '.other-option-included', function () {
        if ($(this).val() == 'Other') {
            $(this).closest(".form-group").next(".form-group.other-div").first().show().find('input').prop('required', true);
        } else {
            $(this).closest(".form-group").next(".form-group.other-div").first().hide().find('input').prop('required', false);
        }
    });

    var counter = parseInt($('#company_counter').val());
    $(".add-btn").click(function () {
        var chemicalInfo = $(".chemical-info-inner").children("div.form-row").last().clone();
        chemicalInfo.css({"border-top": "1px solid black", "padding-top": "10px"})
        chemicalInfo.find('.chemical-info-heading').html('Product Info ' + (counter + 1) + '<button type="button" class="red-btn mb-1 chemical-info-remove float-right">Remove</button>');
        // Manufacturer
        // chemicalInfo.find("input#manufacturer_company_name" + counter).attr({
        //     "id": "manufacturer_company_name" + (counter + 1),
        //     "name": "manufacturer_company_name" + (counter + 1)
        // }).val("").prop('required', 'true');
        // chemicalInfo.find("input#manufacturer_company_name" + (counter + 1)).removeClass('is-invalid');
        // chemicalInfo.find("input#manufacturer_company_name" + (counter + 1)).next('label').remove();
        // chemicalInfo.find("small#manufacturer_company_name" + counter + "_error").attr({
        //     "id": "manufacturer_company_name" + (counter + 1) + "_error"
        // });
        // // Origin
        // chemicalInfo.find("select#origin" + counter).attr({
        //     "id": "origin" + (counter + 1),
        //     "name": "origin" + (counter + 1)
        // }).val("").prop('required', 'true');
        // chemicalInfo.find("select#origin" + (counter + 1)).removeClass('is-invalid');
        // chemicalInfo.find("select#origin" + (counter + 1)).removeClass('is-valid');
        // chemicalInfo.find("select#origin" + (counter + 1)).next('label').remove();
        // chemicalInfo.find("small#origin" + counter + "_error").attr({
        //     "id": "origin" + (counter + 1) + "_error"
        // });
        // Chemicals Listed
        chemicalInfo.find("input#chemicals_listed" + counter).attr({
            "id": "chemicals_listed" + (counter + 1),
            "name": "chemicals_listed" + (counter + 1)
        }).val("").prop('required', 'true');
        chemicalInfo.find("input#chemicals_listed" + (counter + 1)).removeClass('is-invalid');
        chemicalInfo.find("input#chemicals_listed" + (counter + 1)).next('label').remove();
        chemicalInfo.find("small#chemicals_listed" + counter + "_error").attr({
            "id": "chemicals_listed" + (counter + 1) + "_error"
        });
        // Additional Info
        chemicalInfo.find("input#company_additional_info" + counter).attr({
            "id": "company_additional_info" + (counter + 1),
            "name": "company_additional_info" + (counter + 1)
        }).val("");
        // Supply Type
        chemicalInfo.find("input#inStock" + counter).siblings("label").attr("for", "inStock" + (counter + 1));
        chemicalInfo.find("input#inStock" + counter).attr({
            "id": "inStock" + (counter + 1),
            "name": "supply_type" + (counter + 1)
        }).prop('required', 'true');
        chemicalInfo.find("input#inStock" + (counter + 1)).removeClass('is-invalid');
        chemicalInfo.find("input#makeOrder" + counter).siblings("label").attr("for", "makeOrder" + (counter + 1));
        chemicalInfo.find("input#makeOrder" + counter).attr({
            "id": "makeOrder" + (counter + 1),
            "name": "supply_type" + (counter + 1)
        });
        chemicalInfo.find("input#makeOrder" + (counter + 1)).removeClass('is-invalid');
        chemicalInfo.find("input#both" + counter).siblings("label").attr("for", "both" + (counter + 1));
        chemicalInfo.find("input#both" + counter).attr({
            "id": "both" + (counter + 1),
            "name": "supply_type" + (counter + 1)
        });
        chemicalInfo.find("input#both" + (counter + 1)).removeClass('is-invalid');
        chemicalInfo.find("small#supply_type" + counter + "_error").attr({
            "id": "supply_type" + (counter + 1) + "_error",
        });
        chemicalInfo.find("input[type=radio]").prop('checked', false);
        $(".chemical-info-inner").append(chemicalInfo);

        $(".chemical-info-inner").find("input#company_counter").val(counter + 1);
        counter++;
    });

    /*$(".add-btn").click(function() {
        var chemicalInfo = $(".chemical-info-inner").html();
        $(".chemical-info-inner").after(chemicalInfo);
    });*/

    $(document).on('click', '.chemical-info-remove', function () {
        $(this).closest('.form-row').remove();
        counter--;
    });

    $('.product-categories').change(function () {
        var proCategories = $(this).children("option:selected").attr('cat-val');
        var proSubCategories = $(".product-subcategories").children("option:selected").attr('cat-val');
        if (proCategories == "Machinery & Parts") {
            $(".machinery-info").css('display', 'block');
            $(".cert").hide();
            reset();
        } else {
            $(".machinery-info").css('display', 'none');
            $(".cert").show();
            reset();
        }
        if (proCategories == "Garments & Accessories") {

            $('.garments-info').css('display', 'block');
            reset();
            $('.addi_info').attr('placeholder','i.e. Pattern, Trim Details, Technique, Features, Dye Type, Finish Type, Other');
        } else {
            $('.garments-info').css('display', 'none');
            reset();
        }

        if (proCategories == "PPE & Institutional") {
            $('.ppe-institutional-info').css('display', 'block');
            reset();
            $('.addi_info').attr('placeholder','i.e. Pattern, Trim Details, Technique, Features, Dye Type, Finish Type,Other');
        } else {
            $('.ppe-institutional-info').css('display', 'none');
            reset();
        }

        if (proCategories == "Dyes & Chemicals") {
            $('#manufacturer_name, #origin').prop('required', false).closest('.form-group').hide();
            $('.chemical-info').css('display', 'block');
            reset();
        } else if (!$('#productService').prop('checked')) {
            $('.chemical-info').css('display', 'none');
            reset();
            $('#manufacturer_name, #origin').prop('required', false).closest('.form-group').show();
        }
        if (proCategories == "Unstitched & Leftovers") {
            $(".leftover-info").css('display', 'block');
            reset();
        } else {
            $(".leftover-info").css('display', 'none');
            reset();
        }
    });

    $(".product-subcategories").change(function () {
        var proCategories = $(".product-categories").children("option:selected").attr('cat-val');
        var proSubCategories = $(this).children("option:selected").attr('cat-val');

        if (proSubCategories == "Woven Fabric") {
            $(".fabric-info").css('display', 'block');
            $('.addi_info').attr('placeholder','i.e. Yarn Count, Tencile Strength, Technique, Features, Dye Type, Finish Type, Other');
        } else {
            $(".fabric-info").css('display', 'none');
        }
        if (proSubCategories == "Knitted Fabric") {
            $(".knitted-fabric-info").show();
            $('.addi_info').attr('placeholder','i.e. Yarn Count, Tencile Strength, Technique, Features, Dye Type, Finish Type, Other');
        } else {
            $(".knitted-fabric-info").hide();
        }
        if (proSubCategories == "Nonwoven Fabric") {
            $(".non-woven-fabric-info").show();
            $('.addi_info').attr('placeholder','i.e. Yarn Count, Tencile Strength, Technique, Features, Dye Type, Finish Type, Other');
        } else {
            $(".non-woven-fabric-info").hide();
        }
        if (proSubCategories == "Natural Yarn") {
            $(".Yarn-info").show();
            $('.addi_info').attr('placeholder','i.e. Dye Type, Features, Brand, Other');
            var yarnInfo = $(".count_unit").children("option:selected").attr('value');
            if(yarnInfo == "Other"){
                $('.add-other-aditional-yarn-info').show();
            } else {
                $('.add-other-aditional-yarn-info').hide();
            }


        } else {
            $(".Yarn-info").hide();
        }
        if (proSubCategories == "Natural Fibre" || proSubCategories == "Manmade Fibre") {
            $(".fibre-info").show();
            $('.addi_info').attr('placeholder','i.e. Technique, Features, Dye Type, Finish Type,Other');
        }else {
            $(".fibre-info").hide();
        }


        if (proSubCategories == "Synthetic Yarn") {
            $('.yarnPurpose').show();
            $('.yarnVariety').show();
            $('.yarnquality_range').hide();
            $('.yarnproduct_range').hide();
            $('.yarnGrade').hide();
            $('.yarnNature').show();
            $('.yarnCount').show();
            $('.yarnDenier').hide();
            $('.yarnUsageType').show();
            $('.yarnQuality').show();
            $('.yarn_specialtyTexturised').show();
            $('.count_typeTexturised').show();
            // console.log(proSubSubCategories);
            $(".Yarn-info").show();
            $('.addi_info').attr('placeholder','i.e. Dye Type, Features, Brand, Other');
        } else if (proSubCategories == "Natural Yarn") {
            $('.yarnPurpose').show();
            $('.yarnVariety').hide();
            $('.yarnquality_range').hide();
            $('.yarnproduct_range').hide();
            $('.yarnGrade').hide();
            $('.yarnNature').show();
            $('.yarnCount').show();
            $('.yarnDenier').hide();
            $('.yarnUsageType').show();
            $('.yarnQuality').show();
            $('.quality_range_Fancy').hide();
            $('.product_range_Texturised').hide();
            $('.product_range_Fancy').hide();
            $('.quality_range_Fancy').hide();
            $('.count_typeTexturised').show();

            $('.yarn_specialtyTexturised').show();
            // console.log(proSubSubCategories);
            $(".Yarn-info").show();
        } else if (proSubCategories == "Speciality Yarn") {
            $('.yarnPurpose').show();
            $('.yarnVariety').hide();
            $('.yarnquality_range').show();
            $('.quality_range_Fancy').show();
            $('.quality_range_Texturised').hide();
            $('.yarnproduct_range').show();
            $('.product_range_Fancy').show();
            $('.product_range_Texturised').hide();
            $('.yarnGrade').hide();
            $('.yarnNature').show();
            $('.yarnCount').show();
            $('.yarnDenier').hide();
            $('.yarnUsageType').show();
            $('.yarnQuality').show();

            $('.yarn_specialtyTexturised').show();
            $('.count_typeTexturised').show();
            // console.log(proSubSubCategories);
            $(".Yarn-info").show();
            $('.addi_info').attr('placeholder','i.e. Dye Type, Features, Brand, Other');
        } else if (proSubCategories == "Blended Yarn") {
            $('.yarnPurpose').show();
            $('.yarnVariety').show();
            $('.yarnquality_range').show();
            $('.quality_range_Texturised').show();
            $('.quality_range_Fancy').show();
            $('.yarnproduct_range').show();
            $('.product_range_Texturised').show();
            $('.product_range_Fancy').show();
            $('.yarnGrade').show();
            $('.yarnNature').show();
            $('.yarnCount').show();
            $('.yarnDenier').show();
            $('.yarnUsageType').show();
            $('.yarnQuality').show();
            $('.yarn_specialtyTexturised').show();
            $('.count_typeTexturised').show();

            $('.yarn_specialtyTexturised').show();
            // console.log(proSubSubCategories);
            $(".Yarn-info").show();
            $('.addi_info').attr('placeholder','i.e. Dye Type, Features, Brand, Other');

        } else {
            $(".Yarn-info").hide();
        }
    });

    function reset(){
        $('.yarnPurpose').hide();
        $('.yarnVariety').hide();
        $('.yarnquality_range').hide();
        $('.quality_range_Texturised').hide();
        $('.quality_range_Fancy').hide();
        $('.yarnproduct_range').hide();
        $('.product_range_Texturised').hide();
        $('.product_range_Fancy').hide();
        $('.yarnGrade').hide();
        $('.yarnNature').hide();
        $('.yarnCount').hide();
        $('.yarnDenier').hide();
        $('.yarnUsageType').hide();
        $('.yarnQuality').hide();
        $('.yarn_specialtyTexturised').hide();
        $('.count_typeTexturised').hide();


        // console.log(proSubSubCategories);
        $(".Yarn-info").hide();




        $(".fibre-info").hide();
        $(".non-woven-fabric-info").hide();
        $(".knitted-fabric-info").hide();
        $(".fabric-info").css('display', 'none');
    }

    $("#sub_sub_category").change(function () {
        var proCategories = $(".product-categories").children("option:selected").attr('cat-val');
        var proSubCategories = $(".product-subcategories").children("option:selected").attr('cat-val');
        var proSubSubCategories = $(this).children("option:selected").attr('cat-val');

    });
    $('input:checkbox').click(function () {
        if ($(".features-check-other").prop("checked") === true) {
            $(".add-features-field").show();
        } else {
            $(".add-features-field").hide();
        }
        if ($(".non-woven-features-check-other").prop("checked") === true) {
            $(".add-nonwoven-features-field").show();
        } else {
            $(".add-nonwoven-features-field").hide();
        }

        if ($(".End-check-other").prop("checked") === true) {
            $(".add-End-field").show();
        } else {
            $(".add-End-field").hide();
        }

        if ($(".Use-check-other").prop("checked") === true) {
            $(".add-Use-field").show();
        } else {
            $(".add-Use-field").hide();
        }
        if ($(".knitted-use-check-other").prop("checked") === true) {
            $(".add-knitted-Use-field").show();
        } else {
            $(".add-knitted-Use-field").hide();
        }
        if ($(".knitted-feature-use-check-other").prop("checked") === true) {
            $(".add-knitted-features-field").show();
        } else {
            $(".add-knitted-features-field").hide();
        }
    });
    var checked_type_value = false;
    $('input.product-buy-sell').click(function (rb) {
        var newtype_value = false;
        var checked_type_value2 = $("input[name='product_service_types[]']:checked").val();
        if (checked_type_value != false && checked_type_value !== checked_type_value2) {
            if ($('.form-control ').hasClass('is-valid')) {
                if (!confirm("The changes will not be saved – Do you want to discard? Ok/Cancel")) {
                    newtype_value = false;
                    rb.preventDefault();
                }
                else if(confirm){
                    $(window).off('beforeunload');
                    location.reload();
                }
                else {
                    newtype_value = true;
                    checked_type_value = checked_type_value2;
                }
            } else {
                newtype_value = true;
                checked_type_value = checked_type_value2;
            }
        } else if (!checked_type_value) {
            newtype_value = true;
            checked_type_value = checked_type_value2;
        } else {
            newtype_value = false;
        }
        if (newtype_value) {
            var buyProduct = $('#productBuy').prop('checked');
            var sellProduct = $('#productSell').prop('checked');
            var serviceProduct = $('#productService').prop('checked');

            $('.additional-product-info').hide();
            $('.add-unit_price_unit').hide();
            $('.add-target_price_unit').hide();
            // $('.other-option-included').val('PKR');
            if (buyProduct === true || sellProduct === true || serviceProduct === true) {
                $('.product-buy-sell').prop('required', false);

            } else {
                $('.product-buy-sell').prop('required', true);
            }

            if (sellProduct === true) {
                $(".custom-control-input.product-availability").prop('required', true);
                $(".form-control.manufacturer-name").prop('required', false);
                $(".form-control.origin").prop('required', true);
                $(".service-unit").hide();
                $('.product-availability').children('label').html('Product Availability <span class="required"> *</span>');
                $('.manufacturer-name').siblings('label').html('Manufacturer Name <small class="font-500"> (Optional)</small>');
                $('.origin').siblings('label').html('Product Origin <small class="font-500"> (Optional)</small>');
            } else {
                $(".custom-control-input.product-availability").prop('required', false);
                $(".form-control.manufacturer-name").prop('required', false);
                $(".form-control.origin").prop('required', false);
                $('.product-availability').children('label').html('Product Availability');
                $('.manufacturer-name').siblings('label').html('Manufacturer Name <small class="font-500"> (Optional)</small>');
                $('.origin').siblings('label').html('Product Origin <small class="font-500"> (Optional)</small>');
            }

            if (serviceProduct === true) {
                $(".services-container").show();

                $(".services-container").find('#service_durations').prop('required', true);
                $(".services-container").find('#textile_service_types').prop('required', true);
                $(".services-container").find('#service_types').prop('required', true);
                $(".product-categories").val('').removeClass('is-valid');
                $(".product-subcategories").val('').removeClass('is-valid');
                $("#sub_sub_category").val('').removeClass('is-valid');
                $(".product-categories").find('option[cat-type="Business"]').addClass('d-none');
                $(".product-categories").find('option[cat-type="Services"]').removeClass('d-none');
                $('#sub_sub_category').closest('.form-group').addClass('d-none').removeClass('d-flex');
                $('#sub_sub_category').prop('required', false);
                $('.product-service-info').text('SERVICE INFO');
                $('.payment-delivery-info').text('PAYMENT DETAILS');
                $('.manufacturer_name').text('Service Provider');
                $(".hide-for-service").hide();
                $(".service-unit").show();

            } else {
                $(".hide-for-service").show();
                $(".service-unit").hide();
                $(".services-container").hide();
                $(".services-container").find('#service_durations').prop('required', false);
                $(".services-container").find('#textile_service_types').prop('required', false);
                $(".services-container").find('#service_types').prop('required', false);
                $(".product-categories").val('').removeClass('is-valid');
                $(".product-subcategories").val('').removeClass('is-valid');
                $("#sub_sub_category").val('').removeClass('is-valid');
                $(".product-categories").find('option[cat-type="Business"]').removeClass('d-none');
                $(".product-categories").find('option[cat-type="Services"]').addClass('d-none');
                $('#sub_sub_category').closest('.form-group').addClass('d-flex').removeClass('d-none');;
                $('#sub_sub_category').prop('required', true);
                $('.product-service-info').text('PRODUCT INFO');
                // $('.payment-delivery-info').text('PAYMENT & DELIVERY INFO');
                $('.payment-delivery-info').text('PAYMENT INFO');
            }

            if (buyProduct === true) {
                $(".form-control.suitable-currency").prop('required', true);
                $(".form-control.suitable-currency").closest('.form-group').children('label').html('Suitable Currency <span class="required"> *</span>');
                $(".form-control.payment-terms").prop('required', true);
                $(".form-control.payment-terms").closest('.form-group').children('label').html('Payment Terms <span class="required"> *</span>');
                $(".additional-product-info .custom-control-input").prop('required', true);
                $(".additional-product-info .optional-field").prop('required', false);
                $(".custom-control-input.product-availability").prop('required', false);
                $('.product-availability').children('label').html('Product Availability <small class="font-500"> (Optional)</small>');
                $("small.field-error-msg").hide();
                $(".fabric-type").find(".fabric-multiselect").prop("required", false);
                $(".additonial-info").find(".form-control").prop("required", false);
                $(".trade-info").hide();
                $(".service-unit").hide();
                $(".trade-info-tab").find(".required-control").prop('required', false);
                $('.manufacturer_name').html('Preferred Manufacturer Name  <small class="font-500"> (Optional)</small>');
                $('.avail-quantity').html('Required Quantity  <span class="required"> *</span>');
            } else {
                $(".form-control.suitable-currency").prop('required', true);
                $(".form-control.suitable-currency").closest('.form-group').children('label').html('Suitable Currency <span class="required"> *</span>');
                $(".form-control.payment-terms").prop('required', true);
                $(".form-control.payment-terms").closest('.form-group').children('label').html('Payment Terms <span class="required"> *</span>');
                $(".additional-product-info .custom-control-input, .additional-product-info .form-control").prop('required', true);
                $(".additional-product-info .optional-field").prop('required', false);
                $("small.field-error-msg").show();
                $(".fabric-type").find(".fabric-multiselect").prop("required", false);
                $(".additonial-info").find(".form-control").prop("required", false);
                $(".trade-info").show();
                $(".trade-info-tab").find(".required-control").prop('required', true);
            }

            if (serviceProduct === true) {
                $("label[for='sub_category']").html('Service Type <span class="required"> *</span>');
                $("label[for='product_images']").html('Service Image <span class="required"> *</span><br><small class="font-500">(JPG & PNG  files only | Atleast one product image | Upto\n' + '10MB)</small>');
                $(".services-container").find('.multiselectButton').prop('required', true);
                $(".product-name").find('label').html('Service Name <span class="required"> *</span>');
                $(".product-name").find('input').attr('placeholder', 'Service Name *');
                $(".trade-info-tab").find(".required-control").prop('required', false);
                $(".product-availability").hide();
                $(".product-available").hide();
                $(".trade-info-container").hide();
                $(".trade-info").hide();
                $(".trade-info-tab").find(".required-control").prop('required', false);
                $(".optional-field").find(".form-control").prop("required", false);
                $(".form-control.manufacturer-name").parent().hide();
                $(".form-control.origin").parent().hide();
                $('.unit_price_range_label').hide();
                // $('.service_charges_range_label').show();
                $('#unit_price_from').attr('placeholder', 'Service Charges *');
                $('.service_charges_range_unit_label').show();
                $('.product_lead_time').hide();
                $('.product_delivery').hide();
                $(".service-unit").show();
                $('.manufacturer_name').text('Manufacturer Name <small class="font-500"> (Optional)</small>');
            } else {
                $("label[for='sub_category']").html('Sub-Category <span class="required"> *</span>');
                $("label[for='product_images']").html('Product Image <span class="required"> *</span><br><small class="font-500">(JPG & PNG  files only | Atleast one product image | Upto\n' + '10MB)</small>');
                // $(".services-container").find('.multiselectButton').prop('required', false);
                $(".product-name").find('label').html('Product Name <span class="required"> *</span>');
                $(".product-name").find('input').attr('placeholder', 'Product Name *');
                $(".product-availability").show();
                $(".product-available").show();
                $(".trade-info-container").show();
                $(".service-unit").hide();
                $(".optional-field").find(".form-control").prop("required", false);
                $(".form-control.manufacturer-name").parent().show();
                $(".form-control.origin").parent().show();
                // $('.service_charges_range_label').hide();
                $('#unit_price_from').attr('placeholder', 'Unit Price *');
                $('.service_charges_range_unit_label').hide();
                $('.unit_price_range_label').show();
                $('.product_lead_time').show();
                $('.product_delivery').show();
            }
            if (serviceProduct === true || sellProduct === true) {
                $('.unit_price_range').show();
                $('.target_price_range').hide();
            } else {
                $('.target_price_range').show();
                $('.unit_price_range').hide();
            }
        }
    });

    var select = '<option value="" disabled selected>1 to 500</option>';
    for (i = 1; i <= 500; i++) {
        select += '<option val=' + i + '>' + i + '</option>';
    }
    $('.counting-selector').html(select);
    var select500
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    // var validator = $("form[name='registration']").validate({
    //     // Specify validation rules
    //     rules: {
    //         // The key name on the left side is the name attribute
    //         // of an input field. Validation rules are defined
    //         // on the right side
    //         first_name: "required",
    //         last_name: "required",
    //         email: {
    //             required: true,
    //             // Specify that email should be validated
    //             // by the built-in "email" rule
    //             email: true
    //         },
    //         onkeyup: function(element) {
    //             var $element = $(element);
    //             $element.valid();
    //         },
    //
    //         country_id: {
    //             required: true
    //         },
    //         /*phone: {
    //             required: true
    //         },
    //         user_type: {
    //           required: true
    //         },
    //         groups: {
    //               checks: "user_type user_type user_type user_type"
    //         },*/
    //         company_name: {
    //             required: true
    //         },
    //         password: {
    //             required: true,
    //             minlength: 8
    //         },
    //         confirm_password: {
    //             required: true,
    //             equalTo: '#password'
    //         },
    //         birthday: {
    //             required: true
    //         }
    //     },
    //     // Specify validation error messages
    //     messages: {
    //         first_name: "Please enter your firstname",
    //         last_name: "Please enter your lastname",
    //         password: {
    //             required: "Please provide a password",
    //             minlength: "Your password must be at least 8 characters long"
    //         },
    //         confirm_password: {
    //             equalTo: "Password does not match"
    //         },
    //         email: "Please enter a valid email address"
    //     },
    //     errorClass: 'is-invalid error',
    //     validClass: 'is-valid',
    //     // Make sure the form is submitted to the destination defined
    //     // in the "action" attribute of the form when valid
    //     submitHandler: function(form) {
    //         if (!$("#mobileNumber").hasClass("is-invalid")) {
    //             // form.submit();
    //         }
    //     },
    //     invalidHandler: function(form) {
    //         $( "#summary" ).text( validator.numberOfInvalids() + " field(s) are invalid" );
    //     }
    // });

    $("form[name='companyprofile']").validate({
        rules: {
            company_name: {
                required: true
            },
            business_type: {
                required: true
            },
            nature_business: {
                required: true
            },
            email: {
                required: true,
                // Specify that email should be validated
                // by the built-in "email" rule
                email: true
            }
        },
        messages: {
            company_name: "Please enter your company name"
        },
        errorClass: 'is-invalid error',
        validClass: 'is-valid',
        submitHandler: function (form) {
            // form.submit();
        }
    });
});

Dropzone.autoDiscover = false;
/*$(function() {
	class="form-group ticks-checkbox mt-3 mb-3" = new Dropzone("div.images-drop", {
        companyId:'',
        url: "{{url('images')}}",
        addRemoveLinks:true,
        dictRemoveFile:'<button class="delete w-100"><span class="fa fa-trash"></span></button>',
        autoProcessQueue:false,
        parallelUploads: 5,
        maxThumbnailFilesize: 5,
        acceptedFiles:'image/jpeg,image/png',
        paramName: "file",
        init: function(){
            let thisDropzone = this;
            this.on('sending', function(file, xhr, formData){
                formData.append('companyId', thisDropzone.companyId);
            });
        }
    });

	class="form-group ticks-checkbox mt-3 mb-3" = new Dropzone("div.images-files-drop", {
        companyId:'',
        url: "{{url('images')}}",
        addRemoveLinks:true,
        dictRemoveFile:'<button class="delete w-100"><span class="fa fa-trash"></span></button>',
        autoProcessQueue:false,
        parallelUploads: 5,
        maxThumbnailFilesize: 5,
        acceptedFiles:'image/jpeg,image/png,application/pdf',
        paramName: "file",
        init: function(){
            let thisDropzone = this;
            this.on('sending', function(file, xhr, formData){
                formData.append('companyId', thisDropzone.companyId);
            });
        }
    });
});*/

$(document).ready(function () {
    //paste this code under the head tag or in a separate js file.
    // Wait for window load
    // Animate loader off screen
    $("#loader").fadeOut("slow");

    /*tooltip*/
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
    /*tooltip*/

    /*dashboard side bar active link*/
    $(".sidebar-links").each(function () {
        // Current page url
        var currentUrl = window.location.href.split('/');
        var currentValue = currentUrl.pop();
        // currentValue = currentUrl.pop()+'/'+currentValue;

        // Active sidebar item url
        var activeUrl = $(this).attr("href").split('/');
        var activeValue = activeUrl.pop();
        // activeValue = activeUrl.pop()+'/'+activeValue;

        if (currentValue == activeValue) {
            $(this).addClass("active-link");
            $(this).parent('li').css('background', '#34435626');
            $(this).parents('ul').siblings('a').addClass("active-link");
            $(this).parents('ul').parent('li').css('background', '#3443562e');
        }
    });
    /*dashboard side bar active link*/

    /*suppliers active links*/
    $(".suppliers-nav .link").each(function () {
        // Current page url
        var currentUrl = window.location.href.split('/');

        var currentValue = currentUrl.pop();
        // currentValue = currentUrl.pop()+'/'+currentValue;

        // Active url
        var activeUrl = $(this).attr("href").split('/');
        var activeValue = activeUrl.pop();
        // activeValue = activeUrl.pop()+'/'+activeValue;

        if (currentValue == activeValue) {
            $(this).css('background', '#6b2929');
        }
    });
    /*suppliers active links*/

    /*scrolling buttons*/
    if($('body').hasClass('homepage')) {
        $('.scrolling-btns').show();
    }
    else {
        $('.scrolling-btns').hide();
    }

    $("#bottomScroll").click(function () {
        var vheight = $(window).innerHeight();
        $('html, body').animate({
            scrollTop: (Math.ceil($(window).scrollTop() / vheight) + 1) * vheight
        }, 500);

    });

    $("#topScroll").click(function () {
        var vheight = $(window).innerHeight();
        $('html, body').animate({
            scrollTop: (Math.ceil($(window).scrollTop() / vheight) - 1) * vheight
        }, 500);
    });

    $('#topScroll').hide();
    $(window).scroll(function () {
        var scrollScreen = $(window).scrollTop();
        var scrollFloatToInt = Math.ceil(scrollScreen);
        if (scrollFloatToInt + $(window).height() > $(document).height() - 100) {
            $('#bottomScroll').hide();
            $('#topScroll').show();
        } else {
            $('#bottomScroll').show();
            $('#topScroll').hide();

        }
    });
    /*scrolling buttons*/

    /*MyBiz Products & Services (General for all product categories except which are mentioned specifically in the subsequent sections)*/
    $('input:radio').click(function () {
        if ($('#proYes').prop('checked') === true) {
            $('.paid-or-free').show();
        } else {
            $('.paid-or-free').hide();
        }

        if ($('#productYes').prop('checked') === true) {
            $('.type-of-service').show();
        } else {
            $('.type-of-service').hide();
        }

        if ($('#warrantyYes').prop('checked') === true) {
            $('.warranty-services').show();
        } else {
            $('.warranty-services').hide();
        }

        if ($('#certifyYes').prop('checked') === true) {
            $('.certify-services').show();
        } else {
            $('.certify-services').hide();
        }
    });

    // $('input:checkbox').click(function() {
    // 	if($('#productBuy').prop('checked')===true && $('#productSell').prop('checked')===false && $('#productService').prop('checked')===false) {
    // 		$('.product-sales-services').show();
    // 	}
    // 	else {
    // 		$('.product-sales-services').hide();
    // 	}
    // });
    /*MyBiz Products & Services (General for all product categories except which are mentioned specifically in the subsequent sections)*/

    /*if($('div').hasClass('company-profile')) {
        var myDropzone = new Dropzone("div#myDrop", {
            companyId:'',
            url: "{{url('images')}}",
            addRemoveLinks:true,
            dictRemoveFile:'<button class="delete w-100"><span class="fa fa-trash"></span></button>',
            autoProcessQueue:false,
            parallelUploads: 5,
            acceptedFiles:'image/*',
            paramName: "file",
            init: function(){
                let thisDropzone = this;
                this.on('sending', function(file, xhr, formData){
                    formData.append('companyId', thisDropzone.companyId);
                });
            }
        });
    }*/
});

$(document).ready(function () {
    $('.multiselectButton').multiselect({
        buttonClass: 'btn-lg',
        buttonWidth: '100%',
        buttonContainer: '<span class="dropdown" />',
        includeSelectAllOption: false,
        nonSelectedText: 'Select at least one',
    });

    $('.dropdown-menu').change(function () {
        var otherArray = [];
        otherArray = $('.multiselect').attr('title');

        if (otherArray.indexOf("Others") !== -1) {
            $('#othersField').css('display', 'block');
        } else {
            $('#othersField').css('display', 'none');
        }
    });

    // Jquery Dependency
    $("input[data-type='currency']").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        }
    });

    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.

        // get input value
        var input_val = input.val();

        // don't validate empty input
        if (input_val === "") {
            return;
        }

        // original length
        var original_len = input_val.length;

        // initial caret position
        var caret_pos = input.prop("selectionStart");

        // check for decimal
        if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);

            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
                right_side += "00";
            }

            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = "$" + left_side + "." + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = "$" + input_val;

            // final formatting
            if (blur === "blur") {
                input_val += ".00";
            }
        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }
});

jQuery.validator.addMethod("mobilenumber", function (value, element, params) {
    if ($("#mobileNumber").hasClass("is-valid")) {
        return true;
    } else {
        return false;
    }
}, jQuery.validator.format("Please enter valid mobile number"));

/*country code*/
// var telInput = $("#phone"),
// errorMsg = $("#error-msg"),
// validMsg = $("#valid-msg");

// // initialise plugin
// telInput.intlTelInput({

// allowExtensions: true,
// formatOnDisplay: true,
// autoFormat: true,
// autoHideDialCode: false,
// autoPlaceholder: true,
// defaultCountry: "auto",
// ipinfoToken: "yolo",

// nationalMode: false,
// numberType: "MOBILE",
// //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
// preferredCountries: ['sa', 'ae', 'qa','om','bh','kw','ma'],
// preventInvalidNumbers: true,
// separateDialCode: false,
// initialCountry: "pk",
// geoIpLookup: function(callback) {
// $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
// var countryCode = (resp && resp.country) ? resp.country : "";
// callback(countryCode);
// });
// },
// utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
// });

// var reset = function() {
// telInput.removeClass("error");
// errorMsg.addClass("hide");
// validMsg.addClass("hide");
// };

// // on blur: validate
// telInput.blur(function() {
// reset();
// if ($.trim(telInput.val())) {
// if (telInput.intlTelInput("isValidNumber")) {
// validMsg.removeClass("hide");
// } else {
// telInput.addClass("error");
// errorMsg.removeClass("hide");
// }
// }
// });
/*country code*/
// initialise plugin
// var mobileNumberInput = $("#mobileNumber"),
//     whatsappNumberInput = $("#whatsappNumber"),
//     mobileNumInput = $(".mobileNum"),
//     mobileNumbererrorMsg = $("#mobileNumber-error-msg"),
//     whatsappNumbererrorMsg = $("#whatsappNumber-error-msg"),
//     mobileNumerrorMsg = $("#mobileNum-error-msg"),
//     validMsg = $("#valid-msg");
// var mobileNumber = document.querySelector("#mobileNumber");
// var whatsappNumber = document.querySelector("#whatsappNumber");
// var mobileNum = document.querySelector(".mobileNum");
// // console.log(telInput2);
// if (mobileNumber) {
//     var telflags1 = window.intlTelInput(mobileNumber, {
//         allowExtensions: true,
//         formatOnDisplay: true,
//         autoFormat: true,
//         autoHideDialCode: false,
//         autoPlaceholder: true,
//         defaultCountry: "auto",
//         ipinfoToken: "yolo",
//         nationalMode: false,
//         numberType: "MOBILE",
//         //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
//         preferredCountries: ['pk', 'sa', 'ae', 'qa', 'om', 'bh', 'kw', 'ma'],
//         preventInvalidNumbers: true,
//         separateDialCode: true,
//         initialCountry: "pk",
//         geoIpLookup: function (callback) {
//             $.get("http://ipinfo.io", function () {
//             }, "jsonp").always(function (resp) {
//                 var countryCode = (resp && resp.country) ? resp.country : "";
//                 callback(countryCode);
//             });
//         },
//         utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
//     });
// }
// if (whatsappNumber) {
//     var telflags2 = window.intlTelInput(whatsappNumber, {
//         allowExtensions: true,
//         formatOnDisplay: true,
//         autoFormat: true,
//         autoHideDialCode: false,
//         autoPlaceholder: true,
//         defaultCountry: "auto",
//         ipinfoToken: "yolo",
//         nationalMode: false,
//         numberType: "MOBILE",
//         //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
//         preferredCountries: ['pk', 'sa', 'ae', 'qa', 'om', 'bh', 'kw', 'ma'],
//         preventInvalidNumbers: true,
//         separateDialCode: true,
//         initialCountry: "pk",
//         geoIpLookup: function (callback) {
//             $.get("http://ipinfo.io", function () {
//             }, "jsonp").always(function (resp) {
//                 var countryCode = (resp && resp.country) ? resp.country : "";
//                 callback(countryCode);
//             });
//         },
//         utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
//     });
// }
// if (mobileNum) {
//     var telflags3 = window.intlTelInput(mobileNum, {
//         allowExtensions: true,
//         formatOnDisplay: true,
//         autoFormat: true,
//         autoHideDialCode: false,
//         autoPlaceholder: true,
//         defaultCountry: "auto",
//         ipinfoToken: "yolo",
//         nationalMode: false,
//         numberType: "MOBILE",
//         //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
//         preferredCountries: ['pk', 'sa', 'ae', 'qa', 'om', 'bh', 'kw', 'ma'],
//         preventInvalidNumbers: true,
//         separateDialCode: true,
//         initialCountry: "pk",
//         geoIpLookup: function (callback) {
//             $.get("http://ipinfo.io", function () {
//             }, "jsonp").always(function (resp) {
//                 var countryCode = (resp && resp.country) ? resp.country : "";
//                 callback(countryCode);
//             });
//         },
//         utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
//     });
// }
// var reset = function (numinput, errormsgdiv) {
//     numinput.removeClass("is-invalid is-valid");
//     errormsgdiv.addClass("hide");
// };

// on blur: validate
// mobileNumberInput.keyup(function () {
//     reset(mobileNumberInput, mobileNumbererrorMsg);
//     if ($.trim(mobileNumberInput.val())) {
//         if (!telflags1.isValidNumber()) {
//             mobileNumberInput.addClass("is-invalid");
//             mobileNumbererrorMsg.removeClass("hide");
//         } else {
//             mobileNumberInput.addClass("is-valid");
//         }
//     } else {
//         mobileNumberInput.addClass("is-valid");
//     }
// });
// whatsappNumberInput.keyup(function () {
//     reset(whatsappNumberInput, whatsappNumbererrorMsg);
//     if ($.trim(whatsappNumberInput.val())) {
//         if (!telflags2.isValidNumber()) {
//             whatsappNumberInput.addClass("is-invalid");
//             whatsappNumbererrorMsg.removeClass("hide");
//         } else {
//             whatsappNumberInput.addClass("is-valid");
//         }
//     } else {
//         whatsappNumberInput.addClass("is-valid");
//     }
// });
// mobileNumInput.keyup(function () {
//     reset(mobileNumInput, mobileNumerrorMsg);
//     if ($.trim(mobileNumInput.val())) {
//         if (!telflags3.isValidNumber()) {
//             mobileNumInput.addClass("is-invalid");
//             mobileNumerrorMsg.removeClass("hide");
//         } else {
//             mobileNumInput.addClass("is-valid");
//         }
//     } else {
//         mobileNumInput.addClass("is-valid");
//     }
// });

var telInput = $("#mobileNumber, #whatsappNumber, .mobileNum"),
    errorMsg = $("#error-msg"),
    validMsg = $("#valid-msg");
var telInput2 = document.querySelector("#mobileNumber, #whatsappNumber, .mobileNum");
if (telInput2) {
    var telflags = telInput.intlTelInput({
        allowExtensions: true,
        formatOnDisplay: true,
        autoFormat: true,
        autoHideDialCode: false,
        autoPlaceholder: true,
        defaultCountry: "auto",
        ipinfoToken: "yolo",
        nationalMode: false,
        numberType: "MOBILE",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['pk', 'cn', 'us', 'gb'],
        preventInvalidNumbers: true,
        separateDialCode: true,
        initialCountry: "pk",
        geoIpLookup: function (callback) {
            $.get("http://ipinfo.io", function () {
            }, "jsonp").always(function (resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
    });
}
var reset = function (tel_input, tel_error) {
    tel_input.removeClass("is-invalid is-valid");
    tel_error.addClass("hide");
};

// on blur: validate
telInput.keyup(function () {
    var tel_error_msg = $(this).closest('.iti').siblings('.tel-error-msg');
    var regExpLetters = /[a-zA-Z]/g;
    reset($(this), tel_error_msg);
    if ($.trim($(this).val())) {
        if ($(this).intlTelInput("isValidNumber") != true || regExpLetters.test($.trim($(this).val()))) {
            $(this).addClass("is-invalid");
            // tel_error_msg.removeClass("hide");
        } else {
            $(this).addClass("is-valid");
        }
    } else {
        $(this).addClass("is-valid");
    }
});

$.validator.addMethod("phoneNumberFormat", function (value, element) {
        if ($(element).hasClass("is-valid")) {
            return true;
        } else if ($(element).val() == '' && !$(element).prop('required')) {
            return true;
        } else {
            return false;
        }
    },
    "Please enter valid number"
);
// telInput.blur(function() {
// 	reset();
// 	if ($.trim(telInput.val())) {
// 		if (!telInput.intlTelInput("isValidNumber")) {
// 			telInput.addClass("is-invalid");
// 			errorMsg.removeClass("hide");
// 		}
// 		else {
// 			telInput.addClass("is-valid");
// 		}
// 	}
// });
/*country code*/

var bizonair = {};
$(function () {
    /*edit-company-profile*/
    // $('.about-edit-btn, .com-edit-btn').click(function() {
    // 	$('#companyTab1').hide();
    // 	$('#companyTab2').show();
    // 	$('#aboutLinks .nav-item:nth-child(1) .nav-link').removeClass('active');
    // 	$('#aboutLinks .nav-item:nth-child(2) .nav-link').addClass('active');
    // 	$('#myCompanyTab .tab-pane.fade:nth-child(1)').removeClass('active show');
    // 	$('#myCompanyTab .tab-pane.fade:nth-child(2)').addClass('active show');
    // });

    // $('.loc-edit-btn').click(function() {
    // 	$('#companyTab1').hide();
    // 	$('#companyTab2').show();
    // });
    $('.profile-edit-btn').click(function () {
        $('#companyTab1').hide();
        $('#companyTab2').show();
        $("form[name='updateAccount']").valid();
    });

    $('.additional-edit-btn').click(function () {
        $('#companyTab1').hide();
        $('#companyTab2').show();
        $('#aboutLinks .nav-item:nth-child(1) .nav-link').removeClass('active');
        $('#aboutLinks .nav-item:nth-child(2) .nav-link').addClass('active');
        $('#myCompanyTab .tab-pane.fade:nth-child(1)').removeClass('active show');
        $('#myCompanyTab .tab-pane.fade:nth-child(2)').addClass('active show');
    });
    /*edit-user-profile*/

    /*edit-company-profile*/
    $('.about-edit-btn, .com-edit-btn').click(function () {
        $('#companyTab1').hide();
        $('#companyTab2').show();
    });
    $('.close-form').click(function () {
        if (confirm("The changes will not be saved – Do you want to discard? Ok/Cancel")) {
            $('#companyTab2').hide();
            $('#companyTab1').show();
        }
    });
    $('.add-cancil-form').click(function () {
        // if (confirm("The changes will not be saved – Do you want to discard? Ok/Cancel")) {
        //     $('#companyTab2').hide();
        //     $('#companyTab1').show();
        // }
        //alert('The changes will not be saved – Do you want to continue?');
        $(window).off('beforeunload');
        location.reload();
    });
    $('.extra-edit-btn').click(function () {
        $('#companyTab1').hide();
        $('#companyTab2').show();
        $('#aboutLinks .nav-item:nth-child(1) .nav-link').removeClass('active');
        $('#aboutLinks .nav-item:nth-child(2) .nav-link').addClass('active');
        $('#myCompanyTab .tab-pane.fade:nth-child(1)').removeClass('active show');
        $('#myCompanyTab .tab-pane.fade:nth-child(2)').addClass('active show');
    });

    $('.edit-payment').click(function () {
        $('#companyTab1').hide();
        $('#companyTab2').show();
        $('#aboutLinks .nav-item:nth-child(1) .nav-link, #aboutLinks .nav-item:nth-child(2) .nav-link').removeClass('active');
        $('#aboutLinks .nav-item:nth-child(3) .nav-link').addClass('active');
        $('#myCompanyTab .tab-pane.fade:nth-child(1), #myCompanyTab .tab-pane.fade:nth-child(2)').removeClass('active show');
        $('#myCompanyTab .tab-pane.fade:nth-child(3)').addClass('active show');
    });

    /*edit-company-profile*/


    /*group chat dashboard*/
    $('.message-send').click(function () {
        if ($('.chat-input').val() != "") {
            var a = $('.chat-messages');
            var chatText = $('.chat-input').val();
            var time = '10:15 AM';
            var name = 'Ben Stiller';
            a.append($('<div class="message-box-holder">' + '<div class="message-reciever">' + '<span class="time">' + time + '</span>' + ', ' + '<a href="#">' + name + '</a>' + '</div>' + '<div class="message-box">' + chatText + '</div>' + '<span class="my-img-container">' + '<img src= "./images/img-technology.png">' + '</span>' + '</div>'));
        }
    });

    $('#chkSettings').click(function () {
        $('.settings-popup').slideToggle(5);
    });
    /*group chat dashboard*/

    /*my account multiselect element*/
    $("#multiSelectCat").treeMultiselect();
    /*my account multiselect element*/

    /*dasboard*/
    if ($('div').hasClass('chart-container')) {
        var ctx = $('#myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Data-1',
                    data: [30, 29, 5, 5, 20, 3, 10],
                    backgroundColor: '#344256',
                }, {
                    label: 'Data-2',
                    data: [12, 19, 3, 17, 28, 24, 7],
                    backgroundColor: '#A52C3E',
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        barPercentage: 0.4,
                        stacked: true,
                        ticks: {
                            fontSize: 10
                        },
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true,
                            fontSize: 10
                        },
                        type: 'linear',
                    }]
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'MyBiz Leads',
                    fontSize: 10
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                }
            }
        });
    }

    $("#dashboardWrapper #menu-toggle").click(function (e) {
        e.preventDefault();
        $("#dashboardWrapper").toggleClass("toggled");
    });

    var delay = 500;
    $("#dashboardSidebar .progress-bar").each(function (i) {
        $(this).delay(delay * i).animate({width: $(this).attr('aria-valuenow') + '%'}, delay);

        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: delay,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now) + '%');
            }
        });
    });
    /*dasboard*/

    /*dasboard sidebar*/
    $('#dashboardSidebar .side-nav .categories li').on('click', function () {

        var $this = $(this);

        $this.toggleClass('opend').siblings().removeClass('opend');

        if ($this.hasClass('opend')) {
            $this.find('.side-nav-dropdown').slideToggle('fast');
            $this.siblings().find('.side-nav-dropdown').slideUp('fast');
            $this.tooltip('disable');
        } else {
            $this.find('.side-nav-dropdown').slideUp('fast');
            $this.tooltip('enable');
        }
    });

    $('#dashboardSidebar .side-nav .close-aside').on('click', function () {
        $('#' + $(this).data('close')).addClass('show-side-nav');
        contents.removeClass('margin');
    });

    /*Avatar upload*/
    $('input[name="avatar"]').change(function() {
        var MAX_FILE_SIZE = 2 * 1024 * 1024; // 2MB
        var fileSize = this.files[0].size;
        if (fileSize > MAX_FILE_SIZE) {
            alert("File must not exceed 2 MB!");
            $(this).val(null);
        } else {
            /*alert("File less than 2 MB!");*/
            var readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#uploaded_image').attr('src', e.target.result);
                        $('.header-profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        }
    });

    $(".file-upload").on('change', function () {
        readURL(this);
    });

    $(".upload-button").on('click', function () {
        $(this).siblings('.file-upload').click();
    });
    /*Avatar upload*/
    /*dasboard sidebar*/

    /*product images upload*/
    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#uploaded_image').attr('src', e.target.result);
                $('.header-profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".product-file-upload").on('change', function () {

    });
    $(".product-upload-button").on('click', function () {
        $(this).siblings('.product-file-upload').click();
    });

    /*tickmark checkboxes*/
    $("ul li").click(function () {
        $(this).find("input").toggleClass("fa-square-o fa-check-square-o");
    });
    /*tickmark checkboxes*/


    /*registration-form*/
    $("ul li").click(function () {
        $(this).find("input").toggleClass("fa-square-o fa-check-square-o");
    });

    $("ul li").click(function () {
        $(this).find("input").toggleClass("fa-square-o fa-check-square-o");
    });

    $(".service-provider").click(function () {
        $(".choose-services").toggle();
        if ($(".choose-services").is(":visible")) {
            $(".choose-services").prop('required', true);
        } else {
            $(".choose-services").prop('required', false);
        }
        $(".select2-container--default").toggle();
        $(".select2-search--inline").find('input').attr('placeholder', 'Select Service Type');
    });
    /*registration-form*/

    /*header*/
    if ($(window).width() >= 992) {
        $(".header .navbar #bizonairNav .navbar-nav .nav-item.dropdown:not('.category-nav-Search')").hover(function () {
            $(this).addClass("show");
            $(this).find(".dropdown-menu").addClass("show");
            $(this).children('.dropdown').addClass('nav-underline');
        }, function () {
            $(this).children('.dropdown').removeClass('nav-underline');
            $(this).removeClass("show");
            $(this).find(".dropdown-menu").removeClass("show");
        });
    }
    /*header*/

    /*homepage*/
    $(".services-container").hover(function () {
        $(this).find('.services-headings').addClass("white-text");
        $(this).find('p').addClass("white-text");
        $(this).find('img').addClass("img-hover");
    }, function () {
        $(this).find('.services-headings').removeClass("white-text");
        $(this).find('p').removeClass("white-text");
        $(this).find('img').removeClass("img-hover");
    });

    /*homepage sliders*/
    $('.homepage .products-slider .slider-nav').slick({
        autoplay: true,
        dots: true,
        autoplaySpeed: 3000,
        centerMode: false,
        slidesToShow: 4,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 576,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 2
                }
            }
        ]
    });

    $('.homepage .textile-news-inner').slick({
        autoplay: true,
        dots: true,
        autoplaySpeed: 3000,
        centerMode: false,
        slidesToShow: 4,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 576,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 2
                }
            }
        ]
    });
    /*homepage sliders*/
    /*homepage*/

    /*product deals sliders*/
    $('.products-deals-slider').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        centerMode: false,
        slidesToShow: 5,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    arrows: true,
                    centerMode: false,
                    centerPadding: '40px',
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: false,
                    centerPadding: '40px',
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    arrows: false,
                    centerMode: false,
                    centerPadding: '40px',
                    slidesToShow: 2
                }
            }
        ]
    });

    $('#left-thumb-slider').lightSlider({
        gallery: true,
        controls: true,
        item: 1,
        vertical: true,
        verticalHeight: 185,
        vThumbWidth: 50,
        thumbItem: 8,
        thumbMargin: 4,
        slideMargin: 0
    });
    /*product deals sliders*/

    /*country dropdown*/
    if ($('body').hasClass('product-details')) {
        function countriesDropdown(container) {
            var countries = {
                AFG: "Afghanistan",
                ALB: "Albania",
                ALG: "Algeria",
                AND: "Andorra",
                ANG: "Angola",
                ANT: "Antigua and Barbuda",
                ARG: "Argentina",
                ARM: "Armenia",
                ARU: "Aruba",
                ASA: "American Samoa",
                AUS: "Australia",
                AUT: "Austria",
                AZE: "Azerbaijan",
                BAH: "Bahamas",
                BAN: "Bangladesh",
                BAR: "Barbados",
                BDI: "Burundi",
                BEL: "Belgium",
                BEN: "Benin",
                BER: "Bermuda",
                BHU: "Bhutan",
                BIH: "Bosnia and Herzegovina",
                BIZ: "Belize",
                BLR: "Belarus",
                BOL: "Bolivia",
                BOT: "Botswana",
                BRA: "Brazil",
                BRN: "Bahrain",
                BRU: "Brunei",
                BUL: "Bulgaria",
                BUR: "Burkina Faso",
                CAF: "Central African Republic",
                CAM: "Cambodia",
                CAN: "Canada",
                CAY: "Cayman Islands",
                CGO: "Congo",
                CHA: "Chad",
                CHI: "Chile",
                CHN: "China",
                CIV: "Cote d'Ivoire",
                CMR: "Cameroon",
                COD: "DR Congo",
                COK: "Cook Islands",
                COL: "Colombia",
                COM: "Comoros",
                CPV: "Cape Verde",
                CRC: "Costa Rica",
                CRO: "Croatia",
                CUB: "Cuba",
                CYP: "Cyprus",
                CZE: "Czech Republic",
                DEN: "Denmark",
                DJI: "Djibouti",
                DMA: "Dominica",
                DOM: "Dominican Republic",
                ECU: "Ecuador",
                EGY: "Egypt",
                ERI: "Eritrea",
                ESA: "El Salvador",
                ESP: "Spain",
                EST: "Estonia",
                ETH: "Ethiopia",
                FIJ: "Fiji",
                FIN: "Finland",
                FRA: "France",
                FSM: "Micronesia",
                GAB: "Gabon",
                GAM: "Gambia",
                GBR: "Great Britain",
                GBS: "Guinea-Bissau",
                GEO: "Georgia",
                GEQ: "Equatorial Guinea",
                GER: "Germany",
                GHA: "Ghana",
                GRE: "Greece",
                GRN: "Grenada",
                GUA: "Guatemala",
                GUI: "Guinea",
                GUM: "Guam",
                GUY: "Guyana",
                HAI: "Haiti",
                HKG: "Hong Kong",
                HON: "Honduras",
                HUN: "Hungary",
                INA: "Indonesia",
                IND: "India",
                IRI: "Iran",
                IRL: "Ireland",
                IRQ: "Iraq",
                ISL: "Iceland",
                ISR: "Israel",
                ISV: "Virgin Islands",
                ITA: "Italy",
                IVB: "British Virgin Islands",
                JAM: "Jamaica",
                JOR: "Jordan",
                JPN: "Japan",
                KAZ: "Kazakhstan",
                KEN: "Kenya",
                KGZ: "Kyrgyzstan",
                KIR: "Kiribati",
                KOR: "South Korea",
                KOS: "Kosovo",
                KSA: "Saudi Arabia",
                KUW: "Kuwait",
                LAO: "Laos",
                LAT: "Latvia",
                LBA: "Libya",
                LBR: "Liberia",
                LCA: "Saint Lucia",
                LES: "Lesotho",
                LIB: "Lebanon",
                LIE: "Liechtenstein",
                LTU: "Lithuania",
                LUX: "Luxembourg",
                MAD: "Madagascar",
                MAR: "Morocco",
                MAS: "Malaysia",
                MAW: "Malawi",
                MDA: "Moldova",
                MDV: "Maldives",
                MEX: "Mexico",
                MGL: "Mongolia",
                MHL: "Marshall Islands",
                MKD: "Macedonia",
                MLI: "Mali",
                MLT: "Malta",
                MNE: "Montenegro",
                MON: "Monaco",
                MOZ: "Mozambique",
                MRI: "Mauritius",
                MTN: "Mauritania",
                MYA: "Myanmar",
                NAM: "Namibia",
                NCA: "Nicaragua",
                NED: "Netherlands",
                NEP: "Nepal",
                NGR: "Nigeria",
                NIG: "Niger",
                NOR: "Norway",
                NRU: "Nauru",
                NZL: "New Zealand",
                OMA: "Oman",
                PAK: "Pakistan",
                PAN: "Panama",
                PAR: "Paraguay",
                PER: "Peru",
                PHI: "Philippines",
                PLE: "Palestine",
                PLW: "Palau",
                PNG: "Papua New Guinea",
                POL: "Poland",
                POR: "Portugal",
                PRK: "North Korea",
                PUR: "Puerto Rico",
                QAT: "Qatar",
                ROU: "Romania",
                RSA: "South Africa",
                RUS: "Russia",
                RWA: "Rwanda",
                SAM: "Samoa",
                SEN: "Senegal",
                SEY: "Seychelles",
                SIN: "Singapore",
                SKN: "Saint Kitts and Nevis",
                SLE: "Sierra Leone",
                SLO: "Slovenia",
                SMR: "San Marino",
                SOL: "Solomon Islands",
                SOM: "Somalia",
                SRB: "Serbia",
                SRI: "Sri Lanka",
                SSD: "South Sudan",
                STP: "Sao Tome and Principe",
                SUD: "Sudan",
                SUI: "Switzerland",
                SUR: "Suriname",
                SVK: "Slovakia",
                SWE: "Sweden",
                SWZ: "Swaziland",
                SYR: "Syria",
                TAN: "Tanzania",
                TGA: "Tonga",
                THA: "Thailand",
                TJK: "Tajikistan",
                TKM: "Turkmenistan",
                TLS: "Timor-Leste",
                TOG: "Togo",
                TPE: "Chinese Taipei",
                TTO: "Trinidad and Tobago",
                TUN: "Tunisia",
                TUR: "Turkey",
                TUV: "Tuvalu",
                UAE: "United Arab Emirates",
                UGA: "Uganda",
                UKR: "Ukraine",
                URU: "Uruguay",
                USA: "United States",
                UZB: "Uzbekistan",
                VAN: "Vanuatu",
                VEN: "Venezuela",
                VIE: "Vietnam",
                YEM: "Yemen",
                ZAM: "Zambia",
                ZAN: "Zanzibar",
                ZIM: "Zimbabwe"
            }
            var out = "<select><option rel='' selected='selected' disabled='disabled'>Country</option>";
            for (var key in countries) {
                out += "<option rel='" + key + "'>" + countries[key] + "</option>";
            }
            out += "</select>";

            document.getElementById(container).innerHTML = out;
        }


        countriesDropdown("countries");
    }
    /*country dropdown*/

    /*textarea box words length*/
    var text_max = 1000;
    $('#totalCharLeft').html(text_max + ' characters remaining');

    $('#describeRequirement').keyup(function () {
        var text_length = $('#describeRequirement').val().length;
        var text_remaining = text_max - text_length;

        $('#totalCharLeft').html(text_remaining + ' characters remaining');
    });
    /*textarea box words length*/

    $('.ads-slider').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        centerMode: true,
        arrows: false,
        dots: true,
        centerPadding: '40px',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    /*product listing + product details logo slider*/
    $('.logo-slider .slider-nav').slick({
        autoplay: true,
        autoplaySpeed: 3000,
        centerMode: false,
        slidesToShow: 5,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    centerPadding: '40px',
                    arrows: false,
                    dots: false,
                    centerMode: false,
                    slidesToShow: 6
                }
            },
            {
                breakpoint: 576,
                settings: {
                    centerPadding: '40px',
                    arrows: false,
                    dots: false,
                    centerMode: false,
                    slidesToShow: 4
                }
            }
        ]
    });
    /*product listing + product details logo slider*/

    /*footer*/
    var currentYear = (new Date).getFullYear();
    $('.footer #current-year').text(currentYear);
    /*footer*/

    if ($(window).width() <= 575) {
        /*dashboard toggle content*/
        $("#dashboardWrapper").addClass('toggled');
        /*dashboard toggle content*/

        /*product listing page*/
        $('.product-banner-container .banner-search .category-search > form .submit-btn').empty();
        $('.product-banner-container .banner-search .category-search > form .submit-btn').append('<span class="fa fa-search" aria-hidden="true"></span>');
        /*product listing page*/
    } else {
        /*dashboard toggle content*/
        $("#dashboardWrapper").removeClass('toggled');
        /*dashboard toggle content*/

        /*product listing page*/
        $('.product-banner-container .banner-search .category-search > form .submit-btn').empty();
        $('.product-banner-container .banner-search .category-search > form .submit-btn').append('SEARCH<span class="fa fa-search" aria-hidden="true"></span>');
        /*product listing page*/
    }

    $(window).resize(function () {
        /*dashboard top bottom button scrolling functionality*/
        $('#dashboardSidebar').each(function(){
            if ($(this)[0].scrollHeight <= $(this).height()) {
                $('.bottom-arrow, .top-arrow').hide();
            }
        });
        /*dashboard top bottom button scrolling functionality*/

        /*article details left side content height equal to articles right side bar*/
        var articleSidebar = $('.articles-sidebar').innerHeight();
        var scrollFloatToInt = Math.ceil(articleSidebar);
        $('.article-details-outer').innerHeight(scrollFloatToInt);
        /*article details left side content height equal to articles right side bar*/

        /*dashboard sidebar height - header height*/
        var header = $('.header').height();
        var headerVal = Math.ceil(header);
        $('#dashboardSidebar').css( { height: `calc(100% - ${headerVal}px)` } );
        /*dashboard sidebar height - header height*/

        /*for companies sidebar*/
        var CompaniesHeadingHeight = $('.top-companies').siblings('.main-heading').height() + 8;
        var companiesCeilHeight = Math.ceil(CompaniesHeadingHeight);
        $('.top-companies').css( { height: `calc(100% - ${companiesCeilHeight}px)` } );
        /*for companies sidebar*/

        if ($(window).width() <= 575) {
            /*dashboard toggle content*/
            $("#dashboardWrapper").addClass('toggled');
            /*dashboard toggle content*/

            /*product listing page*/
            $('.product-banner-container .banner-search .category-search > form .submit-btn').empty();
            $('.product-banner-container .banner-search .category-search > form .submit-btn').append('<span class="fa fa-search" aria-hidden="true"></span>');
            /*product listing page*/
        } else {
            /*dashboard toggle content*/
            $("#dashboardWrapper").removeClass('toggled');
            /*dashboard toggle content*/

            /*product listing page*/
            $('.product-banner-container .banner-search .category-search > form .submit-btn').empty();
            $('.product-banner-container .banner-search .category-search > form .submit-btn').append('SEARCH<span class="fa fa-search" aria-hidden="true"></span>');
            /*product listing page*/
        }
    });

    /*datepicker*/
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        endDate: '-10y'
    });

    $('#datePicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        endDate: '-10y'
    });
    /*datepicker*/
});

$(document).on('change', '.choose-country', function () {
    let countrycode = $(this).find('option:selected').attr('countrycode').toLowerCase();
    telInput.intlTelInput('setCountry', countrycode);
});

$(document).on('click', '.toggle-password-eye', function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

function phone_validate(phno) {
    var regexPattern = new RegExp(/^[0-9-+]+$/);    // regular expression pattern
    return regexPattern.test(phno);
}
