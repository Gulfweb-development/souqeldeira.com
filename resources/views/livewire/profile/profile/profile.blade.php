<div>
    <x-slot name="meta_title">@lang('app.profile')</x-slot>
    <div class="section-body listing-table">
        <div class="widget-boxed-header">
            <h4>@lang('app.profile_details')</h4>
        </div>
        <div class="sidebar-widget author-widget2">
            <div class="author-box clearfix">
                <img src="{{ toProfileDefaultImage(user()->getFile()) }}" alt="author-image" class="author__img">
                <h4 class="author__title">{{ user()->name }}</h4>
                {{-- <p class="author__meta">Agent of Property</p> --}}
            </div>
            <ul class="author__contact">
                <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span><span
                        class="font-weight-bold">@lang('app.name') :</span> {{ user()->name }}</li>
                <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span><span
                        class="font-weight-bold">@lang('app.phone') :</span> {{ user()->phone }}</li>
                <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span><span
                        class="font-weight-bold">@lang('app.email') :</span> {{ user()->email }}</li>
                <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span><span
                        class="font-weight-bold">@lang('app.type') :</span> {{ user()->type }}</li>
                <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span><span
                        class="font-weight-bold">@lang('app.field') :</span> {{ user()->field }}</li>

                <li>
                    <span class="la la-map-marker"><i class="fa fa-map-marker"></i></span>
                    <span class="font-weight-bold">@lang('app.adv_nurmal_count') :</span> {{ user()->adv_nurmal_count }}
                </li>
                <li>
                    <span class="la la-map-marker"><i class="fa fa-map-marker"></i></span>
                    <span class="font-weight-bold">@lang('app.adv_star_count') :</span> {{ user()->adv_star_count }}
                </li>



                <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span><span
                        class="font-weight-bold">@lang('app.about') :</span> {{ user()->description }}
                </li>
                <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span><span
                        class="font-weight-bold">@lang('app.governorates') :</span>
                    @forelse (user()->governorates as $governorate)
                        {{ $governorate->translate('name') }} -
                    @empty
                        @lang('app.no_data')
                    @endforelse
                </li>

            </ul>
            <div class="agent-contact-form-sidebar">
                <h4>@lang('app.update_profile')</h4>
                <x-frontend.input name="name" label="{{ __('app.name') }}" />
                <x-frontend.input name="phone" label="{{ __('app.phone') }}" />
                <x-frontend.select name="field" label="{{ __('app.field') }}">
                    <option value="ALL">@lang('app.all')</option>
                    <option value="RENT">@lang('app.rent')</option>
                    <option value="SALE">@lang('app.sale')</option>
                    <option value="EXCHANGE">@lang('app.exchange')</option>
                </x-frontend.select>
                <label for="exampleFormControlSelect1">
                    @lang('app.governorates')
                </label>
                <select class="w-100 form-control mb-3 border-1 border-secondary new-select"
                    wire:model.defer="governorate_ids" id="exampleFormControlSelect1" multiple>
                    @forelse ($governorates as $governorate)
                        <option value="{{ $governorate->id }}">{{ $governorate->translate('name') }}</option>
                    @empty
                        <option value="">@lang('app.no_data')</option>
                    @endforelse
                </select>
                @error('governorate_ids')
                    <p class="text-danger text-sm">{{ $message }}</p>
                @enderror
                <x-frontend.textarea name="description" label="{{ __('app.description') }}" />
                {{-- <x-frontend.textarea name="description_en" label="{{ __('app.description_en') }}" /> --}}
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
                        @if ($image)
                            <div class="text-center">
                                <h6>@lang('app.new')</h6>
                                <img src="{{ $image->temporaryUrl() }}" width="200" height="200"
                                    class="img-fluid img-1">
                            </div>
                        @endif
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

                            <span class="text-center" wire:loading.remove wire.target="photo"> @lang('app.drag_and_drop_image_here')</span>

                        </div>
                        @error('image')
                            <p class="text-danger text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        @if ($image)
                            <div class="text-center">
                                <h6>@lang('app.new')</h6>
                                <img src="{{ $image->temporaryUrl() }}" width="200" height="200"
                                    class="img-fluid img-1">
                            </div>
                        @endif
                    </div>
                </div>
                <hr>
                <input type="button" name="sendmessage" class="multiple-send-message"
                    value="@lang('app.update_profile')" wire:loading.attr="disabled" wire:click.prevent="update" />

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
        </script>
    @endpush
</div>
