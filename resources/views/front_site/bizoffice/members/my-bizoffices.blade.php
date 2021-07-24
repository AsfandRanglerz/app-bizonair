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
                                <th class="p2">Company Name</th>
                                <th class="p2">Role</th>
                                <th class="p2">Business Type</th>
                                <th class="p2">Number of Members</th>
                                <th class="p2">Logo</th>
                                <th class="p2">Member Since</th>
                                <th style="width: 85px">Action</th>
                            </tr>
                            </thead>
                            <?php $i=1;?>
                            <tbody>
                            @foreach ($company as $key => $list)

                                <tr @if($list->company->id==session()->get('company_id')) @else style="background: #fff;" @endif>
                                    <th>{{ $i++ }}</th>
                                    <td @if(session()->get('company_id')== $list->company->id) class="font-weight-bold" @endif><a href="{{route('change-company',$list->company->id)}}"> {{$list->company->company_name }}</a></td>
                                    <td>@if($list->is_owner==1) Owner/Admin @elseif($list->is_member==1 && $list->is_admin==1) Admin,Member @else Member @endif</td>
                                    <td>{{$list->company->business_type }}</td>
                                    <td><a href="{{route('get-members')}}">{{getCompanyMembersCount($list->company->id) }}</a></td>
                                    <td><img src="{{$ASSET.'/front_site/images/company-images/'.$list->company->logo }}" style="width: 50px;
    height: 50px;"></td>
                                    <td>{{str_replace('ago', ' ',\Carbon\Carbon::parse($list->company->created_at)->diffForHumans())}}</td>

                                    <td align="center">
                                        <?php $usercomp = \App\UserCompany::where('company_id',$list->company->id)->where('user_id',auth()->id())->first();?>
                                        @if($usercomp->is_member == 1 && $usercomp->is_admin == 1 || $usercomp->is_owner == 1)
                                                <input type="hidden" name='companies_id' value="{{encrypt($list->company->id)}}">
                                                <button  class="dropdown-toggle prWhiteBtn p-0"
                                                        data-toggle="dropdown">
                                                    <img src="{{asset($ASSET.'/front_site/images/3_dots.png') }}" alt="">
                                                </button>
                                        <ul class="dropdown-menu actionMenu p-10" role="menu">
                                            <a href="{{ route('my-company-profile',$list->company->id) }}" onclick="return false;">
                                                <li class="font-500">
                                                    <span class="fa fa-eye view-btn mr-3" aria-hidden="true"></span>Edit
                                                </li>
                                            </a>
                                            <a href="javascript:;" class="delete-product" onclick="return false;">
                                                <li class="font-500" id="cross" companies_id="{{$list->company->id}}">
                                                        <span class="fa fa-trash delete-btn mr-3"
                                                              aria-hidden="true"></span>Delete
                                                </li>
                                            </a>
                                        </ul>
                                            @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
{{--                    <div class="float-right">{{ $company->links() }}</div>--}}

                    @if($company->isEmpty())
                        <h3 class="text-center mt-5">No Companies  yet</h3>
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
            var companies_id=$(this).attr("companies_id");
            btn = $(this);
            companies_id = btn.closest('td').find('input').val();
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
                        $.post("{{ route('remove-company') }}", {
                            _token: '{{ csrf_token() }}',
                            companies_id: companies_id,
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
                                location.reload();
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
