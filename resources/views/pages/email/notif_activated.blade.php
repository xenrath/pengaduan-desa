@component('mail::message')
# Account Activated

<h1>Hello, {{$user->name}}</h1>
<h5>Your account is {{ $status }}. You @if($status == 'activated') can @else can't @endif login in aplication now.</h5>

Thank you<br>
<center>Banjaranyar, Randu Dongkal</center>
@endcomponent