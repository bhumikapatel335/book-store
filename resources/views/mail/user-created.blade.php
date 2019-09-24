@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url'=>''])
            <!-- header here -->
        @endcomponent
    @endslot

@component('mail::panel')
#Hello,@foreach($user as $name)
         {{ $name->getUsername()}} !
    @endforeach
Congratulations !!!!

    Your Registration has been Accepted.

@component('mail::button', ['url' => 'https://hubsolv.com'])
    View Site
@endcomponent

Regards,<br>
Hubsolv
@endcomponent

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <!-- footer here -->
        @endcomponent
    @endslot

@endcomponent




