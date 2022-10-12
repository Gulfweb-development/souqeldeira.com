<div>
    <x-slot name="meta_title">{{ $setting->translate('title') }}</x-slot>
    <x-slot name="meta_descrption">{{ $setting->translate('description') }}</x-slot>
    <x-slot name="meta_keywords">{{ \App\Http\Controllers\Frontend\FrontendLangController::keyWords(true) }}</x-slot>
    <x-slot name="og_title">{{ $setting->translate('title') }}</x-slot>
    <x-slot name="og_description">{{ $setting->translate('description') }}</x-slot>
    <x-slot name="og_url">{{ Request::url() }}</x-slot>
    <x-slot name="og_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_title">{{ $setting->translate('title') }}</x-slot>
    <x-slot name="twitter_description">{{ $setting->translate('description') }}</x-slot>
    <x-slot name="twitter_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_card">{{ $setting->translate('title') }}</x-slot>
    <x-slot name="schema">{{ $setting->translate('title') }}</x-slot>
        @livewire('frontend.components.home-search')

        @livewire('frontend.components.for-sale')
        @livewire('frontend.components.for-rent')
        @livewire('frontend.components.home-clients')
        @if ( \App\Http\Controllers\Frontend\FrontendLangController::setting()['home_details_'.app()->getLocale()])
        <div class="partners bg-white-3">
            <div class="container text-{{ app()->getLocale() == "ar" ? 'right' : 'left' }}">
                {!! nl2br(\App\Http\Controllers\Frontend\FrontendLangController::setting()['home_details_'.app()->getLocale()]) !!}
            </div>
        </div>
        @endif
    </div>
