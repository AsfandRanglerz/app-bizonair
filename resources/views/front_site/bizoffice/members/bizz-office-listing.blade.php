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
                    <span class="main-heading mb-1 text-danger"></span>
                    <span class="main-heading mb-2">{{$title}}</span>
                    <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                         role="alert">
                    </div>
                    <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                         role="alert">
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 5px">#</th>
                            <th>Logo</th>
                            <th>Name</th>
                            <th style="width: 200px">Business Type</th>
                            <th style="width: 85px">Registration No</th>
                            <th>No Of Employees</th>
                            <th>Annual Turnover</th>

                                <th style="width: 85px">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($bizz_listing as $key => $list)

                            <tr>
                                <th>@php
                                        $sr = $key + 1;
                                        echo($sr);
                                    @endphp</th>
                                <td><img src="{{$ASSET}}/front_site/images/company-images/{{$list->logo}}" style="height: 75px; width:75px;" alt=""></td>
                                <td>{{$list->company_name? $list->company_name : 'N/A'}}</td>
                                <td>{{$list->business_type? $list->business_type : 'N/A'}}</td>
                                <td>{{$list->registeration_no? $list->registeration_no : 'N/A'}}</td>
                                <td>{{$list->no_of_employees? $list->no_of_employees : 'N/A'}}</td>
                                <td>{{$list->annual_turnover? $list->annual_turnover : 'N/A'}}</td>

                                    <td align="center">

                                            <button type="button" class="dropdown-toggle prWhiteBtn p-0"
                                                    data-toggle="dropdown">
                                                <img src="./images/3_dots.png" alt="">
                                            </button>
                                            <input type="hidden" name='id' value="{{encrypt($list->id)}}">

                                                <ul class="dropdown-menu actionMenu p-10" role="menu">

                                                    <li class="font-500">
                                                        <a href="javascript:;" class="delete-btn" onclick="return false;">
                                                            <span class="fa fa-trash mr-3" aria-hidden="true"></span>Remove</a>
                                                    </li>
                                                </ul>


                                    </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="float-right">
{{--                    paginaton--}}
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
    </main>
    </body>

@endsection


