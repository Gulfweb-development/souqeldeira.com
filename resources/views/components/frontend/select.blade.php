<div>
    @isset($label)
        <label for="">
            {{ $label }}
        </label>
    @endisset
    <select class="w-100 form-control mb-3 border-1 border-secondary new-select" wire:model.defer="{{ $name }}">
        {{ $slot }}
    </select>
    @error($name)
        <p class="text-danger text-sm">{{ $message }}</p>
    @enderror
</div>
