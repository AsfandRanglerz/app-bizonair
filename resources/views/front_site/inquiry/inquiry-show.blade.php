@extends('front_site.master_layout')

@section('content')

    <body>
    <main id="maincontent" class="page-main">
        <div class="d-flex edit-company-profile" id="dashboardWrapper">
            <!-- Sidebar -->
        @include('front_site.common.dashboard-sidebar')
        <!-- Sidebar -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                @include('front_site.common.dashboard-toggle')
                <div class="mt-2 mr-4 mb-4 ml-4">
                    <div id="companyTab1">
                        <div class="tab-content" id="myCompanyTab">
                            <div class="p-3 tab-pane fade show active" id="tabProfile" role="tabpanel"
                                 aria-labelledby="linkProfile">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="edit-about-us-section">
                                                <h6 class="heading">
                                                    Inquiry Detail
                                                   </h6>

                                                <div class="row text">
                                                    <div class="col-sm-6">
                                                        <span>Protuct Type </span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span>
                                                            @if($inquiry->product_type!=null)
                                                                {{ $inquiry->product_type }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6">
                                                        <span>Protuct Service Type </span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span>
                                                            @if($inquiry->product_service_types!=null)
                                                                {{ $inquiry->product_service_types }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6">
                                                        <span>Protuct Title</span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                            <?php $product = \App\BuySell::where('reference_no','=',$inquiry->reference_no)->first(); ?>
                                                                @if($product)
                                                                <span>
                                                            @if($product->product_service_name!=null)
                                                                {{ $product->product_service_name }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                        @endif
                                                            <?php $product = \App\Product::where('reference_no','=',$inquiry->reference_no)->first(); ?>
                                                                @if($product)
                                                                <span>
                                                                    {{ $product->product_service_name }}
                                                           </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6">
                                                        <span>Reference No </span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span>
                                                            @if($inquiry->reference_no!=null)
                                                                {{$inquiry->reference_no }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6">
                                                        <span>Contact No </span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span>
                                                            @if($inquiry->contact_name!=null)
                                                                {{$inquiry->contact_name }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6">
                                                        <span>City </span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span>
                                                            @if($inquiry->city!=null)
                                                                {{$inquiry->city }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6">
                                                        <span>Country </span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span>
                                                            @if($inquiry->country_name!=null)
                                                                {{$inquiry->country_name }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row text">
                                                    <div class="col-sm-6">
                                                        <span>Status </span>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <span>
                                                          @if($inquiry->status ==0)<p style="color: red"> Waiting For Approval </p> @else <p style="color: green"> Approved @endif</p>
                                                        </span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row text">
                                                <div class="col-sm-6">
                                                    <span>Image </span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <?php $product = \App\BuySell::where('reference_no','=',$inquiry->reference_no)->first(); ?>
                                                    @if($product)
                                                        <span>
                                                           @foreach(\App\Helpers\BuysellHelper::getImages($product->id) as $i => $image)
                                                                @if(!empty($image))
                                                                    <a href="{{ route('buysellDetail',['category'=>get_category_slug($product->category_id),'subcategory'=>get_sub_category_slug($product->subcategory_id),'prod_slug'=>$product->slug]) }}">
                                                                        <img src="{{$ASSETS}}/{{$image->image}}" style="width: 70px;height: 70px;">
                                                                         </a>

                                                                    @if($i==0)
                                                                        @break
                                                                    @endif
                                                                @else
                                                                    <img src="{{$ASSET}}/front_site/images/noimage.png" style="width: 70px;height: 70px;">
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    @endif

                                                    <?php $product = \App\Product::where('reference_no','=',$inquiry->reference_no)->first(); ?>
                                                    @if($product)
                                                        <span>
                                                            @foreach(\App\Helpers\ProductHelper::getImages($product->id) as $i => $image)
                                                                @if(!empty($image))
                                                                    <a href="{{ route('productDetail',['category'=>get_category_slug($product->category_id),'subcategory'=>get_sub_category_slug($product->subcategory_id),'prod_slug'=>$product->slug]) }}">
                                                                            <img src="{{$ASSETS}}/{{$image->image}}" style="width: 70px;height: 70px;">
                                                                         </a>
                                                                    @if($i==0)
                                                                        @break
                                                                    @endif
                                                                @else
                                                                    <img src="{{$ASSET}}/front_site/images/noimage.png" style="width: 70px;height: 70px;">
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="mt-4 mb-4">
                                    <hr class="horizontal-line">
                                </div>
                            </div>
                        </div>
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

    </script>
@endpush
