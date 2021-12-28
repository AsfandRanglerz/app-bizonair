@component('mail::message')
# Hi,
<?php  $company =\App\UserCompany::where('company_id',$invite->company_id)->first(); ?>
{{ucfirst($user->name)}} has invited to Join Biz Office "{{ $company->company_name }}". Your verification code is  {{$invite->verification_code}} please login or register to activate!


Thanks,<br>
{{ config('app.name') }}
@endcomponent
