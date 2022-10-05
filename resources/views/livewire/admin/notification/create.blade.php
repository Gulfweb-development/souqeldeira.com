<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.notification') | @lang('app.create')</x-slot>
    <x-slot name="title">@lang('app.notification') | @lang('app.create')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('app.notifications')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <label for="exampleInput-n">
                        @lang('app.account_type')
                    </label>
                    <select class="form-control @error('type') is-invalid @enderror'" wire:model.defer="state.type">
                        <option value="ALL">@lang('app.all')</option>
                        <option value="USER">@lang('app.user')</option>
                        <option value="COMPANY">@lang('app.company')</option>
                    </select>
                    @error('type')
                        <span class="text-danger text-sm col-12">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <x-admin.input name="state.title_en" label="{{ __('app.title_en') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.input name="state.title_ar" label="{{ __('app.title_ar') }}" />
                </div>

                <div class="col-md-12">
                    <x-admin.textarea name="state.message_ar" label="{{ __('app.message_ar') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.message_en" label="{{ __('app.message_en') }}" />
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
