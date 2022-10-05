<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.school') | @lang('app.edit')</x-slot>
    <x-slot name="title">@lang('app.school') | @lang('app.edit')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.school.index') }}">@lang('app.schools')</a></li>
        <li class="breadcrumb-item active">@lang('app.edit')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">


                <div class="col-md-6">
                    <label for="exampleInputgov">
                        @lang('app.governorates')
                    </label>
                    <select class="form-control" id="exampleInputgov" wire:model="state.governorate_id">
                        <option value="">@lang('app.choose_governorate')</option>
                        @forelse ($governorates as $governorate)
                            <option value="{{ $governorate->id }}">{{ $governorate->translate('name') }}</option>
                        @empty
                            {!! noData() !!}
                        @endforelse
                    </select>
                </div>

                <div class="col-md-6">
                    <x-admin.select name="state.region_id" label="{{ __('app.regions') }}">
                        <option value="">@lang('app.choose_region')</option>
                        @forelse ($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->translate('name') }}</option>
                        @empty
                            {!! noData() !!}
                        @endforelse
                    </x-admin.select>
                </div>



                <div class="col-md-6">
                    <x-admin.input name="state.title_ar" label="{{ __('app.title_ar') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.title_en" label="{{ __('app.title_en') }}" />
                </div>

                <div class="col-md-6">
                    <x-admin.input name="state.map_link" label="{{ __('app.map_link') }}" />
                </div>

                <div class="col-md-6">
                    <x-admin.input name="state.phone" label="{{ __('app.phone') }}" />
                </div>

                <div class="col-md-6">
                    <x-admin.input  name="state.email" label="{{ __('app.email') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input  name="state.facebook" label="{{ __('app.facebook') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input  name="state.twitter" label="{{ __('app.twitter') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input  name="state.instagram" label="{{ __('app.instagram') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input  name="state.snapchat" label="{{ __('app.snapchat') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input  name="state.youtube" label="{{ __('app.youtube') }}" />
                </div>

                <div class="col-md-12">
                    <x-admin.textarea name="state.text_ar" label="{{ __('app.text_ar') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.text_en" label="{{ __('app.text_en') }}" />
                </div>

                <div class="col-md-12">
                    <x-admin.file name="state.image" :image="$state" label="{{ __('app.image') }}"
                        :oldImage="$state['old_image']"   />
                </div>


                <div class="col-md-12 mt-4 justify-content-center align-items-center d-flex border-1">
                    <button type="button" class="btn bg-gradient-primary btn-flat mt-4" wire:loading.attr="disabled"
                        wire:click.prevent="update">
                        <i class="far fa-save"></i>
                        @lang('app.save')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
