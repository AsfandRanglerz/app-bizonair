@component('mail::message')
# Hi,
<?php  $company =\App\UserCompany::where('company_id',$invite->company_id)->first(); ?>
{{ucfirst($user->name)}} has invited to Join Biz Office "{{ $company->company_name }}". For Website user please <a target="_blank" href="{{'https://www.bizonair.com/accept-token/'.$invite->token.'/'.$user->email}}">Click here</a> Or for mobile app user then use this verification code   {{$invite->verification_code}} while registering user  to activate!


Thanks,<br>
{{ config('app.name') }}
@endcomponent
