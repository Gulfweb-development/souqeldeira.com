<div>
    <x-slot name="meta_title">@lang('premium_position') | @lang('app.edit')</x-slot>

    <div class="section-body listing-table">
        <div class="widget-boxed-header">
            <h4>@lang('premium_position') | @lang('app.edit')</h4>
        </div>

        <div class="sidebar-widget author-widget2">
            <div class="agent-contact-form-sidebar">


                <label for="">
                    @lang('app.type')
                </label>
                <select class="w-100 form-control mb-3 border-1 border-secondary new-select" wire:model="type">
                    <option value="">@lang('app.choose')</option>
                    <option value="image">@lang('image')</option>
                    <option value="text">@lang('text')</option>
                </select>
                @error('type')
                <p class="text-danger text-sm">{{ $message }}</p>
                @enderror


                @if ( $type == "text")
                <x-frontend.input name="title" label="{{ __('app.title') }}" />


                <x-frontend.textarea name="text" label="{{ __('app.text') }}" />
                @elseif( $type == "image" )
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
                            @if ($position->image)
                            <div class="text-center currentImage">
                                <h6>@lang('app.current')</h6>
                                <img src="{{ asset($position->image) }}" width="200" height="200" class="img-fluid img-1">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                @if ( $type == "text" or $type == "image" )
                <input type="button" name="sendmessage" class="multiple-send-message mt-5" value="@lang('app.update')"
                    wire:loading.attr="disabled" wire:click.prevent="edit" />
                @endif
            </div>
        </div>
    </div>
    @push('js')
        <script>
            function deleteImage(){
                @this.set('old_image', null);
                $(".currentImage").hide();
            }
        </script>
    @endpush
</div>
