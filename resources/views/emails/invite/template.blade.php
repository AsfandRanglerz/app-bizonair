@component('mail::message')
# Hi,
<?php  $company =\App\UserCompany::where('company_id',$invite->company_id)->first(); ?>
{{ucfirst($user->name)}} has invited to Join Biz Office "{{ $company->company_name }}". <a target="_blank" href="{{ route('accept', ['token' => $invite->token,'email'=>$user->email]) }}">Click here</a> to activate!


Thanks,<br>
{{ config('app.name') }}
@endcomponent
