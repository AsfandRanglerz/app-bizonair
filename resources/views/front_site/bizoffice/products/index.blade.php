@extends('front_site.master_layout')

@section('content')
    <body class="dashboard">
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->

        <!-- Sidebar -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper">

                <div class="px-2 py-2">
                    <div class="">
                        <span
                            class="heading biz-product-heading text-danger d-flex">{{ company_name(session()->get('company_id')) }}</span>
                        <span
                            class="heading biz-product-heading">MyBiz Active Leads {{ ($request->case && $request->case == 'archive') ? ' - Archived' : '' }}</span>
                        @if($request->case && $request->case == 'archive')
                            <div class="my-3">
                                <a href="{{ route('products.index') }}" class="red-btn">Active Products</a>
                            </div>
                        @else
                            <div class="mt-0 mb-2 text-sm-left text-center">
                                <a href="{{ route('products.create') }}" class="red-btn">Add A New Lead</a>
                                <a href="{{ route('products.index') }}?case=archive" class="red-btn">Archived
                                    Leads</a>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive table-mt">
                        <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                             role="alert">
                        </div>
                        <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                             role="alert">
                        </div>
                        <table class="table table-bordered table-striped datatableSearch">
                            <thead>
                            <tr>
                                <th style="width: 5px">#</th>
                                <th class="p2">Lead Type</th>
                                <th class="p2">Reference Number</th>
                                <th class="p2">Product Name</th>
                                <th class="p2">Subject</th>
                                <th class="p2">Image</th>
                                <th class="p2">Price</th>
                                <th class="p2">Matching Leads</th>
                                <th style="width: 85px">Status</th>
                                <th class="p2">Views</th>
                                <th class="p2">Favourites</th>
                                <th class="p2">Created By</th>
                                <th class="p2">Updated By</th>

                            </tr>
                            </thead>
                            <?php $i = 1;?>
                            <tbody>
                            @if(!$products->isEmpty())
                                @foreach($products as $key => $product )
                                    <tr>
                                        <th>{{ $i++ }}</th>
                                        <td>{{ $product->product_service_types }}</td>
                                        <td>{{ $product->reference_no }}</td>
                                        <td><a href="{{ route('productDetail',['category'=>get_category_slug($product->category_id),'subcategory'=>get_sub_category_slug($product->subcategory_id),'prod_slug'=>$product->slug]) }}">{{ $product->product_service_name }}</a></td>
                                        <td>{{ $product->subject }}</td>
                                        <td>  @if(sizeof($product->product_image) > 0)
                                                <img src="{{$ASSETS}}/{{$product->product_image[0]['image']}}"
                                                     style="width: 40px;height: 40px;">
                                            @else
                                                <img src="{{$ASSET}}/front_site/images/noimage.png"
                                                     style="width: 40px;height: 40px;">
                                            @endif</td>
                                        <td>@if($product->suitable_currencies)
                                                {{ str_replace(',', ', ', $product->suitable_currencies) }}
                                            @endif
                                            @if($product->target_price_from && $product->unit_price_from=="")
                                                <p> {{$product->target_price_from}} - {{ $product->target_price_to }} Per {{ ($product->target_price_unit != 'Other') ? $product->target_price_unit : $product->other_target_price_unit }}
                                            @elseif($product->unit_price_from && $product->target_price_from== "")
                                                <p>{{$product->unit_price_from}} - {{ $product->unit_price_to }} Per {{ ($product->unit_price_unit != 'Other') ? $product->unit_price_unit : $product->other_unit_price_unit }}
                                            @else
                                                <p> Nill </p>
                                            @endif</td>
                                        <td>
                                            @if($product->product_service_types =='Sell')
                                                <a href="{{route('buyers-products',['category'=>get_category_slug($product->category_id),'subcategory'=>get_sub_category_slug($product->subcategory_id),'childsubcategory'=>get_child_sub_category_slug($product->childsubcategory_id)])}}">{{getSubSubcategoryBuyProductCount($product->subcategory_id,$product->childsubcategory_id)}}  Matching Buyers</a>
                                            @elseif($product->product_service_types =='Buy')
                                                <a href="{{route('suppliers-products',['category'=>get_category_slug($product->category_id),'subcategory'=>get_sub_category_slug($product->subcategory_id),'childsubcategory'=>get_child_sub_category_slug($product->childsubcategory_id)])}}">{{getSubSubcategorySellProductCount($product->subcategory_id,$product->childsubcategory_id)}}  Matching Sellers</a>
                                            @elseif($product->product_service_types =='Service')
                                                <a href="{{route('subcategory-one-time-services',['category'=>get_category_slug($product->category_id),'subcategory'=>get_sub_category_slug($product->subcategory_id)])}}">{{getSubcategoryServiceBuysellCount($product->subcategory_id)}}  Matching Service Seeker</a>
                                            @endif

                                        </td>
                                        <td align="center">
                                            <input type="hidden" name='id' value="{{encrypt($product->id)}}">
                                            <button  class="dropdown-toggle prWhiteBtn p-0"
                                                    data-toggle="dropdown">
                                                <img src="{{asset($ASSET.'/front_site/images/3_dots.png') }}" alt="">
                                            </button>
                                            <input type="hidden" name='url'
                                                   value="{{ route('products.destroy', $product) }}">
                                            <ul class="dropdown-menu actionMenu p-10" role="menu">
                                                <a href="{{ route('products.edit', $product) }}">
                                                    <li class="font-500">
                                                        <span class="fa fa-eye view-btn mr-3" aria-hidden="true"></span>View
                                                    </li>
                                                </a>
                                                @if($request->case && $request->case == 'archive')
                                                    <a href="javascript:;" class="restore-product" onclick="return false;">
                                                        <li class="font-500">
                                                        <span class="fa fa-undo delete-btn mr-3"
                                                              aria-hidden="true"></span>Restore
                                                        </li>
                                                    </a>
                                                    <a href="javascript:;" class="delete-product" onclick="return false;">
                                                        <li class="font-500">
                                                        <span class="fa fa-trash delete-btn mr-3"
                                                              aria-hidden="true"></span>Permanent Delete
                                                        </li>
                                                    </a>
                                                @else
                                                    <a href="javascript:;" class="delete-product" onclick="return false;">
                                                        <li class="font-500">
                                                        <span class="fa fa-trash delete-btn mr-3"
                                                              aria-hidden="true"></span>Archive
                                                        </li>
                                                    </a>
                                                @endif
                                            </ul>
                                        </td>
                                        <?php
                                        $products = \App\View::where('prod_id',$product->id)->count();
                                        ?>
                                        <td>{{ $products }}</td>
                                        <td>{{ getSingleProductFavCount($product->reference_no) }}</td>
                                        <td>{{ getUserNameById($product->createdBy) }} </br> {!! $product->created_at !!}</td>
                                        <td>{{ getUserNameById($product->updatedBy) }} </br> {!! $product->updated_at !!}</td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>{{ ($request->case && $request->case == 'archive') ? 'No product in archive' : 'No product added yet' }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </main>
    </body>

@endsection

@push('js')

    <script type="text/javascript">
        var alert_close_btn = '<button  class="close"><span aria-hidden="true">&times;</span> </button>';
        $(document).on('click', '.delete-product', function () {
            btn = $(this);
            product_id = btn.closest('td').find('input').val();
            swal({
                title: "Are you sure?",
                text: "You will not be able to revert this.",
                icon: "warning",
                buttons: [true, '{{ ($request->case && $request->case == 'archive') ? 'Yes! permanent delete it.' : 'Yes! archive it.' }}'],
                dangerMode: true,
                closeOnClickOutside: false,
                closeOnEsc: false,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#ajax-preloader").show();
                        $.post("{{ route('archiveProduct') }}", {
                            _token: '{{ csrf_token() }}',
                            product_id: product_id,
                            json: 'yes'
                        }, function (data) {
                            // document.getElementById("wait").style.display = "none";
                            $("#ajax-preloader").hide();
                            var response = $.parseJSON(data);
                            if (response.feedback == 'encrypt_issue') {
                                toastr.error(response.msg);
                            } else if (response.feedback == 'true') {
                                toastr.success(response.msg);
                                // btn.fadeOut(200, function () {
                                //     $(this).closest('tr').remove();
                                // });
                                setTimeout(() => {
                                    window.location.href = '';
                                }, 2000);
                            } else {
                                // toastr.error('Something went Wrong', 'Error');
                                // $('#alert-error').html('Something went Wrong' + alert_close_btn)
                                // $('#alert-error').show();
                                toastr.error('Something went Wrong');
                            }
                        });
                    }
                });
        });
        @if($request->case && $request->case == 'archive')
        $(document).on('click', '.restore-product', function () {
            btn = $(this);
            product_id = btn.closest('td').find('input').val();
            swal({
                title: "Are you sure?",
                text: "Product will be visible on the website.",
                icon: "warning",
                buttons: [true, 'Yes! restore it.'],
                dangerMode: true,
                closeOnClickOutside: false,
                closeOnEsc: false,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#ajax-preloader").show();
                        $.post("{{ route('restoreProduct') }}", {
                            _token: '{{ csrf_token() }}',
                            product_id: product_id,
                            json: 'yes'
                        }, function (data) {
                            // document.getElementById("wait").style.display = "none";
                            $("#ajax-preloader").hide();
                            var response = $.parseJSON(data);
                            if (response.feedback == 'encrypt_issue') {
                                toastr.error(response.msg);
                                // toastr.error(response.msg, 'Error');
                                // $('#alert-error').html('response.msg' + alert_close_btn);
                                // $('#alert-error').show();
                            } else if (response.feedback == 'true') {
                                // toastr.success(response.msg, 'Success');
                                // $('#alert-success').html(response.msg + alert_close_btn)
                                // $('#alert-success').show();
                                // btn.fadeOut(200, function () {
                                //     $(this).closest('tr').remove();
                                // });
                                toastr.success(response.msg);
                                setTimeout(() => {
                                    window.location.href = '';
                                }, 2000);
                            } else {
                                // toastr.error('Something went Wrong', 'Error');
                                // $('#alert-error').html('Something went Wrong' + alert_close_btn)
                                // $('#alert-error').show();
                                toastr.error('Something went Wrong');
                            }
                        });
                    }
                });
        });
        @endif
    </script>

@endpush
