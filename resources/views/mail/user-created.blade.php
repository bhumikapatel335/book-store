@component('mail::message')
# User Created

New User is Created.

@component('mail::button', ['url' => ''])
View User
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
