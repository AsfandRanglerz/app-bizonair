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
                                <th class="p2">Job Title</th>
                                <th class="p2">Salary</th>
                                <th class="p2">Designation</th>
                                <th class="p2">Company Name</th>
                                <th class="p2">Posted By</th>
                                <th class="p2">Posted Date</th>
                                <th style="width: 85px">Action</th>
                            </tr>
                            </thead>
                            <?php $i=1;?>
                            <tbody>
                            @foreach ($job as $key => $list)
                                <tr>
                                    <th>{{ $i++ }}</th>
                                    <td><a href="{{ route('jobs-detail',$list->id) }}">{{$list->title }}</a></td>
                                    <td>{{$list->salary }}</td>
                                    <td>{{$list->designation }}</td>
                                    <td>@if($list->company == 'Other') {{$list->other_company}} @else {{$list->company}} @endif</td>
                                    <td>{{getUserNameById($list->user_id) }}</td>
                                    <td>{{date("d-F-Y", strtotime($list->created_at))}}</td>

                                    <td align="center">
                                        <input type="hidden" name='job_id' value="{{encrypt($list->id)}}">
                                        <button  class="dropdown-toggle prWhiteBtn p-0"
                                                 data-toggle="dropdown">
                                            <img src="{{asset($ASSET.'/front_site/images/3_dots.png') }}" alt="">
                                        </button>

                                        <ul class="dropdown-menu actionMenu p-10" role="menu">
                                            <a href="{{ route('edit-job-management',$list->id) }}">
                                                <li class="font-500">
                                                    <span class="fa fa-eye view-btn mr-3" aria-hidden="true"></span>View
                                                </li>
                                            </a>
                                            <a href="{{ route('edit-job-management',$list->id.'#jobTab2') }}">
                                                <li class="font-500">
                                                    <span class="fa fa-eye view-btn mr-3" aria-hidden="true"></span>Edit
                                                </li>
                                            </a>

                                            <a href="javascript:;" class="delete-product">
                                                <li class="font-500" id="cross" job_id="{{$list->id}}">
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
{{--                    <div class="float-right">{{ $job->links() }}</div>--}}

                    @if($job->isEmpty())
                        <h3 class="text-center mt-5">No Jobs  yet</h3>
                    @endif
                </div>
                <!-- /#page-content-wrapper -->
            </div>
        </div>
    </main>
    </body>

@endsection


@push('js')
    <script src="{{$ASSET}}/front_site/plugins/DataTables/datatables.js"></script>
    <script>
        $(document).delegate('#cross', 'click', function(e) {
            e.preventDefault();
            var job_id=$(this).attr("job_id");
            btn = $(this);
            job_id = btn.closest('td').find('input').val();
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
                        $.post("{{ route('company-remove-job-from-group') }}", {
                            _token: '{{ csrf_token() }}',
                            job_id: job_id,
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
                                // $('#alert-success').html(response.msg)
                                // $('#alert-success').show().fadeOut(2500);
                                toastr.success(response.msg);
                                window.location.reload();
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
