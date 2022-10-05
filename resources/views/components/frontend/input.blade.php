<div>
    @isset($label)
        <label for="">
            {{ $label }}
        </label>
    @endisset
    <input type="{{ isset($type) ? $type : 'text' }}" id="fname-{{ $name }}" name="" wire:model.defer="{{ $name }}" />
    @error($name)
        <p class="text-danger text-sm">{{ $message }}</p>
    @enderror

</div>
