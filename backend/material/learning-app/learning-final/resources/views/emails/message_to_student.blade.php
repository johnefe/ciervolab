@component('mail::message')

# {{ __("Nuevo mensaje") }}

{{ $text_message }}

@component('mail::button', ['url' => url('/')])
    {{ __("Ir a :app", ['app' => env('APP_NAME')]) }}
@endcomponent

{{ __("Gracias") }},<br>
{{ config('app.name') }}

@endcomponent