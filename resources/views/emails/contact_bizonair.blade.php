@component('mail::message')
<h3>Contact Us</h3>
<p>Name : {{$data['$contact']->name}}</p><br>
<p>Email : {{$data['$contact']->email}}</p><br>
<p>Company : {{$data['$contact']->company}}</p><br>
<p>Designation : {{$data['$contact']->designation}}</p><br>
<p>Phone : {{$data['$contact']->phone}}</p><br>
<p>Country : {{$data['$contact']->country}}</p><br>
<p>Message : {{$data['$contact']->description}}</p><br>

{{--{{ config('app.name') }}--}}
@endcomponent
