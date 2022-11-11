@component('mail::message')
<center style="color: #320777; font-size:35px;">Dear User,</center>

<span style="color: #320777; font-size:23px; align:center">

####  Account successfully registered on Bricode Services

### Hi {{ $username }}

### Congratulations from Bricode Services

### Your account has been successfully registered on Bricode.com

### Pleases upgrade your account in next 24 hours Otherwise your account will be suspended automatically
### Keep working hard with Bricode,service
### We look forward to providing you with the ultimate learning and Earning experience of Digital working

### With best wishes,
### Info@starmultinational.com
### www.Starmultinational.com



</span>

@component('mail::button', ['url' => route('login')])
Your Login Here
@endcomponent


{{ config('app.name') }}
@endcomponent
