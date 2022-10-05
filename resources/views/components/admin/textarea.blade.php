<div>
    <div class="form-group">
        @php
            // REFORMAT CUZ I'M USING STATE
            $nameWithoutState = substr($name, 6);
        @endphp
        @if (isset($label))
            <label for="exampleFormControlTextarea1{{ $name }}">
                {{ $label }}
            </label>
        @endif
        <textarea class="form-control @error($nameWithoutState) is-invalid @enderror" rows="3"
            wire:model="{{ $name }}" placeholder="{{ $placeholder ?? '' }}"
            id="exampleFormControlTextarea1{{ $name }}"></textarea>
        @error($nameWithoutState)
            <span class="text-danger text-sm col-12">{{ $message }}</span>
        @enderror
    </div>
</div>
