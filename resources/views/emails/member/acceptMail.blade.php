@component('mail::message')

User {{$email}} has accepted your invitation.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
