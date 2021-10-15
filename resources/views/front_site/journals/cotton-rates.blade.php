@extends('front_site.master_layout')
@section('content')
    <body class="product-main">
    <style>
        /*cotton rates css*/

        /*cotton rates css*/
    </style>
    <main id="maincontent" class="blogs-page">
        @include('front_site.common.product-banner')
        <div class="main-container">
            <nav aria-label="breadcrumb" class="px-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{ url('journal') }}">Journal</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{Request::url()}}">Cotton Rates</a></li>
                </ol>
            </nav>
            <div class="container-fluid px-2">
                <div class="row m-0">
                    <div class="col-sm-9 px-0">
                        <div class="table-responsive table-mt">
                            <table class="table table-bordered table-striped" id="cottonRatesTable" style="width:100%">
                                <thead>
                                <tr>
                                    <th><span class="th-cotton-heading">Cotton Region</span></th>
                                    <th><span class="th-cotton-heading">Price Per Maund (Rs.)</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $dat)
                                <tr>
                                    <th>{{$dat->cotton_region}}</th>
                                    <td>{{$dat->price}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-3 px-0 mt-2">
                        <div class="position-relative ads">
                            @foreach($ads as $ad)
                                <img src="{{ url('storage/app/public/'.$ad->image) }}" class="w-100 ads-img"
                                     alt="">
                                <span class="fa fa-info position-absolute info-icon"></span>
                                <span class="img-info"></span>
                            @endforeach
                        </div>
                        <div class="position-relative mt-3 ads">
                            @foreach($ads1 as $ad)
                                <img src="{{ url('storage/app/public/'.$ad->image) }}" class="w-100 ads-img"
                                     alt="">
                                <span class="fa fa-info position-absolute info-icon"></span>
                                <span class="img-info"></span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
@endsection
@push('js')

    <script>
        $(document).ready(function (){
            /*datatable search*/
            $('#cottonRatesTable').DataTable({
                language: {
                    search: "",
                    searchPlaceholder: "Search"
                },
                "pageLength": 10,
                "fnDrawCallback": function( oSettings ) {
                    if ($('.table-mt tr').length < 10) {
                        $('.dataTables_paginate').hide();
                    }
                },
                "columnDefs": [{"type": "date", "targets": 0}]
            });
            /*datatable search*/
        });
    </script>

@endpush
