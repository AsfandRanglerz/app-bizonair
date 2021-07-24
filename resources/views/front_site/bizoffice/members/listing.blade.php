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

                <div class="table-responsive table-mt d-container mt-2">
                    <span class="main-heading mb-1 text-danger">{{ company_name(session()->get('company_id'))??'' }}</span>
                    <span class="main-heading mb-2">{{$title}}</span>
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
                            <th>Name</th>
                            <th>Designation</th>
                            <th style="width: 200px">Profile Picture</th>
                            <th style="width: 85px">Role</th>
                            <th>Date Joined</th>
                            <th style="width: 85px">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listing as $key => $list)

                            <tr>
                                <th>@php
                                        $sr = $key + 1;
                                        echo($sr);
                                    @endphp</th>
                                <td>
                                    <span data-online="{{ $list->user->id }}"
                                          style="font-size:10px; color: @if($list->user->isOnline()) green @else red @endif"
                                          class="fa fa-circle mb-2 online-user"></span>
                                    {{ucfirst($list->user->first_name.' '.$list->user->last_name)}}
                                </td>
                                <td>{{$list->user->designation? $list->user->designation : 'N/A'}}</td>
                                <td><img src="{{get_user_image($list->user)}}" style="height: 75px; width:75px;" alt=""></td>
                                <td>{{get_user_status($list->user->id)}}</td>
                                <td>Member Since {{str_replace('ago', ' ',\Carbon\Carbon::parse($list->user->created_at)->diffForHumans())}}</td>
                                @if($list->is_owner == 1 || $list->is_admin == 1 || $list->is_member == 1)
                                    <td align="center">

                                        @if(!check_member(\Auth::id()))
                                        @if(!($list->is_owner==1 && $list->is_admin==1)  )

                                            @if(!(\Auth::id() == $list->user_id && ($list->is_member==1 && $list->is_admin==1)))

                                                <button  class="dropdown-toggle prWhiteBtn p-0 abc"
                                                        data-toggle="dropdown" disabled>
                                                    <img src="./images/3_dots.png" alt="">
                                                </button>
                                                <input type="hidden" name='id' value="{{encrypt($list->user->id)}}">
                                                <ul class="dropdown-menu actionMenu p-10" role="menu">
                                                    @if($list->is_admin == 0 && $list->is_member == 1)
                                                    <li class="font-500">
                                                        <a href="javascript:;" class="status-btn" onclick="return false;">
                                                            <span class="fa fa-check mr-3" aria-hidden="true"></span>Mark as Admin</a>
                                                    </li>
                                                        @elseif($list->is_admin == 1 && $list->is_member == 1)
                                                    <li class="font-500">
                                                        <a href="javascript:;" class="status-btn" onclick="return false;">
                                                            <span class="fa fa-check mr-3" aria-hidden="true"></span>Unmark as Admin</a>
                                                    </li>
                                                    @endif
                                                    <li class="font-500">
                                                        <a href="javascript:;" class="delete-btn" onclick="return false;">
                                                            <span class="fa fa-trash mr-3" aria-hidden="true"></span>Remove</a>
                                                    </li>
                                                </ul>

                                            @endif
                                            @endif
                                            @endif

                                    </td>

                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{--                <div class="float-right">--}}
                {{--                    {!! $listing->appends(request()->except('page'))->links() !!}--}}
                {{--                </div>--}}
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </main>
    </body>

@endsection


@push('js')

    <script>
        var online_users = [];

        function get_company_online_users() {
            $.post("{{ route('get-online-members') }}", {
                _token: '{{ csrf_token() }}',
                online_users: online_users
            }, function (data) {
                data = $.parseJSON(data);
                $('.online-user').each(function (item) {
                    var online_id = $(this).attr('data-online');
                    if (data.includes(parseInt(online_id))) {
                        $(this).css('color', 'green');
                    } else {
                        $(this).css('color', 'red');
                    }
                });
            });
        }

        $(document).ready(function () {
            $('.online-user').each(function () {
                online_users.push($(this).attr('data-online'));
            });
            setInterval(function () {
                get_company_online_users()
            }, 5000);
        });
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
