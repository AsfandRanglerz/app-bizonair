@component('mail::message')
<?php  $company =\App\UserCompany::where('company_id',$invite->company_id)->first(); ?>
<!-- {{ucfirst($user->name)}} has invited to Join Biz Office "{{ $company->company_name }}". For Website user please <a target="_blank" href="{{'https://www.bizonair.com/accept-token/'.$invite->token.'/'.$user->email}}">Click here</a> Or for mobile app user then use this verification code   {{$invite->verification_code}} while registering user  to activate! -->
<div>
    <h5 style="margin: 0">Intro:</h5>
    <p style="margin-bottom: 16px">{{ucfirst($user->name)}} has invited to Join Biz Office "{{ $company->company_name }}".</p>
    <h5 style="margin: 0">For Web Users:</h5>
    <p style="margin-bottom: 16px">Please visit this link <a target="_blank" href="{{'https://www.bizonair.com/accept-token/'.$invite->token.'/'.$user->email}}">Click here</a> for further processing.</p>
    <h5 style="margin: 0">For Mobile App Users:</h5>
    <p style="margin-bottom: 16px">Please use this verification code {{$invite->verification_code}} while doing registration process or if you're are registered member then just swipe your sidebar or drawer and click the link as shown in attached Image below, on clicking that link OTP Screen will appear where you can add the OTP.</p>
    <img src="{{$ASSET}}/front_site/images/otp-screen.png" /><br>
    <a href="https://drive.google.com/file/d/1bZZywWMhMVqwuWcDYsMxeheYPAgNLnAB/view?usp=sharing" target="_blank" style="font-size: 16px">Video Tutorial</a>
</div>
<p style="font-size: 16px">Thanks,<br>{{ config('app.name') }}</p>
@endcomponent