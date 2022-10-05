<div>
    @php
        $uuid = Str::uuid();
    @endphp
            @php
            // REFORMAT CUZ I'M USING STATE
            $nameWithoutState = substr($name, 6);
        @endphp
    <div class="custom-control custom-checkbox">
        <input wire:model='{{ $name }}' value="1" class="custom-control-input @error($nameWithoutState) is-invalid @enderror" type="checkbox"
            id="customCheckbox{{ $uuid }}">
        <label for="customCheckbox{{ $uuid }}" class="pointer custom-control-label">
            {{ $label }}
        </label>
    </div>
      @error($nameWithoutState)
            <span class="text-danger text-sm col-12">{{ $message }}</span>
        @enderror
</div>
