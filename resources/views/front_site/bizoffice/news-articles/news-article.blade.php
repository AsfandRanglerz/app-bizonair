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
                        <span class="heading biz-product-heading mb-1 text-danger d-flex"></span>
                        <span class="heading biz-product-heading">{{ $title }}</span>
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
                                <th class="p2">Title</th>
                                <th class="p2">Description</th>
{{--                                <th class="p2">Image</th>--}}
                                <th class="p2">Publisher Name</th>
                                <th class="p2">Type</th>

                                <th style="width: 85px">Status</th>
                                <th style="width: 85px">Action</th>
                            </tr>
                            </thead>
                            <?php $i=1;?>
                            <tbody>
                            @foreach ($journal as $key => $list)

                                <tr>
                                    <th>{{ $i++ }}</th>
                                    <td>{{$list->title }}</td>
                                    <td>{{substr_replace($list->description, "...", 100) }}
                                    </td>
{{--                                    <td><img src="{{$ASSET.'/front_site/blogs/'.$list->image }}" style="width: 50px;--}}
{{--    height: 50px;"></td>--}}
                                    <td>{{$list->user_name }}</td>
                                    <td>{{$list->journal_type_name }}</td>

                                    <td>@if($list->status==0) <p style="color: red">Waiting For Approval</p>  @else <p style="color: green">Published</p> @endif </td>

                                    <td align="center">
                                        <input type="hidden" name='journal_id' value="{{encrypt($list->id)}}">
                                        <button type="button" class="dropdown-toggle prWhiteBtn p-0"
                                                data-toggle="dropdown">
                                            <img src="{{asset($ASSET.'/front_site/images/3_dots.png') }}" alt="">
                                        </button>

                                        <ul class="dropdown-menu actionMenu p-10" role="menu">
                                            <a href="{{ route('edit-article-news',$list->id) }}" onclick="return false;">
                                                <li class="font-500">
                                                    <span class="fa fa-eye view-btn mr-3" aria-hidden="true"></span>View
                                                </li>
                                            </a>

                                            <a href="javascript:;" class="delete-product" onclick="return false;">
                                                <li class="font-500" id="cross" journal_id="{{$list->id}}">
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
{{--                    <div class="float-right">{{ $journal->links() }}</div>--}}

                    @if($journal->isEmpty())
                        <h3 class="text-center mt-5">No Journal added  yet</h3>
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
            var journal_id=$(this).attr("journal_id");
            btn = $(this);
            journal_id = btn.closest('td').find('input').val();
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
                        $.post("{{ route('news-articles-remove') }}", {
                            _token: '{{ csrf_token() }}',
                            journal_id: journal_id,
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

        {{--$(document).on('click', '.status-btn', function () {--}}
        {{--    btn = $(this);--}}
        {{--    user_id = btn.closest('td').find('input').val();--}}
        {{--    swal({--}}
        {{--        title: "Are you sure?",--}}
        {{--        // text: "Once deleted, you will not be able to recover this imaginary file!",--}}
        {{--        icon: "success",--}}
        {{--        buttons: true,--}}
        {{--        dangerMode: true,--}}
        {{--    })--}}
        {{--        .then((willDelete) => {--}}
        {{--            if (willDelete) {--}}
        {{--                $("#ajax-preloader").show();--}}
        {{--                $.post("{{ route('company-change-user-member-status') }}", {--}}
        {{--                    _token: '{{ csrf_token() }}',--}}
        {{--                    user_id: user_id,--}}
        {{--                    json: 'yes'--}}
        {{--                }, function (data) {--}}
        {{--                    // document.getElementById("wait").style.display = "none";--}}
        {{--                    $("#ajax-preloader").hide();--}}
        {{--                    response = $.parseJSON(data);--}}
        {{--                    if (response.feedback == 'encrypt_issue') {--}}
        {{--                        toastr.error(response.msg, 'Error');--}}
        {{--                        $('#alert-error').html('response.msg')--}}
        {{--                        $('#alert-error').show().fadeOut(2500);--}}
        {{--                    } else if (response.feedback == 'true') {--}}
        {{--                        // toastr.success(response.msg, 'Success');--}}
        {{--                        $('#alert-success').html(response.msg)--}}
        {{--                        $('#alert-success').show().fadeOut(2500);--}}
        {{--                        setTimeout(() => {--}}
        {{--                            window.location.reload();--}}
        {{--                        }, 1000);--}}
        {{--                    } else {--}}
        {{--                        // toastr.error('Something went Wrong', 'Error');--}}
        {{--                        $('#alert-error').html('Something went Wrong')--}}
        {{--                        $('#alert-error').show().fadeOut(2500);--}}
        {{--                    }--}}
        {{--                });--}}
        {{--            }--}}
        {{--        });--}}
        {{--});--}}
    </script>

@endpush
