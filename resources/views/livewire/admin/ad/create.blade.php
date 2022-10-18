<div>
    <x-slot name="meta_title">@lang('app.dashboard') | @lang('app.ad') | @lang('app.create')</x-slot>
    <x-slot name="title">@lang('app.ad') | @lang('app.create')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ad.index') }}">@lang('app.ads')</a></li>
        <li class="breadcrumb-item active">@lang('app.create')</li>
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
{{--
                <div class="col-md-6">
                    <x-admin.select name="state.agency_id" label="{{ __('app.agencies') }}">
                        <option value="">@lang('app.choose_agency')</option>
                        @forelse ($agencies as $agency)
                            <option value="{{ $agency->id }}">{{ $agency->translate('name') }}</option>
                        @empty
                            {!! noData() !!}
                        @endforelse
                    </x-admin.select>
                </div> --}}

                <div class="col-md-6">
                    {{-- <x-admin.select name="state.governorate_id" label="{{ __('app.governorates') }}"> --}}
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
                    {{-- </x-admin.select> --}}
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
                            <option value="{{ $buildingType->id }}">{{ $buildingType->translate('name') }}
                            </option>
                        @empty
                            {!! noData() !!}
                        @endforelse
                    </x-admin.select>
                </div>

                {{-- <div class="col-md-6">
                    <x-admin.select name="state.building_status_id" label="{{ __('app.building_status') }}">
                        <option value="">@lang('app.choose_buliding_status')</option>
                        @forelse ($buildingStatuses as $buildingStatus)
                            <option value="{{ $buildingStatus->id }}">{{ $buildingStatus->translate('name') }}
                            </option>
                        @empty
                            {!! noData() !!}
                        @endforelse
                    </x-admin.select>
                </div> --}}


                <div class="col-md-6">
                    <x-admin.select name="state.type" label="{{ __('app.type') }}">
                        <option value="">@lang('app.type')</option>
                        <option value="SALE">@lang('app.sale')</option>
                        <option value="RENT">@lang('app.rent')</option>
                        <option value="EXCHANGE">@lang('app.exchange')</option>
                    </x-admin.select>
                </div>


                <div class="col-md-6">
                    <x-admin.input name="state.title_ar" label="{{ __('app.title_ar') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.title_en" label="{{ __('app.title_en') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.video_link" label="{{ __('app.video_link') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.map_link" label="{{ __('app.map_link') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input name="state.phone" label="{{ __('app.phone') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input type="number" name="state.price" label="{{ __('app.price') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input type="number" name="state.distance" label="{{ __('app.distance') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input type="number" name="state.rooms_count" label="{{ __('app.rooms_count') }}" />
                </div>
                <div class="col-md-6">
                    <x-admin.input type="number" name="state.bathrooms_count"
                        label="{{ __('app.bathrooms_count') }}" />
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
                    <x-admin.textarea name="state.text_ar" label="{{ __('app.text_ar') }}" />
                </div>
                <div class="col-md-12">
                    <x-admin.textarea name="state.text_en" label="{{ __('app.text_en') }}" />
                </div>

                <div class="col-md-12">
                    <x-admin.file name="state.image" :image="$state" label="{{ __('app.image') }}"
                        size="1920x1080" />
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
