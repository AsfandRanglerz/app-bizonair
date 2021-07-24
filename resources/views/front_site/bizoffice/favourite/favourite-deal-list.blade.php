@extends('front_site.master_layout')

@section('content')

    <body class="dashboard">
    <main id="maincontent" class="page-main">
        <div class="d-flex" id="dashboardWrapper">
            <!-- Sidebar -->

        <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            @include('front_site.common.dashboard-toggle')
            <div id="page-content-wrapper">
                <div class="d-container">
                    <div class="">
                        <span
                            class="heading biz-product-heading mb-1 text-danger d-flex"></span>
                        <span
                            class="heading biz-product-heading">{{ $title }}</span>

                    </div>
                    <div class="table-responsive table-mt mt-2">
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
                                <th class="p2">Product Service Name</th>
                                <th class="p2">Image</th>
                                <th class="p2">Reference No</th>
                                <th class="p2">Product Service Type</th>
                                <th style="width: 85px">Action</th>
                            </tr>
                            </thead>
                            <?php $i=1;?>
                            <tbody>
                            @foreach ($favourite as $key => $fav)

                                <tr>
                                    <th>{{ $key+1 }}</th>
                                    <td>{{$fav->product_service_name }}</td>
                                    <?php $product = \App\Product::where('reference_no','=',$fav->reference_no)->first(); ?>
                                    @if($product)
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
                                    @else
                                        <td>
                                        <?php $buysell = \App\BuySell::where('reference_no','=',$fav->reference_no)->first();
                                            $img = \DB::table('buysell_images')->where('buy_sell_id',$buysell->id)->get();?>
                                        @foreach($img as $i => $image)
                                            @if($loop->first)
                                                    <span>
                                                     <a href="{{ route('buysellDetail',['category'=>get_category_slug($buysell->category_id),'subcategory'=>get_sub_category_slug($buysell->subcategory_id),'prod_slug'=>$buysell->slug]) }}">
                                                    <img src="{{$ASSETS}}/{{$image->image}}" style="width: 70px;height: 70px;">
                                                     </a>
                                                </span>

                                            @endif
                                        @endforeach

                                        </td>
                                        @endif

                                    <td>{{$fav->reference_no }}</td>
                                    <td>{{$fav->product_service_types }}</td>

                                    <td align="center">
                                        <input type="hidden" name='favourite_id' value="{{encrypt($fav->id)}}">
                                        <button  class="dropdown-toggle prWhiteBtn p-0"
                                                data-toggle="dropdown" disabled>
                                            <img src="{{asset($ASSET.'/front_site/images/3_dots.png') }}" alt="">
                                        </button>

                                        <ul class="dropdown-menu actionMenu p-10" role="menu">

                                            <a href="javascript:;" class="delete-product" onclick="return false;">
                                                <li class="font-500" id="cross" favourite_id="{{$fav->id}}">
                                                        <span class="fa fa-trash delete-btn mr-3"
                                                              aria-hidden="true"></span>Delete
                                                </li>
                                            </a>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
{{--                    <div class="float-right">{{ $favourite->links() }}</div>--}}

                    @if($favourite->isEmpty())
                        <h3 class="text-center mt-0">No Favourite Product  yet</h3>
                    @endif
                </div>
                <!-- /#page-content-wrapper -->
            </div>
    </main>
    </body>

@endsection


@push('js')

    <script>
        $(document).delegate('#cross', 'click', function(e) {
            e.preventDefault();
            var favourite_id=$(this).attr("favourite_id");
            btn = $(this);
            favourite_id = btn.closest('td').find('input').val();
            swal({
                title: "Are you sure?",
                // text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#ajax-preloader").show();
                        $.post("{{ route('remove-favourite-product') }}", {
                            _token: '{{ csrf_token() }}',
                            favourite_id: favourite_id,
                            json: 'yes'
                        }, function (data) {
                            // document.getElementById("wait").style.display = "none";
                            $("#ajax-preloader").hide();
                            response = $.parseJSON(data);
                            if (response.feedback == 'encrypt_issue') {
                                toastr.error(response.msg, 'Error');
                                $('#alert-error').html('response.msg')
                                $('#alert-error').show().fadeOut(2500);
                            } else if (response.feedback == 'true') {
                                // toastr.success(response.msg, 'Success');
                                $('#alert-success').html(response.msg)
                                $('#alert-success').show().fadeOut(2500);
                                btn.fadeOut(200, function () {
                                    $(this).closest('tr').remove();
                                });
                            } else {
                                // toastr.error('Something went Wrong', 'Error');
                                $('#alert-error').html('Something went Wrong')
                                $('#alert-error').show().fadeOut(2500);
                            }
                        });
                    }
                });
        });
    </script>

@endpush
