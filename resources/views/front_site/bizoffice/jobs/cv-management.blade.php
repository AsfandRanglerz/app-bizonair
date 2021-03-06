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
                                <th class="p2">Name</th>
                                <th class="p2">Functional Area</th>
                                <th class="p2">Textile Sector</th>
                                <th style="width: 85px">Action</th>
                                <th class="p2">Expected Salary</th>
                                <th class="p2">Experience (Years)</th>
                                <th class="p2">Address</th>
                            </tr>
                            </thead>
                            <?php $i=1;?>
                            <tbody>
                            @foreach ($cv as $key => $list)
                                <tr>
                                    <th>{{ $i++ }}</th>
                                    <td><a href="{{route('cvc-detail',$list->id) }}">{{$list->fname }} {{$list->lname }}</a></td>
                                    <td>{{$list->functional_area }}</td>
                                    <td>{{$list->textile_sector }}</td>
                                    <td align="center">
                                        <input type="hidden" name='job_id' value="{{encrypt($list->id)}}">
                                        <button  class="dropdown-toggle prWhiteBtn p-0"
                                                 data-toggle="dropdown">
                                            <img src="{{asset($ASSET.'/front_site/images/3_dots.png') }}" alt="">
                                        </button>

                                        <ul class="dropdown-menu actionMenu p-10" role="menu">
                                            <a href="{{ route('edit-cv-management',$list->id) }}">
                                                <li class="font-500">
                                                    <span class="fa fa-eye view-btn mr-3" aria-hidden="true"></span>View
                                                </li>
                                            </a>

                                            <a href="javascript:;" class="delete-product">
                                                <li class="font-500" id="cross" cv_id="{{$list->id}}">
                                                        <span class="fa fa-trash delete-btn mr-3"
                                                              aria-hidden="true"></span>Delete
                                                </li>
                                            </a>
                                        </ul>
                                    </td>
                                    <td>{{$list->sal_unit }} {{$list->exp_salary }}</td>
                                    <td>{{$list->total_experience }}</td>
                                    <td>{{$list->city,$list->country }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
{{--                    <div class="float-right">{{ $job->links() }}</div>--}}

                    @if($cv->isEmpty())
                        <h3 class="text-center mt-5">No CVs  yet</h3>
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
            var cv_id=$(this).attr("cv_id");
            btn = $(this);
            cv_id = btn.closest('td').find('input').val();
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
                        $.post("{{ route('remove-cv') }}", {
                            _token: '{{ csrf_token() }}',
                            cv_id: cv_id,
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
