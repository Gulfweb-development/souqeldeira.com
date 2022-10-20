<div>
    <div class='row'>
        @php
            $uuid = Str::uuid();
        @endphp
        @php
            // REFORMAT CUZ I'M USING STATE
            $nameWithoutState = substr($name, 6);
        @endphp
        <div class='col-12 col-md-6'>
            <div class="form-group">
                <label for="customFile-{{ $uuid }}">{{ $label ?? '' }}</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error($nameWithoutState) is-invalid @enderror"
                        id="customFile-{{ $uuid }}" wire:loading.attr='disabled'
                        wire:model='{{ $name }}'>
                    <label class="custom-file-label" for="customFile-{{ $uuid }}">
                        {{-- NAME OF FILE INSIDE INPUT ISTED OF CHOOSE FILE --}}
                        @if (array_key_exists('image', $image))
                            {{ $image['image']->getClientOriginalName() }}
                        @else
                            @lang('app.choose_file')
                        @endif
                    </label>
                </div>
                @isset($size)
                    <p class="text-muted">{{ $size }}</p>
                @endisset
                <div class="d-none" wire:loading.class="d-block" wire:target="{{ $name }}">
                    <div class="progress mt-2 rounded">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                    </div>
                </div>
            </div>
            @error($nameWithoutState)
                <span class="text-danger text-sm col-12">{{ $message }}</span>
            @enderror
        </div>
        <div class='col-12 col-md-6'>
            <div class="d-flex">
                @if (array_key_exists('image', $image))
                    <div class="text-center">
                        <h6>@lang('app.new')</h6>
                        <img src="{{ $image['image']->temporaryUrl() }}" width="80" height="80" class="temp-img">
                    </div>
                @endif
                @isset($oldImage)
                    <div class="text-center">
                        <h6>@lang('app.current')</h6>
                        <img src="{{ toAdDefaultImage(asset($oldImage)) }}" width="80" height="80" class="temp-img">
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
