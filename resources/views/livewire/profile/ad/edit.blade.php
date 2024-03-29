<div>
    <x-slot name="meta_title">@lang('app.ads') | @lang('app.edit')</x-slot>

    <div class="section-body listing-table">
        <div class="widget-boxed-header">
            <h4>@lang('app.ads') | @lang('app.edit')</h4>
        </div>

        <div class="sidebar-widget author-widget2">
            <div class="agent-contact-form-sidebar">

                @if ( ! $is_featured)
                    <div class="text-center mt-3 font-italic font-weight-bold text-primary">{{ __('do_you_want_to_see_more') }}</div>
                    <input type="button" class="multiple-send-message mb-3 m2-3 " value="@lang('Upgrade_special_Advertise')"
                           wire:loading.attr="disabled" wire:click.prevent="upgrade" />

                    <hr>
                @endif

{{--                <label for="" class="d-flex">@lang('app.governorates')</label>--}}
{{--                <select wire:model="governorate_id" class="w-100 form-control mb-3 border-1 border-secondary new-select">--}}
{{--                    <option value="">@lang('app.choose')</option>--}}
{{--                    @forelse ($governorates as $governorate)--}}
{{--                        <option value="{{ $governorate->id }}">{{ $governorate->translate('name') }}</option>--}}
{{--                    @empty--}}
{{--                        <option value="">@lang('app.no_data')</option>--}}
{{--                    @endforelse--}}
{{--                </select>--}}
{{--                <x-frontend.select name="region_id" label="{{ __('app.regions') }}">--}}
{{--                    <option value="">@lang('app.choose')</option>--}}
{{--                    @forelse ($regions as $region)--}}
{{--                        <option value="{{ $region->id }}">{{ $region->translate('name') }}</option>--}}
{{--                    @empty--}}
{{--                        <option value="">@lang('app.no_data')</option>--}}
{{--                    @endforelse--}}
{{--                </x-frontend.select>--}}
                <x-frontend.select name="region_id" label="{{ __('app.regions') }}">
                    <option value="">@lang('app.choose')</option>
                       @foreach ($governorates as $governorate)
                        <option disabled="disabled" style="font-weight:bold;color:#000000;font-size:20px;">--{{ $governorate->translate('name') }}--</option>
                            @foreach ($governorate->regions as $region)
                             <option value="{{ $region->id }}">
                            {{ $region->translate('name') }}</option>
                               @endforeach
                       @endforeach
                </x-frontend.select>
                <x-frontend.select name="building_type_id" label="{{ __('app.building_types') }}">
                    <option value="">@lang('app.choose')</option>
                    @forelse ($buildingTypes as $buildingType)
                        <option value="{{ $buildingType->id }}">{{ $buildingType->translate('name') }}</option>
                    @empty
                        <option value="">@lang('app.no_data')</option>
                    @endforelse
                </x-frontend.select>

                <x-frontend.select name="type" label="{{ __('app.type') }}">
                    <option value="">@lang('app.choose')</option>
                    <option value="SALE">@lang('app.sale')</option>
                    <option value="RENT">@lang('app.rent')</option>
                    <option value="EXCHANGE">@lang('app.exchange')</option>
                    <option value="REQUEST">@lang('app.REQUEST')</option>
                </x-frontend.select>


                <x-frontend.input name="phone" label="{{ __('app.phone') }}" />

                <x-frontend.input type="number" name="price" label="{{ __('app.price') }}" />

                <x-frontend.textarea name="text" label="{{ __('app.text') }}" />
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">@lang('app.image')</label>
                        <input type="file" id="fname-file" name="" wire:model="image" />
                        @error('image')
                            <p class="text-danger text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between">
                            @if ($image)
                                <div class="text-center">
                                    <h6>@lang('app.new')</h6>
                                    <img src="{{ $image->temporaryUrl() }}" width="200" height="200"
                                        class="img-fluid img-1">
                                </div>
                            @endif
                            @if ($old_image)
                            <div class="text-center currentImage">
                                <h6>@lang('app.current') <button class="btn btn-danger" onclick="deleteImage()"><i class="far fa-trash-alt"></i></button></h6>
                                <img src="{{ $old_image }}" width="200" height="200" class="img-fluid img-1">
                            </div>
                                <input type="hidden" id="oldImage" wire:model="old_image">
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">@lang('app.or_drag_here')</label>
                        {{-- <input type="file" id="fname-file" name="" wire:model="image" /> --}}
                        <div class="drag-and-drop-area mt-5" id="drg-area" x-data="drop_file_component()"
                            x-bind:class="dropingFile ? 'drop-enter' : 'drop-none'" x-on:drop="dropingFile = false"
                            x-on:drop.prevent="
                handleFileDrop($event)
            " x-on:dragover.prevent="dropingFile = true" x-on:dragleave.prevent="dropingFile = false">

                            <span class="text-center" wire:loading.remove wire.target="photo">
                                @lang('app.drag_and_drop_image_here')</span>

                        </div>
                        @error('image')
                            <p class="text-danger text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center h-100">
                            @if ($image)
                                <div class="text-center">
                                    <h6>@lang('app.new')</h6>
                                    <img src="{{ $image->temporaryUrl() }}" width="200" height="200"
                                        class="img-fluid img-1">
                                </div>
                            @endif
                            @if ($old_image)
                            <div class="text-center currentImage">
                                <h6>@lang('app.current') <button class="btn btn-danger" onclick="deleteImage()"><i class="far fa-trash-alt"></i></button></h6>
                                <img src="{{ $old_image }}" width="200" height="200" class="img-fluid img-1">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <input type="button" name="sendmessage" class="multiple-send-message mt-5" value="@lang('app.update')"
                    wire:loading.attr="disabled" wire:click.prevent="update" />
            </div>
        </div>
    </div>
    @push('css')
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
    @push('js')
        <script>
            function drop_file_component() {
                return {
                    dropingFile: false,
                    handleFileDrop(e) {
                        if (event.dataTransfer.files.length > 0) {
                            const file = e.dataTransfer.files[0];
                            // Upload a file:
                            @this.upload('photo', file, (uploadedFilename) => {
                                // Success callback.
                            }, () => {
                                // Error callback.
                            }, (event) => {
                                // Progress callback.
                                // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                            })
                        }
                    }
                };
            }

            function deleteImage(){
                @this.set('old_image', null);
                $(".currentImage").hide();
            }
        </script>
    @endpush
</div>
