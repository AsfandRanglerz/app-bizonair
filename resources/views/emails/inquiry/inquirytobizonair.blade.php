@component('mail::message')
    # Dear,
    I am looking for Quality, Consultation & Inspection Services from Bizonair Team.<br>
    <p>Name : {{ $name }}</p><br>
    <p>Email : {{ $email }}</p><br>
    <p>Contact Number : {{ $phone }}</p><br>
    <p>Product Name : {{ $prod_name }}</p><br>
    <p>Reference Number : {{ $data['inquiry']->reference_no }}</p><br>
    Thanks
    {{ config('app.name') }}
@endcomponent

