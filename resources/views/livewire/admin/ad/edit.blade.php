<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.ad') | @lang('app.edit')</x-slot>
    <x-slot name="title">@lang('app.ad') | @lang('app.edit')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ad.index') }}">@lang('app.ads')</a></li>
        <li class="breadcrumb-item active">@lang('app.edit')</li>
    </x-slot>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-admin.select name="state.user_id" label="{{ __('app.users') }}">
                        <option value="">@lang('app.choose_user')</option>
                        @forelse ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @empty
                            {!! noData() !!}
                        @endforelse
                    </x-admin.select>
                </div>

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
                    <x-admin.select name="state.building_type_id" label="{{ __('app.building_types') }}">
                        <option value="">@lang('app.choose_buliding_type')</option>
                        @forelse ($buildingTypes as $buildingType)
                            <option value="{{ $buildingType->id }}">{{ $buildingType->translate('name') }}</option>
                        @empty
                            {!! noData() !!}
                        @endforelse
                    </x-admin.select>
                </div>

                <div class="col-md-6">
                    <x-admin.select name="state.type" label="{{ __('app.type') }}">
                        <option value="">@lang('app.type')</option>
                        <option value="SALE">@lang('app.sale')</option>
                        <option value="RENT">@lang('app.rent')</option>
                    </x-admin.select>
                </div>

                <div class="col-md-6">
                    <x-admin.input name="state.phone" label="{{ __('app.phone') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input type="number" name="state.price" label="{{ __('app.price') }}" />
                </div>

                <div class="col-md-12">
                    <hr />
                    <x-admin.checkbox name="state.is_featured" label="{{ __('app.is_featured') }}" />
                    <hr />
                </div>
                <div class="col-md-12">
                    <hr />
                    <x-admin.checkbox name="state.is_approved" label="{{ __('app.is_approved') }}" />
                    <hr />
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.text" label="{{ __('app.text') }}" />
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
