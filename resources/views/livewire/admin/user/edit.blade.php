<div>
    <x-slot name="title">@lang('app.user') | @lang('app.edit')</x-slot>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.user') | @lang('app.edit')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">@lang('app.users')</a></li>
        <li class="breadcrumb-item active">@lang('app.edit')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                {{-- <div class="col-md-6">
                    <label for="exampleInput-n">
                        @lang('app.account_type')
                    </label>
                    <select class="form-control @error('type') is-invalid @enderror'" wire:model.defer="state.type">
                        <option value="USER">@lang('app.user')</option>
                        <option value="COMPANY">@lang('app.company')</option>
                    </select>
                    @error('type')
                        <span class="text-danger text-sm col-12">{{ $message }}</span>
                    @enderror
                </div> --}}
                  <div class="col-md-6">
                    <label for="exampleInput-n">
                        @lang('app.field')
                    </label>
                    <select class="form-control @error('field') is-invalid @enderror'" wire:model.defer="state.field">
                        <option value="ALL">@lang('app.all')</option>
                        <option value="SALE">@lang('app.sale')</option>
                        <option value="RENT">@lang('app.rent')</option>
                    </select>
                    @error('field')
                        <span class="text-danger text-sm col-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.name" label="{{ __('app.name') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.email" label="{{ __('app.email') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.phone" label="{{ __('app.phone') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.password" label="{{ __('app.password') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.password_confirmation" label="{{ __('app.password_confirmation') }}" />
                </div>
                <div class="col-md-12">
                    <hr />
                    <x-admin.checkbox name="state.is_approved" label="{{ __('app.is_approved') }}" />
                    <hr />
                </div>
                <div class="col-md-12">
                    <label for="exampleInput-n">
                        @lang('app.governorates')
                    </label>
                    <select class="form-control @error('governorate_ids') is-invalid @enderror'"
                        wire:model.defer="governorate_ids" multiple>
                        @forelse ($governorates as $governorate)
                            <option value="{{ $governorate->id }}">{{ $governorate->translate('name') }}</option>
                        @empty
                            {!! noData() !!}
                        @endforelse
                    </select>
                    @error('governorate_ids')
                        <span class="text-danger text-sm col-12">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.description_ar" label="{{ __('app.description_ar') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.description_en" label="{{ __('app.description_en') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.file name="state.image" :image="$state" label="{{ __('app.image') }}"
                        :oldImage="$state['old_image']" />
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
