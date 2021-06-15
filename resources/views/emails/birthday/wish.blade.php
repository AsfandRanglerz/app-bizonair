@component('mail::message')
# Happy Birthday

<!-- For Image -->
<!-- ![{{ env('APP_NAME') }}]({{ asset('public/public/birthday-gift.jpg') }}) -->

Happy Birthday {{ $member->name }}.

Wishing you have a wonderful and happy day.

<small>Note: This is an auto generated email don't reply.</small>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
