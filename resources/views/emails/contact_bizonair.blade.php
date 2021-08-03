@component('mail::message')
<style>
    td.content-cell {
        padding: 16px 30px!important;
    }

    .main-heading {
        text-align: center!important;
        font-size: 24px!important;
    }

    .label-heading {
        font-weight: 500!important;
        display: inline-block!important;
        width: 125px!important;
    }

    .attachment-img {
        width: 200px!important;
        height: 200px!important;
        object-fit: contain!important;
        object-position: left!important;
    }
</style>
<h3 class="main-heading">Contact Us</h3>
<p><span class="label-heading">Inquiry For:</span> {{$data['$contact']->inquiry_for}}</p>
<p><span class="label-heading">Name:</span> {{$data['$contact']->name}}</p>
<p><span class="label-heading">Email:</span> {{$data['$contact']->email}}</p>
<p><span class="label-heading">Company:</span> {{$data['$contact']->company}}</p>
<p><span class="label-heading">Designation:</span> {{$data['$contact']->designation}}</p>
<p><span class="label-heading">Phone:</span> {{$data['$contact']->phone}}</p>
<p><span class="label-heading">Country:</span> {{$data['$contact']->country}}</p>
<p><span class="label-heading">Message:</span> {{$data['$contact']->description}}</p>
<p><span class="label-heading">Attachment:</span></p>
<img src="{{$data['$contact']->image}}" class="attachment-img">
@endcomponent
