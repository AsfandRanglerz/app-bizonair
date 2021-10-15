@component('mail::message')
<style>
    p, span, h1, h2, h3, h4, h5, h6 {
        color: #5f6368!important;
    }

    td.content-cell {
        padding: 16px 30px!important;
    }

    .label-heading {
        font-weight: bold!important;
        display: inline-block!important;
        width: 35%!important;
    }

    .font-500 {
        font-weight: 500!important;
    }

    .mb-0 {
        margin-bottom: 0!important;
    }
</style>
<p><span class="font-500">Dear,</span><br>I am looking for Quality, Consultation & Inspection Services from Bizonair Team.</p>
<p><span class="label-heading">Name:</span> {{ $name }}</p>
<p><span class="label-heading">Email:</span> {{ $email }}</p>
<p><span class="label-heading">Contact Number:</span> {{ $phone }}</p>
<p><span class="label-heading">Product Name:</span> {{ $prod_name }}</p>
<p><span class="label-heading">Reference Number:</span> {{ $reference_no }}</p>
<h1 class="mb-0">Thanks {{ config('app.name') }}</h1>
@endcomponent
