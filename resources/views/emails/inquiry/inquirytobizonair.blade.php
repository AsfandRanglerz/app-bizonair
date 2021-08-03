@component('mail::message')
<style>
    td.content-cell {
        padding: 16px 30px!important;
    }

    .label-heading {
        font-weight: 500!important;
        display: inline-block!important;
        width: 125px!important;
    }

    .font-500 {
        font-weight: 500!important;
    }
</style>
<p><span class="font-500">Dear,</span><br>I am looking for Quality, Consultation & Inspection Services from Bizonair Team.</p>
<p><span class="label-heading">Name:</span> {{ $name }}</p>
<p><span class="label-heading">Email:</span> {{ $email }}</p>
<p><span class="label-heading">Contact Number:</span> {{ $phone }}</p>
<p><span class="label-heading">Product Name:</span> {{ $name }}</p>
<p><span class="label-heading">Reference Number:</span> {{ $name }}</p>
<span>Thanks</span><br>
<span>{{ config('app.name') }}</span>
{{--    <p>Name : {{ $name }}</p><br>--}}
{{--    <p>Email : {{ $email }}</p><br>--}}
{{--    <p>Contact Number : {{ $phone }}</p><br>--}}
{{--    <p>Product Name : {{ $prod_name }}</p><br>--}}
{{--    <p>Reference Number : {{ $data['inquiry']->reference_no }}</p><br>--}}
{{--    Thanks--}}
{{--    {{ config('app.name') }}--}}
@endcomponent
