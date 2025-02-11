<x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="route('setnewpassword',['token'=>$token])">
Click here to reset
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
