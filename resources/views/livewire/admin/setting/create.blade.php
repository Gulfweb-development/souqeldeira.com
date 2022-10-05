<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.setting') | @lang('app.create')</x-slot>
    <x-slot name="title">@lang('app.setting') | @lang('app.create')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.setting.index') }}">@lang('app.settings')</a></li>
        <li class="breadcrumb-item active">@lang('app.create')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-admin.input name="state.title_ar" label="{{ __('app.title_ar') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.title_en" label="{{ __('app.title_en') }}" />
                </div>

                <div class="col-md-6">
                    <hr />
                    <x-admin.checkbox name="state.publish_all_to_social_media"
                        label="{{ __('app.publish_all_to_social_media') }}" />
                    <hr />
                </div>

                <div class="col-md-6">
                    <hr />
                    <x-admin.checkbox name="state.is_payment_available"
                        label="{{ __('app.is_payment_available') }}" />
                    <hr />
                </div>

                <div class="col-md-12">
                    <x-admin.textarea name="state.description_ar" label="{{ __('app.description_ar') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.description_en" label="{{ __('app.description_en') }}" />
                </div>



                <div class="col-md-12 mt-4 justify-content-center align-items-center d-flex border-1">
                    <button type="button" class="btn bg-gradient-primary btn-flat mt-4" wire:loading.attr="disabled"
                        wire:click.prevent="store">
                        <i class="far fa-save"></i>
                        @lang('app.save')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
