@component('mail::message')
<h3>User Removed From Company</h3>
<p>you are no longer part of {{$usercompany->company_name}}</p><br>

{{--{{ config('app.name') }}--}}
@endcomponent
