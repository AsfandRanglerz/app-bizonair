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
                            class="heading biz-product-heading text-danger d-flex">{{ \Auth::user()->name }}</span>
                        <span
                            class="heading biz-product-heading">One-Time Deals {{ ($request->case && $request->case == 'archive') ? ' - Archived' : '' }}</span>
                        @if($request->case && $request->case == 'archive')
                            <div>
                                <a href="{{ route('buy-sell.index') }}" class="blue-btn">Active Deals</a>
                            </div>
                        @else
                            <div class="mt-0 mb-2 text-sm-left text-center">
                                <a href="{{ route('buy-sell.create') }}" class="red-btn">Add A New Deal</a>
                                <a href="{{ route('buy-sell.index') }}?case=archive" class="blue-btn">Archived Deals</a>
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
                                <th class="p2">Deal Type</th>
                                <th class="p2">Reference Number</th>
                                <th class="p2">Product Name</th>
                                <th class="p2">Subject</th>
                                <th class="p2">Category</th>
                                <th class="p2">Image</th>
                                <th class="p2">Price</th>
                                <th class="p2">Matching Deals</th>
                                <th style="width: 85px">Status</th>
                                <th class="p2">Views</th>
                                <th class="p2">Favourites</th>
                                <th class="p2">Origin</th>
                                @if(!($request->case && $request->case == 'archive'))
                                    <th class="p2">Ad Expiry</th>
                                @endif
                                <th class="p2">Created At</th>
                                <th class="p2">Updated By</th>

                            </tr>
                            </thead>

                            <tbody>
                            @if(!$buysells->isEmpty())
                                @foreach($buysells as $key => $buysell )
                                    <tr>
                                        <th>{{ $key+1 }}</th>
                                        <td>{{ $buysell->product_service_types }}</td>
                                        <td>{{ $buysell->reference_no }}</td>
                                        @if(!($request->case && $request->case == 'archive'))
                                            @if($buysell->product_service_types == 'Service')
                                                <td>  <a href="{{ route('serviceDetail',['category'=>get_category_slug($buysell->category_id),'subcategory'=>get_sub_category_slug($buysell->subcategory_id),'prod_slug'=>$buysell->slug]) }}">
                                                        {{ $buysell->product_service_name }}</a></td>
                                            @else
                                                <td>  <a href="{{ route('buysellDetail',['category'=>get_category_slug($buysell->category_id),'subcategory'=>get_sub_category_slug($buysell->subcategory_id),'prod_slug'=>$buysell->slug]) }}">
                                                        {{ $buysell->product_service_name }}</a></td>
                                            @endif
                                        @else
                                            @if($buysell->product_service_types == 'Service')
                                                <td>  <a href="#">
                                                        {{ $buysell->product_service_name }}</a></td>
                                            @else
                                                <td>  <a href="#">
                                                        {{ $buysell->product_service_name }}</a></td>
                                            @endif

                                        @endif
                                        <td>{{ $buysell->subject }}</td>
                                        <td>{{ $buysell->category->name }}</td>
                                        <td class="img-td-outer">
                                            <a href="{{ route('buy-sell.edit', $buysell->id) }}">
                                                @foreach(App\Helpers\BuysellHelper::getImages($buysell->id) as $i => $image)
                                                    @if(!empty($image))
                                                        <span>
                                                    <img src="{{$image->image}}" class="img-td">
                                                </span>
                                                        @if($i==0)
                                                            @break
                                                        @endif
                                                    @else
                                                        <img src="{{$ASSET}}/front_site/images/noimage.png" class="img-td">
                                                    @endif
                                                @endforeach
                                            </a>
                                        </td>
                                        <td>@if($buysell->suitable_currencies)
                                                {{ str_replace(',', ', ', $buysell->suitable_currencies) }}
                                            @endif
                                            @if($buysell->target_price_from && $buysell->unit_price_from=="")
                                                <p> {{$buysell->target_price_from}} per {{ $buysell->target_price_unit }}
                                            @elseif($buysell->unit_price_from && $buysell->target_price_from== "")
                                                <p>{{$buysell->unit_price_from}} per {{ $buysell->unit_price_unit }}
                                            @else
                                                <p> Nill </p>
                                            @endif</td>
                                        <td>
                                            @if($buysell->product_service_types =='Sell')

                                                <a href="{{route('one-time-buyer-deals',['category'=>get_category_slug($buysell->category_id),'subcategory'=>get_sub_category_slug($buysell->subcategory_id),'childsubcategory'=>get_child_sub_category_slug($buysell->childsubcategory_id)])}}">{{getSubcategoryBuyBuysellCount($buysell->subcategory_id,$buysell->childsubcategory_id)}}  Matching Buyers</a>
                                            @elseif($buysell->product_service_types =='Buy')
                                                <a href="{{route('one-time-seller-deals',['category'=>get_category_slug($buysell->category_id),'subcategory'=>get_sub_category_slug($buysell->subcategory_id),'childsubcategory'=>get_child_sub_category_slug($buysell->childsubcategory_id)])}}">{{getSubcategorySellBuysellCount($buysell->subcategory_id,$buysell->childsubcategory_id)}}  Matching Sellers</a>
                                            @elseif($buysell->product_service_types =='Service')
                                                <a href="{{route('subcategory-regular-services',['category'=>get_category_slug($buysell->category_id),'subcategory'=>get_sub_category_slug($buysell->subcategory_id)])}}">{{getSubcategoryServiceProductCount($buysell->subcategory_id)}}  Matching Service Provider</a>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <input type="hidden" name='id' value="{{encrypt($buysell->id)}}">
                                            <button  class="dropdown-toggle prWhiteBtn p-0"
                                                     data-toggle="dropdown">
                                                <img src="{{asset($ASSET.'/front_site/images/3_dots.png') }}" alt="">
                                            </button>
                                            <input type="hidden" name='url' value="{{ route('buy-sell.destroy', $buysell->id) }}">
                                            <ul class="dropdown-menu actionMenu p-10" role="menu">
                                               
                                                @if($request->case && $request->case == 'archive')
                                                    <a href="javascript:;" class="restore-buysell">
                                                        <li class="font-500">
                                                        <span class="fa fa-undo delete-btn mr-2"
                                                              aria-hidden="true"></span>Restore
                                                        </li>
                                                    </a>
                                                    <a href="javascript:;" class="delete-buysell">
                                                        <li class="font-500">
                                                        <span class="fa fa-trash delete-btn mr-2"
                                                              aria-hidden="true"></span>Permanent Delete
                                                        </li>
                                                    </a>
                                                @else
                                                <a href="{{ route('buy-sell.edit', $buysell->id) }}">
                                                    <li class="font-500">
                                                        <span class="fa fa-eye view-btn mr-2" aria-hidden="true"></span>View
                                                    </li>
                                                </a>
                                                <a href="{{ route('buy-sell.edit', $buysell->id.'#companyTab2') }}">
                                                        <li class="font-500">
                                                            <span class="fa fa-edit view-btn mr-2" aria-hidden="true"></span>Edit
                                                        </li>
                                                    </a>
                                                    <a href="javascript:;" class="delete-buysell">
                                                        <li class="font-500">
                                                        <span class="fa fa-trash delete-btn mr-2"
                                                              aria-hidden="true"></span>Archive
                                                        </li>
                                                    </a>
                                                @endif
                                            </ul>
                                        </td>
                                        <?php $prod = \App\View::where('buysell_id',$buysell->id)->count(); ?>
                                        <td>{{ $prod }}</td>
                                        <td>{{ getSingleBuysellFavCount($buysell->reference_no) }}</td>

                                        <td>{{$buysell->origin}}</td>
                                        @if(!($request->case && $request->case == 'archive'))
                                            <td>@if(checkExpiryBuysell($buysell->id) == 'Expired')<span style="color: red">{{checkExpiryBuysell($buysell->id)}}</span> <button class="red-btn" id="expirebtn" prod_id="{{$buysell->id}}">Repost</button> @else {{checkExpiryBuysell($buysell->id)}} @endif</td>
                                        @endif
                                        <td> {!! $buysell->created_at !!}</td>
                                        <td>{{ getUserNameById($buysell->updatedBy) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>{{ ($request->case && $request->case == 'archive') ? 'No buy sell in archive' : 'No buy sell added yet' }}</td>
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
    <script src="{{$ASSET}}/front_site/plugins/DataTables/datatables.js"></script>
    <script type="text/javascript">
        var alert_close_btn = '<button  class="close"><span aria-hidden="true">&times;</span> </button>';
        $(document).on('click', '.delete-buysell', function () {
            btn = $(this);
            buysell_id = btn.closest('td').find('input').val();
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
                        $.post("{{ route('archiveBuysell') }}", {
                            _token: '{{ csrf_token() }}',
                            buysell_id: buysell_id,
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
        $(document).on('click', '.restore-buysell', function () {
            btn = $(this);
            buysell_id = btn.closest('td').find('input').val();
            swal({
                title: "Are you sure?",
                text: "Buy Sell will be visible on the website.",
                icon: "warning",
                buttons: [true, 'Yes! restore it.'],
                dangerMode: true,
                closeOnClickOutside: false,
                closeOnEsc: false,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#ajax-preloader").show();
                        $.post("{{ route('restoreBuysell') }}", {
                            _token: '{{ csrf_token() }}',
                            buysell_id: buysell_id,
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
        $(document).on('click', '#expirebtn', function (e) {
            e.preventDefault();
            var prod_id = $(this).attr("prod_id");
            var token='{{csrf_token()}}';

            $.ajax({
                type:'POST',
                url: '{{ url('/repost-buysell') }}',
                data:{prod_id:prod_id,_token:token},
                cache: false,
                success: function(data) {

                    response = $.parseJSON(data);
                    if (response.feedback === "false") {
                        toastr.error(response.msg).fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        $("#loader").hide();
                        toastr.success(response.msg).fadeOut(2500);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        });
    </script>

@endpush
