<div>
    <div class="form-group">
        @php
            // REFORMAT CUZ I'M USING STATE
            $nameWithoutState = substr($name, 6);
        @endphp

        @if (isset($label))
            <label for="exampleInput{{ $name }}">
                {{ $label }}
            </label>
        @endif
        <input type="{{ isset($type) ? $type : 'text' }}"
            class='form-control @error($nameWithoutState) is-invalid @enderror' id="exampleInput{{ $name }}"
            placeholder="{{ $placeholder ?? '' }}" wire:model.defer="{{ $name }}">

        @error($nameWithoutState)
            <span class="text-danger text-sm col-12">{{ $message }}</span>
        @enderror
    </div>

</div>
