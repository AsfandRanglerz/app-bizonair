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

                <div class="  d-container mt-2">
                    <div class="clearfix">
                        <span
                            class="heading biz-product-heading mb-1 text-danger d-flex">{{ company_name(session()->get('company_id'))??'' }}</span>
                        <span
                            class="heading biz-product-heading">{{ $title }}</span>
                        <a href="{{ route('company-create-meeting') }}" class="red-btn pull-right">Schedule Meeting</a>
                    </div>
                    @foreach ($listing as $key => $list)
                        <div class="card mt-2">
                            <div class="card-body p-2">
                                <h3>{{ucfirst($list->title)}}</h3>
                                <p class="mb-2">{{date("F jS, Y", strtotime($list->meeting_date)).' '.date('h:i a', strtotime($list->meeting_time))}}</p>
                                <p class="mb-2">{{$list->detail}}</p>
                                <p class="mb-0 text-right"><strong>Scheduled
                                        By:</strong> {{$list->user->first_name}} {{$list->user->last_name}}</p>
                            </div>
                        </div>

                    @endforeach
                    <div class="float-right mt-5">
                        {!! $listing->appends(request()->except('page'))->links() !!}
                    </div>
                    @if($listing->isEmpty())
                        <h3 class="text-center mt-2">No planned meetings yet</h3>
                    @endif
                </div>
                <!-- /#page-content-wrapper -->
            </div>
    </main>
    </body>

@endsection


@push('js')

    <script>
        $(document).on('click', '.delete-btn', function () {
            btn = $(this);
            user_id = btn.closest('td').find('input').val();
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
                        $.post("{{ route('company-remove-user-from-group') }}", {
                            _token: '{{ csrf_token() }}',
                            user_id: user_id,
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

        $(document).on('click', '.status-btn', function () {
            btn = $(this);
            user_id = btn.closest('td').find('input').val();
            swal({
                title: "Are you sure?",
                // text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "success",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#ajax-preloader").show();
                        $.post("{{ route('company-change-user-member-status') }}", {
                            _token: '{{ csrf_token() }}',
                            user_id: user_id,
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
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1000);
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
