@component('mail::message')
# Meeting Notification

Dear Member,

You are reminded that a meeting had been arranged.

@component('mail::table')
<table class="table-light table-bordered">
	<tbody>
		<tr><th colspan="2">--- Meeting Detail ---</th></tr>
		<tr>
			<th>Title</th>
			<td>{{ $meeting->title }}</td>
		</tr>
		<tr>
			<th>Detail</th>
			<td>{{ $meeting->detail }}</td>
		</tr>
		<tr>
			<th>Date</th>
			<td>{{ $meeting->meeting_date }}</td>
		</tr>
		<tr>
			<th>Time</th>
			<td>{{ $meeting->meeting_time }}</td>
		</tr>
	</tbody>
</table>
@endcomponent

<small>Note: This is an auto generated email don't reply.</small>

@component('mail::button', ['url' => route('company-get-meetings')])
View all meetings
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
