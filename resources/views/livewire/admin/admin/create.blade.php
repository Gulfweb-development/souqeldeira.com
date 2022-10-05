<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.admin') | @lang('app.create')</x-slot>
    <x-slot name="title">@lang('app.admin') | @lang('app.create')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}">@lang('app.admins')</a></li>
        <li class="breadcrumb-item active">@lang('app.create')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-admin.select name="role_id" label="{{ __('app.roles') }}">
                        <option value="">@lang('app.choose')</option>
                        @forelse ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->translate('label') }}</option>
                        @empty
                            {!! noData() !!}
                        @endforelse
                    </x-admin.select>
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.name" label="{{ __('app.name') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.email" label="{{ __('app.email') }}" />
                </div>

                <div class="col-md-6">
                    <x-admin.input name="state.password" label="{{ __('app.password') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.password_confirmation" label="{{ __('app.password_confirmation') }}" />
                </div>

                <div class="col-md-12">
                    <x-admin.file name="state.image" :image="$state" label="{{ __('app.image') }}" />
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
