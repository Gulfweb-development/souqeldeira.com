<div>
    <x-slot name="title">@lang('app.region') | @lang('app.edit')</x-slot>
    <x-slot name="pageTitle">@lang('app.dashboard') | @lang('app.region') | @lang('app.edit')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.region.index') }}">@lang('app.regions')</a></li>
        <li class="breadcrumb-item active">@lang('app.edit')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-admin.select name="state.governorate_id" label="{{ __('app.governorates') }}">
                        <option value="">@lang('app.choose_governorate')</option>
                        @forelse ($governorates as $governorate)
                            <option value="{{ $governorate->id }}">{{ $governorate->translate('name') }}</option>
                        @empty
                            {!! noData() !!}
                        @endforelse
                    </x-admin.select>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.name_ar" label="{{ __('app.name_ar') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.name_en" label="{{ __('app.name_en') }}" />
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
