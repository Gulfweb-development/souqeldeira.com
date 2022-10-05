@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $message }}

    {{-- Promotion --}}
    @isset($promotion)
        @php
            echo strip_tags('<table class="promotion" align="center" width="100%" cellpadding="0" cellspacing="0"><tr><td align="center">'.$promotion.'</td></tr></table>');
        @endphp
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
