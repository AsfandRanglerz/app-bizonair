@component('mail::message')
<h3>User Removed From Company</h3>
<p>It is to inform you that you are no longer part of <b>{{$usercompany->company_name}}</b>. However, you are still a member of Bizonair portal on individual basis.</p>
<br>
<p>Thank you</p>

{{--{{ config('app.name') }}--}}
@endcomponent
