@component('mail::message')
# Welcome from Cake Shop


Hello {{ $name }},<br>
{{ $bodyText }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent