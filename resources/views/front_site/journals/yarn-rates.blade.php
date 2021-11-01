@extends('front_site.master_layout')
@section('content')
    <body class="product-main">
    <main id="maincontent" class="blogs-page">
        <div class="main-container">
            <nav aria-label="breadcrumb" class="px-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{ url('journal') }}">Journal</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="{{Request::url()}}">Yarn Rates</a></li>
                </ol>
            </nav>
            <div class="container-fluid p-sm-4 pt-4 pb-4 pl-3 pr-3">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="table-responsive table-mt mt-3 mb-3 pl-4 pr-4">
                            <table class="table table-bordered table-striped" id="yarnRatesTable" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="text-center"><span class="font-18">Count</span></th>
                                    <th class="text-center"><span class="font-18">Supplier</span></th>
                                    <th class="text-center"><span class="font-18">Price Per Lbs (PKR)</span></th>
                                    <th class="text-center"><span class="font-18">Last Updated</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key=> $dat)
                                <tr>
                                    <td>{{$dat->count}}</td>
                                    <td>{{$dat->supplier}}</td>
                                    <td>{{$dat->price}} {{$dat->unit}}</td>
                                    <td>{{date("d-F-Y", strtotime($dat->publish_date))}}</td>

                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <p class="mb-0"><b>Disclaimer:</b> Above prices are for reference only, contact supplier for exact prices.</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="position-relative ads">
                            @foreach($ads as $ad)
                                <a href="{{ $ad->link }}" class="text-decoration-none">
                                <img src="{{ $ad->image }}" class="w-100 ads-img" alt="">
                                </a>
                                <span class="fa fa-info position-absolute info-icon"></span>
                                <span class="img-info"></span>
                            @endforeach
                        </div>
                        <div class="position-relative mt-3 ads">
                            @foreach($ads1 as $ad)
                                <a href="{{ $ad->link }}" class="text-decoration-none">
                                <img src="{{ $ad->image }}" class="w-100 ads-img" alt="">
                                </a>
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
    <script src="{{$ASSET}}/front_site/plugins/DataTables/datatables.js"></script>
    <script>
        $(document).ready(function (){
            /*datatable search*/
            $('#yarnRatesTable').DataTable({
                "pageLength": 100,
                aaSorting: [[0, "asc"]],
                "fnDrawCallback": function( oSettings ) {
                    if ($('.table-mt tr').length < 100) {
                        $('.dataTables_paginate').hide();
                    }
                },
                /*"columnDefs": [{"type": "date", "targets": 0}]*/
            });
            /*datatable search*/
        });
    </script>

@endpush
