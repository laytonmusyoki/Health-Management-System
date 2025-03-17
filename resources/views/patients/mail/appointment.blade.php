<x-mail::message>

We have received your appointment request and we will get back to you soon.


# Your appointment details are as follows:<br/>
Date of the appointment: {{ $mailData['date'] }}<br>
Time : {{ $mailData['time'] }}<br>
Doctor : {{ $mailData['doctor'] }}<br>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
