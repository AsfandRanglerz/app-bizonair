@component('mail::message')

{{$detail['user_name']}} favourite your product {{$detail['product_title']}} reference number {{$detail['reference_no']}}.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
