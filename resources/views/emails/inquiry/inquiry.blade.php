@component('mail::message')
    # Dear,
    {{ $name }}, You have received one new inquiry on "{{ $prod_name }}" with Reference {{ $data['inquiry']->reference_no }}.
    Thanks
    {{ config('app.name') }}
@endcomponent

