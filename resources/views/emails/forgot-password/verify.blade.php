@component('mail::message')
    <h3>Verify Your Email Address</h3>
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif
    <a href="{{url('/')}}/reset-password/{{$token}}">Click Here</a>
{{--{{ config('app.name') }}--}}
@endcomponent
