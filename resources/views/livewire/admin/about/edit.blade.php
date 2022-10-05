<div>
    <x-slot name="title">@lang('app.about') | @lang('app.edit')</x-slot>
    <x-slot name="pageTitle">@lang('app.dashboard') | @lang('app.about') | @lang('app.edit')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.about.create') }}">@lang('app.abouts')</a></li>
        <li class="breadcrumb-item active">@lang('app.edit')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <x-admin.textarea name="state.text_ar" label="{{ __('app.text_ar') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.text_en" label="{{ __('app.text_en') }}" />
                </div>

                <hr />
                <div class="col-md-12 mt-4 justify-content-center align-items-center d-flex border-1">
                    <button type="button" class="btn bg-gradient-primary btn-flat mt-4" wire:loading.attr="disabled"
                        wire:click.prevent="update">
                        <i class="far fa-save"></i>
                        @lang('app.update')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
