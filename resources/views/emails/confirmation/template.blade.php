@component('mail::message')
    # Dear Member,

    Your OTP is {{$verification_code}}

    Have a nice day!
    Regards,
    {{ config('app.name') }}
@endcomponent
