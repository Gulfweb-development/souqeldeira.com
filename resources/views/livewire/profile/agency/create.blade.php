<div>
    <x-slot name="meta_title">@lang('app.agencies') | @lang('app.create')</x-slot>
    <div class="section-body listing-table">
        <div class="widget-boxed-header">
            <h4>@lang('app.agencies') | @lang('app.create')</h4>
        </div>
        <div class="sidebar-widget author-widget2">
            <div class="agent-contact-form-sidebar">


                <x-frontend.input name="name_ar" label="{{ __('app.name_ar') }}" />

                <x-frontend.input name="name_en" label="{{ __('app.name_en') }}" />


                <x-frontend.textarea name="text_ar" label="{{ __('app.text_ar') }}" />

                <x-frontend.textarea name="text_en" label="{{ __('app.text_en') }}" />
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
                <input type="button" name="sendmessage" class="multiple-send-message" value="@lang('app.create')"
                    wire:loading.attr="disabled" wire:click.prevent="store" />

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
