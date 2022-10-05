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
    <select class="form-control @error($nameWithoutState) is-invalid @enderror'" wire:model.defer="{{ $name }}" multiple>
        {{ $slot }}
    </select>

    @error($nameWithoutState)
        <span class="text-danger text-sm col-12">{{ $message }}</span>
    @enderror
</div>
