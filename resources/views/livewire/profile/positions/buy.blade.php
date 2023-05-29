<div>
    <x-slot name="meta_title">@lang('premium_position') {{ $position_id + 1 }} | @lang('buy')</x-slot>

    <div class="section-body listing-table">
        <div class="widget-boxed-header">
            <h4>@lang('premium_position') {{ $position_id + 1 }} | @lang('buy')</h4>
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

                    <label for="">@lang('app.image')</label>
                    <input type="file" id="fname-file" name="" wire:model="image" />
                    @error('image')
                    <p class="text-danger text-sm">{{ $message }}</p>
                    @enderror
                @endif

                @if ( $type == "text" or $type == "image" )
                <input type="button" name="sendmessage" class="multiple-send-message mt-5" value="@lang('buy') ( {{ $position['price'] }} @lang('app.currency')  - {{ $position['expire'] }} @lang('day') )"
                    wire:loading.attr="disabled" wire:click.prevent="buy" />
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
