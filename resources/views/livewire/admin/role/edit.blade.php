<div>
    <x-slot name="title">@lang('app.role') | @lang('app.edit')</x-slot>
    <x-slot name="pageTitle">@lang('app.dashboard') | @lang('app.role') | @lang('app.edit')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">@lang('app.roles')</a></li>
        <li class="breadcrumb-item active">@lang('app.edit')</li>
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
                        <div class="card card-primary card-outline" wire:key="permationFor-key-{{ $permationFor->id }}" >
                            <div class="card-header bg-primary">
                                <h5 class="card-title m-0 font-weight-bold">{{ $permationFor->translate('name') }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    @forelse ($permationFor->permations as $permation)
                                        <div class="col-md-3" wire:key="permationsis-id-{{ $permation->id }}" >
                                            <div
                                                class="d-flex justify-content-start flex-column align-items-center mb-5">
                                                <p for="">{{ $permation->translate('label') }}</p>
                                                <input type="checkbox"  wire:model="permations"
                                                    value="{{ $permation->id }}" class="form-control">
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
