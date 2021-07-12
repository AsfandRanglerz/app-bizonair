@component('mail::message')
# Dear Member,

Your OTP is {{$verification_code}}
To confirm authenticity of your email address, please click the following verification button. Thank you

@component('mail::button', ['url' => $url])
    Verify Email
@endcomponent

Have a nice day!<br>
Regards,<br>
{{ config('app.name') }}
@endcomponent
