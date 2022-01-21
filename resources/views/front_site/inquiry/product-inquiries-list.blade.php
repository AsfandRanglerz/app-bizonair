@extends('front_site.master_layout')

@section('content')

    <body class="dashboard">
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->
        @include('front_site.common.dashboard-sidebar')

        <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                @include('front_site.common.dashboard-toggle')
                <div class="  d-container mt-2">
                    <div class="">
                        <span class="heading biz-product-heading mb-1 text-danger d-flex">{{ $title }}</span>
                        <span class="heading biz-product-heading"> {{ ($request->case && $request->case == 'archive') ? ' - Archived' : '' }}</span>
                        @if($request->case && $request->case == 'archive')
                            <div class="my-3">
                                <a href="{{ route('product-inquiries') }}" class="blue-btn">Active Products Inquiries</a>
                            </div>
                        @else
                            <div class="my-3">
                                <a href="{{ route('product-inquiries') }}?case=archive" class="blue-btn">Archived
                                    Products Inquiries</a>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive table-mt mt-3">
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
                                <th class="p2">Product Type</th>
                                <th class="p2">Product Service Type</th>
                                <th class="p2">Title</th>
                                <th class="p2">Image</th>
                                <th class="p2">Reference No</th>
                                <th class="p2">Contact_name</th>
                                <th class="p2">City</th>
                                <th class="p2">Country</th>
                                <th class="p2">Status</th>
                                <th style="width: 85px">Action</th>
                            </tr>
                            </thead>
                            <?php $i=1;?>
                            <tbody>
                            @if(!$inquiries->isEmpty())
                            @foreach ($inquiries as $key => $inquiry)

                                <tr>
                                    <th>{{ $key+1 }}</th>
                                    <td>{{$inquiry->product_type }}</td>
                                    <td>{{$inquiry->product_service_types }}</td>
                                        <?php $product = \App\BuySell::where('reference_no','=',$inquiry->reference_no)->first(); ?>
                                       @if($product)
                                        <td>
                                            <a class="text-reset text-decoration-none" href="{{ route('buysellDetail',['category'=>get_category_slug($product->category_id),'subcategory'=>get_sub_category_slug($product->subcategory_id),'prod_slug'=>$product->slug]) }}">
                                                {{$product->product_service_name}}
                                            </a>
                                        </td>
                                    @endif

                                        <?php $product = \App\Product::where('reference_no','=',$inquiry->reference_no)->first(); ?>
                                    @if($product)
                                         <td>
                                            <a class="text-reset text-decoration-none" href="{{ route('productDetail',['category'=>get_category_slug($product->category_id),'subcategory'=>get_sub_category_slug($product->subcategory_id),'prod_slug'=>$product->slug]) }}">
                                                {{$product->product_service_name}}
                                            </a>
                                        </td>
                                    @endif
                                    @if(!$inquiry->product_id)
                                        <?php $product = \App\BuySell::where('reference_no','=',$inquiry->reference_no)->first(); ?>
                                        <td>
                                            @foreach(\App\Helpers\BuysellHelper::getImages($product->id) as $i => $image)
                                                @if(!empty($image))
                                                    <span>
                                                     <a href="{{ route('buysellDetail',['category'=>get_category_slug($product->category_id),'subcategory'=>get_sub_category_slug($product->subcategory_id),'prod_slug'=>$product->slug]) }}">
                                                    <img src="{{$ASSETS}}/{{$image->image}}" style="width: 70px;height: 70px;">
                                                     </a>
                                                </span>
                                                    @if($i==0)
                                                        @break
                                                    @endif
                                                @else
                                                    <img src="{{$ASSET}}/front_site/images/noimage.png" style="width: 70px;height: 70px;">
                                                @endif
                                            @endforeach
                                        </td>
                                    @endif
                                    @if($inquiry->product_id)
                                        <?php $product = \App\Product::where('reference_no','=',$inquiry->reference_no)->first(); ?>
                                        <td>
                                            @foreach(\App\Helpers\ProductHelper::getImages($product->id) as $i => $image)
                                                @if(!empty($image))
                                                    <span>
                                                        <a href="{{ route('productDetail',['category'=>get_category_slug($product->category_id),'subcategory'=>get_sub_category_slug($product->subcategory_id),'prod_slug'=>$product->slug]) }}">
                                                    <img src="{{$ASSETS}}/{{$image->image}}" style="width: 70px;height: 70px;">
                                                     </a>
                                                </span>
                                                    @if($i==0)
                                                        @break
                                                    @endif
                                                @else
                                                    <img src="{{$ASSET}}/front_site/images/noimage.png" style="width: 70px;height: 70px;">
                                                @endif
                                            @endforeach
                                        </td>
                                    @endif
                                    <td>{{$inquiry->reference_no }}</td>
                                    <td>{{$inquiry->contact_name }}</td>
                                    <td>{{$inquiry->city }}</td>
                                    <td>{{$inquiry->country_name }}</td>
                                    <td>@if($inquiry->status ==0)<p style="color: red"> Waiting For Approval </p> @else <p style="color: green"> Approved @endif</p></td>

                                    <td align="center">
                                        <input type="hidden" name='inquiry_id' value="{{encrypt($inquiry->id)}}">
                                        <button  class="dropdown-toggle prWhiteBtn p-0"
                                                data-toggle="dropdown">
                                            <img src="{{asset($ASSET.'/front_site/images/3_dots.png') }}" alt="">
                                        </button>
                                        <input type="hidden" name='url' value="{{ route('inquiry.destroy', $inquiry->id) }}">
                                        <ul class="dropdown-menu actionMenu p-10" role="menu">
                                            <a href="{{ route('inquiry-product.edit', $inquiry->id) }}">
                                                <li class="font-500">
                                                    <span class="fa fa-eye view-btn mr-3" aria-hidden="true"></span>View
                                                </li>
                                            </a>
                                            @if($request->case && $request->case == 'archive')
                                                <a href="javascript:;" class="restore-prod-inquiry">
                                                    <li class="font-500">
                                                        <span class="fa fa-undo delete-btn mr-3"
                                                              aria-hidden="true"></span>Restore
                                                    </li>
                                                </a>
                                                <a href="javascript:;" class="delete-prod-inquiry">
                                                    <li class="font-500">
                                                        <span class="fa fa-trash delete-btn mr-3"
                                                              aria-hidden="true"></span>Permanent Delete
                                                    </li>
                                                </a>
                                            @else
                                                <a href="javascript:;" class="delete-prod-inquiry">
                                                    <li class="font-500">
                                                        <span class="fa fa-trash delete-btn mr-3"
                                                              aria-hidden="true"></span>Archive
                                                    </li>
                                                </a>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td>{{ ($request->case && $request->case == 'archive') ? 'No Product Inquiry in archive' : 'No Product Inquiry added yet' }}</td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>

{{--                    @if($inquiry->isEmpty())--}}
{{--                        <h3 class="text-center mt-5">No Product Inquiry yet</h3>--}}
{{--                    @endif--}}
                </div>
                <!-- /#page-content-wrapper -->
            </div>
    </main>
    </body>

@endsection


@push('js')
    <script src="{{$ASSET}}/front_site/plugins/DataTables/datatables.js"></script>
    <script>
        $(document).on('click', '.delete-prod-inquiry', function () {
            btn = $(this);
            prod_inquiry_id = btn.closest('td').find('input').val();
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
                        $.post("{{ route('archiveProductInquiries') }}", {
                            _token: '{{ csrf_token() }}',
                            prod_inquiry_id: prod_inquiry_id,
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
        $(document).on('click', '.restore-prod-inquiry', function () {
            btn = $(this);
            prod_inquiry_id = btn.closest('td').find('input').val();
            swal({
                title: "Are you sure?",
                text: "Product Inquiries will be visible on the website.",
                icon: "warning",
                buttons: [true, 'Yes! restore it.'],
                dangerMode: true,
                closeOnClickOutside: false,
                closeOnEsc: false,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#ajax-preloader").show();
                        $.post("{{ route('restoreProductInquiries') }}", {
                            _token: '{{ csrf_token() }}',
                            prod_inquiry_id: prod_inquiry_id,
                            json: 'yes'
                        }, function (data) {
                            $("#ajax-preloader").hide();
                            var response = $.parseJSON(data);
                            if (response.feedback == 'encrypt_issue') {
                                toastr.error(response.msg);
                            } else if (response.feedback == 'true') {
                                toastr.success(response.msg);
                                setTimeout(() => {
                                    window.location.href = '';
                                }, 2000);
                            } else {
                                toastr.error('Something went Wrong');
                            }
                        });
                    }
                });
        });
        @endif
    </script>

@endpush
