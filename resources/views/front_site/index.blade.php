@extends('front_site.master_layout')
@section('metadata')
    <link rel="stylesheet" type="text/css" href="{{$ASSET}}/front_site/css/animate.min.css">
@endsection
@section('content')
    <body class="homepage">
    <main id="maincontent" class="page-main">

        @include('front_site.common.categories-dropdown-list')

        <div class="px-2 container-fluid">
            <div class="my-2 ads-slider">
                @foreach($bnr_row1 as $row)
                    <div class="px-1">
                        <div class="position-relative ad-slide">
                            <a href="{{ $row->link }}" class="text-decoration-none" target="_blank">
                                <img src="{{ $row->image }}" class="w-100 banner-below-adds border-grey">
                            </a>
                            <span class="fa fa-info position-absolute info-icon"></span>
                            <span class="img-info"></span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container-fluid px-2 overflow-hidden">
            <div class="row biz-deals-container">
                <div class="px-0 pt-1 container-fluid products-slider biz-deals-slider">
                    <div class="mx-3 text-center position-relative">
                        <h3 class="main-heading">MyBiz Leads</h3>
                        <a href="{{ url('regular-suppliers/fibers-and-materials').'?status=all' }}" class="position-absolute red-link view-all">VIEW ALL</a>
                    </div>
                    <div class="px-1 container-fluid">
                        <div class="slider slider-nav w-100 mybizdeals-front">
                            @if(count($topproduct) > 0)
                                @foreach($topproduct as $i => $prod)
                                    <a class="text-reset text-decoration-none" href="{{ route('productDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                            <div class="slider-content">
                                @if($prod->product_image->isNotEmpty())
                                    @foreach($prod->product_image as $j => $image)
                                        @if($loop->first)
                                            <img class="w-100" alt="100x100" src="{{$image->image}}"
                                                 data-holder-rendered="true">
                                        @endif
                                    @endforeach
                                @else
                                    <img class="w-100" alt="100x100"
                                         src="{{$ASSET}}/front_site/images/noimage.png"
                                         data-holder-rendered="true">
                                @endif
                                        <!-- <p>We are looking for a responsible and trustworthy manufacturer of Ladies Jackets.</p> -->
                                <div>
                                    <div>

                                        <span class="overflow-text-dots-one-line">{{$prod->product_service_name}}</span>
                                        <p class="overflow-text-dots-one-line">{{$prod->category->name}}</p>

                                    </div>
                                    <img src="{{$ASSET}}/front_site/images/groupsl-224.png" class="deals-img">
                                </div>
                            </div>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <div class="row ad">
                <a href="{{$bnrbig2nd->link}}" class="w-100 text-decoration-none" target="_blank">
                    <img src="{{ $bnrbig2nd->image }}" alt="" class="w-100">
                </a>
                <span class="fa fa-info position-absolute info-icon"></span>
                <span class="img-info"></span>
            </div>
            <div class="row biz-services-container">
                <div class="px-0 pt-1 container-fluid products-slider biz-services-slider">
                    <div class="mx-3 text-center position-relative">
                        <h3 class="main-heading">MyBiz Services</h3>
                        <a href="{{ url('regular-service/hr-and-admin').'?status=all' }}" class="position-absolute red-link view-all">VIEW ALL</a>
                    </div>
                    <div class="px-1 container-fluid">
                        <div class="slider slider-nav w-100 mybizdeals-front">
                            @if(count($topservice) > 0)
                                @foreach($topservice as $i => $prod)
                                    <a class="text-reset text-decoration-none" href="{{ route('serviceDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                    <div class="slider-content">
                                        @if($prod->product_image->isNotEmpty())
                                            @foreach($prod->product_image as $j => $image)
                                                @if($loop->first)
                                                    <img class="w-100" alt="100x100" src="{{$image->image}}"
                                                         data-holder-rendered="true">
                                                @endif
                                            @endforeach
                                        @else
                                            <img class="w-100" alt="100x100"
                                                 src="{{$ASSET}}/front_site/images/noimage.png"
                                                 data-holder-rendered="true">
                                        @endif
                                    <!-- <p>We are looking for a responsible and trustworthy manufacturer of Ladies Jackets.</p> -->
                                        <div>
                                            <img src="{{$ASSET}}/front_site/images/groupsl-224.png" class="deals-img">
                                            <div>
                                                <span class="overflow-text-dots-one-line">{{$prod->product_service_name}}</span>
                                                <p class="overflow-text-dots-one-line">{{$prod->category->name}}</p>
                                            </div>

                                        </div>
                                    </div>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="ad-slider-content">
                <div class="pb-1 text-right">
                    <a href="{{route('contact-us')}}" class="red-link view-all">ADVERTISE WITH US</a>
                </div>
                <div class="ad-slider-content2 rounded border-grey">
                    <div id="adSlider1" class="carousel slide ad-slider" data-ride="carousel" data-interval="5000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a href="{{ $bnrlupr->link }}" class="text-decoration-none" target="_blank">
                                    <img src="{{ $bnrlupr->image }}" class="w-100 h-100"/>
                                </a>
                                <span class="fa fa-info position-absolute info-icon"></span>
                                <span class="img-info"></span>
                            </div>
                            <div class="carousel-item">
                                <a href="{{ $bnrwr->link }}" class="text-decoration-none" target="_blank">
                                    <img src="{{ $bnrwr->image }}" class="w-100 h-100"/>
                                </a>
                                <span class="fa fa-info position-absolute info-icon"></span>
                                <span class="img-info"></span>
                            </div>
                        </div>
                        <div class="ad-slider-arrows">
                            <a href="#adSlider1" data-slide="prev">
                                <span class="fa fa-angle-left" aria-hidden="true"></span>
                            </a>
                            <a href="#adSlider1" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="my-2 ad-slider-content2 rounded border-grey">
                    <div id="adSlider2" class="carousel slide ad-slider" data-ride="carousel" data-interval="5000">
                        <div class="carousel-inner">
                            @foreach($bnr_slider as $i => $row)
                            <div class="carousel-item @if($i==0) active @endif">
                                <a href="{{ $row->link }}" class="text-decoration-none" target="_blank">
                                    <img src="{{ $row->image }}">
                                </a>
                                <span class="fa fa-info position-absolute info-icon"></span>
                                <span class="img-info"></span>
                            </div>
                            @endforeach
                        </div>
                        <div class="ad-slider-arrows">
                            <a href="#adSlider2" data-slide="prev">
                                <span class="fa fa-angle-left" aria-hidden="true"></span>
                            </a>
                            <a href="#adSlider2" data-slide="next">
                                <span class="fa fa-angle-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row featured-container" style="">
                <div class="px-0 pt-2 container-fluid products-slider featured-slider">
                    <div class="mx-3 text-center position-relative">
                        <h3 class="main-heading">One-Time Deals</h3>
                        <a href="{{ url('one-time-selling-deals/fibers-and-materials').'?status=all' }}" class="position-absolute red-link view-all">VIEW ALL</a>
                    </div>
                    <div class="px-1 container-fluid">
                        <div class="slider slider-nav w-100 products-front">
                            @if(count($topbuysell) > 0)
                                @foreach($topbuysell as $i => $prod)
                                    <a class="text-decoration-none text-reset" href="{{ route('buysellDetail',['category'=>get_category_slug($prod->category_id),'subcategory'=>get_sub_category_slug($prod->subcategory_id),'prod_slug'=>$prod->slug]) }}">
                                    <div class="slider-content">
                                        <?php $img = \DB::table('buysell_images')->where('buy_sell_id', $prod->id)->get();?>
                                            @if($img->isNotEmpty())
                                                 @foreach($img as $i => $image)
                                                    @if($loop->first)
                                                    <img class="w-100" alt="100x100" src="{{$image->image}}" data-holder-rendered="true">
                                                    @endif
                                                @endforeach
                                            @else
                                                <img class="w-100" alt="100x100" src="{{$ASSET}}/front_site/images/noimage.png" data-holder-rendered="true">
                                            @endif
                                <div>
                                    <img src="{{$ASSET}}/front_site/images/groupsl-224.png">
                                    <span class="mt-2 overflow-text-dots-one-line">{{$prod->product_service_name}}</span>
                                    <?php $categ = \App\Category::where('id',$prod->category_id)->first(); ?>
                                    <p class="overflow-text-dots-one-line">{{$categ->name}}</p>
                                </div>
                            </div>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-2 ad-slider-content2 rounded border-grey">
                <div id="adSlider3" class="carousel slide ad-slider" data-ride="carousel" data-interval="5000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="{{ $bnrlwr->link }}" class="text-decoration-none" target="_blank">
                                <img src="{{ $bnrlwr->image }}" class="w-100 h-100"/>
                            </a>
                            <span class="fa fa-info position-absolute info-icon"></span>
                            <span class="img-info"></span>
                        </div>
                        <div class="carousel-item">
                            <a href="{{ $bnrupr->link }}" class="text-decoration-none h-100" target="_blank">
                                <img src="{{ $bnrupr->image }}" class="w-100 h-100"/>
                            </a>
                            <span class="fa fa-info position-absolute info-icon"></span>
                            <span class="img-info"></span>
                        </div>
                    </div>
                    <div class="ad-slider-arrows">
                        <a href="#adSlider3" data-slide="prev">
                            <span class="fa fa-angle-left" aria-hidden="true"></span>
                        </a>
                        <a href="#adSlider3" data-slide="next">
                            <span class="fa fa-angle-right"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-1 textile-news">
                <div class="text-center position-relative">
                    <h3 class="main-heading">Textile News</h3>
                    <a href="{{route('news')}}" class="position-absolute red-link view-all">VIEW ALL</a>
                </div>
                <div class="textile-news-inner">
                        @foreach($news as $article)
                            <div class="px-1 textile-box">
                                <a href="{{route('news-detail',['id'=>$article->id])}}" class="text-decoration-none">
                                    @if(isset($article->image))
                                        <img src="{{$article->image}}">
                                    @else
                                        <img src="{{$ASSET}}/front_site/images/noimage.png">
                                    @endif
                                    <div class="textile-caption">
                                        <span>News | {{date("d-F-Y", strtotime($article->publish_date))}}</span>
                                        <p class="overflow-text-dots">{{$article->title}}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
            </div>

            <h3 class="text-center home-heading">Textile Partners</h3>
            <div class="px-0 container-fluid logo-slider">
                <div class="mb-0 slider slider-nav w-100">
                    @foreach($textile_partners as $text_partners)
                    <a href="{{ $text_partners->link }}" class="logo-container" target="_blank"><img
                            src="{{ $text_partners->image }}"
                            alt="100x100" data-holder-rendered="true"
                            class="w-100 h-100">
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    </body>


@endsection
@push('js')

    <script>
        $(document).ready(function () {
            /*ads info*/
            $('.ads-slider .info-icon').hover(function() {
                var adWidth = $(this).parent().width();
                var adWidthRoundOff = Math.ceil(adWidth);
                var adHeight = $(this).parent().height();
                var adHeightRoundOff = Math.ceil(adHeight);
                $(this).siblings('.img-info').show().append("W : " + adWidthRoundOff + " x " + "L : " + adHeightRoundOff);
            }, function(){
                $('.ads-slider .img-info').hide().empty();
            });
            /*ads info*/

            /*index partners slider*/
            $('.index-partners-slider').slick({
                autoplay: true,
                autoplaySpeed: 3000,
                dots: false,
                infinite: true,
                cssEase: 'linear'
            });
            /*index partners slider*/

            var options_emailconfirmation = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $('#code').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                },
                success: function (data) {
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#code').removeClass('d-none');
                    if (response.feedback == 'false') {

                    } else if (response.feedback == 'invalid') {
                        $('#alert-error').html(response.msg);
                        $('#alert-error').show();
                        // setTimeout(() => {
                        // 	window.location.reload();
                        // }, 1000);
                    } else if (response.feedback == 'true') {
                        // $('#code').attr('disabled');
                        // $('#alert-success').html('Email has been sent successfully.');
                        // $('#alert-success').show();
                        // let email = $('#email').val();
                        // $('#verifyemail').val(email);
                        window.location.href = '{{ route('email-confirmation') }}?from=home&email=' + $('#email').val();
                    }
                },
                error: function (jqXHR, exception) {
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#code').removeClass('d-none');
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
                    $('#alert-error').html(msg);
                    $('#alert-error').show();
                },

            };

            $('#emailConfirmationForm').ajaxForm(options_emailconfirmation);

        });
    </script>
@endpush
