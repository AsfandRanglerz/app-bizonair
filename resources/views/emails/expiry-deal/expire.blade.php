@component('mail::message')
# Dear {{ $user->name }},

Please re Post Your add {{ $members->product_service_name }}.
Your One-Time ({{ $members->product_service_name }}") with Reference # {{ $members->reference_no }} will expire today.
To activate your One-Time Deal again, please click on this link  <a target="_blank" href="{{ url('/buy-sell') }}">Click here</a>.

<small>Note: This is an auto generated email don't reply.</small>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
