<div>
    <x-slot name="meta_title">@lang('app.app_name')</x-slot>
    <x-slot name="meta_descrption">@lang('app.app_name')</x-slot>
    <x-slot name="og_title">@lang('app.app_name')</x-slot>
    <x-slot name="og_description">@lang('app.app_name')</x-slot>
    <x-slot name="og_url">{{ Request::url() }}</x-slot>
    <x-slot name="og_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_title">@lang('app.app_name')</x-slot>
    <x-slot name="twitter_description">@lang('app.app_name')</x-slot>
    <x-slot name="twitter_image">{{ asset('images/logo-red.svg') }}</x-slot>
    <x-slot name="twitter_card">@lang('app.app_name')</x-slot>
        @livewire('frontend.components.home-search')

        @livewire('frontend.components.for-sale')
        @livewire('frontend.components.for-rent')
        @livewire('frontend.components.home-clients')

    </div>
