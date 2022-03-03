<!DOCTYPE html>
<html>
<head>
    <title>WEB</title>
    <style>
        p, span, h1, h2, h3, h4, h5, h6 {
            color: #5f6368!important;
        }

        td.content-cell {
            padding: 16px 30px!important;
        }

        .main-heading {
            text-align: center!important;
            font-size: 24px!important;
        }

        .label-heading {
            font-weight: bold!important;
            display: inline-block!important;
            width: 30%!important;
        }

        .attachment-img {
            width: 200px!important;
            height: 200px!important;
            object-fit: contain!important;
            object-position: left!important;
            margin-bottom: 15px!important;
        }

        .mb-0 {
            margin-bottom: 0!important;
        }

        .d-block {
            display: block!important;
        }
    </style>
</head>
<body>

{{--<h3 class="main-heading">Inquiry</h3>--}}

<h3>
Dear,
{!! $name  !!} , You have received one new inquiry on "{!! $prod_name !!} " with Reference {!! $reference_no !!}.

    @if($data['inquiry']->product_id)
    <a target="_blank" href="@if(auth()->check()){{ route('product-inquiries') }}@else{{ url('/') }}@endif">Click here</a> to open!
    @else
        <a target="_blank" href="@if(auth()->check()){{ route('buysell-inquiries') }}@else{{ url('/') }}@endif">Click here</a> to open!
    @endif</h3>


<p><span class="label-heading" style="width: 50%">Contact Name:</span> {!! $data['inquiry']->contact_name !!}</p>
<p><span class="label-heading" style="width: 50%">Company Name:</span> {!! $data['inquiry']->company_name !!}</p>
<p><span class="label-heading" style="width: 50%">Contact Number:</span> {!! $data['inquiry']->contact_no !!}</p>
<p><span class="label-heading" style="width: 50%">Email:</span> {!! $data['inquiry']->email !!}</p>
<p><span class="label-heading" style="width: 50%">City:</span> {!! $data['inquiry']->city !!}</p>
<p><span class="label-heading" style="width: 50%">Country:</span> {!! $data['inquiry']->country_name !!}</p>
<p><span class="d-block label-heading">Description:</span> {!! $data['inquiry']->description !!}</p>

<p><span class="label-heading" style="width: 50%">Sample with specification sheet :</span> @if($data['inquiry']->sample_with_specification_sheet) Yes @else - @endif</p>
<p><span class="label-heading" style="width: 50%">Latest Price Quotation :</span> @if($data['inquiry']->latest_price_quotation) Yes @else - @endif</p>
<p><span class="label-heading" style="width: 50%">Compliance certification required :</span> @if($data['inquiry']->compliance_certification_required) Yes @else - @endif</p>
<p><span class="label-heading" style="width: 50%">Preferred payment terms :</span> @if($data['inquiry']->preferred_payment_terms) Yes @else - @endif</p>
<p><span class="label-heading" style="width: 50%">Production Capacity:</span> @if($data['inquiry']->production_capacity) Yes @else - @endif</p>


<h1 class="mb-0 biz-thanks">Thanks {{ config('app.name') }}</h1>
</body>
</html>
