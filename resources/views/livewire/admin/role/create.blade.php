<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.role') | @lang('app.create')</x-slot>
    <x-slot name="title">@lang('app.role') | @lang('app.create')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">@lang('app.roles')</a></li>
        <li class="breadcrumb-item active">@lang('app.create')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-admin.input name="state.label_ar" label="{{ __('app.label_ar') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.label_en" label="{{ __('app.label_en') }}" />
                </div>

                <div class="col-sm-12">
                    <hr>
                </div>
                <div class="col-sm-12">

                    @forelse ($permationFors as $permationFor)
                         <div class="card card-primary card-outline">
                        <div class="card-header bg-primary">
                            <h5 class="card-title m-0 font-weight-bold">{{ $permationFor->translate('name') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                @forelse ($permationFor->permations as $permation)
                                    <div class="col-md-3">
                                    <div class="d-flex justify-content-start flex-column align-items-center mb-5">
                                        <label for="">{{ $permation->translate('label') }}</label>
                                        <input type="checkbox" name="permations[]" wire:model="permations" value="{{ $permation->id }}" class="form-control">
                                    </div>
                                </div>

                                @empty
                                    @lang('app.no_data')
                                @endforelse

                            </div>
                        </div>
                    </div>
                    @empty
                        @lang('app.no_data')
                    @endforelse
                    @error('permations')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mt-4 justify-content-center align-items-center d-flex justify-content-start flex-column align-items-center mb-5 border-1">
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
