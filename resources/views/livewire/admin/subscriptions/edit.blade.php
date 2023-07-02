<div>
    <x-slot name="title">@lang('app.subscriptions') | @lang('app.edit')</x-slot>
    <x-slot name="pageTitle">@lang('app.dashboard') | @lang('app.subscriptions') | @lang('app.edit')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index') }}">@lang('subscriptions_package')</a></li>
        <li class="breadcrumb-item active">@lang('app.edit')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-admin.input name="state.name_ar" label="{{ __('app.name_ar') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.name_en" label="{{ __('app.name_en') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.adv_nurmal_count" label="{{ __('app.adv_nurmal_count') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.adv_star_count" label="{{ __('app.adv_star_count') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.price" label="{{ __('app.price') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.expire_time" label="{{ __('expire_time') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.file name="state.image" :image="$state" :oldImage="$state['old_image']"  label="{{ __('app.image') }}"
                                  size="1920x1080" />
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
