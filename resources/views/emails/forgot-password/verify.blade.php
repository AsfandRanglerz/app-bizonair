@component('mail::message')
    # Dear Member,

    Your Reset Password OTP is {{$token}}

    Have a nice day!
    Regards,
    {{ config('app.name') }}
@endcomponent
