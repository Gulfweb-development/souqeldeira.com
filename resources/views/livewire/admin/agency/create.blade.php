<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.agency') | @lang('app.create')</x-slot>
    <x-slot name="title">@lang('app.agency') | @lang('app.create')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.agency.index') }}">@lang('app.agencies')</a></li>
        <li class="breadcrumb-item active">@lang('app.create')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">

                 <div class="col-md-6">
                    <x-admin.select name="state.user_id" label="{{ __('app.companies') }}">
                        <option value="">@lang('app.choose_company')</option>
                        @forelse ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                     <div class="col-md-12">
                    <x-admin.textarea name="state.text_ar" label="{{ __('app.text_ar') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.text_en" label="{{ __('app.text_en') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.file name="state.image" :image="$state" label="{{ __('app.image') }}"  />
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
