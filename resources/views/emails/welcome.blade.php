@component('mail::message')
# Hola {{ $user->name }}

Gracias por crear una cuenta. Por favor verificala usando el siguiente boton:

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Confimar mi cuenta
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
